<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>DMC - {{ $student->student_name }}</title>
  <style>
    /* General Page Styling */
    body {
      font-family: DejaVu Sans, sans-serif;
      font-size: 12px;
      margin: 40px 60px;
      color: #000;
    }

    /* Header Section */
    .header {
      text-align: center;
      border-bottom: 2px solid #000;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }
    .header h1 {
      font-size: 22px;
      margin: 0;
      font-weight: bold;
      text-transform: uppercase;
    }
    .header h3 {
      margin: 5px 0;
      font-size: 14px;
      font-weight: normal;
    }

    /* Student Info Table */
    .student-info {
      width: 100%;
      border-collapse: collapse;
      margin-top: 15px;
      margin-bottom: 10px;
    }
    .student-info th {
      background-color: #f2f2f2;
      text-align: left;
      padding: 8px;
      width: 25%;
      border: 1px solid #000;
      font-weight: bold;
    }
    .student-info td {
      border: 1px solid #000;
      padding: 8px;
      text-align: left;
    }

    /* Results Table */
    table.results {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    .results th, .results td {
      border: 1px solid #000;
      padding: 8px;
      text-align: center;
    }
    .results th {
      background-color: #f2f2f2;
      font-weight: bold;
    }
    .results tr:nth-child(even) {
      background-color: #fafafa;
    }

    /* Summary Row */
    .results tfoot th {
      font-weight: bold;
      background-color: #f9f9f9;
    }

    /* Footer */
    .footer {
      margin-top: 50px;
      text-align: right;
    }
    .footer p {
      display: inline-block;
      text-align: center;
      margin-right: 50px;
    }

    /* Optional: Border around printable area */
    .page-border {
      border: 1px solid #000;
      padding: 20px 30px;
    }
  </style>
</head>
<body>

  <div class="page-border">
    <!-- School Header -->
    <div class="header">
      <h1>{{ $school->school_name ?? 'Your School Name' }}</h1>
      <h3>
        {{ ucfirst($results->first()->paper_type ?? '-') }} Examination -
        {{ $results->first()->month ?? '-' }} {{ $results->first()->academic_year ?? '-' }}
      </h3>
      <h3>Class: {{ $student->grade->name ?? '-' }}</h3>
      <h3>Detailed Marks Certificate (DMC)</h3>
    </div>

    <!-- Student Information -->
    <table class="student-info">
      <tr>
        <th>Student Name</th>
        <td>{{ $student->student_name }}</td>
        <th>Roll No</th>
        <td>{{ $student->roll_number }}</td>
      </tr>
      <tr>
        <th>Father Name</th>
        <td>{{ $student->father_name ?? '-' }}</td>
        <th>Form-B Number</th>
        <td>{{ $student->b_form ?? '-' }}</td>
      </tr>
    </table>

    <!-- Results Table -->
    <table class="results">
      <thead>
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

        @foreach($results as $result)
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
      </tbody>
      <tfoot>
        <tr>
          <th>Total</th>
          <th>{{ $grandObtained }}</th>
          <th>{{ $grandTotal }}</th>
          <th></th>
        </tr>
        <tr>
          <th colspan="4">
            Overall Percentage:
            {{ $grandTotal > 0 ? number_format(($grandObtained / $grandTotal) * 100, 2) : 0 }}%
          </th>
        </tr>
      </tfoot>
    </table>

    <!-- Footer Signature -->
    <div class="footer">
      <p>_________________________<br>Principal / Headmaster</p>
    </div>
  </div>

</body>
</html>
