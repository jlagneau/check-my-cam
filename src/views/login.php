<main>
    <h2>Login !</h2>
    <form action="/login" method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" minlength="3" maxlength="50" required/><br />
        <label for="password">Password: </label>
        <input type="password" name="password" minlength="3" maxlength="50" required /><br />
        <input type="submit" value="Login" />
    </form>
    <a href="/forgot">Forgot your password ?</a>
</main>
