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
                        <h1>Add New Destination</h1>
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
                            <form action="" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Title<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title') }}" required placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Slug <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="slug"
                                            value="{{ old('slug') }}" required placeholder="Slug Ex. URL">
                                        <div class="" style="color: red">{{ $errors->first('slug') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Category<span style="color: red">*</span></label>
                                        <select name="category_id" id="" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($get_record as $value)
                                                <option value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Price <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ old('price') }}" required placeholder="Price">
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="short_description"
                                            value="{{ old('short_description') }}" required placeholder="Short Description">
                                    </div>
                                    <div class="form-group">
                                        <label>Description<span style="color: red">*</span></label>
                                        <input type="textarea" class="form-control" name="description"
                                            value="{{ old('description') }}" required placeholder="Description">
                                    </div>
                                    <div class="form-group">
                                        <label>Additional Information<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="additional_information"
                                            value="{{ old('additional_information') }}" required placeholder="additional information">
                                    </div>
                                    <div class="form-group">
                                        <label>Status <span style="color: red">*</span></label>
                                        <select class="form-control" name="status" required>
                                            <option {{ old('status') == 0 ? 'selected' : '' }} value="0">Active
                                            </option>
                                            <option {{ old('status') == 1 ? 'selected' : '' }} value="1">Inactive
                                            </option>
                                        </select>
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
