import {Toast} from 'bootstrap';
function ToastIsses(type,heading,text) {
    showToast()
    console.log(type)
    switch (type) {
        case 'success':
            
            document.querySelector('.toastBody').innerHTML = text;
            document.querySelector('.titleToast').innerHTML = heading;
            document.querySelector('.iconToast').classList.add('success');
            
            break;
        case 'fail':
            document.querySelector('.toastBody').innerHTML = text;
            document.querySelector('.titleToast').innerHTML = heading;
            document.querySelector('.iconToast').classList.add('fail');
            break;
    }     
}

function showToast() {
    let myAlert = document.getElementById('toastMess'); // select id of toast
    if (myAlert) {
        let bsAlert = new Toast(myAlert); // initialize it
        bsAlert.show(); // show it
    }
}
export default ToastIsses;