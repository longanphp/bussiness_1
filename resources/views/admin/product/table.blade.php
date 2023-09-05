@forelse($products as $product)
    <tr>
        <td class="text-center">{{ indexTable($products->currentPage(), $products->perPage(), $loop->index) }}</td>
        <td><img src="{{ asset($product->avatar) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>
            <div class="font-14">{{ $product->name }}</div>
            <div><b>{{ __('Lượt xem:') }}</b> 20</div>
            <div><b>{{ __('Yêu thích:') }}</b> 20</div>
            <div><b>{{ __('Đã bán:') }}</b> 20</div>
        </td>
        <td><img src="{{ asset($product->brand->avatar) }}" width="100" height="100" class="object-fit-cover image-table" alt=""></td>
        <td>{{ $product->category->name }}</td>
        <td>
            @if($product->quantity)
                <b>{{ $product->quantity }}</b>
            @else
                <div class="text-danger">
                    <b>{{ __('Hết hàng') }}</b>
                </div>
            @endif
        </td>
        <td class="{{ $product->status_action->class }}"><b>{{ $product->status_action->msg }}</b></td>
        <td>{{ formatTime($product->created_at) }}</td>
        <td>
            <button class="btn btn-warning edit-product" data-url="{{ route('admin.products.show', $product->id) }}" type="button">{{ __('Sửa') }}</button>
            <button class="btn btn-danger delete-product" data-id="{{ $product->id }}" type="button">{{ __('Xóa') }}</button>
            <button class="btn {{ $product->status_action->btn }} update-status"
                    data-id="{{ $product->id }}" data-status="{{ $product->status_action->status }}" type="button">
                {{ $product->status_action->text_btn }}
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td class="text-center" colspan="9">{{ __('Không có dữ liệu.') }}</td>
    </tr>
@endforelse
