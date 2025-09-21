/**
 * Theme Switcher with Security and Accessibility Features
 * Supports light/dark mode switching with localStorage persistence
 * and system preference detection
 */

class ThemeSwitcher {
    constructor() {
        this.themes = {
            LIGHT: 'light',
            DARK: 'dark'
        };

        this.storageKey = 'preferred-theme';
        this.mediaQuery = '(prefers-color-scheme: dark)';

        // Initialize theme system
        this.init();
    }

    /**
     * Initialize the theme system
     */
    init() {
        try {
            // Prevent FOUC by setting theme immediately
            this.setInitialTheme();

            // Set up event listeners when DOM is ready
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', () => this.setupEventListeners());
            } else {
                this.setupEventListeners();
            }

            // Listen for system theme changes
            this.watchSystemTheme();

        } catch (error) {
            console.warn('Theme switcher initialization failed:', error);
            // Fallback to light theme
            this.setTheme(this.themes.LIGHT, false);
        }
    }

    /**
     * Set initial theme before DOM loads to prevent FOUC
     */
    setInitialTheme() {
        const savedTheme = this.getSavedTheme();
        const systemTheme = this.getSystemTheme();
        const initialTheme = savedTheme || systemTheme;

        this.setTheme(initialTheme, false);
    }

    /**
     * Get saved theme from localStorage with error handling
     */
    getSavedTheme() {
        try {
            if (!this.isStorageAvailable()) {
                return null;
            }

            const saved = localStorage.getItem(this.storageKey);
            return this.isValidTheme(saved) ? saved : null;

        } catch (error) {
            console.warn('Failed to read theme from localStorage:', error);
            return null;
        }
    }

    /**
     * Get system preferred theme
     */
    getSystemTheme() {
        try {
            return window.matchMedia && window.matchMedia(this.mediaQuery).matches
                ? this.themes.DARK
                : this.themes.LIGHT;
        } catch (error) {
            console.warn('Failed to detect system theme:', error);
            return this.themes.LIGHT;
        }
    }

    /**
     * Set theme on document and save preference
     */
    setTheme(theme, save = true) {
        try {
            if (!this.isValidTheme(theme)) {
                theme = this.themes.LIGHT;
            }

            // Apply theme to document
            if (theme === this.themes.DARK) {
                document.documentElement.setAttribute('data-theme', 'dark');
            } else {
                document.documentElement.removeAttribute('data-theme');
            }

            // Save to localStorage if requested and available
            if (save) {
                this.saveTheme(theme);
            }

            // Dispatch custom event for other components
            this.dispatchThemeChangeEvent(theme);

        } catch (error) {
            console.warn('Failed to set theme:', error);
        }
    }

    /**
     * Save theme preference to localStorage
     */
    saveTheme(theme) {
        try {
            if (this.isStorageAvailable()) {
                localStorage.setItem(this.storageKey, theme);
            }
        } catch (error) {
            console.warn('Failed to save theme preference:', error);
        }
    }

    /**
     * Toggle between light and dark themes
     */
    toggleTheme() {
        const currentTheme = this.getCurrentTheme();
        const newTheme = currentTheme === this.themes.DARK
            ? this.themes.LIGHT
            : this.themes.DARK;

        this.setTheme(newTheme);

        // Announce theme change for screen readers
        this.announceThemeChange(newTheme);
    }

    /**
     * Get current active theme
     */
    getCurrentTheme() {
        return document.documentElement.hasAttribute('data-theme')
            ? this.themes.DARK
            : this.themes.LIGHT;
    }

    /**
     * Set up event listeners for theme toggle buttons
     */
    setupEventListeners() {
        try {
            // Find all theme toggle buttons
            const toggleButtons = document.querySelectorAll('[data-theme-toggle]');

            toggleButtons.forEach(button => {
                button.addEventListener('click', (e) => {
                    e.preventDefault();
                    this.toggleTheme();
                });

                // Add keyboard support
                button.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        this.toggleTheme();
                    }
                });
            });

            // Update button states
            this.updateToggleButtons();

        } catch (error) {
            console.warn('Failed to setup theme toggle event listeners:', error);
        }
    }

    /**
     * Update toggle button states and icons
     */
    updateToggleButtons() {
        try {
            const currentTheme = this.getCurrentTheme();
            const toggleButtons = document.querySelectorAll('[data-theme-toggle]');

            toggleButtons.forEach(button => {
                // Update aria-label for accessibility
                const label = currentTheme === this.themes.DARK
                    ? 'Switch to light mode'
                    : 'Switch to dark mode';
                button.setAttribute('aria-label', label);
                button.setAttribute('title', label);
            });

        } catch (error) {
            console.warn('Failed to update toggle buttons:', error);
        }
    }

    /**
     * Watch for system theme changes
     */
    watchSystemTheme() {
        try {
            if (window.matchMedia) {
                const mediaQuery = window.matchMedia(this.mediaQuery);

                // Use modern addEventListener if available
                if (mediaQuery.addEventListener) {
                    mediaQuery.addEventListener('change', (e) => {
                        // Only auto-switch if user hasn't set a preference
                        if (!this.getSavedTheme()) {
                            const systemTheme = e.matches ? this.themes.DARK : this.themes.LIGHT;
                            this.setTheme(systemTheme, false);
                        }
                    });
                } else if (mediaQuery.addListener) {
                    // Fallback for older browsers
                    mediaQuery.addListener((e) => {
                        if (!this.getSavedTheme()) {
                            const systemTheme = e.matches ? this.themes.DARK : this.themes.LIGHT;
                            this.setTheme(systemTheme, false);
                        }
                    });
                }
            }
        } catch (error) {
            console.warn('Failed to watch system theme changes:', error);
        }
    }

    /**
     * Dispatch custom theme change event
     */
    dispatchThemeChangeEvent(theme) {
        try {
            const event = new CustomEvent('themechange', {
                detail: { theme }
            });
            window.dispatchEvent(event);
        } catch (error) {
            console.warn('Failed to dispatch theme change event:', error);
        }
    }

    /**
     * Announce theme change for screen readers
     */
    announceThemeChange(theme) {
        try {
            // Create temporary announcement element
            const announcement = document.createElement('div');
            announcement.setAttribute('aria-live', 'polite');
            announcement.setAttribute('aria-atomic', 'true');
            announcement.style.position = 'absolute';
            announcement.style.left = '-10000px';
            announcement.style.width = '1px';
            announcement.style.height = '1px';
            announcement.style.overflow = 'hidden';

            const message = `Switched to ${theme} mode`;
            announcement.textContent = message;

            document.body.appendChild(announcement);

            // Remove after announcement
            setTimeout(() => {
                document.body.removeChild(announcement);
            }, 1000);

        } catch (error) {
            console.warn('Failed to announce theme change:', error);
        }
    }

    /**
     * Check if localStorage is available and functional
     */
    isStorageAvailable() {
        try {
            const test = 'theme-test';
            localStorage.setItem(test, test);
            localStorage.removeItem(test);
            return true;
        } catch (error) {
            return false;
        }
    }

    /**
     * Validate theme value
     */
    isValidTheme(theme) {
        return Object.values(this.themes).includes(theme);
    }

    /**
     * Public API for external access
     */
    getAPI() {
        return {
            getCurrentTheme: () => this.getCurrentTheme(),
            setTheme: (theme) => this.setTheme(theme),
            toggleTheme: () => this.toggleTheme(),
            getSavedTheme: () => this.getSavedTheme(),
            getSystemTheme: () => this.getSystemTheme()
        };
    }
}

// Initialize theme switcher immediately to prevent FOUC
window.themeSwitcher = new ThemeSwitcher();

// Expose API globally for external use
window.ThemeAPI = window.themeSwitcher.getAPI();