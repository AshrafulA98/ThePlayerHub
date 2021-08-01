-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2021 at 04:07 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `theplayerhub`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(255) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_desc` varchar(255) NOT NULL,
  `time_stamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_desc`, `time_stamp`) VALUES
(101, 'HTML', 'The HyperText Markup Language, or HTML is the standard markup language for documents designed to be displayed in a web browser. It can be assisted by technologies such as Cascading Style Sheets and scripting languages such as JavaScript', '2021-07-21 20:14:06'),
(102, 'CSS', 'Cascading Style Sheets is a style sheet language used for describing the presentation of a document written in a markup language such as HTML. CSS is a cornerstone technology of the World Wide Web, alongside HTML and JavaScript.', '2021-07-21 20:14:27'),
(103, 'JavaScript', 'JavaScript, often abbreviated as JS, is a programming language that conforms to the ECMAScript specification. JavaScript is high-level, often just-in-time compiled, and multi-paradigm. It has curly-bracket syntax, dynamic typing, prototype-based object-or', '2021-07-21 20:14:49'),
(104, 'PHP', 'PHP is a general-purpose scripting language geared towards web development. It was originally created by Danish-Canadian programmer Rasmus Lerdorf in 1994. The PHP reference implementation is now produced by The PHP Group', '2021-07-21 20:15:08'),
(105, 'Laravel', 'Laravel 8 is now released and includes many new features including Laravel Jetstream, a models directory, model factory classes, migration squashing, rate-limiting improvements, time testing helpers, dynamic blade components, and many more features', '2021-07-24 20:27:01'),
(106, 'AngularJS', 'AngularJS is a JavaScript-based open-source front-end web framework for developing single-page applications. It is maintained mainly by Google and a community of individuals and corporations', '2021-07-24 20:27:01');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(255) NOT NULL,
  `comments_content` text NOT NULL,
  `therad_id` int(255) NOT NULL,
  `comments_by` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comments_content`, `therad_id`, `comments_by`, `time`) VALUES
(1104, 'Fuck you', 1010, '11029', '2021-07-28 22:17:15'),
(1107, 'Fuck you too!', 1010, '11029', '2021-07-31 23:18:57');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `contact_id` int(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `choice` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contact_id`, `username`, `email`, `mobile`, `choice`, `message`, `time`) VALUES
(5501, 'Ashraf', '+601139275791', 'alamshihab526@gmail.com', 'Web Development,Back-End Development with Php,', 'My next goal is to be a full stack web developer.', '2021-07-25 13:47:20'),
(5503, 'Ashraful Alam Shihab', '+601139275791', 'jack.office.my@gmail.com', 'Web Development,Java Programming,Back-End Development with Php,', 'INSHALLAH I will stat my WFH soon', '2021-07-29 18:54:49');

-- --------------------------------------------------------

--
-- Table structure for table `therads`
--

CREATE TABLE `therads` (
  `therad_id` int(255) NOT NULL,
  `therad_title` varchar(255) NOT NULL,
  `therad_desc` text NOT NULL,
  `therad_cate_id` int(255) DEFAULT NULL,
  `therad_user_id` int(255) NOT NULL,
  `timestamp` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `therads`
--

INSERT INTO `therads` (`therad_id`, `therad_title`, `therad_desc`, `therad_cate_id`, `therad_user_id`, `timestamp`) VALUES
(1010, 'What is HTML', 'Anyone please explain what is html\r\n', 101, 11029, '2021-07-28 22:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(255) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `user_email` varchar(45) NOT NULL,
  `contact` varchar(29) NOT NULL,
  `password` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `acc_status` varchar(255) NOT NULL,
  `time` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `contact`, `password`, `token`, `acc_status`, `time`) VALUES
(11029, 'Ashraful Alam Shihab', 'jack.office.my@gmail.com', '+601139275791', '$2y$10$9JgSt7qwbUkyciTYh46MaOasQY7V/Go4Pk1XUqZjIN.GrAuxfwawS', '2d323209fdc01d3c85632864cd6768', 'active', '2021-07-28 22:14:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `therads`
--
ALTER TABLE `therads`
  ADD PRIMARY KEY (`therad_id`);
ALTER TABLE `therads` ADD FULLTEXT KEY `therad_title` (`therad_title`,`therad_desc`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1108;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `contact_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5504;

--
-- AUTO_INCREMENT for table `therads`
--
ALTER TABLE `therads`
  MODIFY `therad_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1012;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11030;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
