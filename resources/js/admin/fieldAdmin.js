




const onPageLoad = () => {

    
    const np_city_input = document.querySelector('#np_city_input');
    const resusltCityNp = document.querySelector('#resusltCityNp');
    const np_city_ref = document.querySelector('#np_city_ref');

    const warehouse_input = document.querySelector('#warehouse_input');
    const resusltWarehouseNp = document.querySelector('#resusltWarehouseNp');
    const city_ref_np = document.querySelector('#np_city_ref');
    const warehouse_ref_np = document.querySelector('#warehouse_ref_np');
    if(np_city_input) {
        np_city_input.addEventListener('input', function() {
            //warehouse_input.value = "";
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
        function toHtmlCity(np) {
            return `<li class="py-2" data-ref="${np.DeliveryCity}">${np.Present}</li>`
        }
        document.addEventListener('click', function(event) {
            const resusltCityNp = document.querySelector('.resusltCityNp'); // Находим элемент resusltCityNp
        
            // Проверяем, произошел ли клик вне блока resusltCityNp
            if (!resusltCityNp.contains(event.target) && !np_city_input.contains(event.target)) {
                resusltCityNp.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
            }
        });
        resusltCityNp.onclick =  function(event) {
            
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const ref = event.target.dataset.ref;
            np_city_input.value = fullText;
            np_city_ref.value=ref;
            warehouse_input.value = "";
            document.querySelector('.resusltCityNp').classList.add('d-none');
            warehouse_input.removeAttribute("readonly");

        

        };
    }
    if(np_city_input) {

        
        np_city_input.addEventListener('input', function() {
            warehouse_input.value = "";
            const asyncSearchCity = async () => {
                try {
                    const response = await axios.post('/novaposhta/getCity', {
                        city: this.value,
                    });
                    if(response['data'].length != 0) {
                        renderCityNp(response)
                        console.log(response['data'])
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
            document.querySelector('.resusltCityNp').classList.add('d-none');
            warehouse_input.removeAttribute("readonly");

        

        };
        function toHtmlCity(np) {
            return `<li class="py-2" data-ref="${np.DeliveryCity}">${np.Present}</li>`
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
            document.querySelector('.resusltWarehouseNp').classList.remove('d-none');
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
            document.querySelector('.resusltWarehouseNp').classList.add('d-none');
            warehouse_input.setAttribute("readonly",true);
    

        };
        document.addEventListener('click', function(event) {
            const resusltWarehouseNp = document.querySelector('.resusltWarehouseNp'); // Находим элемент resusltCityNp
        
            // Проверяем, произошел ли клик вне блока resusltCityNp
            if (!resusltWarehouseNp.contains(event.target) && !warehouse_input.contains(event.target)) {
                resusltWarehouseNp.classList.add('d-none'); // Скрываем элемент, если клик был вне блока и вне поля ввода
            }
        });

        
    
    }
}


document.addEventListener("turbo:load",  onPageLoad())
document.addEventListener("orchid:listener:after-render", onPageLoad())
document.addEventListener('DOMContentLoaded', onPageLoad())

onPageLoad();
