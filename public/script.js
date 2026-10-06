/**
 * Aplikasi SIM-Fasilitas (Kelompok 11 - Anggota 1)
 * Modul Informasi Fasilitas & Riwayat Pengguna
 * FR-01: Menampilkan daftar fasilitas & status ketersediaan per slot waktu
 * FR-02: Fitur pencarian & penyaringan (tipe, lokasi, kapasitas)
 * FR-05: Halaman riwayat & status reservasi milik pribadi secara detail
 * Dilengkapi integrasi penuh dengan form praktikum yang sudah ada sebelumnya.
 */

// ============================================================
// DATA STATE (FASILITAS & SLOT WAKTU - FR-01 & FR-02)
// ============================================================

const INITIAL_FACILITIES = [
  {
    id: "fac-lab-pemweb",
    name: "Laboratorium Komputer Pemrograman Web & AI",
    type: "Laboratorium Komputer",
    location: "Gedung FTI",
    room: "Lantai 3, Lab 301",
    capacity: 40,
    bannerClass: "bg-fti",
    pic: "Bpk. Rahmat Santoso, M.Kom",
    equipment: ["40 Unit PC Core i7", "High-speed LAN & WiFi 6", "Smart Projector 4K", "AC Central"],
    description: "Ruang lab komputer mutakhir berstandar industri dengan spesifikasi tinggi untuk kegiatan praktikum pemrograman, simulasi komputasi cerdas, dan tes kompetensi.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "booked", bookedBy: "Praktikum Pemrograman Web (Kelas C1)" },
      { id: "s2", time: "10:00 - 12:00", status: "available", bookedBy: null },
      { id: "s3", time: "13:00 - 15:00", status: "booked", bookedBy: "Praktikum Kecerdasan Buatan (Kelas A)" },
      { id: "s4", time: "15:30 - 17:30", status: "available", bookedBy: null }
    ]
  },
  {
    id: "fac-lab-jarkom",
    name: "Laboratorium Jaringan Komputer & Cyber Security",
    type: "Laboratorium Komputer",
    location: "Gedung FTI",
    room: "Lantai 2, Lab 204",
    capacity: 35,
    bannerClass: "bg-fti",
    pic: "Ibu Nurul Aini, M.T.",
    equipment: ["35 Unit PC", "Cisco Router & Switch Rack", "Patch Panel", "Crimping Kit & Cable Tester"],
    description: "Laboratorium khusus perancangan arsitektur jaringan kabel dan nirkabel serta pengujian penetrasi keamanan siber.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "available", bookedBy: null },
      { id: "s2", time: "10:00 - 12:00", status: "available", bookedBy: null },
      { id: "s3", time: "13:00 - 15:00", status: "maintenance", bookedBy: "Pemeliharaan Switch Cisco berkala" },
      { id: "s4", time: "15:30 - 17:30", status: "available", bookedBy: null }
    ]
  },
  {
    id: "fac-auditorium-utama",
    name: "Auditorium Utama & Conference Hall",
    type: "Auditorium & Aula",
    location: "Gedung Rektorat",
    room: "Lantai 1 - Hall Utama",
    capacity: 350,
    bannerClass: "bg-auditorium",
    pic: "Bagian Umum Rektorat",
    equipment: ["Panggung Utama", "Dual Videotron P2.5", "Line Array Sound System", "Podium Digital & Mic Wireless"],
    description: "Auditorium representatif berkapasitas besar untuk kuliah umum, seminar internasional, inaugurasi, dan rapat akbar universitas.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "booked", bookedBy: "Seminar Nasional Technopreneurship" },
      { id: "s2", time: "10:00 - 12:00", status: "booked", bookedBy: "Seminar Nasional Technopreneurship" },
      { id: "s3", time: "13:00 - 15:00", status: "available", bookedBy: null },
      { id: "s4", time: "15:30 - 17:30", status: "available", bookedBy: null }
    ]
  },
  {
    id: "fac-ruang-sidang-feb",
    name: "Ruang Seminar & Simulasi Pasar Modal",
    type: "Ruang Kelas / Seminar",
    location: "Gedung FEB",
    room: "Lantai 2, R.201",
    capacity: 50,
    bannerClass: "bg-feb",
    pic: "Sekretariat Dekanat FEB",
    equipment: ["Bloomberg Terminal Display", "Smart TV 75 Inch", "Meja Konferensi U-Shape", "Sound Bar Audio"],
    description: "Ruangan multimedia berkarpet kedap suara yang ideal untuk presentasi studi kasus bisnis, seminar proposal, dan simulasi trading.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "available", bookedBy: null },
      { id: "s2", time: "10:00 - 12:00", status: "booked", bookedBy: "Sidang Skripsi Prodi Akuntansi" },
      { id: "s3", time: "13:00 - 15:00", status: "available", bookedBy: null },
      { id: "s4", time: "15:30 - 17:30", status: "available", bookedBy: null }
    ]
  },
  {
    id: "fac-peradilan-semu-fh",
    name: "Ruang Peradilan Semu (Moot Court)",
    type: "Ruang Kelas / Seminar",
    location: "Gedung FH",
    room: "Lantai 1, R. Moot Court",
    capacity: 60,
    bannerClass: "bg-fh",
    pic: "Laboratorium Hukum FH",
    equipment: ["Meja Majelis Hakim", "Kursi Terdakwa & Saksi", "Audio Recording System", "Gavel & Mimbar"],
    description: "Fasilitas replika ruang sidang pengadilan formal untuk latihan praktik peradilan semu dan debat argumentasi hukum.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "available", bookedBy: null },
      { id: "s2", time: "10:00 - 12:00", status: "available", bookedBy: null },
      { id: "s3", time: "13:00 - 15:00", status: "booked", bookedBy: "Latihan Kompetisi Moot Court Nasional" },
      { id: "s4", time: "15:30 - 17:30", status: "booked", bookedBy: "Latihan Komunitas Peradilan Semu" }
    ]
  },
  {
    id: "fac-hall-olahraga",
    name: "Gelanggang Olahraga & Lapangan Multifungsi",
    type: "Fasilitas Olahraga",
    location: "Pusat Kegiatan Mahasiswa",
    room: "Indoor Stadium PKM",
    capacity: 200,
    bannerClass: "bg-sports",
    pic: "Unit Pengelola Olahraga Kampus",
    equipment: ["Lapangan Futsal/Basket/Badminton", "Lantai Interlock Rubber", "Tribun Penonton", "Lampu Sorot LED"],
    description: "Fasilitas gelanggang olahraga serbaguna tertutup (indoor) untuk kegiatan latihan UKM olahraga, turnamen fakultas, dan kebugaran civitas akademika.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "available", bookedBy: null },
      { id: "s2", time: "10:00 - 12:00", status: "available", bookedBy: null },
      { id: "s3", time: "13:00 - 15:00", status: "available", bookedBy: null },
      { id: "s4", time: "15:30 - 17:30", status: "booked", bookedBy: "Latihan Rutin UKM Basket Putra" }
    ]
  },
  {
    id: "fac-ruang-podcast",
    name: "Studio Multimedia, Podcast & Mini Broadcasting",
    type: "Ruang Diskusi & Multimedia",
    location: "Gedung FTI",
    room: "Lantai 1, Studio 102",
    capacity: 12,
    bannerClass: "bg-fti",
    pic: "Lab Multimedia & Penyiaran",
    equipment: ["Acoustic Foam Soundproofing", "4x Shure SM7B Mic", "Rodecaster Pro II Console", "Sony Cinema Line FX30"],
    description: "Studio kedap suara bertaraf broadcast profesional untuk rekaman podcast edukasi mahasiswa, wawancara, dan produksi video kuliah digital.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "available", bookedBy: null },
      { id: "s2", time: "10:00 - 12:00", status: "available", bookedBy: null },
      { id: "s3", time: "13:00 - 15:00", status: "booked", bookedBy: "Produksi Konten BEM Fakultas" },
      { id: "s4", time: "15:30 - 17:30", status: "available", bookedBy: null }
    ]
  },
  {
    id: "fac-co-working",
    name: "Student Co-Working & Creative Lounge",
    type: "Ruang Diskusi & Multimedia",
    location: "Pusat Kegiatan Mahasiswa",
    room: "Lantai 2, PKM",
    capacity: 75,
    bannerClass: "bg-sports",
    pic: "Biro Kemahasiswaan",
    equipment: ["Ergonomic Desks & Beanbags", "Ultra High-speed Mesh WiFi", "Power Outlet per Meja", "Coffee & Water Dispenser"],
    description: "Ruang kerja kolaboratif terbuka dengan atmosfer rileks bagi tim mahasiswa yang sedang mengerjakan riset tugas akhir, hackathon, atau diskusi proyek.",
    slots: [
      { id: "s1", time: "08:00 - 10:00", status: "available", bookedBy: null },
      { id: "s2", time: "10:00 - 12:00", status: "available", bookedBy: null },
      { id: "s3", time: "13:00 - 15:00", status: "available", bookedBy: null },
      { id: "s4", time: "15:30 - 17:30", status: "available", bookedBy: null }
    ]
  }
];

