-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 15, 2025 at 01:05 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dswsmsappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `beneficiary_id` bigint(20) UNSIGNED NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `social_worker_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `date_released` timestamp NULL DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `form_data` longtext NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `remarks` text DEFAULT NULL,
  `updated_by` bigint(20) UNSIGNED DEFAULT NULL,
  `approval_date` timestamp NULL DEFAULT NULL,
  `claim_status` varchar(255) NOT NULL DEFAULT 'Unclaimed',
  `claim_date` date DEFAULT NULL,
  `claimed_amount` decimal(10,2) DEFAULT NULL,
  `batch_id` varchar(255) DEFAULT NULL,
  `batch_release_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`id`, `beneficiary_id`, `program_id`, `social_worker_id`, `admin_id`, `approved_date`, `date_released`, `status`, `form_data`, `created_at`, `updated_at`, `remarks`, `updated_by`, `approval_date`, `claim_status`, `claim_date`, `claimed_amount`, `batch_id`, `batch_release_date`) VALUES
(3, 3, 1, 6, 5, '2025-10-14 06:57:17', '2025-10-19 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"TESTMARLO\\\",\\\"middle_name\\\":\\\"TESTMARLO\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"asdasd\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"qdqwewqe\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1929-03-29\\\",\\\"age\\\":\\\"96\\\",\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"13123213\\\",\\\"other_skills\\\":\\\"wewqe\\\",\\\"seniorid\\\":\\\"1\\\",\\\"family_composition\\\":[{\\\"name\\\":\\\"qdqqwe\\\",\\\"age\\\":\\\"23\\\",\\\"relation\\\":\\\"qeqwewqe\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"occupation\\\":\\\"qweqwe\\\",\\\"income\\\":\\\"213123\\\"}]}\"', '2025-10-14 06:56:13', '2025-10-19 22:04:13', NULL, 5, '2025-10-14 06:57:17', 'Unclaimed', NULL, NULL, NULL, NULL),
(4, 4, 3, 4, 3, '2025-10-14 23:19:21', '2025-10-14 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"TESTMARLO\\\",\\\"middle_name\\\":\\\"TESTMARLO\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"asdasd\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"N\\\\\\/A\\\",\\\"occupation\\\":\\\"N\\\\\\/A\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1929-03-29\\\",\\\"age\\\":\\\"96\\\",\\\"certification\\\":\\\"1\\\",\\\"referral_slip\\\":\\\"1\\\",\\\"study_load\\\":\\\"1\\\",\\\"student_id\\\":\\\"1\\\",\\\"certificate_of_no_scholarship\\\":\\\"1\\\",\\\"brgy_cert\\\":\\\"1\\\",\\\"cert_ass_off\\\":\\\"1\\\"}\"', '2025-10-14 23:16:00', '2025-10-14 23:20:40', NULL, 3, '2025-10-14 23:19:21', 'Unclaimed', NULL, NULL, NULL, NULL),
(5, 5, 2, 10, 9, '2025-10-26 22:34:30', '2025-11-10 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"TESTMARLO\\\",\\\"middle_name\\\":\\\"BABAYSON\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"cdo\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"qeqweq\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1998-03-23\\\",\\\"phone_number\\\":\\\"9121394070\\\",\\\"age\\\":\\\"27\\\",\\\"certification\\\":\\\"1\\\",\\\"religion\\\":\\\"qweqwe\\\",\\\"company_agency\\\":\\\"qweqwewqe\\\",\\\"monthly_income\\\":\\\"123,123\\\",\\\"employment_status\\\":\\\"self-employed\\\",\\\"classification_circumstances\\\":\\\"sadasdklaskjdlkj\\\",\\\"needs_problems\\\":\\\"dalkjdaskljd\\\",\\\"emergency_contact\\\":{\\\"name\\\":\\\"asdasd\\\",\\\"relationship\\\":\\\"aasdas\\\",\\\"address\\\":\\\"adasd\\\"},\\\"emergency_contact_number\\\":\\\"1231231231\\\",\\\"child_birth_cert\\\":\\\"1\\\",\\\"parent_id\\\":\\\"1\\\",\\\"brgy_clearance\\\":\\\"1\\\",\\\"family_composition\\\":[{\\\"name\\\":\\\"adsadasjdlkj\\\",\\\"relationship\\\":\\\"askljdsalkjd\\\",\\\"age\\\":\\\"24\\\",\\\"birthdate\\\":\\\"2001-02-13\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"asdsad\\\",\\\"monthly_income\\\":\\\"213123\\\"}]}\"', '2025-10-15 17:49:20', '2025-11-11 04:42:37', NULL, 9, '2025-10-26 22:34:30', 'Unclaimed', NULL, NULL, NULL, NULL),
(6, 6, 4, 8, 7, '2025-10-20 00:07:05', '2025-11-10 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"MARLO\\\",\\\"middle_name\\\":\\\"BABAYSON\\\",\\\"sex\\\":\\\"N\\\\\\/A\\\",\\\"place_of_birth\\\":\\\"N\\\\\\/A\\\",\\\"civil_status\\\":\\\"N\\\\\\/A\\\",\\\"educational_attainment\\\":\\\"N\\\\\\/A\\\",\\\"occupation\\\":\\\"N\\\\\\/A\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1998-12-31\\\",\\\"age\\\":\\\"26\\\",\\\"certification\\\":\\\"1\\\",\\\"certificate_date\\\":\\\"2025-10-16\\\",\\\"financial_assistance\\\":\\\"ajkdadajksdkj\\\",\\\"assistance_type\\\":\\\"asadsas\\\",\\\"assistance_amount\\\":\\\"123,123\\\",\\\"brgy_certification\\\":\\\"1\\\",\\\"medical_prescription\\\":\\\"1\\\",\\\"statement_of_account\\\":\\\"1\\\",\\\"approved_by\\\":\\\"asdasdas\\\",\\\"approver_license\\\":null}\"', '2025-10-15 17:51:46', '2025-11-11 05:34:21', NULL, 7, '2025-10-20 00:07:05', 'Unclaimed', NULL, NULL, NULL, NULL),
(7, 7, 3, 4, 3, '2025-11-11 03:31:07', '2025-11-10 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"TUTING\\\",\\\"first_name\\\":\\\"JUDY\\\",\\\"middle_name\\\":\\\"S\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Female\\\",\\\"place_of_birth\\\":\\\"CDO\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"N\\\\\\/A\\\",\\\"occupation\\\":\\\"N\\\\\\/A\\\",\\\"address\\\":\\\"CDO\\\",\\\"dob\\\":\\\"1999-04-17\\\",\\\"age\\\":\\\"26\\\",\\\"certification\\\":\\\"1\\\",\\\"referral_slip\\\":\\\"1\\\",\\\"study_load\\\":\\\"1\\\",\\\"student_id\\\":\\\"1\\\",\\\"certificate_of_no_scholarship\\\":\\\"1\\\",\\\"brgy_cert\\\":\\\"1\\\",\\\"cert_ass_off\\\":\\\"1\\\"}\"', '2025-10-17 22:06:29', '2025-11-11 05:33:56', NULL, 3, '2025-11-11 03:31:07', 'Unclaimed', NULL, NULL, NULL, NULL),
(8, 8, 1, 6, 5, '2025-10-19 21:46:57', '2025-11-11 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"TESTMARLOss\\\",\\\"middle_name\\\":\\\"TESTMARLO\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"asdasd\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"qdqwewqe\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1929-03-29\\\",\\\"age\\\":\\\"96\\\",\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"13123213\\\",\\\"other_skills\\\":\\\"wewqe\\\",\\\"seniorid\\\":\\\"1\\\"}\"', '2026-10-19 21:07:43', '2025-11-11 19:06:57', NULL, 5, '2025-10-19 21:46:57', 'Unclaimed', NULL, NULL, NULL, NULL),
(9, 3, 1, 6, 5, '2026-10-19 21:25:27', '2025-11-09 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"TESTMARLO\\\",\\\"middle_name\\\":\\\"TESTMARLO\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"asdasd\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"qdqwewqe\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1929-03-29\\\",\\\"age\\\":\\\"96\\\",\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"13123213\\\",\\\"other_skills\\\":\\\"wewqemjkkjkjk\\\",\\\"seniorid\\\":\\\"1\\\"}\"', '2026-10-19 21:08:37', '2025-11-10 07:23:43', NULL, 5, '2026-10-19 21:25:27', 'Unclaimed', NULL, NULL, NULL, NULL),
(10, 2, 1, 6, NULL, NULL, NULL, 'pending', '\"{\\\"surname\\\":\\\"ROMEROS\\\",\\\"first_name\\\":\\\"TESTMARLO\\\",\\\"middle_name\\\":\\\"BABAYSON\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"asdsad\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"qdqwewqe\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1950-06-13\\\",\\\"age\\\":\\\"76\\\",\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"13123213\\\",\\\"other_skills\\\":\\\"wewqemjkkjkjk\\\",\\\"seniorid\\\":\\\"1\\\",\\\"family_composition\\\":[{\\\"name\\\":\\\"askdlaskdj\\\",\\\"age\\\":\\\"21\\\",\\\"relation\\\":\\\"smdmsamd,as\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"occupation\\\":\\\"dmsa,md\\\",\\\"income\\\":\\\"12312123\\\"}]}\"', '2026-10-19 21:12:23', '2026-10-19 21:12:23', NULL, NULL, NULL, 'Unclaimed', NULL, NULL, NULL, NULL),
(11, 9, 1, 6, 5, '2025-10-19 21:45:16', '2025-11-10 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"testetst\\\",\\\"first_name\\\":\\\"testetst\\\",\\\"middle_name\\\":\\\"testetst\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"asdasd\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"sdsad\\\",\\\"address\\\":\\\"sdasd\\\",\\\"dob\\\":\\\"1923-10-03\\\",\\\"age\\\":null,\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"123123\\\",\\\"other_skills\\\":\\\"eqweqweasd\\\",\\\"seniorid\\\":\\\"1\\\",\\\"family_composition\\\":[{\\\"name\\\":\\\"qwlekqlekqwk\\\",\\\"age\\\":\\\"32\\\",\\\"relation\\\":\\\"wlkasdlkasjdklj\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"occupation\\\":\\\"dasdas\\\",\\\"income\\\":\\\"21312\\\"}]}\"', '2025-10-19 21:23:36', '2025-11-11 05:42:10', NULL, 5, '2025-10-19 21:45:16', 'Unclaimed', NULL, NULL, NULL, NULL),
(12, 3, 1, 6, 5, '2025-10-19 21:43:22', '2025-10-19 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"TESTMARLO\\\",\\\"middle_name\\\":\\\"TESTMARLO\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"asdasd\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"qdqwewqe\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1929-03-29\\\",\\\"age\\\":\\\"96\\\",\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"13123213\\\",\\\"other_skills\\\":\\\"wewqemjkkjkjk\\\",\\\"seniorid\\\":\\\"1\\\",\\\"family_composition\\\":[{\\\"name\\\":\\\"asdsad\\\",\\\"age\\\":\\\"23\\\",\\\"relation\\\":\\\"klq;wlkeqw;lek\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"occupation\\\":\\\"q;lkeqw;ekl\\\",\\\"income\\\":\\\"123123\\\"}]}\"', '2027-12-19 21:26:24', '2025-10-19 21:43:27', NULL, 5, '2025-10-19 21:43:22', 'Unclaimed', NULL, NULL, NULL, NULL),
(13, 10, 1, 6, 5, '2025-11-11 03:33:58', '2025-11-10 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"ROMERO\\\",\\\"first_name\\\":\\\"asdk\\\",\\\"middle_name\\\":\\\"asdasd\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"123123123\\\",\\\"civil_status\\\":\\\"Married\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"ssdasd\\\",\\\"address\\\":\\\"Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental\\\",\\\"dob\\\":\\\"1231-02-23\\\",\\\"age\\\":\\\"794\\\",\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"123123123\\\",\\\"other_skills\\\":\\\"sd.,asd,.\\\",\\\"seniorid\\\":\\\"1\\\",\\\"family_composition\\\":[{\\\"name\\\":\\\"MARLO BABAYSON ROMERO\\\",\\\"age\\\":\\\"12\\\",\\\"relation\\\":\\\"213`qq\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"occupation\\\":\\\"sdasdasd\\\",\\\"income\\\":\\\"12312312\\\"}]}\"', '2025-11-10 06:46:41', '2025-11-11 03:34:22', NULL, 5, '2025-11-11 03:33:58', 'Unclaimed', NULL, NULL, NULL, NULL),
(14, 11, 1, 6, NULL, NULL, NULL, 'pending', '\"{\\\"surname\\\":\\\"tesssssssssssst\\\",\\\"first_name\\\":\\\"tesssssssssssst\\\",\\\"middle_name\\\":\\\"tesssssssssssst\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Male\\\",\\\"place_of_birth\\\":\\\"tesssssssssssst\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"Primary\\\",\\\"occupation\\\":\\\"tesssssssssssst\\\",\\\"address\\\":\\\"tesssssssssssst\\\",\\\"dob\\\":\\\"1928-12-11\\\",\\\"age\\\":\\\"96\\\",\\\"certification\\\":\\\"1\\\",\\\"annual_income\\\":\\\"12321\\\",\\\"other_skills\\\":\\\"tesssssssssssst\\\",\\\"seniorid\\\":\\\"1\\\",\\\"family_composition\\\":[{\\\"name\\\":\\\"tesssssssssssst\\\",\\\"age\\\":\\\"23\\\",\\\"relation\\\":\\\"sadas\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"occupation\\\":\\\"tesssssssssssst\\\",\\\"income\\\":\\\"123123\\\"}]}\"', '2025-11-11 05:43:45', '2025-11-11 05:43:45', NULL, NULL, NULL, 'Unclaimed', NULL, NULL, NULL, NULL),
(15, 12, 3, 4, 3, '2025-11-12 05:44:00', '2025-11-11 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"FERNANDEZ\\\",\\\"first_name\\\":\\\"ERICA\\\",\\\"middle_name\\\":\\\"B\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Female\\\",\\\"place_of_birth\\\":\\\"DAVAO\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"N\\\\\\/A\\\",\\\"occupation\\\":\\\"N\\\\\\/A\\\",\\\"address\\\":\\\"DAVAO\\\",\\\"dob\\\":\\\"1989-03-23\\\",\\\"age\\\":\\\"36\\\",\\\"certification\\\":\\\"1\\\",\\\"referral_slip\\\":\\\"1\\\",\\\"study_load\\\":\\\"1\\\",\\\"student_id\\\":\\\"1\\\",\\\"certificate_of_no_scholarship\\\":\\\"1\\\",\\\"brgy_cert\\\":\\\"1\\\",\\\"cert_ass_off\\\":\\\"1\\\"}\"', '2025-11-12 05:40:24', '2025-11-12 05:44:10', NULL, 3, '2025-11-12 05:44:00', 'Unclaimed', NULL, NULL, NULL, NULL),
(16, 13, 3, 4, 3, '2025-11-14 04:02:52', '2025-11-13 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"TUTING\\\",\\\"first_name\\\":\\\"ERICA\\\",\\\"middle_name\\\":\\\"FERNANDEZ\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Female\\\",\\\"place_of_birth\\\":\\\"DAVAO\\\",\\\"civil_status\\\":\\\"Married\\\",\\\"educational_attainment\\\":\\\"N\\\\\\/A\\\",\\\"occupation\\\":\\\"N\\\\\\/A\\\",\\\"address\\\":\\\"DAVAO\\\",\\\"dob\\\":\\\"1989-03-23\\\",\\\"age\\\":\\\"36\\\",\\\"certification\\\":\\\"1\\\",\\\"referral_slip\\\":\\\"1\\\",\\\"study_load\\\":\\\"1\\\",\\\"student_id\\\":\\\"1\\\",\\\"certificate_of_no_scholarship\\\":\\\"1\\\",\\\"brgy_cert\\\":\\\"1\\\",\\\"cert_ass_off\\\":\\\"1\\\"}\"', '2026-11-13 21:32:01', '2025-11-14 04:03:03', NULL, 3, '2025-11-14 04:02:52', 'Unclaimed', NULL, NULL, NULL, NULL),
(17, 12, 3, 4, 3, '2025-11-14 00:23:34', '2025-11-13 16:00:00', 'approved', '\"{\\\"surname\\\":\\\"FERNANDEZ\\\",\\\"first_name\\\":\\\"ERICA\\\",\\\"middle_name\\\":\\\"B\\\",\\\"name_extension\\\":\\\"N\\\\\\/A\\\",\\\"sex\\\":\\\"Female\\\",\\\"place_of_birth\\\":\\\"DAVAO\\\",\\\"civil_status\\\":\\\"Single\\\",\\\"educational_attainment\\\":\\\"N\\\\\\/A\\\",\\\"occupation\\\":\\\"N\\\\\\/A\\\",\\\"address\\\":\\\"DAVAO\\\",\\\"dob\\\":\\\"1989-02-23\\\",\\\"age\\\":\\\"37\\\",\\\"certification\\\":\\\"1\\\",\\\"referral_slip\\\":\\\"1\\\",\\\"study_load\\\":\\\"1\\\",\\\"student_id\\\":\\\"1\\\",\\\"certificate_of_no_scholarship\\\":\\\"1\\\",\\\"brgy_cert\\\":\\\"1\\\",\\\"cert_ass_off\\\":\\\"1\\\"}\"', '2026-11-13 21:32:50', '2025-11-14 00:23:52', NULL, 3, '2025-11-14 00:23:34', 'Unclaimed', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `batches`
--

CREATE TABLE `batches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `social_worker_id` bigint(20) UNSIGNED NOT NULL,
  `release_date` date NOT NULL,
  `status` enum('Pending','Released') NOT NULL DEFAULT 'Pending',
  `remarks` text DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `beneficiaries`
--

CREATE TABLE `beneficiaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) NOT NULL,
  `name_extension` varchar(255) DEFAULT NULL,
  `dob` date NOT NULL,
  `place_of_birth` varchar(255) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `civil_status` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `program` varchar(255) NOT NULL,
  `program_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(20) NOT NULL,
  `social_worker_id` bigint(20) UNSIGNED DEFAULT NULL,
  `admin_id` bigint(20) UNSIGNED DEFAULT NULL,
  `approved_date` timestamp NULL DEFAULT NULL,
  `date_released` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `beneficiaries`
--

INSERT INTO `beneficiaries` (`id`, `first_name`, `middle_name`, `surname`, `name_extension`, `dob`, `place_of_birth`, `sex`, `civil_status`, `address`, `phone_number`, `program`, `program_id`, `status`, `social_worker_id`, `admin_id`, `approved_date`, `date_released`, `created_at`, `updated_at`) VALUES
(1, 'TESTMARLO', 'BABAYSON', 'ROMERO', 'N/A', '1950-06-13', 'asdsad', 'Male', 'Married', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', 'N/A', 'Senior Citizen', 1, 'pending', 6, NULL, NULL, NULL, '2025-10-13 22:46:46', '2025-10-13 22:46:46'),
(2, 'TESTMARLO', 'BABAYSON', 'ROMEROS', 'N/A', '1950-06-13', 'asdsad', 'Male', 'Single', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', 'N/A', 'Senior Citizen', 1, 'pending', 6, NULL, NULL, NULL, '2025-10-13 22:47:13', '2025-10-13 22:47:13'),
(3, 'TESTMARLO', 'TESTMARLO', 'ROMERO', 'N/A', '1929-03-29', 'asdasd', 'Male', 'Single', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', 'N/A', 'Senior Citizen', 1, 'approved', 6, NULL, NULL, NULL, '2025-10-14 06:56:13', '2025-10-14 17:44:45'),
(4, 'TESTMARLO', NULL, 'ROMERO', 'N/A', '1929-03-29', 'asdasd', 'Male', 'Single', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', 'N/A', 'Educational Assistance', 3, 'approved', 4, NULL, NULL, NULL, '2025-10-14 23:16:00', '2025-10-14 23:21:12'),
(5, 'TESTMARLO', 'BABAYSON', 'ROMERO', 'N/A', '1998-03-23', 'cdo', 'Male', 'Single', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', '9121394070', 'Solo Parent', 2, 'approved', 10, NULL, NULL, NULL, '2025-10-15 17:49:20', '2025-11-11 20:07:09'),
(6, 'MARLO', 'BABAYSON', 'ROMERO', 'N/A', '1998-12-31', 'N/A', 'N/A', 'N/A', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', 'N/A', 'AIFCS', 4, 'approved', 8, NULL, NULL, NULL, '2025-10-15 17:51:46', '2025-11-11 19:49:58'),
(7, 'JUDY', 'S', 'TUTING', 'N/A', '1999-04-17', 'CDO', 'Female', 'Single', 'CDO', 'N/A', 'Educational Assistance', 3, 'approved', 4, NULL, NULL, NULL, '2025-10-17 22:06:29', '2025-11-11 19:49:43'),
(8, 'TESTMARLOss', 'TESTMARLO', 'ROMERO', 'N/A', '1929-03-29', 'asdasd', 'Male', 'Single', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', 'N/A', 'Senior Citizen', 1, 'approved', 6, NULL, NULL, NULL, '2026-10-19 21:07:43', '2025-11-03 04:49:40'),
(9, 'testetst', 'testetst', 'testetst', 'N/A', '1923-10-03', 'asdasd', 'Male', 'Single', 'sdasd', 'N/A', 'Senior Citizen', 1, 'pending', 6, NULL, NULL, NULL, '2025-10-19 21:23:36', '2025-10-19 21:23:36'),
(10, 'asdk', 'asdasd', 'ROMERO', 'N/A', '1231-02-23', '123123123', 'Male', 'Married', 'Zone -3, Puerto, Cagayan de Oro City, Misamis Oriental', 'N/A', 'Senior Citizen', 1, 'approved', 6, NULL, NULL, NULL, '2025-11-10 06:46:41', '2025-11-11 19:31:37'),
(11, 'tesssssssssssst', 'tesssssssssssst', 'tesssssssssssst', 'N/A', '1928-12-11', 'tesssssssssssst', 'Male', 'Single', 'tesssssssssssst', 'N/A', 'Senior Citizen', 1, 'pending', 6, NULL, NULL, NULL, '2025-11-11 05:43:45', '2025-11-11 05:43:45'),
(12, 'ERICA', 'B', 'FERNANDEZ', 'N/A', '1989-03-23', 'DAVAO', 'Female', 'Single', 'DAVAO', 'N/A', 'Educational Assistance', 3, 'approved', 4, NULL, NULL, NULL, '2025-11-12 05:40:24', '2025-11-14 00:35:20'),
(13, 'ERICA', 'FERNANDEZ', 'TUTING', 'N/A', '1989-03-23', 'DAVAO', 'Female', 'Married', 'DAVAO', 'N/A', 'Educational Assistance', 3, 'approved', 4, NULL, NULL, NULL, '2026-11-13 21:32:01', '2025-11-14 05:04:29');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_07_19_090142_create_roles_table', 1),
(7, '2024_07_19_090248_create_programs_table', 1),
(8, '2024_07_19_091743_add_program_id_to_users_table', 1),
(9, '2024_07_19_091807_create_role_user_table', 1),
(10, '2024_07_20_033537_create_beneficiaries_table', 1),
(11, '2024_07_20_060833_update_beneficiaries_table', 1),
(12, '2024_07_20_125546_add_program_id_to_beneficiaries_table', 1),
(13, '2024_07_22_034108_remove_email_phone_table', 1),
(14, '2024_07_26_145747_create_permission_tables', 1),
(15, '2024_07_28_165553_change_status_column_in_beneficiaries_table', 1),
(16, '2024_09_14_204915_add_status_to_users_table', 1),
(17, '2024_10_15_055430_create_applications_table', 1),
(18, '2024_10_15_055600_move_beneficiary_data_to_applications', 1),
(19, '2024_11_02_074202_add_remarks_to_applications_table', 1),
(20, '2024_11_02_082831_add_updated_by_to_applications_table', 1),
(21, '2024_11_03_035424_add_approval_date_to_applications_table', 1),
(22, '2024_11_21_051521_add_claim_fields_to_applications_table', 1),
(23, '2024_11_21_052412_add_batch_release_fields_to_applications_table', 1),
(24, '2024_11_24_150932_add_program_type_to_programs_table', 1),
(25, '2024_11_24_152448_add_batch_table', 1),
(26, '2024_11_25_064142_update_applications_table', 1),
(27, '2024_11_28_132743_add_name_extension_and_place_of_birth_to_beneficiaries_table', 1),
(28, '2024_11_28_135829_add_civil_status_to_beneficiaries_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(255) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `guard_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `programs`
--

