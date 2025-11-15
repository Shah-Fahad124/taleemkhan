@extends('layouts.app')

@section('content')
<div class="app-content px-4 py-3">
    <section class="section">
        <div class="card shadow-sm border-0">
            <div class="card-header bg-light">
                <h5 class="mb-0 fw-bold text-primary">Edit Student Information</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('school.students.update', $student->id) }}">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        {{-- Full Name --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="full_name" class="form-control @error('full_name') is-invalid @enderror"
                                value="{{ old('full_name', $student->full_name) }}" required>
                            @error('full_name') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        {{-- Father Name --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Father Name</label>
                            <input type="text" name="father_name" class="form-control"
                                value="{{ old('father_name', $student->father_name) }}">
                        </div>

                        {{-- Gender --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Gender</label>
                            <select name="gender" class="form-control">
                                <option value="">Select Gender</option>
                                <option value="male" {{ old('gender', $student->gender) == 'male' ? 'selected' : '' }}>Male</option>
                                <option value="female" {{ old('gender', $student->gender) == 'female' ? 'selected' : '' }}>Female</option>
                                <option value="other" {{ old('gender', $student->gender) == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        {{-- Date of Birth --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Date of Birth</label>
                            <input type="date" name="date_of_birth" class="form-control"
                                value="{{ old('date_of_birth', $student->date_of_birth) }}">
                        </div>

                        {{-- Birth Certificate Number --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Birth Certificate Number</label>
                            <input type="text" name="birth_certificate_number" class="form-control"
                                value="{{ old('birth_certificate_number', $student->birth_certificate_number) }}">
                        </div>

                        {{-- Grade --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Grade</label>
                            <select name="grade_id" class="form-control" required>
                                <option value="">Select Grade</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ old('grade_id', $student->grade_id) == $grade->id ? 'selected' : '' }}>
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Section --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Section</label>
                         <input type="text" name="section" class="form-control"
                                value="{{ old('section', $student->section) }}">
                        </div>

                        {{-- Phone Number --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone_number" class="form-control"
                                value="{{ old('phone_number', $student->phone_number) }}">
                        </div>

                        {{-- Emergency Contact --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Emergency Contact</label>
                            <input type="text" name="emergency_contact" class="form-control"
                                value="{{ old('emergency_contact', $student->emergency_contact) }}">
                        </div>

                        {{-- Current Address --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Current Address</label>
                            <input type="text" name="current_address" class="form-control"
                                value="{{ old('current_address', $student->current_address) }}">
                        </div>

                        {{-- Permanent Address --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Permanent Address</label>
                            <input type="text" name="permanent_address" class="form-control"
                                value="{{ old('permanent_address', $student->permanent_address) }}">
                        </div>

                        {{-- Status --}}
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-control">
                                <option value="">Select Status</option>
                                <option value="active" {{ old('status', $student->status) == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ old('status', $student->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                <option value="graduated" {{ old('status', $student->status) == 'graduated' ? 'selected' : '' }}>Graduated</option>
                                <option value="transferred" {{ old('status', $student->status) == 'transferred' ? 'selected' : '' }}>Transferred</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-end" style="gap: 5px">
                        <button type="submit" class="btn btn-primary me-2">
                            <i class="fa fa-save"></i> Update Student
                        </button>
                        <a href="{{ route('school.students.index') }}" class="btn btn-secondary">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
