import Sortable, { MultiDrag, Swap } from 'sortablejs';

import RateController from './controllers/rate_controller';

application.register('rate', RateController)

document.addEventListener("turbo:load", () => {
    let el1 = document.querySelectorAll('.treeSort');
    el1.forEach(function(list,index) {
        new Sortable(list, {
            group: `shared`,
            animation: 150,
            
            onEnd: async function (evt) {


                
                let liElements = Array.from(evt.to.children);

                let order = liElements.map(el => el.dataset.id);
                
                let newParentId = evt.to.dataset.parent;  // Предполагаем, что у списка есть data-атрибут с ID



                await fetch('/writesort_product',{
                    method: "POST",
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-Token': document.querySelector('input[name="_token"]').value,
                    },
                    body: JSON.stringify({
                        'orderLists':order,
                        'parent':newParentId
                    })
                });
            }
            
        })
    });
    
});

import './fieldAdmin.js'