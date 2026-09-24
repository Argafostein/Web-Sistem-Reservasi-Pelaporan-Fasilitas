<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Antrian Reservasi — Fasilitas Kampus</title>

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

                <a href="/antrian-reservasi" class="nav-link active">
                    Reservasi
                </a>

                <a href="/antrian-laporan" class="nav-link">
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
                    Antrian
                    <span>reservasi masuk</span>
                </h1>

                <p>
                    Tinjau, setujui, atau tolak reservasi. Sistem otomatis
                    mencegah persetujuan yang jadwalnya bentrok.
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

                    <span>Menunggu</span>

                    <strong>4</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon green">
                    ✓
                </div>

                <div class="summary-content">

                    <span>Disetujui</span>

                    <strong>7</strong>

                </div>

            </div>


            <div class="summary-card">

                <div class="summary-icon red">
                    ×
                </div>

                <div class="summary-content">

                    <span>Ditolak / Dibatalkan</span>

                    <strong>2</strong>

                </div>

            </div>

        </section>


        <!-- =========================
             RESERVASI LIST
        ========================== -->

        <section class="riwayat-section">

            <div class="section-heading">

                <div>

                    <span class="section-label">
                        DAFTAR RESERVASI
                    </span>

                    <h2>
                        Semua reservasi
                    </h2>

                    <p>
                        Klik "Proses" untuk menyetujui, menolak, atau membatalkan reservasi.
                    </p>

                </div>

            </div>


            <!-- RESERVASI 1 — Menunggu -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏫
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            RUANG SEMINAR
                        </span>

                        <h3>
                            Ruang Seminar — Gedung A
                        </h3>

                        <p>
                            📅 Senin, 16 Sep 2026 &nbsp;|&nbsp; 08:00 – 10:00
                            &nbsp;·&nbsp; 👤 Ahmad Fauzi
                        </p>

                        <p class="reservasi-tujuan">
                            Seminar mahasiswa Teknik Informatika angkatan 2023.
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
                            data-fasilitas="Ruang Seminar, Gedung A Lt. 2"
                            data-tanggal="Senin, 16 September 2026"
                            data-waktu="08:00 – 10:00 WIB"
                            data-pemohon="Ahmad Fauzi"
                            data-tujuan="Seminar mahasiswa Teknik Informatika angkatan 2023."
                            data-status="menunggu"
                            data-bentrok="false"
                        >
                            Proses
                        </button>

                    </div>

                </div>

            </article>


            <!-- RESERVASI 2 — Menunggu / BENTROK -->

            <article class="reservasi-item item-conflict">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏫
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            RUANG SEMINAR &nbsp;⚠️ JADWAL BENTROK
                        </span>

                        <h3>
                            Ruang Seminar — Gedung A
                        </h3>

                        <p>
                            📅 Senin, 16 Sep 2026 &nbsp;|&nbsp; 08:00 – 10:00
                            &nbsp;·&nbsp; 👤 Rina Wulandari
                        </p>

                        <p class="reservasi-tujuan">
                            Pelatihan kepemimpinan untuk pengurus OSIS.
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
                            data-id="2"
                            data-fasilitas="Ruang Seminar, Gedung A Lt. 2"
                            data-tanggal="Senin, 16 September 2026"
                            data-waktu="08:00 – 10:00 WIB"
                            data-pemohon="Rina Wulandari"
                            data-tujuan="Pelatihan kepemimpinan untuk pengurus OSIS."
                            data-status="menunggu"
                            data-bentrok="true"
                        >
                            Proses
                        </button>

                    </div>

                </div>

            </article>


            <!-- RESERVASI 3 — Disetujui -->

            <article class="reservasi-item">

                <div class="reservasi-left">

                    <div class="facility-icon">
                        🏛️
                    </div>

                    <div class="reservasi-info">

                        <span class="facility-type">
                            AULA
                        </span>

                        <h3>
                            Aula Fakultas — Gedung B
                        </h3>

                        <p>
                            📅 Rabu, 18 Sep 2026 &nbsp;|&nbsp; 10:00 – 12:00
                            &nbsp;·&nbsp; 👤 Siti Rahayu
                        </p>

                        <p class="reservasi-tujuan">
                            Pelantikan pengurus BEM Fakultas periode 2026/2027.
                        </p>

                    </div>

                </div>

                <div class="reservasi-right">

                    <span class="status-badge status-disetujui">
                        Disetujui
                    </span>

                    <div class="reservasi-actions">

                        <button
                            class="btn-detail"
                            data-id="3"
                            data-fasilitas="Aula Fakultas, Gedung B Lt. 1"
                            data-tanggal="Rabu, 18 September 2026"
                            data-waktu="10:00 – 12:00 WIB"
                            data-pemohon="Siti Rahayu"
                            data-tujuan="Pelantikan pengurus BEM Fakultas periode 2026/2027."
                            data-status="disetujui"
                            data-bentrok="false"
                        >
                            Detail
                        </button>

                        <button
                            class="btn-cancel-officer"
                            data-id="3"
                            data-name="Aula Fakultas — Gedung B"
                            data-tanggal="Rabu, 18 September 2026"
                        >
                            Batalkan
                        </button>

                    </div>

                </div>

            </article>

        </section>

    </main>


    <!-- =========================
         MODAL — PROSES RESERVASI (US9)
    ========================== -->

    <div class="modal-overlay" id="modal-proses">

        <div class="modal modal-wide">

            <div class="modal-header">

                <h3 id="proses-title">
                    Proses Reservasi
                </h3>

                <button class="modal-close" id="close-proses">
                    ✕
                </button>

            </div>

            <div class="modal-body">

                <!-- PERINGATAN BENTROK -->

                <div class="conflict-alert" id="conflict-alert" style="display:none;">

                    <strong>
                        ⚠️ Perhatian: Jadwal Bentrok
                    </strong>

                    <p>
                        Fasilitas ini sudah memiliki reservasi yang
                        <strong>disetujui</strong> pada waktu yang sama.
                        Persetujuan reservasi ini tidak dapat dilakukan
                        karena akan menyebabkan konflik jadwal.
                    </p>

                </div>


                <div class="detail-grid">

                    <div class="detail-row">
                        <span>Pemohon</span>
                        <strong id="proses-pemohon">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Fasilitas</span>
                        <strong id="proses-fasilitas">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Tanggal</span>
                        <strong id="proses-tanggal">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Waktu</span>
                        <strong id="proses-waktu">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Tujuan</span>
                        <strong id="proses-tujuan">—</strong>
                    </div>

                </div>


                <!-- ALASAN PENOLAKAN -->

                <div class="form-group alasan-group" id="alasan-group" style="display:none; margin-top:20px;">

                    <label for="alasan-tolak">
                        Alasan Penolakan
                        <span style="color:#dc2626;">*</span>
                    </label>

                    <textarea
                        id="alasan-tolak"
                        rows="3"
                        placeholder="Tuliskan alasan penolakan reservasi ini..."
                    ></textarea>

                </div>

            </div>

            <div class="modal-footer" id="proses-footer">
                <!-- Buttons inserted by JS -->
            </div>

        </div>

    </div>


    <!-- =========================
         MODAL — BATALKAN RESERVASI DISETUJUI (US10)
    ========================== -->

    <div class="modal-overlay" id="modal-batal-officer">

        <div class="modal">

            <div class="modal-header">

                <h3>
                    Batalkan Reservasi
                </h3>

                <button class="modal-close" id="close-batal-officer">
                    ✕
                </button>

            </div>

            <div class="modal-body">

                <div class="cancel-warning" style="margin-bottom:18px;">
                    ⚠️ Pembatalan darurat — tindakan ini tidak dapat dibatalkan.
                </div>

                <div class="detail-grid">

                    <div class="detail-row">
                        <span>Fasilitas</span>
                        <strong id="batal-name">—</strong>
                    </div>

                    <div class="detail-row">
                        <span>Tanggal</span>
                        <strong id="batal-tanggal">—</strong>
                    </div>

                </div>

                <div class="form-group" style="margin-top:20px;">

                    <label for="alasan-batal">
                        Alasan Pembatalan
                        <span style="color:#dc2626;">*</span>
                    </label>

                    <textarea
                        id="alasan-batal"
                        rows="3"
                        placeholder="Contoh: Fasilitas mendadak tidak dapat digunakan karena renovasi darurat."
                        required
                    ></textarea>

                    <small>
                        Alasan akan disampaikan kepada pemohon sebagai notifikasi.
                    </small>

                </div>

            </div>

            <div class="modal-footer">

                <button class="btn-secondary" id="close-batal-officer-btn">
                    Kembali
                </button>

                <button class="btn-danger">
                    Konfirmasi Pembatalan
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
        // ── Proses modal (approve / reject) ──────────────────────────────

        const modalProses       = document.getElementById('modal-proses');
        const prosesFooter      = document.getElementById('proses-footer');
        const conflictAlert     = document.getElementById('conflict-alert');
        const alasanGroup       = document.getElementById('alasan-group');
        let   showingAlasan     = false;

        document.querySelectorAll('.btn-detail').forEach(btn => {
            btn.addEventListener('click', () => {
                const bentrok = btn.dataset.bentrok === 'true';
                const status  = btn.dataset.status;

                document.getElementById('proses-pemohon').textContent  = btn.dataset.pemohon;
                document.getElementById('proses-fasilitas').textContent = btn.dataset.fasilitas;
                document.getElementById('proses-tanggal').textContent  = btn.dataset.tanggal;
                document.getElementById('proses-waktu').textContent    = btn.dataset.waktu;
                document.getElementById('proses-tujuan').textContent   = btn.dataset.tujuan;
                document.getElementById('proses-title').textContent =
                    status === 'disetujui' ? 'Detail Reservasi' : 'Proses Reservasi';

                conflictAlert.style.display = bentrok ? 'block' : 'none';
                alasanGroup.style.display   = 'none';
                showingAlasan               = false;

                // Build action buttons
                prosesFooter.innerHTML = '';

                const closeBtn = document.createElement('button');
                closeBtn.className = 'btn-secondary';
                closeBtn.textContent = 'Tutup';
                closeBtn.addEventListener('click', closeProses);
                prosesFooter.appendChild(closeBtn);

                if (status === 'menunggu') {
                    // Reject button
                    const tolakBtn = document.createElement('button');
                    tolakBtn.className   = 'btn-warning';
                    tolakBtn.textContent = 'Tolak';
                    tolakBtn.addEventListener('click', () => {
                        if (!showingAlasan) {
                            alasanGroup.style.display = 'block';
                            showingAlasan = true;
                            tolakBtn.textContent = 'Konfirmasi Tolak';
                        }
                    });
                    prosesFooter.appendChild(tolakBtn);

                    // Approve button — disabled if conflict
                    const setujuBtn = document.createElement('button');
                    setujuBtn.className   = bentrok ? 'btn-success btn-disabled' : 'btn-success';
                    setujuBtn.textContent = 'Setujui';
                    setujuBtn.disabled    = bentrok;
                    if (bentrok) {
                        setujuBtn.title = 'Tidak dapat disetujui: jadwal bentrok dengan reservasi lain.';
                    }
                    prosesFooter.appendChild(setujuBtn);
                }

                modalProses.classList.add('active');
            });
        });

        function closeProses() {
            modalProses.classList.remove('active');
        }

        document.getElementById('close-proses').addEventListener('click', closeProses);

        // ── Batalkan (officer cancel) modal ─────────────────────────────

        const modalBatalOfficer = document.getElementById('modal-batal-officer');

        document.querySelectorAll('.btn-cancel-officer').forEach(btn => {
            btn.addEventListener('click', () => {
                document.getElementById('batal-name').textContent    = btn.dataset.name;
                document.getElementById('batal-tanggal').textContent = btn.dataset.tanggal;
                modalBatalOfficer.classList.add('active');
            });
        });

        document.getElementById('close-batal-officer').addEventListener('click', () => {
            modalBatalOfficer.classList.remove('active');
        });
        document.getElementById('close-batal-officer-btn').addEventListener('click', () => {
            modalBatalOfficer.classList.remove('active');
        });

        // ── Close on overlay click ────────────────────────────────────────

        document.querySelectorAll('.modal-overlay').forEach(overlay => {
            overlay.addEventListener('click', e => {
                if (e.target === overlay) overlay.classList.remove('active');
            });
        });
    </script>

</body>

</html>
