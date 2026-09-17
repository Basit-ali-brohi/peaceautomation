<?php
/**
 * Applies sql/schema.sql to the configured database.
 *
 * Run from the container entrypoint on every boot. Every statement in the
 * schema is CREATE ... IF NOT EXISTS, so running it repeatedly is safe and
 * never touches existing rows.
 *
 * Usage: php config/migrate.php
 */

declare(strict_types=1);

require_once __DIR__ . '/db.php';

$schemaFile = __DIR__ . '/../sql/schema.sql';
if (!is_file($schemaFile)) {
    fwrite(STDERR, "migrate: sql/schema.sql not found\n");
    exit(1);
}

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

try {
    $db = get_db_connection();
} catch (Throwable $e) {
    fwrite(STDERR, 'migrate: cannot connect — ' . $e->getMessage() . "\n");
    exit(1);
}

$applied = 0;
foreach ($statements as $statement) {
    try {
        $db->exec($statement);
        $applied++;
    } catch (PDOException $e) {
        fwrite(STDERR, 'migrate: statement failed — ' . $e->getMessage() . "\n");
    }
}

$tables = $db->query('SHOW TABLES')->fetchAll(PDO::FETCH_COLUMN);
fwrite(STDOUT, 'migrate: ' . $applied . ' statement(s) applied; tables: ' . implode(', ', $tables) . "\n");
