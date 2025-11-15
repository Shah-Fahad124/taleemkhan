@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="page-header p-2">
            <h4 class="page-title font-weight-bold">SBA – Item / Question Entry</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Item Bank</li>
            </ol>
        </div>

        <div class="row">
            {{-- ========== LEFT SECTION: Manual Item Entry ========== --}}
            <div class="col-lg-8 col-md-7 mb-4">
                <div class="card shadow-sm border-0 h-100"
                    style="background: linear-gradient(135deg, #ffffff, #f8fafc); border-radius: 12px;">
                    <div class="card-body">
                        <h5 class="font-weight-semibold text-center text-primary mb-3">Add Item / Question Manually</h5>
                        <hr class="pb-2">

                        {{-- Validation Errors --}}
                        @if ($errors->any())
                            <div class="alert alert-danger border-0 shadow-sm">
                                <strong>Please fix the following errors:</strong>
                                <ul class="mt-2 mb-0 pl-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form id="itemForm" action="{{ route('item-bank.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                {{-- SLO --}}
                                <div class="col-md-12 mb-3">
                                    <label>SLO</label>
                                    <input type="text" name="slo" class="form-control" value="{{ old('slo') }}"
                                        placeholder="Reads a short passage and answers questions">
                                </div>

                                {{-- SLO No --}}
                                <div class="col-md-4 mb-3">
                                    <label>SLO No.</label>
                                    <input type="text" name="slo_no" class="form-control"
                                        value="{{ old('slo_no') }}" placeholder="Enter SLO Number">
                                </div>

                                {{-- Subject --}}
                                <div class="col-md-4 mb-3">
                                    <label>Subject <span class="text-danger">*</span></label>
                                    <select name="subject_id" class="form-control select2" required>
                                        <option value="">Select Subject</option>
                                        @foreach ($subjects as $subject)
                                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>
                                                {{ $subject->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Grade --}}
                                <div class="col-md-4 mb-3">
                                    <label>Grade <span class="text-danger">*</span></label>
                                    <select name="grade_id" class="form-control select2" required>
                                        <option value="">Select Grade</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ old('grade_id') == $grade->id ? 'selected' : '' }}>
                                                {{ $grade->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Semester --}}
                                <div class="col-md-4 mb-3">
                                    <label>Semester</label>
                                    <select name="semester" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Fall" {{ old('semester') == 'Fall' ? 'selected' : '' }}>Fall</option>
                                        <option value="Spring" {{ old('semester') == 'Spring' ? 'selected' : '' }}>Spring</option>
                                    </select>
                                </div>

                                {{-- Month --}}
                                <div class="col-md-4 mb-3">
                                    <label>Month</label>
                                    <select name="month" class="form-control select2">
                                        <option value="">Select Month</option>
                                        @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                                            <option value="{{ $m }}" {{ old('month') == $m ? 'selected' : '' }}>{{ $m }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                {{-- Difficulty --}}
                                <div class="col-md-4 mb-3">
                                    <label>Difficulty</label>
                                    <select name="difficulty" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Easy" {{ old('difficulty') == 'Easy' ? 'selected' : '' }}>Easy</option>
                                        <option value="Medium" {{ old('difficulty') == 'Medium' ? 'selected' : '' }}>Medium</option>
                                        <option value="Hard" {{ old('difficulty') == 'Hard' ? 'selected' : '' }}>Hard</option>
                                    </select>
                                </div>

                                {{-- Item Category --}}
                                <div class="col-md-4 mb-3">
                                    <label>Item Category</label>
                                    <select name="category" class="form-control">
                                        <option value="">Select</option>
                                        <option value="Knowledge" {{ old('category') == 'Knowledge' ? 'selected' : '' }}>Knowledge</option>
                                        <option value="Theoretical" {{ old('category') == 'Theoretical' ? 'selected' : '' }}>Theoretical</option>
                                        <option value="Practical" {{ old('category') == 'Practical' ? 'selected' : '' }}>Practical</option>
                                    </select>
                                </div>

                                {{-- Item Type --}}
                                <div class="col-md-4 mb-3">
                                    <label>Item Type <span class="text-danger">*</span></label>
                                    <select id="itemType" name="item_type" class="form-control" required>
                                        <option value="">Select Type</option>
                                        <option value="MCQ" {{ old('item_type') == 'MCQ' ? 'selected' : '' }}>MCQ</option>
                                        <option value="RRQ" {{ old('item_type') == 'RRQ' ? 'selected' : '' }}>RRQ</option>
                                        <option value="ERQ" {{ old('item_type') == 'ERQ' ? 'selected' : '' }}>ERQ</option>
                                    </select>
                                </div>

                                {{-- Skill --}}
                                <div class="col-md-4 mb-3">
                                    <label>Skill</label>
                                    <input type="text" name="skill" class="form-control"
                                        value="{{ old('skill') }}" placeholder="Enter Skill">
                                </div>

                                {{-- Description --}}
                                <div class="col-md-12 mb-3">
                                    <label>Item Description / Stem</label>
                                    <textarea name="item_description" class="form-control" rows="3" placeholder="Write the question text here...">{{ old('item_description') }}</textarea>
                                </div>

                                {{-- Stimulus --}}
                                <div id="stimulus" class="col-md-12 mb-3">
                                    <label>Stimulus</label>
                                    <textarea name="stimulus" class="form-control" rows="2" placeholder="Enter stimulus text...">{{ old('stimulus') }}</textarea>
                                </div>

                                {{-- === MCQ FIELDS === --}}
                                <div id="mcqFields" class="w-100 row mx-2">
                                    @foreach (['A','B','C','D'] as $opt)
                                        <div class="col-md-6 mb-3">
                                            <label>Option {{ $opt }}</label>
                                            <input type="text" name="option_{{ strtolower($opt) }}" class="form-control"
                                                value="{{ old('option_' . strtolower($opt)) }}" placeholder="Option {{ $opt }}">
                                        </div>
                                    @endforeach

                                    <div class="col-md-4 mb-3">
                                        <label>Correct Answer</label>
                                        <select name="correct_answer" class="form-control">
                                            <option value="">Select</option>
                                            @foreach (['A','B','C','D'] as $opt)
                                                <option value="{{ $opt }}" {{ old('correct_answer') == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- === RRQ FIELDS === --}}
                                <div id="rrqFields" class="w-100" style="display: none;">
                                    <div class="col-md-12 mb-3">
                                        <label>Possible Answers</label>
                                        <textarea name="possible_answers" class="form-control">{{ old('possible_answers') }}</textarea>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Marking Hints</label>
                                        <textarea name="marking_hints" class="form-control">{{ old('marking_hints') }}</textarea>
                                    </div>
                                </div>

                                {{-- === ERQ FIELDS === --}}
                                <div id="erqFields" class="w-100" style="display: none;">
                                    <div class="col-md-12 mb-3">
                                        <label>Rubric</label>
                                        <textarea name="rubric" class="form-control">{{ old('rubric') }}</textarea>
                                    </div>
                                </div>

                                {{-- Total Marks --}}
                                <div id="total_marks" class="col-md-4 mb-3">
                                    <label>Total Marks</label>
                                    <input type="number" name="total_marks" class="form-control" min="0"
                                        value="{{ old('total_marks') }}">
                                </div>
                            </div>

                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary" style="color: white;">
                                    <i class="fa fa-save mr-1"></i> Save Item
                                </button>
                                <button type="reset" class="btn btn-secondary">Clear</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- ========== RIGHT SECTION: Import / Export ========== --}}
            <div class="col-lg-4 col-md-5 mb-4">
                <div class="card border-0 shadow-sm"
                    style="background: linear-gradient(135deg, #f9fafb, #eef2f7); border-radius: 12px;">
                    <div class="card-body">
                        <h5 class="font-weight-semibold text-primary mb-3">Import / Export Items</h5>

                        <div class="p-3 rounded"
                            style="background-color: #ffffff; border: 1px solid #428ddd; box-shadow: 0 2px 6px rgba(0,0,0,0.05);">
                            <a href="{{ route('item-bank.sample-export') }}" class="btn btn-sm w-100 mb-2"
                                style="background-color: #c7cadd; color: white; border-radius: 6px;">
                                <i class="fa fa-download mr-1"></i> Download Sample Template
                            </a>

                            <a href="{{ route('item-bank.export') }}" class="btn w-100 mb-3"
                                style="color: white; border-radius: 6px;background-color: #a7ecb7;">
                                <i class="fa fa-file-excel mr-1"></i> Export Existing Items
                            </a>

                            <form action="{{ route('item-bank.import') }}" method="POST" enctype="multipart/form-data" class="mt-2">
                                @csrf
                                <div class="form-group mb-2">
                                    <label class="font-weight-semibold text-muted">Upload Excel File</label>
                                    <input type="file" name="file" class="form-control" required style="border-radius: 6px;">
                                </div>

                                <button type="submit" class="btn btn-primary w-100 mt-2" style="color: white; border-radius: 6px;">
                                    <i class="fa fa-upload mr-1"></i> Upload Items
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Scripts --}}
@push('scripts')
<script>
    $(document).ready(function() {
        // Show/Hide Fields based on Item Type
        $('#itemType').on('change', function() {
            const type = $(this).val();
            $('#mcqFields, #rrqFields, #erqFields, #total_marks').hide();

            if (type === 'MCQ') {
                $('#mcqFields').fadeIn(200);
                $('#stimulus').show();
            } else if (type === 'RRQ') {
                $('#rrqFields').fadeIn(200);
                $('#stimulus').fadeIn(200);
                $('#total_marks').fadeIn(200);
            } else if (type === 'ERQ') {
                $('#erqFields').fadeIn(200);
                $('#stimulus').hide();
                $('#total_marks').fadeIn(200);
            }
        }).trigger('change');

        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true
        });
    });
</script>
@endpush
@endsection
