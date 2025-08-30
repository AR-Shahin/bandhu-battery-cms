CREATE TABLE `admins` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `admins_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO admins VALUES ('1', 'Super Admin', 'admin@mail.com', NULL, '$2y$12$vRjIyUUIq7fKXXaRfYPGdepIFj7Nl/LpsHZE7hGiI6AXA06EyeIl2', '1', NULL, '2024-04-28 15:53:16', '2024-04-28 15:53:16');
INSERT INTO admins VALUES ('2', 'Viewer', 'viewer@mail.com', NULL, '$2y$12$EgsKO8CqbbsyFMZq3suAxOonX77TcmbVb.PxkbwqGeODpxcIjeAXu', '1', NULL, '2024-04-28 15:53:16', '2024-04-28 15:53:16');
INSERT INTO admins VALUES ('3', 'Shahin', 'mdshahinmije96@gmail.com', NULL, '$2y$12$eI.Ry8CMdye3gBKEK0zvJOzHgb/SWrgeSvPlmcg7zQIG/gxAH7H8C', '1', NULL, '2024-04-28 15:53:17', '2024-04-28 15:53:17');

CREATE TABLE `brands` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '01754100439',
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `images` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int DEFAULT NULL,
  `imageable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imageable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `images_imageable_type_imageable_id_index` (`imageable_type`,`imageable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO migrations VALUES ('1', '0001_01_01_000000_create_users_table', '1');
INSERT INTO migrations VALUES ('2', '0001_01_01_000001_create_cache_table', '1');
INSERT INTO migrations VALUES ('3', '0001_01_01_000002_create_jobs_table', '1');
INSERT INTO migrations VALUES ('4', '2024_03_15_094043_create_admins_table', '1');
INSERT INTO migrations VALUES ('5', '2024_03_15_102545_create_permission_tables', '1');
INSERT INTO migrations VALUES ('6', '2024_03_16_095203_create_website_infos_table', '1');
INSERT INTO migrations VALUES ('7', '2024_04_22_143858_create_services_table', '1');
INSERT INTO migrations VALUES ('8', '2024_04_22_143909_create_single_contents_table', '1');
INSERT INTO migrations VALUES ('9', '2024_04_22_143931_create_images_table', '1');
INSERT INTO migrations VALUES ('10', '2024_04_22_143936_create_videos_table', '1');
INSERT INTO migrations VALUES ('11', '2024_04_22_144009_create_social_media_table', '1');
INSERT INTO migrations VALUES ('12', '2024_04_25_103526_create_contacts_table', '1');
INSERT INTO migrations VALUES ('13', '2024_04_26_172628_create_categories_table', '1');
INSERT INTO migrations VALUES ('14', '2024_04_26_172634_create_sub_categories_table', '1');
INSERT INTO migrations VALUES ('15', '2024_04_26_172644_create_brands_table', '1');
INSERT INTO migrations VALUES ('16', '2024_04_26_172649_create_products_table', '1');

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `model_has_roles` (
  `role_id` bigint unsigned NOT NULL,
  `model_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`),
  CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO model_has_roles VALUES ('1', 'App\\Models\\Admin', '1');
INSERT INTO model_has_roles VALUES ('3', 'App\\Models\\Admin', '2');
INSERT INTO model_has_roles VALUES ('1', 'App\\Models\\Admin', '3');

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO permissions VALUES ('1', 'admin-create', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('2', 'admin-view', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('3', 'admin-edit', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('4', 'admin-delete', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('5', 'role-create', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('6', 'role-view', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('7', 'role-delete', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('8', 'permission-create', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('9', 'permission-view', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('10', 'permission-update', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO permissions VALUES ('11', 'permission-delete', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');

CREATE TABLE `products` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `sub_category_id` bigint unsigned NOT NULL,
  `brand_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `image` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `short_des` mediumtext COLLATE utf8mb4_unicode_ci,
  `description` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_category_id_foreign` (`category_id`),
  KEY `products_sub_category_id_foreign` (`sub_category_id`),
  KEY `products_brand_id_foreign` (`brand_id`),
  CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `role_has_permissions_role_id_foreign` (`role_id`),
  CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO role_has_permissions VALUES ('1', '1');
INSERT INTO role_has_permissions VALUES ('2', '1');
INSERT INTO role_has_permissions VALUES ('3', '1');
INSERT INTO role_has_permissions VALUES ('4', '1');
INSERT INTO role_has_permissions VALUES ('5', '1');
INSERT INTO role_has_permissions VALUES ('6', '1');
INSERT INTO role_has_permissions VALUES ('7', '1');
INSERT INTO role_has_permissions VALUES ('8', '1');
INSERT INTO role_has_permissions VALUES ('9', '1');
INSERT INTO role_has_permissions VALUES ('10', '1');
INSERT INTO role_has_permissions VALUES ('11', '1');
INSERT INTO role_has_permissions VALUES ('2', '3');
INSERT INTO role_has_permissions VALUES ('6', '3');
INSERT INTO role_has_permissions VALUES ('9', '3');

CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `guard_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_guard_name_unique` (`name`,`guard_name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO roles VALUES ('1', 'Super Admin', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO roles VALUES ('2', 'Admin', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO roles VALUES ('3', 'Viewer', 'admin', '2024-04-28 15:53:17', '2024-04-28 15:53:17');

CREATE TABLE `services` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO services VALUES ('1', 'RAISE FUND FOR HEALTHY FOOD', 'raise-fund-for-healthy-food', '<i class=\"fal fa-bone\"></i>', '1', '1', 'Join our mission to provide nutritious meals to those in need. Your support helps us deliver fresh, healthy food to families and individuals facing food insecurity. By raising funds, you\'re not only ensuring access to wholesome meals but also promoting better health and well-being in our community. Every donation counts—together, we can make a significant impact in the fight against hunger and create a healthier future for everyone. Donate today and help us nourish our community with the food they deserve.', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO services VALUES ('2', 'EDUCATION FOR POOR CHILDREN', 'education-for-poor-children', '<i class=\"fal fa-graduation-cap\"></i>', '2', '1', 'Join our mission to provide nutritious meals to those in need. Your support helps us deliver fresh, healthy food to families and individuals facing food insecurity. By raising funds, you\'re not only ensuring access to wholesome meals but also promoting better health and well-being in our community. Every donation counts—together, we can make a significant impact in the fight against hunger and create a healthier future for everyone. Donate today and help us nourish our community with the food they deserve.', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO services VALUES ('3', 'PROMOTING THE RIGHTS OF CHILDREN', 'promoting-the-rights-of-children', '<i class=\"fal fa-child\"></i>', '3', '1', 'Join our mission to provide nutritious meals to those in need. Your support helps us deliver fresh, healthy food to families and individuals facing food insecurity. By raising funds, you\'re not only ensuring access to wholesome meals but also promoting better health and well-being in our community. Every donation counts—together, we can make a significant impact in the fight against hunger and create a healthier future for everyone. Donate today and help us nourish our community with the food they deserve.', '2024-04-28 15:53:17', '2024-04-28 15:53:17');
INSERT INTO services VALUES ('4', 'MASSIVE DONATION TO POOR', 'massive-donation-to-poor', '<i class=\"fal fa-box-heart\"></i>', '4', '1', 'Join our mission to provide nutritious meals to those in need. Your support helps us deliver fresh, healthy food to families and individuals facing food insecurity. By raising funds, you\'re not only ensuring access to wholesome meals but also promoting better health and well-being in our community. Every donation counts—together, we can make a significant impact in the fight against hunger and create a healthier future for everyone. Donate today and help us nourish our community with the food they deserve.', '2024-04-28 15:53:17', '2024-04-28 15:53:17');

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO sessions VALUES ('O8KXZzsM58mx9Rr69eZqV4Khbvcb9PInOqtQcuno', '1', '127.0.0.1', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/124.0.0.0 Safari/537.36', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiNU5Xcjl3RXBUWkxNZkh2UmVyemtGVVZadm9mY2RUNEJxWTc3Q3hkRCI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjM3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4vZGFzaGJvYXJkIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', '1714485943');

CREATE TABLE `single_contents` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `about` text COLLATE utf8mb4_unicode_ci,
  `mission` text COLLATE utf8mb4_unicode_ci,
  `vision` text COLLATE utf8mb4_unicode_ci,
  `goal` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO single_contents VALUES ('1', 'আমাদের লক্ষ্য হচ্ছে অসমাজিক নিরাপত্তাহীনতার বিরুদ্ধে লড়াই করা, যারা প্রয়োজন তাদের জন্য স্বাস্থ্যকর, পুষ্টিকর খাবার সরবরাহের মাধ্যমে। আমরা তাজা, উচ্চ-মানের খাবার সরবরাহ ও বিতরণ করার পাশাপাশি সুষম খাদ্যাভ্যাস এবং স্বাস্থ্যকর জীবনযাপন সম্পর্কে শিক্ষা প্রচারের মাধ্যমে পরিবার ও ব্যক্তিদের সমর্থনে প্রতিশ্রুতিবদ্ধ। সম্প্রদায়িক অংশীদারিত্ব ও দাতব্য অনুদানের মাধ্যমে, আমরা এমন একটি টिकाউ সুস্থ খाद্য নেটওয়ার্ক তৈরি করতে চাই, যা স্বাস্থ্য, সুখ ও সবার জন্য উজ্জ্বল ভবিष्यকে উন্নীত করে।  ক্ষুধার মূল কারণগুলি মোকাবেলা করে, আমরা আমাদের সম্প্রদায়ের উপর স্থায়ী ইতিবাচক প্রভাব ফেলতে এবং অন্যদের আমাদের কারণে যোগ দেওয়ার জন্য অনুপ্রাণিত করার চেষ্টা করি।', 'আমাদের দৃষ্টি হলো একটি এমন সমাজ গঠন করা যেখানে প্রত্যেক ব্যক্তির কাছে পুষ্টিকর ও স্বাস্থ্যকর খাদ্যের সহজলভ্যতা থাকবে। আমরা এমন একটি পৃথিবীর কল্পনা করি যেখানে কেউ খাদ্য অভাবে ভোগবে না এবং প্রত্যেকে সুস্থ জীবনযাপনের সুযোগ পাবে। আমাদের লক্ষ্য হলো খাদ্য সুরক্ষা নিশ্চিত করা, এবং জনগণের মাঝে স্বাস্থ্য সচেতনতা বৃদ্ধি করা। আমরা বিশ্বাস করি যে, একত্রিত প্রচেষ্টার মাধ্যমে আমরা ক্ষুধা নির্মূল করতে এবং একটি সুস্থ ও সুখী সমাজ গঠন করতে সক্ষম হবো।', 'আমাদের লক্ষ্য হলো খাদ্য নিরাপত্তা নিশ্চিত করতে এবং সুস্থ ও পুষ্টিকর খাবারের সহজলভ্যতা প্রদান করতে। আমরা এমন একটি সমাজ গঠন করতে চাই যেখানে প্রত্যেক ব্যক্তি, পরিবার এবং শিশু পর্যাপ্ত পুষ্টিকর খাবার পাবে। আমাদের লক্ষ্যকে বাস্তবায়ন করতে আমরা বিভিন্ন সমাজসেবা প্রকল্প এবং দানকারীদের সহায়তা নিয়ে কাজ করি। আমরা বিশ্বাস করি', 'আমাদের লক্ষ্য হলো খাদ্য নিরাপত্তা নিশ্চিত করতে এবং সুস্থ ও পুষ্টিকর খাবারের সহজলভ্যতা প্রদান করতে। আমরা এমন একটি সমাজ গঠন করতে চাই যেখানে প্রত্যেক ব্যক্তি, পরিবার এবং শিশু পর্যাপ্ত পুষ্টিকর খাবার পাবে। আমাদের লক্ষ্যকে বাস্তবায়ন করতে আমরা বিভিন্ন সমাজসেবা প্রকল্প এবং দানকারীদের সহায়তা নিয়ে কাজ করি। আমরা বিশ্বাস করি', '2024-04-28 15:53:17', '2024-04-28 15:53:17');

CREATE TABLE `social_media` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `platform` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `sub_categories` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `category_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sub_categories_category_id_foreign` (`category_id`),
  CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `videos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `flag` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `video` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `order` int DEFAULT NULL,
  `videoable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `videoable_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `videos_videoable_type_videoable_id_index` (`videoable_type`,`videoable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE `website_infos` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'Unique Solution',
  `logo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'storage/generic/logo__.png',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `meta` text COLLATE utf8mb4_unicode_ci,
  `tags` text COLLATE utf8mb4_unicode_ci,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'admin@mail.com',
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT '+8801754100439',
  `fb` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8mb4_unicode_ci,
  `map` mediumtext COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO website_infos VALUES ('1', 'Unique Solution', 'storage/generic/logo__.png', NULL, NULL, NULL, 'admin@mail.com', '+8801754100439', NULL, NULL, NULL, NULL, NULL, '2024-04-28 15:53:17', '2024-04-28 15:53:17');

