@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">

            <!-- Main Container -->
            <div class="management-container">
                <!-- Header Section -->
                <div class="management-header">
                    <div class="header-content">
                        <h1 class="management-title">Student Management</h1>
                        <p class="management-subtitle">Browse and manage student records</p>
                    </div>
                </div>

                <!-- Filters Section -->
                <div class="filters-section">
                    <div class="filters-container">
                        <!-- Grade Filter -->
                        <div class="filter-group">
                            <select id="gradeFilter" class="filter-select">
                                <option value="">All Grades</option>
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Search Input -->
                        <div class="filter-group search-group">
                            <input type="text" id="studentSearch" class="search-input" placeholder="Search students...">
                            <i class="search-icon fas fa-search"></i>
                        </div>

                        <!-- Action Buttons -->
                        <div class="filter-actions">
                            <button onclick="window.location.reload()" class="action-btn clear-btn">
                                <i class="fas fa-undo"></i>
                                Reset
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Content Section -->
                <div class="content-section">
                    <div class="table-container" id="studentsTableContainer">
                        @include('partials.students_table', ['students' => $students])
                    </div>
                </div>
            </div>

        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize select
            $('.filter-select').select2({
                width: '100%',
                placeholder: 'Filter by grade',
                allowClear: true,
                minimumResultsForSearch: 3
            });

            // Debounce function for search
            let searchTimeout;

            function fetchStudents() {
                const grade_id = $('#gradeFilter').val();
                const search = $('#studentSearch').val();

                $.ajax({
                    url: "{{ route('school.students.filter') }}",
                    type: 'GET',
                    data: {
                        grade_id,
                        search
                    },
                    beforeSend: function() {
                        $('#studentsTableContainer').html(`
                            <div class="loading-state">
                                <div class="loading-spinner">
                                    <div class="spinner"></div>
                                </div>
                                <p class="loading-text">Loading student records...</p>
                            </div>
                        `);
                    },
                    success: function(data) {
                        $('#studentsTableContainer').html(data);
                    },
                    error: function() {
                        $('#studentsTableContainer').html(`
                            <div class="error-state">
                                <i class="error-icon fas fa-exclamation-circle"></i>
                                <h3 class="error-title">Unable to Load Students</h3>
                                <p class="error-message">Please check your connection and try again.</p>
                            </div>
                        `);
                    }
                });
            }

            // Search with debounce
            $('#studentSearch').on('keyup', function() {
                clearTimeout(searchTimeout);
                searchTimeout = setTimeout(fetchStudents, 500);
            });

            // Grade filter change
            $('#gradeFilter').on('change', fetchStudents);

            // Auto-focus search input
            $('#studentSearch').focus();
        });
    </script>
@endpush