CREATE TABLE `programs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `program_type` enum('financial','non-financial') NOT NULL DEFAULT 'non-financial',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `programs`
--

INSERT INTO `programs` (`id`, `name`, `program_type`, `created_at`, `updated_at`) VALUES
(1, 'Senior Citizen', 'non-financial', '2025-10-13 20:41:54', '2025-10-13 20:41:54'),
(2, 'Solo Parent', 'non-financial', '2025-10-13 20:41:54', '2025-10-13 20:41:54'),
(3, 'Educational Assistance', 'financial', '2025-10-13 20:41:54', '2025-10-13 20:41:54'),
(4, 'AIFCS', 'financial', '2025-10-13 20:41:54', '2025-10-13 20:41:54');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'super_admin', '2025-10-13 20:41:53', '2025-10-13 20:41:53'),
(2, 'admin', '2025-10-13 20:41:53', '2025-10-13 20:41:53'),
(3, 'social_worker', '2025-10-13 20:41:53', '2025-10-13 20:41:53');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 2, NULL, NULL),
(3, 3, 2, NULL, NULL),
(4, 4, 3, NULL, NULL),
(6, 5, 2, NULL, NULL),
(9, 6, 3, NULL, NULL),
(10, 7, 2, NULL, NULL),
(11, 8, 3, NULL, NULL),
(12, 9, 2, NULL, NULL),
(13, 10, 3, NULL, NULL),
(15, 12, 2, NULL, NULL),
(16, 11, 3, NULL, NULL),
(17, 13, 2, NULL, NULL),
(18, 14, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `program_id` bigint(20) UNSIGNED DEFAULT NULL,
  `status` enum('active','inactive') NOT NULL DEFAULT 'active'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `program_id`, `status`) VALUES
(1, 'Super Admin', 'superadmin@example.com', NULL, '$2y$10$doJIxDQtwaBd3.Js9gIoCed9W2Fy3Yne9tLVIaRV3sRscDRk.IE9m', NULL, '2025-10-13 20:41:53', '2025-10-13 20:41:53', NULL, 'active'),
(2, 'marloadmin1', 'marloadmin@gmail.com', NULL, '$2y$10$hfzPOSwtHQoC49M4ULjIBu09PsS3AZp8qUSwJe1.qWa5iLdETO8u6', NULL, '2025-10-13 20:44:17', '2025-10-13 21:56:03', 1, 'active'),
(3, 'adminEA', 'adminEA@gmail.com', NULL, '$2y$10$2Lz86xUz2czAcR0HELW4KO6Y3QwTF.HhpczFciDWBtAPsoFgxWYE2', NULL, '2025-10-13 21:12:44', '2025-10-17 22:07:51', 3, 'active'),
(4, 'socialworkerEA', 'socialworkerEA@gmail.com', NULL, '$2y$10$OKJyuixvwm/XHsiQjFMWi.hyYCKWieExZvXqlNeoT5sQqyad14/pq', NULL, '2025-10-13 22:07:55', '2025-10-13 22:07:55', 3, 'active'),
(5, 'adminSC', 'adminSC@gmail.com', NULL, '$2y$10$fNC7YQYlw5PVR1LY3o8mo.VntbwtKbTnlSZ0SYotaNpblo7nkqgRG', NULL, '2025-10-13 22:43:21', '2025-10-13 22:43:21', 1, 'active'),
(6, 'swSC', 'swSC@gmail.com', NULL, '$2y$10$LIjnXW/YI/kwNPgI9KHrP.E6jZ88jQsGvAUkcnBMQY0rLC.IoIO.K', NULL, '2025-10-13 22:44:35', '2025-10-13 22:44:35', 1, 'active'),
(7, 'adminAIFCS', 'adminAIFCS@gmail.com', NULL, '$2y$10$xgL7h9KYi6FFbeQoTBKrkuhyS2.jnVfDi30kLfjd632QR8o61.TBe', NULL, '2025-10-15 17:45:26', '2025-10-15 17:45:26', 4, 'active'),
(8, 'socialwokerAIFCS', 'socialwokerAIFCS@gmail.com', NULL, '$2y$10$6kYKdB.AK38..bcGwv/Z6uz2NUX.m119M5Sr2Iaub00IA/Y82VFBa', NULL, '2025-10-15 17:45:48', '2025-10-15 17:45:48', 4, 'active'),
(9, 'adminSP', 'adminSP@gmail.com', NULL, '$2y$10$qrup75OXVgeLcPkUZZMh3.VDNWFyIamOjo11oBV8PNk7mC28nbNXq', NULL, '2025-10-15 17:46:15', '2025-10-26 23:42:59', 2, 'active'),
(10, 'socialwokerSP', 'socialwokerSP@gmail.com', NULL, '$2y$10$f51N4UpyeNb6LEEIzqzEHe3VIekOZ3aryaFk0fcsKL.69BW9lW7tK', NULL, '2025-10-15 17:46:31', '2025-10-15 17:46:31', 2, 'active'),
(11, 'swSC2', 'swSC2@gmail.com', NULL, '$2y$10$x1Bx42UbvNmAiDxbmxn9fuGmPxRTgoC7E4FxkOezjQ8l4FPA/zynK', NULL, '2025-11-03 04:33:58', '2025-11-11 17:55:22', 1, 'active'),
(12, 'swSP2', 'swSP2@gmail.com', NULL, '$2y$10$Lj9T78A54PmOWxmRhILaNO2Sc5MG1Xd68e/phWb4iJskR/cQq30wK', NULL, '2025-11-03 04:34:32', '2025-11-03 04:34:32', 2, 'active'),
(13, 'adminsc2', 'adminsc2@gmail.com', NULL, '$2y$10$cNwxFJpiuvwUL3eHnSJ5DO13VFumYKPv4fdQGHMBJlKw/CnmGbjC6', NULL, '2025-11-11 17:57:13', '2025-11-11 17:57:13', 1, 'active'),
(14, 'adminsc2', 'adminsc12@gmail.com', NULL, '$2y$10$0PkpnoSMMfMrM5wA8ZVRveEMxmTdJCJSuSnFC29DcFajI7J0iQz3a', NULL, '2025-11-11 17:57:30', '2025-11-11 17:57:30', 1, 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `applications`
--
ALTER TABLE `applications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `applications_beneficiary_id_foreign` (`beneficiary_id`),
  ADD KEY `applications_program_id_foreign` (`program_id`),
  ADD KEY `applications_social_worker_id_foreign` (`social_worker_id`),
  ADD KEY `applications_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `batches`
--
ALTER TABLE `batches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `batches_name_unique` (`name`),
  ADD KEY `batches_social_worker_id_foreign` (`social_worker_id`);

