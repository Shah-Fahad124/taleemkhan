<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            margin: 10px;
            line-height: 1.5;
        }

        h2,
        h3,
        h4 {
            text-align: center;
            margin: 2px 0;
        }

        .meta {
            margin-bottom: 10px;
            font-size: 13px;
            text-align: center;
        }

        hr {
            border: 0.5px solid #555;
            margin: 10px 0;
        }

        .section-title {
            font-weight: bold;
            font-size: 15px;
            text-transform: uppercase;
            margin-top: 25px;
            margin-bottom: 5px;
        }

        .instructions {
            font-style: italic;
            color: #444;
            margin-bottom: 10px;
        }

        .question {
            margin-bottom: 10px;
            text-align: justify;
        }

        .marks {
            float: right;
            font-weight: bold;
            color: #333;
        }

        ol {
            margin-top: 5px;
            margin-left: 20px;
        }

        li {
            margin-bottom: 4px;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <h2>{{ Auth::user()->school_name }}</h2>
    <h2><strong>School Based Assessment (SBA)</strong></h2>

    <div class="meta">
        <strong>Grade:</strong> {{ $grade }} &nbsp;&nbsp;
        <strong>Subject:</strong> {{ $subject }} &nbsp;&nbsp;
        <strong>Paper Type:</strong> {{ ucfirst($paper_type) }} &nbsp;&nbsp;
        @if ($paper_type == 'formative')
            <strong>Month:</strong> {{ $month ?? '-' }}
        @else
            <strong>Semester:</strong> {{ strtoupper($semester ?? '-') }}
        @endif
        <br>
        <strong>Total Marks:</strong> {{ $items->sum('total_marks') ?? '-' }}
    </div>
    <hr>

    {{-- SECTION A: MCQs --}}
    @php $mcqs = $items->where('item_type', 'MCQ'); @endphp
    @if ($mcqs->count())
        <div class="section-title">Section A – Multiple Choice Questions (MCQs)</div>
        <div class="instructions">Choose the correct answer from the given options.</div>

        @foreach ($mcqs as $i => $item)
            <div class="question">
                <strong>Q{{ $loop->iteration }}.</strong> {{ $item->item_description }}
                @if ($item->total_marks)
                    <span class="marks">({{ $item->total_marks }} marks)</span>
                @endif
                <ol type="A">
                    <li>{{ $item->option_a }}</li>
                    <li>{{ $item->option_b }}</li>
                    <li>{{ $item->option_c }}</li>
                    <li>{{ $item->option_d }}</li>
                </ol>
            </div>
        @endforeach
    @endif

    {{-- SECTION B: RRQs --}}
    @php $rrqs = $items->where('item_type', 'RRQ'); @endphp
    @if ($rrqs->count())
        <div class="section-title">Section B – Short Response Questions (RRQs)</div>
        <div class="instructions">Answer any three of the following questions briefly.</div>

        @foreach ($rrqs as $i => $item)
            <div class="question">
                <strong>Q{{ $mcqs->count() + $loop->iteration }}.</strong> {{ $item->item_description }}
                @if ($item->total_marks)
                    <span class="marks">({{ $item->total_marks }} marks)</span>
                @endif
                @if ($item->possible_answers)
                    <p><em>Hint:</em> {{ $item->possible_answers }}</p>
                @endif
            </div>
        @endforeach
    @endif

    {{-- SECTION C: ERQs --}}
    @php $erqs = $items->where('item_type', 'ERQ'); @endphp
    @if ($erqs->count())
        <div class="section-title">Section C – Extended Response Questions (ERQs)</div>
        <div class="instructions">Attempt any two of the following in detail.</div>

        @foreach ($erqs as $i => $item)
            <div class="question">
                <strong>Q{{ $mcqs->count() + $rrqs->count() + $loop->iteration }}.</strong>
                {{ $item->item_description }}
                @if ($item->total_marks)
                    <span class="marks">({{ $item->total_marks }} marks)</span>
                @endif
                @if ($item->rubric)
                    <p><em>Guideline:</em> {{ $item->rubric }}</p>
                @endif
            </div>
        @endforeach
    @endif

</body>

</html>
