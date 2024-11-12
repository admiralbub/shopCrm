import Swal from 'sweetalert2'
import Lang from './lang/lang'


Lang();


function showErr(field, errText) {
    const parent = field.parentNode;
    
    field.classList.add("field-error");
    const err = document.createElement('span');
    err.textContent = errText;
    parent.append(err);
    err.classList.add('error-title');
    

}

function hideErr(field) {
    const parent = field.parentNode;
    if(field.classList.contains('field-error')) {
        field.classList.remove('field-error');
        parent.querySelector('.error-title').remove();
    }
    
}



function validateEmail(email) {
    // Regular expression for a basic email pattern
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}
function validatePhoneNumber(phone) {
    const regex = /^\+38\(\d{3}\)\d{3}-\d{2}-\d{2}$/;
    return regex.test(phone);
}
function validField(input) {
    hideErr(input)
    let result = true;
    let pass = document.getElementById('password');
    
    if(input.dataset.require == "true") {
        if (input.tagName === 'INPUT') {
            if(input.value == "") {
                showErr(input, window.lang.validator.empty);
                result = false;
            } else if(input.name=="email") {
                if (!validateEmail(input.value)) {
                    showErr(input, window.lang.validator.email);
                    result = false;
                }
            } else if(input.dataset.max) {
                if(input.value.length >  input.dataset.max) {
                    showErr(input, window.lang.validator.maxlength);
                    result = false;
                }
            } else if(input.name=="password_confirmation") {
                if(pass.value != input.value) {
                    showErr(input, window.lang.validator.confirm_pass);
                    result = false;
                }
            } else if(input.name=="phone") {
                if (!validatePhoneNumber(input.value)) {
                    showErr(input, window.lang.validator.phone);
                    result = false;
                }
            } else if(input.dataset.min) {
                if(input.value.length < input.dataset.min) {
                    showErr(input, window.lang.validator.minlength);
                    result =false;
                }
            }
        } else if (input.tagName === 'SELECT') {
            if (input.value == "" || input.value == "default") { // Проверка на значение по умолчанию
                showErr(input, window.lang.validator.select_required);
                result = false;
            }
        }
        
            
    }
    return result;
}

function validation(form) {
    const AllInput = form.querySelectorAll('input, select');
    let result = true;
    for(let input of AllInput) {
        if (!validField(input)) {
            result = false; // Установить флаг в false, если хоть одно поле не валидно
        }
       
    }
    return result;
}

//Валидация при нажатие на кнопку

const form = document.getElementById('form');
if(form) {
    const inputs = form.querySelectorAll('input, select');
    //Dunamic validation for auth 
    form.addEventListener('submit',function(event) {
        event.preventDefault();
        if(validation(this) == true) {
            form.submit();
        } else {
            Swal.fire({
                title: window.lang.validator.error,
                text: window.lang.validator.error_valid,
                icon: "error"
              });
        }

    })
    inputs.forEach(input => {
        input.addEventListener('input', function() {
            validField(input)
        })
    })
}
