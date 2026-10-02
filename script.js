/* ============================================================
   JARA - SISTEM RESERVASI & PELAPORAN FASILITAS KAMPUS
   script.js
   ============================================================ */

"use strict";

/* ============================================================
   DATA FASILITAS
   ============================================================ */

const INITIAL_FACILITIES = [
  {
    id: "fac-lab-pemweb",
    name: "Laboratorium Komputer Pemrograman Web & AI",
    type: "Laboratorium Komputer",
    location: "Gedung FTI, Lantai 3 Lab 301",
    building: "Gedung FTI",
    floor: "Lantai 3",
    room: "Lab 301",
    capacity: 40,
    description:
      "Laboratorium komputer untuk kegiatan praktikum pemrograman web, kecerdasan buatan, dan pengembangan perangkat lunak.",
    equipment: [
      "40 PC",
      "Proyektor",
      "AC",
      "Whiteboard",
      "Wi-Fi"
    ],
    image:
      "https://images.unsplash.com/photo-1516321318423-f06f85e504b3?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-lab-pemweb-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "booked"
      },
      {
        id: "slot-lab-pemweb-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "available"
      },
      {
        id: "slot-lab-pemweb-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "booked"
      },
      {
        id: "slot-lab-pemweb-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "available"
      }
    ]
  },

  {
    id: "fac-lab-jarkom",
    name: "Laboratorium Jaringan Komputer & Cyber Security",
    type: "Laboratorium Komputer",
    location: "Gedung FTI, Lantai 2 Lab 204",
    building: "Gedung FTI",
    floor: "Lantai 2",
    room: "Lab 204",
    capacity: 35,
    description:
      "Laboratorium jaringan untuk praktikum jaringan komputer, keamanan siber, administrasi server, dan sistem terdistribusi.",
    equipment: [
      "35 PC",
      "Router",
      "Switch",
      "Proyektor",
      "AC"
    ],
    image:
      "https://images.unsplash.com/photo-1558494949-ef010cbdcc31?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-jarkom-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "available"
      },
      {
        id: "slot-jarkom-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "booked"
      },
      {
        id: "slot-jarkom-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "available"
      },
      {
        id: "slot-jarkom-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "maintenance"
      }
    ]
  },

  {
    id: "fac-auditorium-utama",
    name: "Auditorium Utama & Conference Hall",
    type: "Auditorium",
    location: "Gedung Rektorat, Lantai 1",
    building: "Gedung Rektorat",
    floor: "Lantai 1",
    room: "Auditorium Utama",
    capacity: 350,
    description:
      "Auditorium utama untuk seminar, konferensi, kuliah umum, wisuda, dan kegiatan universitas berskala besar.",
    equipment: [
      "350 Kursi",
      "Sound System",
      "Proyektor",
      "AC",
      "Panggung"
    ],
    image:
      "https://images.unsplash.com/photo-1505373877841-8d25f7d46678?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-auditorium-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "booked"
      },
      {
        id: "slot-auditorium-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "available"
      },
      {
        id: "slot-auditorium-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "available"
      },
      {
        id: "slot-auditorium-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "booked"
      }
    ]
  },

  {
    id: "fac-ruang-sidang-feb",
    name: "Ruang Seminar & Simulasi Pasar Modal",
    type: "Ruang Seminar",
    location: "Gedung FEB, Lantai 2",
    building: "Gedung FEB",
    floor: "Lantai 2",
    room: "Ruang Seminar",
    capacity: 50,
    description:
      "Ruang seminar untuk kegiatan akademik, diskusi, simulasi pasar modal, presentasi, dan rapat organisasi.",
    equipment: [
      "50 Kursi",
      "Proyektor",
      "AC",
      "Whiteboard"
    ],
    image:
      "https://images.unsplash.com/photo-1515169067868-5387ec356754?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-feb-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "available"
      },
      {
        id: "slot-feb-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "available"
      },
      {
        id: "slot-feb-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "booked"
      },
      {
        id: "slot-feb-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "available"
      }
    ]
  },

  {
    id: "fac-peradilan-semu-fh",
    name: "Ruang Peradilan Semu (Moot Court)",
    type: "Ruang Simulasi",
    location: "Gedung FH, Lantai 1",
    building: "Gedung FH",
    floor: "Lantai 1",
    room: "Moot Court",
    capacity: 60,
    description:
      "Ruang simulasi persidangan yang digunakan untuk kegiatan praktikum hukum, moot court, seminar, dan simulasi persidangan.",
    equipment: [
      "60 Kursi",
      "Meja Sidang",
      "Proyektor",
      "AC"
    ],
    image:
      "https://images.unsplash.com/photo-1589578527966-fdac0f44566c?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-fh-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "available"
      },
      {
        id: "slot-fh-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "booked"
      },
      {
        id: "slot-fh-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "available"
      },
      {
        id: "slot-fh-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "available"
      }
    ]
  },

  {
    id: "fac-hall-olahraga",
    name: "Gelanggang Olahraga & Lapangan Multifungsi",
    type: "Lapangan",
    location: "PKM, Lantai 1",
    building: "PKM",
    floor: "Lantai 1",
    room: "Gelanggang Olahraga",
    capacity: 200,
    description:
      "Fasilitas olahraga multifungsi untuk kegiatan olahraga, kompetisi mahasiswa, acara organisasi, dan kegiatan kemahasiswaan.",
    equipment: [
      "Lapangan Indoor",
      "Tribun",
      "Sound System",
      "Lampu"
    ],
    image:
      "https://images.unsplash.com/photo-1546519638-68e109498ffc?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-olahraga-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "booked"
      },
      {
        id: "slot-olahraga-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "available"
      },
      {
        id: "slot-olahraga-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "available"
      },
      {
        id: "slot-olahraga-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "booked"
      }
    ]
  },

  {
    id: "fac-ruang-podcast",
    name: "Studio Multimedia, Podcast & Mini Broadcasting",
    type: "Studio Multimedia",
    location: "Gedung FTI, Lantai 4",
    building: "Gedung FTI",
    floor: "Lantai 4",
    room: "Studio Multimedia",
    capacity: 12,
    description:
      "Studio multimedia untuk produksi podcast, video, live streaming, broadcasting, dan pembuatan konten digital mahasiswa.",
    equipment: [
      "Kamera",
      "Microphone",
      "Lighting",
      "Green Screen",
      "PC Editing"
    ],
    image:
      "https://images.unsplash.com/photo-1598488035139-bdbb2231ce04?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-podcast-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "available"
      },
      {
        id: "slot-podcast-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "available"
      },
      {
        id: "slot-podcast-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "maintenance"
      },
      {
        id: "slot-podcast-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "available"
      }
    ]
  },

  {
    id: "fac-co-working",
    name: "Student Co-Working & Creative Lounge",
    type: "Co-Working Space",
    location: "PKM, Lantai 2",
    building: "PKM",
    floor: "Lantai 2",
    room: "Creative Lounge",
    capacity: 75,
    description:
      "Ruang kolaborasi mahasiswa untuk diskusi, kerja kelompok, kegiatan komunitas, dan pengembangan proyek kreatif.",
    equipment: [
      "75 Kursi",
      "Wi-Fi",
      "Proyektor",
      "Whiteboard",
      "AC"
    ],
    image:
      "https://images.unsplash.com/photo-1497366811353-6870744d04b2?auto=format&fit=crop&w=900&q=80",
    slots: [
      {
        id: "slot-coworking-1",
        date: "2026-10-02",
        time: "08:00 - 10:00",
        status: "available"
      },
      {
        id: "slot-coworking-2",
        date: "2026-10-02",
        time: "10:00 - 12:00",
        status: "booked"
      },
      {
        id: "slot-coworking-3",
        date: "2026-10-02",
        time: "13:00 - 15:00",
        status: "available"
      },
      {
        id: "slot-coworking-4",
        date: "2026-10-02",
        time: "15:30 - 17:30",
        status: "available"
      }
    ]
  }
];

