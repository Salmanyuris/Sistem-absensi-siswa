<section class="panel edit-card inline-form-card">
    <h1>Tambah siswa</h1>
    <p class="edit-subtitle">Masukkan informasi dasar siswa baru.</p>
    <form action="proses-tambah.php" method="post">
        <div class="mb-3">
            <label class="form-label" for="nis">NIS</label>
            <input id="nis" type="text" class="form-control" name="nis" placeholder="Masukkan NIS" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="nama">Nama siswa</label>
            <input id="nama" type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="alamat">Alamat</label>
            <input id="alamat" type="text" class="form-control" name="alamat" placeholder="Masukkan alamat" required>
        </div>
        <div class="mb-3">
            <label class="form-label" for="jenis_kelamin">Jenis kelamin</label>
            <select id="jenis_kelamin" class="form-select" name="jenis_kelamin" required>
                <option value="">Pilih jenis kelamin</option>
                <option value="pria">Pria</option>
                <option value="wanita">Wanita</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label" for="agama">Agama</label>
            <select id="agama" class="form-select" name="agama" required>
                <option value="">Pilih agama</option>
                <option value="islam">Islam</option>
                <option value="kristen">Kristen</option>
                <option value="budha">Budha</option>
                <option value="katholik">Katholik</option>
            </select>
        </div>
        <div class="edit-actions">
            <a href="index.php?page=data" class="btn btn-light">Batal</a>
            <button type="submit" class="btn btn-primary" name="simpan" value="simpan">Simpan siswa</button>
        </div>
    </form>
</section>
