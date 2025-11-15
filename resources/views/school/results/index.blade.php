@extends('layouts.app')

@section('content')
<div class="app-content">
  <section class="section p-4">

    <div class="card p-5 shadow-sm mx-auto" style="max-width: 600px;">
      <form method="GET" action="{{ route('school.results.filter') }}">

        {{-- Select Month --}}
        <div class="form-group mb-4">
          <label class="form-label font-weight-bold">Select Month</label>
          <select name="month" class="form-control select2" required>
            <option value="">Select Month</option>
            @foreach(['January','February','March','April','May','June','July','August','September','October','November','December'] as $month)
              <option value="{{ $month }}">{{ $month }}</option>
            @endforeach
          </select>
        </div>

        {{-- Select Grade --}}
        <div class="form-group mb-4">
          <label class="form-label font-weight-bold">Select Grade</label>
          <select name="grade_id" class="form-control select2" required>
            <option value="">Select Grade</option>
            @foreach($grades as $grade)
              <option value="{{ $grade->id }}">{{ $grade->name }}</option>
            @endforeach
          </select>
        </div>

        {{-- Paper Type --}}
        <div class="form-group mb-4">
          <label class="form-label font-weight-bold">Paper Type</label>
          <select name="type" class="form-control" required>
            <option value="">Select Type</option>
            <option value="formative">Formative</option>
            <option value="semester">Semester</option>
          </select>
        </div>

        {{-- Submit Button --}}
        <div class="text-center">
          <button type="submit" class="btn btn-primary px-5 py-2">Filter Results</button>
        </div>

      </form>
    </div>
  </section>
</div>
@endsection

@push('scripts')
    <script>
        $(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%'
            });
        });
    </script>
@endpush
