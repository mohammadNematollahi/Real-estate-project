<?php

return [
    "CREATE TABLE `ads` (
  `id` int NOT NULL auto_increment,
  `title` varchar(191) NOT NULL,
  `description` text NOT NULL,
  `address` text NOT NULL,
  `amount` varchar(191) NOT NULL,
  `image` varchar(191) NOT NULL,
  `floor` varchar(191) NOT NULL,
  `year` int NOT NULL,
  `storeroom` int NOT NULL,
  `balcony` int NOT NULL,
  `area` int NOT NULL,
  `room` int NOT NULL,
  `toilet` enum('ایرانی','فرنگی','ایرانی و فرنگی','') NOT NULL,
  `parking` int NOT NULL,
  `tag` varchar(191) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `cat_id` bigint(20) NOT NULL,
  `status` int NOT NULL,
  `sell_status` int NOT NULL,
  `type` int NOT NULL,
  `view` int NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NULL,
  `deleted_at` datetime NULL,
  primary key(`id`)
  );"
];
