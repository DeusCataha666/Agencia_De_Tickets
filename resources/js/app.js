import './bootstrap';

// Dark Mode Initialization
function applyTheme(isDark) {
    if (isDark) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
    // Sync icon if present
    const iconLight = document.getElementById('iconLight');
    const iconDark  = document.getElementById('iconDark');
    if (iconLight && iconDark) {
        if (isDark) {
            iconLight.classList.add('hidden');
            iconDark.classList.remove('hidden');
        } else {
            iconLight.classList.remove('hidden');
            iconDark.classList.add('hidden');
        }
    }
}

const prefersDark = localStorage.theme === 'dark' ||
    (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches);
applyTheme(prefersDark);

// Run again after DOM is ready so icons are available
document.addEventListener('DOMContentLoaded', () => {
    applyTheme(document.documentElement.classList.contains('dark'));
});

// Function to toggle dark mode
window.toggleDarkMode = function() {
    const isDark = !document.documentElement.classList.contains('dark');
    applyTheme(isDark);
    localStorage.theme = isDark ? 'dark' : 'light';
};
