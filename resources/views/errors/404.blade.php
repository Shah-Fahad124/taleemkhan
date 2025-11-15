@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section d-flex align-items-center justify-content-center min-vh-40 bg-light">
            <div class="container text-center py-4">
                    <div class="card-body">
                        <!-- Error Icon -->
                        <div class="mb-4">
                            <i class="fa fa-exclamation-triangle text-danger fa-4x"></i>
                        </div>

                        <!-- Error Heading -->
                        <h1 class="display-4 font-weight-bold text-danger">404</h1>
                        <h4 class="text-dark mb-3">Page Not Found</h4>

                        <!-- Message -->
                        <p class="lead text-muted">
                            Sorry, the student record you’re looking for doesn’t exist
                            or you don’t have permission to access it.
                        </p>

                        <!-- Back Button -->
                        <a href="{{ route('school.students.index') }}" class="btn btn-primary btn-lg mt-3 px-4">
                            <i class="fa fa-arrow-left mr-2"></i> Back to Students
                        </a>
                    </div>
            </div>
        </section>
    </div>
@endsection
