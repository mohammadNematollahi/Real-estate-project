<?php

return[
    "CREATE TABLE `posts` (
        `id` INT PRIMARY KEY AUTO_INCREMENT,
        `title` varchar(191) NOT NULL,
        `body` text NOT NULL,
        `image` text NOT NULL,
        `user_id` bigint(20) NOT NULL,
        `cat_id` int(10) NOT NULL,
        `published_at` datetime NOT NULL,
        `status` tinyint(5) NOT NULL DEFAULT '0',
        `created_at` datetime NOT NULL,
        `updated_at` datetime DEFAULT NULL,
        `deleted_at` datetime DEFAULT NULL
      );"
];