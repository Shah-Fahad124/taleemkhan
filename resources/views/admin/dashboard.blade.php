@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">

            <!-- Page Header -->
            <div class="page-header p-2">
                <h4 class="page-title font-weight-bold">Admin Dashboard</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light-color">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </div>

            <!-- Row: Summary Cards -->
            <div class="row row-deck">
                <div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
                    <a href="{{ route('schools.index') }}" class="card text-center shadow-sm text-decoration-none">
                        <div class="card-body">
                            <h5 class="mb-3">Total Schools</h5>
                            <h3 class="text-primary mb-0">{{ $totalSchools ?? 0 }}</h3>
                            <span class="text-muted">Registered Schools</span>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
                    <div class="card text-center shadow-sm">
                        <div class="card-body">
                            <h5 class="mb-3">Total Students</h5>
                            <h3 class="text-success mb-0">{{ $totalStudents ?? 0 }}</h3>
                            <span class="text-muted">Enrolled Students</span>
                        </div>
                    </div>
                </div>

                <div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
                    <a href="{{ route('districts.index') }}" class="card text-center shadow-sm text-decoration-none">
                        <div class="card-body">
                            <h5 class="mb-3">Total Districts</h5>
                            <h3 class="text-warning mb-0">{{ $totalDistricts ?? 0 }}</h3>
                            <span class="text-muted">Active Districts</span>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
                    <a href="{{ route('tehsils.index') }}" class="card text-center shadow-sm text-decoration-none">
                        <div class="card-body">
                            <h5 class="mb-3">Total Tehsils</h5>
                            <h3 class="text-danger mb-0">{{ $totalTehsils ?? 0 }}</h3>
                            <span class="text-muted">Active Tehsils</span>
                        </div>
                    </a>
                </div>

                <div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
                    <a href="{{ route('grades.index') }}" class="card text-center shadow-sm text-decoration-none">
                        <div class="card-body">
                            <h5 class="mb-3">Total Grades</h5>
                            <h3 class="text-info mb-0">{{ $totalGrades ?? 0 }}</h3>
                            <span class="text-muted">Available Grades</span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
                    <a href="{{ route('subjects.index') }}" class="card text-center shadow-sm text-decoration-none">
                        <div class="card-body">
                            <h5 class="mb-3">Total Subjects</h5>
                            <h3 class="text-primary mb-0">{{ $totalSubjects ?? 0 }}</h3>
                            <span class="text-muted">Available Subjects</span>
                        </div>
                    </a>
                </div>
                <div class="col-sm-12 col-lg-6 col-xl-3 col-md-6">
                    <a href="{{ route('item-bank.index') }}" class="card text-center shadow-sm text-decoration-none">
                        <div class="card-body">
                            <h5 class="mb-3">Total Questions</h5>
                            <h3 class="text-info mb-0">{{ $totalQuestions ?? 0 }}</h3>
                            <span class="text-muted">Available in Item Bank</span>
                        </div>
                    </a>
                </div>
            </div>

            {{-- <!-- Row: Recent Activity Logs -->
        <div class="row mt-4">
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Recent Activity Logs</h4>
                        <a href="#" class="btn btn-sm btn-outline-primary">View All</a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover table-bordered text-nowrap">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>User</th>
                                        <th>Action</th>
                                        <th>Description</th>
                                        <th>Date & Time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($logs ?? [] as $log)
                                        <tr>
                                            <td>{{ $log->id }}</td>
                                            <td>{{ $log->user->username ?? 'Unknown' }}</td>
                                            <td>{{ ucfirst(str_replace('_', ' ', $log->action)) }}</td>
                                            <td>{{ $log->description }}</td>
                                            <td>{{ $log->created_at->format('d M Y, h:i A') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">No activity logs found</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div> --}}

        </section>
    </div>
@endsection
