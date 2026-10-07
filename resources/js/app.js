import './bootstrap';

const menuToggle = document.querySelector('.menu-toggle');
const mobileMenu = document.querySelector('#mobile-menu');
const mobileMenuPanel = mobileMenu?.querySelector('.mobile-menu__panel');
const mobileMenuClose = mobileMenu?.querySelector('.mobile-menu__close');
const mobileNavigation = mobileMenu?.querySelector('#mobile-navigation');

const closeDropdown = (dropdown, returnFocus = false) => {
    const button = dropdown.querySelector('.dropdown-toggle');

    dropdown.classList.remove('is-expanded');
    button?.setAttribute('aria-expanded', 'false');

    if (returnFocus && button instanceof HTMLButtonElement) {
        button.focus();
    }
};

const setDropdownState = (dropdown, isOpen, returnFocus = false) => {
    const button = dropdown.querySelector('.dropdown-toggle');

    dropdown.classList.toggle('is-expanded', isOpen);
    button?.setAttribute('aria-expanded', String(isOpen));

    if (returnFocus && button instanceof HTMLButtonElement) {
        button.focus();
    }
};

document.querySelectorAll('.nav-item--dropdown').forEach((dropdown) => {
    const button = dropdown.querySelector('.dropdown-toggle');

    if (!(button instanceof HTMLButtonElement)) {
        return;
    }

    button.addEventListener('click', () => {
        const isOpen = button.getAttribute('aria-expanded') === 'true';

        document.querySelectorAll('.nav-item--dropdown').forEach((otherDropdown) => {
            if (otherDropdown !== dropdown) {
                closeDropdown(otherDropdown);
            }
        });

        setDropdownState(dropdown, !isOpen);
    });

    dropdown.addEventListener('pointerenter', (event) => {
        if (event.pointerType === 'mouse') {
            setDropdownState(dropdown, true);
        }
    });

    dropdown.addEventListener('pointerleave', () => {
        if (!dropdown.contains(document.activeElement)) {
            closeDropdown(dropdown);
        }
    });

    dropdown.addEventListener('focusin', () => setDropdownState(dropdown, true));

    dropdown.addEventListener('focusout', (event) => {
        if (!dropdown.contains(event.relatedTarget)) {
            closeDropdown(dropdown);
        }
    });
});

const setMenuState = (isOpen, returnFocus = false) => {
    if (!(menuToggle instanceof HTMLButtonElement)
        || !(mobileMenu instanceof HTMLElement)
        || !(mobileMenuPanel instanceof HTMLElement)) {
        return;
    }

    menuToggle.setAttribute('aria-expanded', String(isOpen));
    menuToggle.setAttribute('aria-label', isOpen ? 'Close navigation' : 'Open navigation');
    document.documentElement.classList.toggle('menu-is-open', isOpen);
    mobileMenu.classList.toggle('is-open', isOpen);

    if (isOpen) {
        mobileMenu.hidden = false;
        mobileMenuClose?.focus();
        return;
    }

    mobileMenu.hidden = true;

    if (returnFocus) {
        menuToggle.focus();
    }
};

if (menuToggle instanceof HTMLButtonElement && mobileMenu instanceof HTMLElement) {
    menuToggle.addEventListener('click', () => {
        setMenuState(menuToggle.getAttribute('aria-expanded') !== 'true');
    });

    mobileMenuClose?.addEventListener('click', () => setMenuState(false, true));
    mobileMenu.querySelector('.mobile-menu__backdrop')?.addEventListener('click', () => setMenuState(false, true));

    mobileNavigation?.addEventListener('click', (event) => {
        if (event.target instanceof HTMLAnchorElement) {
            setMenuState(false);
        }
    });

    mobileNavigation?.querySelectorAll('.mobile-submenu-toggle').forEach((button) => {
        button.addEventListener('click', () => {
            const submenuId = button.getAttribute('aria-controls');
            const submenu = submenuId ? document.getElementById(submenuId) : null;

            if (!(submenu instanceof HTMLElement)) {
                return;
            }

            const isOpen = button.getAttribute('aria-expanded') === 'true';
            button.setAttribute('aria-expanded', String(!isOpen));
            submenu.hidden = isOpen;
        });
    });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && menuToggle.getAttribute('aria-expanded') === 'true') {
            setMenuState(false, true);
            return;
        }

        if (event.key === 'Escape') {
            const openDropdown = document.querySelector('.nav-item--dropdown.is-expanded');

            if (openDropdown) {
                closeDropdown(openDropdown, true);
                return;
            }
        }

        if (event.key !== 'Tab' || menuToggle.getAttribute('aria-expanded') !== 'true') {
            return;
        }

        const focusableItems = [...mobileMenuPanel.querySelectorAll('a[href], button:not([disabled])')]
            .filter((element) => element.getClientRects().length > 0);

        if (!focusableItems.length) {
            event.preventDefault();
            return;
        }

        const firstItem = focusableItems[0];
        const lastItem = focusableItems[focusableItems.length - 1];

        if (event.shiftKey && document.activeElement === firstItem) {
            event.preventDefault();
            lastItem.focus();
        } else if (!event.shiftKey && document.activeElement === lastItem) {
            event.preventDefault();
            firstItem.focus();
        }
    });

    window.matchMedia('(min-width: 76.0625rem)').addEventListener('change', (event) => {
        if (event.matches) {
            setMenuState(false);
        }
    });
}

document.querySelectorAll('[data-booking-form]').forEach((form) => {
    if (!(form instanceof HTMLFormElement)) {
        return;
    }

    const contactDetails = form.querySelector('.booking-form__contact');

    form.addEventListener('invalid', (event) => {
        if (contactDetails instanceof HTMLDetailsElement
            && event.target instanceof HTMLElement
            && contactDetails.contains(event.target)) {
            contactDetails.open = true;
        }
    }, true);

    const errorSummary = form.querySelector('.booking-message--error[tabindex="-1"]');

    if (errorSummary instanceof HTMLElement) {
        errorSummary.focus();
    }
});
