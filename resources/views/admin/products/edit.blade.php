@extends('layouts.app')
@section('title', 'Edit Product')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-capsule' style="color: rgb(8, 184, 175);"></i>
        <div>{{ __('messages.product.title') }} Edition</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">{{ __('messages.product.title') }} Edition</span>

        <form action="{{ route('admin.products.update', $product->id) }}" method="post" id="product_edit"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.product.fields.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12 ">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.product.fields.price') }}</label>
                        <div class="input-group">
                            <span class="input-group-text bg-secondary text-white">MMK</span>
                            <input type="number" class="form-control" name="price"
                                value="{{ old('price', $product->price) }}">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.product.fields.photo') }}</label>
                        <input type="file" class="form-control" name="photo" onchange="showPreview(this);">
                        <img src="{{ $product->imgUrl() }}" alt="" class="mt-3" id="imgPreview" width="100">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="form-group mb-4 mt-4 pt-2">
                        <label for="">{{ __('messages.product.fields.principle') }}</label>
                        <select name="principle_id" id="" class="form-control select2"
                            data-placeholder="--- Please Select ---">
                            <option value=""></option>
                            @foreach ($principles as $id => $value)
                                <option value="{{ $id }}"
                                    {{ old('principle_id') || $product->principle_id == $id ? 'selected' : '' }}>
                                    {{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.product.fields.ingredient') }}</label>
                        <div class="mb-2">
                            <span class="text-white p-1 rounded-1 cursor-pointer select-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Select
                                All</span>
                            <span class="text-white p-1 rounded-1 cursor-pointer disselect-all"
                                style="font-size: 12px; background: rgb(27, 199, 170);">Disselect
                                All</span>
                        </div>
                        <select name="ingredients[]" id="ingredients" class="select2 form-control" multiple="multiple"
                            data-placeholder="--- Please Select ---">
                            @foreach ($ingredients as $id => $value)
                                <option value="{{ $id }}"
                                    {{ in_array($id, old('ingredients', [])) || $product->ingredients->contains($id) ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
            <div class="mt-5">
                <button class="btn btn-secondary back-btn">Cancel</button>
                <button class="btn btn-primary">Create</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateProductRequest', '#product_edit') !!}

    <script>
        const showPreview = (input) => {
            if (input.files && input.files[0]) {
                let reader = new FileReader();

                reader.onload = function(e) {
                    $('#imgPreview').attr('src', e.target.result).width(150).height(150);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
