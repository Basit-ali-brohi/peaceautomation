<?php
/**
 * Single source of truth for brand, contact, services, and package data.
 * Every page reads from here via site('key') — change a value once and it
 * updates across the whole site.
 *
 * Values marked TODO are awaiting the client's real details.
 */

declare(strict_types=1);

return [
    'name'    => 'Peace Automation',
    'tagline' => 'Watching over what matters most',

    // --- Contact ---------------------------------------------------------
    'phone'         => '+92 21 000 0000',        // TODO: real landline
    'phone_href'    => '+92210000000',           // TODO: digits only, for tel:
    'mobile'        => '+92 3XX XXXXXXX',        // TODO: real mobile
    'mobile_href'   => '+923000000000',          // TODO: digits only
    'whatsapp'      => '923000000000',           // TODO: country code + number, no +
    'whatsapp_msg'  => 'Hi, I would like to book a free site survey.',
    'email'         => 'support@peaceautomation.com',
    'address'       => 'Office #605, 6th Floor, Al-Aiza Center, Gulshan-e-Iqbal, Karachi, Pakistan',
    'hours'         => 'Mon–Sat, 10am–8pm',

    'social' => [
        'facebook'  => '#',   // TODO
        'instagram' => '#',   // TODO
        'youtube'   => '#',   // TODO
        'linkedin'  => '#',   // TODO
    ],

    // Full YouTube URL for the homepage video lightbox
    'video_url' => '',        // TODO: e.g. https://www.youtube.com/embed/XXXXXXXXXXX

    // --- Headline stats (shown in hero + counters) -----------------------
    'stats' => [
        ['target' => 2400, 'suffix' => '+',   'label' => 'Cameras installed'],   // TODO: confirm
        ['target' => 18,   'suffix' => '',    'label' => 'Years on the job'],    // TODO: confirm
        ['target' => 24,   'suffix' => '/7',  'label' => 'Support'],
    ],

    // --- Services (used by mega menu, accordion, cards, footer) ----------
    'services' => [
        [
            'slug'  => 'cctv-camera-installation',
            'title' => 'CCTV Camera Installation',
            'icon'  => 'fa-video',
            'desc'  => 'Survey, placement, cabling and full setup.',
            'image' => 'assets/img/services/cctv-residential.jpg',
            'subs'  => ['Site survey & camera placement', 'Cable routing & concealment', 'DVR/NVR configuration', 'Mobile app setup'],
        ],
        [
            'slug'  => 'ip-network-camera-systems',
            'title' => 'IP & Network Camera Systems',
            'icon'  => 'fa-network-wired',
            'desc'  => 'High-resolution IP cameras on your own network.',
            'image' => 'assets/img/services/cctv-products.jpg',
            'subs'  => ['PoE switch setup', 'Static IP & VLAN config', '4K & motorised lenses', 'Remote NVR access'],
        ],
        [
            'slug'  => 'dvr-nvr-setup',
            'title' => 'DVR / NVR Setup & Configuration',
            'icon'  => 'fa-hard-drive',
            'desc'  => 'Recording, storage and retention configured properly.',
            'image' => 'assets/img/case-studies/corporate-cctv.jpg',
            'subs'  => ['Storage sizing & RAID', 'Motion-based recording', 'Retention scheduling', 'Disk health alerts'],
        ],
        [
            'slug'  => 'remote-mobile-monitoring',
            'title' => 'Remote Mobile Monitoring',
            'icon'  => 'fa-mobile-screen',
            'desc'  => 'Watch every camera from your phone, anywhere.',
            'image' => 'assets/img/services/smart-surveillance-banner.jpg',
            'subs'  => ['iOS & Android app setup', 'Multi-site accounts', 'Push notifications', 'Bandwidth tuning'],
        ],
        [
            'slug'  => 'access-control-biometric',
            'title' => 'Access Control & Biometric Systems',
            'icon'  => 'fa-fingerprint',
            'desc'  => 'Fingerprint, card and face-based entry control.',
            'image' => 'assets/img/services/access-control-lobby.jpg',
            'subs'  => ['Fingerprint & face readers', 'Card & PIN access', 'Electric locks & readers', 'Attendance reports'],
        ],
        [
            'slug'  => 'video-door-phone',
            'title' => 'Video Door Phone / Intercom',
            'icon'  => 'fa-door-open',
            'desc'  => 'See and speak to whoever is at your gate.',
            'image' => 'assets/img/general/facility-entrance.jpg',
            'subs'  => ['Indoor & outdoor units', 'Multi-apartment wiring', 'Night-vision panels', 'Mobile call forwarding'],
        ],
        [
            'slug'  => 'alarm-sensor-fire-detection',
            'title' => 'Alarm, Sensor & Fire Detection',
            'icon'  => 'fa-bell',
            'desc'  => 'Intrusion, smoke and fire detection that alerts fast.',
            'image' => 'assets/img/case-studies/fire-safety-upgrade.jpg',
            'subs'  => ['Motion & door sensors', 'Smoke & heat detectors', 'Siren & strobe', 'Central alarm panel'],
        ],
        [
            'slug'  => 'amc-repair',
            'title' => 'Annual Maintenance (AMC) & Repair',
            'icon'  => 'fa-screwdriver-wrench',
            'desc'  => 'Scheduled servicing and fast fault response.',
            'image' => 'assets/img/case-studies/time-attendance.jpg',
            'subs'  => ['Scheduled cleaning & checks', 'Same-day fault response', 'Firmware updates', 'Spare parts in stock'],
        ],
    ],

    // --- Brands carried (logo strip) -------------------------------------
    'brands' => ['Hikvision', 'Dahua', 'CP Plus', 'Uniview', 'TP-Link', 'Ezviz', 'Ajax', 'Honeywell'],

    // --- Packages ---------------------------------------------------------
    'packages' => [
        [
            'name'     => 'Home Basic',
            'cameras'  => '4 cameras',
            'price'    => 'PKR 00,000',   // TODO: real price
            'popular'  => false,
            'includes' => ['4 × HD cameras', 'DVR + 1TB storage', 'Cabling & installation', 'Mobile app setup', '1-year warranty'],
        ],
        [
            'name'     => 'Shop / Office',
            'cameras'  => '8 cameras',
            'price'    => 'PKR 00,000',   // TODO: real price
            'popular'  => true,
            'includes' => ['8 × HD/IP cameras', 'NVR + 2TB storage', 'Concealed cabling', 'Remote mobile access', 'Night vision', '1-year warranty'],
        ],
        [
            'name'     => 'Commercial',
            'cameras'  => '16+ cameras',
            'price'    => 'PKR 000,000',  // TODO: real price
            'popular'  => false,
            'includes' => ['16+ IP cameras', 'NVR + 4TB+ storage', 'PoE network setup', 'Access control ready', 'Annual maintenance (AMC)', '2-year warranty'],
        ],
    ],
];
