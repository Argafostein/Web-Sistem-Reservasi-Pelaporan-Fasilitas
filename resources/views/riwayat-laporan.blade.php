<!DOCTYPE html>
<html lang="id">

<head>

    <meta charset="UTF-8">

    <meta
        name="viewport"
        content="width=device-width, initial-scale=1.0"
    >

    <title>Status Laporan | Fasilitas Kampus</title>


    <style>

        /* =====================================================
           RESET
        ====================================================== */

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
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

            box-shadow:
                0 4px 20px rgba(15, 23, 42, 0.05);
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
            color: #0f172a;
        }

        .campus-brand-text span {
            font-size: 12px;
            color: #64748b;
        }


        /* NAV LINKS */

        .campus-nav-links {
            display: flex;
            align-items: center;

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
           PAGE
        ====================================================== */

        .report-page {
            min-height: calc(100vh - 76px);
            padding-bottom: 70px;
        }

        .report-container {
            width: min(1180px, calc(100% - 40px));
            margin: 0 auto;
        }


        /* HEADER */

        .report-header {
            padding: 55px 0 35px;
        }

        .report-label {
            display: inline-block;

            margin-bottom: 10px;

            color: #2563eb;

            font-size: 12px;
            font-weight: 800;

            letter-spacing: 1.5px;
        }

        .report-header h1 {
            font-size: 38px;
            line-height: 1.2;

            color: #0f172a;
        }

        .report-header p {
            margin-top: 12px;

            color: #64748b;

            font-size: 16px;
            line-height: 1.6;
        }


        /* =====================================================
           SUMMARY
        ====================================================== */

        .report-summary {
            display: grid;

            grid-template-columns: repeat(3, 1fr);

            gap: 18px;

            margin-bottom: 35px;
        }

        .report-summary-card {
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

        .report-summary-icon {
            width: 52px;
            height: 52px;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eff6ff;

            border-radius: 14px;

            font-size: 24px;
        }

        .report-summary-card strong {
            display: block;

            font-size: 25px;

            color: #0f172a;
        }

        .report-summary-card span {
            display: block;

            margin-top: 3px;

            color: #64748b;

            font-size: 13px;
        }


        /* =====================================================
           HISTORY
        ====================================================== */

        .report-history-heading {
            margin-bottom: 18px;
        }

        .report-history-heading h2 {
            font-size: 22px;
            color: #0f172a;
        }

        .report-history-heading p {
            margin-top: 7px;

            color: #64748b;

            font-size: 14px;
        }


        /* =====================================================
           REPORT CARD
        ====================================================== */

        .report-card {
            margin-bottom: 16px;

            overflow: hidden;

            background: white;

            border: 1px solid #e2e8f0;

            border-radius: 20px;

            box-shadow:
                0 8px 25px rgba(15, 23, 42, 0.04);
        }

        .report-card-main {
            display: flex;

            gap: 16px;

            padding: 23px 24px;
        }

        .report-icon {
            width: 50px;
            height: 50px;

            flex-shrink: 0;

            display: flex;
            align-items: center;
            justify-content: center;

            background: #eff6ff;

            border-radius: 14px;

            font-size: 23px;
        }

        .report-content {
            flex: 1;
        }

        .report-card-top {
            display: flex;

            align-items: flex-start;
            justify-content: space-between;

            gap: 15px;
        }

        .report-content h3 {
            font-size: 18px;
            color: #0f172a;
        }

        .report-facility {
            margin-top: 5px;

            color: #64748b;

            font-size: 13px;
        }


        /* STATUS */

        .report-status {
            padding: 7px 13px;

            border-radius: 999px;

            font-size: 12px;
            font-weight: 800;

            white-space: nowrap;
        }

        .status-waiting {
            background: #fef3c7;
            color: #92400e;
        }

        .status-process {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-done {
            background: #dcfce7;
            color: #166534;
        }


        /* DESCRIPTION */

        .report-description {
            margin-top: 17px;

            padding: 14px 16px;

            background: #f8fafc;

            border-radius: 12px;

            color: #475569;

            font-size: 14px;

            line-height: 1.6;
        }


        /* FOOTER */

        .report-card-footer {
            display: flex;

            justify-content: space-between;

            gap: 15px;

            padding: 15px 24px;

            background: #f8fafc;

            border-top: 1px solid #f1f5f9;
        }

        .report-meta {
            color: #64748b;

            font-size: 12px;
        }

        .report-meta strong {
            color: #334155;
        }


        /* =====================================================
           RESPONSIVE
        ====================================================== */

        @media (max-width: 950px) {

            .campus-nav-links {
                gap: 0;
            }

            .campus-nav-links a {
                padding: 9px 8px;
                font-size: 12px;
            }

            .report-summary {
                grid-template-columns: 1fr;
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

            .report-header {
                padding-top: 35px;
            }

            .report-header h1 {
                font-size: 30px;
            }

            .report-card-top {
                flex-direction: column;
            }

            .report-card-footer {
                flex-direction: column;
            }
        }


        @media (max-width: 480px) {

            .campus-nav-links a {
                padding: 9px 5px;

                font-size: 11px;
            }

            .report-container {
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

            <a
                href="/fasilitas"
                class="campus-brand"
            >

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


            <!-- LINKS -->

            <div class="campus-nav-links">

                <a href="/fasilitas">
                    Fasilitas
                </a>

                <a href="/riwayat-reservasi">
                    Reservasi Saya
                </a>

                <a href="/laporan">
                    Buat Laporan
                </a>

                <a
                    href="/riwayat-laporan"
                    class="active"
                >
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

    <main class="report-page">

        <div class="report-container">


            <!-- HEADER -->

            <section class="report-header">

                <span class="report-label">
                    LAPORAN FASILITAS
                </span>

                <h1>
                    Status Laporan
                </h1>

                <p>
                    Pantau perkembangan laporan kerusakan
                    atau masalah fasilitas kampus.
                </p>

            </section>


            <!-- SUMMARY -->

            <section class="report-summary">

                <div class="report-summary-card">

                    <div class="report-summary-icon">
                        📋
                    </div>

                    <div>

                        <strong>
                            3
                        </strong>

                        <span>
                            Total Laporan
                        </span>

                    </div>

                </div>


                <div class="report-summary-card">

                    <div class="report-summary-icon">
                        ⏳
                    </div>

                    <div>

                        <strong>
                            1
                        </strong>

                        <span>
                            Menunggu
                        </span>

                    </div>

                </div>


                <div class="report-summary-card">

                    <div class="report-summary-icon">
                        ✓
                    </div>

                    <div>

                        <strong>
                            1
                        </strong>

                        <span>
                            Selesai
                        </span>

                    </div>

                </div>

            </section>


            <!-- HISTORY -->

            <section>

                <div class="report-history-heading">

                    <h2>
                        Riwayat Laporan
                    </h2>

                    <p>
                        Berikut laporan yang pernah dikirimkan.
                    </p>

                </div>


                <!-- REPORT 1 -->

                <article class="report-card">

                    <div class="report-card-main">

                        <div class="report-icon">
                            🔧
                        </div>

                        <div class="report-content">

                            <div class="report-card-top">

                                <div>

                                    <h3>
                                        Kerusakan AC
                                    </h3>

                                    <div class="report-facility">
                                        Ruang Seminar · Gedung A
                                    </div>

                                </div>

                                <span class="report-status status-process">
                                    Sedang Diproses
                                </span>

                            </div>


                            <div class="report-description">

                                AC di dalam ruangan tidak
                                mengeluarkan udara dingin.
                                Kondisi ini terjadi sejak
                                kegiatan sebelumnya.

                            </div>

                        </div>

                    </div>


                    <div class="report-card-footer">

                        <span class="report-meta">
                            ID Laporan:
                            <strong>RPT-001</strong>
                        </span>

                        <span class="report-meta">
                            Dilaporkan:
                            <strong>20 September 2026</strong>
                        </span>

                    </div>

                </article>


                <!-- REPORT 2 -->

                <article class="report-card">

                    <div class="report-card-main">

                        <div class="report-icon">
                            💡
                        </div>

                        <div class="report-content">

                            <div class="report-card-top">

                                <div>

                                    <h3>
                                        Lampu Ruangan Mati
                                    </h3>

                                    <div class="report-facility">
                                        Laboratorium Komputer · Gedung C
                                    </div>

                                </div>

                                <span class="report-status status-waiting">
                                    Menunggu
                                </span>

                            </div>


                            <div class="report-description">

                                Beberapa lampu pada bagian
                                belakang laboratorium
                                tidak dapat menyala.

                            </div>

                        </div>

                    </div>


                    <div class="report-card-footer">

                        <span class="report-meta">
                            ID Laporan:
                            <strong>RPT-002</strong>
                        </span>

                        <span class="report-meta">
                            Dilaporkan:
                            <strong>23 September 2026</strong>
                        </span>

                    </div>

                </article>


                <!-- REPORT 3 -->

                <article class="report-card">

                    <div class="report-card-main">

                        <div class="report-icon">
                            🚪
                        </div>

                        <div class="report-content">

                            <div class="report-card-top">

                                <div>

                                    <h3>
                                        Pintu Rusak
                                    </h3>

                                    <div class="report-facility">
                                        Aula Fakultas · Gedung B
                                    </div>

                                </div>

                                <span class="report-status status-done">
                                    Selesai
                                </span>

                            </div>


                            <div class="report-description">

                                Pegangan pintu utama aula
                                sebelumnya longgar dan sudah
                                diperbaiki oleh petugas.

                            </div>

                        </div>

                    </div>


                    <div class="report-card-footer">

                        <span class="report-meta">
                            ID Laporan:
                            <strong>RPT-003</strong>
                        </span>

                        <span class="report-meta">
                            Dilaporkan:
                            <strong>12 September 2026</strong>
                        </span>

                    </div>

                </article>

            </section>

        </div>

    </main>


</body>

</html>