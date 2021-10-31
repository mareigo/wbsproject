<?php
declare(strict_types=1);

function session(string $key = null, $value = null)
{
    if (session_status() !== PHP_SESSION_ACTIVE) {
        trigger_error('Sie müssen session_start() aufrufen bevor Sie das Session Modul benutzen können.');
    }

    if (func_num_args() === 0) {
        return $_SESSION;
    }

    if (func_num_args() === 1) {
        return $_SESSION[$key] ?? null;
    }

    if ($value === null) {
        unset($_SESSION[$key]);
    
    } else {
        $_SESSION[$key] = $value;
    }
}
