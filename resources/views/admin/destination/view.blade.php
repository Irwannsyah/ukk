@extends('admin.layouts.app')
@section('style')
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
@endsection

@section('content')
<div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="fw-bold">Destination</h1>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="row justify-content-center g-3">
                    <!-- Card Layout -->
                    <div class="col-md-6 col-lg-3">
                        <div class="card shadow-sm">
                            <!-- Gambar -->
                            <img src="{{ asset('uploads/destination/' . $get_destination->image) }}"
                                class="card-img-top"
                                alt="Banner Image"
                                style="height: 150px; object-fit: cover;">

                            <!-- Konten -->
                            <div class="card-body">
                                <!-- Title -->
                                <h5 class="card-title fw-bold text-center">
                                    {{ $get_destination->title }}
                                </h5>
                                <!-- Detail -->
                                <p class="card-text mb-1">
                                    <strong>Category:</strong> {{ $get_destination->category->name }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Price:</strong> Rp {{ number_format($get_destination->price, 0, ',', '.') }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Quota:</strong> {{ $get_destination->quote_ticket }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Short Description:</strong> {{ $get_destination->short_description }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Description:</strong> {{ $get_destination->description }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>latitude</strong> {{ $get_destination->latitude }}
                                </p>
                                <p class="card-text mb-1">
                                    <strong>Longitude:</strong> {{ $get_destination->longitude }}
                                </p>

                                <input type="hidden" id="latitude" value="{{ $get_destination->latitude }}">
                                <input type="hidden" id="longitude" value="{{ $get_destination->longitude }}">
                                <div class="form-group">
                                        <label>Map Preview</label>
                                        <div id="map" style="height: 400px;"></div>
                                    </div>
                                <p class="card-text mb-1">
                                    <strong>Status:</strong>
                                    <span class="badge {{ $get_destination->status == 0 ? 'bg-success' : 'bg-danger' }}">
                                        {{ $get_destination->status == 0 ? 'Open' : 'Closed' }}
                                    </span>
                                </p>
                                <p class="card-text">
                                    <strong>Created At:</strong> {{ date('d-m-Y', strtotime($get_destination->created_at)) }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.row -->
            </div>
        </section>
    </div>
@endsection


@section('script')
 <script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>
    <script src="{{ url('public/dist/js/pages/dashboard3.js') }}"></script>
    <script src="{{ asset('assets/js/maps.js') }}"></script>
@endsection
