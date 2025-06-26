import './bootstrap';

// resources/js/app.js

// Import jQuery jika Anda masih menggunakannya di tempat lain atau untuk Bootstrap
// import $ from 'jquery';
// window.$ = window.jQuery = $;

// Jika Anda menggunakan Bootstrap JS, pastikan diimport juga
// import 'bootstrap'; // atau bagian-bagian tertentu seperti import 'bootstrap/js/dist/dropdown';

document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebarToggle'); // Tombol di header utama
    const sidebarClose = document.getElementById('sidebarClose'); // Tombol di sidebar header
    const sidebar = document.querySelector('.sidebar');
    const mainContent = document.querySelector('.main-content');

    // Function to toggle sidebar classes for desktop
    function toggleDesktopSidebar() {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    }

    // Function to toggle sidebar classes for mobile (overlay)
    function toggleMobileSidebar() {
        sidebar.classList.toggle('active');
        if (sidebar.classList.contains('active')) {
            // Create and show overlay
            const overlay = document.createElement('div');
            overlay.classList.add('overlay');
            document.body.appendChild(overlay);

            overlay.addEventListener('click', function() {
                toggleMobileSidebar(); // Close sidebar when overlay clicked
            });
        } else {
            // Remove overlay
            const existingOverlay = document.querySelector('.overlay');
            if (existingOverlay) {
                existingOverlay.remove();
            }
        }
    }

    // Event listener for sidebar toggle button (from main header)
    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                toggleMobileSidebar();
            } else {
                toggleDesktopSidebar();
            }
        });
    }

    // Event listener for sidebar close button (inside sidebar header)
    if (sidebarClose) {
        sidebarClose.addEventListener('click', function() {
            if (window.innerWidth <= 768) {
                toggleMobileSidebar(); // Close for mobile view
            }
            // Di desktop, tombol ini tidak akan terlihat, jadi tidak perlu aksi lain
        });
    }

    // Adjust sidebar on window resize
    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            // Ensure sidebar and main-content are in default state for desktop
            sidebar.classList.remove('collapsed', 'active');
            mainContent.classList.remove('expanded');
            const existingOverlay = document.querySelector('.overlay');
            if (existingOverlay) {
                existingOverlay.remove();
            }
        } else {
            // For mobile, if sidebar is not active, ensure it's hidden
            if (!sidebar.classList.contains('active')) {
                sidebar.classList.add('collapsed'); // Keep it hidden if not explicitly opened
            }
        }
    });

    // Initialize sidebar state on load based on screen size
    if (window.innerWidth <= 768) {
        sidebar.classList.add('collapsed'); // Hide sidebar by default on mobile
    }
});