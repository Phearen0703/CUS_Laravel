@extends('backends.layouts.master')
@section('title')
    home page
@endsection

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Books</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{ $totalBooks }}</h3>
                    </div>
                    <!--end col-->
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fa-solid fa-book h1 align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>

            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Categorys</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{ $totalCategories }}</h3>
                    </div>
                    <!--end col-->
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fa-solid fa-layer-group h1 align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>

            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    <div class="col-md-6 col-lg-4">
        <div class="card">
            <div class="card-body">
                <div class="row d-flex justify-content-center border-dashed-bottom pb-3">
                    <div class="col-9">
                        <p class="text-dark mb-0 fw-semibold fs-14">Users</p>
                        <h3 class="mt-2 mb-0 fw-bold">{{ $totalUsers }}</h3>
                    </div>
                    <!--end col-->
                    <div class="col-3 align-self-center">
                        <div
                            class="d-flex justify-content-center align-items-center thumb-xl bg-light rounded-circle mx-auto">
                            <i class="fa-solid fa-user h1 align-self-center mb-0 text-secondary"></i>
                        </div>
                    </div>
                    <!--end col-->
                </div>

            </div>
            <!--end card-body-->
        </div>
        <!--end card-->
    </div>
    
</div>
@endsection