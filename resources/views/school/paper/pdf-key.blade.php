<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            margin: 30px;
            line-height: 1.6;
        }

        h2,
        h4 {
            text-align: center;
            margin: 2px 0;
        }

        .meta {
            margin-bottom: 10px;
            font-size: 13px;
        }

        hr {
            border: 0.5px solid #555;
            margin: 10px 0;
        }

        .section-title {
            font-weight: bold;
            font-size: 15px;
            text-transform: uppercase;
            margin-top: 20px;
            margin-bottom: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 5px;
        }

        th,
        td {
            border: 1px solid #777;
            padding: 6px;
            text-align: left;
        }

        th {
            background: #f2f2f2;
            font-weight: bold;
        }

        .no-data {
            text-align: center;
            color: #999;
            font-style: italic;
        }
    </style>
</head>

<body>

    <h2><strong>{{ Auth::user()->school_name }}</strong></h2>
    <h2><strong>School Based Assessment (SBA)</strong></h2>
    <h4>Answer Key</h4>

    <div class="meta">
        <strong>Grade:</strong> {{ $grade }} &nbsp;&nbsp;
        <strong>Subject:</strong> {{ $subject }} &nbsp;&nbsp;
        <strong>Paper Type:</strong> {{ $type }} &nbsp;&nbsp;
        <strong>Month:</strong> {{ $month }}
        <br>
        <strong>Total Marks:</strong> {{ $items->sum('total_marks') ?? '-' }}
    </div>
    <hr>

    {{-- SECTION A: MCQs --}}
    @php $mcqs = $items->where('item_type', 'MCQ'); @endphp
    <div class="section-title">Section A – Multiple Choice Questions (MCQs)</div>
    @if ($mcqs->count())
        <table>
            <thead>
                <tr>
                    <th style="width: 10%">Q#</th>
                    <th style="width: 70%">Correct Option</th>
                    <th style="width: 20%">Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($mcqs as $index => $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ strtoupper($item->correct_answer ?? '-') }}</td>
                        <td>{{ $item->total_marks ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">No MCQs found.</p>
    @endif

    {{-- SECTION B: RRQs --}}
    @php $rrqs = $items->where('item_type', 'RRQ'); @endphp
    <div class="section-title">Section B – Short Response Questions (RRQs)</div>
    @if ($rrqs->count())
        <table>
            <thead>
                <tr>
                    <th style="width: 10%">Q#</th>
                    <th style="width: 70%">Expected Answer</th>
                    <th style="width: 20%">Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($rrqs as $index => $item)
                    <tr>
                        <td>{{ $mcqs->count() + $loop->iteration }}</td>
                        <td>{{ $item->possible_answers ?? '-' }}</td>
                        <td>{{ $item->total_marks ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">No RRQs found.</p>
    @endif

    {{-- SECTION C: ERQs --}}
    @php $erqs = $items->where('item_type', 'ERQ'); @endphp
    <div class="section-title">Section C – Extended Response Questions (ERQs)</div>
    @if ($erqs->count())
        <table>
            <thead>
                <tr>
                    <th style="width: 10%">Q#</th>
                    <th style="width: 70%">Rubric / Key Points</th>
                    <th style="width: 20%">Marks</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($erqs as $index => $item)
                    <tr>
                        <td>{{ $mcqs->count() + $rrqs->count() + $loop->iteration }}</td>
                        <td>{{ $item->rubric ?? '-' }}</td>
                        <td>{{ $item->total_marks ?? '-' }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="no-data">No ERQs found.</p>
    @endif

</body>

</html>
