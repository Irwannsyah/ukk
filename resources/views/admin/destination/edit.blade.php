@extends('admin.layouts.app')
@section('style')
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-12">
                        <h1>Edit  Destination</h1>
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
                                        <label>Title<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="title"
                                            value="{{ old('title', $get_record->title) }}" required placeholder="Title">
                                    </div>
                                    <div class="form-group">
                                        <label>Images <span style="color: red">*</span></label>
                                        <input type="file" class="form-control" name="images[]" multiple
                                            style="padding: 5px;" required>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>City<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="city"
                                                value="{{ old('city', $get_record->title) }}" required placeholder="City">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Slug <span style="color: red">*</span></label>
                                            <input type="text" class="form-control" name="slug"
                                                value="{{ old('slug', $get_record->title) }}" required
                                                placeholder="Slug Ex. URL">
                                            <div class="" style="color: red">{{ $errors->first('slug') }}</div>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Category<span style="color: red">*</span></label>
                                            <select name="category_id" id="" class="form-control">
                                                <option value="">Select</option>
                                                @foreach ($select as $value)
                                                    <option value="{{ $value->id }}"
                                                        {{ $get_record->category_id == $value->id ? 'selected' : '' }}>
                                                        {{ $value->name }}
                                                    </option>
                                                @endforeach

                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Price <span style="color: red">*</span></label>
                                            <input type="text" id="price" class="form-control" name="price"
                                                required placeholder="Price"
                                                value="{{ old('price', number_format($get_record->price, 0, ',', '.')) }}">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Quota Ticket<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="quota_ticket"
                                            value="{{ old('quota_ticket', $get_record->quote_ticket) }}" required
                                            placeholder="Quota Ticket">
                                    </div>
                                    <div class="form-group">
                                        <label>Short Description<span style="color: red">*</span></label>
                                        <input type="text" class="form-control " name="short_description"
                                            value="{{ old('short_description', $get_record->short_description) }}" required
                                            placeholder="Short Description">
                                    </div>
                                    <div class="form-group">
                                        <label>Description<span style="color: red">*</span></label>
                                        <input type="textarea" class="form-control " name="description"
                                            value="{{ old('description', $get_record->description) }}" required
                                            placeholder="Description">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Waktu Buka</label>
                                            <input type="time" value="{{ old('open_time', $get_record->open_time) }}"
                                                class="form-control" name="open_time">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Waktu Tutup</label>
                                            <input type="time"
                                                value="{{ old('closed_time', $get_record->closed_time) }}"
                                                class="form-control" name="closed_time">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Additional Information<span style="color: red">*</span></label>
                                        <input type="text" class="form-control" name="additional_information"
                                            value="{{ old('additional_information', $get_record->additional_information) }}"
                                            required placeholder="additional information">
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Latitude<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="latitude" name="latitude"
                                                value="{{ old('latitude', $get_record->latitude) }}" required
                                                placeholder="Input Latitude">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Longitude<span style="color: red">*</span></label>
                                            <input type="text" class="form-control" id="longitude" name="longitude"
                                                value="{{ old('longitude', $get_record->longitude) }}" required
                                                placeholder="Input Longitude">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Map Preview</label>
                                        <div id="map" style="height: 400px;"></div>
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
    <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <!-- Dashboard script -->
    <script src="{{ url('public/dist/js/pages/dashboard3.js') }}"></script>

    <!-- Summernote CSS -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">

    <!-- Summernote JS -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote();
        });
        document.getElementById('price').addEventListener('input', function(e) {
            let value = e.target.value;

            // Menghapus karakter yang bukan angka
            value = value.replace(/[^\d]/g, '');

            // Memformat angka dengan menambahkan titik setiap tiga angka
            value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');

            // Menyimpan nilai yang diformat kembali ke input field
            e.target.value = value;
        });
    </script>
    <script src="{{ asset('assets/js/maps.js') }}"></script>
@endsection
