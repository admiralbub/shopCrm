<x-layouts.app  
    :title="__('Compare')"
    :descriptions="__('Compare')"
    :keywords="__('Compare')">

    <div class="container mt-5 mb-5">
        <h1 class="fs-3">{{__('Compare')}}</h1>
        @if(count($products)>0)
            <div class="table-compare table-responsive-sm">
                <table>
                    <tbody>
                        <tr class="resp">
                            <th>{{__('Product')}}</th>
                            
                            @foreach($products as $product)
                                <th class="name_product">
                                    <a href="{{route('product.view',['slug'=>$product->slug])}}" rel="nofollow" >
                                        {{$product->name}}
                                    </a>
                                    
                                </th>
                            @endforeach
                            
                            
                        </tr>
                        <tr class="resp">
                            <td>
                                <strong>
                                    {{__('Image')}}
                                </strong>
                            </td>
                            @foreach($products as $product)
                                <td>
                                    <div class="image">
                                        <a href="{{route('product.view',['slug'=>$product->slug])}}" rel="nofollow" class="image">
                                            <img src="{{$product->image}}" alt="" width="200px">
                                        </a>
                                    </div>
                                    
                                    
                                </td>
                            @endforeach
                        
                        </tr>
                        <tr class="resp">
                            <td>
                                <strong>
                                    {{__('Price')}}
                                </strong>
                            </td>
                            @foreach($products as $product)
                                <td>
                                    <span class="fs-5">{{ $product->price * ($product->packs->count() > 0 ? $product->packs->first()->volume : 1) }} {{__("uah")}}</span>
                                </td>
                            @endforeach
                            
                        </tr>
                        <tr class="resp">
                            <td>
                                <strong>
                                    {{__('Brand')}}
                                </strong>
                            </td>
                            @foreach($products as $product)
                                <td>
                                    <a href="{{route('product.brand.show',['slug'=>$product->brand->slug])}}">
                                        {{$product->brand->name}}
                                    </a>
                                
                                    
                                </td>
                            @endforeach
                            
                        </tr>
                        <tr class="resp">
                            <td>
                                <strong>
                                    {{__('Pack')}}
                                </strong>
                            </td>
                            @foreach($products as $product)
                                <td class="class-center">
                                    {{$product->packs->first()->name}}
                                </td>
                            @endforeach
                        
                        </tr>
                        <tr class="resp">
                            <td>
                                <strong>
                                    {{__('Attribute')}}
                                </strong>
                            </td>
                            <td class="class-center">
                                @if($attrs->count())
                                    @foreach($attrs as $groupName => $attributes)
                                        <strong>{{$groupName}}:</strong>
                                        @foreach ($attributes as $attr) 
                                            {{ $attr->name }}
                                            @if(!$loop->last) | @endif
                                        @endforeach       
                                    @endforeach
                                @endif
                            </td>
                        
                        </tr>
                        <tr class="resp">
                            <td>
                            
                            </td>
                            
                            @foreach($products as $product)
                                <td>    
                                    <button type="button" class="btn btn-light deleteCompare" data-id="{{$product->id}}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </td>
                            @endforeach
                        
                        
                        </tr>
                        
                    </tbody>
                </table>
            </div>

        @else
            <div class="fs-5 pt-3">
                <span>{{__('You have no products in the comparison list.')}}</span>
            </div>
        @endif
    </div>

</x-layouts.app>