// ============================================================
// DATA STATE (RIWAYAT RESERVASI MILIK PRIBADI - FR-05)
// ============================================================

const INITIAL_RESERVATIONS = [
  {
    id: "RES-2026-00412",
    facilityId: "fac-lab-pemweb",
    facilityName: "Laboratorium Komputer Pemrograman Web & AI",
    facilityType: "Laboratorium Komputer",
    location: "Gedung FTI (Lt. 3, Lab 301)",
    date: "Kamis, 01 Okt 2026",
    slotTime: "10:00 - 12:00",
    purpose: "Asistensi Modul 4 Pemrograman Web & Pengerjaan Tugas Tim Kelompok 11",
    applicant: "Yoga Pratama",
    affiliation: "Teknik Informatika 2024 (Kelas C1)",
    status: "Disetujui",
    appliedAt: "30 Sep 2026, 14:20 WIB",
    approvedBy: "Admin Lab Komputer FTI",
    notes: "Kunci lab dapat diambil di ruang staf lantai 3 dengan meninggalkan KTM asli."
  },
  {
    id: "RES-2026-00389",
    facilityId: "fac-ruang-podcast",
    facilityName: "Studio Multimedia, Podcast & Mini Broadcasting",
    facilityType: "Ruang Diskusi & Multimedia",
    location: "Gedung FTI (Lt. 1, Studio 102)",
    date: "Jumat, 02 Okt 2026",
    slotTime: "15:30 - 17:30",
    purpose: "Rekaman Podcast Edukasi Mahasiswa Informatika seputar AI Agentic Coding",
    applicant: "Yoga Pratama",
    affiliation: "Himpunan Mahasiswa Informatika",
    status: "Menunggu Konfirmasi",
    appliedAt: "01 Okt 2026, 09:15 WIB",
    approvedBy: "Menunggu verifikasi Koordinator Studio",
    notes: "Penggunaan mik Shure SM7B memerlukan briefing singkat sebelum rekaman dimulai."
  },
  {
    id: "RES-2026-00310",
    facilityId: "fac-ruang-sidang-feb",
    facilityName: "Ruang Seminar & Simulasi Pasar Modal",
    facilityType: "Ruang Kelas / Seminar",
    location: "Gedung FEB (Lt. 2, R.201)",
    date: "Senin, 28 Sep 2026",
    slotTime: "13:00 - 15:00",
    purpose: "Presentasi Pitch Deck Proposal Startup Bisnis Digital",
    applicant: "Yoga Pratama",
    affiliation: "Tim Inkubator Bisnis Kampus",
    status: "Selesai",
    appliedAt: "25 Sep 2026, 11:00 WIB",
    approvedBy: "Kasubag Sarpras FEB",
    notes: "Kegiatan berjalan lancar tanpa kendala teknis."
  }
];

// LocalStorage Persistence Helpers
function loadFacilities() {
  const saved = localStorage.getItem("sim_facilities_v1");
  if (saved) {
    try { return JSON.parse(saved); } catch (e) { console.error(e); }
  }
  return INITIAL_FACILITIES;
}

function saveFacilities(data) {
  localStorage.setItem("sim_facilities_v1", JSON.stringify(data));
}

function loadReservations() {
  const saved = localStorage.getItem("sim_reservations_v1");
  if (saved) {
    try { return JSON.parse(saved); } catch (e) { console.error(e); }
  }
  return INITIAL_RESERVATIONS;
}

function saveReservations(data) {
  localStorage.setItem("sim_reservations_v1", JSON.stringify(data));
}

let facilitiesData = loadFacilities();
let reservationsData = loadReservations();
let selectedFacilityForBooking = null;
let selectedSlotForBooking = null;
let currentHistoryFilter = "all";

