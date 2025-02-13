const sidebarToggle = document.querySelector("#sidebar-toggle");
sidebarToggle.addEventListener("click",function(){
    document.querySelector("#sidebar").classList.toggle("collapsed");
});

document.addEventListener('DOMContentLoaded', function() {
    const sidebarToggle = document.getElementById('sidebar-toggle');
    const sidebarClose = document.getElementById('sidebar-close');
    const sidebar = document.getElementById('sidebar');
    const wrapper = document.querySelector('.wrapper');
    
    const overlay = document.createElement('div');
    overlay.className = 'sidebar-overlay';
    wrapper.appendChild(overlay);

    function toggleSidebar() {
        console.log('Toggling sidebar');
        sidebar.classList.toggle('active');
        overlay.classList.toggle('active');
    }

    sidebarToggle.addEventListener('click', function(e) {
        e.preventDefault();
        toggleSidebar();
    });

    sidebarClose.addEventListener('click', function(e) {
        e.preventDefault();
        console.log('close');
        toggleSidebar();
    });

    overlay.addEventListener('click', function() {
        toggleSidebar();
    });

    window.addEventListener('resize', function() {
        if (window.innerWidth > 768) {
            sidebar.classList.remove('active');
            overlay.classList.remove('active');
        }
    });
});