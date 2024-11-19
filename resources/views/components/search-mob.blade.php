<!-- Modal -->
<div class="modal fade" id="searchMobModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">{{__('Search')}}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form class="mob-search" action="{{route('products.search')}}" method="GET">
                <div class="mob-search-box position-relative">
                    <input class="mob-search-box-input" type="text" name="search" id="search_mob" value="" data-language="index_search" placeholder="{{__('Search')}}..." autocomplete="off">
                    <button class="mob-search-box-btn" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                                            
                    </button>
                    <div class="search_block_mob d-none"></div>
                </div>
            </form>

            </div>
           
        </div>
    </div>
</div>