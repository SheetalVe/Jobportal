-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2019 at 11:17 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `job_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_application_form`
--

CREATE TABLE `tbl_application_form` (
  `id` bigint(11) NOT NULL,
  `genrated_id` varchar(255) NOT NULL,
  `position_applied` varchar(255) NOT NULL,
  `exp_sal` varchar(255) NOT NULL,
  `when_join_company` varchar(255) NOT NULL,
  `referral_source` enum('1','2','3','4') NOT NULL COMMENT '1=>Advertisement,2=>Employee,3=>Employment Agency,4=>Other',
  `name_of_source` varchar(255) NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_application_form`
--

INSERT INTO `tbl_application_form` (`id`, `genrated_id`, `position_applied`, `exp_sal`, `when_join_company`, `referral_source`, `name_of_source`, `created_at`, `updated_at`) VALUES
(1, 'RNmYL0AidRBi4uV3S2gbL4lNoWzfIZ83', 'eyJpdiI6IkYxV0xTQlc0YytVaTZ4c2x6WlA4RXc9PSIsInZhbHVlIjoiMUIwWFwvWnFycjdTWkZnV05YWDVyN3c9PSIsIm1hYyI6IjEyYmRmMDdjNjJhOWEyYzMwYzJlZWVmMjI5M2RmODc3ODc0Njg3ZTQ3ZTRmZjY2MDBmNGNiODkzNjc2YTU5ZmUifQ==', 'eyJpdiI6IkRNZEV0UVg2TzdZRm5OVGJoTjdmXC9nPT0iLCJ2YWx1ZSI6IlVnXC8zTGtmR0czZG1oNXB4YkJWdzV3PT0iLCJtYWMiOiIxOTU4YmIwNTc0NDE2NjZhNzhiMmEyODkzNjU0MWJkYzBlZDRiYTAwMzJkZjNiODc3MDU1OTQ2NzYzYzI4MWFlIn0=', 'eyJpdiI6ImxhU2kyMnBWbytaMjZRWFkxYXI1XC93PT0iLCJ2YWx1ZSI6IjZiZlcyZ1RwOU5IK3NhTEZrZ2J2dXc9PSIsIm1hYyI6IjIwNmE1ODIzYTQwNTVmMjIxZWViMzQ3MTA3ZmY4NWRiMGE4NDE3MTUzNzY3YTUxNzUzMDA3NGY2YzQ4ODMwNDIifQ==', '2', 'eyJpdiI6Ik82cGRzRlByUFZHRGx0dWV3NDduZUE9PSIsInZhbHVlIjoiV2gwTDlQMllsSmp0d0RiNGxMWHBxdz09IiwibWFjIjoiZjdiOGRjNDlkYTIyNDM1ZTlmYmE4OTg2ZjgzMDIzMzQ5YjZmZTk5ZTRjNDE0M2UxNTE1NjJjYWRhYmJlN2JhYSJ9', '2019-04-23', '2019-04-23 07:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_detail`
--

CREATE TABLE `tbl_user_detail` (
  `id` bigint(11) NOT NULL,
  `application_id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `gender` enum('m','f','o','') NOT NULL,
  `passport_number` varchar(255) NOT NULL,
  `religion` enum('1','2','3','4','5','6','7') NOT NULL COMMENT '1=>Hindu,2=>Buddhist,3=>Taoism,4=>Catholic,5=>Christian,6=>Free Thinker,7=>Other',
  `citizenship` varchar(255) NOT NULL,
  `marital_status` enum('1','2','3','4','5') NOT NULL COMMENT '1=>single,2=>Married,3=>Divorced,4=>Separated,5=>Widowed',
  `race` varchar(255) NOT NULL,
  `nationality` varchar(255) NOT NULL,
  `driving_licence` varchar(255) NOT NULL,
  `cns` enum('Yes','No','Extempted','Not Liable') NOT NULL,
  `home_address` text NOT NULL,
  `home_tel` varchar(255) NOT NULL,
  `email_id` varchar(255) NOT NULL,
  `dob_place` varchar(255) NOT NULL,
  `pass_type` varchar(255) NOT NULL,
  `pass_issued` varchar(255) NOT NULL,
  `interest` text NOT NULL,
  `emergency_name` varchar(100) NOT NULL,
  `emergency_tel` varchar(100) NOT NULL,
  `emergency_address` text NOT NULL,
  `created_at` date NOT NULL,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_user_detail`
--

INSERT INTO `tbl_user_detail` (`id`, `application_id`, `full_name`, `gender`, `passport_number`, `religion`, `citizenship`, `marital_status`, `race`, `nationality`, `driving_licence`, `cns`, `home_address`, `home_tel`, `email_id`, `dob_place`, `pass_type`, `pass_issued`, `interest`, `emergency_name`, `emergency_tel`, `emergency_address`, `created_at`, `updated_at`) VALUES
(1, 1, 'eyJpdiI6IjlYbmJpdHdxUDFETTlncXVucTg0Y1E9PSIsInZhbHVlIjoiVVhRXC85VWZXVkVoVXg4b1c0eWxKbEE9PSIsIm1hYyI6IjUzMWZkYjVmYWFkNDZhMmY1MGI5MTYwMzE0ZmM0ZTA0YWQ5MTdiNzk1ZWMyMDgxN2NkZDk2NGIzODc5MWIzZjkifQ==', '', 'eyJpdiI6Im1ZTVRmWDEzNlFLbGFpNFhSdHNseUE9PSIsInZhbHVlIjoiTVR6SmdWYjlmVGxJY3RtTDR2a0k3dz09IiwibWFjIjoiZWY0OGFmMmQ4MzQ4YmI5NTZlYWVmMWFjNjgyOWIwZjZjZGUwNTNlN2M2YzM3M2E2OGQwODQ4NTQ2MGRkMjJkZSJ9', '1', 'eyJpdiI6InVwN2FhWGtlb3JPcFFXYlJPbnExN2c9PSIsInZhbHVlIjoiWlpnWFdkNVJ1QVVGRHlPZ3diMGhVZz09IiwibWFjIjoiODcyNjY4MjBjZGJmZDQyMGZkYzlkNjE5M2QyYzlkZDNhNWI2NGRmZWI0ZjJkZDFkZTgxZGRkOTc2NTI5ZDJlMSJ9', '', 'eyJpdiI6IncwRUJLSjhoMWphMHlhK0NGdE9hdEE9PSIsInZhbHVlIjoiXC94VUI0RXUxY0lCckVBRmMwVVB2SkE9PSIsIm1hYyI6IjRmZjYzM2YxNzQ4NzBkN2YxNWQ1MTRkZjU5YTk0YmE1MTA0YjJiYWZjMGQxZGIzZmJiZTZkMmQ1NjA2ODg1YzQifQ==', 'eyJpdiI6IkZ5OWQyaFh1MXlVcGZHczkrWmU4OWc9PSIsInZhbHVlIjoiTGhPWHMxZU1pVkVDWkJhTU0ybkRXQT09IiwibWFjIjoiMWE1YWM1ODU5MzQwMmJiYjFkYTM3NDc0NDlhMjc2OWYzYjMyNzdjYzhkNTY4ZjdkODBhMzEzMzNlMTA3MWE0ZiJ9', 'eyJpdiI6IkUxTXVcL0tuM1B3OHhqZFcxS01BXC8wQT09IiwidmFsdWUiOiI4VEtRbHRDOEEycUk4K29qeFNreCt3PT0iLCJtYWMiOiI2MGJhODA0ZjAyYjQyNTk2ZjMzMjg5NDBkN2M0OTY0MmZjMmQ4ZDk1YTg3N2UzMGMyOTU3NzU3ZWI3M2E5MzIxIn0=', '', 'eyJpdiI6ImY2aU9QRkMwVEc0T1V0XC85YzdFeUFnPT0iLCJ2YWx1ZSI6IjlrcnB1N1hmYnlcL3dnMmE0VmhXNk5XeU5oWkk3RnFvZGxRYXAxV24ybGppbW10a3lcLzE1ZUJROUVJeU5MQ1VlanRDRm1mMUZjU3JPRDh4N1NEc0czVWFSYjBSNHo4ejJyenREUVd1RnFoSFE9IiwibWFjIjoiMWFhZmQ5NGYwZDBjOTgzYzgyZWVlZjU5ZGExMmFkNzRhZmY0NGNlMWE0MTU2NjZhY2M1MmMxN2E2YzgxZWY2OCJ9', 'eyJpdiI6Ik1tdmxaUUpNcjBjM0R3WXZyR3UzS2c9PSIsInZhbHVlIjoiQ1lNaklzY2pOWXVVVHFrY3dxTGlBQT09IiwibWFjIjoiZDc3YTdlN2M2NThmZTgwYjAyNDIxY2QzODg4MzA3OGMwZTRiOTU4YTVhOTg1ZDIwY2MxNWEzZmNmMGFkNDBmZCJ9', 'eyJpdiI6IjhVeXh1UTM2bFJUbmU4S2FnVDJPMUE9PSIsInZhbHVlIjoiUE1oY3p5SFRpXC9NV0d6TG9MRWtaNFE9PSIsIm1hYyI6IjBmN2IwMDhhOTdlZGU5ZGFkY2M5MTFiYzMxYjA5NGZmMDllZTU0ZjIzMTE5NmQ0OTkwN2MyNGFhZTRlYjQ4NmYifQ==', 'eyJpdiI6InZ2YXNhMTZWdm5mZHFlQ1BKakdWOHc9PSIsInZhbHVlIjoickJHcFlrXC9yZGZXd3FkU2hXYW4rMkE9PSIsIm1hYyI6IjE1YzNmNzU5MGZiNWEzMTFkMzg0ZjA3NTMyZDM5ZmQ1ZjZkOTExMDg5NjgxNjNmZjY4ZmZiYWM4ODljODMwODMifQ==', 'eyJpdiI6IkVuVHkzcmdPODlZQktsanlITFQzSHc9PSIsInZhbHVlIjoiMHU0bG94b3R0dFhydW9oTjQ3cXVwUT09IiwibWFjIjoiMWI2ZDhiYTEzNDE1ZjFhNjVhMGI0M2U5YjdmMjliYmNkYjkzNjE4ODc3MDE0ZjFlZTNlYzAyZTdiNGUyMDE2OCJ9', 'eyJpdiI6IlJ5Sjk5VXZXQVVMckU1ZU94OE1jdHc9PSIsInZhbHVlIjoiUmY0SlJwY3pqV3NIdTN2UnRBd1F5UT09IiwibWFjIjoiYjg4OWQ0MTljYzE4ZWUwMjc4ZTFmMDgwMTQ5ZWIzMWNmMGMxNjUyOTgwNjg0NWMyNjBiMzAyYWNjYjk3MmFlNiJ9', '', 'eyJpdiI6InlqWFROemtXeUhDZDhHS2hjYmp2blE9PSIsInZhbHVlIjoiSFQ5a3hLaFVKczhpc3NKNFJyaTlUdz09IiwibWFjIjoi', 'eyJpdiI6IkFtRmt6SjVkTUFZNTV2SXA2dzBJQXc9PSIsInZhbHVlIjoiRUxLUGtUSURaZTFDSGFlWVpvUnVpQT09IiwibWFjIjoi', 'eyJpdiI6IjNmVVVQUkhSbnFLTHl1dmoyTkFnSEE9PSIsInZhbHVlIjoiRUtjNXo3dTlaYmZaRSsrNVwveU5SMDRZQ25UeTNUYm9tVlhRbFN0SmNYZEtVSXV5d0VnNU4zSXV3QWZtNzJaOGZGYlZCQjJTMlV6UHJRUjJhcnRvMDFVNG5pWnNFMzExd1drdmtta25cL1wvXC80PSIsIm1hYyI6IjEyNzcxMjliMzIyMzhhOTcwYTIyMjVhOTI4ZWZhOTQwOGViZTNiZWVlN2U3ZDc1MzgyZWQ5NmYxNzljNmY2YjMifQ==', '2019-04-23', '2019-04-23 07:17:58');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_application_form`
--
ALTER TABLE `tbl_application_form`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_user_detail`
--
ALTER TABLE `tbl_user_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_application_form`
--
ALTER TABLE `tbl_application_form`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_user_detail`
--
ALTER TABLE `tbl_user_detail`
  MODIFY `id` bigint(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
