<?php
declare(strict_types=1);

require_once 'session.php';


function login(array $user)
{
    session('_user', $user);
}


function logout()
{
    session('_user', null);
}


function auth_user($key = null)
{
    if ($key === null) {
        return session('_user');
    }
    
    return session('_user')[$key] ?? null;
}


function auth_id()
{
    return ($id = auth_user('id')) ? (int) $id : null;
}
