<?php
/**
 * Shared helpers: config/data access, asset + URL builders, nav state,
 * text helpers, escaping, CSRF.
 */

declare(strict_types=1);

/* ---------------------------------------------------------------
   Config + data
   --------------------------------------------------------------- */

/** cfg() → whole array, cfg('phone') → one value, cfg('mail.host') → nested. */
function cfg(?string $key = null)
{
    static $config = null;
    if ($config === null) {
        $file   = is_file(__DIR__ . '/config.php') ? __DIR__ . '/config.php' : __DIR__ . '/config.sample.php';
        $config = require $file;
    }
    if ($key === null) {
        return $config;
    }
    $value = $config;
    foreach (explode('.', $key) as $segment) {
        if (!is_array($value) || !array_key_exists($segment, $value)) {
            return null;
        }
        $value = $value[$segment];
    }
    return $value;
}

/** data('services') → the services array. */
function data(?string $key = null)
{
    static $data = null;
    if ($data === null) {
        $data = require __DIR__ . '/data.php';
    }
    return $key === null ? $data : ($data[$key] ?? []);
}

/** Find one record in a data set by its slug. */
function find_by_slug(string $set, string $slug): ?array
{
    foreach (data($set) as $row) {
        if (($row['slug'] ?? null) === $slug) {
            return $row;
        }
    }
    return null;
}

/* ---------------------------------------------------------------
   URLs + assets
   --------------------------------------------------------------- */

/** Root-relative path to a file inside /assets. */
function asset(string $path): string
{
    return 'assets/' . ltrim($path, '/');
}

/**
 * Same as asset() but with a ?v=<mtime> cache buster, so a deployed CSS/JS
 * change is picked up immediately despite the long browser cache in .htaccess.
 */
function asset_v(string $path): string
{
    $rel  = asset($path);
    $full = __DIR__ . '/../' . $rel;
    return is_file($full) ? $rel . '?v=' . filemtime($full) : $rel;
}

/** Root-relative page URL. */
function url(string $path = ''): string
{
    return $path === '' ? 'index.php' : ltrim($path, '/');
}

/** 'is-active' when $page matches the current script. */
function active_nav(string $page): string
{
    return basename($_SERVER['SCRIPT_NAME'] ?? '') === $page ? ' is-active' : '';
}

/* ---------------------------------------------------------------
   Text
   --------------------------------------------------------------- */

function e(?string $value): string
{
    return htmlspecialchars((string) $value, ENT_QUOTES, 'UTF-8');
}

function excerpt(string $text, int $words = 22): string
{
    $parts = preg_split('/\s+/', trim($text)) ?: [];
    if (count($parts) <= $words) {
        return $text;
    }
    return implode(' ', array_slice($parts, 0, $words)) . '…';
}

/** Splits a heading into per-word spans for the GSAP colour reveal. */
function reveal_words(string $text): string
{
    $out = '';
    foreach (preg_split('/\s+/', trim($text)) as $word) {
        $out .= '<span class="rw">' . e($word) . '</span> ';
    }
    return trim($out);
}

/**
 * <img> with explicit dimensions, or a labelled grey placeholder at the same
 * aspect ratio when the file is missing — so gaps in the asset set are visible.
 */
function img(string $file, string $alt, int $w, int $h, array $opts = []): string
{
    $path  = asset('images/' . ltrim($file, '/'));
    $class = $opts['class'] ?? '';
    $eager = !empty($opts['eager']);

    if (is_file(__DIR__ . '/../' . $path)) {
        // ?v=<mtime> so a re-exported image is picked up despite the long
        // browser cache .htaccess sets on images.
        return sprintf(
            '<img src="%s" alt="%s" width="%d" height="%d" class="%s" decoding="async" %s>',
            e(asset_v('images/' . ltrim($file, '/'))), e($alt), $w, $h, e($class),
            $eager ? 'fetchpriority="high"' : 'loading="lazy"'
        );
    }

    // Below ~90px there is no room for a filename label — render a plain tile
    // so avatars don't show letters stacked one per line.
    $label = ($w <= 90 || $h <= 90) ? '' : '<span>' . e(basename($file)) . '</span>';

    return sprintf(
        '<div class="img-ph %s%s" role="img" aria-label="%s (image missing)" style="aspect-ratio:%d/%d" title="%s">%s</div>',
        e($class), $label === '' ? ' img-ph--bare' : '',
        e($alt), $w, $h, e(basename($file)), $label
    );
}

/* ---------------------------------------------------------------
   CSRF
   --------------------------------------------------------------- */

