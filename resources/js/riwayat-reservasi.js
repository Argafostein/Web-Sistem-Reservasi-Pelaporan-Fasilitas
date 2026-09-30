document.addEventListener('DOMContentLoaded', function () {

    const cancelButtons = document.querySelectorAll('.cancel-button');

    cancelButtons.forEach(function (button) {

        button.addEventListener('click', function (event) {

            const reservationCode =
                button.dataset.reservation;

            const confirmed = confirm(
                `Apakah Anda yakin ingin membatalkan reservasi ini?`
            );

            if (!confirmed) {
                event.preventDefault();
            }

        });

    });

});

window.toggleReservationDetail = function (header) {

    const card = header.closest('.reservation-history-card');

    if (!card) {
        return;
    }

    card.classList.toggle('active');

};