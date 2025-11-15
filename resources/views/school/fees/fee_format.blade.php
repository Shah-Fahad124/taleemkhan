@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="section-header">
            <h1>Fee Format Setup</h1>
        </div>

        <div class="card">
            <div class="card-body">
                {{-- Fee Format Form --}}
                <form method="POST" action="{{ route('fee-formats.store') }}">
                    @csrf
                    <div class="row">
                        {{-- Select Class --}}
                        <div class="col-md-3 mb-3">
                            <label for="class_id" class="form-label">Class / Grade</label>
                            <select name="class_id" id="class_id" class="form-control" required>
                                <option value="">Select Class</option>
                                @foreach($classes as $class)
                                    <option value="{{ $class->id }}">{{ $class->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Monthly Fee --}}
                        <div class="col-md-3 mb-3">
                            <label for="monthly_fee" class="form-label">Monthly Fee</label>
                            <input type="number" step="0.01" name="monthly_fee" id="monthly_fee" class="form-control" required>
                        </div>

                        {{-- Transport Fee --}}
                        <div class="col-md-3 mb-3">
                            <label for="transport_fee" class="form-label">Transport Fee</label>
                            <input type="number" step="0.01" name="transport_fee" id="transport_fee" class="form-control" value="0">
                        </div>

                        {{-- Computer Fee --}}
                        <div class="col-md-3 mb-3">
                            <label for="computer_fee" class="form-label">Computer Fee</label>
                            <input type="number" step="0.01" name="computer_fee" id="computer_fee" class="form-control" value="0">
                        </div>
                    </div>

                    {{-- Total Fee (auto-calc) --}}
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <label for="total_fee" class="form-label">Total Fee</label>
                            <input type="number" step="0.01" name="total_fee" id="total_fee" class="form-control" readonly>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary mt-2">Save Fee Format</button>
                </form>
            </div>
        </div>

        {{-- Existing Formats Table --}}
        <div class="card mt-4">
            <div class="card-header">
                <h4>Existing Fee Formats</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Class</th>
                                <th>Monthly Fee</th>
                                <th>Transport Fee</th>
                                <th>Computer Fee</th>
                                <th>Total Fee</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($feeFormats as $format)
                                <tr>
                                    <td>{{ $format->class->name }}</td>
                                    <td>{{ number_format($format->monthly_fee, 2) }}</td>
                                    <td>{{ number_format($format->transport_fee, 2) }}</td>
                                    <td>{{ number_format($format->computer_fee, 2) }}</td>
                                    <td>{{ number_format($format->total_fee, 2) }}</td>
                                    <td>
                                        <a href="{{ route('fee-formats.edit', $format->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                        <form action="{{ route('fee-formats.destroy', $format->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this format?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>

{{-- Auto calculate total --}}
<script>
    const monthly = document.getElementById('monthly_fee');
    const transport = document.getElementById('transport_fee');
    const computer = document.getElementById('computer_fee');
    const total = document.getElementById('total_fee');

    function calcTotal() {
        const m = parseFloat(monthly.value) || 0;
        const t = parseFloat(transport.value) || 0;
        const c = parseFloat(computer.value) || 0;
        total.value = (m + t + c).toFixed(2);
    }

    monthly.addEventListener('input', calcTotal);
    transport.addEventListener('input', calcTotal);
    computer.addEventListener('input', calcTotal);
</script>
@endsection
