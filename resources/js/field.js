document.addEventListener("DOMContentLoaded", function() {
    const deliver = document.querySelector('#deliver');
    const np_city_input = document.querySelector('#np_city_input');
    const resusltCityNp = document.querySelector('#resusltCityNp');

    
    const resusltWarehouseNp = document.querySelector('#resusltWarehouseNp');
    if(deliver) {
        deliver.addEventListener("change", () => {
            const deliverValue = deliver.value;
            switch(deliverValue) {
                case "NP":
                    document.querySelector('#np_city_block').classList.remove('d-none');
                    document.querySelector('#np_warehouse_block').classList.remove('d-none');


                    break;

                case "default":
                    document.querySelector('#np_city_block').classList.add('d-none');
                    document.querySelector('#np_warehouse_block').classList.add('d-none');
                    break;
            }
        })
    }
    if(np_city_input) {
        np_city_input.addEventListener('input', function() {
            
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

        resusltCityNp.onclick = async function(event) {
            const fullText = event.target.textContent.trim(); // Получаем полный текст из <li> и удаляем лишние пробелы
            const ref = event.target.dataset.ref;
            np_city_input.value = fullText;
            np_city_input.setAttribute('data-ref', ref);
            document.querySelector('.resusltCityNp').classList.add('d-none');

        };
        function toHtmlCity(np) {
            return `<li class="py-2" data-ref="${np.Ref}">${np.Present}</li>`
        }
    }
    

})