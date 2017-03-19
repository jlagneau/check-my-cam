<?php
// ************************************************************************** //
//                                                                            //
//                                                        :::      ::::::::   //
//   autoload.php                                       :+:      :+:    :+:   //
//                                                    +:+ +:+         +:+     //
//   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        //
//                                                +#+#+#+#+#+   +#+           //
//   Created: 2017/03/19 05:57:10 by jlagneau          #+#    #+#             //
//   Updated: 2017/03/19 05:57:15 by jlagneau         ###   ########.fr       //
//                                                                            //
// ************************************************************************** //

spl_autoload_register(function ($class) {

    // project-specific namespace prefix
    $prefix = 'Camagru\\';

    // base directory for the namespace prefix
    $base_dir = __DIR__.DIRECTORY_SEPARATOR.'..'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR;

    // does the class use the namespace prefix?
    $len = strlen($prefix);

    // get the relative class name
    $relative_class = substr($class, $len);

    // replace the namespace prefix with the base directory, replace namespace
    // separators with directory separators in the relative class name, append
    // with .php
    $file = $base_dir.str_replace('\\', '/', $relative_class).'.php';

    // if the file exists, require it
    if (file_exists($file)) {
        require $file;
    }
});
