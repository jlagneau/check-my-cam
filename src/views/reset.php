<main>
    <h2>Reset your password</h2>
    <p>
        password must have uppercase and lowercase letter(s), digit(s) and special char(s).
    </p>
    <form action="/reset?key=<?php echo $_GET['key'] ?>" method="POST">
        <label for="password">Password: </label>
        <input type="password" name="password" minlength="3" maxlength="50" required
            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+"
            title="Your password must contain at lease an uppercase letter, a lower case letter, a digit and a special character" /><br />
        <input type="submit" value="Login" />
    </form>
</main>
