-- ============================================
-- Netmatters Database Schema
-- Database name: netmatters
-- ============================================


-- NEWS POSTS TABLE


CREATE TABLE IF NOT EXISTS `news_posts` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(255) NOT NULL,
    `summary` TEXT NOT NULL,
    `image` VARCHAR(255) NOT NULL,
    `image_alt` VARCHAR(255) NOT NULL,
    `category` VARCHAR(100) NOT NULL,
    `category_slug` VARCHAR(100) NOT NULL,
    `author_name` VARCHAR(100) NOT NULL DEFAULT 'Netmatters Ltd',
    `author_avatar` VARCHAR(255) NOT NULL DEFAULT 'img/news/netmatters-avatar.webp',
    `posted_date` DATE NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- CONTACT SUBMISSIONS TABLE


CREATE TABLE IF NOT EXISTS `contact_submissions` (
    `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone` VARCHAR(50) DEFAULT NULL,
    `company` VARCHAR(100) DEFAULT NULL,
    `message` TEXT NOT NULL,
    `marketing_consent` TINYINT(1) NOT NULL DEFAULT 0,
    `ip_address` VARCHAR(45) DEFAULT NULL,
    `submitted_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- SEED DATA FOR NEWS POSTS


INSERT INTO `news_posts` (`title`, `summary`, `image`, `image_alt`, `category`, `category_slug`, `author_name`, `posted_date`) VALUES
(
    'Retail Cyberattacks Are a Wake UP Call for UK...',
    'Retail Cyberattacks Are a Wake-Up Call for UK...',
    'img/news/nm-news-02.webp',
    'Abstract image representing cyber security',
    'Case Studies',
    'bespoke-software',
    'Netmatters Ltd',
    '2025-06-03'
),
(
    'May Notables 2025 - Celebrating Our Team',
    'May Notables 2025 Each month at Netmatters, we take a moment to recognise the dedication and achieve...',
    'img/news/nm-news-01.png',
    'Notable employees for May at Netmatters',
    'Case Studies',
    'web-design',
    'Netmatters Ltd',
    '2025-06-03'
),
(
    'Laptops 4 Learning: Rehoming Refurbished Lapt...',
    'Give Your Old Tech a New Purpose Even with the best IT care and support, laptops become outdated and...',
    'img/news/nm-news-03.webp',
    'Promotional graphic for Laptops 4 Learning',
    'Case Studies',
    'it-support',
    'Netmatters Ltd',
    '2025-06-03'
);
