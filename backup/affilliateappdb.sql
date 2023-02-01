-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2022 at 03:51 PM
-- Server version: 8.0.21
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `affilliateappdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `articulos`
--

CREATE TABLE `articulos` (
  `id` int NOT NULL,
  `titulo` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `subtitulo` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `texto` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(300) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fecha` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `autor` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articulos`
--

INSERT INTO `articulos` (`id`, `titulo`, `subtitulo`, `texto`, `imagen`, `fecha`, `autor`) VALUES
(5, 'iPhone 14 Pro shipping delays — should you get a regular iPhone instead?', 'There\'s a silver lining to all this, and it\'s the fact that iPhone 14 and iPhone 14 Plus models appear to be unaffected. Order those phones right now.', '<p> If you\'re eager to get your hands on a new iPhone 14 Pro or iPhone 14 Pro Max, I hope you\'re a big believer in the old adage about good things coming to those who wait. Because it sounds like iPhone ship times are going to test the very limits of that philosophy. </p>\r\n\r\n<p> Apple\'s iPhone 14 Pro models were already facing constrained supplies, pushing iPhone 14 wait times past a month for the $999 and $1,099 iPhone models that Apple started selling toward the end of September. And now it\'s very possible those wait times are going to get worse, thanks to Covid lockdowns where Apple assembles its phones.  </p>\r\n\r\n <p>Specifically, Apple has released a statement warning that the Zhengzhou, China-based production plant responsible for putting together the iPhone 14 Pro models is \"operating at significantly reduced capacity\" as a result of a Covid-19-related lockdown. Apple says that iPhone 14 Pro and iPhone 14 Pro Max shipments will be lower than anticipated; more worrisome for shoppers is that wait times for those phones are expected to increase. </p>\r\n\r\n <p>There\'s a silver lining to all this, and it\'s the fact that iPhone 14 and iPhone 14 Plus models appear to be unaffected. Order those phones right now, for example, and you can have them in your hand by tomorrow in the U.S. </p>\r\n\r\n <p>Then again, there\'s a reason demand for the iPhone 14 isn\'t as fervid as it seems to be for the iPhone 14 Pro. As our iPhone 14 vs. iPhone 14 Pro comparison details, Apple\'s Pro handsets got all the big features this time out. The iPhone 14, in contrast, is a more modest upgrade from recent versions. </p>\r\n\r\n <p>Still, an iPhone in the hand is worth two on back order, to paraphrase another old adage. Jf you\'ve been holding out for an iPhone 14 Pro, does it make more sense to grab the standard iPhone or iPhone 14 Plus, given the lengthy waits for the Pro models? Here\'s what we think about the trade-offs you\'d have to make. </p>\r\n\r\n <p>Just when can you expect to get an iPhone 14 Pro?\r\nA big factor in deciding whether to buy an iPhone 14 Pro and wait for it to ship or buying an iPhone 14 so you can have your phone now boils down to how long you\'ll actually need to wait. Unfortunately, that\'s in flux right now. </p>\r\n\r\n\r\n <p>As of Monday, November 7, ordering an iPhone 14 Pro or iPhone 14 Pro Max in the U.S. requires a month-long wait before the phone ships to you between December 8 and 14. U.K. shoppers face that same lengthy wait for the iPhone 14 Pro and iPhone 14 Pro Max. </p>\r\n\r\n <p>Swipe to scroll horizontally Model Estimated delivery date (U.S.) Estimated delivery date (U.K.) iPhone 14 Tomorrow November 9 iPhone 14 Plus Tomorrow November 9 iPhone 14 Pro December 8 - 14 December 7 - 14 iPhone 14 Pro Max December 8 - 14 December 7 - 14\r\nAnd that could be the shortest wait you experience for a while. In alerting people about reduced capacities at the plant where the Pro models are made, Apple suggested that supplies are going to be stretched even thinner. \"Customers will experience longer wait times to receive their new products,\" Apple\'s statement on supply issues (opens in new tab) says. </p>\r\n', 'https://bittadvise-images.s3.amazonaws.com/bittadvise-images_1668141187_672796780.31O8D6p7sfL._SL500_.jpg', '09/11/2022', 'Joel Males'),
(6, 'MacBook Air M2 review: better than its predecessor, but pricier too', 'Apple has reinvented a classic with the new MacBook Air M2, but is it worth picking up?', '<p>Key specs:\r\n\r\nPrice: $1,199.00\r\n\r\nScreen size: 13.6-inch\r\n\r\nWeight: 2.7 lbs (1.225 kg)\r\n\r\nMemory: 8 GB as standard, 16 GB and 24 GB options\r\n\r\nBattery life: up to 18 hours\r\n\r\nStorage: 256 GB, 512 GB, 1 TB, or 2 TB versions\r\n\r\nWarranty: 1 year, extendable with AppleCare.\r\n\r\nOperating system: macOS Ventura\r\n\r\nDisplay: 13.6-inch Liquid Retina display with 2650x1664 resolution\r\n\r\nCPU: Apple M2 chip (8-core CPU, 8-core GPU, 16-core Neural Engine)\r\n\r\nGraphics: M2 includes 8-core GPU (configurable with 10-core GPU)\r\n\r\nPorts: 2x Thunderbolt USB-C ports, MagSafe, 3.5 mm headphone jack</p>\r\n\r\n<p>Apple has reinvented a classic with the new MacBook Air M2, but is it worth picking up?</p>\r\n\r\n<p>Before 2022, the cheapest way to get an Apple laptop was the MacBook Air M1. It wasn’t a bad machine by any means (and earned a spot in our best laptops for students guide), but it certainly had many glancing enviously at the MacBook Pro’s 14 and 16-inch redesigns – in spite of the hefty price tag.</p>\r\n\r\n<p>That laptop may be a laptop for coding, but it’s overkill for most students. Thankfully, Apple has revised its MacBook Air design with the MacBook Air M2. It’s not as powerful as its Pro counterpart, but it does still offer many of its advantages for a considerably lower price.</p>\r\n\r\n<p>Your mileage may vary, depending on how you feel about the corners that have been cut – the MacBook Air M2 doesn’t have an HDMI port, and the display isn’t quite as transformative as the Pro’s. Instead, it offers excellent performance that blows past what Intel Macs were capable of, in a thin and light design (it weighs just 2.7 lbs) that now comes in four different colors.</p>\r\n\r\n<p>It’s still not cheap though, and you’re ideally going to want to add more storage if it’s going to be your main machine, but for 90% of the Mac laptop audience, the MacBook Air M2 will be perfect.</p>\r\n\r\n<p>Today\'s best Apple MacBook Air M2 2022 deals</p>\r\n\r\n<p>MacBook Air M2: Set up and usability\r\nMacBook Air M2_laptop open on desk, logged in</p>\r\n\r\n<p>Once you’ve opened the box and slipped the very small laptop out of it, the set-up process is as easy as opening the lid and waiting for the startup chime.</p>\r\n\r\n<p>From there, the MacBook Air will ask for your WiFi information, and allow you to set up accessibility settings before logging into your Apple ID to collect your settings and apps. The whole process should take just a couple of minutes, before leaving you at your new desktop.</p>\r\n\r\n<p>Sleek design\r\n4 color options\r\nWe miss the illuminated logo\r\nWhile there’s still part of us that wants a light-up Apple logo on the lid, the MacBook Air M2 remains immediately recognizable as a MacBook – it has rounded corners, a slim profile, and (sadly not illuminated) logo on the top.</p>\r\n\r\n<p>It also comes in four different colors: Space Gray, Silver, Stardust, and Midnight. Our review unit is the Midnight version and, as you can no doubt tell from the photos, it attracts fingerprints like nobody’s business. It doesn’t take much to cover it in smudges, but we’d expect it to be a little less obvious on the other color options.</p>\r\n\r\n<p>On the left-hand side, you’ll find a pair of USB-C ports and a MagSafe connector for charging, and the right has just a 3.5 mm headphone jack. We’d have certainly liked a right-sided USB-C port, especially since you can charge via those ports too, but the key takeaway is that unless you’re all in on USB-C you’ll need a dongle or two to get going.</p>\r\n\r\n<p>Open the lid and you’ll be presented with a slimline, but full-sized keyboard that has TouchID built into the button in the top right corner. The keys have scissor switches which should make this MacBook Air an instant upgrade for anyone who’s had experience with the prior butterfly switches. The trackpad below the keyboard remains industry-leading, too.</p>\r\n\r\n<p>The new Liquid Retina display is absolutely excellent, but we’ve been spoiled by the 14-inch and 16-inch MacBook Pros that offer much deeper blacks and a higher contrast ratio. Still, it’s a great display with impressive color accuracy. The notch returns, too, and contains a 1080p webcam (finally).</p>', 'https://bittadvise-images.s3.amazonaws.com/bittadvise-images_1668181723_462858271.mba_m2_20222.jpg', '11/11/2022', 'Joel Males');

-- --------------------------------------------------------

--
-- Table structure for table `backend_user`
--

CREATE TABLE `backend_user` (
  `id` int NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `backend_user`
--

INSERT INTO `backend_user` (`id`, `name`, `username`, `password`) VALUES
(1, 'Joel', 'joel', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id` int NOT NULL,
  `nombre` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `marca` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `precio` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagen` varchar(300) COLLATE utf8mb4_unicode_ci NOT NULL,
  `descripcion` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `categoria` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id`, `nombre`, `marca`, `precio`, `imagen`, `descripcion`, `categoria`) VALUES
