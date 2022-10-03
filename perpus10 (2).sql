-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 03, 2022 at 06:48 PM
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
-- Database: `perpus10`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id_buku` int(11) NOT NULL,
  `judul` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tahun` year(4) NOT NULL,
  `kota` varchar(100) NOT NULL,
  `cover` varchar(255) NOT NULL,
  `sinopsis` text NOT NULL,
  `stok` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id_buku`, `judul`, `penulis`, `penerbit`, `tahun`, `kota`, `cover`, `sinopsis`, `stok`) VALUES
(1, 'Laskar Pelangi', 'Andrea Hirata', 'Bentang Pustaka', 2005, 'Jakarta', 'Laskar_pelangi_sampul.jpg', 'Bangunan itu nyaris rubuh. Dindingnya miring bersangga sebalok kayu. Atapnya bocor di mana-mana. Tetapi, berpasang-pasang mata mungil menatap penuh harap. Hendak ke mana lagikah mereka harus bersekolah selain tempat itu? Tak peduli seberat apa pun kondisi sekolah itu, sepuluh anak dari keluarga miskin itu tetap bergeming. Di dada mereka, telah menggumpal tekad untuk maju.', 1),
(8, 'Negeri 5 Menara', 'Ahmad Fuadi', 'Gramedia', 2009, 'Jakarta', 'buku3.jpg', 'Alif lahir di pinggir Danau Maninjau dan tidak pernah menginjak tanah di luar ranah Minangkabau. Masa kecilnya adalah berburu durian runtuh di rimba Bukit Barisan, bermain sepak bola di sawah berlumpur dan tentu mandi berkecipak di air biru Danau Maninjau.\r\n\r\nTiba-tiba saja dia harus naik bus tiga hari tiga malam melintasi punggung Sumatra dan Jawa menuju sebuah desa di pelosok Jawa Timur. Ibunya ingin dia menjadi Buya Hamka walau Alif ingin menjadi Habibie. Dengan setengah hati dia mengikuti perintah Ibunya, belajar di pondok.\r\n\r\nDi kelas hari pertamanya di Pondok Madani (PM), Alif terkesima dengan “mantra” sakti man jadda wajada. Siapa yang bersungguh-sungguh pasti sukses.\r\n\r\nDia terheran-heran mendengar komentator sepak bola berbahasa Arab, anak mengigau dalam bahasa Inggris, merinding mendengar ribuan orang melagukan Syair Abu Nawas dan terkesan melihat pondoknya setiap pagi seperti melayang di udara.\r\n\r\nDipersatukan oleh hukuman jewer berantai, Alif berteman dekat dengan Raja dari Medan, Said dari Surabaya, Dulmajid dari Sumenep, Atang dari Bandung dan Baso dari Gowa. Di bawah menara masjid yang menjulang, mereka berenam kerap menunggu maghrib sambil menatap awan lembayung yang berarak pulang ke ufuk. Di mata belia mereka, awan-awan itu menjelma menjadi negara dan benua impian masing-masing. Kemana impian jiwa muda ini membawa mereka? Mereka tidak tahu. Yang mereka tahu adalah: Jangan pernah remehkan impian, walau setinggi apa pun. Tuhan sungguh Maha Mendengar.', 1),
(10, 'Hujan', 'Tere Liye', 'Gramedia', 2016, 'Jakarta', 'Hujan.jpg', 'Pada 2042, dunia telah memasuki era di mana peran manusia telah digantikan oleh ilmu pengeahuan dan teknologi canggih. Cerita berfokus pada karakter Lail, gadis berusia 13 tahun, yang pada hari pertamanya di sekolah harus mengalami bencana gunung meletus dan gempa dahsyat.', 8);

-- --------------------------------------------------------

--
-- Table structure for table `detail_peminjaman`
--

CREATE TABLE `detail_peminjaman` (
  `id_detail_peminjaman` int(11) NOT NULL,
  `id_buku` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `kuantitas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_peminjaman`
--

INSERT INTO `detail_peminjaman` (`id_detail_peminjaman`, `id_buku`, `id_peminjaman`, `kuantitas`) VALUES
(3, 1, 13, 2),
(4, 1, 5, 1),
(5, 10, 5, 1),
(7, 1, 8, 1),
(8, 1, 6, 1),
(9, 1, 5, 1),
(10, 10, 6, 1),
(11, 10, 29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `detail_pengembalian`
--

CREATE TABLE `detail_pengembalian` (
  `id_detail_pengembalian` int(11) NOT NULL,
  `id_pengembalian` int(11) NOT NULL,
  `ada` int(2) NOT NULL,
  `hilang` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `detail_pengembalian`
--

INSERT INTO `detail_pengembalian` (`id_detail_pengembalian`, `id_pengembalian`, `ada`, `hilang`) VALUES
(1, 11, 1, 0),
(2, 12, 1, 0),
(3, 13, 1, 0),
(4, 14, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `kelas`
--

CREATE TABLE `kelas` (
  `id_kelas` int(2) NOT NULL,
  `nama_kelas` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kelas`
