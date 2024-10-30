
document.addEventListener('DOMContentLoaded', function () {
    const selectElement = document.getElementById('sortProduct');
    if(selectElement) {
            // Listen for changes in the select input
        selectElement.addEventListener('change', function() {
            // Get the selected option value
            const selectedValue = this.value;
            getUrlParam(selectedValue); 
        });

        function getUrlParam(sParam)
        {    
            let url = window.location.href;    
            if (url.indexOf('?') < -1){
                url = '?sort='+sParam
            } else {
                url = '?sort='+sParam
            }
            window.location.href = url;
        }
    }
})