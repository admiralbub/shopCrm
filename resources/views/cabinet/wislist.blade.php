<x-layouts.app  
    :title="__('Wishlist')"
    :descriptions="__('Wishlist')"
    :keywords="__('Wishlist')">

    <div class="account container py-5">
        <div class="row">
            <div class="col-lg-3">
                <x-cabinet.menu/>
            </div>
            <div class="col-lg-9 ">
                @if ($errors->any())
                     
                     <x-alert.alert status="danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                        
                    </x-alert.alert>
                @endif
                <div class="account_heading">
                    <h1 class="fs-4">{{__('Wishlist')}}</h1>    
                </div>
                <div class="mt-3">
                    @if(count($wishlists)>0)
                        <div class="table-responsive-sm table-wislist">
                            <table class="table table-hover table-responsive">
                                <thead>
                                    <tr class="pb-3">
                                        <th scope="col"></th>
                                        <th scope="col">{{__('Product')}}</th>
                                        <th scope="col">{{__('Pack')}}</th>
                                        <th scope="col">{{__('Price')}}</th>
                                        <th scope="col">{{__('Status')}}</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach($wishlists as $wishlist)
                                
                                    <tr>
                                        <td>
                                            <a href="{{route('product.view',['slug'=>$wishlist->products->slug])}}" class="fs-6">
                                                <img src="{{asset($wishlist->products->image)}}" alt=""  class="image">
                                            </a>
                                        </td>
                                        <td class="pt-4">
                                            <a href="{{route('product.view',['slug'=>$wishlist->products->slug])}}" class="fs-6">
                                                {{$wishlist->products->name}}
                                            </a>
                                        </td>
                                        <td class="fs-6 pt-4">
                                            {{$wishlist->products->packs()->first()->name}}           
                                        </td>
                                        <td class="fs-6 pt-4">
                                            {{ $wishlist->products->price * ($wishlist->products->packs->count() > 0 ? $wishlist->products->packs->first()->volume : 1) }} {{__("uah")}}             
                                        </td>
                                        <td class="fs-6 pt-4">
                                            <span class="{{$wishlist->products->status_available ? 'status-stock' : 'status-no'}}">
                                                {{$wishlist->products->status_text}}
                                
                                        
                                            </span>            
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-light deleteWishlist" data-id="{{$wishlist->id}}">
                                                <i class="bi bi-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach          
                                        
                                </tbody>
                            </table>
                        </div>
                        {{$wishlists->links()}}
                    @else
                        <span class="fs-4">{{__('You do not have any products in your favorites list')}}</span>
                    @endif


                </div>
          
            </div>
        </div>
    </div>
    

</x-layouts.app>