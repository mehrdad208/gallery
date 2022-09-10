-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 10, 2022 at 08:21 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gallery`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `slug` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `title` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `slug`, `title`, `created_at`, `updated_at`) VALUES
(3, 'مردانه', 'مردانه', '2022-09-26 09:27:20', '2022-09-28 09:27:20'),
(4, 'زنانه', 'زنانه', '2022-09-06 08:27:55', '2022-09-26 09:27:55'),
(5, 'بچه گانه', 'بچه گانه', '2022-09-19 08:18:09', '2022-09-04 04:17:01');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2021_09_26_124858_create_categories_table', 1),
(6, '2021_09_26_130301_create_products_table', 1),
(7, '2021_09_26_132010_create_orders_table', 1),
(8, '2021_09_26_132928_create_order_items_table', 1),
(9, '2021_09_26_133727_create_payments_table', 1),
(10, '2021_09_30_144422_change_password', 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `ref_code` char(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `amount`, `ref_code`, `status`, `created_at`, `updated_at`) VALUES
(51, 2, 1210000, 'be8o2kxvWhIShi1LQk6nOTiNtOKKS3', 'paid', '2022-09-10 01:46:27', '2022-09-10 01:46:28'),
(52, 2, 350000, 'VJFo9G2O2vT00BZFcBao7UoV86AG17', 'paid', '2022-09-10 01:48:25', '2022-09-10 01:48:25'),
(53, 1, 250000, 'rRjsMgztW1yATZwgijhJXvbl0HuhXJ', 'paid', '2022-09-10 01:49:37', '2022-09-10 01:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `price`, `created_at`, `updated_at`) VALUES
(55, 51, 46, 550000, '2022-09-10 01:46:28', '2022-09-10 01:46:28'),
(56, 51, 47, 660000, '2022-09-10 01:46:28', '2022-09-10 01:46:28'),
(57, 52, 40, 350000, '2022-09-10 01:48:25', '2022-09-10 01:48:25'),
(58, 53, 41, 250000, '2022-09-10 01:49:38', '2022-09-10 01:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `gateway` enum('id_pay','zarinpal') COLLATE utf8mb4_unicode_ci NOT NULL,
  `res_id` int(10) UNSIGNED DEFAULT NULL,
  `ref_code` char(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` enum('paid','unpaid') COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `gateway`, `res_id`, `ref_code`, `status`, `order_id`, `created_at`, `updated_at`) VALUES
