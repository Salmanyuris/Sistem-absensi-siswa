<?php
$pageTitles = array(
    'home' => 'Absensi',
    'data' => 'Data siswa',
    'detail' => 'Detail siswa',
    'tambah' => 'Tambah siswa',
);
$requestedPage = isset($_GET['page']) && is_string($_GET['page']) ? $_GET['page'] : 'home';
$page = isset($pageTitles[$requestedPage]) ? $requestedPage : 'home';
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($pageTitles[$page], ENT_QUOTES, 'UTF-8') ?> | Absensi Sekolah</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <script src="assets/js/app.js" defer></script>
</head>

<body>
    <div class="app-shell">
        <aside class="sidebar" id="primary-sidebar">
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
                <a class="<?= in_array($page, array('data', 'detail'), true) ? 'active' : '' ?>" href="index.php?page=data">
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
        <button class="sidebar-backdrop" type="button" aria-label="Tutup menu navigasi" hidden></button>

        <main class="main-content">
            <header class="topbar">
                <div class="topbar-heading">
                    <button class="menu-toggle" type="button" aria-controls="primary-sidebar" aria-expanded="false" aria-label="Buka menu navigasi">
                        <span></span>
                        <span></span>
                        <span></span>
                    </button>
                    <div>
                        <span class="eyebrow">MANAJEMEN SEKOLAH</span>
                        <h1><?= htmlspecialchars($pageTitles[$page], ENT_QUOTES, 'UTF-8') ?></h1>
                    </div>
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
                    case 'detail':
                        include "detail-siswa.php";
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
