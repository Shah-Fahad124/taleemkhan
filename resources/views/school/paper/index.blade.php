@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <!-- Page Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <div>
                    <h4 class="font-weight-bold text-dark mb-1">Paper Generator</h4>
                    <p class="text-muted mb-0">Create customized exam papers for your students</p>
                </div>
            </div>

            <!-- Paper Configuration Card -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0 font-weight-semibold text-primary">
                        <i class="fas fa-cogs mr-2"></i>Paper Configuration
                    </h6>
                </div>
                <div class="card-body">
                    <form id="paperForm" method="POST" action="{{ route('paper-generator.generate') }}">
                        @csrf
                        <div class="row">
                            <!-- Paper Type -->
                            <div class="col-md-4 mb-3">
                                <label class="small font-weight-semibold text-muted mb-2">Paper Type</label>
                                <select name="paper_type" id="paper_type" class="form-control select2" required>
                                    <option value="">Select Paper Type</option>
                                    <option value="formative">Formative Assessment</option>
                                    <option value="semester">Semester Exam</option>
                                </select>
                            </div>

                            <!-- Month (Formative) -->
                            <div class="col-md-4 mb-3" id="monthGroup">
                                <label class="small font-weight-semibold text-muted mb-2">Month</label>
                                <select name="month" id="month" class="form-control select2">
                                    <option value="">Select Month</option>
                                    @foreach ($months as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Semester (Semester) -->
                            <div class="col-md-4 mb-3" id="semesterGroup" style="display:none;">
                                <label class="small font-weight-semibold text-muted mb-2">Semester</label>
                                <select name="semester" id="semester" class="form-control select2">
                                    <option value="">Select Semester</option>
                                    <option value="Fall">Semester 1 (S1)</option>
                                    <option value="Spring">Semester 2 (S2)</option>
                                </select>
                            </div>

                            <!-- Grade -->
                            <div class="col-md-4 mb-3">
                                <label class="small font-weight-semibold text-muted mb-2">Grade</label>
                                <select name="grade_id" id="grade_id" class="form-control select2" required>
                                    <option value="">Select Grade</option>
                                    @foreach ($grades as $grade)
                                        <option value="{{ $grade->id }}">{{ $grade->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <!-- Subject -->
                            <div class="col-md-4 mb-3">
                                <label class="small font-weight-semibold text-muted mb-2">Subject</label>
                                <select name="subject_id" id="subject_id" class="form-control select2" required>
                                    <option value="">Select Subject</option>
                                    @foreach ($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <!-- Generate Button -->
                        <div class="text-center mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">
                                <i class="fas fa-magic mr-2"></i>Generate Paper
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Generated Paper Section -->
            <div id="paperContainer" style="display:none;">
                <!-- Paper Header Info -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-12">
                                <h4 class="font-weight-bold text-primary mb-3">Generated Examination Paper</h4>
                                <div class="row">
                                    <div class="col-md-3 mb-2">
                                        <small class="text-muted d-block">School</small>
                                        <strong class="text-dark">{{ Auth::user()->school_name }}</strong>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <small class="text-muted d-block">Class</small>
                                        <strong class="text-dark" id="paperClass"></strong>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <small class="text-muted d-block">Subject</small>
                                        <strong class="text-dark" id="paperSubject"></strong>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <small class="text-muted d-block">Type</small>
                                        <strong class="text-dark" id="paperType"></strong>
                                    </div>
                                    <div class="col-md-2 mb-2">
                                        <small class="text-muted d-block">Term</small>
                                        <strong class="text-dark" id="paperTerm"></strong>
                                    </div>
                                    <div class="col-md-1 mb-2">
                                        <small class="text-muted d-block">Year</small>
                                        <strong class="text-dark" id="year"></strong>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <!-- Questions Paper -->
                    <div class="col-lg-8 mb-4">
                        <div class="card border-0 shadow-sm">
                            <div class="card-header bg-white">
                                <h6 class="mb-0 font-weight-semibold text-primary">
                                    <i class="fas fa-file-alt mr-2"></i>Examination Paper
                                </h6>
                            </div>
                            <div class="card-body" id="paperContent">
                                <div id="questionsArea" class="text-capitalize"></div>
                            </div>
                        </div>
                    </div>

                    <!-- Answer Key & Actions -->
                    <div class="col-lg-4">
                        <!-- Answer Key -->
                        <div class="card border-0 shadow-sm mb-4">
                            <div class="card-header bg-white">
                                <h6 class="mb-0 font-weight-semibold text-success">
                                    <i class="fas fa-key mr-2"></i>Answer Key
                                </h6>
                            </div>
                            <div class="card-body">
                                <div id="answerKey" class="list-unstyled"></div>
                            </div>
                        </div>

                        <!-- Download Actions -->
                        <div class="card border-0 shadow-sm">
                            <div class="card-body text-center">
                                <h6 class="font-weight-semibold text-muted mb-3">Download Options</h6>
                                <button id="downloadPaperBtn" class="btn btn-success btn-block mb-2">
                                    <i class="fas fa-file-pdf mr-2"></i>Download Paper PDF
                                </button>
                                <button id="downloadKeyBtn" class="btn btn-info btn-block">
                                    <i class="fas fa-key mr-2"></i>Download Answer Key
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hidden form for PDF downloads -->
            <form id="downloadForms" method="POST" class="d-none">
                @csrf
                <input type="hidden" name="grade">
                <input type="hidden" name="subject">
                <input type="hidden" name="paper_type">
                <input type="hidden" name="month">
                <input type="hidden" name="semester">
                <input type="hidden" name="ids">
                <input type="hidden" name="paper_id">
                <input type="hidden" name="year">
            </form>
        </section>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                placeholder: 'Select option',
                allowClear: true
            });

            // Toggle month/semester based on paper type
            $('#paper_type').on('change', function() {
                const type = $(this).val();
                $('#monthGroup').toggle(type === 'formative');
                $('#semesterGroup').toggle(type === 'semester');
            });

            // Form submission
            $('#paperForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: "{{ route('paper-generator.generate') }}",
                    method: "POST",
                    data: $(this).serialize(),
                    beforeSend: function() {
                        $('#paperContainer').hide();
                        $('#questionsArea').html(`
                            <div class="text-center py-5">
                                <div class="spinner-border text-primary mb-3" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <p class="text-muted">Generating your paper...</p>
                            </div>
                        `);
                    },
                    success: function(response) {
                        $('#paperContainer').fadeIn();

                        // Update paper header
                        $('#paperClass').text(response.grade);
                        $('#paperSubject').text(response.subject);
                        $('#paperType').text(response.paper_type === 'formative' ?
                            'Formative Assessment' : 'Semester Exam');
                        $('#paperTerm').text(response.paper_type === 'formative' ?
                            response.month : response.semester);
                        $('#year').text(response.academic_year);

                        let questionsHTML = '';
                        let answerHTML = '';

                        if (response.items.length === 0) {
                            questionsHTML = `
                                <div class="text-center py-4">
                                    <i class="fas fa-exclamation-triangle text-warning fa-2x mb-3"></i>
                                    <p class="text-danger">No questions found for this selection.</p>
                                    <small class="text-muted">Please try different criteria.</small>
                                </div>`;
                        } else {
                            const mcqs = response.items.filter(q => q.item_type === 'MCQ');
                            const fibs = response.items.filter(q => q.item_type === 'FIB');
                            const rrqs = response.items.filter(q => q.item_type === 'RRQ');
                            const erqs = response.items.filter(q => q.item_type === 'ERQ');
                            let qNum = 1;

                            // MCQs
                            if (mcqs.length > 0) {
                                questionsHTML += `<h6 class="font-weight-bold text-primary mt-4 mb-3">Section A – Multiple Choice Questions</h6>`;
                                mcqs.forEach(q => {
                                    questionsHTML += `
                                        <div class="mb-4 p-3 border rounded">
                                            <strong class="d-block mb-2">Q${qNum++}. ${q.item_description ?? ''}</strong>
                                            <ol type="A" class="mb-0 pl-3">
                                                <li class="mb-1">${q.option_a ?? ''}</li>
                                                <li class="mb-1">${q.option_b ?? ''}</li>
                                                <li class="mb-1">${q.option_c ?? ''}</li>
                                                <li class="mb-1">${q.option_d ?? ''}</li>
                                            </ol>
                                        </div>`;
                                    answerHTML += `<div class="mb-2"><strong>Q${qNum - 1}:</strong> ${q.correct_answer ?? '—'}</div>`;
                                });
                            }

                            // FIB
                            if (fibs.length > 0) {
                                questionsHTML += `<h6 class="font-weight-bold text-primary mt-4 mb-3">Section B – Fill in the Blanks</h6>`;
                                fibs.forEach(q => {
                                    questionsHTML += `<div class="mb-3 p-3 border rounded"><strong>Q${qNum++}.</strong> ${q.item_description ?? ''}</div>`;
                                    answerHTML += `<div class="mb-2"><strong>Q${qNum - 1}:</strong> ${q.correct_answer ?? '—'}</div>`;
                                });
                            }

                            // RRQ
                            if (rrqs.length > 0) {
                                questionsHTML += `<h6 class="font-weight-bold text-primary mt-4 mb-3">Section C – Short Response Questions</h6>`;
                                rrqs.forEach(q => {
                                    questionsHTML += `<div class="mb-3 p-3 border rounded"><strong>Q${qNum++}.</strong> ${q.item_description ?? ''}</div>`;
                                    answerHTML += `<div class="mb-2"><strong>Q${qNum - 1}:</strong> ${q.possible_answers ?? '—'}</div>`;
                                });
                            }

                            // ERQ
                            if (erqs.length > 0) {
                                questionsHTML += `<h6 class="font-weight-bold text-primary mt-4 mb-3">Section D – Extended Response Questions</h6>`;
                                erqs.forEach(q => {
                                    questionsHTML += `<div class="mb-3 p-3 border rounded"><strong>Q${qNum++}.</strong> ${q.item_description ?? ''}</div>`;
                                    answerHTML += `<div class="mb-2"><strong>Q${qNum - 1}:</strong> Essay type question</div>`;
                                });
                            }
                        }

                        $('#questionsArea').html(questionsHTML);
                        $('#answerKey').html(answerHTML);

                        // Store current paper data for downloads
                        currentPaperData = {
                            grade: response.grade,
                            subject: response.subject,
                            paper_type: response.paper_type,
                            month: response.month,
                            semester: response.semester,
                            academic_year: response.academic_year,
                            ids: response.items.map(i => i.id),
                            paper_id: response.paper_id
                        };
                    },
                    error: function() {
                        alert('Error generating paper. Please try again.');
                    }
                });
            });

            // Download handlers
            let currentPaperData = {};

            $('#downloadPaperBtn, #downloadKeyBtn').on('click', function(e) {
                e.preventDefault();
                const isPaper = $(this).attr('id') === 'downloadPaperBtn';

                const form = $('#downloadForms');
                form.find('input[name="grade"]').val(currentPaperData.grade);
                form.find('input[name="subject"]').val(currentPaperData.subject);
                form.find('input[name="paper_type"]').val(currentPaperData.paper_type);
                form.find('input[name="month"]').val(currentPaperData.month);
                form.find('input[name="semester"]').val(currentPaperData.semester);
                form.find('input[name="ids"]').val(JSON.stringify(currentPaperData.ids));
                form.find('input[name="paper_id"]').val(currentPaperData.paper_id);

                const url = isPaper ?
                    "{{ route('paper-generator.download.paper') }}" :
                    "{{ route('paper-generator.download.key') }}";

                form.attr('action', url);
                form.submit();
            });
        });
    </script>
@endpush

<style>
    .card {
        border-radius: 0.5rem;
    }

    .form-control {
        border-radius: 0.375rem;
        border: 1px solid #e2e8f0;
    }

    .form-control:focus {
        border-color: #3C3B3F;
        box-shadow: 0 0 0 0.2rem rgba(60, 59, 63, 0.1);
    }

    .btn {
        border-radius: 0.375rem;
    }

    .select2-container--bootstrap .select2-selection {
        border: 1px solid #e2e8f0;
        border-radius: 0.375rem;
    }

    .font-weight-semibold {
        font-weight: 600;
    }

    .border {
        border-color: #e2e8f0 !important;
    }
</style>
