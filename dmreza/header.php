<?php
    // Ukljucuje se sesija - PRVA LINIJA KODA
    session_start();

    $loggedin = false;
    $user = "Guest";
    if(isset($_SESSION['username']))
    {
        $loggedin = true;
        $id = $_SESSION['id']; // $id - id logovanog korisnika
        $user = $_SESSION['username']; // $user - username logovanog korisnika
    }

    require_once "functions.php";
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <img src="social-networking.jpg" alt="Drustvena mreza">
        <ul class="menu">
            <?php if($loggedin) { ?>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="members.php">Members</a>
                </li>
                <li>
                    <a href="friends.php">Friends</a>
                </li>
                <li>
                    <a href="messages.php">Messages</a>
                </li>
                <li>
                    <a href="profile.php">Edit profile</a>
                </li>
                <li>
                    <a href="logout.php">Logout</a>
                </li>
            <?php } else { ?>
                <li>
                    <a href="index.php">Home</a>
                </li>
                <li>
                    <a href="signup.php">Sign up</a>
                </li>
                <li>
                    <a href="login.php">Log in</a>
                </li>
            <?php } ?>
        </ul>