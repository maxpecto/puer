-- phpMyAdmin SQL Dump
-- version 5.2.1deb3
-- https://www.phpmyadmin.net/
--
-- Anamakine: localhost:3306
-- Üretim Zamanı: 12 May 2025, 18:41:24
-- Sunucu sürümü: 10.11.11-MariaDB-0ubuntu0.24.04.2
-- PHP Sürümü: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `puerh_db`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `about_pages`
--

CREATE TABLE `about_pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `about_pages`
--

INSERT INTO `about_pages` (`id`, `title`, `content`, `created_at`, `updated_at`) VALUES
(1, 'Haqqımızda', '<p>Biz innovativ həllər və yüksək keyfiyyətli xidmətlər təqdim edən bir komandayıq. Missiyamız müştərilərimizin ehtiyaclarını ən effektiv şəkildə qarşılamaq və onlara etibarlı, sürətli və peşəkarlıqla işləməkdir.</p><p>Fəaliyyət sahəmizdə yeni texnologiyalar və müasir üsullardan istifadə edərək daim inkişaf edirik. Komandamız sahənin ən bacarıqlı mütəxəssislərindən ibarətdir və hər bir işimizdə mükəmməlliyə çatmaq üçün səy göstəririk.</p><p>Müştəri məmnuniyyəti bizim üçün ən vacib prioritetdir. Buna görə də hər bir müştəri ilə fərdi yanaşma tərzimiz və diqqətimizlə fərqlənirik. Bizə etibar etdiyiniz üçün təşəkkür edirik!</p><p>Əgər bizimlə əməkdaşlıq etmək istəyirsinizsə, bizimlə əlaqə saxlamaqdan çəkinməyin. Sizə dəyər qatmaq üçün buradayıq!</p><p><br></p>', '2025-05-12 02:38:35', '2025-05-12 10:52:01');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache`
--

CREATE TABLE `cache` (
  `key` varchar(191) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `cache`
--

INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
('laravel_cache_da4b9237bacccdf19c0760cab7aec4a8359010b0', 'i:1;', 1747061541),
('laravel_cache_da4b9237bacccdf19c0760cab7aec4a8359010b0:timer', 'i:1747061541;', 1747061541);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(191) NOT NULL,
  `owner` varchar(191) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `created_at`, `updated_at`) VALUES
