@extends('dashboard.layouts.master',['title'=>'Admin Stark | Booking Details'])
@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h4>Unit Details</h4>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Details</li>
                            <li class="breadcrumb-item"><a href="">Booking</a></li>
                        </ol>
                    </div>
                </div>
            </div>
            <div class="text-right mb-3">
                <button class="btn btn-secondary btn-sm" onclick="window.print()">
                    <i class="fas fa-print"></i> Print Details
                </button>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="container">
                <div class="row">
                    <!-- Unit Information -->
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h5><i class="fas fa-info-circle"></i> Unit Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Title:</strong>{{ $request->unit->title }}</p>
                                <p><strong>Price:</strong> {{ $request->unit->price }} {{$request->unit->currancy}}</p>
                                <p><strong>Type:</strong> {{ $request->unit->type }}</p>
                                <p><strong>Area:</strong> {{ $request->unit->area }}</p>
                                <p><strong>Number of Bedrooms:</strong> {{ $request->unit->number_bedroom }}</p>
                                <p><strong>Number of Bathrooms:</strong> {{ $request->unit->number_bathroom }}</p>
                                <p><strong>Location:</strong> {{ $request->unit->address }}</p>
                                <p><strong>Description:</strong> {{ $request->unit->description }}</p>
                                <p><strong>Is Booked:</strong>
                                    @if($request->unit->is_booked)
                                        <span class="badge badge-success">Yes</span>
                                    @else
                                        <span class="badge badge-primary">No</span>
                                    @endif
                                </p>
                                <p><strong>Created At:</strong> {{ $request->unit->created_at }}</p>
                                <p><strong>Last Update At:</strong> {{ $request->unit->updated_at }}</p>
                                <p>
                                    <strong>Status:</strong>
                                    @if ($request->unit->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif ($request->unit->status == 'accepted')
                                        <span class="badge badge-success">Accepted</span>
                                    @elseif ($request->unit->status == 'rejected')
                                        <span class="badge badge-danger">Rejected</span>
                                    @else
                                        <span class="badge badge-secondary">Unknown</span>
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                    <!-- Owner Information -->
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5><i class="fas fa-user"></i> Owner Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Full Name:</strong> {{ $request->owner->full_name }}</p>
                                <p><strong>UserName:</strong> {{ $request->owner->username }}</p>
                                <p><strong>Email:</strong> {{ $request->owner->email }}</p>
                                <p><strong>Phone:</strong> {{ $request->owner->phone }}</p>
                                <p><strong>Business Name:</strong> {{ $request->owner->business_name }}</p>
                                <p><strong>Business License:</strong> {{ $request->owner->business_license }}</p>
                                <p><strong>Address:</strong> {{ $request->owner->address }}</p>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <h5><i class="fas fa-user"></i> Renter Information</h5>
                            </div>
                            <div class="card-body">
                                <p><strong>Full Name:</strong> {{ $request->user->full_name }}</p>
                                <p><strong>UserName:</strong> {{ $request->user->username }}</p>
                                <p><strong>Email:</strong> {{ $request->user->email }}</p>
                                <p><strong>Phone:</strong> {{ $request->user->phone }}</p>
                                <p><strong>Address:</strong> {{ $request->user->address }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-10">

                        <div class="col-md-3">
                            <!-- Features -->
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5><i class="fas fa-list"></i> Features</h5>
                                </div>
                                <div class="card-body">
                                    @foreach ($featuresByCategory as $categoryName => $features)
                                        <h6 class="text-primary"><strong>{{ $categoryName }}</strong></h6>
                                        <ul style="list-style-type: none; padding-left: 0;">
                                            @foreach ($features as $feature)
                                                <li style="font-size: 14px; color: #333;">
                                                    <i class="fas fa-check-circle text-success"></i> {{ $feature->name }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <!-- Features -->
                            <div class="card">
                                <div class="card-header bg-warning text-white">
                                    <h5><i class="fas fa-info-circle"></i>Booking Info</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>Booking Request ID</strong>{{$request->booking->booking_request_id}}</p>
                                    <p><strong>Booking Date</strong>{{$request->booking->confirmed_date}}</p>
                                </div>
                            </div>
                        </div>
                        <!-- Images -->
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-info text-white">
                                    <h5><i class="fas fa-images"></i> Images</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($request->unit->images as $image)
                                            <div class="col-md-6 mb-3">
                                                <img src="{{ asset('storage/'.$image->url) }}" alt="Unit Image"
                                                     class="img-fluid rounded">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@push('css')
    <style>
        @media print {
            body {
                -webkit-print-color-adjust: exact !important;
                color-adjust: exact !important;
            }

            .btn, .breadcrumb, .navbar, footer {
                display: none;
            }

            .card {
                border: 1px solid #ccc !important;
            }
        }
    </style>

@endpush