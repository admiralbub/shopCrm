<div class="position-relative">
    <label class="form-label">{{ $title }}</label>

    <input class="form-control" id="warehouse_input" {{ $attributes }} readonly>
    <div class="resusltInput position-absolute bg-light py-3 px-2 z-3 d-none resusltWarehouseNp">
        <ul id="resusltWarehouseNp">
        </ul>
    </div>
</div>