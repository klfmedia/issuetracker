-- phpMyAdmin SQL Dump
-- version 3.4.10.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 20, 2017 at 06:24 PM
-- Server version: 5.5.20
-- PHP Version: 5.3.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `issue_tracker`
--

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `attachment_id` int(11) NOT NULL AUTO_INCREMENT,
  `attachment_name` varchar(50) NOT NULL DEFAULT 'issue.jpg',
  `issue_id` int(11) NOT NULL,
  PRIMARY KEY (`attachment_id`),
  KEY `issue_id` (`issue_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`attachment_id`, `attachment_name`, `issue_id`) VALUES
(1, 'badtap2.jpg', 22),
(2, 'badtap.jpg', 12),
(3, 'issue.jpg', 1),
(5, 'issue.jpg', 26),
(8, 'bulb1.jpg', 2),
(15, 'issue.jpg', 20),
(20, 'issue.jpg', 37),
(42, 'brokenwindow2.jpg', 65),
(43, 'issue.jpg', 66);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `department_id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(50) NOT NULL,
  PRIMARY KEY (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`department_id`, `department_name`) VALUES
(1, 'accounting'),
(2, 'management'),
(3, 'customer service'),
(4, 'marketing'),
(5, 'administration'),
(6, 'sales'),
(7, 'developers'),
(8, 'logistics');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE IF NOT EXISTS `employees` (
  `employee_id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `employee_number` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `department_id` int(11) NOT NULL,
  `employee_type` varchar(50) NOT NULL,
  `photo` varchar(50) NOT NULL DEFAULT 'staff.png',
  `employee_status` varchar(50) NOT NULL DEFAULT 'active',
  PRIMARY KEY (`employee_id`),
  UNIQUE KEY `employee_number` (`employee_number`),
  KEY `department_id` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=22 ;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`employee_id`, `first_name`, `last_name`, `email`, `employee_number`, `password`, `phone`, `department_id`, `employee_type`, `photo`, `employee_status`) VALUES
(6, 'Edie', 'Ajebe', 'edie@klf.com', 'klfed2016', 'internedie', '5142223333', 7, 'intern', 'back1.jpg', 'active'),
(7, ' Sandro', 'Mezzacappa', 'sandro@klfmedia.com', 'klfsa2000', 'issueAdmin', '514-222-7904', 4, 'administration', 'sandropic.jpg', 'active'),
(8, '  Geraldine', 'Agbor', 'geraldinea.klf@gmail.com', 'klfge2016', 'interngeri', '514-444-3336', 7, 'intern', 'geripic.jpg', 'active'),
(11, 'johnny', 'smith', 'jsmith@klf.com', 'klfjo2011', 'juniorjo', '514-222-4444', 1, 'staff', 'jsmith.jpg', 'inactive'),
(12, 'Francois', 'Fortier', 'ffortier@klfmedia.com', 'klffr2000', 'adminfort', '514-444-3333', 2, 'boss', 'fortierpic.jpg', 'active'),
(13, 'eddie', 'murphy', 'emurphy@klf.com', 'klfem2017', 'funny', '514-222-3333', 3, 'junior staff', 'eddie.jpg', 'active'),
(15, 'gina', 'radu', 'gradu@klf.com', 'klfgi2009', 'hr', '514-222-7777', 3, 'staff', 'ginapic.jpg', 'inactive'),
(16, 'luis andres', 'cordonas', 'luis@yahoo.com', 'klfla2016', 'luis', '514-666-7777', 7, 'intern', 'luispic.jpg', 'active'),
(21, 'nicolas', 'huet', 'nhuet@klf.com', 'klfni2002', '1234', '(438)-111-2222', 4, 'staff', 'nicolas.jpg', 'active');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE IF NOT EXISTS `issues` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `employee_id` int(11) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'pending',
  `priority` varchar(50) NOT NULL,
  PRIMARY KEY (`issue_id`),
  KEY `employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=67 ;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`issue_id`, `issue_name`, `location`, `description`, `employee_id`, `status`, `priority`) VALUES
(1, 'broken bulb', 'main entrance', 'bulbs at entrance not working and need to be replaced. front area looks dark.', 6, 'rejected', 'high'),
(2, 'heater broken', 'mullet room entrance', 'Cold air blows in easily as window is not double layered. this makes the area colder during these winter months.', 8, 'rejected', 'medium'),
(12, 'high voltage', 'whole building', 'electronics at risk', 6, 'in progress', 'high'),
(20, 'Computer broken', 'interns section', 'computer broken after falling to the ground. Cannot do any work now.', 6, 'in progress', 'urgent'),
(22, 'Overflowing Sink', 'kitchen', 'Sink not draining properly and could cause water damage downstairs if tap is not properly closed. Also makes the area look nasty.', 8, 'in progress', 'high'),
(26, 'Hole in roof', 'interns section', 'Water gets into office when it rains', 6, 'resolved', 'high'),
(37, 'blinking bulb', 'main entrance', 'rghwdgnwfm lklwdkgfjklkkl  k kg rgotoo\r\netunintginionwtgwtr\r\ntninntonomtmte\r\ntniorimem,t3rtt\r\n3r9j4orm4t', 8, 'in progress', 'low'),
(65, 'broken window', 'veranda', 'cold air coming in.', 8, 'in progress', 'medium'),
(66, 'r', 'main entrance', 'r', 8, 'resolved', 'low');

-- --------------------------------------------------------

--
-- Table structure for table `issue_log`
--

CREATE TABLE IF NOT EXISTS `issue_log` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `issue_id` int(11) NOT NULL,
  `technician_id` int(11) NOT NULL DEFAULT '1',
  `date_assigned` date DEFAULT NULL,
  `date_closed` date DEFAULT NULL,
  `date_reported` date NOT NULL,
  PRIMARY KEY (`log_id`),
  KEY `issue_id` (`issue_id`),
  KEY `technician_id` (`technician_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=48 ;

--
-- Dumping data for table `issue_log`
--

INSERT INTO `issue_log` (`log_id`, `issue_id`, `technician_id`, `date_assigned`, `date_closed`, `date_reported`) VALUES
(1, 1, 37, '2017-01-18', '2017-01-18', '2015-12-13'),
(2, 20, 28, '2017-01-10', '2017-01-10', '2016-12-11'),
(4, 22, 3, '2017-01-18', '2017-01-09', '2016-12-13'),
(7, 26, 2, '2017-01-06', '2017-01-18', '2016-12-21'),
(8, 2, 2, '2017-01-06', '2017-01-09', '2016-12-21'),
(9, 12, 5, '2017-01-06', '2016-12-23', '2016-12-21'),
(18, 37, 53, '2017-01-19', NULL, '2017-01-12'),
(46, 65, 37, '2017-01-19', NULL, '2017-01-18'),
(47, 66, 26, '2017-01-18', '2017-01-19', '2017-01-18');

-- --------------------------------------------------------

--
-- Table structure for table `quotes`
--

CREATE TABLE IF NOT EXISTS `quotes` (
  `ref_quote` int(11) NOT NULL AUTO_INCREMENT,
  `quote` text NOT NULL,
  `author` varchar(50) NOT NULL DEFAULT 'unknown',
  PRIMARY KEY (`ref_quote`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `quotes`
--

INSERT INTO `quotes` (`ref_quote`, `quote`, `author`) VALUES
(1, 'I invite everyone to choose forgiveness rather than division, teamwork over personal ambition.', 'Jean-Francois Cope'),
(2, 'Coming together is a beginning. Keeping together is progress. Working together is success.', 'Henry Ford'),
(3, 'We are what we repeatedly do. Excellence, then, is not an act, but a habit.', 'Aristotle'),
(4, 'People create their own success by learning what they need to learn and then by practcing it until they become proficient at it.\r\n\r\n', 'Brian Tracy'),
(5, 'Perfection is not attainable, but if we chase perfection we can catch excellence.', 'vince lombardi'),
(6, 'The difference between a successful person and others is not a lack of strength, not a lack of knowledge, but rather a lack of will.', 'vince lombardi'),
(7, 'It''s not whether you get knocked down, it''s whether you get up.', 'vince lombardi'),
(8, 'The harder you work, the harder it is to surrender.', 'vince lombardi'),
(9, 'Individual commitment to a group effort - that is what makes a team work, a company work, a society work, a civilization work.', 'vince lombardi'),
(10, 'Practice doesn’t make perfect. Perfect practice makes perfect.\r\n', 'vince lombardi'),
(11, 'Winners never quit and quitters never win.', 'vince lombardi'),
(12, 'The quality of a person''s life is in direct proportion to their commitment to excellence, regardless of their chosen field of endeavor.', 'vince lombardi'),
(13, 'The only place success comes before work is in the dictionary.', 'vince lombardi'),
(14, 'Winning is habit. Unfortunately, so is losing.', 'vince lombardi'),
(15, 'The achievements of an organization are the results of the combined effort of each individual.', 'vince lombardi'),
(16, 'We chase perfection knowing very well it is not attainable, because in the process we happen to catch excellence.', 'vince lombardi'),
(17, 'Obstacles are what you see when you take your eyes off of the goal.', 'vince lombardi'),
(18, 'People who work together will win, whether it be against complex football defenses, or the problems of modern society.', 'vince lombardi'),
(19, 'To achieve success, whatever the job we have, we must pay a price.', 'vince lombardi'),
(20, 'If you’ll not settle for anything less than your best, you will be amazed at what you can accomplish in your lives.', 'vince lombardi'),
(21, 'Confidence is contagious and so is lack of confidence, and a customer will recognize both.', 'vince lombardi'),
(22, 'Winning is not a sometime thing, it is an all the time thing. You don’t do things right once in a while…you do them right all the time.', 'vince lombardi'),
(23, 'Some of us will do our jobs well and some will not, but we will all be judged on one thing: the result.', 'vince lombardi'),
(24, 'Having the capacity to lead is not enough. The leader must be willing to use it.', 'vince lombardi'),
(25, 'One of our biggest problems is delayed reporting.', 'harry hall');

-- --------------------------------------------------------

--
-- Table structure for table `technicians`
--

CREATE TABLE IF NOT EXISTS `technicians` (
  `technician_id` int(11) NOT NULL AUTO_INCREMENT,
  `company` varchar(50) NOT NULL,
  `speciality` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `tech_name` varchar(50) NOT NULL,
  PRIMARY KEY (`technician_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=56 ;

--
-- Dumping data for table `technicians`
--

INSERT INTO `technicians` (`technician_id`, `company`, `speciality`, `phone`, `tech_name`) VALUES
(1, 'not assigned', 'n/a', 'n/a', 'not applicaple'),
(2, 'hydro quebec', 'electric power', '514-289-2213', 'pierre lechamps'),
(3, 'Rogers Ltd', 'Telecommunications', '514-222-3333', 'pierre roger'),
(4, 'Bureau en Gros', 'office supplies', '514-123-4567', 'danny bros'),
(5, 'Thompson woodworks', 'wood and furniture', '438-298-2229', 'thompson leclerc'),
(23, 'Welding shop', 'metal works', '1888-333-3338', 'simon smith'),
(26, 'Gary and sons ', 'plumbing', '514-333-3333', 'gary coleman'),
(28, 'geek squad', 'electronic maintainence', '514-444-4444', 'joe fraser'),
(37, 'Builders Inc', 'building', '514-111-2222', 'joseph james'),
(53, 'self employed', 'special handy man', '514-678-9012', 'Jack black'),
(55, 'Bell', 'Computers', '333-333-3333', 'eric rogers');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attachments`
--
ALTER TABLE `attachments`
  ADD CONSTRAINT `attachments_ibfk_2` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`issue_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `employees`
--
ALTER TABLE `employees`
  ADD CONSTRAINT `employees_ibfk_2` FOREIGN KEY (`department_id`) REFERENCES `departments` (`department_id`);

--
-- Constraints for table `issues`
--
ALTER TABLE `issues`
  ADD CONSTRAINT `issues_ibfk_4` FOREIGN KEY (`employee_id`) REFERENCES `employees` (`employee_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `issue_log`
--
ALTER TABLE `issue_log`
  ADD CONSTRAINT `issue_log_ibfk_3` FOREIGN KEY (`issue_id`) REFERENCES `issues` (`issue_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `issue_log_ibfk_4` FOREIGN KEY (`technician_id`) REFERENCES `technicians` (`technician_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
