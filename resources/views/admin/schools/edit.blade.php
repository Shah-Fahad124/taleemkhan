@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="page-header p-2">
                <h4 class="page-title font-weight-bold">Edit School</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    {{-- Update School Form --}}
                    <form method="POST" action="{{ route('schools.update', $school->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="row">
                            {{-- EMIS Code --}}
                            <div class="col-md-6">
                                <label>EMIS Code</label>
                                <input type="text" name="emis_code"
                                    class="form-control @error('emis_code') is-invalid @enderror"
                                    value="{{ old('emis_code', $school->emis_code) }}" required>
                                @error('emis_code')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- School Name --}}
                            <div class="col-md-6">
                                <label>School Name</label>
                                <input type="text" name="school_name"
                                    class="form-control @error('school_name') is-invalid @enderror"
                                    value="{{ old('school_name', $school->school_name) }}" required>
                                @error('school_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- School Level --}}
                            <div class="col-md-6 mt-3">
                                <label>School Level</label>
                                <select name="school_level" class="form-control @error('school_level') is-invalid @enderror"
                                    required>
                                    <option value="">Select Level</option>
                                    <option value="Primary"
                                        {{ old('school_level', $school->school_level) == 'Primary' ? 'selected' : '' }}>
                                        Primary</option>
                                    <option value="Middle"
                                        {{ old('school_level', $school->school_level) == 'Middle' ? 'selected' : '' }}>
                                        Middle</option>
                                    <option value="High"
                                        {{ old('school_level', $school->school_level) == 'High' ? 'selected' : '' }}>High
                                    </option>
                                </select>
                                @error('school_level')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Zone --}}
                            <div class="col-md-6 mt-3">
                                <label>Zone</label>
                                <select name="zone" class="form-control @error('zone') is-invalid @enderror" required>
                                    <option value="">Select Zone</option>
                                    <option value="Summer Zone"
                                        {{ old('zone', $school->zone) == 'Summer Zone' ? 'selected' : '' }}>Summer Zone
                                    </option>
                                    <option value="Winter Zone"
                                        {{ old('zone', $school->zone) == 'Winter Zone' ? 'selected' : '' }}>Winter Zone
                                    </option>
                                </select>
                                @error('zone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- District --}}
                            <div class="col-md-6 mt-3">
                                <label>District</label>
                                <select id="districtSelect" name="district_id"
                                    class="form-control @error('district_id') is-invalid @enderror" required>
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}"
                                            {{ old('district_id', $school->district_id) == $district->id ? 'selected' : '' }}>
                                            {{ $district->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Tehsil --}}
                            <div class="col-md-6 mt-3">
                                <label>Tehsil</label>
                                <select id="tehsilSelect" name="tehsil_id"
                                    class="form-control @error('tehsil_id') is-invalid @enderror" required>
                                    <option value="">Select Tehsil</option>
                                    @foreach ($tehsils as $tehsil)
                                        <option value="{{ $tehsil->id }}"
                                            {{ old('tehsil_id', $school->tehsil_id) == $tehsil->id ? 'selected' : '' }}>
                                            {{ $tehsil->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('tehsil_id')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Head Teacher Name --}}
                            <div class="col-md-6 mt-3">
                                <label>Head Teacher Name</label>
                                <input type="text" name="head_teacher_name"
                                    class="form-control @error('head_teacher_name') is-invalid @enderror"
                                    value="{{ old('head_teacher_name', $school->head_teacher_name) }}" required>
                                @error('head_teacher_name')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Head Teacher Phone --}}
                            <div class="col-md-6 mt-3">
                                <label>Head Teacher Phone</label>
                                <input type="text" name="head_teacher_phone"
                                    class="form-control @error('head_teacher_phone') is-invalid @enderror"
                                    value="{{ old('head_teacher_phone', $school->head_teacher_phone) }}" required>
                                @error('head_teacher_phone')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 mt-3">
                                <label>Email (Optional)</label>
                                <input type="email" name="email"
                                    class="form-control @error('email') is-invalid @enderror"
                                    value="{{ old('email', $school->email) }}">
                                @error('email')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Password --}}
                            <div class="col-md-6 mt-3">
                                <label>Password (Optional - leave blank to keep current)</label>
                                <input type="password" name="password"
                                    class="form-control @error('password') is-invalid @enderror">
                                @error('password')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Number of Teachers --}}
                            <div class="col-md-6 mt-3">
                                <label>Number of Teachers</label>
                                <input type="number" name="number_of_teachers"
                                    class="form-control @error('number_of_teachers') is-invalid @enderror"
                                    value="{{ old('number_of_teachers', $school->number_of_teachers) }}" min="0"
                                    required>
                                @error('number_of_teachers')
                                    <small class="text-danger">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-success">Update School</button>
                            <a href="{{ route('schools.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            const districtSelect = $('#districtSelect');
            const tehsilSelect = $('#tehsilSelect');
            const selectedTehsilId = "{{ old('tehsil_id', $school->tehsil_id) }}"; // saved tehsil id
            const initialDistrictId = "{{ old('district_id', $school->district_id) }}"; // saved district id

            // Initialize Select2 for District and Tehsil AFTER the DOM has all options
            districtSelect.select2({
                width: '100%',
                placeholder: 'Select District',
                allowClear: true
            });
            tehsilSelect.select2({
                width: '100%',
                placeholder: 'Select Tehsil',
                allowClear: true
            });

            // Ensure preselected values are applied and visible immediately
            if (initialDistrictId) {
                districtSelect.val(initialDistrictId).trigger('change.select2');
            }

            if (selectedTehsilId) {
                // If the option exists in DOM (server rendered), just set it
                if (tehsilSelect.find('option[value="' + selectedTehsilId + '"]').length) {
                    tehsilSelect.val(selectedTehsilId).trigger('change.select2');
                } else {
                    // Safety fallback: if option not present, try to fetch tehsils for saved district then select
                    if (initialDistrictId) {
                        $.ajax({
                            url: "{{ route('get.tehsils.by.district') }}",
                            type: "GET",
                            data: {
                                district_id: initialDistrictId
                            },
                            success: function(response) {
                                tehsilSelect.empty().append('<option value="">Select Tehsil</option>');
                                $.each(response, function(_, tehsil) {
                                    tehsilSelect.append('<option value="' + tehsil.id + '">' +
                                        tehsil.name + '</option>');
                                });
                                tehsilSelect.val(selectedTehsilId).trigger('change.select2');
                            },
                            error: function() {
                                // leave existing options & selection if any
                            }
                        });
                    }
                }
            }

            // When a district is changed by the user: fetch related tehsils and reset tehsil select
            districtSelect.on('change', function() {
                const districtId = $(this).val();

                // Clear tehsil selection immediately to avoid stale selection
                tehsilSelect.val(null).trigger('change.select2');

                if (!districtId) {
                    // Restore server-rendered full list if you prefer, or empty — here we restore full list by reloading page options:
                    // Option A: empty:
                    tehsilSelect.empty().append('<option value="">Select Tehsil</option>').trigger(
                        'change.select2');
                    return;
                }

                // Fetch tehsils for selected district
                $.ajax({
                    url: "{{ route('get.tehsils.by.district') }}",
                    type: "GET",
                    data: {
                        district_id: districtId
                    },
                    success: function(response) {
                        tehsilSelect.empty().append('<option value="">Select Tehsil</option>');
                        $.each(response, function(_, tehsil) {
                            tehsilSelect.append('<option value="' + tehsil.id + '">' +
                                tehsil.name + '</option>');
                        });
                        // focus the select so admin can see results quickly
                        tehsilSelect.trigger('change.select2');
                    },
                    error: function(xhr, status, error) {
                        console.error('Error loading tehsils:', error);
                        tehsilSelect.empty().append(
                            '<option value="">Error loading tehsils</option>').trigger(
                            'change.select2');
                    }
                });
            });

            // Optional: prevent opening tehsil before district if you want stricter flow
            tehsilSelect.on('select2:opening', function(e) {
                if (!districtSelect.val()) {
                    // If you want to allow choosing from full list before district selected, remove this block
                    // alert('Please select a district first.');
                    // e.preventDefault();
                }
            });
        });
    </script>
@endpush
