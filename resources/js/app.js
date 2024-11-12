import './bootstrap';
import * as bootstrap from 'bootstrap'
import Alert from 'bootstrap/js/dist/alert';

// or, specify which plugins you need:
import { Tooltip, Toast, Popover } from 'bootstrap';

const catalog_menu = document.querySelector('.catalog-mob');
const open_mob = document.querySelector('.open-mob-menu');
const open_mob_close = document.querySelector('.catalog-mob--close');
const category_open_mob = document.querySelector('#menu_categeryMob-open'); 
const categor_mob = document.querySelector('#categor_mob'); 

const button_submenu_mob = document.querySelectorAll('.button-submenu_click');



const quantity = document.querySelector('.quantity');



if(open_mob) {
    open_mob.addEventListener('click',  function() {
        catalog_menu.classList.add("open");
    })
}
if(open_mob_close) {
    open_mob_close.addEventListener('click',  function() {
        catalog_menu.classList.remove("open");
    })
}
if(category_open_mob) {
    category_open_mob.addEventListener('click',  function() {
        categor_mob.style.display = categor_mob.style.display === "block" ? "none" : "block";
        
    })
}

button_submenu_mob.forEach(button => {
    button.addEventListener('click', function(event) {
        // Получаем data-id нажатой кнопки
        const dataId = this.getAttribute('data-id');
        const submenu_mob = document.querySelector('#submenu_mob'+dataId);
        submenu_mob.style.display = submenu_mob.style.display === "block" ? "none" : "block";
        this.classList.toggle("active_icon_sub");
        
    });
});
//Fixed desctop navbar
window.onscroll = function() {
    const floatingElementDesc = document.querySelector(".catalog");
    
    if (window.scrollY > 100) { // Scroll position threshold
        floatingElementDesc.classList.add("fixed_header"); // Hide the element
    } else {
        if(floatingElementDesc.classList.contains("fixed_header")) {
            floatingElementDesc.classList.remove("fixed_header"); // Hide the element
        }
        
    }
    const fixednavasctive = document.querySelector(".fixed_header");
    
    if (window.scrollY > 200) { // Scroll position threshold
        fixednavasctive.classList.add("visible"); // Show the element
    } else {
        if(floatingElementDesc.classList.contains("fixed_header")) {
            fixednavasctive.classList.remove("visible"); // Hide the element
        }
       
    }
    const floatingElementMob = document.querySelector(".header-mob");
    
    if (window.scrollY > 100) { // Scroll position threshold
        floatingElementMob.classList.add("fixed_header_mob"); // Hide the element
        floatingElementMob.classList.remove("mt-2"); // Hide the element
    } else {
        if(floatingElementMob.classList.contains("fixed_header")) {
            floatingElementMob.classList.remove("fixed_header_mob"); // Hide the element
            floatingElementMob.classList.add("mt-2"); // Hide the element
        }
        

    }
    const fixednavasctiveMob = document.querySelector(".fixed_header_mob");
    
    if (window.scrollY > 200) { // Scroll position threshold
        fixednavasctiveMob.classList.add("visible"); // Show the element
    } else {
        if(floatingElementMob.classList.contains("fixed_header")) {
            fixednavasctiveMob.classList.remove("visible"); // Hide the element
        }
    }
        
};
if(quantity) {
    //Увеличить количество товара
    quantity.onclick = function(event) {
        if (event.target.closest('.minus')) {
            const qty = event.target.closest('.quantity').querySelector('.qty');
        
            let quantity = parseInt(qty.value);
            
            if (quantity > 1) { // Предотвращаем уменьшение ниже 1
                quantity--;
                qty.value = quantity;
            }
        }
        if (event.target.closest('.plus')) {
            const qty = event.target.closest('.quantity').querySelector('.qty');
        
            let quantity = parseInt(qty.value);
        
            quantity++;
            qty.value = quantity;
        }
    }
}



//////

//import './order.js'
import './field.js'
import './catalog.js'
import './basket.js'
import './filter.js'
import './slider.js'
import './mask.js'
import './wislist.js'
import './compare.js'
import './validation.js'