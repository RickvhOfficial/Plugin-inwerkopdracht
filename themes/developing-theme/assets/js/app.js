// Menu toggle functionaliteit
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.querySelector('[data-collapse-toggle="mobile-menu-2"]');
    const mobileMenu = document.getElementById('mobile-menu-2');
    
    // Voeg click event toe
    menuButton.addEventListener('click', function() {
        // Wacht even tot Flowbite het menu heeft getoggeld
        setTimeout(() => {
            const isMenuOpen = !mobileMenu.classList.contains('hidden');
            
            // Selecteer beide SVG's
            const hamburgerIcon = menuButton.querySelector('svg:first-of-type');
            const closeIcon = menuButton.querySelector('svg:last-of-type');
            
            if (isMenuOpen) {
                // Menu is open, toon het kruisje
                hamburgerIcon.classList.add('hidden');
                closeIcon.classList.remove('hidden');
            } else {
                // Menu is dicht, toon het hamburger icoon
                hamburgerIcon.classList.remove('hidden');
                closeIcon.classList.add('hidden');
            }
            
            // Update aria-expanded
            menuButton.setAttribute('aria-expanded', isMenuOpen);
        }, 10);
    });

    // Submenu functionaliteit voor mobiel
    setupMobileSubmenu();
});

// Functie voor submenu functionaliteit op mobiel
function setupMobileSubmenu() {
    // Voeg CSS toe voor mobiele submenu's
    addMobileSubmenuCSS();
    
    // Alleen uitvoeren in mobiele weergave
    function handleMobileSubmenu() {
        const isDesktop = window.innerWidth >= 1024; // lg breakpoint in Tailwind
        const menuItemsWithChildren = document.querySelectorAll('.menu-item-has-children');

        menuItemsWithChildren.forEach(menuItem => {
            const link = menuItem.querySelector('a');
            const submenu = menuItem.querySelector('.sub-menu');
            const icon = menuItem.querySelector('svg');
            
            // Verwijder hover effecten van het icon op mobiel
            if (icon && !isDesktop) {
                icon.classList.remove('transition-transform', 'duration-300', 'group-hover:rotate-180');
                icon.classList.add('transition-transform', 'duration-300');
            } else if (icon && isDesktop) {
                // Herstel hover effecten op desktop
                icon.classList.add('group-hover:rotate-180');
            }

            // Verwijder oude event listeners eerst (om dubbele events te voorkomen)
            if (link.mobileClickHandler) {
                link.removeEventListener('click', link.mobileClickHandler);
                link.mobileClickHandler = null;
            }

            if (!isDesktop) {
                // Op mobiel: eerste klik opent submenu, tweede klik navigeert naar de link
                link.mobileClickHandler = function(e) {
                    // Alleen als er een submenu is
                    if (submenu) {
                        const isExpanded = submenu.classList.contains('mobile-expanded');
                        
                        // Als het submenu al open is, laat de klik doorgaan naar de link
                        if (isExpanded) {
                            return true; // Sta de standaard actie toe (navigeren naar de link)
                        }
                        
                        // Anders voorkom de navigatie en open het submenu
                        e.preventDefault();
                        
                        // Sluit andere open submenu's
                        const allExpandedSubmenus = document.querySelectorAll('.sub-menu.mobile-expanded');
                        allExpandedSubmenus.forEach(menu => {
                            if (menu !== submenu) {
                                menu.classList.remove('mobile-expanded');
                                menu.style.maxHeight = '0px';
                                menu.style.visibility = 'hidden';
                                const parentIcon = menu.parentElement.querySelector('svg');
                                if (parentIcon) {
                                    parentIcon.classList.remove('rotate-180');
                                }
                            }
                        });
                        
                        // Submenu is dicht, open het
                        submenu.classList.add('mobile-expanded');
                        submenu.style.maxHeight = submenu.scrollHeight + 'px';
                        submenu.style.visibility = 'visible';
                        if (icon) {
                            icon.classList.add('rotate-180');
                        }
                        
                        // Log voor debugging
                        console.log('Submenu geopend:', submenu);
                    }
                };
                
                link.addEventListener('click', link.mobileClickHandler);
                
                // Standaard verborgen submenu op mobiel
                if (submenu) {
                    submenu.style.maxHeight = '0px';
                    submenu.style.overflow = 'hidden';
                    submenu.style.visibility = 'hidden';
                    submenu.style.transition = 'max-height 0.3s ease-in-out, visibility 0s';
                    
                    // Zorg dat submenu items zichtbaar zijn op mobiel
                    const submenuItems = submenu.querySelectorAll('li');
                    submenuItems.forEach(item => {
                        const subLink = item.querySelector('a');
                        if (subLink) {
                            subLink.classList.add('block', 'py-1', 'pl-3', 'pr-4', 'text-gray-700', 'hover:bg-gray-50', 'lg:hover:bg-transparent', 'lg:border-0', 'lg:hover:text-primary-700', 'lg:p-0');
                        }
                    });
                }
            } else {
                // Op desktop: reset de styling voor hover functionaliteit
                if (submenu) {
                    submenu.style.maxHeight = '';
                    submenu.style.overflow = '';
                    submenu.style.visibility = '';
                    submenu.classList.remove('mobile-expanded');
                }
            }
        });
    }

    // Initiële setup
    handleMobileSubmenu();

    // Update bij resize
    window.addEventListener('resize', handleMobileSubmenu);
}