// ============================================================
// DATABASE SYNC (SQLite via /api/*)
// Database adalah sumber data utama; LocalStorage tetap dipakai
// sebagai cache sekaligus fallback bila server tidak terjangkau.
// ============================================================

async function fetchJson(url, options) {
  const response = await fetch(url, options);
  if (!response.ok) {
    throw new Error(`HTTP ${response.status} - ${url}`);
  }
  return response.json();
}

// Mengganti isi array secara in-place agar referensi lama tetap valid
function replaceArrayContents(target, source) {
  target.length = 0;
  source.forEach(item => target.push(item));
}

async function syncFromDatabase() {
  try {
    const [facilities, reservations] = await Promise.all([
      fetchJson("api/facilities"),
      fetchJson("api/reservations")
    ]);

    replaceArrayContents(facilitiesData, facilities);
    replaceArrayContents(reservationsData, reservations);

    saveFacilities(facilitiesData);
    saveReservations(reservationsData);

    initFacilityModule();
    renderHistoryList();
    console.info("[SIM-Fasilitas] Data tersinkron dari database:", facilities.length, "fasilitas,", reservations.length, "reservasi.");
  } catch (err) {
    console.warn("[SIM-Fasilitas] Gagal sinkronisasi database, memakai cache LocalStorage:", err);
  }
}

function saveReservationToDatabase(reservation) {
  return fetchJson("api/reservations", {
    method: "POST",
    headers: { "Content-Type": "application/json", "Accept": "application/json" },
    body: JSON.stringify(reservation)
  });
}

function cancelReservationInDatabase(reservationId) {
  return fetchJson(`api/reservations/${encodeURIComponent(reservationId)}/cancel`, {
    method: "POST",
    headers: { "Accept": "application/json" }
  });
}

// ============================================================
// SYSTEM TIME & BROWSER DETECTION (SRS-002)
// ============================================================

function updateJam() {
  const jamEl = document.getElementById("jam");
  if (!jamEl) return;
  const now = new Date();
  const hh = String(now.getHours()).padStart(2, "0");
  const mm = String(now.getMinutes()).padStart(2, "0");
  const ss = String(now.getSeconds()).padStart(2, "0");
  jamEl.textContent = `${hh}:${mm}:${ss}`;
}

function detectBrowser() {
  const browserEl = document.getElementById("browser-info");
  if (!browserEl) return;
  const ua = navigator.userAgent;
  let browser = "Web Browser";

  if (ua.indexOf("Firefox") !== -1) {
    browser = "Firefox";
  } else if (ua.indexOf("Edg") !== -1) {
    browser = "Edge";
  } else if (ua.indexOf("Chrome") !== -1) {
    browser = "Chrome";
  } else if (ua.indexOf("Safari") !== -1) {
    browser = "Safari";
  }

  browserEl.textContent = browser;
}

// Toast helper
function showToast(message, type = "success") {
  const toast = document.getElementById("toast");
  if (!toast) return;
  toast.className = `toast-notification toast-${type} show`;
  toast.innerHTML = `
    <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
      ${type === "success" 
        ? '<polyline points="20 6 9 17 4 12"></polyline>' 
        : '<circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line>'}
    </svg>
    <span>${message}</span>
  `;
  setTimeout(() => {
    toast.classList.remove("show");
  }, 3500);
}

// ============================================================
// DOM CONTENT LOADED - MAIN INITIALIZER
// ============================================================

document.addEventListener("DOMContentLoaded", function () {
  updateJam();
  setInterval(updateJam, 1000);
  detectBrowser();

  // Tab Navigation system
  initTabs();

  // FR-01 & FR-02: Facility Catalog, Filter, Slot Availability
  initFacilityModule();

  // FR-05: User Reservation History
  initHistoryModule();

  // Legacy Practicum Form System
  initPracticumForm();

  // Sinkronkan data dari database (SQLite) bila server tersedia
  syncFromDatabase();
});

// ============================================================
// TAB NAVIGATION SYSTEM
// ============================================================

function initTabs() {
  const tabButtons = document.querySelectorAll(".nav-tab");
  const tabPanels = document.querySelectorAll(".tab-panel");

  tabButtons.forEach(button => {
    button.addEventListener("click", () => {
      const targetId = button.getAttribute("data-tab");

      tabButtons.forEach(btn => {
        btn.classList.remove("active");
        btn.setAttribute("aria-selected", "false");
      });
      tabPanels.forEach(panel => panel.classList.remove("active"));

      button.classList.add("active");
      button.setAttribute("aria-selected", "true");
      
      const targetPanel = document.getElementById(targetId);
      if (targetPanel) {
        targetPanel.classList.add("active");
      }
    });
  });

  const quickNewBookingBtn = document.getElementById("btn-quick-new-booking");
  if (quickNewBookingBtn) {
    quickNewBookingBtn.addEventListener("click", () => {
      const facTab = document.getElementById("tab-btn-fasilitas");
      if (facTab) facTab.click();
    });
  }
}

// ============================================================
// FR-01 & FR-02: FASILITAS, FILTER, STATUS KETERSEDIAAN SLOT
// ============================================================

let facilityTablePage = 1;
let facilityTablePerPage = 10;
let refreshFacilityView = null;

