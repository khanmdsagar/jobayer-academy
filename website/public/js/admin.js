document.addEventListener('DOMContentLoaded', function () {
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebarToggle');
    const overlay = document.getElementById('overlay');
    const mainContent = document.getElementById('mainContent');

    // Toggle sidebar on mobile
    sidebarToggle.addEventListener('click', function () {
        sidebar.classList.toggle('mobile-open');
        overlay.classList.toggle('active');
    });

    // Close sidebar when clicking on overlay
    overlay.addEventListener('click', function () {
        sidebar.classList.remove('mobile-open');
        overlay.classList.remove('active');
    });

    // Add active class to clicked nav items
    const navLinks = document.querySelectorAll('.nav-links a');
    navLinks.forEach(link => {
        link.addEventListener('click', function () {
            navLinks.forEach(l => l.classList.remove('active'));
            this.classList.add('active');

            // On mobile, close sidebar after clicking a link
            if (window.innerWidth <= 992) {
                sidebar.classList.remove('mobile-open');
                overlay.classList.remove('active');
            }
        });
    });

    // Pagination button interaction
    const paginationButtons = document.querySelectorAll('.pagination-controls button');
    paginationButtons.forEach(button => {
        button.addEventListener('click', function () {
            if (!this.querySelector('i')) {
                paginationButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
            }
        });
    });

    // Handle window resize
    window.addEventListener('resize', function () {
        if (window.innerWidth > 992) {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('active');
        }
    });
});

