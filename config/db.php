<?php
/**
 * Database configuration & PDO connection.
 *
 * Settings are resolved in this order, first hit wins:
 *
 *   1. A connection URL — MYSQL_URL or DATABASE_URL (what Railway/Heroku hand you)
 *   2. Individual environment variables — DB_* or Railway's MYSQL*
 *   3. config/db.local.php — a gitignored array for local development
 *   4. The XAMPP defaults at the bottom
 *
 * That way the same file works on a laptop and inside a container, and no
 * credential is ever committed.
 */

declare(strict_types=1);

$local = is_file(__DIR__ . '/db.local.php') ? require __DIR__ . '/db.local.php' : [];

/** Reads a variable from every place a SAPI might expose it. */
$envValue = static function (string $name): string {
    $value = getenv($name);
    if ($value === false || $value === '') {
        $value = $_SERVER[$name] ?? $_ENV[$name] ?? '';
    }
    return is_string($value) ? $value : '';
};

// A single connection URL, if the host provides one.
$url = [];
foreach (['MYSQL_URL', 'DATABASE_URL', 'JAWSDB_URL', 'CLEARDB_DATABASE_URL'] as $name) {
    $raw = $envValue($name);
    if ($raw !== '' && ($parts = parse_url($raw)) !== false && !empty($parts['host'])) {
        $url = [
            'host' => $parts['host'],
            'port' => (string) ($parts['port'] ?? 3306),
            'name' => ltrim($parts['path'] ?? '', '/'),
            'user' => urldecode($parts['user'] ?? ''),
            'pass' => urldecode($parts['pass'] ?? ''),
        ];
        break;
    }
}

$resolve = static function (array $envNames, string $key, string $default) use ($envValue, $url, $local): string {
    if (($url[$key] ?? '') !== '') {
        return $url[$key];
    }
    foreach ($envNames as $name) {
        $value = $envValue($name);
        if ($value !== '') {
            return $value;
        }
    }
    return (string) ($local[$key] ?? $default);
};

define('DB_HOST', $resolve(['DB_HOST', 'MYSQLHOST', 'MYSQL_HOST'],         'host', '127.0.0.1'));
define('DB_PORT', $resolve(['DB_PORT', 'MYSQLPORT', 'MYSQL_PORT'],         'port', '3306'));
define('DB_NAME', $resolve(['DB_NAME', 'MYSQLDATABASE', 'MYSQL_DATABASE'], 'name', 'peace_atomation'));
define('DB_USER', $resolve(['DB_USER', 'MYSQLUSER', 'MYSQL_USER'],         'user', 'root'));
define('DB_PASS', $resolve(['DB_PASS', 'MYSQLPASSWORD', 'MYSQL_PASSWORD'], 'pass', ''));
define('DB_CHARSET', 'utf8mb4');

/**
 * Returns a shared PDO instance. Connection errors are logged, never
 * echoed to the browser (avoids leaking credentials/schema to visitors).
 */
function get_db_connection(): PDO
{
    static $pdo = null;

    if ($pdo instanceof PDO) {
        return $pdo;
    }

    $dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;

    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, DB_USER, DB_PASS, $options);
        return $pdo;
    } catch (PDOException $e) {
        error_log('Database connection failed: ' . $e->getMessage());
        http_response_code(500);
        die('Service temporarily unavailable. Please try again later.');
    }
}
