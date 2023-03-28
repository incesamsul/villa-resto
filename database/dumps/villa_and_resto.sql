

INSERT INTO `kamar` (`id_kamar`, `nama_kamar`, `harga_kamar`, `status`, `created_at`, `updated_at`) VALUES
(1, 'kamar 102', '200000', '1', '2023-03-25 08:29:35', '2023-03-25 08:32:23'),
(2, 'kamar 202', '170000', '1', '2023-03-25 08:29:45', '2023-03-25 08:30:46'),
(3, 'kamar 330', '300000', '1', '2023-03-25 08:34:59', '2023-03-25 08:36:01'),
(4, 'kamar 440', '500000', '1', '2023-03-25 08:35:08', '2023-03-25 08:35:22'),
(5, 'kamar 505', '4000000', '1', '2023-03-25 08:41:48', '2023-03-27 05:29:41'),
(6, 'kamar 616', '200000', '1', '2023-03-27 20:13:32', '2023-03-27 20:13:58');


INSERT INTO `kategori` (`id_kategori`, `nama_kategori`, `gambar`, `created_at`, `updated_at`) VALUES
(2, 'kopi', '6421a2f6dbd27..jpg', '2023-03-27 06:06:46', '2023-03-27 06:14:53'),
(3, 'teh', '6421a535617a9..jpg', '2023-03-27 06:16:21', '2023-03-27 07:39:14'),
(4, 'Breakfast', '6421a5427a402..jpg', '2023-03-27 06:16:34', '2023-03-27 06:24:38'),
(5, 'Lunch', '6421a55ee8098..jpg', '2023-03-27 06:17:02', '2023-03-27 06:24:25'),
(7, 'Jus', '6421a6b5e13c1..jpg', '2023-03-27 06:17:35', '2023-03-27 06:22:45'),
(8, 'Snack', '6421a587bf4ae..jpg', '2023-03-27 06:17:43', '2023-03-27 06:17:43'),
(9, 'dinner', '6421a7391f2e1..jpg', '2023-03-27 06:24:57', '2023-03-27 06:24:57');




INSERT INTO `menu` (`id_menu`, `id_kategori`, `nama_menu`, `deskripsi`, `gambar`, `harga`, `created_at`, `updated_at`) VALUES
(5, 2, 'espresso', 'minuman esktrak kopi yang pahit dengan sedikit tambahan rasa asam', '6421b448ec1b1..jpg', 25000, '2023-03-27 07:19:45', '2023-03-27 07:20:40'),
(6, 3, 'Teh tarik', 'minuman yang terbuat dari daun yang di tarik menggunakan tali rapiah', '6421b89367439..jpg', 27000, '2023-03-27 07:38:59', '2023-03-27 07:38:59'),
(7, 4, 'Telur rebus', 'Telur yang di goreng menggunakan minyak panas dengan suhu 700 F', '6421d656e93c6..jpg', 28000, '2023-03-27 09:45:59', '2023-03-27 09:45:59'),
(8, 7, 'Jus kuning', 'Minuman jus yang terbuat dari buah buahan berwarna kuning', '6421d672dc03b..jpg', 18000, '2023-03-27 09:46:26', '2023-03-27 09:46:26');







INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `foto`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@mail.com', NULL, '$2y$10$N6nmGrHUtLAw5/5SlPZqEehn.S5KDNDFHf1yuW184mEw5zLWhVeLm', 'Administrator', '64213a5d9d191.jpg', NULL, '2021-11-24 01:06:43', '2023-03-26 22:40:29');

