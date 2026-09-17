<?php
/**
 * Database configuration & PDO connection.
 *
 * Copy this file to db.php on each environment and fill in the real
 * credentials. db.php is gitignored so passwords never reach the repo.
 */

declare(strict_types=1);

const DB_HOST = '127.0.0.1';
const DB_PORT = '3306';          // XAMPP installs sometimes use 3307
const DB_NAME = 'peace_atomation';
const DB_USER = 'root';
const DB_PASS = '';
const DB_CHARSET = 'utf8mb4';

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
