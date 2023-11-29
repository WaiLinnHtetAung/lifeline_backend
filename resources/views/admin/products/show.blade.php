@extends('layouts.app')
@section('title', 'Product Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-capsule' style="color: rgb(8, 184, 175);"></i>
        <div>{{ __('messages.product.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.product.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th>{{ __('messages.product.fields.photo') }}</th>
                    <td>
                        <div class="d-flex align-items-center gap-4 overflow-x-scroll">
                            @foreach ($product->getMedia('images') as $image)
                                <img src="{{ $image->getUrl() }}" alt="" width="200">
                            @endforeach
                        </div>
                    </td>
                </tr>
                <tr>
                    <th>{{ __('messages.product.fields.name') }}</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.product.fields.price') }}</th>
                    <td>{{ number_format($product->price ?? '00000') . ' MMK' }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.product.fields.category') }}</th>
                    <td>{{ $product->category->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.product.fields.principle') }}</th>
                    <td>{{ $product->principle->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.product.fields.ingredient') }}</th>
                    <td>
                        @foreach ($product->ingredients as $item)
                            <span class="badge bg-warning rounded-pill me-1">{{ $item->name }}</span>
                        @endforeach
                    </td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List </button>
        </div>
    </div>
@endsection
