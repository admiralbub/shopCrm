<div class="sort">
    <div class="title_sort">
        {{__('Sort by')}}:
    </div>
    <div class="form_sort">
        <select class="form-select" aria-label="Default select example" id="sortProduct">
            <option value="default" >--</option>
            <option value="sort-name_asc" @if (request()->query('sort') == "sort-name_asc") selected="selected" @endif> {{__("sort_asc_title")}}</option>
            <option value="sort-name_desc" @if (request()->query('sort') == "sort-name_desc") selected="selected" @endif>{{__("sort_desc_title")}}</option>
            <option value="sort-price_desc" @if (request()->query('sort') == "sort-price_desc") selected="selected" @endif>{{__("sort_price_desc_title")}}</option>
            <option value="sort-price_asc" @if (request()->query('sort') == "sort-price_asc") selected="selected" @endif>{{__("sort_price_asc_title")}}</option>
        </select>
    </div>
 </div>