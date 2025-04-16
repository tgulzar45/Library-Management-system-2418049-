-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 16, 2025 at 10:50 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Library system`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(255) NOT NULL,
  `genre` varchar(100) DEFAULT NULL,
  `isbn` varchar(20) DEFAULT NULL,
  `quantity` int(11) DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `genre`, `isbn`, `quantity`, `added_at`) VALUES
(13, 'yu', '\'F. Scott Fitzgerald\'', 'Fiction', '98989898989', 62, '2025-03-27 16:46:54'),
(15, '', '', '', '', 3, '2025-04-11 22:15:25'),
(24, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', 'Fantasy', '9780439708180', 14, '2025-04-15 21:58:23'),
(25, 'To Kill a Mockingbird', 'Harper Lee', 'Fiction', '9780060935467', 11, '2025-04-15 21:58:23'),
(26, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', 'History', '9780062316110', 9, '2025-04-15 21:58:23'),
(27, 'Gone Girl', 'Gillian Flynn', 'Mystery', '9780307588371', 5, '2025-04-15 21:58:23'),
(28, 'Pride and Prejudice', 'Jane Austen', 'Romance', '9780141439518', 21, '2025-04-15 21:58:23'),
(34, 'The Couple Next Door', 'Shari Lapena', 'Thriller', '9780735221109', 6, '2025-04-16 01:51:49'),
(35, 'The Tattooist of Auschwitz', 'Heather Morris', 'Historical Fiction', '9780062797155', 5, '2025-04-16 01:51:49'),
(36, 'Rich Dad Poor Dad', 'Robert T. Kiyosaki', 'Self-help', '9781612680194', 9, '2025-04-16 01:51:49'),
(37, 'The Man Who Died Twice', 'Richard Osman', 'Mystery', '9781984880993', 6, '2025-04-16 01:51:49'),
(38, 'Reminders of Him', 'Colleen Hoover', 'Romance', '9781542025607', 7, '2025-04-16 01:51:49'),
(39, 'Daisy Jones & The Six', 'Taylor Jenkins Reid', 'Fiction', '9781524798628', 5, '2025-04-16 01:51:49'),
(40, 'Think Like a Monk', 'Jay Shetty', 'Self-help', '9781982134487', 8, '2025-04-16 01:51:49'),
(41, 'Can’t Hurt Me', 'David Goggins', 'Biography', '9781544512280', 7, '2025-04-16 01:51:49'),
(42, 'The Four Winds', 'Kristin Hannah', 'Historical Fiction', '9781250178602', 5, '2025-04-16 01:51:49'),
(132, 'The Crystal Compass', 'Kenneth Anderson', 'Fantasy', '9780218734638', 7, '2025-04-16 20:46:23'),
(133, 'Shadows in the Fog', 'Karen Aguirre', 'History', '9780880908108', 8, '2025-04-16 20:46:23'),
(134, 'Parallel Realms', 'Michelle Dunn', 'Romance', '9780163384636', 3, '2025-04-16 20:46:23'),
(135, 'Letters to the Stars', 'Adam Brown', 'Romance', '9780217168830', 10, '2025-04-16 20:46:23'),
(136, 'Echoes of the Forgotten', 'Marissa Jordan', 'Self-help', '9780550715357', 6, '2025-04-16 20:46:23'),
(137, 'The Rose Dagger', 'William Flynn', 'Fantasy', '9781580876834', 4, '2025-04-16 20:46:23'),
(138, 'Fragments of Us', 'Ronald Casey', 'Horror', '9780937193983', 7, '2025-04-16 20:46:23'),
(139, 'Silent Waters', 'Jeffrey Strickland', 'Science Fiction', '9781319418090', 9, '2025-04-16 20:46:23'),
(140, 'Clockwork Valley', 'Tracey Flores', 'Thriller', '9781990244353', 4, '2025-04-16 20:46:23'),
(141, 'Starlight Chase', 'Robert Black', 'Horror', '9781564602374', 8, '2025-04-16 20:46:23'),
(142, 'The Whisper Code', 'Jennifer Gomez', 'Science Fiction', '9780515924985', 3, '2025-04-16 20:46:23'),
(143, 'Under the Iron Sky', 'Chad Alexander', 'Self-help', '9781305806009', 3, '2025-04-16 20:46:23'),
(144, 'The Archivist\'s Secret', 'Abigail Scott', 'History', '9780315281332', 7, '2025-04-16 20:46:23'),
(145, 'Canvas of Dreams', 'James Evans', 'Mystery', '9781228763633', 6, '2025-04-16 20:46:23'),
(146, 'The Dream Collector', 'Julie Olson', 'Romance', '9780314135743', 4, '2025-04-16 20:46:23'),
(147, 'The Ice Cathedral', 'Rachel Stone', 'Fantasy', '9781415812045', 9, '2025-04-16 20:46:23'),
(148, 'The Last Sunrise', 'Stephen Gill', 'Thriller', '9780678021766', 5, '2025-04-16 20:46:23'),
(149, 'Violet Horizon', 'Nancy Reed', 'Science Fiction', '9780667373951', 10, '2025-04-16 20:46:23'),
(150, 'Monsters Within', 'Joseph Cross', 'Horror', '9780524359273', 3, '2025-04-16 20:46:23'),
(151, 'A Kingdom Undone', 'Dorothy Burke', 'Fantasy', '9780662065768', 6, '2025-04-16 20:46:23'),
(152, 'The Rebel\'s Diary', 'Brian Vaughn', 'Biography', '9781527834792', 4, '2025-04-16 20:46:23'),
(153, 'Into the Dust', 'Barbara Kennedy', 'Non-fiction', '9780334356736', 7, '2025-04-16 20:46:23'),
(154, 'Broken Promises', 'Timothy Jenkins', 'Romance', '9781543456560', 3, '2025-04-16 20:46:23'),
(155, 'Threads of Gold', 'Katherine Walters', 'History', '9780118654413', 6, '2025-04-16 20:46:23'),
(156, 'Ghosts of Time', 'Steven Richards', 'Fantasy', '9780710195220', 5, '2025-04-16 20:46:23'),
(157, 'The Midas Paradox', 'Christina Sanchez', 'Thriller', '9781432937627', 8, '2025-04-16 20:46:23'),
(158, 'Lantern of Ashes', 'Patrick Ross', 'Mystery', '9781491530791', 9, '2025-04-16 20:46:23'),
(159, 'Beyond the Labyrinth', 'Melanie Bates', 'Science Fiction', '9781238051253', 4, '2025-04-16 20:46:23'),
(160, 'Paper Planets', 'Shawn Burke', 'Science Fiction', '9780526896728', 3, '2025-04-16 20:46:23'),
(161, 'The Soul Trader', 'Tina Carroll', 'Thriller', '9781743459174', 6, '2025-04-16 20:46:23'),
(162, 'A Thousand Whispers', 'Gary Bowman', 'Self-help', '9781449378124', 4, '2025-04-16 20:46:23'),
(163, 'Dark Tides Rising', 'Nicole Shaw', 'Fantasy', '9781951137245', 7, '2025-04-16 20:46:23'),
(164, 'The Mirror\'s Lie', 'Douglas Walton', 'Mystery', '9780450519318', 3, '2025-04-16 20:46:23'),
(165, 'Crimson Pact', 'Anita Hale', 'Fantasy', '9781548578334', 8, '2025-04-16 20:46:23'),
(166, 'Tales from the Rift', 'Ethan Sullivan', 'Science Fiction', '9781423856290', 6, '2025-04-16 20:46:23'),
(167, 'Ashes and Embers', 'Robin Klein', 'Romance', '9781643491230', 4, '2025-04-16 20:46:23'),
(168, 'Whistle in the Wind', 'Marcus Gibbs', 'Thriller', '9781778523077', 5, '2025-04-16 20:46:23'),
(169, 'Through Hollow Eyes', 'Angela Moreno', 'Mystery', '9780854329345', 7, '2025-04-16 20:46:23'),
(170, 'Twilight Covenant', 'Carl Peterson', 'Fantasy', '9781267093840', 9, '2025-04-16 20:46:23'),
(171, 'Phantom Scripts', 'Heather Walters', 'Horror', '9780765392446', 6, '2025-04-16 20:46:23'),
(172, 'Chasing Oblivion', 'Daniel Franklin', 'Biography', '9781570230847', 3, '2025-04-16 20:46:23'),
(173, 'The Ember Letters', 'Valerie Howard', 'Romance', '9781506342762', 8, '2025-04-16 20:46:23'),
(174, 'Bridges to Nowhere', 'Gregory Lucas', 'Non-fiction', '9781869483573', 4, '2025-04-16 20:46:23'),
(175, 'Oaths of Silence', 'Jill Burns', 'Thriller', '9780867589453', 7, '2025-04-16 20:46:23'),
(176, 'Caged Truths', 'Ronnie Snyder', 'Fantasy', '9780891925087', 3, '2025-04-16 20:46:23'),
(177, 'Veins of Steel', 'Monica Herrera', 'Science Fiction', '9781308429570', 6, '2025-04-16 20:46:23'),
(178, 'The Willow Keeper', 'Chris Potter', 'Mystery', '9780702482617', 5, '2025-04-16 20:46:23'),
(179, 'Under a Crimson Sky', 'Paula Simmons', 'Historical', '9781912700336', 8, '2025-04-16 20:46:23'),
(180, 'Maze of Thorns', 'Joel Gordon', 'Fantasy', '9781394301275', 9, '2025-04-16 20:46:23'),
(181, 'Legacy of Fire', 'Natalie Becker', 'Fantasy', '9781605133834', 4, '2025-04-16 20:46:23');

-- --------------------------------------------------------

--
-- Table structure for table `borrowed_books`
--

CREATE TABLE `borrowed_books` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `borrow_date` datetime NOT NULL,
  `return_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `borrowed_books`