function initFacilityModule() {
  // Dipanggil ulang setelah booking/pembatalan. Guard ini mencegah listener
  // dan modal terpasang dua kali (yang dulu memicu reservasi ganda).
  if (refreshFacilityView) {
    refreshFacilityView();
    return;
  }

  const searchInput = document.getElementById("filter-search");
  const clearSearchBtn = document.getElementById("btn-clear-search");
  const tipeSelect = document.getElementById("filter-tipe");
  const lokasiSelect = document.getElementById("filter-lokasi");
  const kapasitasSelect = document.getElementById("filter-kapasitas");
  const statusSelect = document.getElementById("filter-status-ketersediaan");
  const resetBtn = document.getElementById("btn-reset-filter");
  const lengthSelect = document.getElementById("table-length");
  const tbodyEl = document.getElementById("facility-grid");
  const paginationEl = document.getElementById("table-pagination");
  const advancedToggleBtn = document.getElementById("btn-toggle-advanced-filter");
  const advancedPanel = document.getElementById("advanced-filter-panel");

  function getFilteredFacilities() {
    const query = (searchInput.value || "").trim().toLowerCase();
    const tipe = tipeSelect.value;
    const lokasi = lokasiSelect.value;
    const kapasitasMin = parseInt(kapasitasSelect.value, 10) || 0;
    const statusSlot = statusSelect.value;

    return facilitiesData.filter(fac => {
      // Pencarian kata kunci (FR-02)
      if (query) {
        const matchName = fac.name.toLowerCase().includes(query);
        const matchRoom = fac.room.toLowerCase().includes(query);
        const matchDesc = fac.description.toLowerCase().includes(query);
        const matchEq = fac.equipment.some(eq => eq.toLowerCase().includes(query));
        if (!matchName && !matchRoom && !matchDesc && !matchEq) return false;
      }

      // Filter Tipe (FR-02)
      if (tipe && fac.type !== tipe) return false;

      // Filter Lokasi (FR-02)
      if (lokasi && !fac.location.includes(lokasi)) return false;

      // Filter Kapasitas (FR-02)
      if (kapasitasMin > 0 && fac.capacity < kapasitasMin) return false;

      // Filter Status Ketersediaan Slot (FR-01)
      if (statusSlot) {
        const hasAvailableSlot = fac.slots.some(s => s.status === "available");
        if (statusSlot === "tersedia" && !hasAvailableSlot) return false;
        if (statusSlot === "penuh" && hasAvailableSlot) return false;
      }

      return true;
    });
  }

  function getFacilityStatus(fac) {
    if (fac.slots.some(s => s.status === "available")) {
      return { key: "available", label: "Tersedia" };
    }
    if (fac.slots.some(s => s.status === "maintenance")) {
      return { key: "maintenance", label: "Maintenance" };
    }
    return { key: "penuh", label: "Penuh" };
  }

  function renderPagination(totalItems) {
    const infoEl = document.getElementById("table-info");
    const pagerEl = document.getElementById("table-pagination");

    const totalPages = Math.max(1, Math.ceil(totalItems / facilityTablePerPage));
    const start = totalItems === 0 ? 0 : (facilityTablePage - 1) * facilityTablePerPage + 1;
    const end = Math.min(facilityTablePage * facilityTablePerPage, totalItems);

    if (infoEl) {
      infoEl.textContent = `Showing ${start} to ${end} of ${totalItems} entries`;
    }

    if (!pagerEl) return;

    let html = `
      <button type="button" class="table-page-btn" data-page="prev" ${facilityTablePage <= 1 ? "disabled" : ""}>Previous</button>
    `;

    for (let p = 1; p <= totalPages; p++) {
      const isActive = p === facilityTablePage;
      html += `
        <button type="button" class="table-page-number ${isActive ? "active" : ""}" data-page="${p}" ${isActive ? 'aria-current="page"' : ""}>${p}</button>
      `;
    }

    html += `
      <button type="button" class="table-page-btn" data-page="next" ${facilityTablePage >= totalPages ? "disabled" : ""}>Next</button>
    `;

    pagerEl.innerHTML = html;
  }

  function renderFacilities() {
    const grid = document.getElementById("facility-grid");
    const countEl = document.getElementById("filter-count");
    const totalStatEl = document.getElementById("stat-total-fasilitas");
    const tersStatEl = document.getElementById("stat-tersedia-fasilitas");

    const filtered = getFilteredFacilities();
    
    if (countEl) countEl.textContent = filtered.length;
    if (totalStatEl) totalStatEl.textContent = facilitiesData.length;
    
    // Hitung total yang memiliki slot tersedia hari ini
    const totalTersediaHariIni = facilitiesData.filter(f => f.slots.some(s => s.status === "available")).length;
    if (tersStatEl) tersStatEl.textContent = totalTersediaHariIni;

    if (!grid) return;

    const totalPages = Math.max(1, Math.ceil(filtered.length / facilityTablePerPage));
    if (facilityTablePage > totalPages) facilityTablePage = totalPages;

    const startIdx = (facilityTablePage - 1) * facilityTablePerPage;
    const pageItems = filtered.slice(startIdx, startIdx + facilityTablePerPage);

    if (pageItems.length === 0) {
      grid.innerHTML = `
        <tr class="table-empty-row">
          <td colspan="5">
            <div class="empty-state">
              <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                <circle cx="11" cy="11" r="8"></circle>
                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
              </svg>
              <h3>Tidak Ada Fasilitas yang Sesuai</h3>
              <p>Kombinasi pencarian atau penyaringan tipe, lokasi, dan kapasitas tidak menemukan ruangan aktif. Silakan reset filter untuk melihat semua.</p>
              <button type="button" class="btn-secondary" onclick="document.getElementById('btn-reset-filter').click()">Reset Filter</button>
            </div>
          </td>
        </tr>
      `;
      renderPagination(filtered.length);
      return;
    }

    grid.innerHTML = pageItems.map(fac => {
      const status = getFacilityStatus(fac);
      const availableSlotsCount = fac.slots.filter(s => s.status === "available").length;
      const totalSlots = fac.slots.length;
      const titleAttr = `${fac.room} &bull; ${availableSlotsCount} dari ${totalSlots} slot tersedia hari ini. Klik baris untuk melihat detail & reservasi.`;

      return `
        <tr class="facility-row row-clickable" data-fac-id="${fac.id}" tabindex="0" title="${titleAttr}">
          <td class="col-nama">
            <span class="facility-name-cell">${fac.name}</span>
            <span class="facility-room-sub">${fac.room}</span>
          </td>
          <td class="col-tipe">${fac.type}</td>
          <td class="col-lokasi">${fac.location}</td>
          <td class="col-kapasitas">${fac.capacity} orang</td>
          <td class="col-status">
            <span class="table-status table-status-${status.key}">
              <span class="table-status-dot">&#9679;</span>${status.label}
            </span>
          </td>
        </tr>
      `;
    }).join("");

    renderPagination(filtered.length);
  }

  function renderFromFirstPage() {
    facilityTablePage = 1;
    renderFacilities();
  }

  // Event Listeners for Filters
  searchInput.addEventListener("input", () => {
    clearSearchBtn.style.display = searchInput.value ? "block" : "none";
    renderFromFirstPage();
  });

  clearSearchBtn.addEventListener("click", () => {
    searchInput.value = "";
    clearSearchBtn.style.display = "none";
    renderFromFirstPage();
  });

  tipeSelect.addEventListener("change", renderFromFirstPage);
  lokasiSelect.addEventListener("change", renderFromFirstPage);
  kapasitasSelect.addEventListener("change", renderFromFirstPage);
  statusSelect.addEventListener("change", renderFromFirstPage);

  resetBtn.addEventListener("click", () => {
    searchInput.value = "";
    clearSearchBtn.style.display = "none";
    tipeSelect.value = "";
    lokasiSelect.value = "";
    kapasitasSelect.value = "0";
    statusSelect.value = "";
    renderFromFirstPage();
    showToast("Filter pencarian telah direset.", "info");
  });

  // Show [n] entries
  if (lengthSelect) {
    facilityTablePerPage = parseInt(lengthSelect.value, 10) || 10;
    lengthSelect.addEventListener("change", () => {
      facilityTablePerPage = parseInt(lengthSelect.value, 10) || 10;
      renderFromFirstPage();
    });
  }

  // Panel Filter Lanjutan (collapsible)
  if (advancedToggleBtn && advancedPanel) {
    advancedToggleBtn.addEventListener("click", () => {
      const isOpen = !advancedPanel.hasAttribute("hidden");
      if (isOpen) {
        advancedPanel.setAttribute("hidden", "");
        advancedToggleBtn.setAttribute("aria-expanded", "false");
        advancedToggleBtn.classList.remove("active");
      } else {
        advancedPanel.removeAttribute("hidden");
        advancedToggleBtn.setAttribute("aria-expanded", "true");
        advancedToggleBtn.classList.add("active");
      }
    });
  }

  // Pagination
  if (paginationEl) {
    paginationEl.addEventListener("click", (e) => {
      const btn = e.target.closest("button[data-page]");
      if (!btn || btn.disabled) return;

      const val = btn.getAttribute("data-page");
      const totalPages = Math.max(1, Math.ceil(getFilteredFacilities().length / facilityTablePerPage));

      if (val === "prev") {
        facilityTablePage = Math.max(1, facilityTablePage - 1);
      } else if (val === "next") {
        facilityTablePage = Math.min(totalPages, facilityTablePage + 1);
      } else {
        facilityTablePage = parseInt(val, 10) || 1;
      }
      renderFacilities();
    });
  }

  // Klik baris tabel = buka modal reservasi existing
  if (tbodyEl) {
    tbodyEl.addEventListener("click", (e) => {
      const row = e.target.closest("tr[data-fac-id]");
      if (!row) return;
      openBookingModal(row.getAttribute("data-fac-id"));
    });

    tbodyEl.addEventListener("keydown", (e) => {
      if (e.key !== "Enter" && e.key !== " ") return;
      const row = e.target.closest("tr[data-fac-id]");
      if (!row) return;
      e.preventDefault();
      openBookingModal(row.getAttribute("data-fac-id"));
    });
  }

  // Modal Booking logic
  initBookingModal();

  // Initial render
  refreshFacilityView = renderFacilities;
  renderFacilities();
}