(33, 'id_pay', NULL, 'be8o2kxvWhIShi1LQk6nOTiNtOKKS3', 'paid', 51, '2022-09-10 01:46:28', '2022-09-10 01:46:28'),
(34, 'id_pay', NULL, 'VJFo9G2O2vT00BZFcBao7UoV86AG17', 'paid', 52, '2022-09-10 01:48:25', '2022-09-10 01:48:25'),
(35, 'id_pay', NULL, 'rRjsMgztW1yATZwgijhJXvbl0HuhXJ', 'paid', 53, '2022-09-10 01:49:38', '2022-09-10 01:49:38');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` char(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumbnail_url` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `demo_url` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `source_url` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `price` int(10) UNSIGNED NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `owner_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `thumbnail_url`, `demo_url`, `source_url`, `price`, `category_id`, `owner_id`, `created_at`, `updated_at`) VALUES
(40, 'پیراهن مردانه', '<p>پیراهن نوعی پوشاک است که برای بالاتنه استفاده می‌شود. در اصل پیراهن نوعی پوشاک است که عمدتاً مردان در زیر لباس رسمی می‌پوشند.[۱] پیراهن مردانه در دو نوع آستین کوتاه و بلند تولید می‌شود و انواع یقه را دارد.</p>', 'products/40/thumbnail_url_product-03.jpg', 'products/40/demo_url_product-03.jpg', 'products/40/source_urlproduct-11.jpg', 350000, 3, 1, '2022-09-09 13:23:17', '2022-09-10 00:56:14'),
(41, 'تیشرت زنانه', '<p>تیشرت، پوشینه‌ای راحت، سبک، ساده، خنک و عموماً بدون یقه، دکمه، زیپ یا سایر تزئینات است. این لباس یکی از راحت‌ترین، پرکاربردترین و محبوب‌ترین انواع لباس‌ها در تمام دنیا است. شاید در هیچ بوتیک لباس‌فروشی، کالایی به‌اندازه تی‌شرت به‌راحتی و سرعت فروش نرود. تی‌شرت‌ها به طور معمول پوشینه‌هایی بدون جنسیت هستند. یعنی اغلب اوقات در مدل‌های بسیار ساده، تفاوتی بین تی‌شرت زنانه و تیشرت مردانه وجود ندارد. البته به‌طور کلی این خاصیت تی‌شرت‌ها است که اساساً لباس‌هایی اسپرت هستند.</p>', 'products/41/thumbnail_url_product-01.jpg', 'products/41/demo_url_product-08.jpg', 'products/41/source_urlproduct-14.jpg', 250000, 4, 1, '2022-09-09 13:24:25', '2022-09-09 13:24:25'),
(42, 'ساعت مردانه', '<p>زمان و وقت شناسی چیزی است که کمتر کسی میتواند خیلی راحت از کنارش بگذرد. حتی یک ثانیه هم میتواند سرنوشت یک نفر یا یک ملت را تغییر دهد.</p>', 'products/42/thumbnail_url_product-06.jpg', 'products/42/demo_url_product-15.jpg', 'products/42/source_urlproduct-15.jpg', 350000, 3, 1, '2022-09-09 13:25:33', '2022-09-09 13:25:33'),
(43, 'شلوار لی زنانه', '<p>جالبه بدانید که شلوار جین‌ها ابتدا به خاطر جنس مقاوم پارچه (دنیم) به عنوان شلوار کار ساخته شدند؛ بعدترها نمادی شدند از سرپیچی و مقاومت طبقه کارگر و امروزه آنچنان کاربرد گسترده ‌ای پیدا کردند که به جرئت می‌شود گفت بسیاری از مردم دنیا توی جین‌هایشان زندگی می‌کنند.</p>', 'products/43/thumbnail_url_product-10.jpg', 'products/43/demo_url_product-10.jpg', 'products/43/source_urlproduct-13.jpg', 450000, 4, 1, '2022-09-09 13:26:43', '2022-09-09 13:26:43'),
(44, 'سوشرت مردانه', '<p>شاید شما یکی از طرفداران سرسخت سویشرت ها باشید که دوست دارید در هر فصل و مکانی از آنان استفاده کنید . اما آیا شما می دانید هودی ها چه نوع لباس هایی هستند ؟ آیا می دانید تفاوت میان هودی و سویشرت مردانه در چیست ؟ هودی و سویشرت مردانه چندان تفاوتی با همدیگر ندارند . بزرگ ترین فرق میان آنها این است که سویشرت ها جلو باز هستند و زیپ می‌خورند اما هودی‌ها جلو بسته هستند که اکثرا مدل کلاه دارشان محبوب تر است .</p>', 'products/44/thumbnail_url_gallery-07.jpg', 'products/44/demo_url_gallery-04.jpg', 'products/44/source_urlgallery-03.jpg', 350000, 3, 1, '2022-09-09 13:27:39', '2022-09-09 13:27:40'),
(45, 'کاپشن مردانه', '<p>کاپشن، از انواع لباس های روپوش و گرم است که معمولا از اواسط فصل پاییز تا اوایل بهار مورد استفاده قرار می گیرد.کاپشن ها معمولا سبک تر و غیر رسمی تر از پالتو هستند و از همین نظر نیز کاربرد بسیار بیشتری از پالتوهای پاییزی و زمستانی دارند . اما اینکه یک کاپشن خوب چه کاپشنی است و چه ویژگی هایی باید داشته باشد، نکته ای است که باید به آن توجه ویژه ای داشت تا خریدی مناسب و کاربردی را در فصل های سرد سال داشته باشید . در این مطلب میخواهیم به شناخت انواع کاپشن بپردازیم .</p>', 'products/45/thumbnail_url_product-detail-03.jpg', 'products/45/demo_url_product-detail-02.jpg', 'products/45/source_urlproduct-detail-01.jpg', 550000, 3, 1, '2022-09-09 13:31:18', '2022-09-09 13:31:18'),
(46, 'کاپشن بهاره مردانه', '<p>فصل بهار و آغاز سال جدید، زمان مناسبی برای پوشیدن لباس های نو و شیک است و به همین دلیل بسیاری از مردم از روزها قبل به فکر خرید بافت مردانه، مدل کت و شلوار مردانه جدید هستند. کت بهاره مردانه یکی از بهترین انتخاب ها برای آقایان است برای روزهای آغاز سال به شمار می رود که جذابیت زیادی در ظاهر دارد. مدل های مختلف ژاکت بهاره را می توان با انواع شلوار مردانه ست کرد و استایل های بسیار زیبایی خلق نمود. در ادامه به معرفی مدل های گوناگون ژاکت مناسب بهار برای آقایان می پردازیم.</p>', 'products/46/thumbnail_url_product-min-03.jpg', 'products/46/demo_url_product-min-02.jpg', 'products/46/source_urlitem-cart-04.jpg', 550000, 3, 1, '2022-09-09 13:32:37', '2022-09-09 13:32:37'),
(47, 'کاپشن زنانه', '<p>کاپشن، از انواع لباس های روپوش و گرم است که معمولا از اواسط فصل پاییز تا اوایل بهار مورد استفاده قرار می گیرد.کاپشن ها معمولا سبک تر و غیر رسمی تر از پالتو هستند و از همین نظر نیز کاربرد بسیار بیشتری از پالتوهای پاییزی و زمستانی دارند . اما اینکه یک کاپشن خوب چه کاپشنی است و چه ویژگی هایی باید داشته باشد، نکته ای است که باید به آن توجه ویژه ای داشت تا خریدی مناسب و کاربردی را در فصل های سرد سال داشته باشید . در این مطلب میخواهیم به شناخت انواع کاپشن بپردازیم .</p>', 'products/47/thumbnail_url_product-04.jpg', 'products/47/demo_url_gallery-02.jpg', 'products/47/source_urlgallery-02.jpg', 660000, 4, 1, '2022-09-09 13:33:42', '2022-09-09 13:33:42'),
(48, 'کت مردانه', '<p>دقت در انتخاب لباس و نحوه پوششتان رابطه مستقیمی در خوشتیپی شما دارد . برای زیباتر به نظر رسیدن بعد از انتخاب لباس مناسب باید به جزئیات توجه کنید . آقایانی که از کت و شلوار استفاده می کنند برای خوشتیپ شدن باید نکاتی را رعایت نمایند و اصول بستن دکمه کت را بدانند زیرا خوشتیپی شاید تا حدودی خدادادی باشد ولی هرگز اتفاقی نیست . در این بخش از دنیای مد نمناک اصول بستن دکمه کت را برای آقایان آورده ایم.</p>', 'products/48/thumbnail_url_product-min-01.jpg', 'products/48/demo_url_product-07.jpg', 'products/48/source_urlbanner-05.jpg', 360000, 3, 1, '2022-09-09 13:34:50', '2022-09-09 13:34:50'),
(49, 'کفش', '<p>&lt;p&gt;کفش یا موزه وسیله ای است برای محافظت از پا در برابر سرما و گرما و خطرات محیطی و راحتی پا به هنگام انجام کارهای روزانه. پای انسان ها به عنوان ستون آدما بر روی زمین به حساب می آیند و نسبت به سایر اندام ها دارای استخوان های بیشتری می باشد و در برابر خطرات محیطی مانند سنگ ها و درختان و زمین داغ آسیب پذیرتر است و کفش ها این خطرات را کاهش می دهند و از پا محافظت می کنند. از گذشته تا به امروز کفش های متنوعی متناسب با نیاز انسان ها درست شده اند و طراحی کفش ها با تغیرات گوناگونی مواجه شده است و امروزه به ظاهر و طراحی کفش ها اهمیت بیشتری داده می شود و جنبه ی آرستگی آن ها نیز در نظر گفته می شود.&lt;/p&gt;</p>', 'products/49/thumbnail_url_product-09.jpg', 'products/49/demo_url_item-cart-02.jpg', 'products/49/source_urlitem-cart-02.jpg', 750000, 4, 1, '2022-09-09 13:36:02', '2022-09-09 13:36:02'),
(50, 'کلاه', '<p>کُلاه به پوشاکی گفته می‌شود که بر سر می‌گذارند. کلاه می‌تواند به خاطر محافظت، دلیل دینی، ایمنی یا مد مورد استفاده قرار گیرد. در گذشته کلاه نشان‌دهنده پایگاه اجتماعی فرد بوده‌است. کلاه در استفاده نظامی می‌تواند نشان‌دهنده ملیت، شاخهٔ فعالیت، درجه یا هنگ باشد.</p>', 'products/50/thumbnail_url_blog-04.jpg', 'products/50/demo_url_blog-01.jpg', 'products/50/source_urlbanner-03.jpg', 0, 4, 1, '2022-09-09 13:37:11', '2022-09-09 13:37:11'),
(51, 'کمربند', '<p>کمربند یک نوار یا تسمه باریک و انعطاف‌پذیر از جنس چرم یا لاستیک می‌باشد که دور کمر بسته می‌شود. کمربند به منظور نگاه داشتن شلوار یا دیگر البسه به کار می‌رود. کاربرد و استفاده کمربند به عصر برنز برمی‌گردد. کمربند هم برای خانم‌ها و هم برای آقایان مورد استفاده قرار می‌گیرد. شکل و شمایل کمربندها با توجه به مد روز متغیر است. کارگران و مهندسان برای آویختن و همراه داشتن ابزارآلات از کمربند استفاده می‌کنند. نیروهای امنیتی و پلیس نیز برای آویختن و حمل جنگ‌افزار، دست‌بند و غیره از کمربند استفاده می‌کنند. معمولاً در طول کمربند سوراخ‌هایی به منظور گیرکردن و محکم کردن سوزن سگک و تنظیم اندازه آن وجود دارد.[۱]</p>', 'products/51/thumbnail_url_product-12.jpg', 'products/51/demo_url_banner-09.jpg', 'products/51/source_urlbanner-09.jpg', 350000, 3, 1, '2022-09-09 13:38:24', '2022-09-09 13:38:24'),
(52, 'کوله پشتی زنانه', '<p>کوله پشتی زنانه برای بانوان جزء یکی از واجب ترین وسیله ها می باشد چرا که برای مسافرت، دانشگاه، کوه، ورزش و یا حتی تیپ های اسپرت و غیر رسمی استفاده می شود.</p>', 'products/52/thumbnail_url_gallery-06.jpg', 'products/52/demo_url_blog-06.jpg', 'products/52/source_urlbanner-08.jpg', 850000, 4, 1, '2022-09-09 13:39:31', '2022-09-09 13:39:31'),
(53, 'کوله پشتی مردانه', '<p>کوله پشتی های مردانه در طرح ها و مدل های مختلف در بازار وجود دارند که پرطرفدارترین آن ها کوله پشتی های چرم، مسافرتی، ورزشی و کوله های مخصوص لپ تاپ هستند.کوله پشتی های مردانه مدل های ساده و اسپرتی دارند که در موقعیت های مختلف قابل استفاده هستند، نمونه هایی از انواع کوله پشتی مردانه را در ادامه مشاهده کنید و بدانید با چه تیپ هایی میتوانید کوله پشتی استفاده کنید. بهترین رنگ ها برای کوله پشتی مردانه مشکی، قهوه ای و طوسی است که ست کردن آن ها کار بسیا راحتی است. هنگام خرید کوله پشتی باید دقت کنید که کوله پشتی سبک باشد، جا دار باشد، جنس اش خوب باشد و ظاهر زیبایی داشته باشد.</p>', 'products/53/thumbnail_url_thumb-03.jpg', 'products/53/demo_url_gallery-01.jpg', 'products/53/source_urlbanner-06.jpg', 450000, 3, 1, '2022-09-09 13:41:31', '2022-09-09 13:41:31'),
(54, 'عینک بچه گانه', '<p>صدمات چشمی ممکن است در همه افراد رخ دهد. اما بیش از نیمی از صدمات چشمی در افراد زیر 25 سال اتفاق می افتد.</p>', 'products/54/thumbnail_url_aynak.jpeg', 'products/54/demo_url_aynak.jpeg', 'products/54/source_urlaynak.jpeg', 150000, 5, 1, '2022-09-09 13:43:49', '2022-09-09 13:43:49'),
(55, 'شورت', '<p>&lt;p&gt;طراح گرافیک از این متن به عنوان عنصری از ترکیب بندی برای پر کردن صفحه و ارایه اولیه شکل ظاهری و کلی طرح سفارش گرفته شده استفاده می نماید، تا از نظر گرافیکی نشانگر چگونگی نوع و اندازه فونت و ظاهر متن باشد. معمولا طراحان گرافیک برای صفحه‌آرایی، نخست از متن‌های آزمایشی و بی‌معنی استفاده می‌کنند تا صرفا به مشتری یا صاحب کار خود نشان دهند که صفحه طراحی یا صفحه بندی شده بعد از اینکه متن در آن قرار گیرد چگونه به نظر می‌رسد و قلم‌ها و اندازه‌بندی‌ها چگونه در نظر گرفته شده‌است. از آنجایی که طراحان عموما نویسنده متن نیستند و وظیفه رعایت حق تکثیر متون را ندارند و در همان حال کار آنها به نوعی وابسته به متن می‌باشد آنها با استفاده از محتویات ساختگی، صفحه گرافیکی خود را صفحه‌آرایی می‌کنند تا مرحله طراحی و صفحه‌بندی را به پایان برند.&lt;/p&gt;</p>', 'products/55/thumbnail_url_short.jpeg', 'products/55/demo_url_short.jpeg', 'products/55/source_urlshort.jpeg', 15000, 5, 1, '2022-09-09 13:45:46', '2022-09-09 13:45:46'),
(56, 'شلوارک مردانه', '<p>&lt;p&gt;شلوارک یک پوشش راحت برای محیط خانه یا موقعیت های غیر رسمی به حساب می آید. در فصل تابستان این لباس به وفور مورد استفاده قرار می گیرد. همچنین مدل های متنوع مردانه و زنانه آن باعث شده که در طرح و رنگ های مختلف به بازار عرضه شود.&lt;/p&gt;&lt;p&gt;فصل تابستان و مسافرت و لب ساحل البسه مختص به خود را می طلبد. شلوارک یکی از گزینه هایی است که در میان آقایان خیلی طرفدار دارد. شلوارک هایی که در طرح ها و سایزهای مختلف و در موقعیت های نسبتا متفاوت مورد استفاده قرار می گیرند شامل شلوارک ورزشی، شلوارک راحتی، شلوارک ساحلی، شلوارک مجلسی و… می باشند&lt;/p&gt;</p>', 'products/56/thumbnail_url_شلوارک-مردانه-شلوارک-مردانه-Nike-مدل-28841-1342037-3915474_b.jpg', 'products/56/demo_url_شلوارک-مردانه-شلوارک-مردانه-Nike-مدل-28841-1342037-3915474_b.jpg', 'products/56/source_urlشلوارک-مردانه-شلوارک-مردانه-Nike-مدل-28841-1342037-3915474_b.jpg', 450000, 3, 1, '2022-09-09 13:47:01', '2022-09-09 13:47:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `national_code` int(10) NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `mobile` char(11) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` enum('admin','user') COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_secret` int(11) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `national_code`, `email`, `email_verified_at`, `mobile`, `role`, `password`, `two_factor_secret`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'مهرداد ابراهیمی تلوکلایی', 2080110403, 'm.ebrahimi.talo1990@gmail.com', '2022-09-19 08:21:37', '09387589696', 'admin', '$2y$10$lB2okXjMO12QsnDpE85k5OI3CgcSSthrwSj6p1EecT5ktx7rHlIPy', 667482481, NULL, '2022-09-18 08:21:37', '2022-09-10 01:43:40'),
(2, 'محمد ابراهیمی', 2080459953, 'm.ebrahimi.talo01990@gmail.com', NULL, '09367251953', 'user', NULL, 0, NULL, '2022-09-06 10:15:52', '2022-09-08 05:26:53'),
(4, 'آوین ابراهیمی', 2082085236, 'm.ebrahimi.tal00o01990@gmail.com', NULL, '09112580897', 'user', NULL, NULL, NULL, '2022-09-08 08:46:33', '2022-09-08 10:05:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payments_order_id_foreign` (`order_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_owner_id_foreign` (`owner_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payments_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `products_owner_id_foreign` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
