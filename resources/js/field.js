document.addEventListener("DOMContentLoaded", function() {
    const deliver = document.querySelector('#deliver');
    const np_city_input = document.querySelector('#np_city_input');
    const resusltCityNp = document.querySelector('#resusltCityNp');
    
    const warehouse_input = document.querySelector('#warehouse_input');
    const resusltWarehouseNp = document.querySelector('#resusltWarehouseNp');

    const clear_city_np = document.querySelector('#clear_city_np');
    const clear_warehouse_np = document.querySelector('#clear_warehouse_np');

    const city_ref_np = document.querySelector('#city_ref_np');
    const warehouse_ref_np = document.querySelector('#warehouse_ref_np');


    if(deliver) {
        deliver.addEventListener("change", () => {
            const deliverValue = deliver.value;
            switch(deliverValue) {
                case "NP":
                    document.querySelector('#np_city_block').classList.remove('d-none');
                    document.querySelector('#np_warehouse_block').classList.remove('d-none');

                    document.querySelector('#warehouse_input').classList.remove('d-none');
                    document.querySelector('#np_city_input').classList.remove('d-none');

                    break;

                case "":
                    document.querySelector('#np_city_block').classList.add('d-none');
                    document.querySelector('#np_warehouse_block').classList.add('d-none');

                    document.querySelector('#warehouse_input').classList.add('d-none');
                    document.querySelector('#np_city_input').classList.add('d-none');
                    break;
            }
        })
    }
    if(np_city_input) {

        clear_city_np.onclick =  function() {
            np_city_input.value = "";
            warehouse_input.value = "";
            warehouse_input.setAttribute("readonly", true);
        }
        
        np_city_input.addEventListener('input', function() {
            warehouse_input.value = "";
            const asyncSearchCity = async () => {
                try {
                    const response = await axios.post('/novaposhta/getCity', {
                        city: this.value,
                    });
                 
                    if(response['data'].length != 0) {
                        renderCityNp(response)
                    }
                    
                    
                   
                } catch (error) {
                    console.log(error);
                }
            };
            asyncSearchCity()
        })
        function renderCityNp(response = []) {
            document.querySelector('.resusltCityNp').classList.remove('d-none');
            const html = Array.isArray(response['data']) ? response['data'].map(toHtmlCity).join('') : '';
            resusltCityNp.innerHTML = html;
            
        }

        resusltCityNp.onclick =  function(event) {
        
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const ref = event.target.dataset.ref;
            np_city_input.value = fullText;
            city_ref_np.value=ref;
            warehouse_input.value = "";
            document.querySelector('.resusltCityNp').classList.add('d-none');
            warehouse_input.removeAttribute("readonly");

           

        };
        function toHtmlCity(np) {
            return `<li class="py-2" data-ref="${np.Ref}">${np.Description}</li>`
        }
        document.addEventListener('click', function(event) {
            const resusltCityNp = document.querySelector('.resusltCityNp'); // Находим элемент resusltCityNp
        
            // Проверяем, произошел ли клик вне блока resusltCityNp
            if (!resusltCityNp.contains(event.target) && !np_city_input.contains(event.target)) {
                resusltCityNp.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
            }
        });
    }
    if(warehouse_input) {
       
        clear_warehouse_np.onclick =  function() {
            warehouse_input.value = "";
        }
        warehouse_input.addEventListener('input', function() {
            
            const asyncSearchWarehouse = async () => {
                try {
                    const response = await axios.post('/novaposhta/getWarehouse', {
                        city: city_ref_np.value,
                        warehouse: this.value,
                    });
                    //console.log(response);
                    if(response['data'].length != 0) {
                        renderWarehouseNp(response)
                    }
                    
                   
                } catch (error) {
                    console.log(error);
                }
            };
            asyncSearchWarehouse()
        })
        function renderWarehouseNp(response = []) {
            console.log(Array.isArray(response['data']))
            document.querySelector('.resusWarehouseNp').classList.remove('d-none');
            const html = Array.isArray(response['data']) ? response['data'].map(toHtmlWarehouse).join('') : '';
            resusltWarehouseNp.innerHTML = html;
            
            
        }
        function toHtmlWarehouse(np) {
            return `<li class="py-2" data-ref="${np.Ref}">${np.Description}</li>`
        }
        resusltWarehouseNp.onclick = async function(event) {
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const ref = event.target.dataset.ref;
            warehouse_input.value = fullText;
            //warehouse_input.setAttribute('data-ref', ref);
            warehouse_ref_np.value = ref;
            document.querySelector('.resusWarehouseNp').classList.add('d-none');
            warehouse_input.setAttribute("readonly",true);
       

        };

        document.addEventListener('click', function(event) {
            const resusWarehouseNp = document.querySelector('.resusWarehouseNp'); // Находим элемент resusltCityNp
        
            // Проверяем, произошел ли клик вне блока resusltCityNp
            if (!resusWarehouseNp.contains(event.target) && !warehouse_input.contains(event.target)) {
                resusWarehouseNp.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
            }
        });
       
    }

    
    

})