// ============================================================
// MODAL BOOKING FASILITAS LANGSUNG
// ============================================================

function initBookingModal() {
  const modal = document.getElementById("modal-booking");
  const closeBtn = document.getElementById("btn-close-modal");
  const cancelBtn = document.getElementById("btn-cancel-modal");
  const form = document.getElementById("form-booking-action");

  function closeModal() {
    modal.classList.remove("open");
    modal.setAttribute("aria-hidden", "true");
    selectedFacilityForBooking = null;
    selectedSlotForBooking = null;
    form.reset();
    document.getElementById("selected-slot-summary").style.display = "none";
    document.getElementById("btn-confirm-booking").disabled = true;
  }

  closeBtn.addEventListener("click", closeModal);
  cancelBtn.addEventListener("click", closeModal);

  modal.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });

  // Submit Booking Form
  form.addEventListener("submit", (e) => {
    e.preventDefault();
    if (!selectedFacilityForBooking || !selectedSlotForBooking) {
      alert("Silakan klik dan pilih slot waktu ketersediaan terlebih dahulu!");
      return;
    }

    const kegiatan = document.getElementById("booking-kegiatan").value.trim();
    const pj = document.getElementById("booking-pj").value.trim();
    const instansi = document.getElementById("booking-instansi").value.trim();

    // Buat data reservasi baru
    const randomNum = Math.floor(1000 + Math.random() * 9000);
    const newReservation = {
      id: `RES-2026-${randomNum}`,
      facilityId: selectedFacilityForBooking.id,
      facilityName: selectedFacilityForBooking.name,
      facilityType: selectedFacilityForBooking.type,
      location: `${selectedFacilityForBooking.location} (${selectedFacilityForBooking.room})`,
      date: "Kamis, 01 Okt 2026",
      slotTime: selectedSlotForBooking.time,
      purpose: kegiatan,
      applicant: pj,
      affiliation: instansi,
      status: "Disetujui", // Otomatis disetujui untuk simulasi UX lancar
      appliedAt: "Baru saja",
      approvedBy: selectedFacilityForBooking.pic,
      notes: "Reservasi terkonfirmasi secara instan. Harap hadir 10 menit sebelum slot waktu dimulai."
    };

    // Update status slot di data fasilitas menjadi booked
    const fac = facilitiesData.find(f => f.id === selectedFacilityForBooking.id);
    if (fac) {
      const slot = fac.slots.find(s => s.id === selectedSlotForBooking.id);
      if (slot) {
        slot.status = "booked";
        slot.bookedBy = `${kegiatan} (${pj})`;
      }
      saveFacilities(facilitiesData);
    }

    // Tambahkan ke daftar reservasi pribadi (FR-05)
    reservationsData.unshift(newReservation);
    saveReservations(reservationsData);

    // Simpan ke database (background; UI tetap jalan bila server offline)
    saveReservationToDatabase(newReservation).catch(err => {
      console.warn("[SIM-Fasilitas] Gagal menyimpan reservasi ke database:", err);
      showToast("Reservasi tersimpan lokal (server database tidak terjangkau).", "info");
    });

    // Refresh UI
    initFacilityModule(); // refresh slot status on grid
    renderHistoryList(); // refresh riwayat tab

    closeModal();
    showToast(`Sukses! Reservasi ${newReservation.id} berhasil diajukan.`);

    // Arahkan ke tab riwayat & buka detailnya
    const riwayatTab = document.getElementById("tab-btn-riwayat");
    if (riwayatTab) {
      riwayatTab.click();
    }
  });
}

