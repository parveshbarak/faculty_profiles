-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 10, 2020 at 11:59 AM
-- Server version: 8.0.22-0ubuntu0.20.04.2
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Faculty_profile`
--
-- --------------------------------------------------------


--
-- Table structure for table `users`
--

CREATE TABLE `users` (
 `id`  INT NOT NULL AUTO_INCREMENT,
 `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ,
 `updated_at` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP, 
 `email` VARCHAR(64) NOT NULL UNIQUE,
 `password` VARCHAR(1024) NOT NULL,
 `Code` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  UNIQUE KEY ( id ),
  PRIMARY KEY ( `Code` )
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Table structure for table `awards`
--

CREATE TABLE `awards` (
  `id`  INT NOT NULL AUTO_INCREMENT,
  `user_id` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `AwardName` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `AwardAgency` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `AwardYear` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
   PRIMARY KEY ( id ),
   FOREIGN KEY(user_id) REFERENCES users(Code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id`  INT NOT NULL AUTO_INCREMENT,
  `user_id` varchar(8) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BookAuthor` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BookTitle` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BookCoAuthor` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BookPublication` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BookISBN` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `BookPYear` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Page` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Impact` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `APIList` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `APICount` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Editor` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
   PRIMARY KEY ( id ),
   FOREIGN KEY(user_id) REFERENCES users(Code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `chapters`
--

CREATE TABLE `chapters` (
  `id`  INT NOT NULL AUTO_INCREMENT,
  `user_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ChapterBook` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ChapterTitle` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ChapterPage` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ChapterPublisher` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Cmonth` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Cyear` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ChapterScoper` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
   PRIMARY KEY ( id ),
   FOREIGN KEY(user_id) REFERENCES users(Code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `confrences`
--

CREATE TABLE `confrences` (
  `id`  INT NOT NULL AUTO_INCREMENT,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ConfType` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ConfTopic` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ConfPlace` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ConfOrgBy` varchar(1024) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ConfDateFm` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ConfDateTo` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
   PRIMARY KEY ( id ),
   FOREIGN KEY(user_id) REFERENCES users(Code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `faculties`
--

CREATE TABLE `faculties` (
  `id`  INT NOT NULL AUTO_INCREMENT,
  `user_id` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `MN` varchar(32) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Name` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Sex` enum('M','F','Others','') CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Post` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Faculty` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Dept` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
   PRIMARY KEY ( id ),
   FOREIGN KEY(user_id) REFERENCES users(Code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `journals`
--

CREATE TABLE `journals` (
  `id`  INT NOT NULL AUTO_INCREMENT,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PublType` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Authors` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Paper` varchar(512) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `JournalNO` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `JournalName` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `ISSN` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Page` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Impact` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `APIList` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `APICount` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Scope` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `JMonth` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `JYear` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PublVol` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PublIssue` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `PublDOI` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
   PRIMARY KEY ( id ),
   FOREIGN KEY(user_id) REFERENCES users(Code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


--
-- Table structure for table `lectures`
--

CREATE TABLE `lectures` (
  `id`  INT NOT NULL AUTO_INCREMENT,
  `user_id` varchar(64) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Lecture` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `Place` varchar(256) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `LectureDtae` varchar(128) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
   PRIMARY KEY ( id ),
   FOREIGN KEY(user_id) REFERENCES users(Code)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



--
-- Dumping data for table `faculties`
--

INSERT INTO `faculties` (`user_id`,`MN`, `Name`, `Sex`, `Post`, `Faculty`, `Dept`) VALUES
('GKV/054', 'DR.', 'LAKSHAMI PRASAD PUROHIT', 'M', 'Professor', 'Faculty of Science', 'Physics'),
('GKV/061','DR.', 'HEMALATHA. K', 'F', 'Professor', 'Kanya Gurukul Campus, Dehradun', 'English'),
('GKV/062','123456', 'DR.', 'NIPUR SINGH', 'F', 'Professor', 'Kanya Gurukul Campus, Dehradun', 'Computer Sc.');

--
-- Dumping data for table `lectures`
--

INSERT INTO `lectures` (`user_id`, `Lecture`, `Place`, `LectureDtae`) VALUES
('GKV/061', 'Theory of Dhvani: Anandavardhan and Abhinavagupta', 'Refresher course  on “20th Century Literary Theory and Criticism” organised  by UGC Academic Staff College, Kumaon University, Nainital ', '/23rd of Feb.2009/'),
('GKV/061', 'Self and Other: A Study of Diaspora Literature', 'Refresher course  on “20th Century Literary Theory and Criticism” organised  by UGC Academic Staff College, Kumaon University, Nainital ', '/23rd of Feb.2009/'),
('GKV/061', 'Application of Sanskrit Literary Theory to Milton’s Paradise Lost', 'Academic staff College, Faridabad ', '/12th of May 2008/'),
('GKV/061', 'Writers in South Asian Diaspora: Canada', 'Academic Staff College, Faridabad ', '/12th of May 2008/'),
('GKV/061', ' Linguistics and Communication Skills ', 'Munna Lal and Jaya Narayan Khemka Girls (P.G.) College, Saharanpur ', '/25 Mar 2011/');


--
-- Dumping data for table `journals`
--

INSERT INTO `journals` (`user_id`, `PublType`, `Authors`, `Paper`, `JournalNO`, `JournalName`, `ISSN`, `Page`, `Impact`, `APIList`, `APICount`, `Scope`, `JMonth`, `JYear`, `PublVol`, `PublIssue`, `PublDOI`) VALUES
('GKV/054', 'International', 'T.K. Pathak, R. Kumar, L.P. Purohit,', 'Preparation and optical properties of undoped and nitrogen doped zno thin films by RF sputtering', '', 'International Journal of ChemTech Research', '09744290', '987-993', '0.41', '', '', 'SCOPUS', '', '', '', '', ''),
('GKV/054', 'International', 'T.K. Pathak, V. Kumar, H.C. Swart, L.P. Purohit', 'P-type conductivity in doped and codoped ZnO thin films synthesized by RF magnetron sputtering', '', 'Journal of Modern Optics', '09500340', '1368-1373', '1.26', '', '', 'SCOPUS', '', '', '', '', ''),
('GKV/054', 'International', 'T.K. Pathak, V. Kumar, H.C. Swart, L.P. Purohit', 'Effect of doping concentration on the conductivity and optical properties of p-type ZnO thin films', '', 'Physica B: Condensed Matter', '09214526', '31-35', '1.87', '', '', 'SCOPUS', '', '', '', '', ''),
('GKV/054', 'International', 'T.K. Pathak, V. Kumar, L.P. Purohit', 'Sputtered Al-N codoped p-type transparent ZnO thin films suitable for optoelectronic devices', '', 'Optik', '00304026', '603-607', '1.87', '', '', 'SCOPUS', '', '', '', '', ''),
('GKV/054', 'International', 'P. Gairola, A. Ohlan,, S.P. Gairola, V. Verma, S.K. Dhawan, L.P. Purohit,', 'Encapsulation of Barium Ferrite and Reduced Graphene Oxide in poly(o-toluidine) as a Barrier for Electromagnetic Radiations', '', 'Crystal Research and Technology', '	02321300', '', '', '', '', 'SCOPUS', '', '', '', '', ''),
('GKV/061', 'National', 'Hemalatha.K', 'Nature and Environment in the Indo Anglian Poets of the Pre-Independence Era', '', 'Jodhpur Studies in English.Vol.X,2012, Dept. of English, Jai Narain Vyas Univ.,Jodhpur', 'ISSN 0970-843X', '16-29', '', '', '', 'Peer Reviewed', '', '', '', '', ''),
('GKV/061', 'National', 'Hemalatha.K', 'Teaching a Poem in a Classroom Situation', '', 'The Vedic Path Vol. LVIII  no. 6 (Dec. 2000-2001)', 'ISSN 0970-1443', '31-36', '', '', '', 'Peer Reviewed', '', '', '', '', ''),
('GKV/061', 'National', 'Hemalatha K&Anamika Saha', 'Questioning Antiquity and Sacrifice in Amish’s Character Shiva', '', ' International Journal of Humanities and Social Sciences(IJHSS)Jan. 2019', 'ISSN(Online) 2319-3948', '33-38', '5.8487', '', '', 'Peer Reviewed', '', '', '', '', ''),
('GKV/061', 'International', 'Hemalatha K & Lakshmi Negi', 'The Concept of National identity and Vision of a Global Village in the Novels of Michael Ondaatje', '63751', 'Veda’s Journal of English Language and Literature(JOELL),An International Peer Reviewed Journal,Vol.2 Issue 3, 2015', 'ISSN 2349-9753', '84-96', 'SJIF Impact Factor 3.079', '', '', 'UGC Listed', '', '', '', '', ''),
('GKV/061', 'National', 'Hemalatha.K. & Himani Sharma', 'A Revolution is Born: Search for a New Society in the plays of Badal Sircar', '', 'Vedic Path LXXXV111(No.3&4),(Jul.-Sep./Oct.-Dec.) 2014', 'ISSN 0970-1443', '143-156', '', '', '', 'Peer Reviewed', '', '', '', '', ''),
('GKV/061', 'National', 'Hemalatha.K', 'Social and Cultural Ostracism of  Dalits: A Study of Modern Marathi Dalit Poetry', '', 'Vedic Path Vol. LXXX1V(No.1&2), (Jan-March/April-June   2010)', 'ISSN 0970-1443', '27-48', '', '', '', 'Peer Reviewed', '', '', '', '', ''),
('GKV/061', 'International', 'Hemalatha.K', 'Indian Theory of Dhvani(Suggestion):A Study of Language and Text in Hamlet ', '', 'Asian Journal of Literature, Culture and Society   Vol.04,No. 1,April 2010.Bangkok: Assumption University Press', 'ISSN 1905-856X', '80-95', '', '', '', 'Peer Reviewed', '', '', '', '', ''),
('GKV/061', 'National', 'Hemalatha.K', 'Anandavardhana’s Dhvani Siddhanta and Milton’s Paradise Lost: A Study in Application', '', 'VedicPath Vol. LXXX1(No.3&4),(July- Dec. 2008)', 'ISSN 0970-1443', '61-80', '', '', '', 'Peer Reviewed', '', '', '', '', ''),
('GKV/054', 'International', 'G.K. Upadhyay, J.K. Rajput, T.K. Pathak, V. Kumar, L.P. Purohit', 'Synthesis of ZnO:TiO2 nanocomposites for photocatalyst application in visible light', '', 'Vacuum', '0042207X', '154-163', '2.51', '', '', 'SCOPUS', '', '', '', '', '');


--
-- Dumping data for table `confrences`
--

INSERT INTO `confrences` (`user_id`, `ConfType`, `ConfTopic`, `ConfPlace`, `ConfOrgBy`, `ConfDateFm`, `ConfDateTo`) VALUES
('GKV/054', 'National', 'Effect of Annealing on Electrical and Optical Properties of S and Se-doped a-Si:H', ' Meerut', 'CCS University, Meerut', '12/29/2005', '12/31/2005'),
('GKV/054', 'National', 'Electrical and Optical Properties of Amorphous Se-Te Thin Films', 'Agra', 'BMAS Engineering College, Agra', '10/12/2006', '10/14/2006'),
('GKV/054', 'National', 'Optical Properties of Lead-Germanium Chalcogenides Thin Films', ' Kurukshetra', 'Kurukshetra University, Kurukshetra', '09/27/2006', '09/29/2006'),
('GKV/054', 'National', 'Crystallization and Thermal Degradation Kinetics of Amorphous GeSePb Alloys', ' Haridwar', 'Gurukula Kangri University, Haridwar', '10/16/2008', '10/18/2008'),
('GKV/054', 'National', 'Optical Dispersion Parameters of Vacuum Evaporated a-GeSePb Thin Films', 'Roorkee', 'IIT Roorkee', '11/10/2008', '11/12/2008'),
('GKV/054', 'National', 'High Current-Voltage Characteristic of Amorphous GeSePb Thin Films', 'Pantnagar', 'GB Pant University of Agriculture and Technology Pantnagar', '11/10/2009', '11/12/2008'),
('GKV/054', 'International', 'Energy and its conservation-the scientific principles in Vedic hymns', 'Haridwar', 'Gurukula Kangri University, Haridwar', '01/27/2005', '01/30/2005'), 'GKV/061', 'International', ' MAG/I/C- Presented paper: Alter-ego and Style of Writing in the Selected novels of J.M.Coetzee', 'Dehradun', 'UPES,Dehradun', '/10Nov 2016/', '/11 Nov 2016/'),
('GKV/061', 'International', 'MAG/I/C- Presented paper: Dhvani (Theory of Suggestion) in T.S.Eliot- \"Wasteland\"', 'Dehradun', 'UPES,Dehradun', '/4 April 2014/', '/5 April 2014/'),
('GKV/061', 'International', 'Cultural Messengers of India-Presented paper: Literary Reflections on British Contribution to Indian Culture', 'Haridwar', 'Dept. Of Indian Culture and Tourism at Dev Sanskriti Vishwavidyalaya, Shantikunj, Haridwar ', '/29 March 2014/', '/30 March 2014/'),
('GKV/061', 'International', 'Strategic Communication: Learning from Mistakes', 'Dehradun', 'Centre of Communication, University of Petroleum &Energy Studies, Dehradun', '/4 Nov.2011/', '/5 Nov.2011/'),
('GKV/061', 'International', 'Bio Diversity and Environmental Governance: Canada and India-Presented paper:Creation of Environmental Awareness Through Nature Poetry: A Study', 'Haridwar', 'Centre of Canadian Studies,Gurukul Kangri Vishwavidyalaya,Haridwar', '/21 Oct.2010/', '/23 Oct.2010/'),
('GKV/061', 'International', 'ESL/EFL Conference -Presented paper :Teaching English in an Era of Globalization', 'Udaipur', 'JRN Rajasthan Vidyapeeth, Udaipur ', '/5 Nov.2009/', '/7 Nov 2009/'),
('GKV/061', 'International', 'Permanence and change: The roles of culture and language-Presented paper :Indian Theory of Dhvani: A study of language and text', 'Bangkok', 'Assumption University, Bangkok ', '/13 Aug 2009/', '/14 Aug  2009/');


--
-- Dumping data for table `books`
--

INSERT INTO `books` (`user_id`, `BookAuthor`, `BookTitle`, `BookCoAuthor`, `BookPublication`, `BookISBN`, `BookPYear`, `Page`, `Impact`, `APIList`, `APICount`, `Editor`) VALUES
('GKV/061', 'Hemalatha K', 'The Quest for Belief: A Study of the Novels of TheodoreDreiser', '0', 'Rajat Publications, New Delhi', 'ISBN 81-7880-252-X', '2006', '197', '', '', '', '');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;