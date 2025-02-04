@extends('admin.layouts.app')
@section('style')
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit Category</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card card-primary">
                            <form action="" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Name Banner <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name', $getSingle->name) }}" required placeholder="Category Name">
                                    </div>
                                    <div class="form-group">
                                        <label>Current Image</label><br>
                                        <img class="" src="{{ asset('uploads/' . $getSingle->image) }}" alt="" style="width: 150px">
                                    </div>
                                    <div class="form-group">
                                        <label>Update Image</label>
                                        <input type="file" class="form-control" name="image" style="padding: 5px;" accept="image/*">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Update</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection


@section('script')
    <script src="{{ url('public/dist/js/pages/dashboard3.js') }}"></script>
@endsection
