@props(['sortParams', 'sortOrders'])

<div class="mt-2 bg-light p-2">
    <form action="{{ URL::current() }}" method="GET">
        <div class="row">
            <div class="col">
                <x-form.select class="form-control-sm" name="sort" required>
                    <option value="">Sort By</option>
                    @foreach ($sortParams as $paramKey => $param)
                        <option value="{{ $paramKey }}" {{ request()->sort == $paramKey ? "selected" : "" }}>{{ $param }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div class="col">
                <x-form.select class="form-control-sm" name="order" required>
                    <option value="">Order</option>
                    @foreach ($sortOrders as $orderKey => $order)
                        <option value="{{ $orderKey }}" {{ request()->order == $orderKey ? "selected" : "" }}>{{ $order }}</option>
                    @endforeach
                </x-form.select>
            </div>
            <div class="col">
                <button class="btn btn-primary btn-sm w-100" type="submit">
                    Sort
                </button>
            </div>
        </div>
    </form>
</div>