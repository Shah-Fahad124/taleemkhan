@extends('layouts.app')

@section('content')
<div class="app-content px-4 py-3">
    <section class="section">
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h4 class="fw-bold mb-0 text-capitalize">{{ $student->full_name }}</h4>
                    <span class="badge bg-success text-capitalize">{{ $student->status }}</span>
                </div>

                <div class="row">
                    {{-- Father Name --}}
                    <div class="col-md-6 mb-3">
                        <strong>Father Name:</strong>
                        <p class="text-capitalize mb-0">{{ $student->father_name ?? '—' }}</p>
                    </div>

                    {{-- Gender --}}
                    <div class="col-md-6 mb-3">
                        <strong>Gender:</strong>
                        <p class="mb-0 text-capitalize">{{ $student->gender ?? '—' }}</p>
                    </div>

                    {{-- Date of Birth --}}
                    <div class="col-md-6 mb-3">
                        <strong>Date of Birth:</strong>
                        <p class="mb-0">
                            {{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') : '—' }}
                        </p>
                    </div>

                    {{-- Birth Certificate --}}
                    <div class="col-md-6 mb-3">
                        <strong>Birth Certificate Number:</strong>
                        <p class="mb-0">{{ $student->birth_certificate_number ?? '—' }}</p>
                    </div>

                    {{-- Grade --}}
                    <div class="col-md-6 mb-3">
                        <strong>Grade:</strong>
                        <p class="mb-0">{{ $student->grade->name ?? '—' }}</p>
                    </div>

                    {{-- Section --}}
                    <div class="col-md-6 mb-3">
                        <strong>Section:</strong>
                        <p class="mb-0">{{ $student->section ?? '—' }}</p>
                    </div>

                    {{-- Phone --}}
                    <div class="col-md-6 mb-3">
                        <strong>Phone Number:</strong>
                        <p class="mb-0">{{ $student->phone_number ?? '—' }}</p>
                    </div>

                    {{-- Emergency Contact --}}
                    <div class="col-md-6 mb-3">
                        <strong>Emergency Contact:</strong>
                        <p class="mb-0">{{ $student->emergency_contact ?? '—' }}</p>
                    </div>

                    {{-- Current Address --}}
                    <div class="col-md-6 mb-3">
                        <strong>Current Address:</strong>
                        <p class="mb-0">{{ $student->current_address ?? '—' }}</p>
                    </div>

                    {{-- Permanent Address --}}
                    <div class="col-md-6 mb-3">
                        <strong>Permanent Address:</strong>
                        <p class="mb-0">{{ $student->permanent_address ?? '—' }}</p>
                    </div>

                    {{-- Registration Date --}}
                    <div class="col-md-6 mb-3">
                        <strong>Registered On:</strong>
                        <p class="mb-0">{{ $student->created_at->format('d M Y, h:i A') }}</p>
                    </div>
                </div>

                <hr>

                <div class="d-flex justify-content-end" style="gap: 4px">
                     <button onclick="window.history.back();" class="btn btn-secondary me-2">
                     back
                    </button>
                    <a href="{{ route('school.students.edit', $student->id) }}" class="btn btn-warning me-2">
                        <i class="fa fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('school.students.destroy', $student->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this student?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger"><i class="fa fa-trash"></i> Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
