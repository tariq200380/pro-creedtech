-- ============================================================
-- CREED TECH ENTERPRISE - MASTER SQL DATABASE SCHEMA & SEED DATA
-- Version: 2.0 (Compatible with MySQL 5.7+, 8.0+, MariaDB, phpMyAdmin)
-- Character Set: utf8mb4 / utf8mb4_unicode_ci
-- ============================================================

SET FOREIGN_KEY_CHECKS = 0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- --------------------------------------------------------
-- 1. TABLE: contact_inquiries (Contact Us Submissions)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `contact_inquiries`;
CREATE TABLE IF NOT EXISTS `contact_inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `company` VARCHAR(255) DEFAULT NULL,
  `phone` VARCHAR(100) DEFAULT NULL,
  `service` VARCHAR(100) DEFAULT 'Software Development',
  `project_details` TEXT NOT NULL,
  `need_nda` TINYINT(1) DEFAULT 1,
  `admin_notes` TEXT DEFAULT NULL,
  `status` ENUM('PENDING', 'IN_REVIEW', 'CONTACTED', 'ARCHIVED') DEFAULT 'PENDING',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  INDEX (`email`),
  INDEX (`status`),
  INDEX (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contact_inquiries` (`id`, `full_name`, `email`, `company`, `phone`, `service`, `project_details`, `need_nda`, `admin_notes`, `status`, `created_at`) VALUES
(1, 'Alexander Vance', 'alexander.vance@fintech-global.de', 'FinTech Global Group', '+49 69 9876543', 'Software Development', 'We require a high-concurrency microservices platform handling 15k requests/sec with real-time settlement.', 1, 'Priority client from Frankfurt. Technical discovery scheduled.', 'PENDING', '2026-08-15 06:45:00'),
(2, 'Dr. Elena Rostova', 'elena@neural-bio.es', 'Neural BioTech Labs', '+34 91 123 4567', 'AI & Automation', 'Private sovereign RAG pipeline fine-tuned on 40,000 biomedical PDFs with zero public model data leakage.', 1, 'Requires Spanish data sovereignty compliance.', 'IN_REVIEW', '2026-08-14 21:20:00'),
(3, 'Marcus Sterling', 'm.sterling@apex-global.co.uk', 'Apex Global Settlement Rail', '+44 20 7946 0912', 'Cloud Infrastructure', 'Zero-downtime multi-region Kubernetes migration across Frankfurt and Dublin with SOC 2 compliance.', 1, 'Milestone 1 contract sent for review.', 'CONTACTED', '2026-08-13 14:10:00');

