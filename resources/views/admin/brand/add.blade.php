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
                        <h1>Add New Brand</h1>
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
                            <form action="{{ route('brand.insert') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Brand Name <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="name"
                                            value="{{ old('name') }}" required placeholder="Banner Name">
                                    </div>
                                    <div class="form-group">
                                        <div
                                            style="display: block; align-items: center; width: 100%;">
                                            <label>Brand Logo</label>
                                            <input type="file" class="form-control" style="padding: 5px" name="image" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
