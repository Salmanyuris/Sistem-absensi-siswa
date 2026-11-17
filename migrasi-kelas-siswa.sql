USE `absensi`;

ALTER TABLE `siswa`
  ADD COLUMN `kelas` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '' AFTER `nama`;

ALTER TABLE `absen`
  DROP PRIMARY KEY,
  ADD PRIMARY KEY (`nis`, `tanggal`);
