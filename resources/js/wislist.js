
import ToastIsses from './toast'
document.addEventListener("DOMContentLoaded", function() {
    const AddWislistLists = document.querySelectorAll('#AddWislistList');
    const AddWislistShow = document.querySelector('#AddWislistShow');
    const deleteWishlists = document.querySelectorAll('.deleteWishlist');
    if(deleteWishlists) {
        deleteWishlists.forEach(function(deleteWishlist) {
            deleteWishlist.onclick = async function(event) {
                let id  = event.target.closest('.deleteWishlist').dataset.id;
                try {
                    await axios.delete('/wislist/delete/'+id, {});
                    location.reload();

                } catch (error) {
                    console.log(error);
                }

            }
        })
    }
    if(AddWislistLists) {
        AddWislistLists.forEach(function(AddWislistList) {
            AddWislistList.onclick = async function(event) {
                let elementAdd  = event.target.closest('#AddWislistList').querySelector('.button_heart_card');
                let isAuth = elementAdd.dataset.auth;
                if(isAuth == 1) {
                    try {
                        const response = await axios.post('/wislist/add', {
                            id: elementAdd.dataset.id,
                        });
                       
                        
                        ToastIsses(
                            response.data.mess['type'],
                            response.data.mess['heading'],
                            response.data.mess['text']
                        )
                        countWislistLabel()
                              
                        
                        
                    } catch (error) {
                        console.log(error);
                    }
                } else {
                    document.location.href = "/auth";
                }
                
            }
        });
    }
    if(AddWislistShow) {
        AddWislistShow.addEventListener('click', function() {
            let dataAttr = this.dataset;
            let id = dataAttr.id;
            let isAuth = dataAttr.auth;
            if(isAuth == 1) {
                const asyncAddWislistShow= async () => {
                    try {
                        const response = await axios.post('/wislist/add', {
                            id: id,
                        });
                            
                                
                        ToastIsses(
                            response.data.mess['type'],
                            response.data.mess['heading'],
                            response.data.mess['text']
                        )
                        countWislistLabel()
                                    
                                
                                
                    } catch (error) {
                        console.log(error);
                    }
                }
                asyncAddWislistShow()
            } else {
                document.location.href = "/auth";
            } 
        })
    }
    

    const countWislistLabel = async () => {
        const countWislist = document.querySelector('.countWislist');
        const countWishlistMob = document.querySelector('#countWishlistMob');
        
        try {
            const response = await axios.get('/wislist/count');
            countWislist.innerText = response.data.count;

            countWishlistMob.innerText = response.data.count;
            
        } catch (error) {
            console.log(error);
        }
    };
    countWislistLabel()
    
});