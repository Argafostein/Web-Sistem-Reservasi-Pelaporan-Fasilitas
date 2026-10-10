document.addEventListener('DOMContentLoaded', function () {
    // ==================================================
    // DATA HALAMAN
    // ==================================================

    const facilityPage = document.querySelector('.facility-page');

    if (!facilityPage) {
        return;
    }

    const reservations = JSON.parse(
        facilityPage.dataset.reservations || '[]'
    );

    console.log('Reservations:', reservations);

    // ==================================================
    // ELEMENT FILTER DAN FASILITAS
    // ==================================================

    const searchFacility = document.getElementById('searchFacility');
    const searchButton = document.getElementById('searchButton');
    const tipe = document.getElementById('tipe');
    const lokasi = document.getElementById('lokasi');
    const kapasitas = document.getElementById('kapasitas');
    const statusFilter = document.getElementById('status');

    const facilityEmpty =
        document.getElementById('facilityEmpty') ||
        document.querySelector('.facility-empty');

    const facilityPagination =
        document.getElementById('facilityPagination');

    // ==================================================
    // ELEMENT KALENDER
    // ==================================================

    const calendarCard = document.getElementById('calendarCard');
    const selectedFacilityName =
        document.getElementById('selectedFacilityName');

    const miniCalendarDays =
        document.getElementById('miniCalendarDays');

    const scheduleDays = document.getElementById('scheduleDays');
    const dayColumns = document.getElementById('dayColumns');

    const monthTitle = document.getElementById('monthTitle');

    const prevMonth = document.getElementById('prevMonth');
    const nextMonth = document.getElementById('nextMonth');

    const previousWeek = document.getElementById('previousWeek');
    const nextWeek = document.getElementById('nextWeek');

    // ==================================================
    // STATE
    // ==================================================

    let selectedFacilityId = null;
    let currentPage = 1;
    const facilitiesPerPage = 9;

    let selectedDate = new Date();
    selectedDate.setHours(0, 0, 0, 0);

    let currentMonth = new Date(
        selectedDate.getFullYear(),
        selectedDate.getMonth(),
        1
    );

    const facilities = Array.from(
        document.querySelectorAll('.facility-item')
    );

    // ==================================================
    // HELPER
    // ==================================================

    function pad(number) {
        return String(number).padStart(2, '0');
    }

    function formatDate(date) {
        return (
            date.getFullYear() +
            '-' +
            pad(date.getMonth() + 1) +
            '-' +
            pad(date.getDate())
        );
    }

    function formatDisplayDate(date) {
        return date.toLocaleDateString('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        });
    }

    function formatMonth(date) {
        return date.toLocaleDateString('id-ID', {
            month: 'long',
            year: 'numeric'
        });
    }

    function formatDay(date) {
        return date.toLocaleDateString('id-ID', {
            weekday: 'short'
        });
    }

    function getMonday(date) {
        const result = new Date(date);
        const day = result.getDay();

        result.setDate(
            result.getDate() + (day === 0 ? -6 : 1 - day)
        );

        result.setHours(0, 0, 0, 0);

        return result;
    }

    function getFacilityId(facility) {
        return String(
            facility.dataset.id ||
            facility.dataset.facilityId ||
            ''
        );
    }

    function getStatusLabel(status) {
        const normalized = String(status || '')
            .trim()
            .toLowerCase();

        if (normalized === 'available') {
            return 'aktif';
        }

        if (normalized === 'unavailable') {
            return 'perbaikan';
        }

        return normalized;
    }

    function timeToMinutes(time) {
        if (!time) {
            return 0;
        }

        const parts = String(time).split(':');

        return (
            Number(parts[0] || 0) * 60 +
            Number(parts[1] || 0)
        );
    }

    function escapeHtml(value) {
        return String(value ?? '').replace(/[&<>"']/g, function (char) {
            const entities = {
                '&': '&amp;',
                '<': '&lt;',
                '>': '&gt;',
                '"': '&quot;',
                "'": '&#039;'
            };

            return entities[char];
        });
    }

    // ==================================================
    // PILIH FASILITAS
    // Kalender hanya muncul ketika tombol diklik
    // ==================================================

    function selectFacility(facility) {
        if (!facility) {
            return;
        }

        const status = getStatusLabel(facility.dataset.status);

        if (status === 'perbaikan') {
            alert(
                'Fasilitas sedang dalam perbaikan dan tidak dapat digunakan.'
            );
            return;
        }

        selectedFacilityId = getFacilityId(facility);

        if (selectedFacilityName) {
            selectedFacilityName.textContent =
                facility.dataset.nameDisplay ||
                facility.querySelector('h2, h3, .facility-name')
                    ?.textContent
                    ?.trim() ||
                'Fasilitas';
        }

        if (calendarCard) {
            calendarCard.style.display = 'block';

            calendarCard.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }

        renderMiniCalendar();
        renderSchedule();
    }

    // Jangan pasang event klik pada seluruh kartu.
    // Hanya tombol "Lihat Ketersediaan" yang membuka kalender.
    document.querySelectorAll('.facility-select-button').forEach(
        function (button) {
            button.addEventListener('click', function (event) {
                event.preventDefault();
                event.stopPropagation();

                const facility = button.closest('.facility-item');

                if (facility) {
                    selectFacility(facility);
                }
            });
        }
    );

    // ==================================================
    // CEK BENTROK RESERVASI
    // ==================================================

    function isSlotBooked(facilityId, date, startTime, endTime) {
        const requestedStart = timeToMinutes(startTime);
        const requestedEnd = timeToMinutes(endTime);
        const requestedDate = formatDate(date);

        return reservations.some(function (reservation) {
            const reservationFacilityId = String(
                reservation.facility_id ??
                reservation.facilityId ??
                ''
            );

            const reservationDate = String(
                reservation.reservation_date ||
                reservation.date ||
                ''
            ).slice(0, 10);

            const reservationStatus = String(
                reservation.status || ''
            ).toLowerCase();

            if (
                reservationFacilityId !== String(facilityId) ||
                reservationDate !== requestedDate ||
                !['pending', 'approved'].includes(reservationStatus)
            ) {
                return false;
            }

            const bookedStart = timeToMinutes(
                reservation.start_time || reservation.startTime
            );

            const bookedEnd = timeToMinutes(
                reservation.end_time || reservation.endTime
            );

            // Bentrok jika waktu saling bertumpukan.
            return (
                requestedStart < bookedEnd &&
                requestedEnd > bookedStart
            );
        });
    }

    function getReservationsForDay(facilityId, date) {
        const dateString = formatDate(date);

        return reservations.filter(function (reservation) {
            const reservationFacilityId = String(
                reservation.facility_id ??
                reservation.facilityId ??
                ''
            );

            const reservationDate = String(
                reservation.reservation_date ||
                reservation.date ||
                ''
            ).slice(0, 10);

            const status = String(
                reservation.status || ''
            ).toLowerCase();

            return (
                reservationFacilityId === String(facilityId) &&
                reservationDate === dateString &&
                ['pending', 'approved'].includes(status)
            );
        });
    }

    // ==================================================
    // RENDER KALENDER BULAN
    // ==================================================

    function renderMiniCalendar() {
        if (!miniCalendarDays) {
            return;
        }

        if (monthTitle) {
            monthTitle.textContent = formatMonth(currentMonth);
        }

        miniCalendarDays.innerHTML = '';

        const year = currentMonth.getFullYear();
        const month = currentMonth.getMonth();

        const firstDay = new Date(year, month, 1);
        const firstDayOffset =
            firstDay.getDay() === 0 ? 6 : firstDay.getDay() - 1;

        const calendarStart = new Date(year, month, 1 - firstDayOffset);

        const today = new Date();
        today.setHours(0, 0, 0, 0);

        for (let index = 0; index < 42; index++) {
            const date = new Date(calendarStart);
            date.setDate(calendarStart.getDate() + index);

            const button = document.createElement('button');
            button.type = 'button';
            button.className = 'mini-calendar-day';
            button.textContent = date.getDate();

            const isCurrentMonth = date.getMonth() === month;
            const isSelected =
                formatDate(date) === formatDate(selectedDate);
            const isToday = formatDate(date) === formatDate(today);
            const isPast = date < today;

            if (!isCurrentMonth) {
                button.classList.add('other-month');
            }

            if (isSelected) {
                button.classList.add('selected');
            }

            if (isToday) {
                button.classList.add('today');
            }

            if (isPast) {
                button.classList.add('past-date');
            }

            button.addEventListener('click', function () {
                selectedDate = new Date(date);
                selectedDate.setHours(0, 0, 0, 0);

                currentMonth = new Date(
                    selectedDate.getFullYear(),
                    selectedDate.getMonth(),
                    1
                );

                renderMiniCalendar();
                renderSchedule();
            });

            miniCalendarDays.appendChild(button);
        }
    }

    // ==================================================
    // RENDER JADWAL MINGGUAN
    // Senin sampai Minggu
    // ==================================================

    function renderSchedule() {
        const container = dayColumns || scheduleDays;

        if (!container) {
            return;
        }

        if (!selectedFacilityId) {
            container.innerHTML = '';
            return;
        }

        container.innerHTML = '';

        const monday = getMonday(selectedDate);

        const timeSlots = [];

        // Jadwal setiap 30 menit, pukul 07.00–20.00.
        for (let minutes = 7 * 60; minutes < 20 * 60; minutes += 30) {
            timeSlots.push({
                start: pad(Math.floor(minutes / 60)) +
                    ':' + pad(minutes % 60),
                end: pad(Math.floor((minutes + 30) / 60)) +
                    ':' + pad((minutes + 30) % 60)
            });
        }

        const scheduleGrid = document.createElement('div');
        scheduleGrid.className = 'schedule-grid';

        const timeHeader = document.createElement('div');
        timeHeader.className = 'schedule-time-header';
        timeHeader.textContent = 'Waktu';
        scheduleGrid.appendChild(timeHeader);

        const dates = [];

        for (let index = 0; index < 7; index++) {
            const date = new Date(monday);
            date.setDate(monday.getDate() + index);
            dates.push(date);

            const header = document.createElement('div');
            header.className = 'schedule-day-header';

            if (formatDate(date) === formatDate(selectedDate)) {
                header.classList.add('selected');
            }

            header.innerHTML =
                '<span>' + escapeHtml(formatDay(date)) + '</span>' +
                '<strong>' + date.getDate() + '</strong>';

            header.addEventListener('click', function () {
                selectedDate = new Date(date);
                selectedDate.setHours(0, 0, 0, 0);

                currentMonth = new Date(
                    date.getFullYear(),
                    date.getMonth(),
                    1
                );

                renderMiniCalendar();
                renderSchedule();
            });

            scheduleGrid.appendChild(header);
        }

        timeSlots.forEach(function (slot) {
            const timeCell = document.createElement('div');
            timeCell.className = 'schedule-time';
            timeCell.textContent = slot.start;
            scheduleGrid.appendChild(timeCell);

            dates.forEach(function (date) {
                const cell = document.createElement('div');
                cell.className = 'schedule-slot';

                const facility = facilities.find(function (item) {
                    return getFacilityId(item) ===
                        String(selectedFacilityId);
                });

                const facilityStatus = facility
                    ? getStatusLabel(facility.dataset.status)
                    : '';

                const isPast =
                    formatDate(date) < formatDate(new Date()) ||
                    (
                        formatDate(date) === formatDate(new Date()) &&
                        timeToMinutes(slot.end) <=
                            new Date().getHours() * 60 +
                            new Date().getMinutes()
                    );

                const isBooked = isSlotBooked(
                    selectedFacilityId,
                    date,
                    slot.start,
                    slot.end
                );

                if (facilityStatus === 'perbaikan') {
                    cell.classList.add('unavailable');
                    cell.title = 'Fasilitas sedang dalam perbaikan';
                } else if (isPast) {
                    cell.classList.add('past');
                    cell.title = 'Waktu telah berlalu';
                } else if (isBooked) {
                    cell.classList.add('booked');
                    cell.title = 'Waktu sudah dipesan';
                } else {
                    cell.classList.add('available');
                    cell.title = 'Waktu tersedia';
                }

                scheduleGrid.appendChild(cell);
            });
        });

        container.appendChild(scheduleGrid);
    }

    // ==================================================
    // NAVIGASI BULAN
    // ==================================================

    if (prevMonth) {
        prevMonth.addEventListener('click', function () {
            currentMonth.setMonth(currentMonth.getMonth() - 1);
            renderMiniCalendar();
        });
    }

    if (nextMonth) {
        nextMonth.addEventListener('click', function () {
            currentMonth.setMonth(currentMonth.getMonth() + 1);
            renderMiniCalendar();
        });
    }

    // ==================================================
    // NAVIGASI MINGGU
    // ==================================================

    if (previousWeek) {
        previousWeek.addEventListener('click', function () {
            selectedDate.setDate(selectedDate.getDate() - 7);

            currentMonth = new Date(
                selectedDate.getFullYear(),
                selectedDate.getMonth(),
                1
            );

            renderMiniCalendar();
            renderSchedule();
        });
    }

    if (nextWeek) {
        nextWeek.addEventListener('click', function () {
            selectedDate.setDate(selectedDate.getDate() + 7);

            currentMonth = new Date(
                selectedDate.getFullYear(),
                selectedDate.getMonth(),
                1
            );

            renderMiniCalendar();
            renderSchedule();
        });
    }

    // ==================================================
    // FILTER FASILITAS
    // ==================================================

    function filterFacilities() {
        const searchValue = (searchFacility?.value || '')
            .toLowerCase()
            .trim();

        const tipeValue = (tipe?.value || '').toLowerCase();
        const lokasiValue = (lokasi?.value || '').toLowerCase();
        const kapasitasValue = kapasitas?.value || '';
        const selectedStatus = (statusFilter?.value || '')
            .toLowerCase()
            .trim();

        const matchedFacilities = facilities.filter(function (facility) {
            const name = (
                facility.dataset.name ||
                facility.querySelector('h2, h3, .facility-name')
                    ?.textContent ||
                ''
            ).toLowerCase().trim();

            const type = (facility.dataset.type || '')
                .toLowerCase().trim();

            const location = (facility.dataset.location || '')
                .toLowerCase().trim();

            const capacity = parseInt(
                facility.dataset.capacity || '0',
                10
            );

            const facilityStatus = (facility.dataset.status || '')
                .toLowerCase().trim();

            const matchSearch = name.includes(searchValue);
            const matchType = !tipeValue || type.includes(tipeValue);
            const matchLocation =
                !lokasiValue || location.includes(lokasiValue);

            const matchCapacity =
                !kapasitasValue ||
                capacity >= parseInt(kapasitasValue, 10);

            // Status database:
            // available   -> aktif
            // unavailable -> perbaikan
            const normalizedStatus = getStatusLabel(facilityStatus);

            const matchStatus =
                !selectedStatus ||
                normalizedStatus === selectedStatus;

            return (
                matchSearch &&
                matchType &&
                matchLocation &&
                matchCapacity &&
                matchStatus
            );
        });

        const totalPages = Math.ceil(
            matchedFacilities.length / facilitiesPerPage
        );

        if (totalPages === 0) {
            currentPage = 1;
        } else if (currentPage > totalPages) {
            currentPage = totalPages;
        }

        const startIndex = (currentPage - 1) * facilitiesPerPage;
        const endIndex = startIndex + facilitiesPerPage;

        facilities.forEach(function (facility) {
            facility.style.display = 'none';
        });

        matchedFacilities
            .slice(startIndex, endIndex)
            .forEach(function (facility) {
                facility.style.display = '';
            });

        if (facilityEmpty) {
            facilityEmpty.style.display =
                matchedFacilities.length === 0 ? 'block' : 'none';
        }

        renderPagination(matchedFacilities.length);
    }

    // ==================================================
    // PAGINATION
    // ==================================================

    function renderPagination(totalFacilities) {
        if (!facilityPagination) {
            return;
        }

        facilityPagination.innerHTML = '';

        const totalPages = Math.ceil(
            totalFacilities / facilitiesPerPage
        );

        if (totalPages <= 1) {
            return;
        }

        const previousButton = document.createElement('button');
        previousButton.type = 'button';
        previousButton.textContent = 'Sebelumnya';
        previousButton.disabled = currentPage === 1;

        previousButton.addEventListener('click', function () {
            if (currentPage > 1) {
                currentPage--;
                filterFacilities();
            }
        });

        facilityPagination.appendChild(previousButton);

        for (let page = 1; page <= totalPages; page++) {
            const pageButton = document.createElement('button');

            pageButton.type = 'button';
            pageButton.textContent = page;

            if (page === currentPage) {
                pageButton.classList.add('active');
                pageButton.setAttribute('aria-current', 'page');
            }

            pageButton.addEventListener('click', function () {
                currentPage = page;
                filterFacilities();
            });

            facilityPagination.appendChild(pageButton);
        }

        const nextButton = document.createElement('button');
        nextButton.type = 'button';
        nextButton.textContent = 'Berikutnya';
        nextButton.disabled = currentPage === totalPages;

        nextButton.addEventListener('click', function () {
            if (currentPage < totalPages) {
                currentPage++;
                filterFacilities();
            }
        });

        facilityPagination.appendChild(nextButton);
    }

    // ==================================================
    // EVENT FILTER
    // ==================================================

    if (searchButton) {
        searchButton.addEventListener('click', function () {
            currentPage = 1;
            filterFacilities();
        });
    }

    if (searchFacility) {
        searchFacility.addEventListener('input', function () {
            currentPage = 1;
            filterFacilities();
        });
    }

    if (tipe) {
        tipe.addEventListener('change', function () {
            currentPage = 1;
            filterFacilities();
        });
    }

    if (lokasi) {
        lokasi.addEventListener('change', function () {
            currentPage = 1;
            filterFacilities();
        });
    }

    if (kapasitas) {
        kapasitas.addEventListener('change', function () {
            currentPage = 1;
            filterFacilities();
        });
    }

    if (statusFilter) {
        statusFilter.addEventListener('change', function () {
            currentPage = 1;
            filterFacilities();
        });
    }

    // ==================================================
    // INISIALISASI
    // ==================================================

    if (calendarCard) {
        calendarCard.style.display = 'none';
    }

    filterFacilities();

});