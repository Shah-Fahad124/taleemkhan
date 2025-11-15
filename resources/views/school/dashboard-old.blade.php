@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section py-0">
            <!-- Header -->
            <div class="row align-items-center mb-4">
                <div class="col">
                    <h4 class="font-weight-bold mb-0 text-dark">Dashboard</h4>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="row mb-4">
                <!-- Total Teachers -->
                <div class="col-md-4 mb-3">
                    <div class="stats-item bg-warning text-white">
                        <div class="stats-content">
                            <div class="stats-icon">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            <div class="stats-info">
                                <h3 class="stats-number">{{ $totalTeachers }}</h3>
                                <span class="stats-label">Total Teachers</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Students -->
                <div class="col-md-4 mb-3">
                    <div class="stats-item bg-info text-white">
                        <div class="stats-content">
                            <div class="stats-icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stats-info">
                                <h3 class="stats-number">{{ $totalStudents }}</h3>
                                <span class="stats-label">Total Students</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- District -->
                <div class="col-md-4 mb-3">
                    <div class="stats-item bg-danger text-white">
                        <div class="stats-content">
                            <div class="stats-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="stats-info">
                                <h3 class="stats-number">{{ $school->district?->name ?? 'N/A' }}</h3>
                                <span class="stats-label">District</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Information Grid -->
            <div class="row">
                <!-- School Information -->
                <div class="col-lg-6 mb-4">
                    <div class="info-panel">
                        <div class="panel-header">
                            <i class="fas fa-school panel-icon"></i>
                            <h5 class="panel-title">School Information</h5>
                        </div>
                        <div class="panel-body">
                            <div class="info-grid">
                                <div class="info-item">
                                    <span class="info-label">School Level</span>
                                    <span class="info-value">{{ $school->school_level }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Zone</span>
                                    <span class="info-value">{{ $school->zone }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">District</span>
                                    <span class="info-value">{{ $school->district?->name ?? 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Tehsil</span>
                                    <span class="info-value">{{ $school->tehsil?->name ?? 'N/A' }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Teachers</span>
                                    <span class="info-value">{{ $school->number_of_teachers }}</span>
                                </div>
                                <div class="info-item">
                                    <span class="info-label">Students</span>
                                    <span class="info-value">{{ $totalStudents }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Head Teacher Information -->
                <div class="col-lg-6 mb-4">
                    <div class="info-panel">
                        <div class="panel-header">
                            <i class="fas fa-user-tie panel-icon"></i>
                            <h5 class="panel-title">Head Teacher</h5>
                        </div>
                        <div class="panel-body">
                            <div class="info-list">
                                <div class="info-list-item">
                                    <div class="info-list-content">
                                        <span class="info-list-label">Name</span>
                                        <span class="info-list-value text-capitalize">{{ $school->head_teacher_name }}</span>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <div class="info-list-content">
                                        <span class="info-list-label">Phone</span>
                                        <span class="info-list-value">{{ $school->head_teacher_phone }}</span>
                                    </div>
                                </div>
                                <div class="info-list-item">
                                    <div class="info-list-content">
                                        <span class="info-list-label">Email</span>
                                        <span class="info-list-value">{{ $school->email ?? 'Not Provided' }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        /* Stats Items */
        .stats-item {
            border-radius: 12px;
            padding: 1.5rem;
            height: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .stats-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .stats-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .stats-icon {
            font-size: 2.5rem;
            opacity: 0.9;
            flex-shrink: 0;
        }

        .stats-info {
            flex: 1;
        }

        .stats-number {
            font-size: 2rem;
            font-weight: 700;
            margin: 0;
            line-height: 1;
        }

        .stats-label {
            font-size: 0.9rem;
            opacity: 0.9;
            font-weight: 500;
        }

        /* Info Panels */
        .info-panel {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.08);
            border: 1px solid #f0f0f0;
            height: 100%;
            transition: all 0.3s ease;
        }

        .info-panel:hover {
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.12);
        }

        .panel-header {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid #f8f9fa;
            background: linear-gradient(135deg, #f8f9fa, #fff);
        }

        .panel-icon {
            font-size: 1.25rem;
            color: #3C3B3F;
        }

        .panel-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin: 0;
            color: #2d3748;
        }

        .panel-body {
            padding: 1.5rem;
        }

        /* School Info Grid */
        .info-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .info-item {
            display: flex;
            flex-direction: column;
            padding: 0.75rem;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .info-item:hover {
            background: #e9ecef;
            transform: translateY(-2px);
        }

        .info-label {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .info-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2d3748;
        }

        /* Head Teacher Info List */
        .info-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .info-list-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .info-list-item:hover {
            background: #e9ecef;
            transform: translateX(5px);
        }

        .info-list-content {
            flex: 1;
        }

        .info-list-label {
            font-size: 0.8rem;
            color: #6c757d;
            font-weight: 500;
            display: block;
            margin-bottom: 0.25rem;
        }

        .info-list-value {
            font-size: 0.95rem;
            font-weight: 600;
            color: #2d3748;
            display: block;
        }

        /* Color Themes */
        .bg-primary { background: linear-gradient(135deg, #3C3B3F, #605C3C) !important; }
        .bg-warning { background: linear-gradient(135deg, #f39c12, #e67e22) !important; }
        .bg-danger { background: linear-gradient(135deg, #e74c3c, #c0392b) !important; }
        .bg-info { background: linear-gradient(135deg, #3498db, #2980b9) !important; }

        /* Responsive Design */
        @media (max-width: 768px) {
            .stats-content {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .stats-icon {
                font-size: 2rem;
            }

            .stats-number {
                font-size: 1.75rem;
            }

            .info-grid {
                grid-template-columns: 1fr;
                gap: 0.75rem;
            }

            .panel-header {
                padding: 1rem;
            }

            .panel-body {
                padding: 1rem;
            }

            .info-item, .info-list-item {
                padding: 0.75rem;
            }
        }

        @media (max-width: 576px) {
            .stats-item {
                padding: 1rem;
            }

            .stats-number {
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
