<?php

return [
    "CREATE TABLE `comments` (
        `id` bigint NOT NULL AUTO_INCREMENT,
        `user_id` bigint NOT NULL,
        `post_id` bigint NOT NULL,
        `comment` text NOT NULL,
        `parent_id` bigint NULL,
        `status` int NOT NULL DEFAULT '0',
        `approved` int NOT NULL DEFAULT '0',
        `created_at` datetime NOT NULL,
        `updated_at` datetime NULL,
        `deleted_at` datetime NULL,
        primary key(`id`)
    );"
];