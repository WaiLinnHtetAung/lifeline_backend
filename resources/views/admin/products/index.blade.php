@extends('layouts.app')
@section('title', 'Products')

@section('content')
    <div class="card-head-icon">
        <i class='bx bxs-capsule' style="color: rgb(8, 184, 175);"></i>
        <div>{{ __('messages.product.title') }}</div>
    </div>

    <div class="card mt-3">
        <div class="d-flex justify-content-between m-3">
            <span>{{ __('messages.product.title') }} List</span>
            @can('user_create')
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary text-decoration-none text-white"><i
                        class='bx bxs-plus-circle me-2'></i>
                    Create New {{ __('messages.product.title') }}</a>
            @endcan
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped w-100" id="DataTable">
                <thead>
                    <th class="no-sort"></th>
                    <th class="no-sort">{{ __('messages.product.fields.photo') }}</th>
                    <th>{{ __('messages.product.fields.name') }}</th>
                    <th>{{ __('messages.product.fields.price') }}</th>
                    <th>{{ __('messages.product.fields.principle') }}</th>
                    <th class="no-sort">{{ __('messages.product.fields.ingredient') }}</th>
                    <th class="no-sort text-nowrap">Action</th>
                </thead>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            //datatable
            const table = new DataTable('#DataTable', {
                processing: true,
                responsive: true,
                serverSide: true,
                ajax: '/admin/product-datatable',
                columns: [{
                        data: 'plus-icon',
                        name: 'plus-icon'
                    },
                    {
                        data: 'photo',
                        name: 'photo'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'principle_id',
                        name: 'principle_id'
                    },
                    {
                        data: 'ingredients',
                        name: 'ingredients'
                    },
                    {
                        data: 'action',
                        data: 'action',
                    }
                ],
                columnDefs: [{
                    targets: 'no-sort',
                    sortable: false,
                    searchable: false
                }, {
                    targets: [0],
                    class: 'control'
                }]
            })

            //delete function
            $(document).on('click', '.delete-btn', function(e) {
                e.preventDefault();

                let id = $(this).data('id');

                Swal.fire({
                    title: 'Are you sure to delete ?',
                    showCancelButton: true,
                    confirmButtonText: 'Confirm',
                    denyButtonText: `Don't save`,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "/admin/products/" + id,
                            type: "DELETE",
                            success: function() {
                                table.ajax.reload();
                            }
                        })
                    }
                })
            })
        })
    </script>
@endsection
