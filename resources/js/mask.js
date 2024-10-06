

import IMask from 'imask';
document.querySelectorAll('input.tel').forEach(function (element) {
    let maskOptions = {
        mask: '+{38}(000)000-00-00',
        lazy: false, 
    };
    let mask = IMask(element, maskOptions);
});