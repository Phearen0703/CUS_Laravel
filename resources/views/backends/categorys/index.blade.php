@extends('backends.layouts.master')
@section('title')
    category page
@endsection

@section('content')
    <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h4 class="card-title">Category</h4>
                            </div><!--end col-->
                            <div class="col-auto">
                                <form class="row g-2">
                                    <div class="col-auto">
                                        <a class="btn bg-primary-subtle text-primary dropdown-toggle d-flex align-items-center arrow-none"
                                            data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false"
                                            aria-expanded="false" data-bs-auto-close="outside">
                                            <i class="iconoir-filter-alt me-1"></i> Filter
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-start">
                                            <div class="p-2">
                                                <div class="form-check mb-2">
                                                    <input type="checkbox" class="form-check-input" checked id="filter-all">
                                                    <label class="form-check-label" for="filter-all">
                                                        All
                                                    </label>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div><!--end col-->

                                    <div class="col-auto">
                                        <a href="{{route('categorys.create')}}" type="button" class="btn btn-primary"><i
                                                class="fa-solid fa-plus me-1"></i> Add
                                            Category</a>
                                    </div><!--end col-->
                                </form>
                            </div><!--end col-->
                        </div><!--end row-->
                    </div><!--end card-header-->
                    <div class="card-body pt-0">

                        <div class="table-responsive">
                            <table class="table mb-0 checkbox-all" id="datatable_1">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th class="ps-0">Name</th>
                                        <th>Code</th>
                                        <th>Created By</th>
                                        <th>Updated By</th>
                                        <th class="text-end">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($categorys)
                                        @php($i =1)
                                        @foreach ($categorys as $category)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td class="ps-0">{{ $category->name }}</td>
                                                <td>{{ $category->code }}</td>
                                                <td>{{ $category->created_by_name }}</td>
                                                <td>{{ $category->updated_by_name }}</td>
                                                <td class="text-end">
                                                    <a class="btn btn-primary btn-sm" href="{{ route('categorys.edit', ['id' => $category->id]) }}"><i class="las la-pen fs-18"></i></a>
                                                    <a class="btn btn-danger btn-sm" href="{{ route('categorys.delete', ['id' => $category->id]) }}"><i class="las la-trash-alt fs-18"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        
                                    @endif
                                    
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div> <!-- end col -->
        </div> <!-- end row -->
@endsection