--

INSERT INTO `borrowed_books` (`id`, `user_id`, `book_id`, `borrow_date`, `return_date`) VALUES
(20, 12, 13, '2025-04-16 09:14:23', '2025-04-16 09:48:33'),
(21, 13, 24, '2025-04-16 09:50:52', '2025-04-16 09:50:58'),
(23, 14, 27, '2025-04-16 11:37:59', NULL),
(24, 14, 27, '2025-04-16 11:40:53', NULL),
(26, 14, 27, '2025-04-16 11:44:28', '2025-04-16 17:01:58'),
(33, 18, 39, '2025-04-16 13:11:00', '2025-04-16 13:22:04'),
(36, 22, 25, '2025-04-16 13:46:00', '2025-04-16 14:03:58'),
(43, 15, 13, '2025-04-16 23:36:30', '2025-04-17 00:18:23'),
(44, 15, 13, '2025-04-16 23:36:43', '2025-04-16 23:54:41'),
(47, 3, 25, '2025-04-17 03:04:17', NULL),
(48, 3, 24, '2025-04-17 03:04:23', NULL),
(49, 3, 28, '2025-04-17 03:04:27', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `loan_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `return_date` timestamp NULL DEFAULT NULL,
  `status` enum('borrowed','returned') DEFAULT 'borrowed'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`id`, `email`, `token`, `expires_at`) VALUES
(1, 'tayyabgulzar45@gmail.com', '0b7d9e646cac211901788832dca20a43', '2025-04-16 00:02:09'),
(2, 'tayyabgulzar45@gmail.com', '23a4804c568ceaa3f0723811a878f823', '2025-04-16 00:16:19'),
(3, 'tayyabgulzar45@gmail.com', 'ec87390563807faecceec3f81d2eecdc', '2025-04-16 00:16:31'),
(4, 'tayyabgulzar45@gmail.com', '019fe40a8aaa5133c6b85422a8f3e22b', '2025-04-16 00:17:23'),
(5, 'tyler@live.com', 'c44184d21a4649cb4ac943742347ae19', '2025-04-16 06:14:28'),
(6, 'ryan@live.com', '6f1d609a98c8fd65e0a2ea2bc39bf5bc', '2025-04-16 06:29:21'),
(7, 'peter@live.com', '1b1a2c1a210779b7c14f5175b52ef7b4', '2025-04-16 06:52:47'),
(8, 'zach@live.com', '0674222b8818f6ba5f41ddd75acf86df', '2025-04-16 08:11:13'),
(9, 'zachy@live.com', '105799a4d89d708520d71555e36d52b8', '2025-04-16 08:16:10'),
(10, 'ethan@live.com', '81bb004177ab723a13bc143f3b79c3b4', '2025-04-16 08:25:14'),
(11, 'june@live.com', '3090b58296cabfce745e9c2af6a53a39', '2025-04-16 09:16:03'),
(12, 'gayle@live.com', '31925a2494eb415e4ea349f7d5d7cd62', '2025-04-16 09:42:52'),
(13, 'kevin@live.com', 'f037bd532e728d64ef8a30db355b8430', '2025-04-16 09:59:49'),
(14, 'garry@live.com', 'd29d231f60e15fbe03d6a9392fadf8c6', '2025-04-16 10:38:55'),
(15, 'barry@live.com', '0e4b1500f9c9886b68a0e4f76c5110d7', '2025-04-16 16:07:50'),
(16, 'nigel@live.com', '04675625843b5a1d793e11808fd6a551', '2025-04-16 16:52:54'),
(17, 'stacy@live.com', 'b3249d4ba9af5744f135547851bbe490', '2025-04-16 17:13:05'),
(18, 'brain@live.com', 'f8160fd2e373e0b90b05ab8319f91316', '2025-04-16 17:16:30'),
(19, 'misrabasilh@gmail.com', '13be2182582d26445fcdf0864404c6c4', '2025-04-16 18:36:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') DEFAULT 'user',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `reset_token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `reset_token`, `token_expiry`) VALUES
(1, 'Admin', 'admin@example.com', '*01A6717B58FF5C7EAFFF6CB7C96F7428EA65FE4C', 'admin', '2025-03-20 21:28:16', NULL, NULL),
(3, 'tayyab gulzar', 'tayyabgulzar45@gmail.com', '$2y$10$dpWjMOWsgzrUBvUNkTebnuqVarVqTkA.4nAIVFMEj5as/uATeOPXO', 'user', '2025-03-20 21:30:46', NULL, NULL),
(5, 'tayyab gulzar', 'khurramgulzar1@gmail.com', '$2y$10$Wr2gOqQJ1cmWfWwZwdCNXOj5Oo4FrsZqo7kjg8fZwiccpNcOngorq', 'admin', '2025-03-21 13:12:58', NULL, NULL),
(6, 'Mustafa Gulzar', 'mustafagulzar01@gmail.com', '$2y$10$kzO8TSGIk2O/BqKtmzW.VePyxzn5NeZ9h76nn4qdVrf0or98m/JT2', 'admin', '2025-03-21 13:17:12', NULL, NULL),
(11, 'Misra Basil Hussain', 'misrabasilh@gmail.com', '$2y$10$LyW5BAyGLX1aYp4dnvycFu4Kyup.IIk8M2jWniMIIL45qYroF4mlC', 'user', '2025-04-15 22:46:02', NULL, NULL),
(12, 'tayyab misra', 'tayyabmisra@gmail.com', '$2y$10$g16AMHxE3eZwp2HdwrwuU.glAvsASE/AFbTqPvxMtVAqi8jZ8fDI2', 'user', '2025-04-15 23:13:29', NULL, NULL),
(13, 'Misra Basil Hussain', 'HHHHH@live.com', '$2y$10$jS0Nm1tB99Q6fn15iwdKLeEWdugKA2Lwf84WRQMOqH4s15ht.vZJ6', 'user', '2025-04-15 23:50:26', NULL, NULL),
(14, 'tayyab gulzar', 'tayyabgulzar@live.com', '$2y$10$R2wv.EXotB33gSIhElalTeefBmdw4hUpZCC./DzerJ5kMbtyNNc.O', 'user', '2025-04-16 01:30:07', NULL, NULL),
(15, 'john', 'john@live.com', '$2y$10$16GXSLwwrpNFGOUAzcBuveddfAXe.jfhM1iKiBAmCAfXcgMVr9jsG', 'user', '2025-04-16 02:03:19', NULL, NULL),
(16, 'oliver', 'Oliver@live.com', '$2y$10$UG.Q4G0McpGYR1uzuqduseOFzpVSMfIhHp5TbRUywCLH19UO39SQm', 'user', '2025-04-16 02:47:49', NULL, NULL),
(18, 'shane', 'shane@live.com', '$2y$10$bYHzXR01196WZGka0C8ZLuYxcRxxtzqRn4Wvx8Ssuf./nr3L371xO', 'user', '2025-04-16 03:08:55', NULL, NULL),
(19, 'tyler', 'tyler@live.com', '$2y$10$vE5TRocnqVpOPgYkSL7WK.k2rWa5biGE.58xzChp0bnprqDh6GDTC', 'user', '2025-04-16 03:13:44', NULL, NULL),
(21, 'ryan', 'ryan@live.com', '$2y$10$keXs0xUFDgunZCploC91/eEQ8d6tz3LH7gEXeeSwC/VIE6yhD60UO', 'user', '2025-04-16 03:28:29', NULL, NULL),
(22, 'shay', 'shay@live.com', '$2y$10$bPCy8MoVL1JtvuaaWjQFrecc.MhxV2ceWTVSgyTFOJtquKGu67kxC', 'user', '2025-04-16 03:42:18', NULL, NULL),
(23, 'peter', 'peter@live.com', '$2y$10$6SrQlbFfcjtrfuAo6oCB5O0KDeunA5IM7lBDI90IPUiNvIp5F60ly', 'user', '2025-04-16 03:52:00', NULL, NULL),
(25, 'zach', 'zach@live.com', '$2y$10$M0gq4Pd8cQ1q4JX1nqHRKOZByZg2dA7rcXYlqthfLEMQuKFMfBaAG', 'user', '2025-04-16 05:10:14', NULL, NULL),
(26, 'zachy', 'zachy@live.com', '$2y$10$PQZmnCQDWREzY0grPvWnyuLiVO9AMEuVhrv2RuHP5sIAfp6x.gY7u', 'user', '2025-04-16 05:15:15', NULL, NULL),
(27, 'ethan', 'ethan@live.com', '$2y$10$z.L6iSfUSV.TOSXlOdIh1eN.lVfiFhoLf2qMGa3aawF9qFzR4zDd6', 'user', '2025-04-16 05:24:20', NULL, NULL),
(29, 'june', 'june@live.com', '$2y$10$oVBHmIw2BDBe1qIYfbiyDeIVWKW1.eyB2GOg/A/j9f010N5jRZ5x.', 'user', '2025-04-16 06:15:11', NULL, NULL),
(31, 'gayle', 'gayle@live.com', '$2y$10$mJOZpPhBvDJbLNPDTaOHkeO2/pqR4aoIHc/LX6x//.CJLwGHnesYi', 'user', '2025-04-16 06:42:03', NULL, NULL),
(33, 'kevin', 'kevin@live.com', '$2y$10$8t5KoPrzl8APH.wJfSXI5.v3uAmXiIh7HJeFXylB3bfJB.QAqWbQW', 'user', '2025-04-16 06:59:16', NULL, NULL),
(35, 'garry', 'garry@live.com', '$2y$10$T6yFuiaSerUFT9CBnyIbP.5NaBqUBQm7lBCS/TgwD0uhyJdoGDq7W', 'user', '2025-04-16 07:38:21', NULL, NULL),
(37, 'barry', 'barry@live.com', '$2y$10$2S/Q6oqKc88/BGyuYHDEeeMR5OqDXh0TIHmR/aacPAiXvM/DbYe22', 'user', '2025-04-16 13:07:15', NULL, NULL),
(39, 'nigel', 'nigel@live.com', '$2y$10$ezzhJWXMQYucyZKlL0dZjuL.gFlsXEzSYWuAgGxatUDTcdtpR8ZmG', 'user', '2025-04-16 13:52:27', NULL, NULL),
(41, 'stacy', 'stacy@live.com', '$2y$10$tbMLcjQK87Fz6phHPm7CoeEy3lFByGHzINRS6fIROIVnoVMrJ5WJO', 'user', '2025-04-16 14:12:33', NULL, NULL),
(42, 'brian', 'brain@live.com', '$2y$10$wUAAAsQH6Nmx3XwrA2jD..kPkEfpMAo1xnb88Bdzw6U/rvx8IUfA6', 'user', '2025-04-16 14:16:09', NULL, NULL),
(44, 'admin', 'admin@live.com', '$2y$10$I1e2e3nYgux8IBpqulJUo.OKhlIiMbkcv.H2r9eofuexbgNditn92', 'admin', '2025-04-16 16:06:23', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- Indexes for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=182;

--
-- AUTO_INCREMENT for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `borrowed_books`
--
ALTER TABLE `borrowed_books`
  ADD CONSTRAINT `borrowed_books_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `borrowed_books_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`);

--
-- Constraints for table `loans`
--
ALTER TABLE `loans`
  ADD CONSTRAINT `loans_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `loans_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
