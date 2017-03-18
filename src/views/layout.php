<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="robots" content="noindex, nofollow">
        <title>Camagru</title>
        <link href="https://fonts.googleapis.com/css?family=Roboto:400,700" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="/styles/main.css">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    <body>
        <header>
            <h1 class="left">Camagru</h1>
            <ul class="right">
                <li><a <?php echo in_array($action, ['home', 'show']) ? 'class="active"' : '' ?> href="/">Home</a></li>
                <?php if (isset($_SESSION['login']) && $_SESSION['login'] != '') : ?>
                <li><a <?php echo in_array($action, ['account', 'newPicture']) ? 'class="active"' : '' ?>href="/account">Account</a></li>
                <li><a href="/logout">Logout</a></li>
                <?php else : ?>
                <li><a <?php echo $action === 'signin' ? 'class="active"' : '' ?>href="/signin">Sign in</a></li>
                <li><a <?php echo $action === 'login' ? 'class="active"' : '' ?>href="/login">Login</a></li>
                <?php endif ?>
            </ul>
        </header>

        <?php if (isset($_SESSION) && isset($_SESSION['flash'])) : ?>
        <div id="flash">
            <p class="<?php echo $_SESSION['flash']['type'] ?>">
                <strong><?php echo ucfirst($_SESSION['flash']['type']) ?>:</strong>
                <?php echo $_SESSION['flash']['message']; ?>
            </p>
        </div>
        <?php endif; ?>

        <div id="wrapper">
        <?php echo $content ?>
        </div>

        <footer>
            <p>&copy; Camagru - 42</p>
        </footer>
    </body>
</html>
