<!DOCTYPE html>
<html>
<head>
    <title>User : <?php echo isset($_SERVER['user_id']) ? $_SERVER['user_name'] : 'Guest'; ?></title>
</head>

<body>
    <ul>
        <li><a href='<?php echo site_url('test/'); ?>'>Home</a></li>
        <li><a href='<?php echo site_url('test/view/acara/'); ?>'>Acara</a></li>
        <li><a href='<?php echo site_url('test/view/lomba/'); ?>'>Lomba</a></li>
        <li><a href='<?php echo site_url('test/view/about/'); ?>'>Tentang Kami</a></li>
    </ul>

    <?php 
    if (isset($_SERVER['user_id'])) 
    {
        echo '<a href="test/profile">' . $_SERVER['user_name'] . '</a>';
        echo '<a href="test/logout">LOGOUT</a>';
    }
    else
    {
        echo '<a href="test/login">LOGIN</a>';
        echo '<a href="test/register">REGISTER</a>';
    }
    ?>

    <br>
