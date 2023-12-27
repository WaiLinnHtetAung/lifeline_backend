@extends('layouts.app')

@section('content')
    <div class="content-wrapper">
        <!-- Content -->

        <div class="row">
            <div class="col-lg-12 mb-4 order-0">
                <div class="card">
                    <div class="d-flex align-items-end row">
                        <div class="col-sm-7">
                            <div class="card-body">
                                <h5 class="card-title text-primary">Welcome Back {{ auth()->user()->name }}! 🙋🏻</h5>
                                <p class="mb-4">
                                    Welcome to the Admin Dashboard – your command center for streamlined management. Gain
                                    real-time insights, wield control, and navigate administrative tasks effortlessly. From
                                    user management to analytics, this dashboard is your key to informed decision-making.
                                    Let's embark on a journey of efficient administration together.
                                </p>

                                <span class="bg-primary text-white py-2 px-4 badge rounded-pill">
                                    {{ auth()->user()->roles ? auth()->user()->roles[0]->name : '' }}
                                </span>
                            </div>
                        </div>
                        <div class="col-sm-5 text-center text-sm-left">
                            <div class="card-body pb-0 px-0 px-md-4">
                                <img src="../assets/img/illustrations/dashboard.jpg" height="200" alt="View Badge User" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- / Content -->
        <div class="content-backdrop fade"></div>
    </div>
@endsection
