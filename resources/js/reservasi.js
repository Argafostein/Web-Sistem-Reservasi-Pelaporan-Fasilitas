// const tanggalInput = document.getElementById('tanggal');
// const waktuMulai = document.getElementById('waktu-mulai');
// const waktuSelesai = document.getElementById('waktu-selesai');

// const oldStartTime = @json(old('start_time'));
// const oldEndTime = @json(old('end_time'));

// // Membuat daftar waktu setiap 30 menit
// function generateTimeSlots() {
//     const slots = [];

//     for (let hour = 7; hour <= 20; hour++) {

//         for (let minute of [0, 30]) {

//             // Waktu mulai tidak boleh lebih dari 19:30
//             if (hour === 20 && minute === 30) {
//                 continue;
//             }

//             const time =
//                 String(hour).padStart(2, '0') +
//                 ':' +
//                 String(minute).padStart(2, '0');

//             slots.push(time);
//         }
//     }

//     return slots;
// }


// // Mendapatkan waktu sekarang dalam format HH:MM
// function getCurrentTime() {

//     const now = new Date();

//     const hours = String(now.getHours()).padStart(2, '0');
//     const minutes = String(now.getMinutes()).padStart(2, '0');

//     return `${hours}:${minutes}`;
// }


// // Membulatkan waktu sekarang ke slot 30 menit berikutnya
// function getNextAvailableTime() {

//     const now = new Date();

//     let hour = now.getHours();
//     let minute = now.getMinutes();

//     if (minute < 30) {
//         minute = 30;
//     } else {
//         minute = 0;
//         hour++;
//     }

//     if (hour > 20) {
//         return null;
//     }

//     return (
//         String(hour).padStart(2, '0') +
//         ':' +
//         String(minute).padStart(2, '0')
//     );
// }


// // Mengecek apakah tanggal yang dipilih adalah hari ini
// function isToday(selectedDate) {

//     const now = new Date();

//     const today =
//         now.getFullYear() +
//         '-' +
//         String(now.getMonth() + 1).padStart(2, '0') +
//         '-' +
//         String(now.getDate()).padStart(2, '0');

//     return selectedDate === today;
// }


// // Mengisi dropdown waktu mulai
// function updateStartTime() {

//     const selectedDate = tanggalInput.value;

//     waktuMulai.innerHTML = '';
//     waktuSelesai.innerHTML = '';

//     waktuSelesai.disabled = true;

//     if (!selectedDate) {

//         waktuMulai.disabled = true;

//         waktuMulai.innerHTML =
//             '<option value="">Pilih tanggal terlebih dahulu</option>';

//         waktuSelesai.innerHTML =
//             '<option value="">Pilih waktu mulai terlebih dahulu</option>';

//         return;
//     }


//     waktuMulai.disabled = false;

//     const slots = generateTimeSlots();

//     let minimumTime = '07:00';

//     // Jika tanggal adalah hari ini,
//     // waktu harus setelah waktu sekarang
//     if (isToday(selectedDate)) {

//         const nextTime = getNextAvailableTime();

//         if (!nextTime) {

//             waktuMulai.disabled = true;

//             waktuMulai.innerHTML =
//                 '<option value="">Tidak ada waktu tersedia hari ini</option>';

//             return;
//         }

//         minimumTime = nextTime;
//     }


//     waktuMulai.innerHTML =
//         '<option value="">Pilih waktu mulai</option>';


//     slots.forEach(time => {

//         if (time >= minimumTime && time <= '19:30') {

//             const option = document.createElement('option');

//             option.value = time;
//             option.textContent = time;

//             if (time === oldStartTime) {
//                 option.selected = true;
//             }

//             waktuMulai.appendChild(option);
//         }
//     });


//     // Kalau sebelumnya ada waktu mulai
//     // langsung isi waktu selesai
//     if (waktuMulai.value) {
//         updateEndTime();
//     }
// }


// // Mengisi dropdown waktu selesai
// function updateEndTime() {

//     const selectedDate = tanggalInput.value;
//     const startTime = waktuMulai.value;

//     waktuSelesai.innerHTML = '';

//     if (!selectedDate || !startTime) {

//         waktuSelesai.disabled = true;

//         waktuSelesai.innerHTML =
//             '<option value="">Pilih waktu mulai terlebih dahulu</option>';

//         return;
//     }


//     waktuSelesai.disabled = false;

//     waktuSelesai.innerHTML =
//         '<option value="">Pilih waktu selesai</option>';

//     const slots = generateTimeSlots();

//     slots.forEach(time => {

//         // Waktu selesai harus setelah waktu mulai
//         // dan maksimal pukul 20:00
//         if (time > startTime && time <= '20:00') {

//             const option = document.createElement('option');

//             option.value = time;
//             option.textContent = time;

//             if (time === oldEndTime) {
//                 option.selected = true;
//             }

//             waktuSelesai.appendChild(option);
//         }
//     });
// }


// // Ketika tanggal berubah
// tanggalInput.addEventListener('change', function () {

//     // Reset waktu lama
//     waktuMulai.value = '';
//     waktuSelesai.value = '';

//     updateStartTime();
// });


// // Ketika waktu mulai berubah
// waktuMulai.addEventListener('change', function () {

//     waktuSelesai.value = '';

//     updateEndTime();
// });


// // Jalankan saat halaman pertama kali dibuka
// if (tanggalInput.value) {
//     updateStartTime();
// }