window.openBookingModal = function(facilityId) {
  const fac = facilitiesData.find(f => f.id === facilityId);
  if (!fac) return;

  selectedFacilityForBooking = fac;
  selectedSlotForBooking = null;

  const modal = document.getElementById("modal-booking");
  document.getElementById("modal-fac-type").textContent = fac.type;
  document.getElementById("modal-fac-name").textContent = fac.name;
  document.getElementById("modal-fac-location").textContent = `${fac.location} - ${fac.room}`;
  document.getElementById("modal-fac-capacity").textContent = `${fac.capacity} Orang`;
  document.getElementById("modal-fac-equipment").textContent = fac.equipment.join(", ");
  document.getElementById("modal-fac-pic").textContent = fac.pic;
  document.getElementById("modal-fac-desc").textContent = fac.description;

  // Render slot list interaktif di modal (FR-01)
  const slotsList = document.getElementById("modal-slots-list");
  slotsList.innerHTML = fac.slots.map(s => {
    let stateLabel = "Tersedia";
    let isClickable = s.status === "available";
    if (s.status === "booked") stateLabel = "Terpakai";
    if (s.status === "maintenance") stateLabel = "Maintenance";

    return `
      <button type="button" class="slot-interactive-btn ${s.status}" data-slot-id="${s.id}" ${!isClickable ? 'disabled' : ''}>
        <span class="slot-interactive-time">${s.time}</span>
        <span class="slot-interactive-state">${stateLabel}</span>
      </button>
    `;
  }).join("");

  // Handler klik slot
  const slotButtons = slotsList.querySelectorAll(".slot-interactive-btn.available");
  const confirmBtn = document.getElementById("btn-confirm-booking");
  const summaryBox = document.getElementById("selected-slot-summary");
  const summaryTime = document.getElementById("summary-slot-time");

  slotButtons.forEach(btn => {
    btn.addEventListener("click", () => {
      slotButtons.forEach(b => b.classList.remove("selected"));
      btn.classList.add("selected");

      const slotId = btn.getAttribute("data-slot-id");
      selectedSlotForBooking = fac.slots.find(s => s.id === slotId);

      if (selectedSlotForBooking) {
        summaryBox.style.display = "flex";
        summaryTime.textContent = selectedSlotForBooking.time;
        confirmBtn.disabled = false;
      }
    });
  });

  // Pre-fill pemohon jika ada nama di user chip
  const defaultPj = document.getElementById("booking-pj");
  if (defaultPj && !defaultPj.value) {
    defaultPj.value = "Yoga Pratama";
    document.getElementById("booking-instansi").value = "Teknik Informatika 2024 (Kelompok 11)";
  }

  modal.classList.add("open");
  modal.setAttribute("aria-hidden", "false");
};

// ============================================================
// FR-05: MODUL RIWAYAT & DETAIL RESERVASI PRIBADI
// ============================================================

function initHistoryModule() {
  const filterPills = document.querySelectorAll(".pill-filter-btn");

  filterPills.forEach(pill => {
    pill.addEventListener("click", () => {
      filterPills.forEach(p => p.classList.remove("active"));
      pill.classList.add("active");
      currentHistoryFilter = pill.getAttribute("data-history-filter");
      renderHistoryList();
    });
  });

  initDetailRiwayatModal();
  renderHistoryList();
}

function renderHistoryList() {
  const container = document.getElementById("riwayat-container");
  const countAll = document.getElementById("count-hist-all");
  const countApproved = document.getElementById("count-hist-approved");
  const countPending = document.getElementById("count-hist-pending");
  const countCompleted = document.getElementById("count-hist-completed");
  const countCancelled = document.getElementById("count-hist-cancelled");
  const riwayatBadge = document.getElementById("riwayat-badge");

  if (!container) return;

  // Hitung badge
  const total = reservationsData.length;
  const approved = reservationsData.filter(r => r.status === "Disetujui").length;
  const pending = reservationsData.filter(r => r.status === "Menunggu Konfirmasi").length;
  const completed = reservationsData.filter(r => r.status === "Selesai").length;
  const cancelled = reservationsData.filter(r => r.status === "Dibatalkan").length;

  if (countAll) countAll.textContent = total;
  if (countApproved) countApproved.textContent = approved;
  if (countPending) countPending.textContent = pending;
  if (countCompleted) countCompleted.textContent = completed;
  if (countCancelled) countCancelled.textContent = cancelled;
  if (riwayatBadge) riwayatBadge.textContent = total;

  let filtered = reservationsData;
  if (currentHistoryFilter !== "all") {
    filtered = reservationsData.filter(r => r.status === currentHistoryFilter);
  }

  if (filtered.length === 0) {
    container.innerHTML = `
      <div class="empty-state">
        <svg width="48" height="48" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
          <circle cx="12" cy="12" r="10"></circle>
          <polyline points="12 6 12 12 16 14"></polyline>
        </svg>
        <h3>Tidak Ada Riwayat Reservasi</h3>
        <p>Belum ada data reservasi dengan status "${currentHistoryFilter}". Anda dapat menjelajahi fasilitas dan membuat reservasi pertama Anda.</p>
        <button type="button" class="btn-primary" onclick="document.getElementById('tab-btn-fasilitas').click()">Eksplorasi Fasilitas</button>
      </div>
    `;
    return;
  }

  container.innerHTML = filtered.map(item => {
    let statusClass = "status-approved";
    if (item.status === "Menunggu Konfirmasi") statusClass = "status-pending";
    if (item.status === "Selesai") statusClass = "status-completed";
    if (item.status === "Dibatalkan") statusClass = "status-cancelled";

    const canCancel = item.status === "Disetujui" || item.status === "Menunggu Konfirmasi";

    return `
      <div class="history-card ${statusClass}">
        <div class="history-card-main">
          <div class="history-icon-box">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
              <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
              <line x1="16" y1="2" x2="16" y2="6"></line>
              <line x1="8" y1="2" x2="8" y2="6"></line>
              <line x1="3" y1="10" x2="21" y2="10"></line>
            </svg>
          </div>
          <div class="history-info">
            <span class="history-code">${item.id}</span>
            <h4 class="history-facility-name">${item.facilityName}</h4>
            <div class="history-meta-sub">
              <span>
                <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                  <circle cx="12" cy="10" r="3"></circle>
                </svg>
                ${item.location}
              </span>
              <span>&bull;</span>
              <span>Keperluan: <strong>${item.purpose}</strong></span>
            </div>
          </div>
        </div>

        <div class="history-card-details">
          <div class="history-slot-pill">
            <div class="history-slot-date">${item.date}</div>
            <div class="history-slot-time">${item.slotTime}</div>
          </div>

          <span class="history-status-badge status-${item.status.replace(/\s+/g, '-')}">
            <span class="live-dot" style="width:6px;height:6px;background:currentColor;"></span>
            ${item.status}
          </span>

          <div class="history-actions">
            <button type="button" class="btn-secondary btn-detail" onclick="openDetailRiwayatModal('${item.id}')">
              Lihat Detail
            </button>
            ${canCancel ? `
              <button type="button" class="btn-cancel-reservation" title="Batalkan Pengajuan Reservasi" onclick="cancelReservation('${item.id}')">
                Batalkan
              </button>
            ` : ''}
          </div>
        </div>
      </div>
    `;
  }).join("");
}

