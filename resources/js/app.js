import './bootstrap';

const iconSun = `<svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-4 w-4"><path d="M12 17a5 5 0 1 0 0-10a5 5 0 0 0 0 10Z" stroke="currentColor" stroke-width="1.8"/><path d="M12 2v2.5M12 19.5V22M4.22 4.22 6 6M18 18l1.78 1.78M2 12h2.5M19.5 12H22M4.22 19.78 6 18M18 6l1.78-1.78" stroke="currentColor" stroke-width="1.8" stroke-linecap="round"/></svg>`;
const iconMoon = `<svg viewBox="0 0 24 24" fill="none" aria-hidden="true" class="h-4 w-4"><path d="M21 15.5A8.5 8.5 0 0 1 8.5 3a6.8 6.8 0 0 0 8.7 12.5A6.8 6.8 0 0 0 21 15.5Z" stroke="currentColor" stroke-width="1.8" stroke-linejoin="round"/></svg>`;

function setTheme(theme) {
    document.documentElement.setAttribute('data-theme', theme);
    localStorage.setItem('theme', theme);
    const icon = document.querySelector('[data-theme-icon]');
    if (icon) icon.innerHTML = theme === 'dark' ? iconSun : iconMoon;
}

const savedTheme = localStorage.getItem('theme');
if (savedTheme === 'dark' || savedTheme === 'light') {
    setTheme(savedTheme);
} else {
    setTheme(window.matchMedia?.('(prefers-color-scheme: dark)')?.matches ? 'dark' : 'light');
}

document.addEventListener('click', (e) => {
    const target = e.target?.closest?.('[data-theme-toggle]');
    if (!target) return;
    const current = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
    setTheme(current === 'dark' ? 'light' : 'dark');
});

// Sidebar toggle functionality - IMPROVED
document.addEventListener('click', (e) => {
    const trigger = e.target?.closest?.('[data-toggle-target]');
    if (!trigger) return;
    
    const selectors = trigger.getAttribute('data-toggle-target');
    if (!selectors) return;
    
    const selectorList = selectors.split(',');
    let isCurrentlyHidden = null;
    
    selectorList.forEach((selector) => {
        const panel = document.querySelector(selector.trim());
        if (!panel) return;
        
        if (isCurrentlyHidden === null) {
            isCurrentlyHidden = panel.classList.contains('hidden') || panel.classList.contains('-translate-x-full');
        }
        
        if (panel.classList.contains('hidden')) {
            panel.classList.toggle('hidden', !isCurrentlyHidden);
        }
        
        if (panel.classList.contains('-translate-x-full')) {
            panel.classList.toggle('-translate-x-full', !isCurrentlyHidden);
        }
    });
});

// Close sidebar when clicking outside on mobile
document.addEventListener('click', (e) => {
    const sidebar = document.getElementById('adminSidebar');
    const overlay = document.getElementById('sidebarOverlay');
    
    if (!sidebar || !overlay) return;
    
    // If clicking the overlay, close sidebar
    if (e.target === overlay) {
        sidebar.classList.add('-translate-x-full');
        overlay.classList.add('hidden');
    }
    
    // If clicking a sidebar link on mobile, close sidebar
    if (window.innerWidth < 1024) {
        const sidebarLink = e.target.closest('#adminSidebar a');
        if (sidebarLink) {
            setTimeout(() => {
                sidebar.classList.add('-translate-x-full');
                overlay.classList.add('hidden');
            }, 150);
        }
    }
});