(1, 'Black Teas', 'black-teas', '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(2, 'Green Teas', 'green-teas', '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(3, 'Herbal Infusions', 'herbal-infusions', '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(4, 'Oolong Teas', 'oolong-teas', '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(5, 'White Teas', 'white-teas', '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(6, 'Pu-erh Teas', 'pu-erh-teas', '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(7, 'Specialty Blends', 'specialty-blends', '2025-05-11 11:31:35', '2025-05-11 11:31:35');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `contact_submissions`
--

CREATE TABLE `contact_submissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `subject` varchar(191) DEFAULT NULL,
  `message` text NOT NULL,
  `is_read` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `contact_submissions`
--

INSERT INTO `contact_submissions` (`id`, `name`, `email`, `phone`, `subject`, `message`, `is_read`, `created_at`, `updated_at`) VALUES
(1, 'Onur', 'maxpecto@hotmail.com', '0545 685 85 99', 'Test', 'qweqweqweqwe', 1, '2025-05-12 10:29:04', '2025-05-12 10:29:21');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `content_blocks`
--

CREATE TABLE `content_blocks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `key` varchar(191) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `image_path` varchar(191) DEFAULT NULL,
  `link_text` varchar(191) DEFAULT NULL,
  `link_url` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `gallery_images`
--

CREATE TABLE `gallery_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `image_path` varchar(191) NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `caption` text DEFAULT NULL,
  `link_url` varchar(191) DEFAULT NULL,
  `group_key` varchar(191) NOT NULL DEFAULT 'default',
  `display_order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(191) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `menu_items`
--

CREATE TABLE `menu_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `url` varchar(191) NOT NULL,
  `target` varchar(191) NOT NULL DEFAULT '_self',
  `icon` varchar(191) DEFAULT NULL,
  `parent_id` bigint(20) UNSIGNED DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT 0,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_05_11_095228_create_categories_table', 1),
(5, '2025_05_11_100930_create_products_table', 1),
(6, '2025_05_11_101914_create_offers_table', 1),
(7, '2025_05_11_102041_create_testimonials_table', 1),
(8, '2025_05_11_102428_create_general_settings_table', 1),
(9, '2025_05_11_102924_create_content_blocks_table', 1),
(10, '2025_05_11_103214_create_gallery_images_table', 1),
(11, '2025_05_11_103810_create_menus_table', 1),
(12, '2025_05_11_103943_create_menu_items_table', 1),
(13, '2025_05_11_104609_add_is_admin_to_users_table', 1),
(14, '2025_05_11_112251_add_is_active_to_products_table', 1),
(15, '2025_05_11_153326_create_settings_table', 1),
(16, '2025_05_12_062838_create_about_pages_table', 2),
(17, '2025_05_12_142613_create_contact_submissions_table', 3);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `offers`
--

CREATE TABLE `offers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_path` varchar(191) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `description` text DEFAULT NULL,
  `price` decimal(8,2) NOT NULL,
  `image_path` varchar(191) DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `slug`, `is_active`, `description`, `price`, `image_path`, `is_featured`, `created_at`, `updated_at`) VALUES
(1, 2, 'Omnis Quas', 'omnis-quas-deul', 1, 'Ut nam quae iusto doloremque pariatur. Tempora aut est repudiandae sed nulla laudantium. Culpa aliquam non earum maiores suscipit. Error quo excepturi tempore voluptatem quaerat dolores asperiores.\n\nNumquam et sapiente dolorem in neque fuga. Necessitatibus enim expedita quidem illo. Amet voluptas aliquam et quos at aperiam et. Eaque ut voluptate ipsum cumque reiciendis nobis quaerat. Provident nam corporis ea quo omnis ut excepturi.\n\nDolorum accusantium est mollitia doloremque incidunt fugit eaque. Facere reiciendis et itaque velit aut atque non blanditiis. Doloremque omnis vel similique illum sunt nobis. Maiores veritatis explicabo aliquam blanditiis dolores dolorem odio.\n\nQuae sed molestiae voluptas hic iste dolorem. Et vitae quos ducimus deserunt et eaque. Et facilis architecto modi odit alias maxime a. Voluptas atque quisquam consequatur quia sit facilis.\n\nConsequatur quidem quia molestiae distinctio. Et rerum nostrum voluptatem expedita enim provident. Sint et omnis qui.', 61.40, 'product-images/01JV0104DS8M3YRS5621JHKARW.webp', 0, '2025-05-11 11:31:35', '2025-05-11 11:56:42'),
(2, 2, 'Ut Recusandae Eveniet Non', 'ut-recusandae-eveniet-non-4mka', 1, 'Distinctio est et exercitationem perspiciatis odit modi est. Eos quia corporis occaecati voluptatem. Necessitatibus quis deleniti laboriosam ea sunt quia.\n\nEa nulla iure et quaerat deserunt. Non in quasi qui ut. Eligendi consequatur enim nesciunt vitae sed amet odit. Expedita aut et delectus impedit debitis. Nesciunt sed voluptas dolor.\n\nEius et amet odit molestiae aliquam. Error eos illum sint velit minus. Voluptate a deserunt sed quaerat minus est. Rerum alias voluptatem incidunt commodi beatae repellendus illum quod.', 68.70, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(3, 4, 'Quos Corrupti', 'quos-corrupti-stgd', 1, 'Modi vel aut eaque vero velit ut. Est labore consequatur omnis dolores quos.\n\nTempore non ducimus fugiat alias et ut. Voluptatem explicabo nam consequuntur odio temporibus pariatur et. Veritatis corporis eum ipsa asperiores laborum aspernatur. Non asperiores nam rerum corporis. Eum enim doloribus est laudantium tempore.\n\nExplicabo est corporis facere et. In pariatur asperiores delectus aut. Voluptatum minima voluptates qui qui.\n\nRerum neque repellendus fugiat illo quos. Maxime fuga mollitia sed doloremque. Et animi ipsum magni dolores libero sit. Nesciunt officiis non numquam dolor.', 20.96, NULL, 1, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(4, 2, 'Voluptatem Laborum Qui', 'voluptatem-laborum-qui-1goy', 1, 'Sit aspernatur ad tenetur impedit dolores officia est. Et ut cupiditate iusto omnis voluptas ullam quaerat. Sunt consequuntur officia quae voluptatum culpa. Reiciendis tempore voluptatem quidem perferendis architecto exercitationem quis.\n\nVelit repellat vero in voluptas debitis. Illo aspernatur consequuntur magni vero aliquam explicabo. Aut quis voluptatem blanditiis.\n\nEa occaecati quos sint et. Dolore impedit alias quidem reiciendis quia vel cumque. Amet accusamus hic alias veniam dolor accusamus.', 8.95, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(5, 1, 'Asperiores Corporis', 'asperiores-corporis-ppo5', 1, 'Quisquam officiis natus aperiam officiis dolorem. Aspernatur voluptate officiis veritatis eligendi qui occaecati. Consequuntur magni ut omnis sint repellat in est.\n\nOccaecati eum veritatis explicabo eum voluptas voluptas. Soluta sit accusantium sed saepe saepe ratione. Culpa quaerat vel repellat ad quia atque provident.\n\nSit voluptate exercitationem est occaecati sint. Voluptates delectus architecto hic non quia consequuntur deleniti deserunt. Consequatur est reprehenderit sit consectetur eum laboriosam ducimus.\n\nEsse aut sunt error autem ut. Aperiam aut at dolor ea sapiente perspiciatis mollitia.', 40.49, NULL, 1, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(6, 6, 'Aperiam Quos Numquam', 'aperiam-quos-numquam-wzcq', 1, 'Error quis quod laudantium sed aut ea ad. Eveniet reiciendis eius expedita laborum perspiciatis maiores praesentium commodi. Unde vel perferendis aliquam. Et dolore excepturi quasi rem consequatur excepturi.\n\nSit odit nulla adipisci nulla et. Inventore quis quia aliquid. Hic adipisci at corrupti eum. Iure voluptatem expedita autem saepe est.\n\nExplicabo aut nesciunt ipsam similique suscipit nam. Aperiam dolorum asperiores commodi inventore nemo et repudiandae. Expedita sunt ea in perspiciatis.', 44.65, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(7, 6, 'Ipsa Rerum Voluptas Aspernatur', 'ipsa-rerum-voluptas-aspernatur-8hno', 1, 'Consequuntur corporis rerum voluptatum aut doloremque. Autem quaerat rem provident sed fuga quo asperiores. Et iusto architecto et sunt. Sint voluptatibus quidem tempora aut eum non fugiat mollitia.\n\nIllo officia sunt voluptatem qui. Asperiores non vel vel ab ullam. Fugit natus natus eius non.', 81.30, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(8, 3, 'Omnis Vel Blanditiis Non', 'omnis-vel-blanditiis-non-seia', 1, 'Necessitatibus et velit est dolores est quis. Voluptatem provident sit laborum nam amet ut. Labore et aut et amet eum. Quae aperiam quod voluptas et.\n\nExercitationem voluptas et doloremque voluptatibus perspiciatis et officia et. Adipisci velit et recusandae ut dolorum excepturi animi. Id sit expedita quas natus qui.\n\nQuia atque aspernatur illo beatae voluptatem. Eius laudantium dolorem quae assumenda. Molestiae placeat perferendis soluta exercitationem eveniet qui eum.\n\nFugiat ipsam id quis cumque est. Repellendus quisquam eum voluptas impedit rerum consequatur. Voluptatem possimus aut dolor numquam.\n\nTemporibus ut eveniet molestias. Quisquam amet saepe voluptas aperiam. Nobis et et animi voluptas ut aut. Ratione tempore atque labore.', 36.17, NULL, 1, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(9, 5, 'Corporis In', 'corporis-in-8zml', 1, 'Tempora aut odio est repellat et et temporibus. Quis ut illo et dicta laboriosam iusto. Repudiandae error laboriosam pariatur voluptate architecto.\n\nAut nulla at suscipit sed nam asperiores. Maiores consequatur eligendi possimus. Voluptates iusto deleniti facilis eum.', 83.56, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(10, 7, 'Quasi Temporibus', 'quasi-temporibus-irww', 1, 'Aliquid reiciendis ab blanditiis nostrum. Architecto ut dignissimos ut quo fugit. Rerum repudiandae excepturi placeat ea est voluptatem.\n\nQuos quos cumque cumque ipsam. Omnis ut ut ex optio. Optio exercitationem dolorem impedit est dolores. Consequatur voluptatem vitae consequatur libero natus laborum.', 60.07, NULL, 1, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(11, 7, 'Repudiandae Amet Qui Autem', 'repudiandae-amet-qui-autem-zz5l', 1, 'Nobis cum facere cumque sequi quia repellat. Iusto cumque est optio nobis magnam. Sunt ut architecto enim nemo.\n\nVelit aut velit libero voluptatem eum quia possimus. Quaerat voluptas dolor repellat quia quasi. Exercitationem eum corrupti repellendus corrupti hic reprehenderit quo. Sint est vel non.\n\nUt neque dolorum occaecati vitae ea a magnam. Odio in corporis perferendis. Quas pariatur numquam illum et sunt et.\n\nFugit eaque aut velit eum eaque. Necessitatibus eaque possimus sit dolorem assumenda. Non molestiae vero et qui.', 93.46, NULL, 1, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(12, 6, 'Alias Ducimus Voluptatem Expedita', 'alias-ducimus-voluptatem-expedita-euqi', 1, 'Sit minima sapiente provident non sit ex tempora sed. Dignissimos est aliquam sint et. Soluta ut nesciunt exercitationem et sapiente porro eius sint.\n\nQuam et quia dolores est est eligendi qui. Recusandae rerum porro voluptas adipisci iusto tempore animi est. Magnam dolores voluptatem distinctio dignissimos rem. Et aut voluptatum quas et. Praesentium tenetur distinctio rerum necessitatibus voluptatem velit.\n\nRepudiandae totam illo et nihil id. Sit porro ullam quos facilis soluta nulla. Est eius ut molestiae voluptatem vel facere. Dolorum aut et dolorem quo deleniti.\n\nLibero dicta odit blanditiis magnam rerum at. Omnis facilis laboriosam est eos perspiciatis sint. Maiores facere labore tempora et aliquam quibusdam et.', 8.91, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(13, 3, 'Nobis Dolore Earum', 'nobis-dolore-earum-oixl', 1, 'Amet non deleniti enim hic itaque. Eaque nemo nihil ut molestiae autem consequuntur assumenda. Ad harum pariatur quisquam assumenda voluptatum qui.\n\nVoluptatem vero laboriosam omnis nulla. Error porro ut libero ducimus hic tenetur. Architecto ex vero aut consequatur non tempora laborum. Et a laudantium cum.\n\nQuis molestias et qui minima. Iusto voluptatum quas libero soluta. Modi voluptatum iure ab ea quia.\n\nNumquam veniam totam eveniet sit aliquid unde nesciunt. Error repudiandae dicta impedit omnis nam. Non corrupti veniam pariatur iure non et. Qui enim quis deleniti iure rerum corrupti at ad.', 17.77, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(14, 5, 'Occaecati Ut Cum Deserunt', 'occaecati-ut-cum-deserunt-jymj', 1, 'Voluptate dolorem sed id voluptates et et. Iste sint ut quo magnam et.\n\nCupiditate assumenda sequi placeat dicta aliquid quasi dolores nostrum. Dolor et dolorem omnis. Officiis rerum dolor vel nihil reiciendis. Maxime aut harum esse molestias quam.\n\nQuis quaerat et sunt ab aliquid. Consequuntur beatae nihil quibusdam sunt quasi sunt eum. Corrupti aut est voluptatem possimus laudantium reprehenderit.', 85.56, NULL, 1, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(15, 7, 'In Ipsam Sit', 'in-ipsam-sit-hww9', 1, 'Debitis natus quasi non reiciendis. Saepe in aperiam nesciunt et adipisci. Neque ut eligendi eum corporis dolor.\n\nVoluptatum et nulla itaque quasi. Eum accusantium nisi rerum neque.\n\nMagnam repellendus tempore nisi dolorem et. Odio accusamus officia labore cumque aut dignissimos. Vitae error ratione repudiandae similique laudantium nobis velit.\n\nCorrupti id et cumque vitae. Mollitia iusto eaque quaerat et expedita consectetur enim. Unde aut cupiditate sunt accusamus quibusdam ducimus. Perspiciatis modi error libero et quas esse aspernatur.\n\nEx iste aperiam harum voluptate eum in quo. Dicta eos blanditiis ducimus quasi odio quis odit.', 13.23, NULL, 1, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(16, 6, 'Aut Quaerat', 'aut-quaerat-rtnq', 1, 'Ratione recusandae error amet. Aspernatur error velit ratione enim non. Voluptas ut adipisci nostrum eum dignissimos alias nemo. Velit voluptas id aliquam dicta et quo.\n\nLaudantium eos et dolor pariatur dolores vitae. Reiciendis qui dicta distinctio modi. Qui et est rerum.\n\nAccusamus atque omnis voluptatibus ullam voluptatem inventore et. Corrupti magnam consequatur facilis ut sit suscipit labore voluptate.\n\nEaque nihil doloribus totam modi. Voluptas ut dolorem provident illo sed asperiores et. Iure similique corrupti officiis. Maxime soluta eaque et aut quasi quasi quia.', 57.83, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(17, 7, 'Aut Sint Voluptatibus Vel', 'aut-sint-voluptatibus-vel-e1h6', 1, 'Est nostrum dolorem consequuntur rerum distinctio. Deleniti facere cum inventore ullam. Sed consequatur nam adipisci est reiciendis.\n\nConsequuntur qui et doloribus ullam veritatis odit ut. Aut libero incidunt eveniet fugit repellendus. Accusamus neque consectetur tempora et eveniet. Sit non soluta voluptas qui.\n\nLabore soluta et similique natus velit. Provident voluptatem recusandae ea et velit. Facere eveniet sint omnis laborum reiciendis. Debitis tenetur est hic qui eum velit officia eos.', 73.69, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(18, 2, 'Et Corporis Culpa', 'et-corporis-culpa-kefz', 1, 'Eligendi adipisci autem et numquam praesentium aut a. Autem voluptas aut qui. Tempora officiis delectus a qui facilis fugit voluptatem. Placeat quisquam suscipit dolor in.\n\nSaepe sint placeat vel laboriosam quia nisi. Ab nostrum voluptatem consectetur est quis ratione minus perspiciatis. Consequatur qui repellendus et eos blanditiis qui fuga. Consequatur unde commodi occaecati cumque.', 9.90, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(19, 5, 'Ad Ducimus Placeat Possimus', 'ad-ducimus-placeat-possimus-1trg', 1, 'Laborum impedit et vel consequatur et dolorem quod. Eum eum sed quo alias. Velit doloremque et ipsa fugit hic dolores laboriosam.\n\nAmet quis nihil soluta qui dolores. Culpa sed iure sapiente est id neque.\n\nProvident architecto facilis laborum. Cum non sunt rerum numquam sint corporis enim laborum. Placeat et repellendus rerum deserunt omnis occaecati.\n\nDoloribus magni quia suscipit ratione expedita. Vitae aut dolore ipsam vitae deleniti. Odit ad eos ut quia quod cum.\n\nDolorem velit perspiciatis consequatur non qui sed voluptas. Est rerum qui odio ut a magni voluptas. Quam debitis et ut et minus.', 34.69, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35'),
(20, 2, 'Adipisci Nobis Quia', 'adipisci-nobis-quia-96nn', 1, 'Molestiae nesciunt nihil quaerat corrupti est. Necessitatibus nostrum voluptatum ipsum architecto nihil. Voluptatem mollitia incidunt dolorem quod reprehenderit. Ea sed quod magni qui.\n\nUllam expedita est repudiandae dicta est asperiores. Reiciendis corporis beatae quod odit quis voluptatum. Dolor laborum enim ut et. Sint velit aut reiciendis totam omnis placeat.', 64.30, NULL, 0, '2025-05-11 11:31:35', '2025-05-11 11:31:35');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(191) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group` varchar(191) NOT NULL,
  `name` varchar(191) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `payload` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`payload`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `settings`
--

INSERT INTO `settings` (`id`, `group`, `name`, `locked`, `payload`, `created_at`, `updated_at`) VALUES
(1, 'general', 'general', 0, '{\"site_name\":\"Puerxana\",\"site_logo_header\":\"setting-images\\/01JV00WA6KR6MJ28WFQ08TPVNX.png\",\"site_logo_footer\":\"setting-images\\/01JV00WA6NNMA636MMVC0C1BYP.png\",\"footer_address\":\"BAKI \\u015e\\u018fH\\u018fR\\u0130, X\\u018fTA\\u0130 RAYONU, \\u0130LQAR Z\\u00dcLF\\u00dcQAROV K\\u00dc\\u00c7\\u018fS\\u0130, 2942A M\\u018fH\\u018fLL\\u018fS\\u0130, M\\u018fNZ\\u0130L 116\",\"footer_phone\":\"0508232535\",\"footer_email\":\"maxpecto@hotmail.com\",\"working_hours_weekdays\":\"B.e. - C.: 09:00 - 18:00\",\"working_hours_weekend\":\"B.e. - C.: 09:00 - 18:00\",\"facebook_url\":\"http:\\/\\/facebook.com\",\"instagram_url\":\"http:\\/\\/facebook.com\",\"twitter_url\":\"http:\\/\\/facebook.com\",\"pinterest_url\":\"http:\\/\\/facebook.com\",\"hero_title\":null,\"hero_subtitle\":null,\"hero_background_image\":\"setting-images\\/01JV00ZD9SPEBXWV2JCGGSRYBD.webp\",\"meta_title\":null,\"meta_description\":null,\"meta_keywords\":null,\"linkedin_url\":\"http:\\/\\/facebook.com\",\"youtube_url\":\"http:\\/\\/facebook.com\",\"contact_form_email\":null,\"google_maps_iframe\":null,\"google_analytics_id\":null,\"facebook_pixel_id\":null,\"maintenance_mode\":false,\"default_product_image\":null,\"primary_color\":\"#cc3636\",\"secondary_color\":\"#FFFFFF\",\"text_color\":\"#cc3636\",\"text_light_color\":\"#FFFFFF\",\"background_color\":\"#1c1919\",\"surface_color\":\"#292323\",\"accent_color\":\"#cc3636\",\"header_bg_color\":\"#292323\",\"header_text_color\":\"#cc3636\",\"footer_bg_color\":\"#292323\",\"footer_text_color\":\"#cc3636\",\"button_primary_bg_color\":\"#cc3636\",\"button_primary_text_color\":\"#FFFFFF\",\"button_secondary_bg_color\":\"#6C757D\",\"button_secondary_text_color\":\"#FFFFFF\",\"featured_products_title\":\"Unique Tea Blends\",\"featured_products_subtitle\":\"Discover our handpicked selection...\",\"shop_page_url\":\"\\/products\",\"view_all_products_button_text\":\"View All Teas\",\"popular_offers_title\":\"Special Offers Just For You\",\"popular_offers_subtitle\":\"Don\'t miss out on our exclusive deals...\",\"testimonials_title\":\"What Our Customers Say\",\"testimonials_subtitle\":\"Honest feedback from our valued tea lovers.\",\"instagram_gallery_title\":\"Follow Us on Instagram\",\"instagram_gallery_subtitle\":\"Get inspired by our latest posts...\",\"instagram_handle\":\"puerxana\",\"hero_button_link\":\"\\/products\",\"hero_button_text\":\"Shop Now\",\"whatsapp_number\":\"994508232535\",\"mapbox_api_key\":\"pk.eyJ1IjoibWF4cGVjdG8iLCJhIjoiY21hazJkcmMzMDZrbTJpc2RyejZ6Z203MiJ9.9qDZf69uYzjg28xAQrY40g\",\"mapbox_longitude\":\"49.844042\",\"mapbox_latitude\":\"40.379559\",\"mapbox_zoom_level\":10,\"mapbox_style_url\":\"mapbox:\\/\\/styles\\/mapbox\\/streets-v11\",\"header_link_color\":null,\"header_link_hover_color\":null,\"header_icon_color\":null,\"header_icon_hover_color\":null,\"mobile_menu_bg_color\":null,\"mobile_menu_link_color\":null,\"mobile_menu_link_hover_bg_color\":\"#F0FDF4\",\"mobile_menu_link_hover_text_color\":null,\"cart_badge_bg_color\":\"#DC2626\",\"cart_badge_text_color\":\"#cc3636\",\"mobile_menu_button_color\":\"#cc3636\",\"mobile_menu_button_hover_color\":\"#FFFFFF\",\"footer_secondary_text_color\":null,\"footer_link_hover_color\":\"#cc3636\",\"footer_border_color\":\"#cc3636\"}', NULL, '2025-05-12 10:36:04');

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `author_name` varchar(191) NOT NULL,
  `content` text NOT NULL,
  `is_visible` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `email` varchar(191) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `password` varchar(191) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Tablo döküm verisi `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `is_admin`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin User', 'maxpecto@hotmail.com', '2025-05-11 11:31:35', 1, '$2y$12$sWBLOUQf.eCZPnjRd7LknOACeT.vmQEehXKgUb9wZATwmDmI06fE2', 'nlJMmH6A2g', '2025-05-11 11:31:35', '2025-05-11 11:52:20'),
(2, 'Test User', 'test@example.com', '2025-05-11 11:31:35', 0, '$2y$12$vU67iUbUgGqiPXE3iGD.FeZ1RZKOAgD7FWj1yVF2M4pIuLzd1j8I2', 'DFWnNj7wJZ', '2025-05-11 11:31:35', '2025-05-11 11:31:35');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `about_pages`
--
ALTER TABLE `about_pages`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Tablo için indeksler `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Tablo için indeksler `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_slug_unique` (`slug`);

--
-- Tablo için indeksler `contact_submissions`
--
ALTER TABLE `contact_submissions`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `content_blocks`
--
ALTER TABLE `content_blocks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `content_blocks_key_unique` (`key`);

--
-- Tablo için indeksler `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Tablo için indeksler `gallery_images`
--
ALTER TABLE `gallery_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `gallery_images_group_key_index` (`group_key`);

--
-- Tablo için indeksler `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Tablo için indeksler `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `menus_slug_unique` (`slug`);

--
-- Tablo için indeksler `menu_items`
--
ALTER TABLE `menu_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `menu_items_menu_id_foreign` (`menu_id`),
  ADD KEY `menu_items_parent_id_foreign` (`parent_id`);

--
-- Tablo için indeksler `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `offers`
--
ALTER TABLE `offers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `offers_slug_unique` (`slug`);

--
-- Tablo için indeksler `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Tablo için indeksler `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `products_slug_unique` (`slug`),
  ADD KEY `products_category_id_foreign` (`category_id`);

--
-- Tablo için indeksler `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Tablo için indeksler `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_group_name_unique` (`group`,`name`);

--
-- Tablo için indeksler `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Tablo için indeksler `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `about_pages`
--
ALTER TABLE `about_pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Tablo için AUTO_INCREMENT değeri `contact_submissions`
--
ALTER TABLE `contact_submissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `content_blocks`
--
ALTER TABLE `content_blocks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `gallery_images`
--
ALTER TABLE `gallery_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `menu_items`
--
ALTER TABLE `menu_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Tablo için AUTO_INCREMENT değeri `offers`
--
ALTER TABLE `offers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Tablo için AUTO_INCREMENT değeri `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Tablo için AUTO_INCREMENT değeri `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Dökümü yapılmış tablolar için kısıtlamalar
--

--
-- Tablo kısıtlamaları `menu_items`
--
ALTER TABLE `menu_items`
  ADD CONSTRAINT `menu_items_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `menu_items_parent_id_foreign` FOREIGN KEY (`parent_id`) REFERENCES `menu_items` (`id`) ON DELETE CASCADE;

--
-- Tablo kısıtlamaları `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
