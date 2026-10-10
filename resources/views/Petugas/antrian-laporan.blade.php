<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Antrian Laporan — Fasilitas Kampus</title>

    <link rel="stylesheet" href="{{ asset('fasilitas.css') }}">
</head>

<body>

    <!-- =========================
         NAVBAR
    ========================== -->

    <header class="navbar">

        <div class="navbar-container">

            <a href="/fasilitas" class="brand">

                <div class="brand-logo">
                    FK
                </div>

                <div class="brand-text">
                    <strong>Fasilitas Kampus</strong>
                    <span>Panel Petugas</span>
                </div>

            </a>


            <nav class="navigation">

                <a href="/dashboard-petugas" class="nav-link">
                    Dashboard
                </a>

                <a href="/antrian-reservasi" class="nav-link">
                    Reservasi
                </a>

                <a href="/antrian-laporan" class="nav-link active">
                    Laporan
                </a>

            </nav>

        </div>

    </header>


    <main>

        <!-- =========================
             PAGE HEADER
        ========================== -->

        <section class="page-header">

            <div class="page-header-content">

                <span class="hero-badge">
                    PANEL PETUGAS
                </span>

                <h1>
                    Antrian laporan
                    <span>kerusakan fasilitas</span>
                </h1>

                <p>
                    Tinjau dan perbarui status setiap laporan kerusakan
                    yang masuk dari pengguna.
                </p>

            </div>

            <div class="hero-decoration decoration-one"></div>
            <div class="hero-decoration decoration-two"></div>

        </section>


        <!-- =========================
             SUMMARY
        ========================== -->

        <section class="summary">

            <div class="summary-card">

                <div class="summary-icon blue">
                    📋
                </div>

                <div class="summary-content">

                    <span>Total Laporan</span>

                    <strong>5</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon red">
                    ⏳
                </div>

                <div class="summary-content">

                    <span>Menunggu</span>

                    <strong>2</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon green">
                    ✓
                </div>

                <div class="summary-content">

                    <span>Selesai</span>

                    <strong>2</strong>

                </div>

            </div>

        </section>


        <!-- =========================
             LAPORAN LIST
        ========================== -->

        <section class="riwayat-section">

            <div class="section-heading">

                <div>

                    <span class="section-label">
                        DAFTAR LAPORAN
                    </span>

                    <h2>
                        Semua laporan
                    </h2>

                    <p>
                        Klik "Tinjau" untuk melihat detail dan memperbarui status laporan.
                    </p>

                </div>

            </div>


            <!-- LAPORAN 1 — Menunggu -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏫
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            ELEKTRONIK — RUANG SEMINAR
                        </span>

                        <h3>
                            AC tidak menyala
                        </h3>

                        <p>
                            📍 Ruang Seminar, Gedung A
                            &nbsp;·&nbsp; 👤 Budi Santoso
                            &nbsp;·&nbsp; 14 Sep 2026
                        </p>

                        <p class="reservasi-tujuan">
                            AC di sudut kiri tidak menyala sejak kemarin meskipun sudah dicoba via remote.
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-menunggu">
                        Menunggu
                    </span>

                    <div class="reservasi-actions">

                        <button
                            class="btn-detail"
                            data-id="1"
                            data-fasilitas="Ruang Seminar, Gedung A"
                            data-kategori="Elektronik"
                            data-judul="AC tidak menyala"
                            data-deskripsi="AC di sudut kiri tidak menyala sejak kemarin meskipun sudah dicoba via remote."
                            data-pelapor="Budi Santoso"
                            data-tanggal="14 September 2026"
                            data-status="menunggu"
                        >
                            Tinjau
                        </button>

                    </div>

                </div>

            </article>


            <!-- LAPORAN 2 — Diproses -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏛️
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            PERABOTAN — AULA FAKULTAS
                        </span>

                        <h3>
                            Kursi rusak
                        </h3>

                        <p>
                            📍 Aula Fakultas, Gedung B
                            &nbsp;·&nbsp; 👤 Dewi Lestari
                            &nbsp;·&nbsp; 10 Sep 2026
                        </p>

                        <p class="reservasi-tujuan">
                            Terdapat 5 kursi di baris depan yang kaki penyangganya patah.
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-diproses">
                        Diproses
                    </span>

                    <div class="reservasi-actions">

                        <button
                            class="btn-detail"
                            data-id="2"
                            data-fasilitas="Aula Fakultas, Gedung B"
                            data-kategori="Perabotan"
                            data-judul="Kursi rusak"
                            data-deskripsi="Terdapat 5 kursi di baris depan yang kaki penyangganya patah dan tidak bisa digunakan."
                            data-pelapor="Dewi Lestari"
                            data-tanggal="10 September 2026"
                            data-status="diproses"
                        >
                            Tinjau
                        </button>

                    </div>

                </div>

            </article>


            <!-- LAPORAN 3 — Selesai -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        💻
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            KELISTRIKAN — LAB KOMPUTER
                        </span>

                        <h3>
                            Stop kontak mati
                        </h3>

                        <p>
                            📍 Lab Komputer, Gedung C
                            &nbsp;·&nbsp; 👤 Eko Prasetyo
                            &nbsp;·&nbsp; 3 Sep 2026
                        </p>

                        <p class="reservasi-tujuan">
                            Dua stop kontak di meja nomor 12 dan 13 tidak mengalirkan listrik.
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-selesai">
                        Selesai
                    </span>

                    <div class="reservasi-actions">

                        <button
                            class="btn-detail"
                            data-id="3"
                            data-fasilitas="Lab Komputer, Gedung C"
                            data-kategori="Kelistrikan"
                            data-judul="Stop kontak mati"
                            data-deskripsi="Dua stop kontak di meja nomor 12 dan 13 tidak mengalirkan listrik sama sekali."
                            data-pelapor="Eko Prasetyo"
                            data-tanggal="3 September 2026"
                            data-status="selesai"
                        >
                            Detail
                        </button>

                    </div>

                </div>

            </article>

        </section>

    </main>


    <!-- =========================
         MODAL — TINJAU LAPORAN
    ========================== -->

    <div class="modal-overlay" id="modal-tinjau">

        <div class="modal modal-wide">

            <div class="modal-header">

                <h3 id="tinjau-title">
                    Tinjau Laporan
                </h3>

                <button class="modal-close" id="close-tinjau">
                    ✕
                </button>

            </div>

            <div class="modal-body">

                <div class="detail-grid">

                    <div class="detail-row">
                        <span>Pelapor</span>
                        <strong id="tinjau-pelapor">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Fasilitas</span>
                        <strong id="tinjau-fasilitas">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Kategori</span>
                        <strong id="tinjau-kategori">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Judul</span>
                        <strong id="tinjau-judul">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Deskripsi</span>
                        <strong id="tinjau-deskripsi">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Tanggal Laporan</span>
                        <strong id="tinjau-tanggal">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Status</span>
                        <strong id="tinjau-status">—</strong>
                    </div>

                </div>


                <!-- UPDATE STATUS -->

                <div class="form-group" id="update-status-group" style="margin-top:22px;">

                    <label for="status-baru">
                        Perbarui Status
                    </label>

                    <select id="status-baru">
                        <option value="menunggu">Menunggu</option>
                        <option value="diproses">Diproses</option>
                        <option value="selesai">Selesai</option>
                    </select>

                </div>

                <div class="form-group" style="margin-top:8px;">

                    <label for="catatan-petugas">
                        Catatan Petugas
                    </label>

                    <textarea
                        id="catatan-petugas"
                        rows="3"
                        placeholder="Tambahkan catatan tindak lanjut (opsional)..."
                    ></textarea>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn-secondary" id="close-tinjau-btn">
                    Tutup
                </button>

                <button class="btn-success" id="simpan-status">
                    Simpan Perubahan
                </button>

            </div>

        </div>

    </div>


    <!-- =========================
         FOOTER
    ========================== -->

    <footer>

        <div class="footer-content">

            <strong>
                Fasilitas Kampus
            </strong>

            <span>
                Sistem Informasi Fasilitas Kampus
            </span>

        </div>

        <p>
            © 2026 Fasilitas Kampus
        </p>

    </footer>


    <script>
        const modalTinjau = document.getElementById('modal-tinjau');
        const statusMap   = {
            menunggu : 'status-menunggu',
            diproses : 'status-diproses',
            selesai  : 'status-selesai',
        };

        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const status = btn.dataset.status;

                document.getElementById('tinjau-pelapor').textContent   = btn.dataset.pelapor;
                document.getElementById('tinjau-fasilitas').textContent = btn.dataset.fasilitas;
                document.getElementById('tinjau-kategori').textContent  = btn.dataset.kategori;
                document.getElementById('tinjau-judul').textContent     = btn.dataset.judul;
                document.getElementById('tinjau-deskripsi').textContent = btn.dataset.deskripsi;
                document.getElementById('tinjau-tanggal').textContent   = btn.dataset.tanggal;

                const statusEl = document.getElementById('tinjau-status');
                statusEl.innerHTML = `<span class="status-badge ${statusMap[status] || ''}">${btn.dataset.status}</span>`;

                document.getElementById('status-baru').value = status;
                document.getElementById('tinjau-title').textContent =
                    status === 'selesai' ? 'Detail Laporan' : 'Tinjau Laporan';

                modalTinjau.classList.add('active');
            });
        });

        function closeTinjau() { modalTinjau.classList.remove('active'); }

        document.getElementById('close-tinjau').addEventListener('click', closeTinjau);
        document.getElementById('close-tinjau-btn').addEventListener('click', closeTinjau);

        document.getElementById('simpan-status').addEventListener('click', closeTinjau);

        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', e => {
                if (e.target === overlay) overlay.classList.remove('active');
            });
        });
    </script>

</body>

</html>
