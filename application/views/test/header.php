<!DOCTYPE html>
<html>
<head>
    <title>User : <?php echo isset($user_id) ? $$user_name : 'Guest'; ?></title>
</head>

<body>
    <ul>
        <li><a href= <?php echo site_url() . 'test/'; ?> >Home</a></li>
        <li><a href= <?php echo site_url() . 'test/acara'; ?> >Acara</a></li>
        <li><a href= <?php echo site_url() . 'test/lomba'; ?> >Lomba</a></li>
        <li><a href= <?php echo site_url() . 'test/tentangkami'; ?> >Tentang Kami</a></li>
    </ul>

    <?php 
    if (isset($user_id)) 
    {
        echo '<a href="test/profile">' . $user_name . '</a>';
        echo '<a href="test/logout">LOGOUT</a>';
    }
    else
    {
        echo '<a href="test/login">LOGIN</a>';
        echo '<a href="test/register">REGISTER</a>';
    }
    ?>
