--****************************************************************************--
--                                                                            --
--                                                        :::      ::::::::   --
--   schema.sql                                         :+:      :+:    :+:   --
--                                                    +:+ +:+         +:+     --
--   By: jlagneau <jlagneau@student.42.fr>          +#+  +:+       +#+        --
--                                                +#+#+#+#+#+   +#+           --
--   Created: 2017/03/19 05:56:13 by jlagneau          #+#    #+#             --
--   Updated: 2017/03/19 05:56:17 by jlagneau         ###   ########.fr       --
--                                                                            --
--****************************************************************************--

DROP TABLE IF EXISTS `camagru_user`;
CREATE TABLE `camagru_user` (
  `id`        INTEGER PRIMARY KEY AUTOINCREMENT,
  `username`  CHAR(50)  NOT NULL UNIQUE,
  `email`     CHAR(50)  NOT NULL UNIQUE,
  `password`  CHAR(128) NOT NULL,
  `hash`      CHAR(128) NOT NULL UNIQUE,
  `active`    INT(1)    NOT NULL
);

DROP TABLE IF EXISTS `camagru_picture`;
CREATE TABLE `camagru_picture` (
  `id`        INTEGER PRIMARY KEY AUTOINCREMENT,
  `userId`    INT(11)   NOT NULL,
  `path`      CHAR(50)  NOT NULL UNIQUE,
  `realPath`  CHAR(255) NOT NULL UNIQUE,
  `likes`     INT(11)   NOT NULL
);

DROP TABLE IF EXISTS `camagru_user_like`;
CREATE TABLE `camagru_user_like` (
  `id`        INTEGER PRIMARY KEY AUTOINCREMENT,
  `userId`    INT(11)   NOT NULL,
  `pictureId` INT(11)   NOT NULL
);

DROP TABLE IF EXISTS `camagru_comment`;
CREATE TABLE `camagru_comment` (
  `id`        INTEGER PRIMARY KEY AUTOINCREMENT,
  `userId`    INT(11)   NOT NULL,
  `pictureId` INT(11)   NOT NULL,
  `content`   TEXT      NOT NULL
);
