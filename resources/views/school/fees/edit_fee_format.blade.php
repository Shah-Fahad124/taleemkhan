@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="card shadow-sm">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">Edit Fee Format</h4>
                <a href="{{ route('fee-formats.index') }}" class="btn btn-sm btn-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back
                </a>
            </div>

            <div class="card-body">
                <form action="{{ route('fee-formats.update', $feeFormat->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Class -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Select Class</label>
                            <select name="class_id" class="form-control select2" required>
                                <option value="">Select Class</option>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ $feeFormat->class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Monthly Fee -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Monthly Fee</label>
                            <input type="number" name="monthly_fee" class="form-control"
                                   value="{{ old('monthly_fee', $feeFormat->monthly_fee) }}" required>
                        </div>

                        <!-- Transport Fee -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Transport Fee</label>
                            <input type="number" name="transport_fee" class="form-control"
                                   value="{{ old('transport_fee', $feeFormat->transport_fee) }}">
                        </div>

                        <!-- Computer Fee -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Computer Fee</label>
                            <input type="number" name="computer_fee" class="form-control"
                                   value="{{ old('computer_fee', $feeFormat->computer_fee) }}">
                        </div>

                        <!-- Total Fee -->
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Total Fee</label>
                            <input type="number" name="total_fee" id="total_fee" class="form-control"
                                   value="{{ old('total_fee', $feeFormat->total_fee) }}" required readonly>
                        </div>
                    </div>

                    <div class="text-end mt-3">
                        <button type="submit" class="btn btn-primary px-4">
                            <i class="fa fa-save me-1"></i> Update Fee Format
                        </button>
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
        $('.select2').select2({ width: '100%' });

        // Auto calculate total fee
        $('input[name="monthly_fee"], input[name="transport_fee"], input[name="computer_fee"]').on('input', function() {
            const monthly = parseFloat($('input[name="monthly_fee"]').val()) || 0;
            const transport = parseFloat($('input[name="transport_fee"]').val()) || 0;
            const computer = parseFloat($('input[name="computer_fee"]').val()) || 0;
            $('#total_fee').val(monthly + transport + computer);
        });
    });
</script>
@endpush