// Batal reservasi
window.cancelReservation = function(resId) {
  const item = reservationsData.find(r => r.id === resId);
  if (!item) return;

  if (confirm(`Yakin ingin membatalkan reservasi "${item.facilityName}" (${item.id})?`)) {
    item.status = "Dibatalkan";
    saveReservations(reservationsData);

    // Update status di database (background)
    cancelReservationInDatabase(resId).catch(err => {
      console.warn("[SIM-Fasilitas] Gagal memperbarui pembatalan di database:", err);
    });

    // Kembalikan slot fasilitas menjadi available
    const fac = facilitiesData.find(f => f.id === item.facilityId);
    if (fac) {
      const slot = fac.slots.find(s => s.time === item.slotTime);
      if (slot) {
        slot.status = "available";
        slot.bookedBy = null;
      }
      saveFacilities(facilitiesData);
    }

    renderHistoryList();
    initFacilityModule();
    showToast(`Reservasi ${resId} telah dibatalkan.`, "info");
  }
};

// Modal Detail Riwayat (FR-05)
function initDetailRiwayatModal() {
  const modal = document.getElementById("modal-detail-riwayat");
  const closeBtn = document.getElementById("btn-close-det-modal");
  const closeBtnBottom = document.getElementById("btn-close-det-btn");
  const printBtn = document.getElementById("btn-print-receipt");

  function closeModal() {
    modal.classList.remove("open");
    modal.setAttribute("aria-hidden", "true");
  }

  closeBtn.addEventListener("click", closeModal);
  closeBtnBottom.addEventListener("click", closeModal);
  modal.addEventListener("click", (e) => {
    if (e.target === modal) closeModal();
  });

  printBtn.addEventListener("click", () => {
    window.print();
  });
}

window.openDetailRiwayatModal = function(resId) {
  const item = reservationsData.find(r => r.id === resId);
  if (!item) return;

  const modal = document.getElementById("modal-detail-riwayat");
  document.getElementById("det-kode-badge").textContent = item.id;

  const content = document.getElementById("detail-riwayat-content");
  content.innerHTML = `
    <div class="detail-riwayat-receipt">
      <div class="receipt-top">
        <span class="receipt-booking-id">${item.id}</span>
        <div class="receipt-status-wrap">
          <span class="history-status-badge status-${item.status.replace(/\s+/g, '-')}">
            ${item.status}
          </span>
        </div>
      </div>

      <div class="receipt-grid">
        <div class="receipt-row">
          <span class="receipt-label">Nama Fasilitas</span>
          <span class="receipt-value">${item.facilityName}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Tipe Fasilitas</span>
          <span class="receipt-value">${item.facilityType}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Lokasi / Ruangan</span>
          <span class="receipt-value">${item.location}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Tanggal Pelaksanaan</span>
          <span class="receipt-value">${item.date}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Slot Waktu Reservasi</span>
          <span class="receipt-value" style="font-family: var(--font-mono); color: var(--primary);">${item.slotTime}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Penanggung Jawab</span>
          <span class="receipt-value">${item.applicant}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Instansi / Prodi</span>
          <span class="receipt-value">${item.affiliation}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Tujuan Kegiatan</span>
          <span class="receipt-value">${item.purpose}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Waktu Pengajuan</span>
          <span class="receipt-value">${item.appliedAt}</span>
        </div>
        <div class="receipt-row">
          <span class="receipt-label">Disetujui / PIC</span>
          <span class="receipt-value">${item.approvedBy}</span>
        </div>
      </div>

      <div class="receipt-note">
        <strong>Catatan Petugas:</strong>
        <p>${item.notes}</p>
      </div>
    </div>
  `;

  modal.classList.add("open");
  modal.setAttribute("aria-hidden", "false");
};

// ============================================================
// SISTEM PENDAFTARAN PRAKTIKUM (KODE AWAL TERJAGA UTUH)
// SRS-003, SRS-004, SRS-005, SRS-006, SRS-007
// ============================================================

