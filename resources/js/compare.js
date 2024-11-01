
import ToastIsses from './toast'
document.addEventListener("DOMContentLoaded", function() {
    const AddCompareLists = document.querySelectorAll('#AddCompareList');
    const AddCompareShow = document.querySelector('#AddCompareShow');
    const deleteCompares = document.querySelectorAll('.deleteCompare');

    if(deleteCompares) {
        deleteCompares.forEach(function(deleteCompare) {
            deleteCompare.onclick = async function(event) {
                let id  = event.target.closest('.deleteCompare').dataset.id;
                try {
                    await axios.delete('/compare/delete/'+id, {});
                    location.reload();

                } catch (error) {
                    console.log(error);
                }

            }
        })
    }
    if(AddCompareShow) {
        AddCompareShow.addEventListener('click', function() {
            let dataAttr = this.dataset;
            let id = dataAttr.id;
            const asyncAddCompareShow= async () => {
                try {
                    const response = await axios.post('/compare/add', {
                        id: id,
                    });
                        
                            
                    ToastIsses(
                        response.data.mess['type'],
                        response.data.mess['heading'],
                        response.data.mess['text']
                    )
                    countCompareLabel()
                                
                            
                            
                } catch (error) {
                    console.log(error);
                }
            }
            asyncAddCompareShow()
        })
    }

    if(AddCompareLists) {
        AddCompareLists.forEach(function(AddCompareList) {
            
            AddCompareList.onclick = async function(event) {
                const elementAddCompare  = event.target.closest('#AddCompareList').querySelector('.button_scale_card');
                try {
                    const response = await axios.post('/compare/add', {
                        id: elementAddCompare.dataset.id,
                    });
                    
                    ToastIsses(
                        response.data.mess['type'],
                        response.data.mess['heading'],
                        response.data.mess['text']
                    )
                    //countWislistLabel()
                    countCompareLabel()      
                    
                    
                } catch (error) {
                    console.log(error);
                }

            }
        })
    }

    const countCompareLabel = async () => {
        const countCompare = document.querySelector('.countCompare');
        const countCompareMob = document.querySelector('#countCompareMob');
        
        try {
            const response = await axios.get('/compare/count');
            countCompare.innerText = response.data.count;

            countCompareMob.innerText = response.data.count;
            
        } catch (error) {
            console.log(error);
        }
    };
    countCompareLabel()
    
})
