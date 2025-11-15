@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="font-weight-bold text-dark mb-1">Create Paper Format</h4>
                    <p class="text-muted mb-0">Define question distribution for exam papers</p>
                </div>
                <a href="{{ route('paper-formats.index') }}" class="btn btn-outline-primary">
                    <i class="fas fa-list mr-2"></i>View Formats
                </a>
            </div>

            <!-- Configuration Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0 font-weight-semibold text-primary">
                        <i class="fas fa-cog mr-2"></i>Basic Configuration
                    </h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('paper-formats.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <label class="small font-weight-semibold text-muted mb-2">Paper Type</label>
                                <select name="paper_type" class="form-control" required>
                                    <option value="formative">Formative Assessment</option>
                                    <option value="semester">Semester Exam</option>
                                </select>
                            </div>
                        </div>
                </div>
            </div>

            <!-- Questions Distribution Card -->
            <div class="card border-0 shadow-sm">
                <div class="card-header bg-light">
                    <h6 class="mb-0 font-weight-semibold text-primary">
                        <i class="fas fa-layer-group mr-2"></i>Questions Distribution
                    </h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="thead-light text-white">
                                <tr class="">
                                    <th class="border-0 font-weight-semibold">Question Type</th>
                                    <th class="border-0 text-center font-weight-semibold">Easy</th>
                                    <th class="border-0 text-center font-weight-semibold">Medium</th>
                                    <th class="border-0 text-center font-weight-semibold">Hard</th>
                                    <th class="border-0 text-center font-weight-semibold">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $types = [
                                        'mcq' => ['label' => 'Multiple Choice', 'icon' => 'fas fa-list-ol'],
                                        'fib' => ['label' => 'Fill in Blanks', 'icon' => 'fas fa-edit'],
                                        'rrq' => ['label' => 'Short Response', 'icon' => 'fas fa-comment-alt'],
                                        'erq' => ['label' => 'Extended Response', 'icon' => 'fas fa-file-alt'],
                                    ];
                                @endphp
                                @foreach ($types as $key => $type)
                                    <tr>
                                        <td class="font-weight-semibold">
                                            <i class="{{ $type['icon'] }} mr-2 text-primary"></i>
                                            {{ $type['label'] }}
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="{{ $key }}_easy"
                                                class="form-control form-control-sm q-input text-center" placeholder="0"
                                                min="0">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="{{ $key }}_medium"
                                                class="form-control form-control-sm q-input text-center" placeholder="0"
                                                min="0">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="{{ $key }}_hard"
                                                class="form-control form-control-sm q-input text-center" placeholder="0"
                                                min="0">
                                        </td>
                                        <td class="text-center">
                                            <input type="number" name="{{ $key }}_total"
                                                class="form-control form-control-sm total-field text-center bg-light"
                                                readonly>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td class="font-weight-bold text-right">Overall Total:</td>
                                    <td colspan="3"></td>
                                    <td class="text-center">
                                        <span id="overallTotal" class="font-weight-bold text-primary h5">0</span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <!-- Action Buttons -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="text-muted">
                                    <small>All fields are optional. Leave blank for zero.</small>
                                </div>
                                <div>
                                    <button type="reset" class="btn btn-outline-secondary mr-2">
                                        <i class="fas fa-redo mr-1"></i>Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-1"></i>Save Format
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
            </div>


        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Calculate totals dynamically
            function calculateTotals() {
                let overall = 0;
                const typeTotals = {
                    mcq: 0,
                    fib: 0,
                    rrq: 0,
                    erq: 0
                };

                $('tbody tr').each(function(index) {
                    const easy = parseInt($(this).find('input[name$="_easy"]').val()) || 0;
                    const medium = parseInt($(this).find('input[name$="_medium"]').val()) || 0;
                    const hard = parseInt($(this).find('input[name$="_hard"]').val()) || 0;
                    const total = easy + medium + hard;

                    $(this).find('.total-field').val(total);
                    overall += total;

                    // Update type-specific totals
                    const types = ['mcq', 'fib', 'rrq', 'erq'];
                    if (types[index]) {
                        typeTotals[types[index]] = total;
                    }
                });

                $('#overallTotal').text(overall);

                // Update quick stats
                $('#totalMcq').text(typeTotals.mcq);
                $('#totalFib').text(typeTotals.fib);
                $('#totalRrq').text(typeTotals.rrq);
                $('#totalErq').text(typeTotals.erq);
            }

            // Input event listeners
            $(document).on('input', '.q-input', function() {
                calculateTotals();
            });

            // Initialize totals
            calculateTotals();

            // Add some visual feedback
            $('.q-input').on('focus', function() {
                $(this).parent().addClass('bg-warning-soft');
            }).on('blur', function() {
                $(this).parent().removeClass('bg-warning-soft');
            });
        });
    </script>
@endpush

<style>
    .card {
        border-radius: 0.5rem;
    }

    .table th {
        border-top: none;
        font-weight: 600;
        font-size: 0.875rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .table td {
        vertical-align: middle;
        padding: 1rem 0.75rem;
    }

    .form-control-sm {
        border-radius: 0.375rem;
        border: 1px solid #e2e8f0;
        font-weight: 500;
    }

    .form-control-sm:focus {
        border-color: #3C3B3F;
        box-shadow: 0 0 0 0.2rem rgba(60, 59, 63, 0.1);
    }

    .total-field {
        background-color: #f8f9fa !important;
        border-color: #e2e8f0 !important;
        font-weight: 600;
        color: #3C3B3F;
    }

    .bg-primary {
        background: linear-gradient(135deg, #3C3B3F, #605C3C) !important;
    }

    .bg-success {
        background: linear-gradient(135deg, #28a745, #20c997) !important;
    }

    .bg-warning {
        background: linear-gradient(135deg, #ffc107, #fd7e14) !important;
    }

    .bg-info {
        background: linear-gradient(135deg, #17a2b8, #6f42c1) !important;
    }

    .bg-warning-soft {
        background-color: rgba(255, 193, 7, 0.1) !important;
    }

    .table-hover tbody tr:hover {
        background-color: rgba(60, 59, 63, 0.02);
    }

    .font-weight-semibold {
        font-weight: 600;
    }

    input[type="number"]::-webkit-outer-spin-button,
    input[type="number"]::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    input[type="number"] {
        -moz-appearance: textfield;
    }
</style>
