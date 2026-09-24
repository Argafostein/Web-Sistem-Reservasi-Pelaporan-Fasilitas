<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Riwayat Reservasi | Fasilitas Kampus</title>

    <style>
        /* =====================================================
           RESET
        ====================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f8fafc;
            color: #0f172a;
        }

        a {
            text-decoration: none;
        }


        /* =====================================================
           NAVBAR
        ====================================================== */

        .campus-navbar {
            width: 100%;
            height: 76px;
            background: rgba(255, 255, 255, 0.97);
            border-bottom: 1px solid #e2e8f0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 4px 20px rgba(15, 23, 42, 0.05);
        }

        .campus-nav-container {
            width: min(1180px, calc(100% - 40px));
            height: 100%;
            margin: 0 auto;

            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 30px;
        }


        /* BRAND */

        .campus-brand {
            display: flex;
            align-items: center;
            gap: 13px;
            flex-shrink: 0;
            color: #0f172a;
        }

        .campus-brand-logo {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: linear-gradient(
                135deg,
                #2563eb,
                #4f46e5
            );

            color: white;
            border-radius: 15px;

            font-size: 18px;
            font-weight: 800;

            box-shadow:
                0 8px 18px rgba(37, 99, 235, 0.25);
        }

        .campus-brand-text {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }

        .campus-brand-text strong {
            font-size: 16px;
            line-height: 1.2;
            color: #0f172a;
        }

        .campus-brand-text span {
            font-size: 12px;
            color: #64748b;
        }


        /* NAVIGATION */

        .campus-nav-links {
            display: flex;
            align-items: center;
            justify-content: flex-end;
            gap: 4px;
        }

        .campus-nav-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;

            padding: 10px 13px;

            color: #475569;
            font-size: 13px;
            font-weight: 600;

            border-radius: 9px;

            transition:
                background 0.2s ease,
                color 0.2s ease;
        }

        .campus-nav-links a:hover {
            background: #eff6ff;
            color: #2563eb;
        }

        .campus-nav-links a.active {
            background: #eff6ff;
            color: #2563eb;
        }


        /* LOGOUT */

        .campus-nav-links a.logout {
            margin-left: 8px;

            background: #fff1f2;
            color: #dc2626;

            padding-left: 17px;
            padding-right: 17px;
        }

        .campus-nav-links a.logout:hover {
            background: #fee2e2;
            color: #b91c1c;
        }


        /* =====================================================
           MAIN
        ====================================================== */

        .history-page {
            min-height: calc(100vh - 76px);
            padding-bottom: 70px;
        }

        .history-container {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }


        /* =====================================================
           HEADER
        ====================================================== */

        .history-header {
            padding: 55px 0 35px;
        }

        .history-label {
            display: inline-block;

            margin-bottom: 10px;

            color: #2563eb;

            font-size: 12px;
            font-weight: 800;
            letter-spacing: 1.5px;
        }

        .history-header h1 {
            font-size: 38px;
            line-height: 1.2;
            color: #0f172a;
        }

        .history-header p {
            margin-top: 12px;

            color: #64748b;
            font-size: 16px;
            line-height: 1.6;
        }


        /* =====================================================
           SUMMARY
        ====================================================== */

        .history-summary {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 18px;

            margin-bottom: 35px;
        }

        .summary-box {
            display: flex;
            align-items: center;
            gap: 16px;

            padding: 22px;

            background: white;
            border: 1px solid #e2e8f0;
            border-radius: 18px;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, 0.04);
        }

        .summary-icon {
            width: 52px;
            height: 52px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            border-radius: 14px;

            background: #eff6ff;

            font-size: 24px;
        }

        .summary-box strong {
            display: block;

            color: #0f172a;
            font-size: 25px;
        }

        .summary-box span {
            display: block;

            margin-top: 3px;

            color: #64748b;
            font-size: 13px;
        }


        /* =====================================================
           SECTION TITLE
        ====================================================== */

        .history-section-title {
            margin-bottom: 18px;
        }

        .history-section-title h2 {
            color: #0f172a;
            font-size: 22px;
        }


        /* =====================================================
           RESERVATION CARD
        ====================================================== */

        .reservation-history-card {
            margin-bottom: 16px;

            overflow: hidden;

            background: white;

            border: 1px solid #e2e8f0;
            border-radius: 20px;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, 0.04);
        }

        .reservation-card-top {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;

            padding: 22px 24px;

            border-bottom: 1px solid #f1f5f9;
        }

        .reservation-title {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .reservation-facility-icon {
            width: 48px;
            height: 48px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eff6ff;
            border-radius: 13px;

            font-size: 22px;
        }

        .reservation-title h3 {
            color: #0f172a;
            font-size: 18px;
        }

        .reservation-title p {
            margin-top: 5px;

            color: #64748b;
            font-size: 13px;
        }


        /* =====================================================
           STATUS
        ====================================================== */

        .reservation-status {
            padding: 7px 13px;

            border-radius: 999px;

            font-size: 12px;
            font-weight: 800;

            white-space: nowrap;
        }

        .status-pending {
            background: #fef3c7;
            color: #92400e;
        }

        .status-approved {
            background: #dcfce7;
            color: #166534;
        }

        .status-completed {
            background: #dbeafe;
            color: #1d4ed8;
        }


        /* =====================================================
           DETAILS
        ====================================================== */

        .reservation-details {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;

            padding: 22px 24px;
        }

        .detail-item span {
            display: block;

            margin-bottom: 6px;

            color: #94a3b8;
            font-size: 12px;
        }

        .detail-item strong {
            display: block;

            color: #334155;
            font-size: 14px;
        }


        /* =====================================================
           CARD FOOTER
        ====================================================== */

        .reservation-card-bottom {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 15px;

            padding: 15px 24px;

            background: #f8fafc;
        }

        .reservation-code {
            color: #64748b;
            font-size: 12px;
        }

        .cancel-button {
            padding: 9px 15px;

            border: 1px solid #fecaca;
            border-radius: 9px;

            background: white;
            color: #dc2626;

            font-size: 12px;
            font-weight: 700;

            cursor: pointer;
        }

        .cancel-button:hover {
            background: #fef2f2;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 950px) {

            .campus-nav-container {
                gap: 10px;
            }

            .campus-nav-links {
                gap: 0;
            }

            .campus-nav-links a {
                padding: 9px 8px;
                font-size: 12px;
            }

            .history-summary {
                grid-template-columns: 1fr;
            }

            .reservation-details {
                grid-template-columns: repeat(2, 1fr);
            }
        }


        @media (max-width: 700px) {

            .campus-navbar {
                height: auto;
            }

            .campus-nav-container {
                width: calc(100% - 24px);

                padding: 12px 0;

                flex-direction: column;
                align-items: stretch;
            }

            .campus-brand {
                justify-content: center;
            }

            .campus-nav-links {
                width: 100%;

                display: grid;
                grid-template-columns: repeat(2, 1fr);

                gap: 5px;
            }

            .campus-nav-links a.logout {
                margin-left: 0;
            }

            .history-header {
                padding-top: 35px;
            }

            .history-header h1 {
                font-size: 30px;
            }

            .reservation-card-top {
                flex-direction: column;
            }

            .reservation-details {
                grid-template-columns: 1fr;
            }

            .reservation-card-bottom {
                flex-direction: column;
                align-items: flex-start;
            }
        }


        @media (max-width: 480px) {

            .campus-nav-links {
                grid-template-columns: 1fr 1fr;
            }

            .campus-nav-links a {
                font-size: 11px;
                padding: 9px 5px;
            }

            .history-container {
                width: calc(100% - 24px);
            }
        }

    </style>
</head>


<body>

    <!-- =====================================================
         NAVBAR
    ====================================================== -->

    <nav class="campus-navbar">

        <div class="campus-nav-container">

            <!-- BRAND -->

            <a href="/fasilitas" class="campus-brand">

                <div class="campus-brand-logo">
                    FK
                </div>

                <div class="campus-brand-text">

                    <strong>
                        Fasilitas Kampus
                    </strong>

                    <span>
                        Sistem Informasi Fasilitas
                    </span>

                </div>

            </a>


            <!-- NAVIGATION -->

            <div class="campus-nav-links">

                <a href="/fasilitas">
                    Fasilitas
                </a>

                <a
                    href="/riwayat-reservasi"
                    class="active"
                >
                    Reservasi Saya
                </a>

                <a href="/laporan">
                    Buat Laporan
                </a>

                <a href="/riwayat-laporan">
                    Status Laporan
                </a>

                <a
                    href="/login"
                    class="logout"
                >
                    Keluar
                </a>

            </div>

        </div>

    </nav>


    <!-- =====================================================
         MAIN
    ====================================================== -->

    <main class="history-page">

        <div class="history-container">


            <!-- HEADER -->

            <section class="history-header">

                <span class="history-label">
                    RESERVASI SAYA
                </span>

                <h1>
                    Riwayat Reservasi
                </h1>

                <p>
                    Lihat seluruh pengajuan reservasi fasilitas
                    yang pernah dibuat.
                </p>

            </section>


            <!-- SUMMARY -->

            <section class="history-summary">

                <div class="summary-box">

                    <div class="summary-icon">
                        📋
                    </div>

                    <div>
                        <strong>3</strong>
                        <span>Total Reservasi</span>
                    </div>

                </div>


                <div class="summary-box">

                    <div class="summary-icon">
                        ⏳
                    </div>

                    <div>
                        <strong>1</strong>
                        <span>Menunggu Persetujuan</span>
                    </div>

                </div>


                <div class="summary-box">

                    <div class="summary-icon">
                        ✓
                    </div>

                    <div>
                        <strong>1</strong>
                        <span>Disetujui</span>
                    </div>

                </div>

            </section>


            <!-- LIST -->

            <section>

                <div class="history-section-title">

                    <h2>
                        Daftar Reservasi
                    </h2>

                </div>


                <!-- RESERVATION 1 -->

                <article class="reservation-history-card">

                    <div class="reservation-card-top">

                        <div class="reservation-title">

                            <div class="reservation-facility-icon">
                                🏫
                            </div>

                            <div>

                                <h3>
                                    Ruang Seminar
                                </h3>

                                <p>
                                    Gedung A · Lantai 2
                                </p>

                            </div>

                        </div>


                        <span class="reservation-status status-approved">
                            Disetujui
                        </span>

                    </div>


                    <div class="reservation-details">

                        <div class="detail-item">

                            <span>
                                Tanggal
                            </span>

                            <strong>
                                25 September 2026
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Waktu
                            </span>

                            <strong>
                                08:00 - 10:00
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Tujuan
                            </span>

                            <strong>
                                Seminar Mahasiswa
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Diajukan
                            </span>

                            <strong>
                                20 September 2026
                            </strong>

                        </div>

                    </div>


                    <div class="reservation-card-bottom">

                        <span class="reservation-code">
                            ID Reservasi: RSV-001
                        </span>

                    </div>

                </article>


                <!-- RESERVATION 2 -->

                <article class="reservation-history-card">

                    <div class="reservation-card-top">

                        <div class="reservation-title">

                            <div class="reservation-facility-icon">
                                💻
                            </div>

                            <div>

                                <h3>
                                    Laboratorium Komputer
                                </h3>

                                <p>
                                    Gedung C · Lantai 3
                                </p>

                            </div>

                        </div>


                        <span class="reservation-status status-pending">
                            Menunggu
                        </span>

                    </div>


                    <div class="reservation-details">

                        <div class="detail-item">

                            <span>
                                Tanggal
                            </span>

                            <strong>
                                28 September 2026
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Waktu
                            </span>

                            <strong>
                                13:00 - 15:00
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Tujuan
                            </span>

                            <strong>
                                Praktikum
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Diajukan
                            </span>

                            <strong>
                                23 September 2026
                            </strong>

                        </div>

                    </div>


                    <div class="reservation-card-bottom">

                        <span class="reservation-code">
                            ID Reservasi: RSV-002
                        </span>

                        <button
                            type="button"
                            class="cancel-button"
                            onclick="alert('Fitur pembatalan akan diproses oleh sistem.')"
                        >
                            Batalkan Reservasi
                        </button>

                    </div>

                </article>


                <!-- RESERVATION 3 -->

                <article class="reservation-history-card">

                    <div class="reservation-card-top">

                        <div class="reservation-title">

                            <div class="reservation-facility-icon">
                                🏛️
                            </div>

                            <div>

                                <h3>
                                    Aula Fakultas
                                </h3>

                                <p>
                                    Gedung B · Lantai 1
                                </p>

                            </div>

                        </div>


                        <span class="reservation-status status-completed">
                            Selesai
                        </span>

                    </div>


                    <div class="reservation-details">

                        <div class="detail-item">

                            <span>
                                Tanggal
                            </span>

                            <strong>
                                15 September 2026
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Waktu
                            </span>

                            <strong>
                                10:00 - 12:00
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Tujuan
                            </span>

                            <strong>
                                Kegiatan Organisasi
                            </strong>

                        </div>


                        <div class="detail-item">

                            <span>
                                Diajukan
                            </span>

                            <strong>
                                10 September 2026
                            </strong>

                        </div>

                    </div>


                    <div class="reservation-card-bottom">

                        <span class="reservation-code">
                            ID Reservasi: RSV-003
                        </span>

                    </div>

                </article>

            </section>

        </div>

    </main>

</body>

</html>