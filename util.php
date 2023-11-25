<?php
error_reporting(E_ALL);
ini_set('display_errors',1);

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
    $conn = new mysqli("localhost", "loosap", "", "adatok");
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

    switch ($db_color) {
        case 'piros':
            return '#e89292';
        case 'zold':
            return '#b3f092';
        case 'sarga':
            return '#f0d492';
        case 'kek':
            return '#5f9ef5';
        case 'fekete':
            return '#3b3b3b';
        case 'feher':
            return '#f7f7f7';
        default:
            return '#ffffff';
    }
}

