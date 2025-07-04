-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 04 Jul 2025 pada 09.40
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

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
-- Struktur dari tabel `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `products`
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
-- Dumping data untuk tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`, `stock`, `category`) VALUES
(20, 'Pisau Dapur', 50000, 'Pisau Dapur', 'uploads/68674a15eb4d7_Pisau Dapur.png', 0, 'dapur'),
(21, 'Sofa Tamu', 950000, 'Sofa tamu ini hadir dengan desain elegan dan minimalis, cocok untuk melengkapi interior ruang tamu Anda dengan sentuhan modern yang hangat. Dibuat dari rangka kayu solid yang kokoh dan dilapisi dengan busa empuk berkualitas tinggi, sofa ini memberikan kenyamanan optimal saat bersantai bersama keluarga atau menyambut tamu. Balutan kain atau kulit sintetis yang lembut dan mudah dibersihkan menambah kesan mewah sekaligus praktis. Dengan perpaduan gaya dan fungsi, sofa ini menjadi pilihan ideal untuk menciptakan suasana ruang tamu yang nyaman dan berkelas.', 'uploads/6867589a46b3d_Sofa.jpeg', 0, 'ruangTamu'),
(22, 'Lukisan', 399999, 'Lukisan ini memancarkan keindahan visual yang mampu menghidupkan suasana ruangan dengan penuh makna dan karakter. Setiap goresan kuas pada kanvas menghadirkan perpaduan warna dan komposisi yang harmonis, menciptakan karya seni yang tidak hanya memanjakan mata, tetapi juga menggugah emosi. Cocok digunakan sebagai elemen dekoratif di ruang tamu, kamar, maupun ruang kerja, lukisan ini mampu menjadi titik fokus yang memperkaya estetika ruangan. Baik bertema alam, abstrak, maupun potret, lukisan ini merepresentasikan keunikan dan selera artistik pemiliknya.', 'uploads/6867595cd2a12_Lukisan.jpeg', 0, 'ruangTamu'),
(23, 'Karpet', 180000, 'Lotus Carpet menawarkan berbagai pilihan karpet dengan kualitas premium dan harga terjangkau yang telah dipercaya. Dengan standar internasional, karpet ini cocok untuk melengkapi berbagai ruang di rumah Anda, serta dapat digunakan untuk kegiatan outdoor seperti piknik.', 'uploads/68675a368b546_Carpet.jpg', 0, 'ruangTamu'),
(24, 'Jam Hias', 2500000, 'Jam hias ini merupakan perpaduan antara fungsi dan estetika, dirancang untuk tidak hanya menunjukkan waktu, tetapi juga mempercantik tampilan ruangan. Dengan desain elegan dan detail artistik yang menawan, jam ini cocok dijadikan elemen dekoratif di ruang tamu, ruang keluarga, atau bahkan lorong rumah. Material berkualitas tinggi memberikan kesan mewah dan tahan lama, sementara bentuk dan ornamen yang khas menambahkan nilai seni yang tinggi. Jam hias ini bukan sekadar penunjuk waktu, melainkan juga simbol keindahan yang memperkuat karakter interior rumah Anda.', 'uploads/68675ada2d72d_Jam hias.jpg', 0, 'ruangTamu'),
(25, 'Tempat Tidur', 2500000, 'Tempat tidur ini dirancang untuk memberikan kenyamanan optimal sekaligus menghadirkan sentuhan estetika yang elegan dalam kamar tidur Anda. Dengan rangka yang kokoh dari bahan berkualitas, dipadukan dengan desain modern atau klasik yang menawan, tempat tidur ini menjadi pusat perhatian sekaligus tempat beristirahat yang ideal. Permukaan yang luas dan stabil memberikan dukungan sempurna untuk kasur, memastikan tidur yang nyenyak setiap malam. Cocok untuk berbagai gaya interior, tempat tidur ini tidak hanya fungsional, tetapi juga memperkuat nuansa tenang dan hangat di ruang pribadi Anda.', 'uploads/68675b48dbe94_Tempat Tidur.jpeg', 0, 'kamarTidur'),
(26, 'Lampu Tidur', 349000, 'Lampu tidur ini hadir dengan desain simpel namun elegan, memberikan pencahayaan lembut yang menciptakan suasana tenang dan nyaman di kamar Anda. Cocok digunakan saat membaca sebelum tidur atau sebagai penerangan redup di malam hari, lampu ini membantu menciptakan lingkungan yang kondusif untuk beristirahat. Dibuat dari material berkualitas dengan detail yang estetik, lampu tidur ini tidak hanya berfungsi sebagai sumber cahaya, tetapi juga sebagai elemen dekoratif yang mempercantik ruang tidur Anda. Desainnya yang compact dan stylish membuatnya mudah dipadukan dengan berbagai gaya interior.', 'uploads/68675bd8baa18_lampu tidur.jpeg', 0, 'kamarTidur'),
(27, 'Lemari', 450000, 'Lemari tempat tidur ini merupakan solusi penyimpanan praktis yang dirancang untuk melengkapi kamar tidur dengan sentuhan fungsional dan estetis. Dengan desain yang ramping namun tetap luas, lemari ini ideal untuk menyimpan pakaian, selimut, atau barang-barang pribadi agar kamar tetap rapi dan tertata. Terbuat dari material berkualitas dengan finishing halus, lemari ini tidak hanya kuat dan tahan lama, tetapi juga mempercantik tampilan ruang tidur. Pilihan warna dan model yang elegan membuatnya mudah dipadukan dengan berbagai gaya interior, menjadikannya elemen penting dalam menciptakan kamar yang nyaman dan terorganisir.', 'uploads/68675c61cda0a_Lemari.jpg', 0, 'kamarTidur'),
(28, 'Shower', 255000, 'Shower ini dirancang untuk menghadirkan pengalaman mandi yang menyegarkan dan nyaman setiap hari. Dengan aliran air yang lembut namun merata, shower ini mampu memberikan relaksasi maksimal setelah aktivitas seharian. Desainnya yang modern dan minimalis membuatnya cocok untuk berbagai gaya kamar mandi, baik klasik maupun kontemporer. Terbuat dari bahan tahan karat dan mudah dibersihkan, shower ini juga dilengkapi dengan fitur pengatur tekanan air yang praktis. Selain fungsional, tampilannya yang elegan turut menambah kesan mewah pada area mandi Anda.', 'uploads/68675cef87487_Shower.jpg', 0, 'kamarMandi'),
(29, 'Lampu Hias', 358900, 'Ubah suasana ruang tamu Anda menjadi lebih elegan dan nyaman. Dirancang dengan gaya modern yang simple namun mewah, lampu ini cocok untuk berbagai konsep interior, mulai dari Scandinavian, industrial, hingga klasik.', 'uploads/68675d41cf33a_Lampu Hias.jpg', 0, 'ruangTamu'),
(30, 'Pot Gantung', 55000, 'Percantik tampilan halaman, balkon, atau teras rumah Anda dengan Pot Gantung Outdoor Minimalis! Dibuat dari bahan tebal berkualitas atau rotan sintetis, pot ini tahan panas, hujan, dan cocok untuk berbagai jenis tanaman seperti sirih gading, keladi, bunga gantung, atau tanaman merambat lainnya.', 'uploads/68675d7a6ef37_Pot Gantung.jpg', 0, 'outdoor'),
(31, 'Toilet', 1076000, 'Toilet ini menggabungkan desain modern dengan fungsi maksimal untuk menciptakan kenyamanan dan kebersihan di kamar mandi Anda. Dibuat dari material keramik berkualitas tinggi dengan permukaan halus dan mudah dibersihkan, toilet ini dirancang untuk tahan lama dan higienis. Sistem flush yang efisien membantu menghemat air tanpa mengurangi performa pembersihannya. Dengan bentuk ergonomis dan tampilan elegan, toilet ini cocok digunakan di berbagai jenis kamar mandi, baik bergaya minimalis, klasik, maupun kontemporer. Pilihan tepat untuk menghadirkan kenyamanan dan estetika dalam satu kesatuan.', 'uploads/68675e9fd0eab_Toilet.jpeg', 0, 'kamarMandi'),
(32, 'Rak Piring', 150000, 'Jaga dapur tetap rapi dan terorganisir dengan Rak Piring Dapur Serbaguna ini. Terbuat dari material stainless steel berkualitas, rak ini anti karat, kuat, dan tahan lama, cocok untuk menyimpan piring, gelas, sendok, bahkan peralatan masak lainnya.', 'uploads/6867602b82ccc_Rak piring.jpg', 0, 'dapur'),
(33, 'Bangku Teras', 500000, 'Hadirkan sentuhan alami dan nyaman di taman, teras, atau halaman rumah Anda dengan Bangku Outdoor. Dirancang dengan model minimalis modern, bangku ini cocok untuk berbagai gaya eksterior, mulai dari klasik hingga kontemporer', 'uploads/686760de58645_Bangku Teras.jpg', 0, 'outdoor');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transactions`
--

CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `order_id` varchar(255) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `total_price` decimal(10,2) NOT NULL,
  `transaction_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `user_id`, `total_price`, `transaction_date`) VALUES
