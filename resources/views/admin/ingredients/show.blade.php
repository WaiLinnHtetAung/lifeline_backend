@extends('layouts.app')
@section('title', 'Ingredient Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-doughnut-chart' style="color: rgb(8, 184, 8);"></i>
        <div>{{ __('messages.ingredient.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.ingredient.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th width="25%">ID</th>
                    <td>{{ $ingredient->id }}</td>
                </tr>
                <tr>
                    <th>Name</th>
                    <td>{{ $ingredient->name }}</td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
