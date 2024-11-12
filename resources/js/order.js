document.addEventListener("DOMContentLoaded", function() {
    const showTableCart = document.querySelector('#showTableCart');
    const basketCart = async () => {
        try {
            const response = await axios.get('/basket/basketJson');
            if(response.data.baskets.length != 0) {
                render(response.data.baskets)
               
                
            } 
            
        } catch (error) {
            showTableCart.innerHTML = error;
        }
    };
    function render(basket = []) {
        const html = Array.isArray(basket) ? basket.map(toHtml).join('') : '';
        showTableCart.innerHTML = html;
        totalbBasket.innerHTML =  totalBasketParser(basket);
    }
    function toHtml(basket) {
        return  `
            

             <li class="order_summ-order">
                <a href="/product/${basket.slug}" class="product-image position-relative">
                    <img src="${basket.image}" alt="">
                    <span class="qty-count">${basket.quantity}</span>
                </a>
                <div class="product-info">
                     <a href="/product/${basket.slug}" class="product-name">
                        ${basket.name}
                    </a>
                </div>
                <div class="product-price">
                    ${basket.price*basket.quantity} грн
                </div>
            </li>
        `;
    }

    basketCart()
})