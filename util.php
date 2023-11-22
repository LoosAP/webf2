<?php

function is_post(): bool
{
    return strtoupper($_SERVER['REQUEST_METHOD']) == 'POST';
}
function json_response(string $message, int $code = 400): void
{
    http_response_code($code);
    echo json_encode(array('status' => $code, 'message' => $message));
    exit($code);
}

function redirect(string $path): void
{
    header('Location: ' . $path);
    exit();
}

function favourite_color(string $username): string
{
    $conn = mysqli_connect("localhost", "root", "", "adatok");
    $statement = $conn->prepare("SELECT `Titkos` FROM `tabla` WHERE `Username` = ?");
    $statement->bind_param("s", $username);
    $statement->execute();
    $statement->bind_result($result_data);
    $statement->fetch();
    $conn->close();
    return $result_data;
}

function color_data(string $db_color): string
{
    return match ($db_color) {
        'piros' => '#e89292',
        'zold' => '#b3f092',
        'sarga' => '#f0d492',
        'kek' => '#5f9ef5',
        'fekete' => '#3b3b3b',
        'feher' => '#f7f7f7',
        default => '#ffffff',
    };
}
