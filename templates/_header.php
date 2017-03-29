<!doctype html>
<html lang="en">
<head>
    <style>
        @import 'css/style.css';
    </style>
    <title>MGW</title>
</head>

<body>

<!-- login header -->
<header>
    <!-- nav -->
    <nav>
        <nav>
            <ul>
                <li>
                    <a href="/">home</a>
                </li>
                <li>
                    <a href="/index.php?action=about">about</a>
                </li>
            </ul>

        </nav>
    </nav>

    <!-- login / logout -->
    <section>
        <?php
        //----------------------------
        if($isLoggedIn):
            //----------------------------
            ?>
            <a href="/index.php?action=cart">Shopping Cart</a>
            <br>
            you are logged in as: <strong><?= $username ?></strong>
            <br>
            <a href="/index.php?action=logout">(logout)</a>
            <?php
        //----------------------------
        else:
            //----------------------------
            ?>
            <a href="/index.php?action=cart">Shopping Cart</a>
            <br>
            <a href="/index.php?action=login">login</a>
            <?php
            //----------------------------
        endif;
        //----------------------------
        ?>
    </section>
</header>