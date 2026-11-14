<?php
$errorTitle = isset($errorTitle) ? $errorTitle : "Halaman tidak tersedia";
$errorMessage = isset($errorMessage) ? $errorMessage : "Terjadi kesalahan saat memuat halaman.";
$errorDetail = isset($errorDetail) ? $errorDetail : "";
$errorBackUrl = isset($errorBackUrl) ? $errorBackUrl : "index.php?page=home";
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= htmlspecialchars($errorTitle, ENT_QUOTES, "UTF-8") ?> | Absensi Sekolah</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <main class="edit-page">
        <section class="edit-card">
            <h1><?= htmlspecialchars($errorTitle, ENT_QUOTES, "UTF-8") ?></h1>
            <p class="edit-subtitle"><?= htmlspecialchars($errorMessage, ENT_QUOTES, "UTF-8") ?></p>
            <?php if ($errorDetail !== "") { ?>
                <p class="database-notice-detail"><?= htmlspecialchars($errorDetail, ENT_QUOTES, "UTF-8") ?></p>
            <?php } ?>
            <a href="<?= htmlspecialchars($errorBackUrl, ENT_QUOTES, "UTF-8") ?>" class="btn btn-primary">Kembali</a>
        </section>
    </main>
</body>

</html>
