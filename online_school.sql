-- phpMyAdmin SQL Dump
-- version 3.4.11.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 30, 2013 at 08:07 PM
-- Server version: 5.5.29
-- PHP Version: 5.4.6-1ubuntu1.2

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `online_school`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `last_log_date` date NOT NULL,
  `time` time NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `first_name`, `last_name`, `username`, `password`, `email`, `last_log_date`, `time`) VALUES
(1, 'Nabil', 'Ahmad', 'nabil', 'nabil', 'nabilahmad86@yahoo.com', '2013-04-28', '00:26:15'),
(2, 'Niloy', 'Banik', 'niloy', 'niloy', 'niloy_cste@gmail.com', '2013-04-13', '17:43:23');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `Category_id` int(11) NOT NULL AUTO_INCREMENT,
  `Category_name` varchar(255) NOT NULL,
  `Category_desc` text NOT NULL,
  PRIMARY KEY (`Category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`Category_id`, `Category_name`, `Category_desc`) VALUES
(1, 'Programming', 'Here we represents basic of several programming language'),
(2, 'Database', 'This section made database learners novice to expert.'),
(3, 'Server', 'There''s several server is in the field. Which one is appropriate for your environment and how to handle them...learn from this section.'),
(4, 'Installation', 'Request in our forum if you have any installation problem, but we have already provide most common program''s installation process which are normally make you sufferer.'),
(5, 'Troubleshooting', 'Common problem happens in your machine.');

-- --------------------------------------------------------

--
-- Table structure for table `forum_comment`
--

CREATE TABLE IF NOT EXISTS `forum_comment` (
  `post_id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `user` int(11) NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `forum_comment`
--

INSERT INTO `forum_comment` (`post_id`, `comment_id`, `comment`, `date`, `user`) VALUES
(3, 4, 'Read OOP section from PHP Manuel. Then buy a book and try some coding. Its fun.<br>', '2013-04-27 14:33:48', 35),
(0, 6, 'Try out something', '2013-04-27 16:03:40', 4),
(7, 7, 'Try yourself and find yourself', '2013-04-27 16:04:35', 4);

-- --------------------------------------------------------

--
-- Table structure for table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `user_id` int(11) NOT NULL,
  `Subcategory_id` varchar(11) NOT NULL,
  `post_id` int(11) NOT NULL AUTO_INCREMENT,
  `post_title` varchar(255) NOT NULL,
  `post` text NOT NULL,
  `views` int(11) NOT NULL,
  `time` datetime NOT NULL,
  PRIMARY KEY (`post_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `forum_topic`
--

INSERT INTO `forum_topic` (`user_id`, `Subcategory_id`, `post_id`, `post_title`, `post`, `views`, `time`) VALUES
(3, '2.1', 4, 'Problem with PHPmyadmin', 'Recently I had installed mysql. It works fine but i do not get phpmyadmin with it? How to solve this problem', 15, '2012-12-01 20:48:29'),
(4, '1.5', 3, 'PHP OOP', 'I am a developer on php. But I don''t get in touch with OOP. It looks to me kinda complex and furious. How can i possible learn PHP OOP features?', 15, '2013-04-04 23:21:42'),
(35, '1.3', 10, 'Java vs C#', 'Which is good? Java or C#?<br>', 1, '2013-04-27 14:29:57'),
(35, '2.2', 7, 'Detail about oracle', 'What is the pros and cons of <u>Oracle</u> server? And what is the difference between it and <b>MySQL</b> server?<br>', 23, '2013-04-27 14:09:53');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `exam_id` varchar(255) NOT NULL,
  `ques_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ques_title` text NOT NULL,
  `answer` varchar(255) NOT NULL,
  PRIMARY KEY (`ques_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`exam_id`, `ques_id`, `ques_title`, `answer`) VALUES
('15b', 1, 'Which is the php tag?', 'op-1.1'),
('15b', 2, 'What is php''s nature?', 'op-2.2'),
('15b', 3, 'What is the meaning of php ?', 'op-3.3'),
('15b', 4, 'Is php?', 'op-4.1'),
('22b', 5, 'Hmmm', 'op-5.2');

-- --------------------------------------------------------

--
-- Table structure for table `questions_options`
--

CREATE TABLE IF NOT EXISTS `questions_options` (
  `ques_id` int(11) NOT NULL,
  `option_id` varchar(255) NOT NULL,
  `options` text NOT NULL,
  PRIMARY KEY (`option_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `questions_options`
--

INSERT INTO `questions_options` (`ques_id`, `option_id`, `options`) VALUES
(1, 'op-1.1', '&#60;&#63;'),
(1, 'op-1.2', '>'),
(1, 'op-1.3', '<--'),
(1, 'op-1.4', '??'),
(2, 'op-2.1', 'Client-side'),
(2, 'op-2.2', 'Server-Side'),
(2, 'op-2.3', 'Both'),
(2, 'op-2.4', 'None'),
(3, 'op-3.1', 'Pre Hesitated Programmer'),
(3, 'op-3.2', 'Per Hour Programming'),
(3, 'op-3.3', 'Hypertext Preprocessor'),
(3, 'op-3.4', 'Nothing'),
(4, 'op-4.1', 'Open Sourece'),
(4, 'op-4.2', 'Close Source'),
(4, 'op-4.3', 'Both'),
(4, 'op-4.4', 'None'),
(5, 'op-5.1', 'oooop1'),
(5, 'op-5.2', 'oooop2'),
(5, 'op-5.3', 'oooop3'),
(5, 'op-5.4', 'oooop4');

-- --------------------------------------------------------

--
-- Table structure for table `result_archive`
--

CREATE TABLE IF NOT EXISTS `result_archive` (
  `sl` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `exam_id` varchar(255) NOT NULL,
  `total_marks` int(11) NOT NULL,
  `obtained_marks` int(11) NOT NULL,
  `date_of_exam` date NOT NULL,
  PRIMARY KEY (`sl`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `result_archive`
--

INSERT INTO `result_archive` (`sl`, `user_id`, `exam_id`, `total_marks`, `obtained_marks`, `date_of_exam`) VALUES
(1, 3, '15b', 4, 4, '2012-02-07'),
(2, 4, '15b', 4, 1, '2012-10-24'),
(3, 4, '15b', 4, 4, '2013-02-28'),
(5, 3, '15b', 4, 3, '2013-04-23'),
(9, 35, '15b', 4, 2, '2013-04-27');

-- --------------------------------------------------------

--
-- Table structure for table `subcategory`
--

CREATE TABLE IF NOT EXISTS `subcategory` (
  `Category_id` int(11) NOT NULL,
  `Subcategory_id` varchar(255) NOT NULL,
  `Subcategory_name` text NOT NULL,
  `meta` text NOT NULL,
  PRIMARY KEY (`Subcategory_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subcategory`
--

INSERT INTO `subcategory` (`Category_id`, `Subcategory_id`, `Subcategory_name`, `meta`) VALUES
(1, '1.2', 'C++', 'For a newbie it is best to learn OOP.'),
(1, '1.3', 'JAVA', 'Simply awesome ... Most popular language.'),
(1, '1.4', 'C#', 'Alternative language of JAVA.'),
(1, '1.5', 'PHP', 'One of the best web languages existed yet.'),
(1, '1.6', 'HTML', 'Brick of a web page.'),
(1, '1.7', 'Javascript', 'Make web development more effective and sharp.'),
(1, '1.8', 'HTML5', 'New standard version of HTML.'),
(1, '1.9', 'CSS3', 'New standard version of CSS.'),
(2, '2.1', 'MySQL', 'Most popular database management system.'),
(2, '2.2', 'Oracle', 'Another awesome DBMS. Best use for desktop development.'),
(2, '2.3', 'SQL Server', 'Mostly use with MS visual studio.'),
(3, '3.1', 'Apache', 'If you work with PHP and MySQL, it is the best matching server for your PC.'),
(3, '3.2', 'Nginx', 'Faster than Apache. And efficient. '),
(3, '3.3', 'IIS', 'ASP.NET developers need it.'),
(4, '4.1', 'OS', 'Operating system is the life of a computer.'),
(4, '4.2', 'CMS', 'Content management system makes our life easy.'),
(4, '4.3', 'Server', 'It is more harder to maintain than learning. Just focus...'),
(5, '5.1', 'Linux', 'God bless you Linux.'),
(5, '5.2', 'Windows', 'May be you bookmarked this section always.');

-- --------------------------------------------------------

--
-- Table structure for table `tuto`
--

CREATE TABLE IF NOT EXISTS `tuto` (
  `Subcategory_id` varchar(255) NOT NULL,
  `Tuto_id` varchar(255) NOT NULL,
  `Tuto_title` text NOT NULL,
  `Writer` text NOT NULL,
  `Tuto_desc` text NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`Tuto_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tuto`
--

INSERT INTO `tuto` (`Subcategory_id`, `Tuto_id`, `Tuto_title`, `Writer`, `Tuto_desc`, `date`) VALUES
('2.1', '2.1.1', 'Install_MySQL.php', 'nitro121', 'Individual MySQL installation', '2013-01-02'),
('2.1', '2.1.2', 'Install_MySQL_cmd.php', 'nitro121', 'MySQL command promt', '2012-12-10'),
('2.1', '2.1.3', 'Installing_phpMyAdmin.php', 'BotMaster', 'PHPMyAdmin', '2013-02-21'),
('3.1', '3.1.1', 'Install_Apache.php', 'BotMaster', 'Individual Apache installation', '2013-03-01');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `date_of_birth` varchar(255) NOT NULL,
  `e_mail` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `log_in_time` datetime NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `first_name`, `last_name`, `user_name`, `date_of_birth`, `e_mail`, `country`, `password`, `log_in_time`) VALUES
(3, 'cste', 'rocks', 'cste', '1993-02-02', 'cste@nstu.com', 'Canada', 'cste', '2013-04-13 17:48:53'),
(4, 'nabil', 'ahmad', 'nabil123', '1988-07-15', 'nabil@cste.com', 'Bangladesh', 'nabil', '2013-04-27 15:33:58'),
(35, 'Big', 'boss', 'BotMaster', '1996-04-04', 'BotMaster@nstu.com', 'Bangladesh', 'botmaster', '2013-04-27 14:49:51');

-- --------------------------------------------------------

--
-- Table structure for table `video_links`
--

CREATE TABLE IF NOT EXISTS `video_links` (
  `Subcategory_id` varchar(255) NOT NULL,
  `List_id` varchar(255) NOT NULL,
  `List_title` text NOT NULL,
  `Link_desc` text NOT NULL,
  `views` int(11) NOT NULL,
  `time_since_post` varchar(255) NOT NULL,
  PRIMARY KEY (`List_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `video_links`
--

INSERT INTO `video_links` (`Subcategory_id`, `List_id`, `List_title`, `Link_desc`, `views`, `time_since_post`) VALUES
('1.5', '1.5.1', 'Introduction', '', 5, '1366163463'),
('1.5', '1.5.10', 'Concatenation', '', 0, '1365172881'),
('1.5', '1.5.11', ' If If Else Statement', '', 0, '1365173247'),
('1.5', '1.5.12', 'Arithmetic Operators', '', 3, '1365173265 	'),
('1.5', '1.5.13', 'Triple Equals', '', 0, '1365173439'),
('1.5', '1.5.14', 'Do While Loop', '', 1, '1365173790'),
('1.5', '1.5.15', 'For Loop', '', 0, '1365173281'),
('1.5', '1.5.16', 'Die And Exit Functions', '', 0, '1366163425'),
('1.5', '1.5.17', 'Functions With Arguments', '', 0, '1366162779 	'),
('1.5', '1.5.18', 'Global Variables', '', 0, '1366162889'),
('1.5', '1.5.19', 'Introduction To Arrays', '', 0, '1366163180'),
('1.5', '1.5.2', 'Creating First Php File', '', 5, '1366162823'),
('1.5', '1.5.20', 'Multi-dimensional Arrays', '', 0, '1366163142'),
('1.5', '1.5.21', 'For Each Statement', '', 0, '1366163142'),
('1.5', '1.5.22', 'Include & Require ', '', 1, '1366163162'),
('1.5', '1.5.23', 'Include & Require Once', '', 0, '1366162877'),
('1.5', '1.5.24', 'Expression Matching', '', 0, '1366163257'),
('1.5', '1.5.25', 'String Conversion', '', 0, '1366163540 	'),
('1.5', '1.5.26', ' String Replacing', '', 0, '1366162861'),
('1.5', '1.5.3', 'Writing First Php File', '', 3, '1366163104'),
('1.5', '1.5.4', 'The Phpinfo Function', '', 2, '1366163066'),
('1.5', '1.5.5', 'The Php.ini File', '', 0, '1366162823'),
('1.5', '1.5.6', 'Echo', '', 0, '1366162942'),
('1.5', '1.5.7', 'Embedding Php Inside Html', '', 0, '1365175675'),
('1.5', '1.5.8', 'Error Reporting', '', 1, '1366163085'),
('1.5', '1.5.9', 'Variables', '', 0, '1365173307');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
