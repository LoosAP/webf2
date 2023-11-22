<?php
session_start();


if (isset($_SESSION['fail']) && $_SESSION['fail']) {
    echo "Hibás felhasználónév vagy jelszó!";
    header("refresh:3;url=https://www.police.hu/");
    $_SESSION['fail'] = false;
}



$background_color = '';
if (isset($_SESSION['color'])) {
    $background_color = ' background-color: ' . $_SESSION['color'] . ';';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bejelentkezés</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body style="<?= $background_color ?>">
    <div class="container py-5">
        <h1 class="text-center mb-4">Bejelentkezési form</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <form action="login.php" method="post">
                            <?php
                            if (key_exists('login', $_SESSION)) {
                                if ($_SESSION['login']) {
                                    echo '<div class="alert alert-success" role="alert">Üdv újra, ' . $_SESSION['username'] . '!</div>';
                                } else {
                                    echo '<div class="alert alert-danger" role="alert">Sikertelen bejelentkezés!</div>';
                                }
                            }

                            if (!isset($_SESSION['color'])) {
                                echo ('
                                <div class="form-group">
                                    <label for="username">Email</label>
                                    <input name="username" type="email" class="form-control" id="username" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input name="password" type="password" class="form-control" id="password" placeholder="Password">
                                </div>
                                <button type="submit" class="btn btn-primary btn-block">Bejelentkezés</button>
                                </form>
                                ');
                            } else {
                                echo ('</form>
                                    <a href="redirect.php" class="btn btn-primary btn-block">Vissza</a>
                                ');
                            }
                            ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>