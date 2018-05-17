-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: 2018-05-17 09:01:27
-- 服务器版本： 5.7.19-log
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taoshuwu`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin_config`
--

CREATE TABLE `admin_config` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_config`
--

INSERT INTO `admin_config` (`id`, `name`, `value`, `description`, `created_at`, `updated_at`) VALUES
(1, 'order_fake_pay', 'off', '是否开启模拟支付', '2018-03-12 08:27:45', '2018-03-12 08:27:45'),
(2, 'notify_order_confirmed', '您的订单已确认，请等待卖家送书！', '订单已确认', '2018-03-13 09:45:17', '2018-03-13 09:52:13'),
(3, 'notify_order_finish', '您的二手书资金已入账！', '资金已入账', '2018-03-13 09:48:06', '2018-03-13 09:48:06'),
(4, 'notify_order_payed', '您的书本已经被人购买，请尽快确认并将书本送达取书点！', '已售出请确认', '2018-03-13 09:49:30', '2018-03-13 09:49:57'),
(5, 'notify_order_send', '您购买的书本已送达，请及时取书！', '已送达请取书', '2018-03-13 09:51:59', '2018-03-13 09:51:59'),
(6, 'commission', '0', '平台分成比例单位（%）', '2018-03-15 06:51:18', '2018-05-17 00:53:30'),
(7, 'sim_wechat_oauth', 'off', '是否开启模拟微信登录', '2018-03-26 06:45:29', '2018-05-14 06:29:58');

-- --------------------------------------------------------

--
-- 表的结构 `admin_menu`
--

CREATE TABLE `admin_menu` (
  `id` int(10) UNSIGNED NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `order` int(11) NOT NULL DEFAULT '0',
  `title` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `icon` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uri` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_menu`
--

INSERT INTO `admin_menu` (`id`, `parent_id`, `order`, `title`, `icon`, `uri`, `created_at`, `updated_at`) VALUES
(1, 0, 1, '后台首页', 'fa-bar-chart', '/', NULL, '2018-03-26 03:35:25'),
(2, 0, 10, '管理员', 'fa-tasks', NULL, NULL, '2018-03-26 07:28:52'),
(3, 2, 11, '管理员列表', 'fa-users', 'auth/users', NULL, '2018-03-26 07:28:52'),
(4, 2, 12, '规则', 'fa-user', 'auth/roles', NULL, '2018-03-26 07:28:52'),
(5, 2, 13, '权限', 'fa-ban', 'auth/permissions', NULL, '2018-03-26 07:28:52'),
(6, 2, 14, '后台菜单', 'fa-bars', 'auth/menu', NULL, '2018-03-26 07:28:52'),
(7, 2, 15, '操作日志', 'fa-history', 'auth/logs', NULL, '2018-03-26 07:28:52'),
(8, 0, 5, '书本管理', 'fa-book', 'books', '2018-03-05 06:26:42', '2018-03-26 03:43:08'),
(9, 2, 17, '站点配置', 'fa-toggle-on', 'config', '2018-03-05 06:28:01', '2018-03-26 07:28:52'),
(10, 0, 4, '会员管理', 'fa-group', 'users', '2018-03-05 07:40:47', '2018-03-26 03:43:00'),
(11, 0, 3, '书本分类', 'fa-align-left', 'categories', '2018-03-05 08:14:59', '2018-03-26 03:42:20'),
(12, 0, 2, '学校管理', 'fa-balance-scale', 'schools', '2018-03-05 08:23:55', '2018-03-26 03:42:48'),
(13, 0, 8, '媒体文件管理', 'fa-file', 'media', '2018-03-05 08:55:27', '2018-03-26 03:42:20'),
(14, 2, 16, '定时任务', 'fa-clock-o', 'scheduling', '2018-03-05 09:00:52', '2018-03-26 07:28:52'),
(15, 0, 6, '订单管理', 'fa-calendar-check-o', 'orders', '2018-03-12 02:32:12', '2018-03-26 03:43:17'),
(16, 0, 7, '提现申请', 'fa-amazon', 'transfers', '2018-03-20 06:39:02', '2018-03-26 03:42:20'),
(17, 0, 9, '文章管理', 'fa-bookmark', 'articles', '2018-03-26 07:28:26', '2018-03-26 07:28:52');

-- --------------------------------------------------------

--
-- 表的结构 `admin_operation_log`
--

CREATE TABLE `admin_operation_log` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `path` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `method` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ip` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `input` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `admin_permissions`
--

