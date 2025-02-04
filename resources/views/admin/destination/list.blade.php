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
                        <h1>Destination List</h1>
                    </div>
                    <div class="col-sm-6" style="text-align: right">
                        <a href="{{ route('destination.add') }}" class="btn btn-primary">Add New Destination</a>
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
                                <h3 class="card-title">Destination List</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Image</th>
                                            <th>City</th>
                                            <th>Slug</th>
                                            <th>Category</th>
                                            <th>price</th>
                                            <th>Short Description</th>
                                            <th>Description</th>
                                            <th>Additional Information</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($get_record as $value)
                                            <tr>
                                                <td>{{ $value->id }}</td>
                                                <td>{{ $value->title }}</td>
                                                <td>
                                                    <img src="{{ asset('uploads/destination/' . $value->image) }}" alt="Banner Image"
                                                        style="width: 200px; height: 150px; object-fit: contain; border-radius: 10px;">
                                                </td>
                                                <td>{{ $value->city }}</td>
                                                <td>{{ $value->slug }}</td>
                                                <td>{{ $value->category->name }}</td>
                                                <td>{{ $value->formatPrice() }}</td>
                                                <td>{{ Str::limit($value->short_description, 12) }}</td>
                                                <td>{{ Str::limit($value->description, 12) }}</td>
                                                <td>{{ $value->additional_information }}</td>
                                                <td>{{ $value->status == 0 ? 'Open' : 'Closed' }}</td>
                                                <td>{{ date('d-m-Y', strtotime($value->created_at)) }}</td>
                                                <td>
                                                    <a href="{{ url('admin/destination/edit/' . $value->id) }}"
                                                        class="btn btn-warning">Edit</a>
                                                    <a href="{{ url('admin/destination/delete/' . $value->id) }}"
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
