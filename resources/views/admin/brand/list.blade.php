@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brand List</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('brand.add') }}" class="btn btn-primary">Add New Brand</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        @include('admin.layouts._message')
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Brand List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Brand Image</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($brands as $key => $brand)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $brand->name }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/brand/' . $brand->image) }}" alt="brand Image"
                                                        style="width: 200px; height: 150px; object-fit: contain; border-radius: 10px;">
                                                </td>
                                                <td>
                                                    <a href="{{ url('admin/brand/edit/' . $brand->id) }}"
                                                        class="btn btn-warning">Edit</a>

                                                    <a href="{{ url('admin/brand/delete/' . $brand->id) }}"
                                                        class="btn btn-danger">Delete</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
            </div>
        </section>
    </div>
@endsection


@section('script')
    <script src="{{ url('public/dist/js/pages/dashboard3.js') }}"></script>
@endsection
