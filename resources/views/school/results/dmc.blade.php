@extends('layouts.app')

@section('content')
<div class="app-content">
  <section class="section p-4">

    <!-- Page Header -->
    <div class="page-header bg-primary text-white text-center rounded p-3 mb-4 shadow-sm">
      <h3 class="mb-1 text-uppercase">{{ $school->school_name ?? 'Your School Name' }}</h3>
      <p class="mb-0">Detailed Marks Certificate (DMC)</p>
    </div>

    <!-- Student Information -->
    <div class="card shadow-sm mb-4 border-0">
      <div class="card-header bg-light border-bottom-0">
        <h5 class="mb-0 font-weight-bold text-primary">
          <i class="fa fa-user mr-2"></i>Student Information
        </h5>
      </div>
      <div class="card-body p-0">
        <table class="table table-bordered m-0">
          <tbody>
            <tr>
              <th class="bg-light" style="width: 25%">Student Name</th>
              <td>{{ $student->student_name }}</td>
              <th class="bg-light" style="width: 25%">Class</th>
              <td>{{ $student->grade->name ?? '-' }}</td>
            </tr>
            <tr>
              <th class="bg-light">Roll Number</th>
              <td>{{ $student->roll_number }}</td>
              <th class="bg-light">Academic Year</th>
              <td>{{ $results->first()->academic_year ?? '-' }}</td>
            </tr>
            <tr>
              <th class="bg-light">Month</th>
              <td>{{ $results->first()->month ?? '-' }}</td>
              <th class="bg-light">Exam Type</th>
              <td>{{ ucfirst($results->first()->paper_type ?? '-') }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

    <!-- Results Table -->
    <div class="card shadow-sm border-0">
      <div class="card-header bg-light border-bottom-0">
        <h5 class="mb-0 font-weight-bold text-primary">
          <i class="fa fa-list mr-2"></i>Result Summary
        </h5>
      </div>
      <div class="card-body table-responsive p-0">
        <table class="table table-bordered text-center align-middle mb-0">
          <thead class="thead-light">
            <tr>
              <th>Subject</th>
              <th>Obtained Marks</th>
              <th>Total Marks</th>
              <th>Remarks</th>
            </tr>
          </thead>
          <tbody>
            @php
              $grandObtained = 0;
              $grandTotal = 0;
            @endphp
            @foreach ($results as $result)
              @php
                $grandObtained += $result->total_obtained;
                $grandTotal += $result->total_marks;
              @endphp
              <tr>
                <td>{{ $result->subject_name }}</td>
                <td>{{ $result->total_obtained }}</td>
                <td>{{ $result->total_marks }}</td>
                <td>{{ $result->remarks ?? '-' }}</td>
              </tr>
            @endforeach
            <tr class="font-weight-bold bg-light">
              <td>Total</td>
              <td>{{ $grandObtained }}</td>
              <td>{{ $grandTotal }}</td>
              <td></td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>

      <!-- Result Summary -->
        @php
            $percentage = $grandTotal > 0 ? round(($grandObtained / $grandTotal) * 100, 2) : 0;
            if ($percentage >= 90) {
                $grade = 'A+';
            } elseif ($percentage >= 80) {
                $grade = 'A';
            } elseif ($percentage >= 70) {
                $grade = 'B';
            } elseif ($percentage >= 60) {
                $grade = 'C';
            } elseif ($percentage >= 50) {
                $grade = 'D';
            } else {
                $grade = 'F';
            }
        @endphp

        <div class="card shadow-sm mt-4">
            <div class="card-body text-center">
                <h5 class="font-weight-bold mb-3">Result Summary</h5>
                <p><strong>Total Marks:</strong> {{ $grandTotal }}</p>
                <p><strong>Obtained Marks:</strong> {{ $grandObtained }}</p>
                <p><strong>Percentage:</strong> {{ $percentage }}%</p>
                <p><strong>Grade:</strong> {{ $grade }}</p>
                <p class="mt-2 {{ $grade == 'F' ? 'text-danger font-weight-bold' : 'text-success font-weight-bold' }}">
                    {{ $grade == 'F' ? 'Failed' : 'Passed' }}
                </p>
            </div>
        </div>

    <!-- Download Button -->
    <div class="mt-4 text-center">
      <a href="{{ route('school.results.dmc.download', [
          'studentId' => $student->id,
          'month' => $month,
          'type' => $type,
      ]) }}" class="btn btn-primary btn-lg shadow">
        <i class="fa fa-download mr-1"></i> Download PDF
      </a>
    </div>

  </section>
</div>
@endsection
