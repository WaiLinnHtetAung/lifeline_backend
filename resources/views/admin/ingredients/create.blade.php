@extends('layouts.app')
@section('title', 'Create Ingredients')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-doughnut-chart' style="color: rgb(8, 184, 8);"></i>
        <div>{{ __('messages.ingredient.title') }} Creation</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">{{ __('messages.ingredient.title') }} Creation</span>

        <form action="{{ route('admin.ingredients.store') }}" method="post" id="ingredient_create">
            @csrf
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.ingredient.fields.name') }}</label>
                        <input type="text" name="name" class="form-control" value="{{ old('name') }}">
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\StoreIngredientRequest', '#ingredient_create') !!}

@endsection
