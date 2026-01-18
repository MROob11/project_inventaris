-- Database: db_inventaris
CREATE DATABASE IF NOT EXISTS `db_inventaris`;
USE `db_inventaris`;

-- Table Structure for Tb_Barang
CREATE TABLE IF NOT EXISTS `Tb_Barang` (
  `Id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `Nama_barang` varchar(100) NOT NULL,
  `Deskripsi_barang` text DEFAULT NULL,
  `Harga_barang` decimal(10,2) NOT NULL,
  `Stok_barang` int(11) NOT NULL,
  `Last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`Id_barang`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table `Tb_Barang`
INSERT INTO `Tb_Barang` (`Nama_barang`, `Deskripsi_barang`, `Harga_barang`, `Stok_barang`) VALUES
('Laptop Gaming X', 'Laptop performa tinggi untuk gaming dan rendering.', 15000000.00, 10),
('Mouse Wireless Pro', 'Mouse ergonomis dengan presisi tinggi.', 250000.00, 50),
('Mechanical Keyboard', 'Keyboard mekanik switch biru RGB.', 750000.00, 30),
('Monitor 144Hz', 'Monitor 24 inch refresh rate tinggi 144Hz.', 2200000.00, 15),
('Headset 7.1 Surround', 'Headset gaming dengan suara surround virtual.', 450000.00, 25);
