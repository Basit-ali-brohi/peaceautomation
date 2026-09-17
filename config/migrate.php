<?php
/**
 * Applies sql/schema.sql to the configured database.
 *
 * Run from the container entrypoint on every boot. Every statement in the
 * schema is CREATE ... IF NOT EXISTS, so running it repeatedly is safe and
 * never touches existing rows.
 *
 * A managed database often is not reachable the instant the app container
 * starts, so the connection is retried for a short while before giving up.
 * Giving up is not fatal: the site still boots, and the pages that need the
 * database degrade on their own.
 *
 * Usage: php config/migrate.php
 */

declare(strict_types=1);

require_once __DIR__ . '/db.php';

const MIGRATE_ATTEMPTS   = 10;
const MIGRATE_WAIT_SECS  = 3;

function migrate_log(string $message): void
{
    fwrite(STDOUT, 'migrate: ' . $message . "\n");
}

$schemaFile = __DIR__ . '/../sql/schema.sql';
if (!is_file($schemaFile)) {
    migrate_log('sql/schema.sql not found — nothing to apply');
    exit(0);
}

/* ---- connect, with retries -------------------------------------------- */

$dsn = 'mysql:host=' . DB_HOST . ';port=' . DB_PORT . ';dbname=' . DB_NAME . ';charset=' . DB_CHARSET;
$db  = null;

for ($attempt = 1; $attempt <= MIGRATE_ATTEMPTS; $attempt++) {
    try {
        $db = new PDO($dsn, DB_USER, DB_PASS, [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
            PDO::ATTR_TIMEOUT            => 5,
        ]);
        break;
    } catch (PDOException $e) {
        migrate_log(sprintf(
            'database not ready (attempt %d/%d): %s',
            $attempt,
            MIGRATE_ATTEMPTS,
            $e->getMessage()
        ));
        if ($attempt < MIGRATE_ATTEMPTS) {
            sleep(MIGRATE_WAIT_SECS);
        }
    }
}

if (!$db instanceof PDO) {
    migrate_log('giving up on the database — the site will start without it');
    exit(0);
}

/* ---- apply the schema -------------------------------------------------- */

$sql = (string) file_get_contents($schemaFile);

// Comments are stripped before splitting — a leading "-- …" line would
// otherwise swallow the CREATE TABLE that follows it.
$sql = preg_replace('/^\s*--.*$/m', '', $sql) ?? $sql;
$sql = preg_replace('#/\*.*?\*/#s', '', $sql) ?? $sql;

// The managed database already exists and is named by the platform, so the
// CREATE DATABASE / USE lines from the local schema are dropped here.
$sql = preg_replace('/^\s*(CREATE\s+DATABASE|USE)\b[^;]*;/mi', '', $sql) ?? $sql;

$statements = array_filter(
    array_map('trim', explode(';', $sql)),
    static fn(string $s): bool => $s !== ''
);

$applied = 0;
foreach ($statements as $statement) {
    try {
        $db->exec($statement);
        $applied++;
    } catch (PDOException $e) {
        migrate_log('statement failed — ' . $e->getMessage());
    }
}

$tables = $db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
migrate_log($applied . ' statement(s) applied; tables: ' . implode(', ', $tables));