(1, 'ORDER-676c1ff445c4f', 1, 1450000.00, '2024-12-25 22:08:53'),
(2, 'ORDER-676c21ecd628d', 1, 95000.00, '2024-12-25 22:17:35'),
(3, 'ORDER-676cdd909f845', 1, 255000.00, '2024-12-26 11:39:11'),
(4, 'ORDER-6863aecf8ad78', 19, 85000.00, '2025-07-01 16:49:47'),
(5, 'ORDER-6863b610d9c83', 19, 95000.00, '2025-07-01 17:19:18'),
(6, 'ORDER-6863ca7d20652', 19, 85000.00, '2025-07-01 18:46:46'),
(7, 'ORDER-6867408693eb5', 19, 120000.00, '2025-07-04 09:46:50'),
(8, 'ORDER-6867428cd251a', 19, 85000.00, '2025-07-04 09:55:26'),
(9, 'ORDER-68675705e3157', 19, 50000.00, '2025-07-04 11:22:51'),
(10, 'ORDER-68675f5758d60', 19, 50000.00, '2025-07-04 11:58:27'),
(11, 'ORDER-686764d407606', 20, 2500000.00, '2025-07-04 12:21:56'),
(12, 'ORDER-686771fe9ad33', 22, 2699998.00, '2025-07-04 13:18:10');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction_details`
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
-- Dumping data untuk tabel `transaction_details`
--

INSERT INTO `transaction_details` (`id`, `transaction_id`, `product_id`, `product_name`, `quantity`, `price`) VALUES
(1, 1, 2, 'Partikel', 3, 95000.00),
(2, 1, 1, 'Segala Cinta Senja', 4, 85000.00),
(3, 1, 4, 'Kematian', 1, 85000.00),
(4, 1, 10, 'Gelombang', 6, 85000.00),
(5, 1, 9, 'Learning How to Learn', 1, 110000.00),
(6, 1, 3, 'Montessori Parenting', 1, 120000.00),
(7, 2, 14, 'Einstein: Visione del linguaggio del genio', 1, 95000.00),
(8, 3, 4, 'Kematian', 3, 85000.00),
(9, 4, 1, 'Segala Cinta Senja', 1, 85000.00),
(10, 5, 2, 'Partikel', 1, 95000.00),
(11, 6, 4, 'Kematian', 1, 85000.00),
(12, 7, 6, 'Surrounded by Idiots', 1, 120000.00),
(13, 8, 4, 'Kematian', 1, 85000.00),
(14, 9, 20, 'Pisau Dapur', 1, 50000.00),
(15, 10, 20, 'Pisau Dapur', 1, 50000.00),
(16, 11, 24, 'Jam Hias', 1, 2500000.00),
(17, 12, 21, 'Sofa Tamu', 2, 950000.00),
(18, 12, 22, 'Lukisan', 2, 399999.00);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(1, 'Hans', 'hnsnnthnl@gmail.com', '$2y$10$ItbdY.a88lv7KJc0OiIbCu6hqJ0aMjywCGtS3Fi9iTXQr3qqrNH4C'),
(15, 'lol', 'lol@email', '$2y$10$0WVTfvir4kSeIyaFnqJhgeZgFIhBWQagf4D6jhR37jkDvUPAYTKG.'),
(16, 'falih', 'sampah@gmail.com', '$2y$10$UEUsS0jVyBBfrTal/F2vUejdi7p3udedA7W8R4y3FoCo4cStOruZW'),
(17, 'Hansen Nathaniel', 'hansennathaniel20@gmail.com', ''),
(18, 'admin', 'admin@admin', '$2y$10$HyIcUOMc//vvSA7sptHBkO6nQTUB7XP7T8z8zcoFymnqNRxocwq5C'),
(19, '123', '123@gmail.com', '$2y$10$Ez4L85YikADO0IItJhLXiekcPQuwXUSamUCQQtDBHw/hEpeqwWa0O'),
(20, 'test', 'test@gmail.com', '$2y$10$rm2EnqWA5ywfCKBg2biW0..bca9ho0T3Wgp6BHazQ5Ir5YTWjHbbS'),
(21, 'test123', 'test123@gmail.com', '$2y$10$BMqYNygCPKEL0MXkttafA.0LiYoSWGVt709BSrlX8FTUIFpCZIp9S'),
(22, '12345', '12345@gmail.com', '$2y$10$AZostkLeRcZHsKsxjbD6V.SHv0XYqXDh.KhX7r52jbAXqMGnpenZC'),
(23, 'jim', '123@jad.com', '$2y$10$ezlCO0icOV.R5JOvyJeMWORRCxD8PTqoAkYqOqyFhm93P1XkSzIYy');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_products`
--

