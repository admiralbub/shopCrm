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



const search_block = document.querySelector('.search_block');
const search_descktop = document.querySelector('#search_descktop');


const search_mob = document.querySelector('#search_mob');
const search_block_mob = document.querySelector('.search_block_mob');

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
if(search_mob) {
    search_mob.addEventListener('input', function() {
        const asyncSearchProductMob = async () => {
            try {
                const response = await axios.post('/search_ajax', {
                    query: this.value,
                });
                if(response['data'].length != 0) {
                    renderProductSearchMob(response)
                }
                
                
               
            } catch (error) {
                console.log(error);
            }
        };
        if(this.value.length > 1) {
            asyncSearchProductMob()
        }
        
    })
    function renderProductSearchMob(response = []) {
        document.querySelector('.search_block_mob').classList.remove('d-none');
        const html = Array.isArray(response['data']) ? response['data'].map(toHtmlProductMob).join('') : '';
        search_block_mob.innerHTML = html;
        
    }
    document.addEventListener('click', function(event) {
        const search_block_mob = document.querySelector('.search_block_mob'); // Находим элемент resusltCityNp
    
        // Проверяем, произошел ли клик вне блока resusltCityNp
        if (!search_block_mob.contains(event.target) && !search_block_mob.contains(event.target)) {
            search_block_mob.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
        }
    });
    function toHtmlProductMob(pr) {
        return `<div class="py-3 px-4">
            <a href="/product/${pr.slug}" class="d-flex">
                <div>
                    <img src="${pr.image}" width="60px">
                </div>
                <div class="px-3 py-1">
                    ${pr.name}
                </div>
            </a>
        </div>`
    }
}   



if(search_descktop) {
    search_descktop.addEventListener('input', function() {
        const asyncSearchProductDescktop = async () => {
            try {
                const response = await axios.post('/search_ajax', {
                    query: this.value,
                });
                if(response['data'].length != 0) {
                    renderProductSearch(response)
                }
                
                
               
            } catch (error) {
                console.log(error);
            }
        };
        if(this.value.length > 1) {
            asyncSearchProductDescktop()
        }
        
    })
    function renderProductSearch(response = []) {
        document.querySelector('.search_block').classList.remove('d-none');
        const html = Array.isArray(response['data']) ? response['data'].map(toHtmlProduct).join('') : '';
        search_block.innerHTML = html;
        
    }
    document.addEventListener('click', function(event) {
        const search_block = document.querySelector('.search_block'); // Находим элемент resusltCityNp
    
        // Проверяем, произошел ли клик вне блока resusltCityNp
        if (!search_block.contains(event.target) && !search_descktop.contains(event.target)) {
            search_block.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
        }
    });
    function toHtmlProduct(pr) {
        return `<div class="py-3 px-4">
            <a href="/product/${pr.slug}" class="d-flex">
                <div>
                    <img src="${pr.image}" width="60px">
                </div>
                <div class="px-3 py-1">
                    ${pr.name}
                </div>
            </a>
        </div>`
    }
}



//////

import './order.js'
import './field.js'
import './catalog.js'
import './basket.js'
import './filter.js'
import './slider.js'
import './mask.js'
import './wislist.js'
import './compare.js'
import './validation.js'