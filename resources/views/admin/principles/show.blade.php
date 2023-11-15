@extends('layouts.app')
@section('title', 'Principle Detail')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-user-check' style="color: rgb(157, 21, 161);"></i>
        <div>{{ __('messages.principle.title') }} Detail</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.principle.title') }} Detail</span>

        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="DataTable">
                <tr>
                    <th>{{ __('messages.principle.fields.name') }}</th>
                    <td>{{ $principle->name }}</td>
                </tr>
                <tr>
                    <th>{{ __('messages.principle.fields.country') }}</th>
                    <td>{{ $principle->country }}</td>
                </tr>
            </table>
            <button class="btn btn-outline-secondary mt-3 back-btn">Back to List</button>
        </div>
    </div>
@endsection
