<?php

return [
    "CREATE TABLE `users` (
          `id` bigint AUTO_INCREMENT,
          `email` varchar(191) NOT NULL,
          `first_name` varchar(191) NOT NULL,
          `last_name` varchar(191) NOT NULL,
          `avatar` varchar(191) NULL,
          `password` varchar(191) NOT NULL,
          `status` tinyint(5) NOT NULL DEFAULT '0',
          `is_active` tinyint(5) NOT NULL DEFAULT '0',
          `verify_token` varchar(191) NULL,
          `user_type` varchar(191) DEFAULT 'user',
          `remember_token` varchar(191) NULL,
          `remember_token_expire` datetime NULL,
          `created_at` datetime NOT NULL,
          `updated_at` datetime NULL,
          `deleted_at` datetime NULL,
          primary key(`id`)
      );"
];
