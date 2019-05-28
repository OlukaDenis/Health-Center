-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 15, 2019 at 05:33 AM
-- Server version: 5.7.24
-- PHP Version: 7.1.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `healthcenter`
--
CREATE DATABASE IF NOT EXISTS `healthcenter` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `healthcenter`;

-- --------------------------------------------------------

--
-- Table structure for table `accounts`
--

DROP TABLE IF EXISTS `accounts`;
CREATE TABLE IF NOT EXISTS `accounts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PatientNumb` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Diagnosis` varchar(256) NOT NULL,
  `ConsultationFee` int(11) NOT NULL,
  `LabFee` int(11) NOT NULL,
  `PharmacyFee` int(11) NOT NULL,
  `Paid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accounts`
--

INSERT INTO `accounts` (`id`, `PatientNumb`, `Name`, `Diagnosis`, `ConsultationFee`, `LabFee`, `PharmacyFee`, `Paid`) VALUES
(8, 'NDH38', 'Daniel Ok', ' Check malaria\r\n\r\nGive panadol', 2000, 20000, 3000, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctordiagnosis`
--

DROP TABLE IF EXISTS `doctordiagnosis`;
CREATE TABLE IF NOT EXISTS `doctordiagnosis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `DoctorId` varchar(100) DEFAULT NULL,
  `Diagnosis` varchar(200) DEFAULT NULL,
  `ToLab` varchar(100) DEFAULT NULL,
  `PatientNum` varchar(100) NOT NULL,
  `ToPharmacy` int(11) NOT NULL DEFAULT '0',
  `ToAccounts` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctordiagnosis`
--

INSERT INTO `doctordiagnosis` (`id`, `DoctorId`, `Diagnosis`, `ToLab`, `PatientNum`, `ToPharmacy`, `ToAccounts`) VALUES
(40, 'Wasswa Hassan', 'Check malaria\r\n\r\nGive panadol', 'No', 'NDH38', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

DROP TABLE IF EXISTS `employees`;
CREATE TABLE IF NOT EXISTS `employees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `dateAdded` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `username`, `password`, `role`, `dateAdded`) VALUES
(1, 'Wasswa Hassan', 'hassan', '123456', 'doctor', '2019-04-28 08:00:17.180241'),
(3, 'Ssekawungu Brian', 'brian', '123456', 'accountant', '2019-04-12 08:00:17.180241'),
(2, 'Kauli Robert', 'robert', '123456', 'lab technician', '2019-04-22 21:00:00.000000'),
(4, 'Namagembe Deborah', 'deborah', '123456', 'receptionist', '2019-04-27 06:21:18.257000'),
(7, 'Naluwuge Mariam', 'mariam', '123456', 'nurse', '2019-04-27 06:21:18.257000'),
(6, 'Lubega Abhudallah', 'abhudallah', '123456', 'pharmacist', '2019-04-27 06:21:18.257000');

-- --------------------------------------------------------

--
-- Table structure for table `labtechnician`
--

DROP TABLE IF EXISTS `labtechnician`;
CREATE TABLE IF NOT EXISTS `labtechnician` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LabTechId` varchar(100) NOT NULL,
  `StuNum` varchar(100) NOT NULL,
  `DocNum` varchar(100) NOT NULL,
  `Results` varchar(500) DEFAULT NULL,
  `ToDoc` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `labtechnician`
--

INSERT INTO `labtechnician` (`id`, `LabTechId`, `StuNum`, `DocNum`, `Results`, `ToDoc`) VALUES
(4, 'Kauli Robert', 'NDH38', 'Wasswa Hassan', 'Malaria positive', 0);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `PatientNo` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Village` varchar(100) NOT NULL,
  `DateOfBirth` varchar(100) NOT NULL,
  `Telephone` varchar(100) NOT NULL,
  `Sex` varchar(100) NOT NULL,
  `ToNurse` int(11) NOT NULL,
  `DateAdded` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `PatientNo`, `Name`, `Village`, `DateOfBirth`, `Telephone`, `Sex`, `ToNurse`, `DateAdded`) VALUES
(9, 'NDH38', 'Daniel Ok', 'Kayunga', '1111-01-01', '343254234324', 'Male', 1, '2019-04-14 20:40:31.723451');

-- --------------------------------------------------------

--
-- Table structure for table `patientdetails`
--

DROP TABLE IF EXISTS `patientdetails`;
CREATE TABLE IF NOT EXISTS `patientdetails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `NurseNo` varchar(100) DEFAULT NULL,
  `PatientNumber` varchar(100) DEFAULT NULL,
  `Weight` varchar(100) DEFAULT NULL,
  `BloodPressure` varchar(100) DEFAULT NULL,
  `Temperature` varchar(100) DEFAULT NULL,
  `Height` varchar(100) DEFAULT NULL,
  `Status` varchar(100) DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `PatientNumber` (`PatientNumber`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patientdetails`
--

INSERT INTO `patientdetails` (`id`, `NurseNo`, `PatientNumber`, `Weight`, `BloodPressure`, `Temperature`, `Height`, `Status`) VALUES
(37, 'Naluwuge Mariam', 'NDH38', '890', '78', '12', '930', '0');

-- --------------------------------------------------------

--
-- Table structure for table `pharmacy`
--

DROP TABLE IF EXISTS `pharmacy`;
CREATE TABLE IF NOT EXISTS `pharmacy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `StudntNum` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Medication` varchar(256) NOT NULL,
  `Date` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pharmacy`
--

INSERT INTO `pharmacy` (`id`, `StudntNum`, `Name`, `Medication`, `Date`) VALUES
(3, 'NDH38', 'Daniel Ok', '', '2019-04-14 20:44:37.059029');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
