

import { Tooltip, Toast, Popover } from 'bootstrap';
import Lang from './lang/lang'


Lang();
document.addEventListener("DOMContentLoaded", function() {
    const AddBaskets = document.querySelectorAll('#addBasketList');
    const deleteBaskets = document.querySelectorAll('.deleteBasket');
    const countBasket = document.querySelector('#basket-count');
    const countBasketMob = document.querySelector('#mobCountBasket');
    const basketNavbar = document.querySelector('#basketNavbar');
    const totalbBasket = document.querySelector('#totalbBasket');
    const AddBasketView = document.querySelector('#AddBasketView');
    
    
    const openRightBasket = document.querySelector('#openRightBasket');
    const openRightBasketMob = document.querySelector('#openRightBasketMob');
    const closeRightBasket = document.querySelector('#closeRightBasket');
    const body_overlay = document.querySelector('.body-overlay');



    if (openRightBasket) {
        openRightBasket.addEventListener('click', function() {
            document.querySelector('.cartmini__area').classList.add('cartmini__area-opened');
            document.querySelector('.body-overlay').classList.add('opened');
    
        })
    
        
    }
    if (openRightBasketMob) {
        openRightBasketMob.addEventListener('click', function() {
            document.querySelector('.cartmini__area').classList.add('cartmini__area-opened');
            document.querySelector('.body-overlay').classList.add('opened');
    
        })
    
        
    }
    
    if (closeRightBasket) {
        closeRightBasket.addEventListener('click', function() {
            document.querySelector('.cartmini__area').classList.remove('cartmini__area-opened');
            document.querySelector('.body-overlay').classList.remove('opened');
        
        })
    }
    if(body_overlay) {
        body_overlay.addEventListener('click', function() {
            if (body_overlay.classList.contains('opened')) {
                document.querySelector('.cartmini__area').classList.remove('cartmini__area-opened');
                document.querySelector('.body-overlay').classList.remove('opened');
            }
        
        })
    }
    const basketNavbarLabel = async () => {
    
            
        try {
            const response = await axios.get('/basket/basketJson');
            if(response.data.baskets.length != 0) {
                render(response.data.baskets)
                document.querySelector('.cartmini__area-wrapper_checkout').style.display = 'block';
                document.querySelector('.cartmini__area-wrapper_buttons').style.display = 'block';
                
            } else {
              
                document.querySelector('.cartmini__area-wrapper_checkout').style.display = 'none';
                document.querySelector('.cartmini__area-wrapper_buttons').style.display = 'none';
                basketNavbar.innerHTML = `<span class="fs-5">${window.lang.validator.emptyBasket}</span>`;
                
            }
            
        } catch (error) {
            basketNavbar.innerHTML = error;
        }
    };
    if(basketNavbar) {
        const countBasketLabel = async () => {
            try {
                const response = await axios.get('/basket/countBasket');
                countBasket.innerText = response.data.count;
                countBasketMob.innerText = response.data.count;
                
            } catch (error) {
                console.log(error);
            }
        };
        basketNavbar.onclick = async function(event) {
            if(event.target.id == "btn_delete") {
                try {
                    await axios.delete('/basket/deleteBasker/'+event.target.dataset.id, {});
                    location.reload();
    
                } catch (error) {
                    console.log(error);
                }
            }
            // Уменьшаем кол-во товара в корзине
            if (event.target.closest('#quantity-minus')) {
                const inputElement = event.target.closest('.amt').querySelector('.quantity');
                let quantity = parseInt(inputElement.value);
                if (quantity > 1) { // Предотвращаем уменьшение ниже 1
                    quantity--;
                    inputElement.value = quantity;
                    try {
                        const response = await axios.post('/basket/quantity', {
                            id: inputElement.dataset.id,
                            quantity: quantity,
                        });
                    } catch (error) {
                        console.log(error);
                    }
                    countBasketLabel();
                    basketNavbarLabel()
                }
            }
            
            // Увеличиваем кол-во товара в корзине
            if (event.target.closest('#quantity-plus')) {
                const inputElement = event.target.closest('.amt').querySelector('.quantity');
                let quantity = parseInt(inputElement.value);
                quantity++;
                inputElement.value = quantity;
                try {
                    const response = await axios.post('/basket/quantity', {
                        id: inputElement.dataset.id,
                        quantity: quantity,
                    });
                } catch (error) {
                    console.log(error);
                }
                countBasketLabel();
                basketNavbarLabel()
                
            }
        }    
    
        
        countBasketLabel();
        basketNavbarLabel()    
    
    }
    
        
    function render(basket = []) {
        const html = Array.isArray(basket) ? basket.map(toHtml).join('') : '';
        basketNavbar.innerHTML = html;
        totalbBasket.innerHTML =  totalBasketParser(basket);
    }

    function totalBasketParser(basket = []) {
        let totalAmount = 0;
        basket.forEach(item => {
            totalAmount += item.price * item.quantity; // Суммируем цену, умноженную на количество
            
        });
        return totalAmount+' грн.';
    }
    
    function toHtml(basket) {
        return `
            <div class="cartmini__area-item">
                <div class="cartmini__area-item_into d-flex justify-content-between">
                    <div class="item_into_content">
                        <div class="d-flex">
                            <div class="item_into_content-img fw-bold">
                                <a href="/product/${basket.slug}">
                                    <img src="${basket.image}" alt="">
                                </a>
                            </div>
                            <div class="item_into_content-spend">
                                <a href="/product/${basket.slug}">
                                    ${basket.name}
                                </a>
                                <div class="amt mt-2 mb-2">
                                    <div class="minus" id="quantity-minus" data-id="${basket.id}">
                                        <svg width="10" height="2" viewBox="0 0 10 2" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M1 1H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                    <input type="text" value="${basket.quantity}" data-id="${basket.id}" data-type="quantity" class="quantity quantity_basket" readonly="" >
                                    <div class="plus" id="quantity-plus" data-id="${basket.id}">
                                        <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M5 1V9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                            <path d="M1 5H9" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                                        </svg>
                                    </div>
                                </div>
                                <div class="item_into_content-price pt-1">
                                    <strong>${basket.price*basket.quantity} грн</strong>
                                </div>
                            </div>
                        </div>   
                        
                            
                    </div>
                    <div class="item_into_delete" >
                        <button type="button" class="btn btn-light fs-4" data-id="${basket.id}" id="btn_delete">
                            &times;
                        </button>
                    </div>
                </div> 
            </div>`
    }
    
    if(AddBaskets) {
        AddBaskets.forEach(function(AddBasket) {
            AddBasket.addEventListener('click', function() {
                const dataAttributes = this.dataset;
                
                const id = dataAttributes.id;
                const packid = dataAttributes.packid;
                
                const asyncAddBasket = async () => {
                    try {
                        const response = await axios.post('/basket/addBasket', {
                            id: id,
                            quanity: 1,
                            packid: packid
                        });
                        
                        countBasket.innerText = response.data.count;
                        countBasketMob.innerText = response.data.count;
                        /*var myAlert = document.getElementById('toastSuccess'); // select id of toast
                        if (myAlert) {
                            var bsAlert = new Toast(myAlert); // initialize it
                            bsAlert.show(); // show it
                        }
                        document.querySelector('#toastSuccessbody').innerHTML=response.data.mess['success'];
                        basketNavbarLabel()*/

                        document.querySelector('.cartmini__area').classList.add('cartmini__area-opened');
                        document.querySelector('.body-overlay').classList.add('opened');
                        basketNavbarLabel()
                    } catch (error) {
                        console.log(error);
                    }
                };
                asyncAddBasket();
            });
        })
    }

    if(AddBasketView) {
        AddBasketView.addEventListener('click', function() {
            const dataAttributes = this.dataset;
            
            const id = dataAttributes.id;
            const packid = dataAttributes.packid;
            const qty = document.querySelector('#qty');

            const asyncAddBasket = async () => {
                try {
                    const response = await axios.post('/basket/addBasket', {
                        id: id,
                        quanity: qty.value,
                        packid: packid
                    });
                    
                    countBasket.innerText = response.data.count;
                    countBasketMob.innerText = response.data.count;
                    var myAlert = document.getElementById('toastSuccess'); // select id of toast
                    if (myAlert) {
                        var bsAlert = new Toast(myAlert); // initialize it
                        bsAlert.show(); // show it
                    }
                    //document.querySelector('#toastSuccessbody').innerHTML=response.data.mess['success'];

                    document.querySelector('.cartmini__area').classList.add('cartmini__area-opened');
                    document.querySelector('.body-overlay').classList.add('opened');
                    basketNavbarLabel()
                } catch (error) {
                    console.log(error);
                }
            };
            asyncAddBasket();
        });
    }
    

    
    


    if(deleteBaskets) {
        deleteBaskets.forEach(function(deleteBasket) {
            deleteBasket.addEventListener('click', function() {
                let dataAttr = this.dataset;
                let id = dataAttr.id;
                const asyncDeleteItem = async () => {
                    try {
                        await axios.delete('/basket/deleteBasker/'+id, {});
                        location.reload();

                    } catch (error) {
                        console.log(error);
                    }
                };
                asyncDeleteItem();
            })
        })
    }
    
});