<?php
$filepath = realpath(dirname(__FILE__));
include_once $filepath . '/../lib/Session.php';
Session::init();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Enter your description here" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Login|Register</title>
</head>
<?php
if (isset($_GET['action']) && $_GET['action'] == "logout") {
    Session::destroy();
}
?>

<body>
    <section class="header-section">
        <nav class="navbar navbar-expand-lg navbar-light">
            <div class="container">
                <a class="navbar-brand" href="index.php">Login Register System With PHP </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav ml-auto">

                        <?php
                        $id = Session::get("id");
                        $userlogin = Session::get("login");
                        if ($userlogin == true) { ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="?action=index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="profile.php?id=<?php echo $id ?>">Profile</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="?action=logout">Logout</a>
                            </li>
                        <?php } else { ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="?action=index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="register.php">Register</a>
                            </li>

                        <?php } ?>



                    </ul>
                </div>
            </div>
        </nav>
    </section>