function initPracticumForm() {
  const form = document.getElementById("form-daftar");
  if (!form) return;

  const fakultasSelect = document.getElementById("fakultas");
  const prodiSelect = document.getElementById("prodi");
  let formSubmitted = false;

  const dataFakultas = [
    { id: "fti", nama: "Fakultas Teknologi Informasi" },
    { id: "feb", nama: "Fakultas Ekonomi dan Bisnis" },
    { id: "fh", nama: "Fakultas Hukum" },
  ];

  const dataProdi = {
    fti: [
      { id: "ti", nama: "Teknik Informatika" },
      { id: "si", nama: "Sistem Informasi" },
      { id: "ti2", nama: "Teknologi Informasi" },
    ],
    feb: [
      { id: "ak", nama: "Akuntansi" },
      { id: "mba", nama: "Manajemen Bisnis" },
      { id: "ep", nama: "Ekonomi Pembangunan" },
    ],
    fh: [
      { id: "ih", nama: "Ilmu Hukum" },
      { id: "hn", nama: "Hukum Notariat" },
      { id: "hi", nama: "Hukum Internasional" },
    ],
  };

  dataFakultas.forEach(function (fakultas) {
    const option = document.createElement("option");
    option.value = fakultas.id;
    option.textContent = fakultas.nama;
    fakultasSelect.appendChild(option);
  });

  function populateProdi(fakultasId) {
    prodiSelect.innerHTML = "";
    const placeholder = document.createElement("option");
    placeholder.value = "";
    placeholder.textContent = "-- Pilih Program Studi --";
    prodiSelect.appendChild(placeholder);

    if (!fakultasId || !dataProdi[fakultasId]) {
      prodiSelect.disabled = true;
      return;
    }

    dataProdi[fakultasId].forEach(function (prodi) {
      const option = document.createElement("option");
      option.value = prodi.id;
      option.textContent = prodi.nama;
      prodiSelect.appendChild(option);
    });

    prodiSelect.disabled = false;
  }

  fakultasSelect.addEventListener("change", function () {
    populateProdi(this.value);
  });

  const namaInput = document.getElementById("nama");
  const nimInput = document.getElementById("nim");
  const namaError = document.getElementById("nama-error");
  const nimError = document.getElementById("nim-error");

  function validateNama(value) {
    if (!value || value.trim() === "") return "Nama wajib diisi";
    if (value.trim().length < 2) return "Nama minimal 2 karakter";
    return "";
  }

  function validateNim(value) {
    if (!value || value.trim() === "") return "NIM wajib diisi";
    if (!/^\d+$/.test(value.trim())) return "NIM harus berupa angka";
    if (value.trim().length < 8) return "NIM minimal 8 digit";
    return "";
  }

  function showError(inputEl, errorEl, message) {
    if (message) {
      errorEl.textContent = message;
      inputEl.classList.add("error");
    } else {
      errorEl.textContent = "";
      inputEl.classList.remove("error");
    }
  }

  namaInput.addEventListener("input", function () {
    showError(namaInput, namaError, validateNama(namaInput.value));
  });

  nimInput.addEventListener("input", function () {
    showError(nimInput, nimError, validateNim(nimInput.value));
  });

  const mkSelect = document.getElementById("mk");
  const btnTambahMk = document.getElementById("btn-tambah-mk");
  const daftarMk = document.getElementById("daftar-mk");
  const jumlahMk = document.getElementById("jumlah-mk");
  let selectedMk = [];

  const dataMk = [
    { id: "prak-pemweb", nama: "Praktikum Pemrograman Web" },
    { id: "prak-basisdata", nama: "Praktikum Basis Data" },
    { id: "prak-jarkom", nama: "Praktikum Jaringan Komputer" },
    { id: "prak-rpl", nama: "Praktikum Rekayasa Perangkat Lunak" },
  ];

  dataMk.forEach(function (mk) {
    const option = document.createElement("option");
    option.value = mk.id;
    option.textContent = mk.nama;
    mkSelect.appendChild(option);
  });

  function updateJumlahMk() {
    jumlahMk.textContent = selectedMk.length;
  }

  function tambahMk() {
    const mkId = mkSelect.value;
    if (!mkId) return;

    const sudahAda = selectedMk.some(item => item.id === mkId);
    if (sudahAda) {
      alert("Mata kuliah sudah dipilih!");
      return;
    }

    const mkData = dataMk.find(item => item.id === mkId);
    if (!mkData) return;

    selectedMk.push(mkData);
    renderDaftarMk();
    mkSelect.value = "";
  }

  function hapusMk(mkId) {
    selectedMk = selectedMk.filter(item => item.id !== mkId);
    renderDaftarMk();
  }

  function renderDaftarMk() {
    daftarMk.innerHTML = "";
    selectedMk.forEach(function (mk) {
      const li = document.createElement("li");
      const span = document.createElement("span");
      span.textContent = mk.nama;
      const btnHapus = document.createElement("button");
      btnHapus.type = "button";
      btnHapus.textContent = "Hapus";
      btnHapus.addEventListener("click", function () {
        hapusMk(mk.id);
      });
      li.appendChild(span);
      li.appendChild(btnHapus);
      daftarMk.appendChild(li);
    });
    updateJumlahMk();
  }

  btnTambahMk.addEventListener("click", tambahMk);

  const ringkasanDiv = document.getElementById("ringkasan");
  const btnDaftarUlang = document.getElementById("btn-daftar-ulang");
  const fakultasError = document.getElementById("fakultas-error");
  const prodiError = document.getElementById("prodi-error");
  const mkError = document.getElementById("mk-error");

  function getSelectText(selectEl) {
    if (selectEl.selectedIndex < 0) return "";
    return selectEl.options[selectEl.selectedIndex].text;
  }

  function clearAllErrors() {
    showError(namaInput, namaError, "");
    showError(nimInput, nimError, "");
    fakultasError.textContent = "";
    prodiError.textContent = "";
    mkError.textContent = "";
  }

  form.addEventListener("submit", function (e) {
    e.preventDefault();
    clearAllErrors();

    let hasError = false;

    const namaMsg = validateNama(namaInput.value);
    if (namaMsg) {
      showError(namaInput, namaError, namaMsg);
      hasError = true;
    }

    const nimMsg = validateNim(nimInput.value);
    if (nimMsg) {
      showError(nimInput, nimError, nimMsg);
      hasError = true;
    }

    if (!fakultasSelect.value) {
      fakultasError.textContent = "Fakultas wajib dipilih";
      hasError = true;
    }

    if (!prodiSelect.value) {
      prodiError.textContent = "Program Studi wajib dipilih";
      hasError = true;
    }

    if (selectedMk.length === 0) {
      mkError.textContent = "Pilih minimal 1 mata kuliah";
      hasError = true;
    }

    if (hasError) return;

    document.getElementById("ring-nama").textContent = namaInput.value.trim();
    document.getElementById("ring-nim").textContent = nimInput.value.trim();
    document.getElementById("ring-fakultas").textContent = getSelectText(fakultasSelect);
    document.getElementById("ring-prodi").textContent = getSelectText(prodiSelect);

    const ringMk = document.getElementById("ring-mk");
    ringMk.innerHTML = "";
    selectedMk.forEach(function (mk) {
      const li = document.createElement("li");
      li.textContent = mk.nama;
      ringMk.appendChild(li);
    });

    form.style.display = "none";
    ringkasanDiv.style.display = "block";
    formSubmitted = true;
    showToast("Pendaftaran praktikum berhasil disimpan!");
  });

  btnDaftarUlang.addEventListener("click", function () {
    ringkasanDiv.style.display = "none";
    form.style.display = "block";
    form.reset();

    formSubmitted = false;
    prodiSelect.disabled = true;
    prodiSelect.innerHTML = '<option value="">-- Pilih Program Studi --</option>';
    selectedMk = [];
    renderDaftarMk();
    clearAllErrors();
  });

  window.addEventListener("beforeunload", function (e) {
    // Only warn if practicum form is partially filled and not submitted
    const isTyping = namaInput.value || nimInput.value || selectedMk.length > 0;
    if (isTyping && !formSubmitted) {
      e.preventDefault();
      e.returnValue = "";
    }
  });
}
