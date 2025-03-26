// Theme - user preference
function applyTheme() {
    const isDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    const currentTheme = document.documentElement.getAttribute("data-theme");

    const themeToApply = currentTheme || (isDark ? "dark" : "light");
    document.documentElement.setAttribute("data-theme", themeToApply);

    updateThemeIcon(themeToApply);
}

function updateThemeIcon(theme) {
    const icon = document.getElementById("theme-icon");
    const text = document.getElementById("theme-text");

    if (theme === "dark") {
        icon.classList.remove("fa-sun");
        icon.classList.add("fa-moon", "fa-solid");
        text.textContent = "Dark mode";
    } else {
        icon.classList.remove("fa-moon");
        icon.classList.add("fa-sun", "fa-solid");
        text.textContent = "Light mode";
    }
}

// Theme - toggle button
function toggleTheme() {
    const currentTheme = document.documentElement.getAttribute("data-theme");
    const newTheme = currentTheme === "dark" ? "light" : "dark";
    document.documentElement.setAttribute("data-theme", newTheme);

    updateThemeIcon(newTheme);
}

// Initialize theme on page load
applyTheme();

// Listen for system theme changes
window
    .matchMedia("(prefers-color-scheme: dark)")
    .addEventListener("change", applyTheme);

// Listen for manual toggle
document
    .querySelector(".theme-toggle-label")
    .addEventListener("click", toggleTheme);
