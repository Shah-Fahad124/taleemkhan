@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="section-header">
            <h5 class="page__heading">Fee Record Details</h5>
            <div class="ml-auto">
                <a href="{{ route('fees.index') }}" class="btn btn-primary btn-sm">
                    <i class="fas fa-arrow-left"></i> Back to Fee Records
                </a>
            </div>
        </div>

        <div class="card">
            <div class="card-body">

                {{-- Student Information --}}
                <h6 class="font-weight-bold mb-3 border-bottom pb-2">Student Information</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Student Name:</strong> {{ $record->student->full_name ?? '-' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Class:</strong> {{ $record->class->name ?? '-' }}
                    </div>
                    <div class="col-md-4">
                        <strong>Admission No:</strong> {{ $record->student->id ?? 'N/A' }}
                    </div>
                </div>

                {{-- Fee Period Information --}}
                <h6 class="font-weight-bold mb-3 border-bottom pb-2">Fee Period</h6>
                <div class="row mb-3">
                    <div class="col-md-4">
                        <strong>Month:</strong> {{ $record->month }}
                    </div>
                    <div class="col-md-4">
                        <strong>Year:</strong> {{ $record->year }}
                    </div>
                    <div class="col-md-4">
                        <strong>Payment Date:</strong>
                        {{ $record->payment_date ? \Carbon\Carbon::parse($record->payment_date)->format('d-M-Y') : '-' }}
                    </div>
                </div>

                {{-- Fee Details --}}
                <h6 class="font-weight-bold mb-3 border-bottom pb-2">Fee Details</h6>
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-light">
                            <tr>
                                <th>Total Fee</th>
                                <th>Discount</th>
                                <th>Paid Amount</th>
                                <th>Due Amount</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ number_format($record->total_fee, 2) }}</td>
                                <td>{{ number_format($record->discount, 2) }}</td>
                                <td>{{ number_format($record->paid_amount, 2) }}</td>
                                <td class="{{ $record->due_amount > 0 ? 'text-danger font-weight-bold' : '' }}">
                                    {{ number_format($record->due_amount, 2) }}
                                </td>
                                <td>
                                    @if ($record->status === 'Paid')
                                        <span class="badge badge-success">{{ $record->status }}</span>
                                    @elseif ($record->status === 'Partial')
                                        <span class="badge badge-warning">{{ $record->status }}</span>
                                    @else
                                        <span class="badge badge-danger">{{ $record->status }}</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                {{-- Remarks Section --}}
                <div class="mt-3">
                    <h6 class="font-weight-bold mb-2">Remarks</h6>
                    <div class="p-3 border rounded bg-light">
                        {{ $record->remarks ?? 'No remarks added.' }}
                    </div>
                </div>

                {{-- Action Buttons --}}
                <div class="mt-4 text-right">
                    {{-- <a href="{{ route('fees.edit', $record->id) }}" class="btn btn-info btn-sm">
                        <i class="fas fa-edit"></i> Edit
                    </a> --}}

                    <form action="{{ route('fees.destroy', $record->id) }}" method="POST" class="d-inline"
                        onsubmit="return confirm('Are you sure you want to delete this record?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

