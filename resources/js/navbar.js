document.addEventListener('DOMContentLoaded', function () {

    const profileButton = document.getElementById('profileButton');
    const profileDropdown = document.getElementById('profileDropdown');

    if (!profileButton || !profileDropdown) {
        return;
    }

    // Klik tombol profile
    profileButton.addEventListener('click', function (event) {
        event.stopPropagation();

        profileDropdown.classList.toggle('show');
    });

    // Klik di luar dropdown
    document.addEventListener('click', function () {
        profileDropdown.classList.remove('show');
    });

    // Klik di dalam dropdown tidak menutup dropdown
    profileDropdown.addEventListener('click', function (event) {
        event.stopPropagation();
    });

});