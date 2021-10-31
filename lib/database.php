<?php
declare(strict_types=1);

function db_connect(array $config) : mysqli
{
    $db = mysqli_connect(
        $config['host'],
        $config['username'],
        $config['password'],
        $config['database'],
        $config['port'] ?? 3306
    );

    if (mysqli_connect_errno()) {
        trigger_error("DB Error: " . mysqli_connect_error(), E_USER_ERROR);
    }

    mysqli_set_charset($db, $config['charset'] ?? 'utf8mb4');

    return $db;
}

function db_get_global($fatal = true)
{
    global $database;

    if ($fatal && (!isset($database) || !$database instanceof mysqli)) {
        trigger_error('The database-module requires a globally defined variable called $database that holds a MySQL/MariaDB connection (mysqli-Object). You can use db_connect() to establish this connection.', E_USER_ERROR);
    }

    return $database;
}

function db_disconnect()
{
    $db = db_get_global(false);

    if ($db instanceof mysqli) {
        return mysqli_close($db);
    }
}

function db_query(string $sql, $fatal = true)
{
    $db = db_get_global();

    $result = mysqli_query($db, $sql);

    if ($fatal && mysqli_errno($db)) {
        trigger_error(
            'DB ERROR ' . mysqli_errno($db) .
            ': ' . mysqli_error($db), E_USER_ERROR
        );
    }

    return $result;
}

function db_delete(string $table, $ids) : bool
{
    $ids = (array) $ids;

    $count = count($ids);
    for ($i = 0; $i < $count; $i++) {
        $ids[$i] = (int) $ids[$i];
    }

    $ids = implode(', ', $ids);

    $sql = "DELETE FROM `$table` WHERE `id` IN ($ids)";

    return db_query($sql);
}

function db_prepare($value) : string
{
    if (is_bool($value)) {
        return $value ? '1' : '0';
    }

    if ($value === 'NULL' || $value === 'null' || $value === null) {
        return 'NULL';
    }

    if (is_string($value)) {
        return "'" . mysqli_escape_string(db_get_global(), $value) . "'";
    }

    return (string) $value;
}

function db_insert(string $table, array $data)
{
    $columns = [];
    $values = [];

    foreach ($data as $column => $value) {
        $columns[] = "`$column`";
        $values[] = db_prepare($value);
    }

    $columns = implode(', ', $columns);
    $values = implode(', ', $values);

    $sql = "INSERT INTO `$table` ($columns) VALUES ($values)";

    $success = db_query($sql);

    if ($success) {
        return mysqli_insert_id(db_get_global());
    }

    return false;
}

function db_update(string $table, int $id, array $data) : bool
{
    $pairs = [];

    foreach ($data as $column => $value) {
        $pairs[] = "`$column` = " . db_prepare($value);
    }

    $pairs = implode(', ', $pairs);

    $sql = "UPDATE `$table` SET $pairs WHERE `id` = $id";

    return db_query($sql);
}

function db_raw_select(string $sql)
{
    $result = db_query($sql);

    $data = mysqli_fetch_all($result, MYSQLI_ASSOC);

    mysqli_free_result($result);

    return $data;
}


function db_raw_first(string $sql)
{
    $result = db_query($sql);

    $data = mysqli_fetch_assoc($result);

    mysqli_free_result($result);

    return $data;
}
