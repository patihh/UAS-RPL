-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2024 at 10:28 AM
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
-- Database: `projectrpl`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`, `added_at`) VALUES
(2, 15, 14, 8, '2024-11-16 10:45:16'),
(3, 16, 14, 19, '2024-11-19 06:22:17'),
(11, 1, 3, 4, '2024-12-26 05:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` int(10) NOT NULL,
  `description` text NOT NULL,
  `image` varchar(255) NOT NULL,
  `stock` int(11) NOT NULL,
  `category` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `stock`, `category`) VALUES
(1, 'Segala Cinta Senja', 85000, 'Buku Segala Cinta Senja merupakan sebuah antologi puisi yang ditulis oleh penulis muda berbakat, Asri Wibowo. Buku ini menyajikan kumpulan sajak yang menyentuh perasaan, mengeksplorasi keindahan alam, dan merefleksikan dinamika kehidupan manusia. Dengan gaya bahasa yang indah dan emosional, buku ini mengajak pembaca untuk menyelami makna cinta, kesedihan, dan kebahagiaan dalam keseharian. Segala Cinta Senja menjadi bacaan yang menginspirasi dan memperkaya jiwa.\r\n', 'uploads/1.png', 50, 'Romance'),
(2, 'Partikel', 95000, '\"Partikel\" adalah novel karya Dek yang bercerita tentang partikel-partikel subatomik dan bagaimana mereka mempengaruhi kehidupan manusia. Dengan gaya penulisan yang memikat dan imajinatif, novel ini mengajak pembaca untuk menjelajahi dunia fisika modern dan filosofi eksistensial. Melalui narasi yang kuat dan analisis konseptual yang mendalam, \"Partikel\" mengungkap misteri alam semesta dan mengajak pembaca untuk merefleksikan makna hidup dan keberadaan. Buku ini akan menyedot perhatian pembaca yang tertarik dengan sains, filsafat, dan pencarian makna terdalam.', 'uploads/2.png', 80, 'Romance'),
(3, 'Montessori Parenting', 120000, '\"Montessori Parenting\" adalah buku panduan parenting yang menghadirkan pendekatan Montessori dalam mendidik anak. Ditulis oleh ahli Montessori, buku ini menawarkan praktik-praktik sederhana namun efektif untuk membantu orang tua menciptakan lingkungan belajar yang kondusif bagi perkembangan anak. Dengan berfokus pada penghargaan terhadap keunikan anak, penguatan kemandirian, dan stimulasi multisensorik, buku ini membimbing orang tua untuk menumbuhkan potensi anak secara optimal. \"Montessori Parenting\" akan menjadi panduan berharga bagi siapa pun yang ingin menerapkan filosofi Montessori dalam pengasuhan anak.', 'uploads/3.png', 80, 'Romance'),
(4, 'Kematian', 85000, '\"Kematian\" adalah novel suram dan intens karya Iero yang menawarkan pengalaman baca yang mengikat dan menakutkan. Dengan gaya penulisan yang kuat dan atraktif, novel ini menceritakan perjalanan seorang individu yang terjebak dalam spiral kegelapan dan kematian. Melalui plot yang memikat dan karakter yang kompleks, \"Kematian\" mengundang pembaca untuk menyelami konsep kematian, keputusasaan, dan kemungkinan penebusan. Novel ini akan memberikan pengalaman membaca yang mendalam dan mencekam bagi pencinta fiksi gelap dan psikologis. Buku ini direkomendasikan bagi pembaca yang mencari karya yang menantang dan menyentuh jiwa.', 'uploads/4.png', 75, 'Fantasy'),
(5, 'Homunculus', 95000, '\"Homunculus\" adalah sebuah novel grafis yang menawarkan pengalaman visual dan naratif yang menakjubkan. Dengan ilustrasi yang kuat dan gaya pembuatan yang cinematic, buku ini menceritakan tentang eksperimen ilmiah yang mengarah pada penciptaan makhluk baru. Melalui jalinan cerita yang kompleks dan simbolisme yang kaya, \"Homunculus\" mengeksplorasi tema-tema seperti identitas, moralitas, dan keterbatasan manusia. Buku ini akan menghanyutkan pembaca ke dalam dunia fantasi sains yang gelap dan menggugah, memaksa mereka untuk merenungkan pertanyaan-pertanyaan fundamental tentang keberadaan dan kodrat manusia. \"Homunculus\" akan menarik perhatian pembaca yang mencari karya grafis inovatif dan menggelitik pemikiran.', 'uploads/4.png', 55, 'Fantasy'),
(6, 'Surrounded by Idiots', 120000, '\"Surrounded by Idiots\" adalah buku non-fiksi yang menyediakan panduan praktis untuk memahami dan bekerja dengan orang-orang yang sulit. Ditulis oleh pakar komunikasi dan psikologi Thomas Erikson, buku ini membagi kepribadian manusia ke dalam 4 tipe utama dan memberikan wawasan tentang bagaimana masing-masing tipe bereaksi dan berkomunikasi. Dengan pendekatan yang mudah dipahami dan contoh-contoh yang relatable, \"Surrounded by Idiots\" membantu pembaca untuk mengenali pola perilaku orang lain, menghindari konflik, dan membangun hubungan yang lebih efektif di lingkungan kerja maupun pribadi. Buku ini sangat bermanfaat bagi siapa pun yang ingin meningkatkan keterampilan komunikasi dan memahami dinamika interpersonal.', 'uploads/6.png', 70, 'Fantasy'),
(7, 'Brianna Bottomwise', 90000, '\"Brianna Bottomwise\" adalah novel terbaru karya Andrea Hirata yang menceritakan petualangan seorang wanita muda yang memutuskan mengubah arah hidup. Dengan gaya penulisan yang khas Andrea Hirata, buku ini menghadirkan kisah yang memukau, lucu, dan penuh dengan pesan inspiratif. Mengikuti perjalanan Brianna dalam menemukan jati diri dan mengejar impiannya, pembaca akan terhanyut dalam narasi yang memikat dan karakter yang menarik. \"Brianna Bottomwise\" menawarkan pengalaman membaca yang menyenangkan sekaligus membawa refleksi tentang keberanian, determinasi, dan makna hidup yang sesungguhnya. Buku ini akan sangat menghibur dan menginspirasi pembaca pecinta fiksi kontemporer yang kaya akan nilai-nilai kehidupan.', 'uploads/7.png', 70, 'Horror'),
(8, 'Petir', 75000, '\"Petir\" adalah novel fiksi karya penulis Dee yang menghadirkan sebuah cerita inovatif dan memikat. Dengan latar belakang dunia yang unik, buku ini menceritakan perjalanan seorang individu yang menemukan kekuatan dalam dirinya sendiri. Melalui penggunaan simbol dan metafora yang kuat, \"Petir\" mengeksplorasi tema kekuatan, transformasi, dan pencarian jati diri. Pembaca akan dibawa ke dalam dunia yang penuh misteri dan fantasi, sementara diajak untuk merenungkan pertanyaan-pertanyaan fundamental tentang kemanusiaan. Dengan narasi yang mengalir dan karakter yang kompleks, \"Petir\" akan menghanyutkan pembaca ke dalam pengalaman membaca yang menginspirasi dan menantang pemikiran. Buku ini akan sangat menarik bagi pencinta fiksi spekulatif yang menghargai karya dengan kedalaman konseptual.\r\n', 'uploads/8.png', 90, 'Horror'),
(9, 'Learning How to Learn', 110000, '\"Learning How to Learn\" adalah buku panduan yang membantu pembaca mengembangkan keterampilan belajar yang efektif dan efisien. Ditulis oleh pakar pendidikan Barbara Oakley dan Terry Sejnowski, buku ini menawarkan teknik-teknik dan strategi praktis untuk memaksimalkan potensi belajar individu. Mulai dari mengelola waktu dan fokus, hingga memanfaatkan teknik memori dan kreativitas, \"Learning How to Learn\" memberikan wawasan yang dapat diterapkan dalam berbagai bidang akademik maupun profesional. Dengan gaya penulisan yang jelas dan mudah dipahami, buku ini menjadi panduan berharga bagi siapa pun yang ingin meningkatkan kemampuan belajar dan menguasai materi dengan lebih baik. Buku ini sangat direkomendasikan bagi pelajar, mahasiswa, dan profesional yang ingin menjadi pembelajar yang lebih terampil.\r\n', 'uploads/9.png', 100, 'Horror'),
(10, 'Gelombang', 85000, '\"Gelombang\" adalah novel karya Dee Lestari yang menghadirkan cerita penuh emosi dan filosofi kehidupan. Menceritakan tentang perjalanan seorang individu dalam menghadapi pasang surut hidup, buku ini mengeksplorasi tema-tema seperti identitas, hubungan, dan pencarian makna. Dengan gaya penulisan yang indah dan mendalam, \"Gelombang\" membawa pembaca untuk merenungkan pertanyaan-pertanyaan mendasar tentang keberadaan manusia. Melalui narasi yang memikat dan karakter yang kompleks, novel ini mengajak pembaca untuk terhanyut dalam pengalaman membaca yang menginspirasi dan menggugah jiwa. \"Gelombang\" akan sangat menarik bagi pencinta fiksi kontemporer yang menghargai karya-karya yang kaya akan wawasan dan pesan kehidupan.', 'uploads/10.png', 50, 'Education'),
(11, 'The 100-Year-Old Man Who Climbed Out the Window and Disappeared', 120000, '\"The 100-Year-Old Man Who Climbed Out the Window and Disappeared\" adalah novel humoristik karya Jonas Jonasson yang menawarkan sebuah kisah menggelikan dan tak terduga. Buku ini menceritakan petualangan seorang pria berusia 100 tahun yang memutuskan melarikan diri dari panti jompo, hanya untuk terlibat dalam serangkaian peristiwa yang tidak biasa. Dengan campuran gaya naratif yang jenaka dan anekdot sejarah yang menarik, novel ini menyajikan pengalaman membaca yang menghibur sekaligus merefleksikan tema-tema seperti kehidupan, keberuntungan, dan takdir. \"The 100-Year-Old Man\" akan mengundang tawa dan rasa heran dari pembaca, sambil memberikan wawasan yang menginspirasi tentang pentingnya menikmati sisa usia dan tidak terlalu terikat oleh aturan-aturan konvensional. Buku ini akan menarik minat pecinta fiksi komedi dan keluarga.', 'uploads/11.png', 50, 'Education'),
(12, 'Akar', 95000, '\"Akar\" adalah novel fiksi spekulatif karya penulis Dee yang menghadirkan sebuah dunia alternatif yang unik dan menarik. Menggunakan simbol bunga sebagai representasi, buku ini menceritakan tentang masyarakat yang hidup di balik tembok-tembok megah, terpisah dari dunia di luar. Dengan gaya penulisan yang imajinatif dan simbolisme yang kuat, \"Akarta\" mengeksplorasi tema-tema seperti kekuasaan, kontrol, dan pemberontakan. Pembaca akan terpikat oleh kompleksitas karakter serta dinamika sosial-politik yang digambarkan dalam novel ini. \"Akarta\" akan menghadirkan pengalaman membaca yang mencengangkan dan memicu refleksi mendalam tentang masyarakat, kebebasan, dan kehidupan. Buku ini akan sangat menarik bagi pecinta fiksi spekulatif yang menghargai karya-karya dengan kedalaman konseptual dan inovasi naratif.', 'uploads/12.png', 70, 'Education'),
(13, 'Inteligensi Embun Pagi', 110000, '\"Inteligensi Embun Pagi\" adalah novel karya Dee Lestari yang menghadirkan sebuah dunia fiksi yang memikat dan menggelitik pemikiran. Buku ini menceritakan tentang masyarakat yang menilai kecerdasan seseorang berdasarkan kemampuan perseptual di pagi hari, saat embun masih membasahi permukaan. Dengan gaya penulisan yang imajinatif dan penuh simbolisme, \"Inteligensi Embun Pagi\" mengeksplorasi konsep-konsep seperti realitas, perspektif, dan potensi manusia. Pembaca akan dibawa ke dalam sebuah narasi yang menantang, sambil diajak untuk merenungkan batasan-batasan yang kita tetapkan terhadap kecerdasan. Novel ini akan sangat menarik bagi pecinta fiksi spekulatif yang menghargai karya-karya kreatif dengan kedalaman filosofis.', 'uploads/13.png', 50, 'Mystery'),
(14, 'Einstein: Visione del linguaggio del genio', 95000, '\"Einstein: Visione del linguaggio del genio\" adalah biografi komprehensif yang mengulas kehidupan dan pemikiran Albert Einstein, salah satu ilmuwan terbesar sepanjang masa. Ditulis oleh Walter Isaacson, buku ini menyajikan potret mendalam tentang sosok Einstein, mengupas tidak hanya penemuannya yang ikonik, tetapi juga proses kreatif, keyakinan filosofis, dan gaya hidup Einstein.\r\nDengan bahasa yang elegan dan wawasan yang mendalam, \"Einstein\" mengajak pembaca untuk menyelami dunia pemikiran Einstein dan memahami bagaimana seorang genius menavigasi alam semesta dan masyarakat. Buku ini mengungkap Einstein tidak hanya sebagai fisikawan jenius, tetapi juga seorang humanis, pemikir, dan pemberontak dengan pandangan yang unik tentang realitas.\r\n\"Einstein: Visione del linguaggio del genio\" akan menarik bagi pembaca yang tertarik dengan biografi dan sejarah sains, serta siapa pun yang ingin memahami sosok Einstein secara lebih komprehensif.', 'uploads/14.png', 50, 'Mystery'),
(17, 'halo', 90000, 'kachi', 'uploads/6738952a97477_Screenshot 2024-09-07 145421.png', 3, 'Comedy'),
(18, 'barang', 500000, 'Bola', 'uploads/676d1a2b06601_Screenshot 2024-12-23 125156.png', 30, NULL),
(19, 'Irfan', 15000, 'nyam', 'uploads/676d1b0858ca3_Screenshot 2024-12-26 001552.png', 20, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `transaction_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `user_id`, `total_price`, `transaction_date`) VALUES
(1, 'ORDER-676c1ff445c4f', 1, 1450000.00, '2024-12-25 22:08:53'),
(2, 'ORDER-676c21ecd628d', 1, 95000.00, '2024-12-25 22:17:35'),
(3, 'ORDER-676cdd909f845', 1, 255000.00, '2024-12-26 11:39:11');

-- --------------------------------------------------------

--
-- Table structure for table `transaction_details`
--

CREATE TABLE `transaction_details` (
  `id` int(11) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 2, 'Partikel', 3, 95000.00),
(2, 1, 1, 'Segala Cinta Senja', 4, 85000.00),
(3, 1, 4, 'Kematian', 1, 85000.00),
(4, 1, 10, 'Gelombang', 6, 85000.00),
(5, 1, 9, 'Learning How to Learn', 1, 110000.00),
(6, 1, 3, 'Montessori Parenting', 1, 120000.00),
(7, 2, 14, 'Einstein: Visione del linguaggio del genio', 1, 95000.00),
(8, 3, 4, 'Kematian', 3, 85000.00);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Hans', 'hnsnnthnl@gmail.com', '$2y$10$ItbdY.a88lv7KJc0OiIbCu6hqJ0aMjywCGtS3Fi9iTXQr3qqrNH4C'),
(15, 'lol', 'lol@email', '$2y$10$0WVTfvir4kSeIyaFnqJhgeZgFIhBWQagf4D6jhR37jkDvUPAYTKG.'),
(16, 'falih', 'sampah@gmail.com', '$2y$10$UEUsS0jVyBBfrTal/F2vUejdi7p3udedA7W8R4y3FoCo4cStOruZW'),
(17, 'Hansen Nathaniel', 'hansennathaniel20@gmail.com', ''),
(18, 'admin', 'admin@admin', '$2y$10$HyIcUOMc//vvSA7sptHBkO6nQTUB7XP7T8z8zcoFymnqNRxocwq5C');

-- --------------------------------------------------------

--
-- Table structure for table `users_products`
--

CREATE TABLE `users_products` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `original_product_id` int(10) UNSIGNED NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users_products`
--

INSERT INTO `users_products` (`id`, `user_id`, `original_product_id`, `added_at`) VALUES
(1, 1, 17, '2024-11-16 12:50:50'),
(2, 1, 18, '2024-12-26 08:56:11'),
(3, 18, 19, '2024-12-26 08:59:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gender` enum('Laki-laki','Perempuan','Other') DEFAULT 'Other',
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `gender`, `phone_number`, `address`) VALUES
(1, 1, 'Laki-laki', '081382328258', 'unj');

-- --------------------------------------------------------

--
-- Table structure for table `wishlist`
--

CREATE TABLE `wishlist` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(255) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `original_product_id` (`original_product_id`);

--
-- Indexes for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Constraints for table `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`original_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
