import noUiSlider from 'nouislider'


let priceRanges = document.querySelectorAll('.js-price-range');
priceRanges.forEach(el => {
    let downPriceInput = el.closest('.filter-price').querySelector('.js-price-down'),
          upPriceInput   = el.closest('.filter-price').querySelector('.js-price-up'),
          inputs         = [downPriceInput, upPriceInput];

      const minPrice = +downPriceInput.getAttribute('data-min');
      downPriceInput.value = minPrice.toLocaleString();  
      //get maxPrice for slider price
      const maxPrice = +upPriceInput.getAttribute('data-max');
      upPriceInput.value = maxPrice.toLocaleString();
     

      //Init price range slider
      noUiSlider.create(el, {
          range: {
              'min': minPrice,
              'max': maxPrice
          },
          behaviour: 'drag',
          connect  : true,
          start    : [minPrice, maxPrice],
          step     : 1
      });

      //Update value after scroll pointer in slider
      el.noUiSlider.on('update', values => {
          let [downPrice, upPrice] = values;

          downPrice = Number(downPrice);
          upPrice   = Number(upPrice);

          downPriceInput.value = downPrice;
          upPriceInput.value   = upPrice;
      });

      //Change slider value after inputs change
      inputs.forEach(function (input, handle) {
          input.addEventListener('change', function () {
              let value = this.value;
              value = value.replace(/\s+/g, '');
              value = parseInt(value);

              el.noUiSlider.setHandle(handle, value);
          });
      });

  });

// Обработчик событий для всех чекбоксов с классом filter_attr_check
document.querySelectorAll('.filter_attr_check').forEach(checkbox => {
    checkbox.addEventListener('click', function () {
        // Получаем значение URL из атрибута value
        const url = this.value;
        // Перенаправляем пользователя по указанному URL
        window.location.href = url;
    });
});

// Обработчик событий для всех чекбоксов с классом filter_attr_check
document.querySelectorAll('.filter_brand_check').forEach(checkbox => {
    checkbox.addEventListener('click', function () {
        // Получаем значение URL из атрибута value
        const url = this.value;
        // Перенаправляем пользователя по указанному URL
        window.location.href = url;
    });
});
