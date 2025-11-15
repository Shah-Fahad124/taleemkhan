@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Add New Student</h4>
            </div>

            <div class="card-body">
                <div class="row">
                    <!-- ==================== Left Side: Student Form ==================== -->
                    <div class="col-md-7 border-end">
                        <form action="{{ route('school.students.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <!-- Personal Info -->
                            <h6 class="mt-2 mb-3 fw-semibold border-bottom pb-2">Personal Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="full_name" class="form-control" required>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Father Name</label>
                                    <input type="text" name="father_name" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Gender</label>
                                    <select name="gender" class="form-control">
                                        <option value="">Select</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option value="other">Other</option>
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="date" name="date_of_birth" class="form-control">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Form-b / CNIC Number</label>
                                    <input type="text" name="birth_certificate_number" class="form-control">
                                </div>
                            </div>

                            <!-- Contact Info -->
                            <h6 class="mt-4 mb-3 fw-semibold border-bottom pb-2">Contact Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Current Address</label>
                                    <textarea name="current_address" class="form-control" rows="2"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Permanent Address</label>
                                    <textarea name="permanent_address" class="form-control" rows="2"></textarea>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Phone Number</label>
                                    <input type="text" name="phone_number" class="form-control">
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Emergency Contact</label>
                                    <input type="text" name="emergency_contact" class="form-control">
                                </div>
                            </div>

                            <!-- Academic Info -->
                            <h6 class="mt-4 mb-3 fw-semibold border-bottom pb-2">Academic Information</h6>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Grade</label>
                                    <select name="grade_id" class="form-control select2" required>
                                        <option value="">Select Grade</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label">Section</label>
                                    <input type="text" name="section" class="form-control">
                                </div>

                            </div>

                            <!-- Submit -->
                            <div class="mt-4 text-end">
                                <button type="submit" class="btn btn-primary px-4">Save Student</button>
                            </div>
                        </form>
                    </div>

                    <!-- ==================== Right Side: Excel Upload ==================== -->
                    <div class="col-md-5">
                        <div class="ps-3">
                            <h6 class="mt-2 mb-3 fw-semibold border-bottom pb-2">Upload Students via Excel</h6>

                            <form action="{{ route('students.import') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label class="form-label">Choose Excel File (.xlsx)</label>
                                    <input type="file" name="file" class="form-control" accept=".xlsx,.xls" required>
                                </div>

                                <button type="submit" class="btn btn-success w-100">
                                    <i class="fa fa-file-excel me-1"></i> Upload Excel File
                                </button>
                            </form>

                            <div class="alert alert-info mt-4 small">
                                <strong>Note:</strong> Excel file must include headers like:
                                <code>full_name, father_name, gender, date_of_birth, birth_certificate_number, current_address, permanent_address, phone_number, emergency_contact, grade_id, section_id, status</code>
                            </div>
                        </div>
                    </div>
                </div> <!-- row -->
            </div>
        </div>
    </section>
</div>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.select2').select2({ width: '100%' });
    });
</script>
@endpush
