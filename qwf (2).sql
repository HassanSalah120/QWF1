-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 09, 2023 at 12:17 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 7.4.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qwf`
--

-- --------------------------------------------------------

--
-- Table structure for table `acadyear`
--

CREATE TABLE `acadyear` (
  `id` int(11) NOT NULL,
  `Ayear` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `actdocuments`
--

CREATE TABLE `actdocuments` (
  `DocID` int(11) NOT NULL,
  `GeneralActID` varchar(100) NOT NULL,
  `DocName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activieminplan`
--

CREATE TABLE `activieminplan` (
  `id` int(11) NOT NULL,
  `AYID` int(11) NOT NULL,
  `StdID` int(11) NOT NULL,
  `EvalPointerID` int(11) NOT NULL,
  `ActID` int(11) NOT NULL,
  `Responsible` varchar(100) NOT NULL,
  `DateFrom` date NOT NULL,
  `DateTo` date NOT NULL,
  `FolderPath` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `activites`
--

CREATE TABLE `activites` (
  `id` int(11) NOT NULL,
  `actv` varchar(100) NOT NULL,
  `manager` varchar(100) NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` varchar(100) NOT NULL,
  `output` varchar(100) NOT NULL,
  `goalID` int(11) NOT NULL,
  `pointerID` int(11) NOT NULL,
  `stdID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `activites`
--

INSERT INTO `activites` (`id`, `actv`, `manager`, `from`, `to`, `output`, `goalID`, `pointerID`, `stdID`) VALUES
(1, '1/1/1 عقد ورش حول اعداد تحديث رؤيه ورساله الكلية ( 2019ـ 2024 ) بمشاركة الأطراف المعنية ( أعضاء هيئة', '-	رئيس لجنة التخطيط وتقييم الأداء -	رئيس لجنة التدريب  والدعم الفنى والمسئولية المجتمعية', 'اكتوبر 2021', 'نوفمبر2021', '1/1  رساله ورؤيه الكليه معتمدتان ومعلنتان وشارك في وضعهما الأطراف المعنيه 	 تحديث رؤية ورسالة الكلية', 2, 1, 1),
(3, '2', 'aatef', 'may', 'march', 'ana', 1, 3, 2),
(4, 'h', 'hh', 'hh', 'hh', 'h', 1, 1, 0),
(20, '', '', '', '', '', 1, 1, 0),
(21, '1', '23', '43', '2312', '213', 1, 1, 0),
(22, '432', '324', '432', '432', '432', 1, 1, 0),
(23, '432', '324', '432', '432', '432', 1, 1, 0),
(24, '', '', '', '', '', 1, 1, 1),
(25, '', '', '', '', '', 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `password` varchar(50) NOT NULL,
  `roleId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `password`, `roleId`) VALUES
(19, 'ahmed', '1234', 1),
(21, 'atef', '4512', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_std`
--

CREATE TABLE `admin_std` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `std_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_std`
--

INSERT INTO `admin_std` (`id`, `user_id`, `std_id`) VALUES
(8, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `ID` int(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL,
  `stdID` int(11) NOT NULL,
  `pointerID` int(11) NOT NULL,
  `actID` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 AUTO_INCREMENT=1;


--
-- Dumping data for table `files`
--

INSERT INTO `files` (`ID`, `name`, `size`, `downloads`, `stdID`, `pointerID`, `actID`) VALUES
(7, 'Web Head Plan.pdf', 223025, 3, 1, 1, 1),
(8, 's.png', 17675, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `goals`
--

CREATE TABLE `goals` (
  `id` int(11) NOT NULL,
  `goalName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `pointer`
--

CREATE TABLE `pointer` (
  `id` int(11) NOT NULL,
  `pointer_name` varchar(100) NOT NULL,
  `goalName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pointer`
--

INSERT INTO `pointer` (`id`, `pointer_name`, `goalName`) VALUES
(1, 'رساله ورؤيه الكليه معتمدتان ومعلنتان وشارك في وضعهما الأطراف المعنيه', 'تحليل الوضع الراهن للكلية  (التعليم والبحث العلمي وخدمة المجتمع )'),
(2, 'رساله الكليه واضحه وتعكس دورها التعليمى والبحثى', ''),
(3, 'الخطه الاستراتيجيه للكليه معتمده ومكتمله العناصر وتتسق مع استراتيجيه الجامعه', ''),
(4, 'التحليل البيئي شمل البيئه الداخليه والخارجيه وشارك فيها الأطراف المعنيه', ''),
(5, 'الأهداف الاستراتيجيه للمؤسسه معلنه وواضحه الصياغه', ''),
(6, 'الخطط التنفيذية تتضمن الأنشطة التى تحقق الأهداف الإستراتيجية', ''),
(7, ' للكلية تقارير دوريه لمتابعه وتقويم مدى تقدم الخطط التنفيذيه', '');

-- --------------------------------------------------------

--
-- Table structure for table `pointers`
--

CREATE TABLE `pointers` (
  `id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `StdID` int(11) NOT NULL,
  `EvalpointerID` int(11) NOT NULL,
  `EvalResultID` int(11) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Doctor'),
(3, 'Teacher Assistan');

-- --------------------------------------------------------

--
-- Table structure for table `standarts`
--

CREATE TABLE `standarts` (
  `StdID` int(11) NOT NULL,
  `StdName` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `standarts`
--

INSERT INTO `standarts` (`StdID`, `StdName`) VALUES
(1, 'معيار التخطيط الإستراتيجى'),
(2, 'معيار القيادة والحوكمة '),
(3, 'إدارة نظم الجودة والتطوير '),
(4, 'أعضاء هيئة التدريس والهيئة المعاونة   '),
(5, 'الجهاز الإدارى  '),
(6, 'الموارد المالية والمادية  '),
(7, 'المعايير الأكاديمية والبرامج التعليمية'),
(8, 'التدريس والتعلم والتقويم'),
(9, 'الطلاب والخريجون'),
(10, 'البحث العلمى والأنشطة العلمية'),
(11, 'المشاركة المجتمعية وتنمية البيئة'),
(13, 'معيار القيادة والحوكمة ');

-- --------------------------------------------------------

--
-- Table structure for table `upload`
--

CREATE TABLE `upload` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `size` int(11) NOT NULL,
  `downloads` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `upload`
--

INSERT INTO `upload` (`id`, `name`, `size`, `downloads`) VALUES
(39, 'Web Head Plan.pdf', 223025, 2),
(40, 'Web Head Plan.pdf', 223025, 0),
(41, 's.png', 17675, 0),
(42, 's.png', 17675, 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acadyear`
--
ALTER TABLE `acadyear`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activieminplan`
--
ALTER TABLE `activieminplan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `activites`
--
ALTER TABLE `activites`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- Indexes for table `admin_std`
--
ALTER TABLE `admin_std`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `goals`
--
ALTER TABLE `goals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pointer`
--
ALTER TABLE `pointer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `standarts`
--
ALTER TABLE `standarts`
  ADD PRIMARY KEY (`StdID`);

--
-- Indexes for table `upload`
--
ALTER TABLE `upload`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acadyear`
--
ALTER TABLE `acadyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activieminplan`
--
ALTER TABLE `activieminplan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `activites`
--
ALTER TABLE `activites`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `admin_std`
--
ALTER TABLE `admin_std`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `ID` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `goals`
--
ALTER TABLE `goals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `pointer`
--
ALTER TABLE `pointer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `standarts`
--
ALTER TABLE `standarts`
  MODIFY `StdID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `upload`
--
ALTER TABLE `upload`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
