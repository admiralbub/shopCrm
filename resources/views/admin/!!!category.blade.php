
<div class="treeCategory">
    <ul class="tree treeSort" id="tree" data-parent="0">
        @foreach($categories as $row)

            @if($row->childrenCategories !=0) 
                <li data-id="{{$row->id}}">
                    <details>
                        <summary class="d-flex justify-content-between">
                            {{$row->name_ua}}
                            <a href="{{route('platform.category.edit', $row->id)}}" class="px-4">
                                <img src="{{asset('icon/pen.png')}}" alt="" width="22px">
                            </a>
                        </summary>
                            <ul class="treeSort2" data-parent="{{$row->id}}">
                                @foreach($row->childrenCategories->sortBy('sort')  as $subcategory)
                          
                                    @if($subcategory->childs->count())
                                        <li data-id="{{$subcategory->id}}">
                                            <details>
                                                <summary  class="d-flex justify-content-between">
                                                    {{$subcategory->name_ua}}
                                                    <a href="{{route('platform.category.edit', $subcategory->id)}}" class="px-4">
                                                        <img src="{{asset('icon/pen.png')}}" alt="" width="22px">
                                                    </a>
                                                </summary>
                                                <ul class="treeSort3" data-parent="{{$subcategory->id}}">
                                                    @foreach($subcategory->childs->sortBy('sort')  as $subcategory2)
                                                        <li class="d-flex justify-content-between">
                                                            {{$subcategory2->name_ua}}
                                                            <a href="{{route('platform.category.edit', $subcategory2->id)}}" class="px-4">
                                                                <img src="{{asset('icon/pen.png')}}" alt=""  width="22px">
                                                            </a>
                                                        </li>
                                                    @endforeach
                                                </ul>  
                                            </details>
                                        </li>
                                     @else
                                        <li class="d-flex justify-content-between" data-id="{{$subcategory->id}}">
                                            {{$subcategory->name_ua}}
                                            <a href="{{route('platform.category.edit', $subcategory->id)}}" class="px-4">
                                                <img src="{{asset('icon/pen.png')}}" alt=""  width="22px">
                                            </a>
                                        </li>
                                    @endif
                                    
                                @endforeach
                            </ul>
                    </details>
                </li>
            @else
                <li class="d-flex justify-content-between " data-id="{{$row->id}}"> 
                    {{$row->name_ua}}
                    <a href="{{route('platform.category.edit', $row->id)}}" class="px-4">
                        <img src="{{asset('icon/pen.png')}}" alt=""  width="22px">
                    </a>
                </li>
            @endif
           
        @endforeach
    </ul>

</div>