(18, 'Macbook Air 2022', 'Apple', '2342.12', 'https://bittadvise-images.s3.amazonaws.com/bittadvise-images_1668180910_309549770.632c66b0f576c60018fc3421.webp', 'Macbook pro with all the new features for your productivity', 'computers'),
(19, 'Macbook Air 2022 M2', 'Apple', '2313.122', 'https://bittadvise-images.s3.amazonaws.com/bittadvise-images_1668180991_493862937.Apple-MacBook-Air-M2-2022-review-.jpeg', 'The all new M2 apple chip has all you need to become greater at school, home or even bussines', 'computers'),
(20, 'Macbook pro 2022 space gray 32gb ram', 'Apple', '2313.122', 'https://bittadvise-images.s3.amazonaws.com/bittadvise-images_1668181130_120222555.macbook-pro-14-and-16_overview__fz0lron5xyuu_og.png', 'The powerful macbook pro with the m1 pro chip, which enables a new level of productivity in your daily tasks.', 'computers'),
(21, 'Macbook pro 2019 8gb ram', 'Apple', '234.23', 'https://bittadvise-images.s3.amazonaws.com/bittadvise-images_1668181312_533862862.632c66b0f576c60018fc3421.webp', 'An incredible mac for an incredible price, find out more.', 'computers'),
(22, 'Apple iPhone 14 pro', 'Apple', '2313.122', 'https://bittadvise-images.s3.amazonaws.com/bittadvise-images_1668181390_654434876.31O8D6p7sfL._SL500_.jpg', 'The brand new iPhone 14 pro, come check all the new specs and features it brings.', 'computers');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `auth_key` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password_hash` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_at` text COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articulos`
--
ALTER TABLE `articulos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `backend_user`
--
ALTER TABLE `backend_user`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articulos`
--
ALTER TABLE `articulos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
