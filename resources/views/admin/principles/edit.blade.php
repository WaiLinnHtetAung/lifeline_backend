@extends('layouts.app')
@section('title', 'Edit Principle')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-doughnut-chart' style="color: rgb(8, 184, 8);"></i>
        <div>{{ __('messages.principle.title') }} Edition</div>
    </div>
    <div class="card mt-3 p-4">
        <span class="mb-4">{{ __('messages.principle.title') }} Edition</span>

        <form action="{{ route('admin.principles.update', $principle->id) }}" method="post" id="principle_update">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.principle.fields.name') }}</label>
                        <input type="text" name="name" class="form-control"
                            value="{{ old('name', $principle->name) }}">
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-12 col-12">
                    <div class="form-group mb-4">
                        <label for="">{{ __('messages.principle.fields.country') }}</label>
                        <input type="text" name="country" class="form-control"
                            value="{{ old('country', $principle->country) }}">
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
    {!! JsValidator::formRequest('App\Http\Requests\Admin\UpdatePrincipleRequest', '#principle_update') !!}

@endsection
