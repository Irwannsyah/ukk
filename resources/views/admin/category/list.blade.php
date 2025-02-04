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
                        <h1>Category List</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('category.add') }}" class="btn btn-primary">Add New Category</a>
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
                                <h3 class="card-title">Category List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Name</th>
                                            <th>Image</th>
                                            <th>Slug</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($get_record as $key => $category)
                                            <tr>
                                                <td>{{ $key + 1 }}</td>
                                                <td>{{ $category->name }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/category/' . $category->image) }}" alt="" style="width: 200px; height: 150px; object-fit: contain; border-radius: 10px;">
                                                </td>
                                                <td>{{ $category->slug }}</td>
                                                <td>
                                                    <a href="{{ url('admin/category/edit/' . $category->id) }}"
                                                        class="btn btn-warning">Edit</a>

                                                    <a href="{{ url('admin/category/delete/' . $category->id) }}"
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