CREATE TABLE `admin_permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `http_method` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `http_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_permissions`
--

INSERT INTO `admin_permissions` (`id`, `name`, `slug`, `http_method`, `http_path`, `created_at`, `updated_at`) VALUES
(1, '所有权限', '*', '', '*', NULL, '2018-03-26 06:53:02'),
(2, '后台首页', 'dashboard', 'GET', '/', NULL, '2018-03-26 06:52:47'),
(3, '登录', 'auth.login', '', '/auth/login\r\n/auth/logout', NULL, '2018-03-26 06:53:12'),
(4, '管理员个人信息设置', 'auth.setting', 'GET,PUT', '/auth/setting', NULL, '2018-03-26 06:53:43'),
(5, '权限管理', 'auth.management', '', '/auth/roles\r\n/auth/permissions\r\n/auth/menu\r\n/auth/logs', NULL, '2018-03-26 06:53:57'),
(6, '媒体文件管理', 'ext.media-manager', '', '/media*', '2018-03-06 02:04:11', '2018-03-26 06:54:06'),
(7, '站点配置', 'ext.config', '', '/config*', '2018-03-06 02:04:29', '2018-03-26 06:54:22'),
(8, '定时任务', 'ext.scheduling', '', '/scheduling*', '2018-03-06 02:04:38', '2018-03-26 06:54:41'),
(9, '学校管理', 'schools', '', '/schools*', '2018-03-26 06:55:06', '2018-03-26 06:55:32'),
(10, '书本分类', 'categories', '', '/categories*', '2018-03-26 06:56:59', '2018-03-26 06:56:59'),
(11, '会员管理', 'users', '', '/users*', '2018-03-26 06:57:23', '2018-03-26 06:57:23'),
(12, '书本管理', 'books', '', '/books*', '2018-03-26 06:57:46', '2018-03-26 06:57:46'),
(13, '订单管理', 'orders', '', '/orders*', '2018-03-26 06:58:13', '2018-03-26 06:58:13'),
(14, '提现申请', 'transfers', '', '/transfers*', '2018-03-26 06:58:36', '2018-03-26 06:58:36'),
(15, '确认打款', 'transfer_confirm', 'GET', '/transfer/{transfer}/confirm', '2018-03-26 06:59:08', '2018-03-26 06:59:43');

-- --------------------------------------------------------

--
-- 表的结构 `admin_roles`
--

CREATE TABLE `admin_roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `slug` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_roles`
--

INSERT INTO `admin_roles` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, '超级管理员', 'administrator', '2018-03-06 02:03:04', '2018-03-26 07:02:11'),
(2, '书本管理员', 'books_manager', '2018-03-26 07:01:49', '2018-03-26 07:01:49');

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_menu`
--

CREATE TABLE `admin_role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_menu`
--

