document.addEventListener('DOMContentLoaded', function () {

    const cancelButtons = document.querySelectorAll('.cancel-button');

    cancelButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const reservationCode =
                button.dataset.reservation;

            const confirmed = confirm(
                `Apakah Anda yakin ingin membatalkan reservasi ${reservationCode}?`
            );

            if (!confirmed) {
                return;
            }

            alert(
                `Pembatalan reservasi ${reservationCode} akan diproses oleh sistem.`
            );

        });

    });

});