@extends('layouts.app')
@section('title', 'Category Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-food-menu' style="color: rgb(182, 119, 36);"></i>
        <div>{{ __('messages.category.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.category.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th width="25%">ID</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $category->name }}</td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
