document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('emergencyCancelModal');
    const form = document.getElementById('emergencyCancelForm');
    const reason = document.getElementById('emergencyReason');
    const facilityName = document.getElementById('emergencyFacilityName');

    if (!modal || !form || !reason) return;

    const closeButtons = modal.querySelectorAll(
        '.emergency-modal-close, .emergency-cancel-close'
    );

    function closeModal() {
        modal.classList.remove('show');
        form.reset();
    }

    document.querySelectorAll('.emergency-cancel-button').forEach(button => {
        button.addEventListener('click', function (event) {
            event.stopPropagation();

            form.action = this.dataset.cancelUrl;
            facilityName.textContent =
                this.dataset.facility || 'Fasilitas';

            reason.value = '';
            modal.classList.add('show');

            setTimeout(() => reason.focus(), 100);
        });
    });

    closeButtons.forEach(button => {
        button.addEventListener('click', closeModal);
    });

    modal.addEventListener('click', function (event) {
        if (event.target === modal) {
            closeModal();
        }
    });

    form.addEventListener('submit', function (event) {
        if (!reason.value.trim()) {
            event.preventDefault();
            reason.setCustomValidity('Alasan pembatalan wajib diisi.');
            reason.reportValidity();
            return;
        }

        reason.setCustomValidity('');

        if (!confirm('Apakah Anda yakin ingin membatalkan reservasi ini?')) {
            event.preventDefault();
        }
    });

    reason.addEventListener('input', function () {
        reason.setCustomValidity('');
    });
});

window.toggleReservationDetail = function (header) {

    const card = header.closest('.reservation-history-card');

    if (!card) {
        return;
    }

    card.classList.toggle('active');

};