CREATE TABLE `users_products` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `original_product_id` int(10) UNSIGNED NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `users_products`
--

INSERT INTO `users_products` (`id`, `user_id`, `original_product_id`, `added_at`) VALUES
(4, 18, 20, '2025-07-04 03:27:17'),
(5, 18, 21, '2025-07-04 04:29:14'),
(6, 18, 22, '2025-07-04 04:32:28'),
(7, 18, 23, '2025-07-04 04:36:06'),
(8, 18, 24, '2025-07-04 04:38:50'),
(9, 18, 25, '2025-07-04 04:40:40'),
(10, 18, 26, '2025-07-04 04:43:04'),
(11, 18, 27, '2025-07-04 04:45:21'),
(12, 18, 28, '2025-07-04 04:47:43'),
(13, 18, 29, '2025-07-04 04:49:05'),
(14, 18, 30, '2025-07-04 04:50:02'),
(15, 18, 31, '2025-07-04 04:54:55'),
(16, 18, 32, '2025-07-04 05:01:31'),
(17, 18, 33, '2025-07-04 05:04:30');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_profiles`
--

CREATE TABLE `user_profiles` (
  `id` int(11) NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `gender` enum('Laki-laki','Perempuan','Other') DEFAULT 'Other',
  `phone_number` varchar(20) DEFAULT NULL,
  `address` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user_profiles`