/* ============================================================
   STORAGE
   ============================================================ */

const STORAGE_KEYS = {
  facilities: "jara_facilities",
  reservations: "jara_reservations",
  reports: "jara_reports"
};

function loadFacilities() {
  try {
    const saved = localStorage.getItem(STORAGE_KEYS.facilities);

    if (!saved) {
      return structuredClone(INITIAL_FACILITIES);
    }

    const parsed = JSON.parse(saved);

    if (!Array.isArray(parsed) || parsed.length === 0) {
      return structuredClone(INITIAL_FACILITIES);
    }

    return parsed;
  } catch (error) {
    console.error("Gagal membaca data fasilitas:", error);
    return structuredClone(INITIAL_FACILITIES);
  }
}

function saveFacilities(facilities) {
  try {
    localStorage.setItem(
      STORAGE_KEYS.facilities,
      JSON.stringify(facilities)
    );
  } catch (error) {
    console.error("Gagal menyimpan fasilitas:", error);
  }
}

function loadReservations() {
  try {
    const saved = localStorage.getItem(STORAGE_KEYS.reservations);

    if (!saved) {
      return [];
    }

    const parsed = JSON.parse(saved);

    return Array.isArray(parsed) ? parsed : [];
  } catch (error) {
    console.error("Gagal membaca reservasi:", error);
    return [];
  }
}

function saveReservations(reservations) {
  try {
    localStorage.setItem(
      STORAGE_KEYS.reservations,
      JSON.stringify(reservations)
    );
  } catch (error) {
    console.error("Gagal menyimpan reservasi:", error);
  }
}

