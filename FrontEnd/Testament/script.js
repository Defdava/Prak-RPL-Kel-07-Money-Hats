// Sidebar functionality
const sidebar = document.getElementById('sidebar');
const hamburger = document.getElementById('hamburger');
const closeSidebar = document.getElementById('closeSidebar');
const mainContent = document.getElementById('mainContent');
const overlay = document.getElementById('overlay');

function toggleSidebar() {
    sidebar.classList.toggle('active');
    overlay.style.display = sidebar.classList.contains('active') ? 'block' : 'none';
    
    // Only shift content on larger screens
    if (window.innerWidth > 992) {
        mainContent.classList.toggle('shifted');
    }
}

hamburger.addEventListener('click', toggleSidebar);
closeSidebar.addEventListener('click', toggleSidebar);
overlay.addEventListener('click', toggleSidebar);

// Menu item active state
const menuItems = document.querySelectorAll('.menu-item');
menuItems.forEach(item => {
    item.addEventListener('click', function() {
        menuItems.forEach(i => i.classList.remove('active'));
        this.classList.add('active');
        
        // Close sidebar on mobile after clicking a menu item
        if (window.innerWidth <= 992) {
            toggleSidebar();
        }
    });
});

// Modal functionality
const modal = document.getElementById('transactionModal');
const addTransactionBtn = document.getElementById('addTransactionBtn');
const closeModalBtn = document.querySelector('.close-modal');
const cancelBtn = document.querySelector('.btn-cancel');

addTransactionBtn.addEventListener('click', () => {
    modal.style.display = 'flex';
});

closeModalBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

cancelBtn.addEventListener('click', () => {
    modal.style.display = 'none';
});

// Close modal if clicked outside
window.addEventListener('click', (event) => {
    if (event.target === modal) {
        modal.style.display = 'none';
    }
});

// Tabs functionality
const tabs = document.querySelectorAll('.chart-tab');
tabs.forEach(tab => {
    tab.addEventListener('click', () => {
        tabs.forEach(t => t.classList.remove('active'));
        tab.classList.add('active');
    });
});

// Initialize current date on the date input
document.addEventListener('DOMContentLoaded', () => {
    const dateInput = document.getElementById('date');
    const today = new Date();
    const year = today.getFullYear();
    const month = String(today.getMonth() + 1).padStart(2, '0');
    const day = String(today.getDate()).padStart(2, '0');
    dateInput.value = `${year}-${month}-${day}`;
});