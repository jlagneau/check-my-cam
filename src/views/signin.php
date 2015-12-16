<main>
    <h2>Sign in !</h2>
    <p>
        password must have uppercase and lowercase letter(s), digit(s) and special char(s).
    </p>
    <form action="/signin" method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" minlength="3" maxlength="50" required/><br />
        <label for="email">Email: </label>
        <input type="text" type="email" name="email" minlength="3" maxlength="50" required /><br />
        <label for="password">Password: </label>
        <input type="password" name="password" minlength="3" maxlength="50" required
            pattern="(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+"
            title="Your password must contain at lease an uppercase letter, a lower case letter, a digit and a special character" /><br />
        <input type="submit" value="Sign in" />
    </form>
</main>