--

INSERT INTO `user_profiles` (`id`, `user_id`, `gender`, `phone_number`, `address`) VALUES
(1, 1, 'Laki-laki', '081382328258', 'unj');

-- --------------------------------------------------------

--
-- Struktur dari tabel `wishlist`
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
-- Dumping data untuk tabel `wishlist`
--

INSERT INTO `wishlist` (`id`, `user_id`, `product_id`, `product_name`, `price`, `image`, `added_at`) VALUES
(12, 20, 25, 'Tempat Tidur', 2500000.00, 'uploads/68675b48dbe94_Tempat Tidur.jpeg', '2025-07-04 05:07:52'),
(13, 22, 22, 'Lukisan', 399999.00, 'uploads/6867595cd2a12_Lukisan.jpeg', '2025-07-04 06:17:10');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indeks untuk tabel `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indeks untuk tabel `users_products`
--
ALTER TABLE `users_products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `original_product_id` (`original_product_id`);

--
-- Indeks untuk tabel `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indeks untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT untuk tabel `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT untuk tabel `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `users_products`
--
ALTER TABLE `users_products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT untuk tabel `user_profiles`
--
ALTER TABLE `user_profiles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Ketidakleluasaan untuk tabel `transaction_details`
--
ALTER TABLE `transaction_details`
  ADD CONSTRAINT `transaction_details_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactions` (`id`);

--
-- Ketidakleluasaan untuk tabel `users_products`
--
ALTER TABLE `users_products`
  ADD CONSTRAINT `users_products_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_products_ibfk_2` FOREIGN KEY (`original_product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `user_profiles`
--
ALTER TABLE `user_profiles`
  ADD CONSTRAINT `user_profiles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ketidakleluasaan untuk tabel `wishlist`
--
ALTER TABLE `wishlist`
  ADD CONSTRAINT `wishlist_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlist_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