INSERT INTO `admin_role_menu` (`role_id`, `menu_id`, `created_at`, `updated_at`) VALUES
(1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_permissions`
--

CREATE TABLE `admin_role_permissions` (
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_permissions`
--

INSERT INTO `admin_role_permissions` (`role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 12, NULL, NULL),
(2, 2, NULL, NULL),
(2, 3, NULL, NULL),
(2, 4, NULL, NULL),
(2, 10, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_role_users`
--

CREATE TABLE `admin_role_users` (
  `role_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_role_users`
--

INSERT INTO `admin_role_users` (`role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, NULL),
(2, 2, NULL, NULL),
(1, 3, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `admin_users`
--

CREATE TABLE `admin_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(190) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `name`, `avatar`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', '$2y$10$ATYyiwfX8BXAtnPs1Dw.5.009AjvyuOzH7lHbkfDgZCb91Kl6ZyrG', 'Administrator', NULL, '1Ro3fGaxH1Fj6f3ysmUFSFpxePLSwMUprIE519nVS3kHVlqT1fQZx5kn1PEN', '2018-03-06 02:03:04', '2018-04-16 09:51:53'),
(2, 'zhangsan', '$2y$10$yvhA34pgMuXLYFRW9ecbe.ZbBTo3QUOqTbNdk/NLDPCG7Mp5jAFJu', '张三', 'images/ATRBozJLrK.png', 'YjpEB77p4DHF6oK1nJQbbJOYsOHfz3BMM91Kl5QQ1XaHqO7z6JBtvgDoERcN', '2018-03-26 07:02:45', '2018-03-26 07:02:45');

-- --------------------------------------------------------

--
-- 表的结构 `admin_user_permissions`
--

CREATE TABLE `admin_user_permissions` (
  `user_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `admin_user_permissions`
--

INSERT INTO `admin_user_permissions` (`user_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(3, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- 表的结构 `articles`
--

CREATE TABLE `articles` (
  `id` int(10) UNSIGNED NOT NULL,
  `alias` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标识',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '名称',
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '标题',
  `image` text COLLATE utf8mb4_unicode_ci COMMENT '图片',
  `content` text COLLATE utf8mb4_unicode_ci COMMENT '详情',
  `link` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '链接',
  `is_show` tinyint(4) NOT NULL DEFAULT '1' COMMENT '是否显示',
  `views` int(11) NOT NULL DEFAULT '0' COMMENT '浏览量',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `sort` int(11) NOT NULL DEFAULT '100' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `articles`
--

INSERT INTO `articles` (`id`, `alias`, `name`, `title`, `image`, `content`, `link`, `is_show`, `views`, `created_at`, `updated_at`, `sort`) VALUES
(1, 'banner', '首页 banner 第一张', '淘书屋上线', 'http://wx.hsj200808.com/uploads/images/articles/bac646e3dfc7cf8e4c879b4e3fbe5455.png', '一、平台介绍\r\n“乐书淘”图书交易平台属于昆明零梦科技有限公司，成立于2018年，注册资本200万元，公司主要为在校大学生提供一个自由买卖教材、图书的平台，用户可以在平台上进行新旧图书（教材）的自由交易，大家可以把不用的图书（教材）放在这里进行买卖，既可以为购买教材省钱，也可以赚取零花钱。书本有价，知识无价！既保护了环境，又传递了知识！创建节约型社会，从我做起。\r\n二、操作指南\r\n1、新用户注册\r\n三、功能特点\r\n四、招商代理\r\n五、联系我们', 'http://wx.hsj200808.com/article/4/show', 1, 3, '2018-03-26 08:22:53', '2018-05-16 02:27:50', 200),
(2, 'middle', '首页中部广告', '平台好书推荐', 'http://wx.hsj200808.com/uploads/images/articles/7151cb7b5318789bf6f6ec7fdc6f27f1.png', '一、平台介绍\r\n         “乐书淘”图书交易平台属于昆明零梦科技有限公司，成立于2018年，注册资本200万元，公司主要为在校大学生提供一个自由买卖教材、图书的平台，用户可以在平台上进行新旧图书（教材）的自由交易，大家可以把不用的图书（教材）放在这里进行买卖，既可以为购买教材省钱，也可以赚取零花钱。书本有价，知识无价！既保护了环境，又传递了知识！创建节约型社会，从我做起。\r\n          二、操作指南\r\n           1、新用户注册\r\n          三、功能特点\r\n          四、招商代理\r\n         五、联系我们', 'http://wx.hsj200808.com/article/2/show', 1, 70, '2018-03-26 09:16:13', '2018-05-16 11:06:53', 100),
(3, 'about', '平台介绍', '关于我们', 'http://wx.hsj200808.com/uploads/images/articles/8672a1acd63bc279b5e093cd0fc9a6d9.png', '<p><strong>&nbsp; &nbsp; 用户可以在平台上进行旧教材的自由交易。</strong><strong>大家的旧书可以同城交易或同校交易，可以把不用的书籍放在这里卖，既可以赚的零花钱，也可以变废为宝，节约资源，利人利己！书本有价，知识无价！！创建节约型社会，从我做起。</strong></p>\r\n\r\n<p><strong>&nbsp;&nbsp; &nbsp;</strong></p>\r\n\r\n<h1>校园代理火热招募中...</h1>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h1>合作初步介绍</h1>\r\n\r\n<p>　　校园代理负责二手教材网在该校园的推广活动，有义务代表二手教材网处理校园相关业务，包括：代客下单、接单和代客处理退换货，同时也有义务维护二手教材网在校园的形象。<br />\r\n校园代理是二手教材网为进入校园市场而招募的优秀校园人才，让更多的校园学生能够有机会了解电子商务行业知识，在自我实践和学习中得到能力和收入的双丰收。</p>\r\n\r\n<h1>合作加盟条件</h1>\r\n\r\n<p>1)吃苦耐劳,有事业心,有责任感,执行力强,服从安排。<br />\r\n2)在学校内有自己的人际关系网络,并有良好的理解能力与表达能力,沟通能力。<br />\r\n3)对电子商务及网购有一定了解，熟悉二手教材网购物流程,熟悉校园环境,便于货物的派发。<br />\r\n4)在校大学生或者在校职工。<br />\r\n5)有极其方便的上网环境。<br />\r\n6)能够合理安排学习和工作的时间。<br />\r\n7)BBS版主、社团负责人、或者有代购和电子商务相关工作经验者优先考虑。</p>\r\n\r\n<h1>合作加盟流程</h1>\r\n\r\n<p>提交在线申请表――＞管理员审核并通知审核结果――＞开始推广合作<br />\r\n1)在下面的在线报名表单内，完整填写信息；<br />\r\n2)管理员进行审核，审核结果将会在账户内体现；<br />\r\n3)代理通过线上线下方式发展新客户，促进客户下单。</p>', 'http://wx.hsj200808.com/article/3/show', 1, 81, '2018-03-26 09:18:13', '2018-05-12 14:12:06', 100);

-- --------------------------------------------------------

--
-- 表的结构 `books`
--

CREATE TABLE `books` (
  `id` int(10) UNSIGNED NOT NULL,
  `sn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `press` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `used` tinyint(4) NOT NULL,
  `original_price` decimal(8,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `is_show` tinyint(4) NOT NULL DEFAULT '2',
  `is_recommend` tinyint(4) NOT NULL DEFAULT '2',
  `user_id` int(10) UNSIGNED NOT NULL,
  `category_id` int(10) UNSIGNED NOT NULL,
  `school_id` int(10) UNSIGNED NOT NULL,
  `admin_id` int(10) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `admin_note` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '管理员备注'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `categories`
--

CREATE TABLE `categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `categories`
--

INSERT INTO `categories` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, '二手教材', '书本有价，知识无价。', NULL, '2018-03-29 07:49:26'),
(2, '课外读物', '开发技巧、推荐扩展包等', NULL, NULL),
(3, '教辅书籍', '请保持友善，互帮互助', NULL, '2018-03-29 07:50:12'),
(4, '计算机', NULL, '2018-03-29 07:50:42', '2018-04-26 07:27:19'),
(5, '经管类', NULL, '2018-03-30 02:07:11', '2018-03-30 02:07:11'),
(6, '文艺', NULL, '2018-03-30 02:07:32', '2018-03-30 02:07:32'),
(7, '医学', NULL, '2018-03-30 02:07:45', '2018-03-30 02:07:45'),
(8, '社科', NULL, '2018-03-30 02:07:58', '2018-03-30 02:07:58'),
(9, '少儿', NULL, '2018-03-30 02:08:14', '2018-03-30 02:08:14');

-- --------------------------------------------------------

--
-- 表的结构 `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `laravel_sms`
--

CREATE TABLE `laravel_sms` (
  `id` int(10) UNSIGNED NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `temp_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `data` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `content` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `voice_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `fail_times` mediumint(9) NOT NULL DEFAULT '0',
  `last_fail_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sent_time` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `result_info` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(52, '2014_10_12_000000_create_users_table', 1),
(53, '2015_12_21_111514_create_sms_table', 1),
(54, '2016_01_04_173148_create_admin_tables', 1),
(55, '2017_07_17_040159_create_config_table', 1),
(56, '2018_03_02_162015_create_schools_table', 1),
(57, '2018_03_02_162315_create_categories_table', 1),
(58, '2018_03_02_162608_seed_categories_data', 1),
(59, '2018_03_02_162929_seed_schools_data', 1),
(60, '2018_03_02_173338_create_books_table', 1),
(61, '2018_03_05_103156_add_admin_note_to_books_table', 1),
(62, '2018_03_05_164922_change_school_table', 1),
(63, '2018_03_12_090116_create_failed_jobs_table', 2),
(67, '2018_03_12_092047_create_orders_table', 3),
(71, '2018_03_13_103705_create_notifications_table', 4),
(72, '2018_03_13_134729_create_order_logs_table', 4),
(73, '2018_03_14_140952_create_failed_jobs_table', 5),
(74, '2018_03_15_150515_add_commission_to_orders', 6),
(75, '2018_03_15_151108_create_user_accounts_table', 7),
(76, '2018_03_15_153224_create_transfers_table', 8),
(80, '2018_03_16_132721_create_search_table', 9),
(81, '2018_03_26_141257_add_oauth_to_users', 10),
(85, '2018_03_26_151019_create_articles_table', 11),
(86, '2018_03_26_161638_add_sort_to_articles', 11),
(87, '2018_03_29_162905_change_books_table', 12);

-- --------------------------------------------------------

--
-- 表的结构 `notifications`
--

CREATE TABLE `notifications` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `notifiable_id` int(10) UNSIGNED NOT NULL,
  `notifiable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `data` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `read_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `orders`
--

CREATE TABLE `orders` (
  `id` int(10) UNSIGNED NOT NULL,
  `sn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci,
  `book_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `school_id` int(11) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `payed_amount` decimal(8,2) NOT NULL DEFAULT '0.00',
  `payed_at` timestamp NULL DEFAULT NULL,
  `out_sn` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `image` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `commission_user` decimal(8,2) DEFAULT NULL,
  `commission_system` decimal(8,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `order_logs`
--

CREATE TABLE `order_logs` (
  `id` int(10) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `order_status` tinyint(4) NOT NULL,
  `operator` tinyint(4) NOT NULL,
  `operator_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `schools`
--

CREATE TABLE `schools` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `depot` text COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '取货点',
  `working_time` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '工作时间',
  `worker` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系人',
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '联系电话',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 转存表中的数据 `schools`
--

INSERT INTO `schools` (`id`, `name`, `depot`, `working_time`, `worker`, `mobile`, `created_at`, `updated_at`) VALUES
(1, '云南大学(东陆校区）', '云南大学东二院门卫', '7:00 ~ 20:00', '李四', '13800000000', NULL, '2018-03-29 07:45:38'),
(2, '云南民族大学', '惠泽园1栋101小卖铺', '7:00 ~ 20:00', '张三', '13800000000', NULL, '2018-03-29 04:49:46'),
(3, '昆明理工大学', '锦华苑食堂一楼角落', '7:00 ~ 20:00', '王五', '13800000000', NULL, NULL),
(4, '昆明理工大学津桥学院（空港校区）', '公教楼104', NULL, '侯', '13759138797', '2018-03-28 00:30:17', '2018-03-28 00:30:31'),
(5, '云南大学（呈贡校区）', '百花超市', '全天', '周东', '13600000000', '2018-03-29 07:46:36', '2018-03-29 07:46:36'),
(6, '云南师范大学（呈贡校区）', '1214宿舍', '全天', '张目', '13800000000', '2018-03-29 07:48:01', '2018-03-29 07:48:01'),
(7, '云南农业大学', '东二门', '全天', '曾金', '13577140000', '2018-03-30 02:05:55', '2018-03-30 02:05:55'),
(8, '西南大学', '东院', '全天', '高红丽', '13577176044', '2018-03-30 02:06:45', '2018-03-30 02:06:45');

-- --------------------------------------------------------

--
-- 表的结构 `searches`
--

CREATE TABLE `searches` (
  `id` int(10) UNSIGNED NOT NULL,
  `keywords` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `transfers`
--

CREATE TABLE `transfers` (
  `id` int(10) UNSIGNED NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `user_id` int(11) NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `alipay` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_id` int(11) DEFAULT NULL,
  `payed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` decimal(8,2) NOT NULL DEFAULT '0.00',
  `alipay` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci COMMENT '头像',
  `gender` tinyint(4) NOT NULL DEFAULT '0' COMMENT '性别',
  `last_actived_at` timestamp NULL DEFAULT NULL COMMENT '近期活跃',
  `notification_count` int(11) NOT NULL DEFAULT '0' COMMENT '通知数量',
  `school_id` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `openid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `user_accounts`
--

CREATE TABLE `user_accounts` (
  `id` int(10) UNSIGNED NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_balance` decimal(8,2) NOT NULL,
  `type` tinyint(4) NOT NULL,
  `link` json DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_config`
--
ALTER TABLE `admin_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_config_name_unique` (`name`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  ADD PRIMARY KEY (`id`),
  ADD KEY `admin_operation_log_user_id_index` (`user_id`);

--
-- Indexes for table `admin_permissions`
--
ALTER TABLE `admin_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_permissions_name_unique` (`name`);

--
-- Indexes for table `admin_roles`
--
ALTER TABLE `admin_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_roles_name_unique` (`name`);

--
-- Indexes for table `admin_role_menu`
--
ALTER TABLE `admin_role_menu`
  ADD KEY `admin_role_menu_role_id_menu_id_index` (`role_id`,`menu_id`);

--
-- Indexes for table `admin_role_permissions`
--
ALTER TABLE `admin_role_permissions`
  ADD KEY `admin_role_permissions_role_id_permission_id_index` (`role_id`,`permission_id`);

--
-- Indexes for table `admin_role_users`
--
ALTER TABLE `admin_role_users`
  ADD KEY `admin_role_users_role_id_user_id_index` (`role_id`,`user_id`);

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admin_users_username_unique` (`username`);

--
-- Indexes for table `admin_user_permissions`
--
ALTER TABLE `admin_user_permissions`
  ADD KEY `admin_user_permissions_user_id_permission_id_index` (`user_id`,`permission_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `articles_alias_index` (`alias`);

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `books_name_index` (`name`),
  ADD KEY `books_user_id_index` (`user_id`),
  ADD KEY `books_category_id_index` (`category_id`),
  ADD KEY `books_school_id_index` (`school_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `laravel_sms`
--
ALTER TABLE `laravel_sms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_notifiable_id_notifiable_type_index` (`notifiable_id`,`notifiable_type`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_sn_index` (`sn`),
  ADD KEY `orders_book_id_index` (`book_id`),
  ADD KEY `orders_seller_id_index` (`seller_id`),
  ADD KEY `orders_user_id_index` (`user_id`),
  ADD KEY `orders_school_id_index` (`school_id`),
  ADD KEY `orders_status_index` (`status`);

--
-- Indexes for table `order_logs`
--
ALTER TABLE `order_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_logs_order_id_index` (`order_id`);

--
-- Indexes for table `schools`
--
ALTER TABLE `schools`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `searches`
--
ALTER TABLE `searches`
  ADD PRIMARY KEY (`id`),
  ADD KEY `searches_keywords_index` (`keywords`),
  ADD KEY `searches_user_id_index` (`user_id`);

--
-- Indexes for table `transfers`
--
ALTER TABLE `transfers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transfers_user_id_index` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_mobile_unique` (`mobile`),
  ADD UNIQUE KEY `users_openid_unique` (`openid`),
  ADD KEY `users_school_id_index` (`school_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_accounts_user_id_index` (`user_id`),
  ADD KEY `user_accounts_type_index` (`type`);

--
-- 在导出的表使用AUTO_INCREMENT
--

--
-- 使用表AUTO_INCREMENT `admin_config`
--
ALTER TABLE `admin_config`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- 使用表AUTO_INCREMENT `admin_menu`
--
ALTER TABLE `admin_menu`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 使用表AUTO_INCREMENT `admin_operation_log`
--
ALTER TABLE `admin_operation_log`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `admin_permissions`
--
ALTER TABLE `admin_permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- 使用表AUTO_INCREMENT `admin_roles`
--
ALTER TABLE `admin_roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用表AUTO_INCREMENT `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 使用表AUTO_INCREMENT `books`
--
ALTER TABLE `books`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- 使用表AUTO_INCREMENT `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `laravel_sms`
--
ALTER TABLE `laravel_sms`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- 使用表AUTO_INCREMENT `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `order_logs`
--
ALTER TABLE `order_logs`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `schools`
--
ALTER TABLE `schools`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- 使用表AUTO_INCREMENT `searches`
--
ALTER TABLE `searches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `transfers`
--
ALTER TABLE `transfers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用表AUTO_INCREMENT `user_accounts`
--
ALTER TABLE `user_accounts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
