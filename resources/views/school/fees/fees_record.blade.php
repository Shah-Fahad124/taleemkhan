@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Student Fee Records</h4>
                </div>

                <div class="card-body">
                    <!-- Filters -->
                    <div class="card p-3 mb-4 border">
                        <form method="GET">
                            <div class="form-row align-items-center">
                                   <!-- Student Name -->
                                <div class="col-md-3 mb-3">
                                    <label>Student</label>
                                    <input type="text" name="student_name" class="form-control"
                                        placeholder="Search name..." value="{{ request('student_name') }}">
                                </div>


                                <!-- Year -->
                                <div class="col-md-2 mb-3">
                                    <label>Year</label>
                                    <select name="year" class="form-control">
                                        <option value="">All</option>
                                        @foreach ($years as $year)
                                            <option value="{{ $year }}"
                                                {{ $selectedYear == $year ? 'selected' : '' }}>
                                                {{ $year }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Month -->
                                <div class="col-md-2 mb-3">
                                    <label>Month</label>
                                    <select name="month" class="form-control select2">
                                        <option value="">All</option>
                                        @foreach ($months as $month)
                                            <option value="{{ $month }}"
                                                {{ $selectedMonth == $month ? 'selected' : '' }}>
                                                {{ $month }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Class -->
                                <div class="col-md-2 mb-3">
                                    <label>Class</label>
                                    <select name="class_id" class="form-control select2">
                                        <option value="">All</option>
                                        @foreach ($classes as $class)
                                            <option value="{{ $class->id }}"
                                                {{ request('class_id') == $class->id ? 'selected' : '' }}>
                                                {{ $class->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Status -->
                                <div class="col-md-2 mb-3">
                                    <label>Status</label>
                                    <select name="status" class="form-control select2">
                                        <option value="">All</option>
                                        <option value="Paid" {{ request('status') == 'Paid' ? 'selected' : '' }}>Paid
                                        </option>
                                        <option value="Partial" {{ request('status') == 'Partial' ? 'selected' : '' }}>
                                            Partial</option>
                                        <option value="Unpaid" {{ request('status') == 'Unpaid' ? 'selected' : '' }}>Unpaid
                                        </option>
                                    </select>
                                </div>

                            </div>
                             <!-- Buttons -->
                                <div class="d-flex justify-content-end" style="gap: 10px">
                                    <button class="btn btn-primary" type="submit">Apply</button>
                                    <a href="{{ route('fees.index') }}" class="btn btn-secondary">Reset</a>
                                </div>
                        </form>
                    </div>


                    <!-- Fee Records Table -->
                    <div class="table-responsive">
                        <table class="table table-bordered align-middle">
                            <thead class="bg-light">
                                <tr>
                                    <th>Student Name</th>
                                    <th>Class</th>
                                    <th>Month / Year</th>
                                    <th>Total Fee</th>
                                    <th>Discount</th>
                                    <th>Paid</th>
                                    <th>Due</th>
                                    <th>Status</th>
                                    <th>Payment Date</th>
                                    <th>Remarks</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($records as $record)
                                    <tr
                                        class="@if ($record->status == 'Paid') table-success
                                            @elseif($record->status == 'Partial') table-warning
                                            @else table-danger @endif">
                                        <td>{{ $record->student->full_name }}</td>
                                        <td>{{ $record->class->name }}</td>
                                        <td>{{ $record->month }} / {{ $record->year }}</td>
                                        <td>{{ number_format($record->total_fee, 2) }}</td>
                                        <td>{{ number_format($record->discount, 2) }}</td>
                                        <td>{{ number_format($record->paid_amount, 2) }}</td>
                                        <td>{{ number_format($record->due_amount, 2) }}</td>
                                        <td>{{ $record->status }}</td>
                                        <td>{{ $record->payment_date ? $record->payment_date->format('d-M-Y') : '-' }}</td>
                                        <td>{{ $record->remarks ?? '-' }}</td>
                                        <td class="d-flex" style="gap: 5px">
                                            <a href="{{ route('fees.view', $record->id) }}"
                                                class="btn btn-sm btn-info">View</a>
                                            <a href="{{ route('fees.edit', $record->id) }}"
                                                class="btn btn-sm btn-primary">Edit</a>
                                            <form action="{{ route('fees.destroy', $record->id) }}" method="POST"
                                                class="d-inline"
                                                onsubmit="return confirm('Are you sure you want to delete this record?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    Delete
                                                </button>
                                            </form>

                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="11" class="text-center">No records found.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $records->withQueryString()->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.select2').select2({
                width: '100%'
            });
        });
    </script>
@endpush
