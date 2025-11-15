@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="card">
            <div class="card-header">
                <h4>Edit Fee Record</h4>
            </div>
            <div class="card-body">
                <form action="{{ route('fees.update', $record->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label">Student Name</label>
                            <input type="text" class="form-control" value="{{ $record->student->full_name }}" readonly>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Class</label>
                            <select name="class_id" class="form-select" required>
                                @foreach ($classes as $class)
                                    <option value="{{ $class->id }}" {{ $record->class_id == $class->id ? 'selected' : '' }}>
                                        {{ $class->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Month</label>
                            <input type="text" name="month" class="form-control" value="{{ $record->month }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Year</label>
                            <input type="number" name="year" class="form-control" value="{{ $record->year }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Total Fee</label>
                            <input type="number" name="total_fee" class="form-control" value="{{ $record->total_fee }}" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Discount</label>
                            <input type="number" name="discount" class="form-control" value="{{ $record->discount }}">
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-3">
                            <label class="form-label">Paid Amount</label>
                            <input type="number" name="paid_amount" class="form-control" value="{{ $record->paid_amount }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Due Amount</label>
                            <input type="number" name="due_amount" class="form-control" value="{{ $record->due_amount }}">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Status</label>
                            <select name="status" class="form-select" required>
                                <option value="Paid" {{ $record->status == 'Paid' ? 'selected' : '' }}>Paid</option>
                                <option value="Partial" {{ $record->status == 'Partial' ? 'selected' : '' }}>Partial</option>
                                <option value="Unpaid" {{ $record->status == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Payment Date</label>
                            <input type="date" name="payment_date" class="form-control"
                                value="{{ $record->payment_date ? \Carbon\Carbon::parse($record->payment_date)->format('Y-m-d') : '' }}">
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Remarks</label>
                        <textarea name="remarks" class="form-control" rows="3">{{ $record->remarks }}</textarea>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Record</button>
                    <a href="{{ route('fees.index') }}" class="btn btn-secondary">Cancel</a>
                </form>
            </div>
        </div>
    </section>
</div>
@endsection
