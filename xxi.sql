/*
 Navicat Premium Data Transfer

 Source Server         : localhost_3306
 Source Server Type    : MySQL
 Source Server Version : 50724
 Source Host           : localhost:3306
 Source Schema         : xxi

 Target Server Type    : MySQL
 Target Server Version : 50724
 File Encoding         : 65001

 Date: 18/06/2020 19:50:13
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for branches
-- ----------------------------
DROP TABLE IF EXISTS `branches`;
CREATE TABLE `branches`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 2 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of branches
-- ----------------------------
INSERT INTO `branches` VALUES (1, 'Matarams', '2020-06-18 12:37:46', '2020-06-18 12:40:17');

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp(0) NOT NULL DEFAULT CURRENT_TIMESTAMP(0),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of failed_jobs
-- ----------------------------

-- ----------------------------
-- Table structure for login_tokens
-- ----------------------------
DROP TABLE IF EXISTS `login_tokens`;
CREATE TABLE `login_tokens`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `token` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of login_tokens
-- ----------------------------
INSERT INTO `login_tokens` VALUES (1, 1, '$2y$10$XikyrGJ/deqkTssKVoUYyuJgK3yTjHImCQm/kMVo/qLeceQtTyKjO', '2020-06-18 12:36:30', '2020-06-18 12:36:30');
INSERT INTO `login_tokens` VALUES (2, 3, '$2y$10$fMa8bxE8H1e.JH5c5pz0UuTSnxcXtW.TAHnhtpARFlhpwD3xkLtNK', '2020-06-18 12:37:13', '2020-06-18 12:37:13');

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations`  (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of migrations
-- ----------------------------
INSERT INTO `migrations` VALUES (1, '2014_10_12_000000_create_users_table', 1);
INSERT INTO `migrations` VALUES (2, '2019_08_19_000000_create_failed_jobs_table', 1);
INSERT INTO `migrations` VALUES (3, '2020_06_18_073005_create_branches_table', 1);
INSERT INTO `migrations` VALUES (4, '2020_06_18_073137_create_studios_table', 1);
INSERT INTO `migrations` VALUES (5, '2020_06_18_073747_create_movies_table', 1);
INSERT INTO `migrations` VALUES (6, '2020_06_18_073944_create_schedules_table', 1);
INSERT INTO `migrations` VALUES (7, '2020_06_18_080315_create_login_tokens_table', 1);

-- ----------------------------
-- Table structure for movies
-- ----------------------------
DROP TABLE IF EXISTS `movies`;
CREATE TABLE `movies`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `minute_length` int(11) NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of movies
-- ----------------------------
INSERT INTO `movies` VALUES (1, 'Perang Bintang', 113, 'movies/hpf7UrFnihup9L57KvQptmk3aZCjHjnxbsOmlFQP.jpeg', '2020-06-18 12:41:15', '2020-06-18 12:41:15');
INSERT INTO `movies` VALUES (2, 'Perang Bintang', 113, 'movies/KdJTMhEL5Gj4arUEI6IbE9FjkkGv9b9XaneFBfTu.jpeg', '2020-06-18 12:41:22', '2020-06-18 12:41:22');

-- ----------------------------
-- Table structure for schedules
-- ----------------------------
DROP TABLE IF EXISTS `schedules`;
CREATE TABLE `schedules`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `studio_id` bigint(20) UNSIGNED NOT NULL,
  `movie_id` bigint(20) UNSIGNED NOT NULL,
  `start_date_time` datetime(0) NOT NULL,
  `end_date_time` datetime(0) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `schedules_studio_id_foreign`(`studio_id`) USING BTREE,
  INDEX `schedules_movie_id_foreign`(`movie_id`) USING BTREE,
  CONSTRAINT `schedules_movie_id_foreign` FOREIGN KEY (`movie_id`) REFERENCES `movies` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `schedules_studio_id_foreign` FOREIGN KEY (`studio_id`) REFERENCES `studios` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of schedules
-- ----------------------------
INSERT INTO `schedules` VALUES (1, 1, 1, '2020-06-21 17:02:00', '2020-06-21 18:55:00', '2020-06-18 12:41:28', '2020-06-18 12:41:28');
INSERT INTO `schedules` VALUES (2, 1, 1, '2018-02-01 14:00:00', '2018-02-01 15:53:00', '2020-06-18 12:41:35', '2020-06-18 12:41:35');

-- ----------------------------
-- Table structure for studios
-- ----------------------------
DROP TABLE IF EXISTS `studios`;
CREATE TABLE `studios`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `basic_price` bigint(20) NOT NULL,
  `additional_friday_price` bigint(20) NOT NULL,
  `additional_saturday_price` bigint(20) NOT NULL,
  `additional_sunday_price` bigint(20) NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `studios_branch_id_foreign`(`branch_id`) USING BTREE,
  CONSTRAINT `studios_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branches` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 3 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of studios
-- ----------------------------
INSERT INTO `studios` VALUES (1, 'Studio 1', 1, 30000, 5000, 10000, 10000, '2020-06-18 12:40:49', '2020-06-18 12:40:49');
INSERT INTO `studios` VALUES (2, 'Studio 1', 1, 30000, 5000, 10000, 10000, '2020-06-18 12:41:04', '2020-06-18 12:41:04');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users`  (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp(0) NULL DEFAULT NULL,
  `updated_at` timestamp(0) NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_unicode_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES (1, 'admin1', '$2y$10$indpEn8MqLMiVIo3HBWyGePwBhZfmupqtn.PPKedE6IkGquXKS3y6', 'admin', '2020-06-18 12:36:07', '2020-06-18 12:36:07');
INSERT INTO `users` VALUES (2, 'admin2', '$2y$10$1BcH6.qImrfbYRVL9oZiNuvN6f3aTpB6WabMGTHC93.G8D/dvHbUa', 'admin', '2020-06-18 12:36:07', '2020-06-18 12:36:07');
INSERT INTO `users` VALUES (3, 'user1', '$2y$10$Yf3qCRAop3wuO3ER2WcghOgzCoK9A3TAHZCEyReZz.lSjXjbqI7xG', 'user', '2020-06-18 12:36:07', '2020-06-18 12:36:07');

SET FOREIGN_KEY_CHECKS = 1;
