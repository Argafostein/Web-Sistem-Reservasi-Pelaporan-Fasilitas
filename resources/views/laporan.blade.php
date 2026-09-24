<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Buat Laporan — Fasilitas Kampus</title>

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
                <span>Sistem Informasi Kampus</span>
            </div>

        </a>

        <nav class="navigation">

            <a href="/fasilitas" class="nav-link">
                Fasilitas
            </a>

            <a href="/riwayat-reservasi" class="nav-link">
                Reservasi Saya
            </a>

            <a href="/laporan" class="nav-link active">
                Buat Laporan
            </a>

            <a href="/riwayat-laporan" class="nav-link">
                Status Laporan
            </a>

            <a href="/login" class="logout-link">
                Keluar
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
                    LAPORAN KERUSAKAN
                </span>

                <h1>
                    Laporkan masalah
                    <span>pada fasilitas.</span>
                </h1>

                <p>
                    Bantu kami menjaga fasilitas tetap prima dengan
                    melaporkan kerusakan atau masalah yang Anda temukan.
                </p>

            </div>

            <div class="hero-decoration decoration-one"></div>
            <div class="hero-decoration decoration-two"></div>

        </section>


        <!-- =========================
             FORM LAPORAN
        ========================== -->

        <section class="reservation-section" id="form-laporan">

            <div class="section-heading">

                <div>

                    <span class="section-label">
                        FORM LAPORAN
                    </span>

                    <h2>
                        Buat laporan baru
                    </h2>

                    <p>
                        Isi semua informasi berikut agar laporan dapat
                        diproses dengan cepat.
                    </p>

                </div>

            </div>


            <div class="reservation-card">


                <!-- INFORMASI FORM -->

                <div class="reservation-info">

                    <div class="reservation-icon">
                        🔧
                    </div>

                    <h3>
                        Form Laporan Kerusakan / Masalah
                    </h3>

                    <p>
                        Pilih fasilitas, kategori masalah, dan deskripsikan
                        kerusakan yang ditemukan. Anda juga dapat melampirkan
                        foto sebagai bukti pendukung.
                    </p>


                    <div class="reservation-note">

                        <strong>
                            Catatan
                        </strong>

                        <span>
                            Laporan akan ditinjau oleh petugas dan Anda
                            akan mendapat notifikasi perkembangan statusnya.
                        </span>

                    </div>

                </div>



                <!-- FORM -->

                <form enctype="multipart/form-data">


                    <!-- FASILITAS -->

                    <div class="form-group">

                        <label for="fasilitas">
                            Fasilitas
                            <span>*</span>
                        </label>

                        <select
                            id="fasilitas"
                            name="fasilitas"
                            required
                        >

                            <option value="">
                                Pilih fasilitas
                            </option>

                            <option value="ruang-seminar">
                                Ruang Seminar — Gedung A
                            </option>

                            <option value="aula">
                                Aula Fakultas — Gedung B
                            </option>

                            <option value="laboratorium">
                                Laboratorium Komputer — Gedung C
                            </option>

                        </select>

                    </div>


                    <!-- KATEGORI -->

                    <div class="form-group">

                        <label for="kategori">
                            Kategori Masalah
                            <span>*</span>
                        </label>

                        <select
                            id="kategori"
                            name="kategori"
                            required
                        >

                            <option value="">
                                Pilih kategori
                            </option>

                            <option value="kelistrikan">
                                Kelistrikan (lampu, stop kontak, dll.)
                            </option>

                            <option value="perabotan">
                                Perabotan (kursi, meja, papan tulis, dll.)
                            </option>

                            <option value="elektronik">
                                Elektronik (proyektor, AC, komputer, dll.)
                            </option>

                            <option value="kebersihan">
                                Kebersihan
                            </option>

                            <option value="struktural">
                                Struktural (atap, dinding, lantai, dll.)
                            </option>

                            <option value="lainnya">
                                Lainnya
                            </option>

                        </select>

                        <small>
                            Pilih kategori yang paling sesuai dengan masalah yang dilaporkan.
                        </small>

                    </div>


                    <!-- DESKRIPSI -->

                    <div class="form-group">

                        <label for="deskripsi">
                            Deskripsi Masalah
                            <span>*</span>
                        </label>

                        <textarea
                            id="deskripsi"
                            name="deskripsi"
                            rows="5"
                            placeholder="Contoh: AC di sudut kiri tidak menyala sejak kemarin. Sudah dicoba menyalakan dari remote tetapi tidak merespons."
                            required
                        ></textarea>

                        <small>
                            Jelaskan masalah secara detail termasuk lokasi spesifik
                            dan kapan pertama kali ditemukan.
                        </small>

                    </div>


                    <!-- FOTO -->

                    <div class="form-group">

                        <label for="foto">
                            Foto Pendukung
                        </label>

                        <div class="upload-area" id="upload-area">

                            <div class="upload-placeholder" id="upload-placeholder">

                                <span class="upload-icon">
                                    📷
                                </span>

                                <strong>
                                    Klik atau seret foto ke sini
                                </strong>

                                <span>
                                    JPG, PNG, maksimal 5 MB
                                </span>

                            </div>

                            <img
                                class="upload-preview"
                                id="upload-preview"
                                alt="Preview foto"
                            >

                            <input
                                type="file"
                                id="foto"
                                name="foto"
                                accept="image/*"
                                class="upload-input"
                            >

                        </div>

                        <small>
                            Opsional. Foto dapat membantu petugas mengidentifikasi masalah lebih cepat.
                        </small>

                    </div>


                    <!-- BUTTON -->

                    <div class="form-submit">

                        <button
                            type="submit"
                            class="submit-button"
                        >
                            Kirim Laporan
                        </button>

                    </div>


                </form>

            </div>

        </section>

    </main>


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
        const uploadArea    = document.getElementById('upload-area');
        const uploadInput   = document.getElementById('foto');
        const uploadPreview = document.getElementById('upload-preview');
        const uploadPH      = document.getElementById('upload-placeholder');

        uploadArea.addEventListener('click', () => uploadInput.click());

        uploadArea.addEventListener('dragover', e => {
            e.preventDefault();
            uploadArea.classList.add('dragover');
        });

        uploadArea.addEventListener('dragleave', () => {
            uploadArea.classList.remove('dragover');
        });

        uploadArea.addEventListener('drop', e => {
            e.preventDefault();
            uploadArea.classList.remove('dragover');
            const file = e.dataTransfer.files[0];
            if (file) showPreview(file);
        });

        uploadInput.addEventListener('change', () => {
            if (uploadInput.files[0]) showPreview(uploadInput.files[0]);
        });

        function showPreview(file) {
            const reader = new FileReader();
            reader.onload = e => {
                uploadPreview.src = e.target.result;
                uploadPreview.style.display = 'block';
                uploadPH.style.display = 'none';
            };
            reader.readAsDataURL(file);
        }
    </script>

</body>

</html>
