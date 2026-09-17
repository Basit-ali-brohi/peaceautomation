<?php
/**
 * Local development database settings.
 *
 * Copy this file to config/db.local.php and fill in your own values.
 * db.local.php is gitignored, and config/db.php reads it whenever no
 * DB_* environment variables are present.
 */

declare(strict_types=1);

return [
    'host' => '127.0.0.1',
    'port' => '3306',   // XAMPP installs sometimes use 3307
    'name' => 'peace_atomation',
    'user' => 'root',
    'pass' => '',
];
