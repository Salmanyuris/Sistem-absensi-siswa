<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$pageTitles = array(
    'home' => 'Absensi',
    'data' => 'Data siswa',
    'tambah' => 'Tambah siswa',
);
if (!isset($pageTitles[$page])) {
    $page = 'home';
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitles[$page], ENT_QUOTES, 'UTF-8') ?> | Absensi Sekolah</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="app-shell">
        <aside class="sidebar">
            <a class="brand" href="index.php?page=home">
                <span class="brand-mark">A</span>
                <span>
                    <strong>RuangKelas</strong>
                    <small>Portal sekolah</small>
                </span>
            </a>

            <p class="nav-caption">MENU UTAMA</p>
            <nav class="side-nav" aria-label="Navigasi utama">
                <a class="<?= $page === 'home' ? 'active' : '' ?>" href="index.php?page=home">
                    <span class="nav-icon">◷</span> Absensi
                </a>
                <a class="<?= $page === 'data' ? 'active' : '' ?>" href="index.php?page=data">
                    <span class="nav-icon">▦</span> Data siswa
                </a>
            </nav>

            <div class="sidebar-note">
                <span class="note-dot"></span>
                <div>
                    <strong>SMK Warna Dunia</strong>
                    <small>Sistem informasi sekolah</small>
                </div>
            </div>
        </aside>

        <main class="main-content">
            <header class="topbar">
                <div>
                    <span class="eyebrow">MANAJEMEN SEKOLAH</span>
                    <h1><?= htmlspecialchars($pageTitles[$page], ENT_QUOTES, 'UTF-8') ?></h1>
                </div>
                <div class="profile-chip">
                    <span class="profile-avatar">A</span>
                    <span><strong>Administrator</strong><small>Panel sekolah</small></span>
                </div>
            </header>

            <section class="content-area">
                <?php
                switch ($page) {
                    case 'data':
                        include "data.php";
                        break;
                    case 'tambah':
                        include "form-tambah.php";
                        break;
                    case 'home':
                    default:
                        include "home.php";
                        break;
                }
                ?>
            </section>

            <footer class="app-footer">© <?= date('Y') ?> SMK Warna Dunia <span>•</span> Sistem Absensi</footer>
        </main>
    </div>
</body>

</html>
