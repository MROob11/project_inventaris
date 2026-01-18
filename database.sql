CREATE DATABASE IF NOT EXISTS `db_inventaris`;

USE `db_inventaris`;

CREATE TABLE IF NOT EXISTS `Tb_Barang` (
    `Id_barang` int(11) NOT NULL AUTO_INCREMENT,
    `Nama_barang` varchar(100) NOT NULL,
    `Deskripsi_barang` text DEFAULT NULL,
    `Harga_barang` decimal(10, 2) NOT NULL,
    `Stok_barang` int(11) NOT NULL,
    `Last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
    PRIMARY KEY (`Id_barang`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4;

INSERT INTO
    `Tb_Barang` (
        `Nama_barang`,
        `Deskripsi_barang`,
        `Harga_barang`,
        `Stok_barang`
    )
VALUES (
        'Meja Biliar 9-ft Tournament',
        'Meja standar turnamen dengan batu slate Italia dan kain Simonis 860.',
        45000000.00,
        5
    ),
    (
        'Stik Predator Revo 12.4',
        'Stik carbon composite dengan low deflection shaft teknologi terbaru.',
        8500000.00,
        15
    ),
    (
        'Bola Aramith Tournament Pro',
        'Set bola duramin resin fenolik standar kejuaraan dunia.',
        4200000.00,
        20
    ),
    (
        'Master Chalk Blue (1 Gross)',
        'Kapur biliar premium original, tekstur pas tidak mudah rontok (144 pcs).',
        350000.00,
        50
    ),
    (
        'Fury Billiard Glove',
        'Sarung tangan lycra breathable, anti-slip bridge.',
        150000.00,
        100
    ),
    (
        'Lampu LED 3-Shade Green',
        'Lampu gantung klasik kap hijau dengan pencahayaan merata.',
        2800000.00,
        8
    ),
    (
        'Rak Segitiga Kayu Jati',
        'Rack segitiga custom kayu jati solid finishing natural.',
        450000.00,
        25
    );