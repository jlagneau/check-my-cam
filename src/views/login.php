<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   login.php                                          :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:59:47 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 06:00:02 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //
?>
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
