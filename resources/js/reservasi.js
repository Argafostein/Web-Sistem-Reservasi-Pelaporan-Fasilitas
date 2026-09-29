import Alpine from 'alpinejs';
import flatpickr from 'flatpickr';
// import 'flatpickr/dist/flatpickr.min.css';


Alpine.data('timePicker', (initialTime, isEndTime = false) => {

    let parts = initialTime
        ? initialTime.split(':')
        : ['07', '00'];

    return {

        open: false,
        hour: parseInt(parts[0]),
        minute: parseInt(parts[1]),
        hasValue: false,

        activeTab: 'hour',

        error: '',

        isEndTime: isEndTime,


        get timeString() {
        if (!this.hasValue) {
            return ''; 
        }
            return this.pad(this.hour) + ':' + this.pad(this.minute);
        },


        pad(num) {
            return String(num).padStart(2, '0');
        },


        getStartMinutes() {

            const startInput =
                document.querySelector('input[name="start_time"]');

            if (!startInput || !startInput.value) {
                return null;
            }

            const [hour, minute] =
                startInput.value.split(':').map(Number);

            return (hour * 60) + minute;
        },


        isValidTime(hour, minute) {

            const totalMinutes =
                (hour * 60) + minute;

            // Batas 07:00 - 20:00
            if (totalMinutes < 420) {
                return false;
            }

            if (totalMinutes > 1200) {
                return false;
            }


            // Khusus Waktu Selesai
            if (this.isEndTime) {

                const startMinutes =
                    this.getStartMinutes();

                if (
                    startMinutes !== null &&
                    totalMinutes <= startMinutes
                ) {
                    return false;
                }
            }

            return true;
        },


        validateTime() {

            if (!this.isValidTime(this.hour, this.minute)) {

                if (this.isEndTime) {

                    this.error =
                        'Waktu selesai harus lebih dari waktu mulai.';

                }

                return false;
            }

            this.error = '';

            return true;
        },

        checkEndTime(startHour, startMinute) {

            this.$nextTick(() => {

                const endInput =
                    document.querySelector('input[name="end_time"]');

                if (!endInput || !endInput.value) {
                    return;
                }

                const [endHour, endMinute] =
                    endInput.value.split(':').map(Number);

                const startTotal =
                    (startHour * 60) + startMinute;

                const endTotal =
                    (endHour * 60) + endMinute;

                if (endTotal <= startTotal) {

                    // Tampilkan peringatan di bawah box
                    const endElement =
                        endInput.closest('[x-data]');

                    if (endElement) {
                        const alpineData =
                            Alpine.$data(endElement);

                        alpineData.error =
                            'Waktu selesai harus lebih dari waktu mulai.';
                    }

                } else {

                    // Hilangkan peringatan jika sudah valid
                    const endElement =
                        endInput.closest('[x-data]');

                    if (endElement) {
                        const alpineData =
                            Alpine.$data(endElement);

                        alpineData.error = '';
                    }
                }

            });
        },

        /*
        |--------------------------------------------------------------------------
        | NAIK / TURUN JAM
        |--------------------------------------------------------------------------
        */

        adjustHour(val) {

            let newHour =
                (this.hour + val + 24) % 24;

            const totalMinutes =
                (newHour * 60) + this.minute;

            if (this.isEndTime) {

                if (
                    totalMinutes < 450 ||
                    totalMinutes > 1200
                ) {
                    return;
                }

            } else {

                if (
                    totalMinutes < 420 ||
                    totalMinutes > 1170
                ) {
                    return;
                }
            }

            this.hour = newHour;
            this.hasValue = true;

            this.validateTime();

            // Jika yang diubah adalah Waktu Mulai
            if (!this.isEndTime) {

                this.checkEndTime(
                    this.hour,
                    this.minute
                );
            }
        },


        /*
        |--------------------------------------------------------------------------
        | NAIK / TURUN MENIT
        |--------------------------------------------------------------------------
        */

        adjustMinute() {

            let newMinute =
                this.minute === 30 ? 0 : 30;

            const totalMinutes =
                (this.hour * 60) + newMinute;

            if (this.isEndTime) {

                if (
                    totalMinutes < 450 ||
                    totalMinutes > 1200
                ) {
                    return;
                }

            } else {

                if (
                    totalMinutes < 420 ||
                    totalMinutes > 1170
                ) {
                    return;
                }
            }

            this.minute = newMinute;
            this.hasValue = true;

            this.validateTime();

            // Jika yang diubah adalah Waktu Mulai
            if (!this.isEndTime) {

                this.checkEndTime(
                    this.hour,
                    this.minute
                );
            }
        },

        setPreset(hour, minute) {
            this.hour = hour;
            this.minute = minute;
            this.hasValue = true;

            this.validateTime();

            // Jika mengubah waktu mulai
            if (!this.isEndTime) {

                this.checkEndTime(
                    this.hour,
                    this.minute
                );
            }
        },
    };

});


/*
|--------------------------------------------------------------------------
| FLATPICKR - DATE PICKER
|--------------------------------------------------------------------------
*/

flatpickr('#tanggal', {

    dateFormat: 'd-m-Y',
    minDate: 'today',
    allowInput: false,
    disableMobile: true

});


window.Alpine = Alpine;

Alpine.start();

window.validateReservationTime = function () {

    const startInput =
        document.querySelector('input[name="start_time"]');

    const endInput =
        document.querySelector('input[name="end_time"]');

    if (!startInput || !endInput) {
        return true;
    }

    const [startHour, startMinute] =
        startInput.value.split(':').map(Number);

    const [endHour, endMinute] =
        endInput.value.split(':').map(Number);

    const startTotal =
        (startHour * 60) + startMinute;

    const endTotal =
        (endHour * 60) + endMinute;

    if (endTotal <= startTotal) {

        alert(
            '* Waktu selesai harus lebih dari waktu mulai.'
        );

        return false;
    }

    return true;
};