-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 16, 2017 at 11:31 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id922837_Group8`
--

-- --------------------------------------------------------

--
-- Table structure for table `major_subjects`
--

CREATE TABLE `major_subjects` (
  `subject_id` int(11) NOT NULL COMMENT ' holds the unique id number of each subject   ',
  `subject_name` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'name of each subject.'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `major_subjects`
--

INSERT INTO `major_subjects` (`subject_id`, `subject_name`) VALUES
(1, 'Computer Science'),
(2, 'Chemistry'),
(3, 'Engineering'),
(4, 'Physics');

-- --------------------------------------------------------

--
-- Table structure for table `status`
--

CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `status` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `status`
--

INSERT INTO `status` (`status_id`, `status`) VALUES
(1, 'Unclaimed'),
(2, 'Claimed'),
(3, 'Flagged');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

CREATE TABLE `tags` (
  `tag_id` int(11) NOT NULL,
  `text` varchar(16) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`tag_id`, `text`) VALUES
(1, 'test'),
(2, 'cs-4014'),
(3, 'ee4013'),
(4, 'test'),
(5, ''),
(6, 'testTag2'),
(7, 'second test tag '),
(8, 'second test tag '),
(9, 'test tag v.2'),
(10, 'test tag v.3'),
(11, 'test tag v.4'),
(12, 'science'),
(13, 'stuff'),
(14, 'sciency stuff'),
(15, 'top secret algeb');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `text_description` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `task_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Attached_files` blob NOT NULL,
  `no_of_pages` int(11) NOT NULL,
  `no_of_words` int(11) NOT NULL,
  `Deadline` datetime NOT NULL,
  `claim_by_date` datetime NOT NULL,
  `file_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tag_1` int(11) DEFAULT NULL,
  `tag_2` int(11) DEFAULT NULL,
  `tag_3` int(11) DEFAULT NULL,
  `tag_4` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='table with all the details of the table key';

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`task_id`, `user_id`, `title`, `text_description`, `task_type`, `Attached_files`, `no_of_pages`, `no_of_words`, `Deadline`, `claim_by_date`, `file_type`, `tag_1`, `tag_2`, `tag_3`, `tag_4`) VALUES
(11, 1, 'dsg', 'kjhgasdf', 'kjhfs', 0x756669756766, 3, 2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '.docs', 2, 3, 3, 4),
(13, 1, '$TaskTitle', '$Description', '$TaskType', 0x2453616d706c6546696c65, 3, 4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '$FileType', 1, 2, 3, 4);

-- --------------------------------------------------------

--
-- Table structure for table `taskStatus`
--

CREATE TABLE `taskStatus` (
  `taskStatus_id` int(11) NOT NULL,
  `status_id` int(11) NOT NULL,
  `claim_id` int(11) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_claims`
--

CREATE TABLE `task_claims` (
  `claim_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL COMMENT ' unique id number for every user .',
  `first_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'first name of the user',
  `last_name` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'last name of the user ',
  `student/staff_id` int(10) NOT NULL COMMENT 'id number of the student or staff member',
  `email` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'email of the user',
  `subject_id` int(11) NOT NULL COMMENT ' foreign key linking to a set table of predefined major_subjects ',
  `password` varchar(16) COLLATE utf8_unicode_ci NOT NULL COMMENT 'password of user',
  `reputation_score` int(11) NOT NULL COMMENT 'reputation score of the user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Table containing all the details of users in the systems';

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `first_name`, `last_name`, `student/staff_id`, `email`, `subject_id`, `password`, `reputation_score`) VALUES
(1, 'William', 'Leary', 15155528, 'willoleary6@gmail.com', 1, 'AaronIsABadger', 0),
(2, 'John', 'bloggs', 133984934, 'jbloggs@gmail.com', 1, 'Fuckyouaaron', 0),
(3, 'Michael ', 'ralp', 46545845, 'mralp@gmail.com', 1, 'ftthtfyt', 0),
(4, 'Michael ', 'ralphes', 46545845, 'yojhk@gmail.com', 1, 'ygygfy', 0),
(5, 'Michael ', 'ralphes', 46545845, 'fgdf@gmail.com', 1, 'jhgjh', 0),
(9, 'sds', 'wdw', 54545, 'dfdf@gmail.com', 2, 'dsdsd', 0),
(13, 'john', 'df', 15, 'gfkgj@gmail.com', 2, 'dfjdj', 0),
(15, 'dfdk', 'efe', 5, 'gdd@gmail.com', 1, 'ferfe', 0),
(16, 'wdw', 'sds', 2332, 'fdf@gmail.com', 2, 'dfd', 0),
(17, 'sds', 'fdd', 2147483647, 'sds@gmail.com', 2, 'ssfd', 0),
(18, 'efas', 'swdw', 2147483647, 'ss@gmail.com', 1, 'Willis', 0),
(19, 'dfdf', 'dfd', 2, 'dfd@hmail.com', 2, '', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `major_subjects`
--
ALTER TABLE `major_subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `status`
--
ALTER TABLE `status`
  ADD PRIMARY KEY (`status_id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
  ADD PRIMARY KEY (`tag_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`task_id`),
  ADD KEY `tag1` (`tag_1`),
  ADD KEY `tag2` (`tag_2`),
  ADD KEY `tag3` (`tag_3`),
  ADD KEY `tag4` (`tag_4`),
  ADD KEY `link to user` (`user_id`);

--
-- Indexes for table `taskStatus`
--
ALTER TABLE `taskStatus`
  ADD PRIMARY KEY (`taskStatus_id`),
  ADD KEY `link to claim` (`claim_id`),
  ADD KEY `link to status` (`status_id`);

--
-- Indexes for table `task_claims`
--
ALTER TABLE `task_claims`
  ADD PRIMARY KEY (`claim_id`),
  ADD KEY `link to task` (`task_id`),
  ADD KEY `link to claimant` (`user_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `subject_id` (`subject_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `major_subjects`
--
ALTER TABLE `major_subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' holds the unique id number of each subject   ', AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `status`
--
ALTER TABLE `status`
  MODIFY `status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
  MODIFY `tag_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `task_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `taskStatus`
--
ALTER TABLE `taskStatus`
  MODIFY `taskStatus_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_claims`
--
ALTER TABLE `task_claims`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT ' unique id number for every user .', AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `link to user` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`),
  ADD CONSTRAINT `tag1` FOREIGN KEY (`tag_1`) REFERENCES `tags` (`tag_id`),
  ADD CONSTRAINT `tag2` FOREIGN KEY (`tag_2`) REFERENCES `tags` (`tag_id`),
  ADD CONSTRAINT `tag3` FOREIGN KEY (`tag_3`) REFERENCES `tags` (`tag_id`),
  ADD CONSTRAINT `tag4` FOREIGN KEY (`tag_4`) REFERENCES `tags` (`tag_id`);

--
-- Constraints for table `taskStatus`
--
ALTER TABLE `taskStatus`
  ADD CONSTRAINT `link to claim` FOREIGN KEY (`claim_id`) REFERENCES `task_claims` (`claim_id`),
  ADD CONSTRAINT `link to status` FOREIGN KEY (`status_id`) REFERENCES `status` (`status_id`);

--
-- Constraints for table `task_claims`
--
ALTER TABLE `task_claims`
  ADD CONSTRAINT `link to claimant` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`),
  ADD CONSTRAINT `link to task` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`task_id`);

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `link_between_user_details_and_major_subjects` FOREIGN KEY (`subject_id`) REFERENCES `major_subjects` (`subject_id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
