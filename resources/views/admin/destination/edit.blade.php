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
                            <form action="" method="POST">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>Title<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title', $get_record->title) }}" required placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Slug <span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="slug"
                                            value="{{ old('slug', $get_record->slug) }}" required
                                            placeholder="Slug Ex. URL">
                                        <div class="" style="color: red">{{ $errors->first('slug') }}</div>
                                    </div>
                                    <div class="form-group">
                                        <label>Category <span style="color: red">*</span></label>
                                        <select name="category_id" class="form-control">
                                            @foreach ($get_category as $value)
                                                <option {{ $value->id == $get_record->category_id ? 'selected' : '' }}
                                                    value="{{ $value->id }}">{{ $value->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>Price<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="price"
                                            value="{{ old('price', $get_record->price) }}" required placeholder="price">
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="short_description"
                                            value="{{ old('short_description', $get_record->short_description) }}" required placeholder="Short Description">
                                    </div>
                                    <div class="form-group">
                                        <label>Description<span style="color: red">*</span></label>
                                        <input type="textarea" class="form-control" name="description"
                                            value="{{ old('description', $get_record->description) }}" required placeholder="description">
                                    </div>
                                    <div class="form-group">
                                        <label>Additional Information<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="additional_information"
                                            value="{{ old('additional_information', $get_record->price) }}" required placeholder="additional_information">
                                    </div>
                                    <div class="form-group">
                                        <label>Status<span style="color: red">*</span></label>
                                        <select name="status" class="form-control" id="">
                                            <option {{ old('status', $get_record->status == 0 ? 'selected' : '') }} value="0">Open</option>
                                            <option {{ old('status', $get_record->status == 1 ? 'selected' : '') }} value="1">Closed</option>
                                        </select>
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