function loadReports() {
  try {
    const saved = localStorage.getItem(STORAGE_KEYS.reports);

    if (!saved) {
      return [];
    }

    const parsed = JSON.parse(saved);

    return Array.isArray(parsed) ? parsed : [];
  } catch (error) {
    console.error("Gagal membaca laporan:", error);
    return [];
  }
}

function saveReports(reports) {
  try {
    localStorage.setItem(
      STORAGE_KEYS.reports,
      JSON.stringify(reports)
    );
  } catch (error) {
    console.error("Gagal menyimpan laporan:", error);
  }
}

/* ============================================================
   GLOBAL STATE
   ============================================================ */

let facilities = loadFacilities();
let reservations = loadReservations();
let reports = loadReports();

let selectedFacilityId = null;
let selectedReservationId = null;

/* ============================================================
   HELPER
   ============================================================ */

function escapeHTML(value) {
  if (value === null || value === undefined) {
    return "";
  }

  return String(value)
    .replace(/&/g, "&amp;")
    .replace(/</g, "&lt;")
    .replace(/>/g, "&gt;")
    .replace(/"/g, "&quot;")
    .replace(/'/g, "&#039;");
}

function formatDate(dateString) {
  if (!dateString) {
    return "-";
  }

  const date = new Date(`${dateString}T00:00:00`);

  if (Number.isNaN(date.getTime())) {
    return dateString;
  }

  return date.toLocaleDateString("id-ID", {
    day: "2-digit",
    month: "long",
    year: "numeric"
  });
}

function formatDateShort(dateString) {
  if (!dateString) {
    return "-";
  }

  const date = new Date(`${dateString}T00:00:00`);

  if (Number.isNaN(date.getTime())) {
    return dateString;
  }

  return date.toLocaleDateString("id-ID", {
    day: "2-digit",
    month: "short",
    year: "numeric"
  });
}

function getTodayString() {
  const now = new Date();

  const year = now.getFullYear();
  const month = String(now.getMonth() + 1).padStart(2, "0");
  const day = String(now.getDate()).padStart(2, "0");

  return `${year}-${month}-${day}`;
}

function generateId(prefix = "id") {
  return `${prefix}-${Date.now()}-${Math.random()
    .toString(36)
    .substring(2, 9)}`;
}

function getFacilityById(id) {
  return facilities.find((facility) => facility.id === id);
}

function getReservationById(id) {
  return reservations.find(
    (reservation) => reservation.id === id
  );
}

function getAvailableSlots(facility, date = getTodayString()) {
  if (!facility || !Array.isArray(facility.slots)) {
    return [];
  }

  return facility.slots.filter(
    (slot) =>
      slot.date === date &&
      slot.status === "available"
  );
}

function getSlotStatusText(status) {
  switch (status) {
    case "available":
      return "Tersedia";

    case "booked":
      return "Terisi";

    case "maintenance":
      return "Pemeliharaan";

    default:
      return "Tidak diketahui";
  }
}

function getSlotStatusClass(status) {
  switch (status) {
    case "available":
      return "slot-available";

    case "booked":
      return "slot-booked";

    case "maintenance":
      return "slot-maintenance";

    default:
      return "";
  }
}

function getFacilityIcon(type) {
  const normalized = String(type || "").toLowerCase();

  if (normalized.includes("laboratorium")) {
    return "💻";
  }

  if (normalized.includes("auditorium")) {
    return "🏛️";
  }

  if (normalized.includes("seminar")) {
    return "📚";
  }

  if (normalized.includes("simulasi")) {
    return "⚖️";
  }

  if (normalized.includes("lapangan")) {
    return "🏟️";
  }

  if (normalized.includes("studio")) {
    return "🎙️";
  }

  if (normalized.includes("co-working")) {
    return "🧑‍💻";
  }

  return "🏢";
}

/* ============================================================
   TOAST
   ============================================================ */

function showToast(message, type = "success") {
  let toastContainer =
    document.getElementById("toast-container");

  if (!toastContainer) {
    toastContainer = document.createElement("div");

    toastContainer.id = "toast-container";

    toastContainer.className = "toast-container";

    document.body.appendChild(toastContainer);
  }

  const toast = document.createElement("div");

  toast.className = `toast toast-${type}`;

  toast.innerHTML = `
    <div class="toast-icon">
      ${
        type === "success"
          ? "✓"
          : type === "error"
          ? "!"
          : "i"
      }
    </div>

    <div class="toast-message">
      ${escapeHTML(message)}
    </div>

    <button
      type="button"
      class="toast-close"
      aria-label="Tutup"
    >
      ×
    </button>
  `;

  toastContainer.appendChild(toast);

  const closeButton =
    toast.querySelector(".toast-close");

  closeButton.addEventListener("click", () => {
    toast.remove();
  });

  setTimeout(() => {
    if (toast.parentNode) {
      toast.remove();
    }
  }, 4000);
}

/* ============================================================
   TAB NAVIGATION
   ============================================================ */

function initTabs() {
  const tabButtons =
    document.querySelectorAll("[data-tab]");

  const tabContents =
    document.querySelectorAll(".tab-content");

  tabButtons.forEach((button) => {
    button.addEventListener("click", () => {
      const target = button.dataset.tab;

      tabButtons.forEach((item) => {
        item.classList.remove("active");
      });

      tabContents.forEach((content) => {
        content.classList.remove("active");
      });

      button.classList.add("active");

      const targetContent =
        document.getElementById(target);

      if (targetContent) {
        targetContent.classList.add("active");
      }

      if (target === "tab-riwayat") {
        renderReservationHistory();
      }
    });
  });
}

/* ============================================================
   FACILITY MODULE
   ============================================================ */

function initFacilityModule() {
  const searchInput =
    document.getElementById("facility-search");

  const typeFilter =
    document.getElementById("filter-type");

  const locationFilter =
    document.getElementById("filter-location");

  const capacityFilter =
    document.getElementById("filter-capacity");

  if (searchInput) {
    searchInput.addEventListener("input", () => {
      renderFacilities();
    });
  }

  if (typeFilter) {
    typeFilter.addEventListener("change", () => {
      renderFacilities();
    });
  }

  if (locationFilter) {
    locationFilter.addEventListener("change", () => {
      renderFacilities();
    });
  }

  if (capacityFilter) {
    capacityFilter.addEventListener("change", () => {
      renderFacilities();
    });
  }

  initFacilityModal();

  renderFacilities();
  updateFacilityStatistics();
}

/* ============================================================
   FILTER FACILITIES
   ============================================================ */

function getFilteredFacilities() {
  const searchInput =
    document.getElementById("facility-search");

  const typeFilter =
    document.getElementById("filter-type");

  const locationFilter =
    document.getElementById("filter-location");

  const capacityFilter =
    document.getElementById("filter-capacity");

  const search = searchInput
    ? searchInput.value.trim().toLowerCase()
    : "";

  const selectedType = typeFilter
    ? typeFilter.value
    : "";

  const selectedLocation = locationFilter
    ? locationFilter.value
    : "";

  const selectedCapacity = capacityFilter
    ? capacityFilter.value
    : "";

  return facilities.filter((facility) => {
    const matchesSearch =
      !search ||
      facility.name.toLowerCase().includes(search) ||
      facility.type.toLowerCase().includes(search) ||
      facility.location.toLowerCase().includes(search) ||
      facility.description.toLowerCase().includes(search);

    const matchesType =
      !selectedType ||
      facility.type === selectedType;

    const matchesLocation =
      !selectedLocation ||
      facility.building === selectedLocation;

    let matchesCapacity = true;

    if (selectedCapacity === "small") {
      matchesCapacity = facility.capacity <= 30;
    }

    if (selectedCapacity === "medium") {
      matchesCapacity =
        facility.capacity > 30 &&
        facility.capacity <= 100;
    }

    if (selectedCapacity === "large") {
      matchesCapacity = facility.capacity > 100;
    }

    return (
      matchesSearch &&
      matchesType &&
      matchesLocation &&
      matchesCapacity
    );
  });
}

/* ============================================================
   RENDER FACILITIES - TABLE
   ============================================================ */

function renderFacilities() {
  const tableBody =
    document.getElementById("facility-grid");

  const countEl =
    document.getElementById("filter-count");

  const totalStatEl =
    document.getElementById(
      "stat-total-fasilitas"
    );

  const availableStatEl =
    document.getElementById(
      "stat-tersedia-fasilitas"
    );

  if (!tableBody) {
    return;
  }

  const filtered = getFilteredFacilities();

  if (countEl) {
    countEl.textContent =
      `${filtered.length} fasilitas ditemukan`;
  }

  if (totalStatEl) {
    totalStatEl.textContent = facilities.length;
  }

  if (availableStatEl) {
    const totalAvailable = facilities.reduce(
      (total, facility) => {
        return (
          total +
          getAvailableSlots(facility).length
        );
      },
      0
    );

    availableStatEl.textContent = totalAvailable;
  }

  if (filtered.length === 0) {
    tableBody.innerHTML = `
      <tr>
        <td colspan="8">
          <div class="facility-empty">
            <div class="facility-empty-icon">
              🔍
            </div>

            <h3>Fasilitas tidak ditemukan</h3>

            <p>
              Tidak ada fasilitas yang sesuai
              dengan filter yang dipilih.
            </p>
          </div>
        </td>
      </tr>
    `;

    return;
  }

  tableBody.innerHTML = filtered
    .map((facility, index) => {
      const availableSlots =
        getAvailableSlots(facility);

      const todaySlots =
        facility.slots.filter(
          (slot) =>
            slot.date === getTodayString()
        );

      const hasMaintenance =
        todaySlots.some(
          (slot) =>
            slot.status === "maintenance"
        );

      const allBooked =
        todaySlots.length > 0 &&
        todaySlots.every(
          (slot) =>
            slot.status === "booked"
        );

      let overallStatus = "available";
      let overallStatusText = "Tersedia";

      if (hasMaintenance && availableSlots.length === 0) {
        overallStatus = "maintenance";
        overallStatusText = "Pemeliharaan";
      } else if (
        allBooked ||
        availableSlots.length === 0
      ) {
        overallStatus = "full";
        overallStatusText = "Penuh";
      }

      const slotHTML =
        todaySlots.length > 0
          ? todaySlots
              .map(
                (slot) => `
                  <span
                    class="mini-slot ${getSlotStatusClass(
                      slot.status
                    )}"
                    title="${escapeHTML(
                      getSlotStatusText(
                        slot.status
                      )
                    )}"
                  >
                    ${escapeHTML(slot.time)}
                  </span>
                `
              )
              .join("")
          : `
              <span class="mini-slot">
                Belum ada jadwal
              </span>
            `;

      return `
        <tr class="facility-row">

          <td class="number-cell">
            ${index + 1}
          </td>

          <td>
            <div class="facility-name-cell">

              <div class="facility-icon-small">
                ${getFacilityIcon(facility.type)}
              </div>

              <div>
                <div class="facility-name">
                  ${escapeHTML(facility.name)}
                </div>

                <div class="facility-description">
                  ${escapeHTML(
                    facility.description
                  )}
                </div>
              </div>

            </div>
          </td>

          <td class="location-cell">
            <strong>
              ${escapeHTML(facility.building)}
            </strong>

            <span>
              ${escapeHTML(facility.floor)}
              ·
              ${escapeHTML(facility.room)}
            </span>
          </td>

          <td>
            <span class="type-badge">
              ${escapeHTML(facility.type)}
            </span>
          </td>

          <td class="capacity-cell">
            <strong>
              ${facility.capacity}
            </strong>

            <span>
              orang
            </span>
          </td>

          <td>
            <div class="slot-summary">
              ${slotHTML}
            </div>

            <div class="slot-count">
              ${availableSlots.length}
              slot tersedia
            </div>
          </td>

          <td>
            <span
              class="
                facility-status
                status-${overallStatus}
              "
            >
              <span class="status-dot"></span>
              ${overallStatusText}
            </span>
          </td>

          <td>
            <button
              type="button"
              class="btn-table-book"
              onclick="openBookingModal('${facility.id}')"
              ${
                availableSlots.length === 0
                  ? "disabled"
                  : ""
              }
            >
              ${
                availableSlots.length === 0
                  ? "Tidak Tersedia"
                  : "Pilih Ruang"
              }
            </button>
          </td>

        </tr>
      `;
    })
    .join("");
}

/* ============================================================
   FACILITY STATISTICS
   ============================================================ */

function updateFacilityStatistics() {
  const totalFacilities =
    document.getElementById(
      "stat-total-fasilitas"
    );

  const availableFacilities =
    document.getElementById(
      "stat-tersedia-fasilitas"
    );

  if (totalFacilities) {
    totalFacilities.textContent =
      facilities.length;
  }

  if (availableFacilities) {
    const count = facilities.reduce(
      (total, facility) => {
        return (
          total +
          getAvailableSlots(facility).length
        );
      },
      0
    );

    availableFacilities.textContent = count;
  }
}

/* ============================================================
   RESET FILTER
   ============================================================ */

function resetFacilityFilters() {
  const searchInput =
    document.getElementById("facility-search");

  const typeFilter =
    document.getElementById("filter-type");

  const locationFilter =
    document.getElementById("filter-location");

  const capacityFilter =
    document.getElementById("filter-capacity");

  if (searchInput) {
    searchInput.value = "";
  }

  if (typeFilter) {
    typeFilter.value = "";
  }

  if (locationFilter) {
    locationFilter.value = "";
  }

  if (capacityFilter) {
    capacityFilter.value = "";
  }

  renderFacilities();
}

/* ============================================================
   BOOKING MODAL
   ============================================================ */

function initFacilityModal() {
  const modal =
    document.getElementById("modal-booking");

  if (!modal) {
    return;
  }

  const closeButtons =
    modal.querySelectorAll(
      "[data-close-modal], .modal-close"
    );

  closeButtons.forEach((button) => {
    button.addEventListener("click", () => {
      closeBookingModal();
    });
  });

  modal.addEventListener("click", (event) => {
    if (event.target === modal) {
      closeBookingModal();
    }
  });

  const bookingForm =
    document.getElementById("booking-form");

  if (bookingForm) {
    bookingForm.addEventListener(
      "submit",
      handleBookingSubmit
    );
  }

  const dateInput =
    document.getElementById("booking-date");

  if (dateInput) {
    dateInput.addEventListener("change", () => {
      updateBookingSlots();
    });
  }
}

function openBookingModal(facilityId) {
  const facility =
    getFacilityById(facilityId);

  if (!facility) {
    showToast(
      "Fasilitas tidak ditemukan.",
      "error"
    );

    return;
  }

  selectedFacilityId = facilityId;

  const modal =
    document.getElementById("modal-booking");

  if (!modal) {
    return;
  }

  const facilityName =
    document.getElementById(
      "booking-facility-name"
    );

  const facilityLocation =
    document.getElementById(
      "booking-facility-location"
    );

  const facilityCapacity =
    document.getElementById(
      "booking-facility-capacity"
    );

  if (facilityName) {
    facilityName.textContent =
      facility.name;
  }

  if (facilityLocation) {
    facilityLocation.textContent =
      facility.location;
  }

  if (facilityCapacity) {
    facilityCapacity.textContent =
      `${facility.capacity} orang`;
  }

  const dateInput =
    document.getElementById("booking-date");

  if (dateInput) {
    dateInput.min = getTodayString();

    if (!dateInput.value) {
      dateInput.value =
        getTodayString();
    }
  }

  updateBookingSlots();

  modal.classList.add("active");
  modal.setAttribute("aria-hidden", "false");

  document.body.classList.add(
    "modal-open"
  );
}

function closeBookingModal() {
  const modal =
    document.getElementById("modal-booking");

  if (!modal) {
    return;
  }

  modal.classList.remove("active");
  modal.setAttribute("aria-hidden", "true");

  document.body.classList.remove(
    "modal-open"
  );

  selectedFacilityId = null;

  const form =
    document.getElementById("booking-form");

  if (form) {
    form.reset();
  }
}

function updateBookingSlots() {
  const facility =
    getFacilityById(selectedFacilityId);

  const dateInput =
    document.getElementById("booking-date");

  const slotContainer =
    document.getElementById(
      "booking-slots"
    );

  if (
    !facility ||
    !dateInput ||
    !slotContainer
  ) {
    return;
  }

  const selectedDate =
    dateInput.value;

  const slots =
    facility.slots.filter(
      (slot) =>
        slot.date === selectedDate
    );

  if (slots.length === 0) {
    slotContainer.innerHTML = `
      <div class="no-slots">
        Tidak ada slot pada tanggal ini.
      </div>
    `;

    return;
  }

  slotContainer.innerHTML = slots
    .map(
      (slot) => `
        <label
          class="
            booking-slot-option
            ${slot.status !== "available"
              ? "disabled"
              : ""}
          "
        >

          <input
            type="radio"
            name="booking-slot"
            value="${escapeHTML(slot.id)}"
            ${
              slot.status !== "available"
                ? "disabled"
                : ""
            }
          />

          <span class="booking-slot-content">

            <strong>
              ${escapeHTML(slot.time)}
            </strong>

            <small>
              ${getSlotStatusText(
                slot.status
              )}
            </small>

          </span>

        </label>
      `
    )
    .join("");
}

/* ============================================================
   BOOKING SUBMIT
   ============================================================ */

function handleBookingSubmit(event) {
  event.preventDefault();

  const facility =
    getFacilityById(selectedFacilityId);

  if (!facility) {
    showToast(
      "Fasilitas tidak ditemukan.",
      "error"
    );

    return;
  }

  const form = event.target;

  const date =
    document.getElementById(
      "booking-date"
    )?.value;

  const selectedSlot =
    form.querySelector(
      'input[name="booking-slot"]:checked'
    );

  const purpose =
    document.getElementById(
      "booking-purpose"
    )?.value;

  const name =
    document.getElementById(
      "booking-name"
    )?.value;

  const email =
    document.getElementById(
      "booking-email"
    )?.value;

  const phone =
    document.getElementById(
      "booking-phone"
    )?.value;

  if (!date) {
    showToast(
      "Silakan pilih tanggal reservasi.",
      "error"
    );

    return;
  }

  if (!selectedSlot) {
    showToast(
      "Silakan pilih slot waktu.",
      "error"
    );

    return;
  }

  if (!purpose) {
    showToast(
      "Silakan isi tujuan penggunaan ruangan.",
      "error"
    );

    return;
  }

  const slot =
    facility.slots.find(
      (item) =>
        item.id === selectedSlot.value
    );

  if (!slot) {
    showToast(
      "Slot tidak ditemukan.",
      "error"
    );

    return;
  }

  if (slot.status !== "available") {
    showToast(
      "Slot tersebut sudah tidak tersedia.",
      "error"
    );

    updateBookingSlots();

    return;
  }

  const reservation = {
    id: generateId("reservation"),

    facilityId: facility.id,

    facilityName: facility.name,

    facilityLocation: facility.location,

    date,

    slotId: slot.id,

    time: slot.time,

    purpose,

    name:
      name ||
      "Mahasiswa",

    email:
      email ||
      "",

    phone:
      phone ||
      "",

    status: "pending",

    createdAt:
      new Date().toISOString()
  };

  reservations.push(reservation);

  saveReservations(reservations);

  slot.status = "booked";

  saveFacilities(facilities);

  closeBookingModal();

  renderFacilities();

  updateFacilityStatistics();

  renderReservationHistory();

  showToast(
    "Reservasi berhasil dibuat.",
    "success"
  );
}

/* ============================================================
   RESERVATION HISTORY
   ============================================================ */

function initHistoryModule() {
  renderReservationHistory();
}

function renderReservationHistory() {
  const container =
    document.getElementById(
      "reservation-history"
    );

  if (!container) {
    return;
  }

  if (reservations.length === 0) {
    container.innerHTML = `
      <div class="history-empty">
        <div class="history-empty-icon">
          📅
        </div>

        <h3>
          Belum ada reservasi
        </h3>

        <p>
          Reservasi fasilitas yang kamu buat
          akan muncul di sini.
        </p>
      </div>
    `;

    return;
  }

  const sortedReservations = [
    ...reservations
  ].sort(
    (a, b) =>
      new Date(b.createdAt) -
      new Date(a.createdAt)
  );

  container.innerHTML =
    sortedReservations
      .map((reservation) => {
        const facility =
          getFacilityById(
            reservation.facilityId
          );

        return `
          <div
            class="reservation-card"
            data-reservation-id="${escapeHTML(
              reservation.id
            )}"
          >

            <div class="reservation-card-header">

              <div>
                <span class="reservation-label">
                  Reservasi Fasilitas
                </span>

                <h3>
                  ${escapeHTML(
                    reservation.facilityName
                  )}
                </h3>
              </div>

              <span
                class="
                  reservation-status
                  status-${escapeHTML(
                    reservation.status
                  )}
                "
              >
                ${getReservationStatusText(
                  reservation.status
                )}
              </span>

            </div>

            <div class="reservation-card-body">

              <div class="reservation-info">

                <span>
                  📅
                  ${formatDate(
                    reservation.date
                  )}
                </span>

                <span>
                  🕐
                  ${escapeHTML(
                    reservation.time
                  )}
                </span>

                <span>
                  📍
                  ${escapeHTML(
                    reservation.facilityLocation
                  )}
                </span>

              </div>

              <div class="reservation-purpose">
                <strong>
                  Keperluan:
                </strong>

                ${escapeHTML(
                  reservation.purpose
                )}
              </div>

            </div>

            <div class="reservation-card-footer">

              <button
                type="button"
                class="btn-secondary"
                onclick="showReservationDetail('${reservation.id}')"
              >
                Lihat Detail
              </button>

              ${
                reservation.status !==
                "cancelled"
                  ? `
                    <button
                      type="button"
                      class="btn-danger-outline"
                      onclick="cancelReservation('${reservation.id}')"
                    >
                      Batalkan
                    </button>
                  `
                  : ""
              }

            </div>

          </div>
        `;
      })
      .join("");
}

function getReservationStatusText(status) {
  switch (status) {
    case "pending":
      return "Menunggu Persetujuan";

    case "approved":
      return "Disetujui";

    case "rejected":
      return "Ditolak";

    case "cancelled":
      return "Dibatalkan";

    case "completed":
      return "Selesai";

    default:
      return "Tidak Diketahui";
  }
}

/* ============================================================
   RESERVATION DETAIL
   ============================================================ */

function showReservationDetail(
  reservationId
) {
  const reservation =
    getReservationById(
      reservationId
    );

  if (!reservation) {
    showToast(
      "Data reservasi tidak ditemukan.",
      "error"
    );

    return;
  }

  selectedReservationId =
    reservationId;

  const modal =
    document.getElementById(
      "modal-history-detail"
    );

  if (!modal) {
    return;
  }

  const facilityName =
    modal.querySelector(
      "[data-detail-facility]"
    );

  const location =
    modal.querySelector(
      "[data-detail-location]"
    );

  const date =
    modal.querySelector(
      "[data-detail-date]"
    );

  const time =
    modal.querySelector(
      "[data-detail-time]"
    );

  const purpose =
    modal.querySelector(
      "[data-detail-purpose]"
    );

  const status =
    modal.querySelector(
      "[data-detail-status]"
    );

  if (facilityName) {
    facilityName.textContent =
      reservation.facilityName;
  }

  if (location) {
    location.textContent =
      reservation.facilityLocation;
  }

  if (date) {
    date.textContent =
      formatDate(
        reservation.date
      );
  }

  if (time) {
    time.textContent =
      reservation.time;
  }

  if (purpose) {
    purpose.textContent =
      reservation.purpose;
  }

  if (status) {
    status.textContent =
      getReservationStatusText(
        reservation.status
      );
  }

  modal.classList.add("active");

  modal.setAttribute(
    "aria-hidden",
    "false"
  );

  document.body.classList.add(
    "modal-open"
  );
}

function closeHistoryDetail() {
  const modal =
    document.getElementById(
      "modal-history-detail"
    );

  if (!modal) {
    return;
  }

  modal.classList.remove("active");

  modal.setAttribute(
    "aria-hidden",
    "true"
  );

  document.body.classList.remove(
    "modal-open"
  );

  selectedReservationId = null;
}

/* ============================================================
   CANCEL RESERVATION
   ============================================================ */

function cancelReservation(
  reservationId
) {
  const reservation =
    getReservationById(
      reservationId
    );

  if (!reservation) {
    showToast(
      "Reservasi tidak ditemukan.",
      "error"
    );

    return;
  }

  const confirmed =
    window.confirm(
      "Apakah kamu yakin ingin membatalkan reservasi ini?"
    );

  if (!confirmed) {
    return;
  }

  reservation.status =
    "cancelled";

  const facility =
    getFacilityById(
      reservation.facilityId
    );

  if (facility) {
    const slot =
      facility.slots.find(
        (item) =>
          item.id ===
          reservation.slotId
      );

    if (slot) {
      slot.status =
        "available";
    }
  }

  saveReservations(
    reservations
  );

  saveFacilities(
    facilities
  );

  renderReservationHistory();

  renderFacilities();

  updateFacilityStatistics();

  showToast(
    "Reservasi berhasil dibatalkan.",
    "success"
  );
}

/* ============================================================
   PRACTICUM MODULE
   ============================================================ */

function initPracticumForm() {
  const form =
    document.getElementById(
      "practicum-form"
    );

  if (!form) {
    return;
  }

  form.addEventListener(
    "submit",
    handlePracticumSubmit
  );
}

function handlePracticumSubmit(
  event
) {
  event.preventDefault();

  const form =
    event.target;

  const data = {
    id: generateId("practicum"),

    name:
      form.querySelector(
        '[name="name"]'
      )?.value || "",

    nim:
      form.querySelector(
        '[name="nim"]'
      )?.value || "",

    className:
      form.querySelector(
        '[name="class"]'
      )?.value || "",

    course:
      form.querySelector(
        '[name="course"]'
      )?.value || "",

    facility:
      form.querySelector(
        '[name="facility"]'
      )?.value || "",

    date:
      form.querySelector(
        '[name="date"]'
      )?.value || "",

    time:
      form.querySelector(
        '[name="time"]'
      )?.value || "",

    description:
      form.querySelector(
        '[name="description"]'
      )?.value || "",

    createdAt:
      new Date().toISOString()
  };

  const existing =
    JSON.parse(
      localStorage.getItem(
        "jara_practicum"
      ) || "[]"
    );

  existing.push(data);

  localStorage.setItem(
    "jara_practicum",
    JSON.stringify(existing)
  );

  form.reset();

  showToast(
    "Pengajuan praktikum berhasil dikirim.",
    "success"
  );
}

/* ============================================================
   REPORT MODULE
   ============================================================ */

function submitFacilityReport(data) {
  const report = {
    id: generateId("report"),

    ...data,

    status: "submitted",

    createdAt:
      new Date().toISOString()
  };

  reports.push(report);

  saveReports(reports);

  return report;
}

/* ============================================================
   GLOBAL MODAL EVENTS
   ============================================================ */

document.addEventListener(
  "keydown",
  (event) => {
    if (event.key !== "Escape") {
      return;
    }

    closeBookingModal();
    closeHistoryDetail();
  }
);

/* ============================================================
   INITIALIZATION
   ============================================================ */

document.addEventListener(
  "DOMContentLoaded",
  () => {
    initTabs();

    initFacilityModule();

    initHistoryModule();

    initPracticumForm();

    const detailCloseButtons =
      document.querySelectorAll(
        "#modal-history-detail .modal-close, " +
        "#modal-history-detail [data-close-modal]"
      );

    detailCloseButtons.forEach(
      (button) => {
        button.addEventListener(
          "click",
          closeHistoryDetail
        );
      }
    );

    const detailModal =
      document.getElementById(
        "modal-history-detail"
      );

    if (detailModal) {
      detailModal.addEventListener(
        "click",
        (event) => {
          if (
            event.target ===
            detailModal
          ) {
            closeHistoryDetail();
          }
        }
      );
    }

    console.log(
      "JARA initialized successfully."
    );
  }
);

/* ============================================================
   GLOBAL FUNCTIONS
   ============================================================ */

window.openBookingModal =
  openBookingModal;

window.closeBookingModal =
  closeBookingModal;

window.showReservationDetail =
  showReservationDetail;

window.closeHistoryDetail =
  closeHistoryDetail;

window.cancelReservation =
  cancelReservation;

window.resetFacilityFilters =
  resetFacilityFilters;