<style>
    /* Modern Layout Variables */
    :root {
        --border-radius: 12px;
        --border-radius-sm: 8px;
        --spacing-xs: 0.5rem;
        --spacing-sm: 1rem;
        --spacing-md: 1.5rem;
        --spacing-lg: 2rem;
        --shadow-sm: 0 2px 4px rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px rgba(0, 0, 0, 0.07);
        --border-color: #e2e8f0;
        --text-primary: #2d3748;
        --text-secondary: #718096;
        --background-light: #f8fafc;
    }

    /* Main Container */
    .management-container {
        background: white;
        border-radius: var(--border-radius);
        box-shadow: var(--shadow-sm);
        border: 1px solid var(--border-color);
        overflow: hidden;
    }

    /* Header Section */
    .management-header {
        padding: var(--spacing-lg);
        border-bottom: 1px solid var(--border-color);
        background: var(--background-light);
    }

    .management-title {
        font-size: 1.75rem;
        font-weight: 700;
        color: var(--text-primary);
        margin: 0 0 var(--spacing-xs) 0;
        line-height: 1.2;
    }

    .management-subtitle {
        font-size: 1rem;
        color: var(--text-secondary);
        margin: 0;
        font-weight: 400;
    }

    /* Filters Section */
    .filters-section {
        padding: var(--spacing-md);
        border-bottom: 1px solid var(--border-color);
        background: white;
    }

    .filters-container {
        display: flex;
        align-items: center;
        gap: var(--spacing-md);
        flex-wrap: wrap;
    }

    .filter-group {
        flex: 1;
        min-width: 150px;
        max-width: 200px;
    }

    .search-group {
        position: relative;
        flex: 2;
        min-width: 250px;
        max-width: 400px;
    }

    .filter-select {
        width: 100%;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-sm);
        padding: 0.75rem;
        font-size: 0.875rem;
        background: white;
        transition: all 0.2s ease;
    }

    .filter-select:focus {
        outline: none;
        border-color: #3C3B3F;
        box-shadow: 0 0 0 3px rgba(60, 59, 63, 0.1);
    }

    .search-input {
        width: 100%;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-sm);
        padding: 0.75rem 2.5rem 0.75rem 1rem;
        font-size: 0.875rem;
        transition: all 0.2s ease;
        background: white;
    }

    .search-input:focus {
        outline: none;
        border-color: #3C3B3F;
        box-shadow: 0 0 0 3px rgba(60, 59, 63, 0.1);
    }

    .search-icon {
        position: absolute;
        right: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: var(--text-secondary);
        font-size: 0.875rem;
    }

    /* Action Buttons */
    .filter-actions {
        flex-shrink: 0;
    }

    .action-btn {
        padding: 0.75rem 1.25rem;
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-sm);
        font-size: 0.875rem;
        font-weight: 500;
        cursor: pointer;
        transition: all 0.2s ease;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: white;
        color: var(--text-primary);
    }

    .clear-btn:hover {
        background: var(--background-light);
        border-color: var(--text-secondary);
        transform: translateY(-1px);
    }

    /* Content Section */
    .content-section {
        padding: var(--spacing-md);
    }

    .table-container {
        background: white;
        border-radius: var(--border-radius-sm);
        overflow: hidden;
    }

    /* Loading States */
    .loading-state {
        padding: var(--spacing-lg);
        text-align: center;
    }

    .loading-spinner {
        display: inline-block;
        margin-bottom: var(--spacing-sm);
    }

    .spinner {
        width: 40px;
        height: 40px;
        border: 3px solid var(--border-color);
        border-top: 3px solid #3C3B3F;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% {
            transform: rotate(0deg);
        }

        100% {
            transform: rotate(360deg);
        }
    }

    .loading-text {
        color: var(--text-secondary);
        font-size: 0.875rem;
        margin: 0;
    }

    /* Error States */
    .error-state {
        padding: var(--spacing-lg);
        text-align: center;
    }

    .error-icon {
        font-size: 3rem;
        color: #e53e3e;
        margin-bottom: var(--spacing-sm);
    }

    .error-title {
        color: var(--text-primary);
        margin: 0 0 var(--spacing-xs) 0;
        font-size: 1.125rem;
    }

    .error-message {
        color: var(--text-secondary);
        margin: 0;
        font-size: 0.875rem;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .management-header {
            padding: var(--spacing-md);
        }

        .management-title {
            font-size: 1.5rem;
        }

        .filters-section {
            padding: var(--spacing-sm);
        }

        .filters-container {
            flex-direction: column;
            align-items: stretch;
            gap: var(--spacing-sm);
        }

        .filter-group,
        .search-group {
            min-width: auto;
            max-width: none;
        }

        .filter-actions {
            align-self: stretch;
        }

        .action-btn {
            width: 100%;
            justify-content: center;
        }

        .content-section {
            padding: var(--spacing-sm);
        }
    }

    @media (max-width: 480px) {
        .management-header {
            padding: var(--spacing-sm);
        }

        .management-title {
            font-size: 1.25rem;
        }

        .management-subtitle {
            font-size: 0.875rem;
        }
    }

    /* Select2 Customization */
    .select2-container--default .select2-selection--single {
        border: 1px solid var(--border-color);
        border-radius: var(--border-radius-sm);
        height: auto;
        padding: 0.75rem;
    }

    .select2-container--default .select2-selection--single .select2-selection__arrow {
        height: 100%;
    }

    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 1.5;
        padding: 0;
    }
</style>