--

INSERT INTO `kelas` (`id_kelas`, `nama_kelas`) VALUES
(1, '10-A'),
(2, '10-B'),
(4, '11-A'),
(5, '11-B'),
(6, '12-A'),
(7, '12-B');

-- --------------------------------------------------------

--
-- Table structure for table `peminjaman`
--

CREATE TABLE `peminjaman` (
  `id_peminjaman` int(11) NOT NULL,
  `id_siswa` int(11) NOT NULL,
  `id_petugas` int(11) NOT NULL,
  `tanggal_peminjaman` date NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `status` enum('dipinjam','dikembalikan') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `peminjaman`
--

INSERT INTO `peminjaman` (`id_peminjaman`, `id_siswa`, `id_petugas`, `tanggal_peminjaman`, `tanggal_pengembalian`, `status`) VALUES
(3, 1233, 123, '2022-09-08', '2022-09-15', 'dipinjam'),
(4, 1233, 123, '2022-09-21', '2022-09-28', 'dipinjam'),
(5, 1234, 124, '2022-10-03', '2022-10-10', 'dipinjam'),
(6, 1290, 123, '2022-10-01', '2022-10-08', 'dipinjam'),
(7, 1233, 123, '2022-10-20', '2022-10-27', 'dipinjam'),
(8, 1235, 123, '2022-09-29', '2022-10-06', 'dipinjam'),
(9, 1233, 123, '2022-09-26', '2022-10-03', 'dipinjam'),
(10, 1290, 123, '2022-10-20', '2022-10-27', 'dipinjam'),
(11, 1235, 123, '2022-10-01', '2022-10-08', 'dipinjam'),
(12, 1234, 123, '2022-10-01', '2022-10-08', 'dipinjam'),
(13, 1290, 123, '2022-10-01', '2022-10-08', 'dipinjam'),
(14, 1234, 123, '2022-10-07', '2022-11-05', 'dipinjam'),
(15, 1290, 123, '2022-10-08', '2022-10-17', 'dipinjam'),
(16, 1235, 123, '2022-10-22', '2022-10-29', 'dipinjam'),
(18, 1233, 124, '2022-10-07', '2022-10-14', 'dipinjam'),
(20, 1234, 124, '2022-10-21', '2022-10-28', 'dipinjam'),
(21, 1234, 124, '2022-10-15', '2022-10-22', 'dipinjam'),
(22, 1235, 123, '2022-10-14', '2022-10-21', 'dipinjam'),
(23, 1290, 123, '2022-10-08', '2022-10-15', 'dipinjam'),
(24, 1234, 123, '2022-10-05', '2022-10-12', 'dipinjam'),
(25, 1234, 123, '2022-10-01', '2022-10-08', 'dipinjam'),
(26, 1290, 123, '2022-10-01', '2022-10-08', 'dipinjam'),
(27, 1233, 123, '2022-09-25', '2022-10-02', 'dipinjam'),
(28, 1234, 123, '2022-09-27', '2022-10-04', 'dipinjam'),
(29, 1290, 123, '2022-10-29', '2022-11-05', 'dikembalikan');

-- --------------------------------------------------------

--
-- Table structure for table `pengembalian`
--

CREATE TABLE `pengembalian` (
  `id_pengembalian` int(11) NOT NULL,
  `id_peminjaman` int(11) NOT NULL,
  `tanggal_pengembalian` date NOT NULL,
  `denda` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pengembalian`
--

INSERT INTO `pengembalian` (`id_pengembalian`, `id_peminjaman`, `tanggal_pengembalian`, `denda`) VALUES
(10, 25, '2022-11-05', 28000),
(11, 23, '2022-11-05', 21000),
(12, 9, '2022-10-20', 17000),
(13, 23, '2022-11-05', 21000),
(14, 29, '2022-10-20', 16000);

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `nip` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `level` enum('admin','petugas') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`nip`, `nama`, `jenis_kelamin`, `alamat`, `password`, `level`) VALUES
(123, 'Farras', 'L', 'Malang', 'farras', 'admin'),
(124, 'Luthfa', 'P', 'Surabaya', 'luthfa', 'petugas'),
(126, 'Adit', 'L', 'Surabaya', 'adit123', 'petugas');

-- --------------------------------------------------------

--
-- Table structure for table `siswa`
--

CREATE TABLE `siswa` (
  `nis` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `jenis_kelamin` enum('L','P') NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `id_kelas` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `siswa`
--

INSERT INTO `siswa` (`nis`, `nama`, `jenis_kelamin`, `alamat`, `id_kelas`) VALUES
(1233, 'Andi', 'L', 'Bandung', 6),
(1234, 'Budi', 'L', 'Malang', 1),
(1235, 'Fika', 'P', 'Malang', 5),
(1290, 'Sari', 'P', 'Madiun', 6);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD PRIMARY KEY (`id_detail_peminjaman`),
  ADD KEY `id_buku` (`id_buku`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indexes for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  ADD PRIMARY KEY (`id_detail_pengembalian`),
  ADD KEY `id_pengembalian` (`id_pengembalian`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id_kelas`);

--
-- Indexes for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD PRIMARY KEY (`id_peminjaman`),
  ADD KEY `id_siswa` (`id_siswa`),
  ADD KEY `id_petugas` (`id_petugas`);

--
-- Indexes for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD PRIMARY KEY (`id_pengembalian`),
  ADD KEY `id_peminjaman` (`id_peminjaman`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`nip`);

--
-- Indexes for table `siswa`
--
ALTER TABLE `siswa`
  ADD PRIMARY KEY (`nis`),
  ADD KEY `id_kelas` (`id_kelas`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  MODIFY `id_detail_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  MODIFY `id_detail_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id_kelas` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `peminjaman`
--
ALTER TABLE `peminjaman`
  MODIFY `id_peminjaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `pengembalian`
--
ALTER TABLE `pengembalian`
  MODIFY `id_pengembalian` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `detail_peminjaman`
--
ALTER TABLE `detail_peminjaman`
  ADD CONSTRAINT `detail_peminjaman_ibfk_1` FOREIGN KEY (`id_buku`) REFERENCES `buku` (`id_buku`),
  ADD CONSTRAINT `detail_peminjaman_ibfk_2` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Constraints for table `detail_pengembalian`
--
ALTER TABLE `detail_pengembalian`
  ADD CONSTRAINT `detail_pengembalian_ibfk_1` FOREIGN KEY (`id_pengembalian`) REFERENCES `pengembalian` (`id_pengembalian`);

--
-- Constraints for table `peminjaman`
--
ALTER TABLE `peminjaman`
  ADD CONSTRAINT `peminjaman_ibfk_1` FOREIGN KEY (`id_siswa`) REFERENCES `siswa` (`nis`),
  ADD CONSTRAINT `peminjaman_ibfk_2` FOREIGN KEY (`id_petugas`) REFERENCES `petugas` (`nip`);

--
-- Constraints for table `pengembalian`
--
ALTER TABLE `pengembalian`
  ADD CONSTRAINT `pengembalian_ibfk_2` FOREIGN KEY (`id_peminjaman`) REFERENCES `peminjaman` (`id_peminjaman`);

--
-- Constraints for table `siswa`
--
ALTER TABLE `siswa`
  ADD CONSTRAINT `siswa_ibfk_1` FOREIGN KEY (`id_kelas`) REFERENCES `kelas` (`id_kelas`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