// Functie om CSS toe te voegen voor mobiele submenu's
function addMobileSubmenuCSS() {
    // Controleer of de styling al bestaat
    if (document.getElementById('mobile-submenu-styles')) {
        return;
    }
    
    // Maak een style element
    const style = document.createElement('style');
    style.id = 'mobile-submenu-styles';
    style.textContent = `
        @media (max-width: 1023px) {
            /* Verwijder witruimte tussen menu items */
            #mobile-menu-2 ul li {
                margin: 0;
                padding: 0;
            }
            
            #mobile-menu-2 ul li a {
                display: flex;
                align-items: center;
                justify-content: space-between;
                padding: 0.35rem 0.5rem;
            }
            
            /* Submenu styling */
            .sub-menu {
                display: block !important;
                position: static;
                box-shadow: none;
                padding-left: 0.75rem;
                border-left: 2px solid #e5e7eb;
                margin-top: 0;
                margin-bottom: 0;
            }
            
            .sub-menu:not(.mobile-expanded) {
                display: block !important;
                max-height: 0 !important;
                visibility: hidden !important;
                opacity: 0 !important;
                margin: 0 !important;
                padding: 0 !important;
                border-left: 0 !important;
            }
            
            .sub-menu.mobile-expanded {
                opacity: 1 !important;
                visibility: visible !important;
                padding-left: 0.75rem !important;
                border-left: 2px solid #e5e7eb !important;
            }
            
            /* Dichtere spacing voor submenu items */
            .sub-menu li {
                margin: 0 !important;
            }
            
            .sub-menu li a {
                padding-top: 0.25rem !important;
                padding-bottom: 0.25rem !important;
            }
            
            /* Animatie voor submenu toggle */
            .sub-menu {
                transition: max-height 0.3s ease-in-out, 
                            opacity 0.2s ease-in-out, 
                            visibility 0s linear 0.3s,
                            padding 0.3s ease-in-out,
                            border-left 0.3s ease-in-out,
                            margin 0.3s ease-in-out;
            }
            
            .sub-menu.mobile-expanded {
                transition: max-height 0.3s ease-in-out, 
                            opacity 0.2s ease-in-out, 
                            visibility 0s linear 0s,
                            padding 0.3s ease-in-out,
                            border-left 0.3s ease-in-out,
                            margin 0.3s ease-in-out;
            }
            
            /* Icon animatie alleen op klik, niet op hover */
            .menu-item-has-children a svg {
                transform: rotate(0deg) !important;
            }
            
            .menu-item-has-children a svg.rotate-180 {
                transform: rotate(180deg) !important;
            }
        }
    `;
    
    // Voeg aan document toe
    document.head.appendChild(style);
    
    console.log('Mobiele submenu styling toegevoegd');
}