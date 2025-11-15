@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="page-header p-2">
                <h4 class="page-title font-weight-bold">Schools Management</h4>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light-color">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Schools</li>
                </ol>
            </div>

            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">All Schools</h4>
                    <a href="{{ route('schools.create') }}" class="btn btn-sm btn-primary" style="width: 8rem;">Add
                        School</a>
                </div>

                <div class="card-body">

                    <div class="d-flex align-items-center mb-3" style="gap: 1rem;">
                        <!-- District Filter -->
                        <select id="districtFilter" class="form-control select2" style="width: 200px;">
                            <option value="">All Districts</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>

                        <!-- School Search -->
                        <input type="text" id="schoolSearch" class="form-control" style="width: 250px;"
                            placeholder="Search by school name...">

                        <button type="button" id="clearFiltersBtn" class="btn btn-secondary btn-sm" onclick="window.location.reload()">
                            <i class="fa fa-times"></i> Clear
                        </button>
                    </div>

                    <!-- Table container -->
                    <div id="schoolTableContainer" class="table-responsive">
                        @include('partials.school_table', ['schools' => $schools])
                    </div>

                    <div class="d-flex justify-content-end mt-3">
                        {{ $schools->links() }}
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
                width: '25%',
                placeholder: 'Filter by District',
                allowClear: true
            });



            function fetchSchools() {
                const district_id = $('#districtFilter').val();
                const school_name = $('#schoolSearch').val();

                $.ajax({
                    url: "{{ route('schools.filter') }}",
                    type: 'GET',
                    data: {
                        district_id,
                        school_name
                    },
                    beforeSend: function() {
                        $('#schoolTableContainer').html(
                            '<div class="text-center p-4">Loading...</div>');
                    },
                    success: function(data) {
                        $('#schoolTableContainer').html(data);
                    },
                    error: function() {
                        alert('Error loading schools. Please try again.');
                    }
                });
            }

            // Trigger search on input
            $('#schoolSearch').on('keyup', fetchSchools);
            // Trigger on district change
            $('#districtFilter').on('change', fetchSchools);

        });
    </script>
@endpush
