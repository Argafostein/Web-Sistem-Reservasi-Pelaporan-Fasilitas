document.addEventListener('DOMContentLoaded', function () {

    const facilityPage = document.querySelector('.facility-page');

    const reservations = JSON.parse(
        facilityPage.dataset.reservations || '[]'
    );

    console.log('Reservations:', reservations);

    // ==========================================
    // ELEMENT
    // ==========================================

    const searchFacility =
        document.getElementById('searchFacility');

    const tipe =
        document.getElementById('tipe');

    const lokasi =
        document.getElementById('lokasi');

    const kapasitas =
        document.getElementById('kapasitas');

    const searchButton =
        document.getElementById('searchButton');

    const facilityList =
        document.getElementById('facilityList');

    const facilityEmpty =
        document.getElementById('facilityEmpty');

    const calendarCard =
        document.getElementById('calendarCard');

    const selectedFacilityName =
        document.getElementById('selectedFacilityName');

    const miniCalendarDays =
        document.getElementById('miniCalendarDays');

    const scheduleDays =
        document.getElementById('scheduleDays');

    const dayColumns =
        document.getElementById('dayColumns');

    const monthTitle =
        document.getElementById('monthTitle');

    const prevMonth =
        document.getElementById('prevMonth');

    const nextMonth =
        document.getElementById('nextMonth');

    const previousWeek =
        document.getElementById('previousWeek');

    const nextWeek =
        document.getElementById('nextWeek');


    // ==========================================
    // STATE
    // ==========================================

    let selectedFacilityId = null;
    let currentPage = 1;
    const facilitiesPerPage = 9;

    let selectedDate = new Date();

    let currentMonth = new Date(
        selectedDate.getFullYear(),
        selectedDate.getMonth(),
        1
    );


    // ==========================================
    // DATA
    // ==========================================

    const monthNames = [
        'Januari',
        'Februari',
        'Maret',
        'April',
        'Mei',
        'Juni',
        'Juli',
        'Agustus',
        'September',
        'Oktober',
        'November',
        'Desember'
    ];

    const dayNames = [
        'MIN',
        'SEN',
        'SEL',
        'RAB',
        'KAM',
        'JUM',
        'SAB'
    ];

    const timeSlots = [
        '07:00', '07:30',
        '08:00', '08:30',
        '09:00', '09:30',
        '10:00', '10:30',
        '11:00', '11:30',
        '12:00', '12:30',
        '13:00', '13:30',
        '14:00', '14:30',
        '15:00', '15:30',
        '16:00', '16:30',
        '17:00', '17:30',
        '18:00', '18:30',
        '19:00', '19:30',
    ];


    // ==========================================
    // HELPER
    // ==========================================

    function sameDate(date1, date2) {
        return (
            date1.getFullYear() === date2.getFullYear() &&
            date1.getMonth() === date2.getMonth() &&
            date1.getDate() === date2.getDate()
        );
    }


    function formatDate(date) {
        const year = date.getFullYear();

        const month = String(
            date.getMonth() + 1
        ).padStart(2, '0');

        const day = String(
            date.getDate()
        ).padStart(2, '0');

        return `${year}-${month}-${day}`;
    }


    function timeToMinutes(time) {

        if (!time) {
            return 0;
        }

        const parts =
            time.substring(0, 5).split(':');

        const hour =
            parseInt(parts[0], 10);

        const minute =
            parseInt(parts[1], 10);

        return (hour * 60) + minute;
    }


    // ==========================================
    // FILTER FACILITY
    // ==========================================

    function filterFacilities() {
        const searchValue = searchFacility.value.toLowerCase().trim();
        const tipeValue = tipe.value.toLowerCase();
        const lokasiValue = lokasi.value.toLowerCase();
        const kapasitasValue = kapasitas.value;

        const facilities = Array.from(
            document.querySelectorAll('.facility-item')
        );

        const matchedFacilities = facilities.filter(function (facility) {
            const name = facility.dataset.name;
            const type = facility.dataset.type;
            const location = facility.dataset.location;
            const capacity = parseInt(facility.dataset.capacity, 10);

            const matchSearch = name.includes(searchValue);
            const matchType = !tipeValue || type.includes(tipeValue);
            const matchLocation =
                !lokasiValue || location.includes(lokasiValue);
            const matchCapacity =
                !kapasitasValue ||
                capacity >= parseInt(kapasitasValue, 10);

            return (
                matchSearch &&
                matchType &&
                matchLocation &&
                matchCapacity
            );
        });

        const totalPages = Math.ceil(
            matchedFacilities.length / facilitiesPerPage
        );

        if (currentPage > totalPages && totalPages > 0) {
            currentPage = totalPages;
        }

        const startIndex =
            (currentPage - 1) * facilitiesPerPage;

        const endIndex =
            startIndex + facilitiesPerPage;

        facilities.forEach(function (facility) {
            facility.style.display = 'none';
        });

        matchedFacilities
            .slice(startIndex, endIndex)
            .forEach(function (facility) {
                facility.style.display = 'block';
            });

        facilityEmpty.style.display =
            matchedFacilities.length === 0
                ? 'block'
                : 'none';

        renderPagination(matchedFacilities.length);
    }

    //PAGINATION

    function renderPagination(totalFacilities) {
        let pagination = document.getElementById('facilityPagination');

        if (!pagination) {
            pagination = document.createElement('div');
            pagination.id = 'facilityPagination';
            pagination.classList.add('facility-pagination');

            facilityList.parentNode.insertBefore(
                pagination,
                facilityList.nextSibling
            );
        }

        pagination.innerHTML = '';

        const totalPages = Math.ceil(
            totalFacilities / facilitiesPerPage
        );

        // Tidak perlu pagination kalau hanya 1 halaman
        if (totalPages <= 1) {
            pagination.style.display = 'none';
            return;
        }

        pagination.style.display = 'flex';

        for (let page = 1; page <= totalPages; page++) {
            const button = document.createElement('button');

            button.type = 'button';
            button.textContent = page;

            if (page === currentPage) {
                button.classList.add('active');
            }

            button.addEventListener('click', function () {
                currentPage = page;
                filterFacilities();

                facilityList.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            });

            pagination.appendChild(button);
        }
    }

    // ==========================================
    // SELECT FACILITY
    // ==========================================

    function selectFacility(facilityElement) {

        selectedFacilityId =
            facilityElement.dataset.id;


        const facilityName =
            facilityElement.dataset.name;


        selectedFacilityName.textContent =
            facilityName;


        // Tampilkan calendar

        calendarCard.style.display =
            'block';


        // Scroll ke calendar

        calendarCard.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });


        renderMiniCalendar();

        renderSchedule();
    }


    // ==========================================
    // CLICK FACILITY CARD
    // ==========================================

    document
        .querySelectorAll('.facility-item')
        .forEach(function (facility) {

            facility.addEventListener(
                'click',
                function () {

                    selectFacility(facility);

                }
            );

        });


    // ==========================================
    // SEARCH BUTTON
    // ==========================================

    searchButton.addEventListener(
        'click',
        function () {

            filterFacilities();

        }
    );


    // Filter langsung ketika mengetik

    searchFacility.addEventListener(
        'input',
        filterFacilities
    );


    tipe.addEventListener(
        'change',
        filterFacilities
    );


    lokasi.addEventListener(
        'change',
        filterFacilities
    );


    kapasitas.addEventListener(
        'change',
        filterFacilities
    );


    // ==========================================
    // CHECK BOOKED SLOT
    // ==========================================

    function isSlotBooked(date, time) {

        if (!selectedFacilityId) {
            return false;
        }


        const dateString =
            formatDate(date);


        const slotStart =
            timeToMinutes(time);


        const slotEnd =
            slotStart + 30;


        return reservations.some(
            function (reservation) {

                // Hanya fasilitas yang dipilih

                if (
                    String(reservation.facility_id) !==
                    String(selectedFacilityId)
                ) {
                    return false;
                }


                // Pending dan approved dianggap terisi

                if (
                    reservation.status !== 'pending' &&
                    reservation.status !== 'approved'
                ) {
                    return false;
                }


                // Cek tanggal

                if (
                    reservation.reservation_date !==
                    dateString
                ) {
                    return false;
                }


                const reservationStart =
                    timeToMinutes(
                        reservation.start_time
                    );


                const reservationEnd =
                    timeToMinutes(
                        reservation.end_time
                    );


                // Cek overlap waktu

                return (
                    slotStart < reservationEnd &&
                    slotEnd > reservationStart
                );

            }
        );
    }


    // ==========================================
    // MINI CALENDAR
    // ==========================================

    function renderMiniCalendar() {

        miniCalendarDays.innerHTML = '';


        monthTitle.textContent =
            monthNames[currentMonth.getMonth()] +
            ' ' +
            currentMonth.getFullYear();


        const firstDay = new Date(
            currentMonth.getFullYear(),
            currentMonth.getMonth(),
            1
        );


        const lastDay = new Date(
            currentMonth.getFullYear(),
            currentMonth.getMonth() + 1,
            0
        );


        const startDay =
            firstDay.getDay() === 0
                ? 6
                : firstDay.getDay() - 1;


        // Hari bulan sebelumnya

        for (
            let i = startDay - 1;
            i >= 0;
            i--
        ) {

            const date = new Date(
                currentMonth.getFullYear(),
                currentMonth.getMonth(),
                -i
            );

            createMiniDay(date, true);
        }


        // Hari bulan sekarang

        for (
            let day = 1;
            day <= lastDay.getDate();
            day++
        ) {

            const date = new Date(
                currentMonth.getFullYear(),
                currentMonth.getMonth(),
                day
            );

            createMiniDay(date, false);
        }


        // Sisa cell

        const totalCells =
            miniCalendarDays.children.length;


        for (
            let i = 1;
            i <= 42 - totalCells;
            i++
        ) {

            const date = new Date(
                currentMonth.getFullYear(),
                currentMonth.getMonth() + 1,
                i
            );

            createMiniDay(date, true);
        }
    }


    function createMiniDay(date, muted) {

        const day =
            document.createElement('span');


        day.classList.add(
            'calendar-day'
        );


        day.textContent =
            date.getDate();


        if (muted) {
            day.classList.add('muted');
        }


        if (sameDate(date, new Date())) {

            day.classList.add('today');

        }


        if (sameDate(date, selectedDate)) {

            day.classList.add('selected');

        }


        day.addEventListener(
            'click',
            function () {

                selectedDate =
                    new Date(date);


                currentMonth =
                    new Date(
                        date.getFullYear(),
                        date.getMonth(),
                        1
                    );


                renderMiniCalendar();

                renderSchedule();

            }
        );


        miniCalendarDays.appendChild(day);
    }


    // ==========================================
    // GET MONDAY
    // ==========================================

    function getMonday(date) {

        const result =
            new Date(date);


        const day =
            result.getDay();


        const difference =
            day === 0
                ? -6
                : 1 - day;


        result.setDate(
            result.getDate() + difference
        );


        return result;
    }


    // ==========================================
    // RENDER SCHEDULE
    // ==========================================

    function renderSchedule() {

        if (!selectedFacilityId) {
            return;
        }


        scheduleDays.innerHTML = '';

        dayColumns.innerHTML = '';


        const monday =
            getMonday(selectedDate);


        for (
            let i = 0;
            i < 7;
            i++
        ) {

            const date =
                new Date(monday);


            date.setDate(
                monday.getDate() + i
            );


            // ==========================
            // HEADER HARI
            // ==========================

            const header =
                document.createElement('div');


            header.classList.add(
                'schedule-day'
            );


            const dayName =
                document.createElement('span');


            dayName.classList.add(
                'schedule-day-name'
            );


            dayName.textContent =
                dayNames[date.getDay()];


            const dayNumber =
                document.createElement('span');


            dayNumber.classList.add(
                'schedule-day-number'
            );


            dayNumber.textContent =
                date.getDate();


            if (
                sameDate(
                    date,
                    selectedDate
                )
            ) {

                header.classList.add(
                    'selected'
                );

            }


            header.appendChild(dayName);

            header.appendChild(dayNumber);

            scheduleDays.appendChild(header);


            // ==========================
            // KOLOM JAM
            // ==========================

            const column =
                document.createElement('div');


            column.classList.add(
                'day-column'
            );


            timeSlots.forEach(
                function (time) {

                    const cell =
                        document.createElement('div');


                    cell.classList.add(
                        'day-cell'
                    );


                    if (
                        isSlotBooked(
                            date,
                            time
                        )
                    ) {

                        cell.classList.add(
                            'booked'
                        );

                        cell.title =
                            'Sudah dipesan';

                    } else {

                        cell.classList.add(
                            'available'
                        );

                        const [hour, minute] = time.split(':').map(Number);

                        const endMinute = minute + 30;
                        const endHour = hour + Math.floor(endMinute / 60);
                        const finalMinute = endMinute % 60;

                        const endTime =
                            `${String(endHour).padStart(2, '0')}:${String(finalMinute).padStart(2, '0')}`;

                        cell.title =
                            `${time.replace(':', '.')} - ${endTime.replace(':', '.')} tersedia`;

                    }


                    cell.addEventListener(
                        'click',
                        function () {

                            if (
                                cell.classList.contains(
                                    'booked'
                                )
                            ) {

                                return;

                            }


                            selectedDate =
                                new Date(date);


                            renderMiniCalendar();

                            renderSchedule();

                        }
                    );


                    column.appendChild(cell);

                }
            );


            dayColumns.appendChild(column);

        }
    }


    // ==========================================
    // MONTH NAVIGATION
    // ==========================================

    prevMonth.addEventListener(
        'click',
        function () {

            currentMonth.setMonth(
                currentMonth.getMonth() - 1
            );

            renderMiniCalendar();

        }
    );


    nextMonth.addEventListener(
        'click',
        function () {

            currentMonth.setMonth(
                currentMonth.getMonth() + 1
            );

            renderMiniCalendar();

        }
    );


    // ==========================================
    // WEEK NAVIGATION
    // ==========================================

    previousWeek.addEventListener(
        'click',
        function () {

            selectedDate.setDate(
                selectedDate.getDate() - 7
            );


            currentMonth =
                new Date(
                    selectedDate.getFullYear(),
                    selectedDate.getMonth(),
                    1
                );


            renderMiniCalendar();

            renderSchedule();

        }
    );


    nextWeek.addEventListener(
        'click',
        function () {

            selectedDate.setDate(
                selectedDate.getDate() + 7
            );


            currentMonth =
                new Date(
                    selectedDate.getFullYear(),
                    selectedDate.getMonth(),
                    1
                );


            renderMiniCalendar();

            renderSchedule();

        }
    );


    // ==========================================
    // INITIAL
    // ==========================================

    filterFacilities();

});