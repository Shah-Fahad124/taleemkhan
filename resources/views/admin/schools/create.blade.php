@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="page-header p-2">
                <h4 class="page-title font-weight-bold">Add New School</h4>
            </div>

            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('schools.store') }}">
                        @csrf

                        <div class="row">
                            {{-- EMIS Code --}}
                            <div class="col-md-6">
                                <label>EMIS Code</label>
                                <input type="text" name="emis_code" class="form-control" required>
                            </div>

                            {{-- School Name --}}
                            <div class="col-md-6">
                                <label>School Name</label>
                                <input type="text" name="school_name" class="form-control" required>
                            </div>

                            {{-- Level --}}
                            <div class="col-md-6 mt-3">
                                <label>School Level</label>
                                <select name="school_level" class="form-control" required>
                                    <option value="">Select Level</option>
                                    <option value="Primary">Primary</option>
                                    <option value="Middle">Middle</option>
                                    <option value="High">High</option>
                                </select>
                            </div>

                            {{-- Zone --}}
                            <div class="col-md-6 mt-3">
                                <label>Zone</label>
                                <select name="zone" class="form-control" required>
                                    <option value="">Select Zone</option>
                                    <option value="Summer Zone">Summer Zone</option>
                                    <option value="Winter Zone">Winter Zone</option>
                                </select>
                            </div>

                            {{-- District --}}
                            <div class="col-md-6 mt-3">
                                <label>District</label>
                                <select id="districtSelect" name="district_id" class="form-control select2" required>
                                    <option value="">Select District</option>
                                    @foreach ($districts as $district)
                                        <option value="{{ $district->id }}">{{ $district->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Tehsil (Dynamic) --}}
                            <div class="col-md-6 mt-3">
                                <label>Tehsil</label>
                                <select id="tehsilSelect" name="tehsil_id" class="form-control select2" required>
                                    <option value="">Select Tehsil</option>
                                    @foreach ($tehsils as $tehsil)
                                        <option value="{{ $tehsil->id }}">{{ $tehsil->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Head Teacher --}}
                            <div class="col-md-6 mt-3">
                                <label>Head Teacher Name</label>
                                <input type="text" name="head_teacher_name" class="form-control" required>
                            </div>

                            {{-- Head Teacher Phone --}}
                            <div class="col-md-6 mt-3">
                                <label>Head Teacher Phone</label>
                                <input type="text" name="head_teacher_phone" class="form-control" required>
                            </div>

                            {{-- Email --}}
                            <div class="col-md-6 mt-3">
                                <label>Email (Optional)</label>
                                <input type="email" name="email" class="form-control">
                            </div>

                           {{-- Password --}}
<div class="col-md-6 mt-3">
    <label for="password" class="font-weight-bold">Password</label>
    <div class="input-group">
        <input type="password" name="password" id="password" class="form-control" placeholder="Enter Password" required>
        <div class="input-group-append">
            <span class="input-group-text bg-white border-left-0" style="cursor: pointer;" id="togglePassword">
                <i class="fa fa-eye-slash" id="eyeIcon"></i>
            </span>
        </div>
    </div>
</div>


                            {{-- Teachers Count --}}
                            <div class="col-md-6 mt-3">
                                <label>Number of Teachers</label>
                                <input type="number" name="number_of_teachers" class="form-control" min="0"
                                    value="0" required>
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="btn btn-primary">Save School</button>
                            <a href="{{ route('schools.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
            {{-- passoword visibility toggle --}}
  <script>
    const passwordField = document.getElementById('password');
    const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    togglePassword.addEventListener('click', function () {
        const isPassword = passwordField.getAttribute('type') === 'password';
        passwordField.setAttribute('type', isPassword ? 'text' : 'password');
        eyeIcon.classList.toggle('fa-eye');
        eyeIcon.classList.toggle('fa-eye-slash');
    });
</script>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 only for District and Tehsil
    $('#districtSelect, #tehsilSelect').select2({
        width: '100%',
        placeholder: 'Select an option',
        allowClear: true
    });

    let tehsilSelect = $('#tehsilSelect');

    // Initially load all tehsils
    $.ajax({
        url: "{{ route('get.tehsils.by.district') }}",
        type: "GET",
        data: { district_id: '' },
        success: function(response) {
            tehsilSelect.empty().append('<option value="">Select Tehsil</option>');
            $.each(response, function(_, tehsil) {
                tehsilSelect.append('<option value="'+ tehsil.id +'">'+ tehsil.name +'</option>');
            });
            tehsilSelect.trigger('change.select2');
        }
    });

    // When a district is selected
    $('#districtSelect').on('change', function() {
        let districtId = $(this).val();

        if (!districtId) {
            tehsilSelect.empty().append('<option value="">Select Tehsil</option>');
            return;
        }

        $.ajax({
            url: "{{ route('get.tehsils.by.district') }}",
            type: "GET",
            data: { district_id: districtId },
            success: function(response) {
                tehsilSelect.empty().append('<option value="">Select Tehsil</option>');
                $.each(response, function(_, tehsil) {
                    tehsilSelect.append('<option value="'+ tehsil.id +'">'+ tehsil.name +'</option>');
                });
                tehsilSelect.trigger('change.select2');
            },
            error: function() {
                tehsilSelect.empty().append('<option value="">Error loading tehsils</option>');
            }
        });
    });

});
</script>

@endpush