-- --------------------------------------------------------
-- 2. TABLE: vision_inquiries (Vision To Life Service Requests)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `vision_inquiries`;
CREATE TABLE IF NOT EXISTS `vision_inquiries` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(100) DEFAULT NULL,
  `engagement_type` ENUM('Dedicated Team', 'Staff Augmentation', 'Fixed Price Project') DEFAULT 'Dedicated Team',
  `role_needed` VARCHAR(255) NOT NULL,
  `message` TEXT NOT NULL,
  `attachment_name` VARCHAR(255) DEFAULT NULL,
  `admin_notes` TEXT DEFAULT NULL,
  `status` ENUM('NEW', 'IN_REVIEW', 'CONTACTED', 'ARCHIVED') DEFAULT 'NEW',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (`email`),
  INDEX (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `vision_inquiries` (`id`, `full_name`, `email`, `phone`, `engagement_type`, `role_needed`, `message`, `attachment_name`, `admin_notes`, `status`, `created_at`) VALUES
(1, 'Michael Sterling', 'm.sterling@hyper-scale.com', '+1 (415) 890-4820', 'Dedicated Team', 'AI Developers (4 Senior)', 'Looking to hire a dedicated pod of 4 senior AI engineers to build multi-agent autonomous workflows for our enterprise portal.', 'ai_architecture_specs.pdf', 'Requested 4 senior engineers for 12 months.', 'NEW', '2026-08-15 07:15:00'),
(2, 'Sophia Martinez', 'sophia@iberia-cloud.es', '+34 91 555 7890', 'Fixed Price Project', 'Cloud & DevOps Architects', 'Complete Kubernetes cluster migration with automated multi-region failover between Frankfurt and Madrid data centers.', 'cloud_migration_scope.docx', 'Fixed sprint scope estimated at 8 weeks.', 'IN_REVIEW', '2026-08-14 16:30:00');

-- --------------------------------------------------------
-- 3. TABLE: articles (Knowledge Center & Blog Articles)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `slug` VARCHAR(255) NOT NULL UNIQUE,
  `title` VARCHAR(500) NOT NULL,
  `category` VARCHAR(100) DEFAULT 'Technology',
  `source` VARCHAR(255) DEFAULT 'Creed Tech Editorial',
  `read_time` VARCHAR(50) DEFAULT '4 min read',
  `summary` TEXT NOT NULL,
  `content_html` LONGTEXT DEFAULT NULL,
  `image_url` VARCHAR(500) DEFAULT NULL,
  `video_url` VARCHAR(500) DEFAULT NULL,
  `is_hero` TINYINT(1) DEFAULT 0,
  `is_published` TINYINT(1) DEFAULT 1,
  `view_count` INT DEFAULT 0,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (`slug`),
  INDEX (`is_published`),
  INDEX (`category`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `articles` (`id`, `slug`, `title`, `category`, `source`, `read_time`, `summary`, `image_url`, `is_hero`, `is_published`, `view_count`, `created_at`) VALUES
(1, 'cloud-ai-breakthrough-2026', 'Global Cloud Infrastructures Shift to Autonomous AI Agents for Real-Time Threat Isolation', 'Cloud & AI Breakthrough', 'Bloomberg Intelligence', '4 min read', 'Enterprise architectures are adopting multi-agent neural orchestration to automate hybrid cloud workloads, slashing compute latency by 45% while achieving automated cryptographic defense.', 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?q=80&w=1000&auto=format&fit=crop', 1, 1, 142000, '2026-08-15 00:00:00'),
(2, 'ai-history-1950-1965', 'Artificial Intelligence Development from 1950 to 1965: The Foundation of Modern AI Research', 'AI Research Archive', 'Creed Tech Labs', '6 min read', 'An institutional look back at symbolic reasoning, early neural networks, and how 1950s foundational mathematics shaped modern large language models.', 'https://images.unsplash.com/photo-1618005182384-a83a8bd57fbe?q=80&w=800&auto=format&fit=crop', 0, 1, 89000, '2026-08-12 00:00:00'),
(3, 'distributed-zero-trust-2026', 'Zero-Trust Architecture & Hardware-Level Cryptographic Key Custody in FinTech Rails', 'Security & Infrastructure', 'Creed Security Bureau', '5 min read', 'Why software perimeter firewalls are obsolete and how FIPS 140-2 Level 3 Hardware Security Modules (HSM) secure modern transactional rails.', 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?q=80&w=800&auto=format&fit=crop', 0, 1, 64000, '2026-08-10 00:00:00');

-- --------------------------------------------------------
-- 4. TABLE: video_library (Video Keynotes & Feature Demos)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `video_library`;
CREATE TABLE IF NOT EXISTS `video_library` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(500) NOT NULL,
  `duration` VARCHAR(50) DEFAULT '10:00',
  `video_url` VARCHAR(500) NOT NULL,
  `thumbnail` VARCHAR(500) DEFAULT NULL,
  `category` VARCHAR(100) DEFAULT 'General',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `video_library` (`id`, `title`, `duration`, `video_url`, `thumbnail`, `category`, `created_at`) VALUES
(1, 'What Are Social Advertising Algorithms & Conversion Tracking in 2026?', '14:20', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?q=80&w=800&auto=format&fit=crop', 'Digital Ads & Scale', '2026-04-25 00:00:00'),
(2, 'Architecting Sovereign AI Agents & LLM Fine-Tuning Pipelines', '22:45', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'https://images.unsplash.com/photo-1526374965328-7f61d4dc18c5?q=80&w=800&auto=format&fit=crop', 'Artificial Intelligence', '2026-04-18 00:00:00'),
(3, 'Multi-Region Kubernetes Failover with Zero Data Loss', '18:10', 'https://www.youtube.com/watch?v=dQw4w9WgXcQ', 'https://images.unsplash.com/photo-1544197150-b99a580bb7a8?q=80&w=800&auto=format&fit=crop', 'DevOps & SRE', '2026-04-10 00:00:00');

-- --------------------------------------------------------
-- 5. TABLE: client_reviews (Testimonials & Endorsements)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `client_reviews`;
CREATE TABLE IF NOT EXISTS `client_reviews` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `author_name` VARCHAR(255) NOT NULL,
  `author_role` VARCHAR(255) NOT NULL,
  `company` VARCHAR(255) DEFAULT NULL,
  `avatar_url` VARCHAR(500) DEFAULT NULL,
  `quote` TEXT NOT NULL,
  `rating` TINYINT DEFAULT 5,
  `is_approved` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `client_reviews` (`id`, `author_name`, `author_role`, `company`, `avatar_url`, `quote`, `rating`, `is_approved`, `created_at`) VALUES
(1, 'Marcus Vance', 'VP of Engineering', 'Apex Global UK', 'https://images.unsplash.com/photo-1534528741775-53994a69daeb?q=80&w=300&auto=format&fit=crop', 'Creed Tech transformed our legacy database into an automated distributed cluster with zero downtime across 15 countries.', 5, 1, '2026-08-01 00:00:00'),
(2, 'Sarah Jenkins', 'Head of Digital Strategy', 'Nexus Logistics Germany', 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=300&auto=format&fit=crop', 'The engineering caliber is unmatched. Their senior pods delivered our enterprise mobile app 3 weeks ahead of deadline.', 5, 1, '2026-08-03 00:00:00'),
(3, 'Dr. Aris Thorne', 'Chief Medical Information Officer', 'Cognitive Health Analytics USA', 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=300&auto=format&fit=crop', 'Sovereign HIPAA-compliant AI pipelines executed flawlessly with 99.4% diagnostic accuracy and total data isolation.', 5, 1, '2026-08-05 00:00:00');

-- --------------------------------------------------------
-- 6. TABLE: talent_applicants (Careers & Pod Registrations)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `talent_applicants`;
CREATE TABLE IF NOT EXISTS `talent_applicants` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `full_name` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(100) DEFAULT NULL,
  `specialty` VARCHAR(255) NOT NULL,
  `portfolio_url` VARCHAR(500) DEFAULT NULL,
  `notes` TEXT DEFAULT NULL,
  `status` ENUM('NEW', 'SHORTLISTED', 'INTERVIEW_SCHEDULED', 'HIRED', 'REJECTED') DEFAULT 'NEW',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (`email`),
  INDEX (`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `talent_applicants` (`id`, `full_name`, `email`, `phone`, `specialty`, `portfolio_url`, `notes`, `status`, `created_at`) VALUES
(1, 'Julian Alvarez', 'julian.alvarez@dev.io', '+34 91 999 8877', 'Rust & Distributed Systems', 'https://github.com/jalvarez', 'Ex-defense backend architect with 8 years Rust/C++ experience.', 'SHORTLISTED', '2026-08-14 10:00:00'),
(2, 'Hannah Becker', 'hannah.becker@cloud-eng.de', '+49 69 4433221', 'Kubernetes & SRE Infrastructure', 'https://github.com/hbecker', 'CKA & CKS certified Kubernetes administrator.', 'NEW', '2026-08-15 08:30:00');

-- --------------------------------------------------------
-- 7. TABLE: newsletter_subscribers (Email Newsletter Leads)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `newsletter_subscribers`;
CREATE TABLE IF NOT EXISTS `newsletter_subscribers` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `source` VARCHAR(100) DEFAULT 'FOOTER_STRIP',
  `is_active` TINYINT(1) DEFAULT 1,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  INDEX (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `newsletter_subscribers` (`id`, `email`, `source`, `is_active`, `created_at`) VALUES
(1, 'cto@enterprise-cloud.de', 'FOOTER_STRIP', 1, '2026-08-10 12:00:00'),
(2, 'lead.arch@fintech-ny.com', 'KNOWLEDGE_CENTER', 1, '2026-08-12 15:30:00'),
(3, 'alex@berlin-tech.io', 'FOOTER_STRIP', 1, '2026-08-14 09:15:00');

-- --------------------------------------------------------
-- 8. TABLE: users (Admin Authentication Credentials)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `username` VARCHAR(100) NOT NULL UNIQUE,
  `email` VARCHAR(255) NOT NULL UNIQUE,
  `password` VARCHAR(255) NOT NULL,
  `role` VARCHAR(50) DEFAULT 'admin',
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Default Admin: admin / admin123 (MD5 & standard hash compatible)
INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `created_at`) VALUES
(1, 'admin', 'admin@creed-tech.com', '0192023a7bbd73250516f069df18b500', 'superadmin', '2026-08-01 00:00:00');

-- --------------------------------------------------------
-- 9. LEGACY COMPATIBILITY TABLES (blog & contact)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `blog`;
CREATE TABLE IF NOT EXISTS `blog` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `title` VARCHAR(255) NOT NULL,
  `description` LONGTEXT NOT NULL,
  `blog_image` VARCHAR(255) DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `blog` (`id`, `title`, `description`, `blog_image`) VALUES
(1, 'Global Cloud Infrastructures Shift to Autonomous AI Agents', 'Enterprise architectures are adopting multi-agent neural orchestration to automate hybrid cloud workloads.', 'blog.webp'),
(2, 'Artificial Intelligence Development: Foundations of Modern AI', 'An institutional look back at symbolic reasoning, early neural networks, and mathematical models.', 'blog.webp');

DROP TABLE IF EXISTS `contact`;
CREATE TABLE IF NOT EXISTS `contact` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `fname` VARCHAR(100) DEFAULT NULL,
  `lname` VARCHAR(100) DEFAULT NULL,
  `email` VARCHAR(255) NOT NULL,
  `phone` VARCHAR(100) DEFAULT NULL,
  `service` VARCHAR(100) DEFAULT NULL,
  `message` TEXT NOT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- 10. TABLE: live_news (Live Multi-Provider Syndicated News & Image Tracking)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `live_news`;
CREATE TABLE IF NOT EXISTS `live_news` (
  `id` INT AUTO_INCREMENT PRIMARY KEY,
  `provider` VARCHAR(50) NOT NULL,
  `external_article_id` VARCHAR(255) NOT NULL,
  `wire_type` VARCHAR(50) DEFAULT 'brand',
  `wire_key` VARCHAR(50) DEFAULT NULL,
  `category` VARCHAR(100) DEFAULT NULL,
  `brand_badge` VARCHAR(100) DEFAULT NULL,
  `caption_tag` VARCHAR(100) DEFAULT NULL,
  `caption` VARCHAR(255) DEFAULT NULL,
  `title` VARCHAR(500) NOT NULL,
  `summary` TEXT DEFAULT NULL,
  `source_name` VARCHAR(255) DEFAULT NULL,
  `source_url` VARCHAR(2048) DEFAULT NULL,
  `source_image_url` VARCHAR(2048) DEFAULT NULL,
  `image_url` VARCHAR(2048) DEFAULT NULL,
  `local_image_path` VARCHAR(2048) DEFAULT NULL,
  `image_hash` VARCHAR(64) DEFAULT NULL,
  `image_updated_at` TIMESTAMP NULL DEFAULT NULL,
  `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  UNIQUE KEY `uk_provider_article` (`provider`, `external_article_id`),
  INDEX (`wire_type`),
  INDEX (`wire_key`),
  INDEX (`created_at`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS = 1;

-- ============================================================
-- END OF CREED TECH MASTER DATABASE DUMP
-- ============================================================
