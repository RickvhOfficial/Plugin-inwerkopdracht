document.addEventListener('DOMContentLoaded',function(){const menuButton=document.querySelector('[data-collapse-toggle="mobile-menu-2"]');const mobileMenu=document.getElementById('mobile-menu-2');menuButton.addEventListener('click',function(){setTimeout(()=>{const isMenuOpen=!mobileMenu.classList.contains('hidden');const hamburgerIcon=menuButton.querySelector('svg:first-of-type');const closeIcon=menuButton.querySelector('svg:last-of-type');if(isMenuOpen){hamburgerIcon.classList.add('hidden');closeIcon.classList.remove('hidden')}else{hamburgerIcon.classList.remove('hidden');closeIcon.classList.add('hidden')}
menuButton.setAttribute('aria-expanded',isMenuOpen)},10)});setupMobileSubmenu()});function setupMobileSubmenu(){addMobileSubmenuCSS();function handleMobileSubmenu(){const isDesktop=window.innerWidth>=1024;const menuItemsWithChildren=document.querySelectorAll('.menu-item-has-children');menuItemsWithChildren.forEach(menuItem=>{const link=menuItem.querySelector('a');const submenu=menuItem.querySelector('.sub-menu');const icon=menuItem.querySelector('svg');if(icon&&!isDesktop){icon.classList.remove('transition-transform','duration-300','group-hover:rotate-180');icon.classList.add('transition-transform','duration-300')}else if(icon&&isDesktop){icon.classList.add('group-hover:rotate-180')}
if(link.mobileClickHandler){link.removeEventListener('click',link.mobileClickHandler);link.mobileClickHandler=null}
if(!isDesktop){link.mobileClickHandler=function(e){if(submenu){const isExpanded=submenu.classList.contains('mobile-expanded');if(isExpanded){return!0}
e.preventDefault();const allExpandedSubmenus=document.querySelectorAll('.sub-menu.mobile-expanded');allExpandedSubmenus.forEach(menu=>{if(menu!==submenu){menu.classList.remove('mobile-expanded');menu.style.maxHeight='0px';menu.style.visibility='hidden';const parentIcon=menu.parentElement.querySelector('svg');if(parentIcon){parentIcon.classList.remove('rotate-180')}}});submenu.classList.add('mobile-expanded');submenu.style.maxHeight=submenu.scrollHeight+'px';submenu.style.visibility='visible';if(icon){icon.classList.add('rotate-180')}
console.log('Submenu geopend:',submenu)}};link.addEventListener('click',link.mobileClickHandler);if(submenu){submenu.style.maxHeight='0px';submenu.style.overflow='hidden';submenu.style.visibility='hidden';submenu.style.transition='max-height 0.3s ease-in-out, visibility 0s';const submenuItems=submenu.querySelectorAll('li');submenuItems.forEach(item=>{const subLink=item.querySelector('a');if(subLink){subLink.classList.add('block','py-1','pl-3','pr-4','text-gray-700','hover:bg-gray-50','lg:hover:bg-transparent','lg:border-0','lg:hover:text-primary-700','lg:p-0')}})}}else{if(submenu){submenu.style.maxHeight='';submenu.style.overflow='';submenu.style.visibility='';submenu.classList.remove('mobile-expanded')}}})}
handleMobileSubmenu();window.addEventListener('resize',handleMobileSubmenu)}
function addMobileSubmenuCSS(){if(document.getElementById('mobile-submenu-styles')){return}
const style=document.createElement('style');style.id='mobile-submenu-styles';style.textContent=`
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
    `;document.head.appendChild(style);console.log('Mobiele submenu styling toegevoegd')}