--
-- Indexes for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `beneficiaries_program_id_foreign` (`program_id`),
  ADD KEY `beneficiaries_social_worker_id_foreign` (`social_worker_id`),
  ADD KEY `beneficiaries_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`role_id`,`model_id`,`model_type`),
  ADD KEY `model_has_roles_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_guard_name_unique` (`name`,`guard_name`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `programs`
--
ALTER TABLE `programs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `role_has_permissions_role_id_foreign` (`role_id`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_program_id_foreign` (`program_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `applications`
--
ALTER TABLE `applications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `batches`
--
ALTER TABLE `batches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `programs`
--
ALTER TABLE `programs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `applications`
--
ALTER TABLE `applications`
  ADD CONSTRAINT `applications_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_beneficiary_id_foreign` FOREIGN KEY (`beneficiary_id`) REFERENCES `beneficiaries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `applications_social_worker_id_foreign` FOREIGN KEY (`social_worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `batches`
--
ALTER TABLE `batches`
  ADD CONSTRAINT `batches_social_worker_id_foreign` FOREIGN KEY (`social_worker_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `beneficiaries`
--
ALTER TABLE `beneficiaries`
  ADD CONSTRAINT `beneficiaries_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `beneficiaries_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `beneficiaries_social_worker_id_foreign` FOREIGN KEY (`social_worker_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD CONSTRAINT `model_has_roles_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_has_permissions_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_program_id_foreign` FOREIGN KEY (`program_id`) REFERENCES `programs` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
