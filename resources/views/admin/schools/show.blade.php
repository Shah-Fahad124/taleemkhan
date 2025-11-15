@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="page-header p-2 d-flex justify-content-between align-items-center">
                <h4 class="page-title font-weight-bold">School Profile</h4>
                <div>
                    <a href="{{ route('schools.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fa fa-arrow-left mr-1"></i> Back
                    </a>
                    {{-- <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-primary btn-sm">
                    <i class="fa fa-edit mr-1"></i> Edit
                </a> --}}
                </div>
            </div>

            <div class="card shadow-lg border-0">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0 text-capitalize">
                        <i class="fa fa-school mr-2"></i> {{ $school->school_name }}
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">

                        {{-- Left column --}}
                        <div class="col-md-6 mb-4">
                            <div class="card border-light shadow-sm h-100">
                                <div class="card-header bg-light">
                                    <strong class="text-primary"><i class="fa fa-info-circle mr-1"></i> Basic
                                        Information</strong>
                                </div>
                                <div class="card-body">
                                    <p><strong>EMIS Code:</strong> {{ $school->emis_code }}</p>
                                    <p><strong>School Level:</strong> {{ $school->school_level }}</p>
                                    <p><strong>Students:</strong> {{ $school->students_count }}</p>
                                    <p><strong>Status:</strong>
                                        @if ($school->is_active)
                                            <span class="badge badge-success">Active</span>
                                        @else
                                            <span class="badge badge-danger">Inactive</span>
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </div>

                        {{-- Right column --}}
                        <div class="col-md-6 mb-4">
                            <div class="card border-light shadow-sm h-100">
                                <div class="card-header bg-light">
                                    <strong class="text-primary"><i class="fa fa-map-marker-alt mr-1"></i> Location
                                        Details</strong>
                                </div>
                                <div class="card-body">
                                    <p><strong>District:</strong> {{ $school->district->name ?? 'N/A' }}</p>
                                    <p><strong>Tehsil:</strong> {{ $school->tehsil->name ?? 'N/A' }}</p>
                                    <p><strong>Zone:</strong> {{ $school->zone }}</p>
                                </div>
                            </div>
                        </div>

                        {{-- Full width section --}}
                        <div class="col-md-12 mb-4">
                            <div class="card border-light shadow-sm">
                                <div class="card-header bg-light">
                                    <strong class="text-primary"><i class="fa fa-user-tie mr-1"></i> Head Teacher
                                        Information</strong>
                                </div>
                                <div class="card-body row">
                                    <div class="col-md-6">
                                        <p><strong>Name:</strong> {{ $school->head_teacher_name }}</p>
                                        <p><strong>Phone:</strong> {{ $school->head_teacher_phone }}</p>
                                    </div>
                                    <div class="col-md-6">
                                        <p><strong>Email:</strong> {{ $school->email ?? 'N/A' }}</p>
                                        <p><strong>Number of Teachers:</strong> {{ $school->number_of_teachers }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Footer Info --}}
                        <div class="col-md-12">
                            <div class="text-right text-muted mt-2">
                                <small>Created on: {{ $school->created_at->format('d M Y') }} |
                                    Last updated: {{ $school->updated_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
