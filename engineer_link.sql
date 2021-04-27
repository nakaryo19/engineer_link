-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Apr 26, 2021 at 11:57 AM
-- Server version: 5.7.30
-- PHP Version: 7.4.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `engineer_link`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `text` varchar(255) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `title`, `text`, `user_id`, `category_id`, `created_at`, `update_at`) VALUES
(3, 'テスト編集1', 'テスト編集', 13, 1, '2021-04-05 11:40:04', '2021-04-06 08:48:19'),
(4, 'POSTとは', 'POSTは指定したリソースを実装した機能に従って処理をする機能になります。\r\n\r\n主に登録処理や更新処理などの、書き込みがありリソースが更新される可能性のある処理に対して使うメソッドになります。\r\n\r\n例えば、以下のような例があります。\r\n\r\nHTMLの <form></form>に入力された内容をDBへ登録する\r\nブログの記事を投稿する\r\n新しいユーザを登録する\r\n既存のデータに新しい情報を付加する\r\nまた、GETとは反対に冪等でないかつ安全でないと定義されています。', 11, 2, '2021-04-07 08:05:17', '2021-04-07 17:05:17'),
(5, 'テスト', 'JAVAのテスト', 11, 5, '2021-04-07 08:21:18', '2021-04-07 17:21:18'),
(6, 'PHPの特徴', 'PHPの最大の特徴は、HTMLと組み合わせて使うことができるということです。HTMLは基本的に静的サイトを作成するのもなので、記事の更新などのタイミングに応じて表示の変わる動的サイトを作ることができません。そこでHTMLで生成されたコードの一部をPHPに変更することによって動的サイトを作ることができます。', 13, 1, '2021-04-13 08:33:19', '2021-04-13 17:33:19'),
(7, 'Rubyのメリット', 'Rubyはインタプリタ型言語です。コードはコンピューターが理解できるように翻訳した後実行されますが、\r\nインタプリタ型言語はコードを一つずつ随時翻訳してくれます。（コンパイル型言語は実行前に全てを翻訳して実行します）\r\nインタープリタ方式であるRubyはコードを手軽に実行し確認することができます。\r\nRubyはオブジェクト指向な言語であり、あらゆるものがオブジェクトとして扱われ\r\n開発効率が良いと定評があります。\r\nまたRubyは他の言語に比べ記述量が少なく、初学者にも学びやすい言語です。\r\n\r\n', 9, 4, '2021-04-13 08:43:15', '2021-04-13 17:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`) VALUES
(1, 'php'),
(2, 'HTML/CSS'),
(3, 'Javascript'),
(4, 'Ruby'),
(5, 'Java');

-- --------------------------------------------------------

--
-- Table structure for table `favorites`
--

CREATE TABLE `favorites` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorites`
--

INSERT INTO `favorites` (`id`, `user_id`, `article_id`, `created_at`, `update_at`) VALUES
(7, 3, 5, '2021-04-10 20:04:23', '2021-04-10 20:04:23'),
(8, 11, 4, '2021-04-13 17:24:23', '2021-04-13 17:24:23'),
(10, 9, 6, '2021-04-13 17:43:33', '2021-04-13 17:43:33'),
(11, 9, 5, '2021-04-13 17:43:39', '2021-04-13 17:43:39'),
(12, 9, 3, '2021-04-13 17:43:46', '2021-04-13 17:43:46'),
(13, 15, 7, '2021-04-13 17:45:00', '2021-04-13 17:45:00'),
(14, 15, 6, '2021-04-13 17:45:11', '2021-04-13 17:45:11'),
(16, 15, 5, '2021-04-13 17:45:23', '2021-04-13 17:45:23'),
(17, 15, 3, '2021-04-13 17:45:27', '2021-04-13 17:45:27'),
(18, 3, 7, '2021-04-13 17:47:08', '2021-04-13 17:47:08'),
(19, 3, 6, '2021-04-13 17:47:13', '2021-04-13 17:47:13'),
(20, 3, 3, '2021-04-13 17:47:22', '2021-04-13 17:47:22'),
(21, 3, 4, '2021-04-13 17:47:28', '2021-04-13 17:47:28'),
(22, 13, 8, '2021-04-14 18:57:57', '2021-04-14 18:57:57'),
(23, 13, 3, '2021-04-14 18:59:49', '2021-04-14 18:59:49'),
(24, 11, 7, '2021-04-24 08:33:38', '2021-04-24 08:33:38');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_name` varchar(32) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_name`, `mail`, `password`, `img`, `created_at`, `update_at`) VALUES
(3, 'メール受信テスト', 'techryo19@gmail.com', '$2y$10$W3ptDBKKrArhsSVZixt.v.TqfftqTdtJ6zvuREwaapJYvWg8ZMZSa', NULL, '2021-03-31 07:56:36', '2021-03-31 09:38:32'),
(9, 'テスト4', 'sample4@gmail.com', '$2y$10$.xjXL1J7OAErXsPC2yxP.ux/RfxFBY.rOkON1U5SM7DnhQqTrRPW2', 'エンジニアリンク目的.jpeg', '2021-03-31 08:14:36', '2021-04-13 08:40:32'),
(11, 'テスト1', 'sample@gmail.com', '$2y$10$Bs4ZRO0nCgMVg3FG/4/s1OBB/3JQOuRoEPwOoVMbsEaPaSnR8vKK.', '2295779.jpg', '2021-04-02 12:34:33', '2021-04-09 10:36:50'),
(13, 'サンプル', 'sample5@gmail.com', '$2y$10$tra6BPDerybtbQpKaBiKTelOigpAX2FcD4SgMbS4w4dEGS/nGgl8O', 'エンジニア悩み.png', '2021-04-03 19:54:35', '2021-04-13 08:33:59'),
(15, 'テスト6', 'sample6@gmail.com', '$2y$10$lVrbvSXE4d/pzV44B2x97ugeaPGIF1jVI906475db6Ar7HzrW1OdG', '0EC36C59-A755-45FB-9784-025ACA03DA1D.jpeg', '2021-04-09 06:57:15', '2021-04-13 08:44:49');

-- --------------------------------------------------------

--
-- Table structure for table `user_articles`
--

CREATE TABLE `user_articles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `article_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `favorites`
--
ALTER TABLE `favorites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_articles`
--
ALTER TABLE `user_articles`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `favorites`
--
ALTER TABLE `favorites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `user_articles`
--
ALTER TABLE `user_articles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
