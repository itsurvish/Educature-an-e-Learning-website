-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 08, 2019 at 12:06 AM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `my_educature`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `user_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`cart_id`, `active`, `user_user_id`) VALUES
(25, 1, 60),
(26, 1, 61);

-- --------------------------------------------------------

--
-- Table structure for table `cartitem`
--

CREATE TABLE `cartitem` (
  `cartitem_id` int(11) NOT NULL,
  `course_image` varchar(500) DEFAULT NULL,
  `course_name` varchar(45) NOT NULL,
  `course_price` double NOT NULL,
  `course_code` varchar(6) DEFAULT NULL,
  `cart_cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `coursecategory`
--

CREATE TABLE `coursecategory` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursecategory`
--

INSERT INTO `coursecategory` (`category_id`, `category_name`) VALUES
(1, 'Web development'),
(2, 'Bussiness'),
(3, 'Health Care'),
(4, 'Photography'),
(5, 'Marketing'),
(6, 'Music'),
(7, 'Academic'),
(8, 'Lifestyle'),
(9, 'Language'),
(10, 'It & Software'),
(11, 'Design');

-- --------------------------------------------------------

--
-- Table structure for table `coursedetail`
--

CREATE TABLE `coursedetail` (
  `course_detail_id` int(11) NOT NULL,
  `course_description` varchar(1000) NOT NULL,
  `course_duration` varchar(45) NOT NULL,
  `course_rating` varchar(45) NOT NULL,
  `course_image` varchar(1000) NOT NULL,
  `course_course_id` int(11) NOT NULL,
  `course_price` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `coursedetail`
--

INSERT INTO `coursedetail` (`course_detail_id`, `course_description`, `course_duration`, `course_rating`, `course_image`, `course_course_id`, `course_price`) VALUES
(95, 'Develop modern, complex, responsive and scalable web applications with Angular 8', '23:11', '4.5', 'angular.png', 104, 200),
(96, 'React is a library for building composable user interfaces. It encourages the creation of reusable UI components, which present data that changes over time.', '19:22', '4.5', 'cover-a1d5b40.png', 105, 149);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(45) NOT NULL,
  `course_code` varchar(6) DEFAULT NULL,
  `coursecategory_category_id` int(11) NOT NULL,
  `course_tag` varchar(45) NOT NULL,
  `enroll` tinyint(4) NOT NULL,
  `user_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `course_name`, `course_code`, `coursecategory_category_id`, `course_tag`, `enroll`, `user_user_id`) VALUES
(104, 'Angular', 'Bltv14', 1, 'Angular Tutorials', 0, 60),
(105, 'React', 'cgS0wK', 1, 'React Tutorials', 0, 60);

-- --------------------------------------------------------

--
-- Table structure for table `courses_has_cart`
--

CREATE TABLE `courses_has_cart` (
  `course_course_id` int(11) NOT NULL,
  `cart_cart_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `order_id` int(11) NOT NULL,
  `total_qty` int(11) NOT NULL,
  `user_user_id` int(11) NOT NULL,
  `payment_payment_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `total_qty`, `user_user_id`, `payment_payment_id`) VALUES
