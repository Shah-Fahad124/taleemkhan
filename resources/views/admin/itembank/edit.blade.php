@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="page-header p-2">
            <h4 class="page-title font-weight-bold">Edit Item / Question</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light-color">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('item-bank.index') }}">Item Bank</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('item-bank.update', $item->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">

                        {{-- SLO --}}
                        <div class="col-md-12 mb-3">
                            <label>SLO</label>
                            <input type="text" name="slo" class="form-control" value="{{ old('slo', $item->slo) }}">
                        </div>

                        {{-- SLO No --}}
                        <div class="col-md-4 mb-3">
                            <label>SLO No.</label>
                            <input type="text" name="slo_no" class="form-control" value="{{ old('slo_no', $item->slo_no) }}">
                        </div>

                        {{-- Subject --}}
                        <div class="col-md-4 mb-3">
                            <label>Subject</label>
                            <select name="subject_id" class="form-control select2">
                                @foreach ($subjects as $subject)
                                    <option value="{{ $subject->id }}" {{ $item->subject_id == $subject->id ? 'selected' : '' }}>
                                        {{ $subject->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Grade --}}
                        <div class="col-md-4 mb-3">
                            <label>Grade</label>
                            <select name="grade_id" class="form-control select2">
                                @foreach ($grades as $grade)
                                    <option value="{{ $grade->id }}" {{ $item->grade_id == $grade->id ? 'selected' : '' }}>
                                        {{ $grade->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Semester & Month --}}
                        <div class="col-md-4 mb-3">
                            <label>Semester</label>
                            <select name="semester" class="form-control">
                                <option value="">Select</option>
                                <option value="Fall" {{ $item->semester == 'Fall' ? 'selected' : '' }}>Fall</option>
                                <option value="Spring" {{ $item->semester == 'Spring' ? 'selected' : '' }}>Spring</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Month</label>
                            <select name="month" class="form-control select2">
                                @foreach (['January','February','March','April','May','June','July','August','September','October','November','December'] as $m)
                                    <option value="{{ $m }}" {{ $item->month == $m ? 'selected' : '' }}>{{ $m }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- Difficulty / Category / Item Type --}}
                        <div class="col-md-4 mb-3">
                            <label>Difficulty</label>
                            <select name="difficulty" class="form-control">
                                <option value="">Select</option>
                                <option value="Easy" {{ $item->difficulty == 'Easy' ? 'selected' : '' }}>Easy</option>
                                <option value="Medium" {{ $item->difficulty == 'Medium' ? 'selected' : '' }}>Medium</option>
                                <option value="Hard" {{ $item->difficulty == 'Hard' ? 'selected' : '' }}>Hard</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Item Category</label>
                            <select name="item_category" class="form-control">
                                <option value="">Select</option>
                                <option value="Knowledge" {{ $item->item_category == 'Knowledge' ? 'selected' : '' }}>Knowledge</option>
                                <option value="Theoretical" {{ $item->item_category == 'Theoretical' ? 'selected' : '' }}>Theoretical</option>
                                <option value="Practical" {{ $item->item_category == 'Practical' ? 'selected' : '' }}>Practical</option>
                            </select>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label>Item Type</label>
                            <select id="itemType" name="item_type" class="form-control">
                                <option value="">Select</option>
                                <option value="MCQ" {{ $item->item_type == 'MCQ' ? 'selected' : '' }}>MCQ</option>
                                <option value="RRQ" {{ $item->item_type == 'RRQ' ? 'selected' : '' }}>RRQ</option>
                                <option value="ERQ" {{ $item->item_type == 'ERQ' ? 'selected' : '' }}>ERQ</option>
                            </select>
                        </div>

                        {{-- Skill --}}
                        <div class="col-md-4 mb-3">
                            <label>Skill</label>
                            <input type="text" name="skill" class="form-control" value="{{ old('skill', $item->skill) }}">
                        </div>

                        {{-- Item Description --}}
                        <div class="col-md-12 mb-3">
                            <label>Item Description / Stem</label>
                            <textarea name="question_text" class="form-control" rows="3">{{ old('question_text', $item->item_description) }}</textarea>
                        </div>

                        {{-- Stimulus --}}
                        <div id="stimulus" class="col-md-12 mb-3">
                            <label>Stimulus</label>
                            <textarea name="stimulus" class="form-control" rows="2">{{ old('stimulus', $item->stimulus) }}</textarea>
                        </div>

                        {{-- === MCQ Fields === --}}
                        <div id="mcqFields" class="w-100 row mx-2">
                            @foreach (['A', 'B', 'C', 'D'] as $opt)
                                <div class="col-md-6 mb-3">
                                    <label>Option {{ $opt }}</label>
                                    <input type="text" name="option_{{ strtolower($opt) }}" class="form-control"
                                           value="{{ old('option_' . strtolower($opt), $item->{'option_' . strtolower($opt)}) }}">
                                </div>
                            @endforeach

                            <div class="col-md-4 mb-3">
                                <label>Correct Answer</label>
                                <select name="correct_answer" class="form-control">
                                    <option value="">Select</option>
                                    @foreach (['A','B','C','D'] as $opt)
                                        <option value="{{ $opt }}" {{ $item->correct_answer == $opt ? 'selected' : '' }}>{{ $opt }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        {{-- === RRQ Fields === --}}
                        <div id="rrqFields" class="w-100" style="display:none;">
                            <div class="col-md-12 mb-3">
                                <label>Possible Answers</label>
                                <textarea name="possible_answers" class="form-control">{{ old('possible_answers', $item->possible_answers) }}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label>Marking Hints</label>
                                <textarea name="marking_hints" class="form-control">{{ old('marking_hints', $item->marking_hints) }}</textarea>
                            </div>
                        </div>

                        {{-- === ERQ Fields === --}}
                        <div id="erqFields" class="w-100" style="display:none;">
                            <div class="col-md-12 mb-3">
                                <label>Rubric</label>
                                <textarea name="rubric" class="form-control">{{ old('rubric', $item->rubric) }}</textarea>
                            </div>
                        </div>

                        {{-- Total Marks --}}
                        <div id="total_marks" class="col-md-4 mb-3">
                            <label>Total Marks</label>
                            <input type="number" name="total_marks" class="form-control" value="{{ old('total_marks', $item->total_marks) }}">
                        </div>
                    </div>

                    <div class="mt-4">
                        <button type="submit" class="btn btn-success">Update</button>
                        <a href="{{ route('item-bank.index') }}" class="btn btn-secondary">Cancel</a>
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
    const type = $('#itemType').val();
    showFields(type);

    $('#itemType').on('change', function() {
        showFields($(this).val());
    });

    function showFields(type) {
        $('#mcqFields, #rrqFields, #erqFields, #total_marks,#stimulus').hide();
        if (type === 'MCQ') $('#mcqFields,#stimulus').show();
        else if (type === 'RRQ') $('#rrqFields, #total_marks,#stimulus').show();
        else if (type === 'ERQ') $('#erqFields, #total_marks').show();
    }

    $('.select2').select2({ width: '100%' });
});
</script>
@endpush
