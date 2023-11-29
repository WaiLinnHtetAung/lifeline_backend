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
                <div class="col-lg-4 col-md-12 col-sm-12 col-12">
                    <div class="form-group mb-4 ">
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

            </div>
            <div class="row">
                <div class="col-lg-8 col-md-12 col-sm-12 col-12 mt-3">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.product.fields.photo') }}</label>
                        <div class="needslick dropzone" id="image-dropzone">

                        </div>
                        @error('images')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
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
                <button class="btn btn-primary">Create </button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdateProductRequest', '#product_edit') !!}

    <script>
        let uploadedImageMap = {}
        Dropzone.options.imageDropzone = {
            url: "{{ route('admin.products.storeMedia') }}",
            maxFilesize: 10,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            success: function(file, response) {

                $('form').append('<input type="hidden" name="images[]" value="' + response.name + '">')
                uploadedImageMap[file.name] = response.name
            },
            removedfile: function(file) {
                file.previewElement.remove();
                let name = file.file_name || uploadedImageMap[file.name];
                $('input[name="images[]"][value="' + name + '"]').remove();
                $.ajax({
                    url: "{{ route('admin.products.deleteMedia') }}", // Change this to the appropriate delete route
                    method: "POST",
                    data: {
                        _token: "{{ csrf_token() }}",
                        file_name: name
                    },
                    success: function(response) {
                        console.log("File deleted successfully:", response);
                    },
                    error: function(xhr, status, error) {
                        console.error("Error deleting file:", error);
                    }
                });
            },
            init: function() {
                @if (isset($product) && $product->productImages())
                    var files = {!! json_encode($product->productImages()) !!}

                    for (var i in files) {
                        var server_url = `{{ url('/media/${files[i].order_column}/') }}`;
                        var file = {
                            name: files[i].file_name,
                            size: files[i].size,
                            accepted: true
                        };

                        this.files.push(file); // Add the file to Dropzone's files array
                        this.emit("addedfile", file); // Emit the "addedfile" event
                        this.emit("thumbnail", file, server_url + '/' + files[i]
                            .file_name); // Emit the "thumbnail" event
                        this.emit("complete", file); // Emit the "complete" event

                        $('form').append('<input type="hidden" name="images[]" value="' + files[i].file_name + '">')
                        uploadedImageMap[file.name] = files[i].file_name

                        // Adjust thumbnail image styles to fit within a container
                        var thumbnailElement = this.files[i].previewElement.querySelector(".dz-image img");
                        thumbnailElement.style.maxWidth = "100%";
                        thumbnailElement.style.height = "auto";
                    }
                @endif

            },


        }
    </script>
@endsection
