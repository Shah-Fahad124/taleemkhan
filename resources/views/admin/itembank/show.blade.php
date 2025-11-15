@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="page-header p-2">
            <h4 class="page-title font-weight-bold">View Question</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('item-bank.index') }}" class="text-light-color">Item Bank</a></li>
                <li class="breadcrumb-item active" aria-current="page">Details</li>
            </ol>
        </div>

        <div class="card shadow-sm p-4">
            <div class="card-body">

                     <div class="row">
                    <div class="col-md-6"><strong>Subject:</strong> {{ $item_bank->subject->name }}</div>
                    <div class="col-md-6"><strong>Grade:</strong> {{ $item_bank->grade->name }}</div>
                    <div class="col-md-6"><strong>Item Type:</strong> {{ $item_bank->item_type }}</div>
                    <div class="col-md-6"><strong>Category:</strong> {{ $item_bank->category }}</div>
                    <div class="col-md-6"><strong>Difficulty:</strong> {{ $item_bank->difficulty }}</div>
                    <div class="col-md-6"><strong>Skill:</strong> {{ $item_bank->skill ?? '—' }}</div>
                </div>

                    <hr>


                <h5 class="font-weight-bold mb-3">{{ $item_bank->item_description ?? 'Untitled Question' }}</h5>

                @if ($item_bank->stimulus)
                    <p><strong>Stimulus:</strong> {{ $item_bank->stimulus }}</p>
                @endif



                {{-- MCQ Type --}}
                @if ($item_bank->item_type === 'MCQ')
                    <ul class="list-group mb-3">
                        <li class="list-group-item {{ $item_bank->correct_option == 'A' ? 'list-group-item-success' : '' }}">A) {{ $item_bank->option_a }}</li>
                        <li class="list-group-item {{ $item_bank->correct_option == 'B' ? 'list-group-item-success' : '' }}">B) {{ $item_bank->option_b }}</li>
                        <li class="list-group-item {{ $item_bank->correct_option == 'C' ? 'list-group-item-success' : '' }}">C) {{ $item_bank->option_c }}</li>
                        <li class="list-group-item {{ $item_bank->correct_option == 'D' ? 'list-group-item-success' : '' }}">D) {{ $item_bank->option_d }}</li>
                    </ul>
                    <p><strong>Correct Answer:</strong> Option {{ $item_bank->correct_answer }}</p>
                @endif

                {{-- RRQ Type --}}
                @if ($item_bank->item_type === 'RRQ')
                    <p><strong>Possible Answers:</strong></p>
                    <p>{{ $item_bank->possible_answers }}</p>
                    <p><strong>Marking Hints:</strong></p>
                    <p>{{ $item_bank->marking_hints }}</p>
                    <p><strong>Total Marks:</strong> {{ $item_bank->total_marks }}</p>
                @endif

                {{-- ERQ Type --}}
                @if ($item_bank->item_type === 'ERQ')
                    <p><strong>Rubric:</strong></p>
                    <p>{{ $item_bank->rubric }}</p>
                    <p><strong>Total Marks:</strong> {{ $item_bank->total_marks }}</p>
                @endif

                <hr>
                <div class="d-flex justify-content-between">
                    <a href="{{ route('item-bank.edit', $item_bank->id) }}" class="btn btn-primary">Edit</a>
                    <a href="{{ route('item-bank.index') }}" class="btn btn-secondary">Back to List</a>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
