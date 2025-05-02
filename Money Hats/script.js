// DOM Elements
const sidebar = document.getElementById('sidebar');
const toggleSidebarBtn = document.getElementById('toggleSidebar');
const darkModeToggle = document.getElementById('darkModeToggle');
const profileButton = document.getElementById('profileButton');
const profileDropdown = document.getElementById('profileDropdown');
const addTransactionBtn = document.getElementById('addTransactionBtn');

// Toggle sidebar
toggleSidebarBtn.addEventListener('click', () => {
    sidebar.classList.toggle('collapsed');
    document.body.classList.toggle('sidebar-collapsed');
});

// Dark mode toggle
darkModeToggle.addEventListener('click', () => {
    document.body.dataset.theme = document.body.dataset.theme === 'dark' ? 'light' : 'dark';
    // Save preference to localStorage
    localStorage.setItem('theme', document.body.dataset.theme);
});

// Check for saved theme preference
const savedTheme = localStorage.getItem('theme');
if (savedTheme) {
    document.body.dataset.theme = savedTheme;
}

// Profile dropdown
profileButton.addEventListener('click', (e) => {
    e.stopPropagation();
    profileDropdown.classList.toggle('show');
});

// Close dropdown when clicking outside
document.addEventListener('click', () => {
    profileDropdown.classList.remove('show');
});

// Add transaction modal
addTransactionBtn.addEventListener('click', () => {
    // Modal functionality would go here
    console.log('Add transaction clicked');
});

// Menu item active state
const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        menuItems.forEach(i => i.classList.remove('active'));
        this.classList.add('active');
    });
});

// Chart tabs functionality
const chartTabs = document.querySelectorAll('.chart-tab');
chartTabs.forEach(tab => {
    tab.addEventListener('click', () => {
        chartTabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
    });
});

// Initialize date picker with today's date
document.addEventListener('DOMContentLoaded', () => {
    const dateInputs = document.querySelectorAll('input[type="date"]');
    const today = new Date().toISOString().split('T')[0];
    dateInputs.forEach(input => {
        input.value = today;
    });
});