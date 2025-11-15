@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <!-- Page Header -->
            {{-- <div class="dashboard-header">
                <div class="header-content">
                    <div class="header-text">
                        <h1 class="page-title">Results Management</h1>
                        <p class="page-subtitle">Enter and manage student examination results</p>
                    </div>
                </div>
            </div> --}}

            <!-- Configuration Panel -->
            <div class="config-panel">
                <div class="panel-header">
                    <i class="fas fa-cog panel-icon"></i>
                    <h3 class="panel-title">Paper Configuration</h3>
                </div>
                <div class="panel-body">
                    <form id="filterForm" class="config-form">
                        @csrf
                        <div class="form-grid">
                            <!-- Paper Type -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-file-alt"></i>
                                    Paper Type
                                </label>
                                <select name="paper_type" id="paper_type" class="modern-select" required>
                                    <option value="">Select Paper Type</option>
                                    <option value="formative">Formative Assessment</option>
                                    <option value="semester">Semester Examination</option>
                                </select>
                            </div>

                            <!-- Month -->
                            <div class="form-group" id="monthGroup">
                                <label class="form-label">
                                    <i class="fas fa-calendar-alt"></i>
                                    Month
                                </label>
                                <select name="month" id="month" class="modern-select">
                                    <option value="">Select Month</option>
                                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Semester -->
                            <div class="form-group" id="semesterGroup" style="display:none;">
                                <label class="form-label">
                                    <i class="fas fa-graduation-cap"></i>
                                    Semester
                                </label>
                                <select name="semester" id="semester" class="modern-select">
                                    <option value="">Select Semester</option>
                                    <option value="Fall">Semester 1</option>
                                    <option value="Spring">Semester 2</option>
                                </select>
                            </div>

                            <!-- Grade -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-layer-group"></i>
                                    Grade
                                </label>
                                <select name="grade_id" id="grade_id" class="modern-select" required>
                                    <option value="">Select Grade</option>
                                    @foreach ($grades as $g)
                                        <option value="{{ $g->id }}">{{ $g->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subject -->
                            <div class="form-group">
                                <label class="form-label">
                                    <i class="fas fa-book"></i>
                                    Subject
                                </label>
                                <select name="subject_id" id="subject_id" class="modern-select" required>
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $s)
                                        <option value="{{ $s->id }}">{{ $s->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <button id="loadPaperBtn" class="btn-primary">
                                <i class="fas fa-download"></i>
                                Load Paper & Students
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Results Entry Panel -->
            <div class="results-panel" id="paperArea" style="display:none;">
                <div class="panel-header">
                    <i class="fas fa-edit panel-icon"></i>
                    <div class="panel-title-group">
                        <h3 class="panel-title">Enter Results</h3>
                        <span id="paperInfo" class="paper-info"></span>
                    </div>
                </div>
                <div class="panel-body">
                    <form id="resultsForm" method="POST" action="{{ route('school.results.store') }}">
                        @csrf
                        <input type="hidden" name="paper_id" id="paper_id">

                        <!-- Results Table -->
                        <div class="table-container">
                            <div class="table-wrapper">
                                <table class="results-table" id="resultsTable">
                                    <thead>
                                        <tr id="questionHeader">
                                            <th class="student-col">Student Name</th>
                                            <!-- question headers inserted dynamically -->
                                        </tr>
                                    </thead>
                                    <tbody id="studentsBody">
                                        <!-- student rows inserted dynamically -->
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Global Remarks & Actions -->
                        <div class="results-footer">
                            <div class="remarks-section">
                                <label class="remarks-label">
                                    <i class="fas fa-comment"></i>
                                    Global Remarks (Optional)
                                </label>
                                <input type="text" name="remarks_global" id="remarks_global" class="remarks-input"
                                    placeholder="Enter remarks for all students...">
                            </div>
                            <div class="actions-section">
                                <button type="submit" class="btn-success">
                                    <i class="fas fa-save"></i>
                                    Save All Results
                                </button>
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
        $(function() {
            // Initialize modern selects
            $('.modern-select').select2({
                width: '100%',
                placeholder: 'Choose option...',
                allowClear: true,
                minimumResultsForSearch: 3
            });

            // Show/Hide Month or Semester fields
            $('#paper_type').on('change', function() {
                const type = $(this).val();
                $('#monthGroup, #semesterGroup').hide();

                if (type === 'formative') {
                    $('#monthGroup').show();
                } else if (type === 'semester') {
                    $('#semesterGroup').show();
                }
            });

            // Load paper via AJAX
            $('#loadPaperBtn').on('click', function(e) {
                e.preventDefault();

                const requestData = {
                    _token: '{{ csrf_token() }}',
                    paper_type: $('#paper_type').val(),
                    grade_id: $('#grade_id').val(),
                    subject_id: $('#subject_id').val(),
                    month: $('#month').val(),
                    semester: $('#semester').val()
                };

                // Client-side validation
                if (!requestData.paper_type || !requestData.grade_id || !requestData.subject_id) {
                    showNotification('Please select Paper Type, Grade, and Subject.', 'error');
                    return;
                }
                if (requestData.paper_type === 'formative' && !requestData.month) {
                    showNotification('Please select Month for formative paper.', 'error');
                    return;
                }
                if (requestData.paper_type === 'semester' && !requestData.semester) {
                    showNotification('Please select Semester for semester paper.', 'error');
                    return;
                }

                // Show loading state
                $('#loadPaperBtn').html('<i class="fas fa-spinner fa-spin"></i> Loading...').prop('disabled', true);

                // Clear old data
                $('#paperArea').hide();
                $('#studentsBody').empty();
                $('#questionHeader').find('th:gt(0)').remove();

                $.post("{{ route('school.results.fetchPaper') }}", requestData)
                    .done(function(res) {
                        // Update paper info
                        $('#paperInfo').text(`Total Marks: ${res.paper.total_marks}`);
                        $('#paper_id').val(res.paper.id);

                        // Build question headers
                        let headerHtml = '<th class="student-col">Student Name</th>';
                        res.questions.forEach((q, i) => {
                            headerHtml += `
                                <th class="question-col" data-qid="${q.id}" data-qmarks="${q.total_marks}">
                                    <div class="question-header">
                                        <span class="q-number">Q${i + 1}</span>
                                        <span class="q-marks">${q.total_marks}</span>
                                    </div>
                                </th>`;
                        });
                        headerHtml += `
                            <th class="total-col obtained">Obtained</th>
                            <th class="total-col possible">Total</th>`;
                        $('#questionHeader').html(headerHtml);

                        // Build student rows with prefilled marks
                        let rowsHtml = '';
                        res.students.forEach(student => {
                            rowsHtml += `
                                <tr data-student="${student.id}">
                                    <td class="student-col">
                                        <div class="student-info">
                                            <span class="student-name">${student.student_name}</span>
                                            <input type="hidden" name="student_ids[]" value="${student.id}">
                                        </div>
                                    </td>`;

                            res.questions.forEach(q => {
                                const prefill = res.existing?.[student.id]?.[q.id] ?? '';
                                rowsHtml += `
                                    <td class="question-col">
                                        <input type="number" min="0" step="1"
                                               class="marks-input"
                                               name="results[${student.id}][${q.id}]"
                                               data-qid="${q.id}" data-possible="${q.total_marks}"
                                               value="${prefill}"
                                               placeholder="0">
                                    </td>`;
                            });

                            rowsHtml += `
                                <td class="total-col obtained">
                                    <span class="total-value">0</span>
                                </td>
                                <td class="total-col possible">
                                    <span class="total-value">0</span>
                                </td>
                                </tr>`;
                        });

                        $('#studentsBody').html(rowsHtml);

                        // Calculate totals immediately for prefilled data
                        const totalPossible = res.questions.reduce((sum, q) => sum + Number(q.total_marks || 0), 0);
                        $('#studentsBody tr').each(function() {
                            let totalObtained = 0;
                            $(this).find('.marks-input').each(function() {
                                totalObtained += Number($(this).val()) || 0;
                            });
                            $(this).find('.total-col.obtained .total-value').text(totalObtained);
                            $(this).find('.total-col.possible .total-value').text(totalPossible);
                        });

                        $('#paperArea').fadeIn();
                        attachInputHandlers();
                        showNotification('Paper loaded successfully!', 'success');
                    })
                    .fail(function(xhr) {
                        showNotification('Failed to load paper. Please check your selections and try again.', 'error');
                    })
                    .always(function() {
                        $('#loadPaperBtn').html('<i class="fas fa-download"></i> Load Paper & Students').prop('disabled', false);
                    });
            });

            // Handle input changes and recalculate totals
            function attachInputHandlers() {
                $('.marks-input').off('input').on('input', function() {
                    const $input = $(this);
                    let val = parseFloat($input.val());
                    const max = parseInt($input.data('possible') || 0);

                    if (isNaN(val) || val < 0) val = 0;
                    if (val > max) val = max;
                    $input.val(val);

                    const $row = $input.closest('tr');
                    let rowTotal = 0;
                    $row.find('.marks-input').each(function() {
                        rowTotal += Number($(this).val()) || 0;
                    });
                    $row.find('.total-col.obtained .total-value').text(rowTotal);
                });
            }

            // Submit results
            $('#resultsForm').on('submit', function(e) {
                e.preventDefault();

                const form = $(this);
                const submitBtn = form.find('button[type="submit"]');
                const payload = form.serializeArray();
                payload.push({
                    name: 'paper_id',
                    value: $('#paper_id').val()
                });

                const globalRemarks = $('#remarks_global').val();
                if (globalRemarks) {
                    $('input[name="student_ids[]"]').each(function() {
                        payload.push({
                            name: `remarks[${$(this).val()}]`,
                            value: globalRemarks
                        });
                    });
                }

                $.ajax({
                    url: form.attr('action'),
                    method: 'POST',
                    data: $.param(payload),
                    beforeSend: () => {
                        submitBtn.html('<i class="fas fa-spinner fa-spin"></i> Saving...').prop('disabled', true);
                    },
                    success: function(res) {
                        showNotification(res.message || 'Results saved successfully!', 'success');
                        setTimeout(() => {
                            location.reload();
                        }, 1500);
                    },
                    error: function(xhr) {
                        submitBtn.html('<i class="fas fa-save"></i> Save All Results').prop('disabled', false);
                        if (xhr.status === 422) {
                            const errors = xhr.responseJSON.errors || {};
                            const msg = Object.values(errors).flat().join("\n");
                            showNotification('Validation errors:\n' + msg, 'error');
                        } else {
                            const msg = xhr.responseJSON?.error || 'Failed to save results.';
                            showNotification(msg, 'error');
                        }
                    }
                });
            });

            // Notification function
            function showNotification(message, type = 'info') {
                // Remove existing notifications
                $('.notification-toast').remove();

                const toast = $(`
                    <div class="notification-toast ${type}">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'error' ? 'exclamation-circle' : 'info-circle'}"></i>
                        <span>${message}</span>
                    </div>
                `);

                $('body').append(toast);
                toast.fadeIn(300);

                setTimeout(() => {
                    toast.fadeOut(300, () => toast.remove());
                }, 4000);
            }
        });
    </script>
@endpush

<style>
    /* Modern Design System */
    :root {
        --primary: #3C3B3F;
        --primary-dark: #605C3C;
        --secondary: #667eea;
        --accent: #764ba2;
        --success: #10b981;
        --warning: #f59e0b;
        --error: #ef4444;
        --gray-50: #f9fafb;
        --gray-100: #f3f4f6;
        --gray-200: #e5e7eb;
        --gray-300: #d1d5db;
        --gray-400: #9ca3af;
        --gray-600: #4b5563;
        --gray-800: #1f2937;
        --shadow-sm: 0 1px 2px 0 rgba(0, 0, 0, 0.05);
        --shadow-md: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-lg: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05);
        --radius: 16px;
        --radius-sm: 8px;
        --radius-md: 12px;
    }

    /* Dashboard Header */
    .dashboard-header {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        border-radius: var(--radius);
        padding: 2rem;
        margin-bottom: 1.5rem;
        color: white;
        box-shadow: var(--shadow-lg);
    }

    .page-title {
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 0.5rem 0;
        color: white;
    }

    .page-subtitle {
        font-size: 1.1rem;
        opacity: 0.9;
        margin: 0;
        font-weight: 400;
    }

    /* Configuration Panel */
    .config-panel, .results-panel {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow-md);
        border: 1px solid var(--gray-200);
        margin-bottom: 1.5rem;
        overflow: hidden;
    }

    .panel-header {
        background: linear-gradient(135deg, var(--gray-50), white);
        padding: 1.5rem 2rem;
        border-bottom: 1px solid var(--gray-200);
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .panel-title-group {
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex: 1;
    }

    .panel-icon {
        font-size: 1.5rem;
        color: var(--primary);
    }

    .panel-title {
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
        color: var(--gray-800);
    }

    .paper-info {
        background: var(--primary);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .panel-body {
        padding: 2rem;
    }

    /* Form Grid */
    .form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .form-group {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }

    .form-label {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .form-label i {
        color: var(--primary);
        width: 16px;
    }

    .modern-select {
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-sm);
        padding: 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
        background: white;
    }

    .modern-select:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(60, 59, 63, 0.1);
    }

    /* Buttons */
    .btn-primary, .btn-success {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        border: none;
        padding: 0.875rem 1.5rem;
        border-radius: var(--radius-sm);
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        cursor: pointer;
        text-decoration: none;
    }

    .btn-success {
        background: linear-gradient(135deg, var(--success), #059669);
    }

    .btn-primary:hover, .btn-success:hover {
        transform: translateY(-2px);
        box-shadow: var(--shadow-md);
    }

    .btn-primary:disabled, .btn-success:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none;
    }

    .form-actions {
        display: flex;
        justify-content: flex-end;
    }

    /* Results Table */
    .table-container {
        background: var(--gray-50);
        border-radius: var(--radius-sm);
        padding: 1rem;
        margin-bottom: 2rem;
    }

    .table-wrapper {
        overflow-x: auto;
        border-radius: var(--radius-sm);
        background: white;
        box-shadow: var(--shadow-sm);
    }

    .results-table {
        width: 100%;
        border-collapse: collapse;
        min-width: 800px;
    }

    .results-table th {
        background: var(--gray-100);
        padding: 1rem;
        font-weight: 600;
        font-size: 0.875rem;
        text-align: center;
        border-bottom: 2px solid var(--gray-200);
        color: var(--gray-800);
    }

    .results-table td {
        padding: 0.75rem;
        border-bottom: 1px solid var(--gray-200);
        text-align: center;
    }

    .student-col {
        text-align: left;
        min-width: 200px;
        position: sticky;
        left: 0;
        background: white;
        z-index: 1;
    }

    .question-col {
        min-width: 80px;
    }

    .total-col {
        min-width: 100px;
        font-weight: 600;
        background: var(--gray-50);
    }

    .question-header {
        display: flex;
        flex-direction: column;
        gap: 0.25rem;
    }

    .q-number {
        font-weight: 600;
        color: var(--gray-800);
    }

    .q-marks {
        font-size: 0.75rem;
        color: var(--gray-600);
        background: var(--gray-200);
        border-radius: 12px;
        padding: 0.125rem 0.5rem;
    }

    .student-info {
        display: flex;
        align-items: center;
    }

    .student-name {
        font-weight: 500;
        color: var(--gray-800);
    }

    .marks-input {
        width: 60px;
        border: 1px solid var(--gray-300);
        border-radius: 6px;
        padding: 0.5rem;
        text-align: center;
        font-size: 0.875rem;
        transition: all 0.2s ease;
    }

    .marks-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 2px rgba(60, 59, 63, 0.1);
    }

    .total-value {
        font-weight: 600;
        color: var(--gray-800);
    }

    /* Results Footer */
    .results-footer {
        display: flex;
        justify-content: space-between;
        align-items: end;
        gap: 2rem;
        flex-wrap: wrap;
    }

    .remarks-section {
        flex: 1;
        min-width: 300px;
    }

    .remarks-label {
        font-weight: 600;
        color: var(--gray-800);
        font-size: 0.875rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-bottom: 0.5rem;
    }

    .remarks-input {
        width: 100%;
        border: 1px solid var(--gray-300);
        border-radius: var(--radius-sm);
        padding: 0.75rem;
        font-size: 0.875rem;
        transition: all 0.3s ease;
    }

    .remarks-input:focus {
        outline: none;
        border-color: var(--primary);
        box-shadow: 0 0 0 3px rgba(60, 59, 63, 0.1);
    }

    .actions-section {
        flex-shrink: 0;
    }

    /* Notifications */
    .notification-toast {
        position: fixed;
        top: 2rem;
        right: 2rem;
        background: white;
        padding: 1rem 1.5rem;
        border-radius: var(--radius-sm);
        box-shadow: var(--shadow-lg);
        border-left: 4px solid var(--success);
        display: flex;
        align-items: center;
        gap: 0.75rem;
        z-index: 1000;
        max-width: 400px;
    }

    .notification-toast.error {
        border-left-color: var(--error);
    }

    .notification-toast i {
        font-size: 1.25rem;
    }

    .notification-toast.success i {
        color: var(--success);
    }

    .notification-toast.error i {
        color: var(--error);
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .dashboard-header {
            padding: 1.5rem;
        }

        .panel-header {
            padding: 1.25rem;
        }

        .panel-body {
            padding: 1.5rem;
        }

        .form-grid {
            grid-template-columns: 1fr;
            gap: 1rem;
        }

        .results-footer {
            flex-direction: column;
            align-items: stretch;
        }

        .remarks-section {
            min-width: auto;
        }

        .page-title {
            font-size: 1.5rem;
        }

        .notification-toast {
            right: 1rem;
            left: 1rem;
            max-width: none;
        }
    }

    @media (max-width: 480px) {
        .dashboard-header {
            padding: 1rem;
        }

        .panel-body {
            padding: 1rem;
        }

        .table-container {
            padding: 0.5rem;
        }

        .marks-input {
            width: 50px;
            padding: 0.375rem;
        }
    }
</style>