(1, 1, 60, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orderdetails`
--

CREATE TABLE `orderdetails` (
  `orderdetail_id` int(11) NOT NULL,
  `order_date` date NOT NULL,
  `course_name` varchar(45) NOT NULL,
  `course_price` double NOT NULL,
  `order_order_id` int(11) NOT NULL,
  `course_course_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL,
  `pay-code` varchar(6) DEFAULT NULL,
  `payment_amount` varchar(45) NOT NULL,
  `payment_status` varchar(45) NOT NULL,
  `payment_dated` date NOT NULL,
  `paymentmethod_paymenttype_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`payment_id`, `pay-code`, `payment_amount`, `payment_status`, `payment_dated`, `paymentmethod_paymenttype_id`) VALUES
(1, 'jXyaDO', '200', 'Paid', '2019-08-07', 4);

-- --------------------------------------------------------

--
-- Table structure for table `paymentmethod`
--

CREATE TABLE `paymentmethod` (
  `payment_id` int(11) NOT NULL,
  `payment_method` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `paymentmethod`
--

INSERT INTO `paymentmethod` (`payment_id`, `payment_method`) VALUES
(2, 'Visa'),
(3, 'MasterCard'),
(4, 'American Express');

-- --------------------------------------------------------

--
-- Table structure for table `payment_details`
--

CREATE TABLE `payment_details` (
  `paymentdetail_id` int(11) NOT NULL,
  `card_number` bigint(16) NOT NULL,
  `card_name` varchar(45) NOT NULL,
  `expiry_date` date NOT NULL,
  `country` varchar(45) NOT NULL,
  `verification_code` int(11) NOT NULL,
  `payment_payment_id` int(11) NOT NULL,
  `user_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_details`
--

INSERT INTO `payment_details` (`paymentdetail_id`, `card_number`, `card_name`, `expiry_date`, `country`, `verification_code`, `payment_payment_id`, `user_user_id`) VALUES
(1, 371795123891000, 'Rutu', '2019-08-15', 'AU', 123, 1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `role_description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`, `role_description`) VALUES
(1, 'Instructor', 'Tutors'),
(2, 'User', 'Students');

-- --------------------------------------------------------

--
-- Table structure for table `userdesignation`
--

CREATE TABLE `userdesignation` (
  `designation_id` int(11) NOT NULL,
  `designation_title` varchar(50) NOT NULL,
  `designation_description` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdesignation`
--

INSERT INTO `userdesignation` (`designation_id`, `designation_title`, `designation_description`) VALUES
(1, 'Web Developer', 'There was a painful and uncontrollable squeaking mixed in with it, the words could be made out at first but then there was a sort of echo which made them unclear, leaving the hearer unsure whether he had heard properly or not.'),
(2, 'Business Professor', 'There was a painful and uncontrollable squeaking mixed in with it, the words could be made out at first but then there was a sort of echo which made them unclear, leaving the hearer unsure whether he had heard properly or not.');

-- --------------------------------------------------------

--
-- Table structure for table `userdesignation_has_user`
--

CREATE TABLE `userdesignation_has_user` (
  `UserDesignation_designation` int(11) NOT NULL,
  `user_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdesignation_has_user`
--

INSERT INTO `userdesignation_has_user` (`UserDesignation_designation`, `user_user_id`) VALUES
(1, 60);

-- --------------------------------------------------------

--
-- Table structure for table `userdetails`
--

CREATE TABLE `userdetails` (
  `user_detail_id` int(11) NOT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `image` varchar(500) DEFAULT NULL,
  `facebook_link` varchar(50) DEFAULT NULL,
  `linkedin_link` varchar(50) DEFAULT NULL,
  `github_link` varchar(50) DEFAULT NULL,
  `user_user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `userdetails`
--

INSERT INTO `userdetails` (`user_detail_id`, `first_name`, `last_name`, `image`, `facebook_link`, `linkedin_link`, `github_link`, `user_user_id`) VALUES
(40, 'Urvish', 'Mahant', 'um.jfif', 'https://www.facebook.com/', 'https://ca.linkedin.com/', 'https://github.com/', 60),
(41, 'Rutu', 'Patel', '1.jpg', NULL, NULL, NULL, 61);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(50) NOT NULL,
  `user_email` varchar(50) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `role_role_id` int(11) NOT NULL,
  `verification_key` varchar(50) NOT NULL,
  `is_verified` tinyint(11) NOT NULL,
  `date_created` date NOT NULL,
  `is_active` tinyint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `user_email`, `user_password`, `role_role_id`, `verification_key`, `is_verified`, `date_created`, `is_active`) VALUES
(60, 'Urvish', 'umahant101@gmail.com', 'Uu123456', 1, ')AwQ7btXd0', 1, '2019-08-07', 1),
(61, 'Rutu', 'patelrutu1203@gmail.com', 'Rutu@123', 2, 'IazQ5l42i3', 1, '2019-08-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `video_name` varchar(300) NOT NULL,
  `video_duration` varchar(45) NOT NULL,
  `video_link` varchar(10000) NOT NULL,
  `coursedetail_course_detail_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `video_name`, `video_duration`, `video_link`, `coursedetail_course_detail_id`) VALUES
(1, 'Angular1', '', 'angular1.mp4', 95),
(2, 'Angular2', '', 'angular2.mp4', 95),
(3, 'Angular3', '', 'angular3.mp4', 95),
(4, 'Angular4', '', 'angular4.mp4', 95),
(6, 'React1', '', 'ReactJS Tutorial - 1 - Introduction.mp4', 96),
(7, 'React2', '', 'ReactJS Tutorial - 2 - Hello World.mp4', 96),
(8, 'React3', '', 'ReactJS Tutorial - 3 - Folder Structure.mp4', 96),
(9, 'React4', '', 'ReactJS Tutorial - 4 - Components.mp4', 96),
(10, 'React5', '', 'ReactJS Tutorial - 5 - Functional Components.mp4', 96),
(14, 'Angular5', '', 'angular5.mp4', 95);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `cart_ibfk_1` (`user_user_id`);

--
-- Indexes for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD PRIMARY KEY (`cartitem_id`),
  ADD KEY `cart_cart_id` (`cart_cart_id`);

--
-- Indexes for table `coursecategory`
--
ALTER TABLE `coursecategory`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `coursedetail`
--
ALTER TABLE `coursedetail`
  ADD PRIMARY KEY (`course_detail_id`),
  ADD KEY `course_course_id` (`course_course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`),
  ADD KEY `coursecategory_category_id` (`coursecategory_category_id`),
  ADD KEY `user_user_id` (`user_user_id`);

--
-- Indexes for table `courses_has_cart`
--
ALTER TABLE `courses_has_cart`
  ADD KEY `course_course_id` (`course_course_id`),
  ADD KEY `cart_cart_id` (`cart_cart_id`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `payment_payment_id` (`payment_payment_id`),
  ADD KEY `user_user_id` (`user_user_id`);

--
-- Indexes for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD PRIMARY KEY (`orderdetail_id`),
  ADD KEY `order_order_id` (`order_order_id`),
  ADD KEY `course_course_id` (`course_course_id`);

--
-- Indexes for table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`payment_id`),
  ADD KEY `paymentmethod_paymenttype_id` (`paymentmethod_paymenttype_id`);

--
-- Indexes for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD PRIMARY KEY (`paymentdetail_id`),
  ADD KEY `payment_payment_id` (`payment_payment_id`),
  ADD KEY `user_user_id` (`user_user_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `userdesignation`
--
ALTER TABLE `userdesignation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `userdesignation_has_user`
--
ALTER TABLE `userdesignation_has_user`
  ADD KEY `UserDesignation_designation` (`UserDesignation_designation`),
  ADD KEY `user_user_id` (`user_user_id`);

--
-- Indexes for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD PRIMARY KEY (`user_detail_id`),
  ADD KEY `user_user_id` (`user_user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `role_role_id` (`role_role_id`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`),
  ADD KEY `coursedetail_course_detail_id` (`coursedetail_course_detail_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `cartitem`
--
ALTER TABLE `cartitem`
  MODIFY `cartitem_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `coursecategory`
--
ALTER TABLE `coursecategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `coursedetail`
--
ALTER TABLE `coursedetail`
  MODIFY `course_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `orderdetails`
--
ALTER TABLE `orderdetails`
  MODIFY `orderdetail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment`
--
ALTER TABLE `payment`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `paymentmethod`
--
ALTER TABLE `paymentmethod`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_details`
--
ALTER TABLE `payment_details`
  MODIFY `paymentdetail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdesignation`
--
ALTER TABLE `userdesignation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `userdetails`
--
ALTER TABLE `userdetails`
  MODIFY `user_detail_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `cartitem`
--
ALTER TABLE `cartitem`
  ADD CONSTRAINT `cartitem_ibfk_1` FOREIGN KEY (`cart_cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `coursedetail`
--
ALTER TABLE `coursedetail`
  ADD CONSTRAINT `coursedetail_ibfk_1` FOREIGN KEY (`course_course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses`
--
ALTER TABLE `courses`
  ADD CONSTRAINT `courses_ibfk_1` FOREIGN KEY (`coursecategory_category_id`) REFERENCES `coursecategory` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_ibfk_2` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `courses_has_cart`
--
ALTER TABLE `courses_has_cart`
  ADD CONSTRAINT `courses_has_cart_ibfk_1` FOREIGN KEY (`course_course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `courses_has_cart_ibfk_2` FOREIGN KEY (`cart_cart_id`) REFERENCES `cart` (`cart_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order`
--
ALTER TABLE `order`
  ADD CONSTRAINT `order_ibfk_1` FOREIGN KEY (`payment_payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_ibfk_2` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orderdetails`
--
ALTER TABLE `orderdetails`
  ADD CONSTRAINT `orderdetails_ibfk_1` FOREIGN KEY (`order_order_id`) REFERENCES `order` (`order_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `orderdetails_ibfk_2` FOREIGN KEY (`course_course_id`) REFERENCES `courses` (`course_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`paymentmethod_paymenttype_id`) REFERENCES `paymentmethod` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payment_details`
--
ALTER TABLE `payment_details`
  ADD CONSTRAINT `payment_details_ibfk_1` FOREIGN KEY (`payment_payment_id`) REFERENCES `payment` (`payment_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `payment_details_ibfk_2` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userdesignation_has_user`
--
ALTER TABLE `userdesignation_has_user`
  ADD CONSTRAINT `userdesignation_has_user_ibfk_1` FOREIGN KEY (`UserDesignation_designation`) REFERENCES `userdesignation` (`designation_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `userdesignation_has_user_ibfk_2` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `userdetails`
--
ALTER TABLE `userdetails`
  ADD CONSTRAINT `userdetails_ibfk_1` FOREIGN KEY (`user_user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_role_id`) REFERENCES `role` (`role_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `video`
--
ALTER TABLE `video`
  ADD CONSTRAINT `video_ibfk_1` FOREIGN KEY (`coursedetail_course_detail_id`) REFERENCES `coursedetail` (`course_detail_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
