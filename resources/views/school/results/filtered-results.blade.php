@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section p-3">
            <div class="page-header p-2">
                <h4 class="page-title font-weight-bold">
                    {{ $grade->name ?? '' }} - {{ ucfirst($request->type) }} Results ({{ $request->month }})
                </h4>
            </div>

            <div class="card shadow-sm">
                <div class="card-body table-responsive">
                    <table class="table table-bordered text-center align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Roll No</th>
                                <th>Student Name</th>
                                <th>Total Obtained</th>
                                <th>Total Marks</th>
                                <th>Percentage</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($results as $result)
                                @php
                                    $percentage =
                                        $result->total_marks > 0
                                            ? round(($result->total_obtained / $result->total_marks) * 100, 2)
                                            : 0;
                                @endphp
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $result->roll_number }}</td>
                                    <td>{{ $result->student_name }}</td>
                                    <td>{{ $result->total_obtained }}</td>
                                    <td>{{ $result->total_marks }}</td>
                                    <td>{{ $percentage }}%</td>
                                    <td>
                                        <a
                                            href="{{ route('school.results.dmc', [
                                                'student' => $result->student_id,
                                                'month' => $request->month,
                                                'type' => $request->type,
                                            ]) }}">
                                            View DMC
                                        </a>

                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-muted text-center">No results found for this filter.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </div>
@endsection
