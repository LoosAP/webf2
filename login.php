<?php
require 'password.php';
require 'util.php';

if (!is_post()) {
    json_response('Invalid request method');
}

if (!array_key_exists('username', $_POST) || !array_key_exists('password', $_POST)) {
    json_response('Missing username or password');
}

session_start();

$username = $_POST['username'];
$password = $_POST['password'];

$users = get_users();
if (!array_key_exists($username, $users)) {
    $_SESSION['login'] = false;
    redirect('/index.php');
}

if (!hash_equals($users[$username], $password)) {
    $_SESSION['login'] = false;
    $_SESSION['fail'] = true;
    redirect('/index.php');
}

$color = color_data(favourite_color($username));

$_SESSION['login'] = true;
$_SESSION['color'] = $color;
$_SESSION['username'] = $username;


redirect('/index.php');
