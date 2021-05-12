<div id="print-area">
    <table class="table table-hover table-bordered">

        <thead>
        <tr>
            <th>@lang('site.name')</th>
            <th>@lang('site.quantity')</th>
            <th>@lang('site.price.price')</th>
        </tr>
        </thead>

        <tbody>
        @foreach ($products as $product)
            <tr>
                @if (app()->getLocale()=='ar')
                <td>{{ $product->name_ar }}</td>
                @else
                <td>{{ $product->name_en }}</td>
                @endif

                <td>{{ $product->pivot->qunatity }}</td>
                <td>{{ number_format($product->pivot->qunatity * $product->sale_price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
    <h3>@lang('site.total_price') <span>{{ number_format($order->total_price, 2) }}</span></h3>

</div>

<button class="btn btn-block btn-primary print-btn"><i class="fa fa-print"></i> @lang('site.print')</button>