function csrf_token(): string
{
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

function csrf_field(): string
{
    return '<input type="hidden" name="csrf_token" value="' . e(csrf_token()) . '">';
}

function csrf_verify(?string $token): bool
{
    return is_string($token)
        && !empty($_SESSION['csrf_token'])
        && hash_equals($_SESSION['csrf_token'], $token);
}

/** wa.me link with the configured number + prefilled message. */
function whatsapp_link(): string
{
    return 'https://wa.me/' . cfg('whatsapp') . '?text=' . rawurlencode((string) cfg('whatsapp_msg'));
}

/* ---------------------------------------------------------------
   Inline SVG icon set (no icon-font dependency)
   --------------------------------------------------------------- */
function icon(string $name, string $class = ''): string
{
    $p = [
        'camera'      => '<path d="M2 8.5 15 5v9.5L2 18V8.5Z"/><path d="M15 8h4.5a2.5 2.5 0 0 1 0 5H15"/><circle cx="7" cy="12" r="2.2"/>',
        'flame'       => '<path d="M12 2s5 4.5 5 9a5 5 0 0 1-10 0c0-1.7 1-3.2 2-4 0 2 1 3 2 3 1.5 0 1-4 1-8Z"/>',
        'droplet'     => '<path d="M12 3s6 6 6 10a6 6 0 0 1-12 0c0-4 6-10 6-10Z"/>',
        'fingerprint' => '<path d="M12 4a8 8 0 0 0-8 8v3"/><path d="M20 13v-1a8 8 0 0 0-4-6.9"/><path d="M8 12a4 4 0 0 1 8 0v5"/><path d="M12 12v7"/>',
        'clock'       => '<circle cx="12" cy="12" r="9"/><path d="M12 7v5l3.5 2"/>',
        'shield'      => '<path d="M12 3 4.5 6v6c0 4.4 3.1 7.9 7.5 9 4.4-1.1 7.5-4.6 7.5-9V6L12 3Z"/>',
        'barrier'     => '<path d="M3 10h18"/><path d="M4 10V7"/><path d="M4 21v-8"/><path d="M8 10 21 6"/>',
        'headset'     => '<path d="M4 13v-1a8 8 0 0 1 16 0v1"/><rect x="2.5" y="13" width="4" height="6" rx="1.6"/><rect x="17.5" y="13" width="4" height="6" rx="1.6"/><path d="M20 19v1a3 3 0 0 1-3 3h-3"/>',
        'link'        => '<path d="M10 13a4 4 0 0 0 5.7.4l2.6-2.6a4 4 0 0 0-5.7-5.7L11 6.7"/><path d="M14 11a4 4 0 0 0-5.7-.4L5.7 13.2a4 4 0 0 0 5.7 5.7l1.6-1.6"/>',
        'cpu'         => '<rect x="7" y="7" width="10" height="10" rx="2"/><path d="M4 10h3M4 14h3M17 10h3M17 14h3M10 4v3M14 4v3M10 17v3M14 17v3"/>',
        'arrow'       => '<path d="M6 18 18 6"/><path d="M9 6h9v9"/>',
        'check'       => '<path d="m4 12 5 5L20 6"/>',
        'chevron'     => '<path d="m9 5 7 7-7 7"/>',
        'chevron-left'=> '<path d="m15 5-7 7 7 7"/>',
        'nodes'       => '<circle cx="5.5" cy="6" r="2.2"/><circle cx="18.5" cy="6" r="2.2"/><circle cx="12" cy="18" r="2.2"/><path d="M7.4 7.3 10.9 16"/><path d="M16.6 7.3 13.1 16"/><path d="M7.7 6h8.6"/>',
        'shield-check'=> '<path d="M12 3 4.5 6v6c0 4.4 3.1 7.9 7.5 9 4.4-1.1 7.5-4.6 7.5-9V6L12 3Z"/><path d="m9 12 2.2 2.2L15.5 10"/>',
        'plus'        => '<path d="M12 5v14M5 12h14"/>',
        'phone'       => '<path d="M5 4h4l2 5-2.5 1.5a12 12 0 0 0 5 5L15 13l5 2v4a2 2 0 0 1-2.2 2A16.5 16.5 0 0 1 3 6.2 2 2 0 0 1 5 4Z"/>',
        'mail'        => '<rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3.5 7 8.5 6 8.5-6"/>',
        'pin'         => '<path d="M12 21s7-6 7-11a7 7 0 1 0-14 0c0 5 7 11 7 11Z"/><circle cx="12" cy="10" r="2.5"/>',
        'send'        => '<path d="M21 3 3 10.5l7 3 3 7L21 3Z"/>',
        'star'        => '<path d="m12 3 2.6 5.7 6.4.7-4.7 4.3 1.3 6.3L12 17l-5.6 3 1.3-6.3L3 9.4l6.4-.7L12 3Z"/>',
        'quote'       => '<path d="M9 6c-3 1.5-5 4.5-5 8v4h6v-6H6c0-2.5 1.2-4.3 3-5.2L9 6Zm11 0c-3 1.5-5 4.5-5 8v4h6v-6h-4c0-2.5 1.2-4.3 3-5.2L20 6Z"/>',
        'menu'        => '<path d="M3 6h18M3 12h18M3 18h18"/>',
        'close'       => '<path d="M6 6l12 12M18 6 6 18"/>',
        'cart'        => '<circle cx="9" cy="20" r="1.4"/><circle cx="17.5" cy="20" r="1.4"/><path d="M3 4h2.2l2.3 11.2a1.5 1.5 0 0 0 1.5 1.2h8.3a1.5 1.5 0 0 0 1.5-1.2L21 8H6"/>',
        'trash'       => '<path d="M4 7h16"/><path d="M9 7V5.5A1.5 1.5 0 0 1 10.5 4h3A1.5 1.5 0 0 1 15 5.5V7"/><path d="M6.5 7 7.4 19a1.6 1.6 0 0 0 1.6 1.5h6a1.6 1.6 0 0 0 1.6-1.5L17.5 7"/><path d="M10.5 11v5M13.5 11v5"/>',
        'minus'       => '<path d="M5 12h14"/>',
        'truck'       => '<rect x="2.5" y="6.5" width="11" height="9" rx="1.5"/><path d="M13.5 9.5h3.6l3.4 3.2v2.8h-7"/><circle cx="7" cy="18" r="1.8"/><circle cx="17" cy="18" r="1.8"/>',
        'wallet'      => '<rect x="3" y="6" width="18" height="13" rx="2.5"/><path d="M3 10h18"/><circle cx="17" cy="14.5" r="1.3"/>',
        'search'      => '<circle cx="11" cy="11" r="7"/><path d="m16.5 16.5 4 4"/>',
        'sliders'     => '<path d="M4 6h10M18 6h2M4 12h4M12 12h8M4 18h10M18 18h2"/><circle cx="16" cy="6" r="2"/><circle cx="10" cy="12" r="2"/><circle cx="16" cy="18" r="2"/>',
        'grid'        => '<rect x="3" y="3" width="7" height="7" rx="1.5"/><rect x="14" y="3" width="7" height="7" rx="1.5"/><rect x="3" y="14" width="7" height="7" rx="1.5"/><rect x="14" y="14" width="7" height="7" rx="1.5"/>',
        'whatsapp'    => '<path d="M12 3a9 9 0 0 0-7.8 13.5L3 21l4.7-1.2A9 9 0 1 0 12 3Z"/><path d="M8.8 8.6c.3-.6.6-.6.9-.6h.7l1 2.2-.8.9a6.5 6.5 0 0 0 3.3 3.3l.9-.8 2.2 1v.7c0 .3 0 .6-.6.9-1.5.8-4.2-.4-6-2.2s-3-4.5-2.2-6Z"/>',
        'arrow-up'    => '<path d="M12 19V5"/><path d="m5 12 7-7 7 7"/>',
        'play'        => '<path d="M8 5v14l11-7L8 5Z"/>',
        'facebook'    => '<path d="M14 8.5h2.5V5.6h-2.6c-2.3 0-3.6 1.4-3.6 3.7V11H8v3h2.3v6.5h3.2V14h2.4l.4-3h-2.8V9.6c0-.8.2-1.1 1-1.1Z"/>',
        'instagram'   => '<rect x="3.5" y="3.5" width="17" height="17" rx="5"/><circle cx="12" cy="12" r="3.8"/><circle cx="17" cy="7" r="1.1" fill="currentColor" stroke="none"/>',
        'linkedin'    => '<rect x="3.5" y="3.5" width="17" height="17" rx="3"/><path d="M8 10.5V16"/><path d="M8 7.6v.1"/><path d="M11.6 16v-3.1a2.3 2.3 0 0 1 4.6 0V16"/>',
        'youtube'     => '<rect x="2.8" y="6" width="18.4" height="12" rx="3.4"/><path d="m10.4 9.6 4.6 2.4-4.6 2.4V9.6Z"/>',
    ][$name] ?? '';

    return '<svg class="ico ' . e($class) . '" viewBox="0 0 24 24" fill="none" stroke="currentColor" '
         . 'stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $p . '</svg>';
}

/* ===============================================================
   LEGACY SHIMS — keep the not-yet-migrated pages working.
   Delete each of these once every page has moved to cfg()/data().
   =============================================================== */

/** Old brand/contact accessor, still backed by config/site.php. */
function site(?string $key = null)
{
    static $legacy = null;
    if ($legacy === null) {
        $legacy = is_file(__DIR__ . '/../config/site.php')
            ? require __DIR__ . '/../config/site.php'
            : [];
    }
    return $key === null ? $legacy : ($legacy[$key] ?? null);
}

/** Old image helper (paths relative to the project root, e.g. assets/img/...). */
function img_tag(string $path, string $alt, string $class = '', bool $eager = false): string
{
    if (is_file(__DIR__ . '/../' . $path)) {
        return sprintf(
            '<img src="%s" alt="%s" class="%s" %s decoding="async">',
            e($path), e($alt), e($class),
            $eager ? 'fetchpriority="high"' : 'loading="lazy"'
        );
    }
    return sprintf(
        '<div class="img-ph %s" role="img" aria-label="%s (image missing)"><span>%s</span></div>',
        e($class), e($alt), e(basename($path))
    );
}

function clean_input(string $value): string
{
    return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

function nav_active(string $page): string
{
    return basename($_SERVER['SCRIPT_NAME'] ?? '') === $page ? 'nav-link nav-link-active' : 'nav-link';
}

function mobile_nav_active(string $page): string
{
    return basename($_SERVER['SCRIPT_NAME'] ?? '') === $page ? 'mobile-link mobile-link-active' : 'mobile-link';
}
