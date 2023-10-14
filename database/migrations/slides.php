<?php

return[
    "CREATE TABLE `slides` (
        `id` bigint NOT NULL AUTO_INCREMENT,
        `title` varchar(191) NOT NULL,
        `url` varchar(250) NOT NULL,
        `address` varchar(191) NOT NULL,
        `amount` int NOT NULL,
        `description` text NOT NULL,
        `image` text NOT NULL,
        `created_at` datetime NOT NULL,
        `updated_at` datetime NULL,
        `deleted_at` datetime NULL,
        primary key(`id`)
    );"
];