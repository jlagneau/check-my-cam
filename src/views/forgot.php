<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   forgot.php                                         :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:58:41 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:58:50 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //
?>
<main>
    <h2>Forgot your password ?</h2>
    <form action="/forgot" method="POST">
        <label for="username">Username: </label>
        <input type="text" name="username" minlength="3" maxlength="50" required/><br />
    </form>
</main>
