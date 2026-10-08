document.addEventListener('DOMContentLoaded', function () {

    const modal = document.getElementById('rejectModal');
    const form = document.getElementById('rejectForm');
    const reason = document.getElementById('rejection_reason');

    if (!modal || !form || !reason) {
        return;
    }

    const rejectButtons = document.querySelectorAll('.reject-button');

    rejectButtons.forEach(function (button) {

        button.addEventListener('click', function () {

            const reservationId =
                button.dataset.reservationId;

            form.action =
                `/petugas/reservasi/${reservationId}/reject`;

            modal.classList.add('show');

            reason.focus();
        });

    });

    const closeButton =
        document.querySelector('.reject-modal-close');

    if (closeButton) {
        closeButton.addEventListener('click', function () {
            modal.classList.remove('show');
            form.reset();
        });
    }

    modal.addEventListener('click', function (event) {

        if (event.target === modal) {
            modal.classList.remove('show');
            form.reset();
        }

    });

});