-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 03 Apr 2021 pada 10.43
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `matacode`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(11) NOT NULL,
  `url_kategori` varchar(50) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL,
  `img_kategori` varchar(100) NOT NULL,
  `urutan_kategori` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `url_kategori`, `nama_kategori`, `img_kategori`, `urutan_kategori`) VALUES
(1, 'html', 'HTML', 'html.png', 1),
(2, 'css', 'CSS', 'matacode.png', 2),
(3, 'javascript', 'Javascript', 'matacode1.png', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `komentar`
--

CREATE TABLE `komentar` (
  `id_komentar` int(11) NOT NULL,
  `id_post` int(11) NOT NULL,
  `nama_komentar` varchar(30) NOT NULL,
  `isi_komentar` varchar(200) NOT NULL,
  `tanggal_komentar` varchar(50) NOT NULL,
  `ip_komentar` varchar(50) NOT NULL,
  `status_komentar` enum('belum','dibaca') NOT NULL,
  `level_komentar` enum('admin','users') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `komentar`
--

INSERT INTO `komentar` (`id_komentar`, `id_post`, `nama_komentar`, `isi_komentar`, `tanggal_komentar`, `ip_komentar`, `status_komentar`, `level_komentar`) VALUES
(2, 7, 'ketut krisna', 'test aja bro', '1617423757', '::1', 'dibaca', 'users'),
(3, 7, 'Admin', 'Oke bro selamat berselancar disini..', '1617424664', '::1', 'dibaca', 'admin'),
(6, 7, 'Jokowi', 'Saya selaku presiden sangat mendukung karya anda!', '1617437410', '::1', 'dibaca', 'users');

-- --------------------------------------------------------

--
-- Struktur dari tabel `posting`
--

CREATE TABLE `posting` (
  `id_posting` int(11) NOT NULL,
  `url_posting` varchar(200) NOT NULL,
  `judul_posting` varchar(100) NOT NULL,
  `isi_posting` longtext NOT NULL,
  `tanggal_posting` varchar(100) NOT NULL,
  `kategori_posting` int(11) NOT NULL,
  `visitor_posting` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `posting`
--

INSERT INTO `posting` (`id_posting`, `url_posting`, `judul_posting`, `isi_posting`, `tanggal_posting`, `kategori_posting`, `visitor_posting`) VALUES
(1, 'membuat-data-json-dengan-php', 'Membuat data json dengan php', 'Ini merupakan data yang penting untuk dipelajari oleh kita. mari kita pelajari dengan cara seksama okelah kalo begitu<p class=\"codepen\" data-height=\"265\" data-theme-id=\"dark\" data-default-tab=\"html,result\" data-user=\"ketut-krisna\" data-slug-hash=\"poRjGxa\" xss=removed data-pen-title=\"oke\">\r\n                  <span>See the Pen <a href=\"https://codepen.io/ketut-krisna/pen/poRjGxa\">\r\n                  oke</a> by Ketut Krisna (<a href=\"https://codepen.io/ketut-krisna\">@ketut-krisna</a>)\r\n                  on <a href=\"https://codepen.io\">CodePen</a>.</span>\r\n                </p><div class=\"alert alert-warning m-0 d-flex justify-content-start align-items-center\" role=\"alert\">\r\n                  <i class=\"bi bi-info-circle fw-bold me-2\"></i>\r\n                  <span xss=removed>A simple warning alert—check it out A simple warning alert—check it out!</span>\r\n                </div>', '1616734487', 1, 45),
(2, 'okelah-saya-coba-dulu', 'okelah saya coba dulus css', 'oke test bro yas', '1616747256', 2, 11),
(3, 'javascript-lanjutan-oke', 'javascript lanjutan oke', 'oke sekarang kita mulai javascript nya', '1616837760', 3, 7),
(4, 'css-dasar-untuk-menjadi-profesional', 'css dasar untuk menjadi profesional', 'mari belajar bro', '1616841366', 2, 5),
(5, 'css-mantap', 'css mantap', 'css oke', '1616841926', 2, 20),
(7, 'html-oke', 'html oke', 'Breaking columns to a new line in flexbox requires a small hack: add an element with width: 100% wherever you want to wrap your columns to a new line. Normally this is accomplished with multiple .rows, but not every implementation method can account for this.\r\nBreaking columns to a new line in flexbox requires a small hack: add an element with width: 100% wherever you want to wrap your columns to a new line. Normally this is accomplished with multiple .rows, but not every implementation method can account for this.\r\nBreaking columns to a new line in flexbox requires a small hack: add an element with width: 100% wherever you want to wrap your columns to a new line. Normally this is accomplished with multiple .rows, but not every implementation method can account for this.\r\nBreaking columns to a new line in flexbox requires a small hack: add an element with width: 100% wherever you want to wrap your columns to a new line. Normally this is accomplished with multiple .rows, but not every implementation method can account for this.', '1616842012', 1, 276);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `nama_user` varchar(50) NOT NULL,
  `username_user` varchar(20) NOT NULL,
  `password_user` char(150) NOT NULL,
  `level_user` enum('admin','user') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id_user`, `nama_user`, `username_user`, `password_user`, `level_user`) VALUES
(1, 'Mata Kode', 'admin', '$2y$10$30DRki3Veg9G6SFTI1xiI.UwdJ7JgwXRhxyulRatZBW1HGKrWzoYO', 'admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `visitor`
--

CREATE TABLE `visitor` (
  `id_visitor` int(11) NOT NULL,
  `total_visitor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `visitor`
--

INSERT INTO `visitor` (`id_visitor`, `total_visitor`) VALUES
(1, 2289);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indeks untuk tabel `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentar`);

--
-- Indeks untuk tabel `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`id_posting`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `visitor`
--
ALTER TABLE `visitor`
  ADD PRIMARY KEY (`id_visitor`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `posting`
--
ALTER TABLE `posting`
  MODIFY `id_posting` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `visitor`
--
ALTER TABLE `visitor`
  MODIFY `id_visitor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
