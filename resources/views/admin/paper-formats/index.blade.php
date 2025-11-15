@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">

            <!-- Header -->
            <div class="page-header p-2 d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="page-title font-weight-bold mb-1">Paper Formats</h4>
                    <small class="" style="color: white">List of all paper format structures</small>
                </div>
                <a href="{{ route('paper-formats.create') }}" class="btn btn-sm btn-secondary">
                    Add New Format
                </a>
            </div>

            <!-- Table -->
            <div class="card shadow-sm mt-3">
                <div class="card-body table-responsive">
                    <table class="table table-bordered table-striped text-center align-middle">
                        <thead class="bg-light">
                            <tr>
                                <th>#</th>
                                <th>Type</th>
                                <th>Version</th>
                                <th colspan="3">MCQs</th>
                                <th colspan="3">Blanks (FIB)</th>
                                <th colspan="3">RRQs</th>
                                <th colspan="3">ERQs</th>
                                <th>Total</th>
                                <th>Action</th>
                            </tr>
                            <tr class="small bg-light text-muted">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th>Easy</th>
                                <th>Med</th>
                                <th>Hard</th>
                                <th>Easy</th>
                                <th>Med</th>
                                <th>Hard</th>
                                <th>Easy</th>
                                <th>Med</th>
                                <th>Hard</th>
                                <th>Easy</th>
                                <th>Med</th>
                                <th>Hard</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($formats as $index => $format)
                                @php
                                    $mcqTotal = $format->mcq_easy + $format->mcq_medium + $format->mcq_hard;
                                    $fibTotal = $format->fib_easy + $format->fib_medium + $format->fib_hard;
                                    $rrqTotal = $format->rrq_easy + $format->rrq_medium + $format->rrq_hard;
                                    $erqTotal = $format->erq_easy + $format->erq_medium + $format->erq_hard;
                                    $overallTotal = $mcqTotal + $fibTotal + $rrqTotal + $erqTotal;
                                @endphp
                                <tr>
                                    <td>{{ $formats->firstItem() + $index }}</td>
                                    <td class="text-capitalize">{{ $format->paper_type }}</td>
                                    <td><span class="badge badge-info">v{{ $format->version }}</span></td>

                                    <!-- MCQs -->
                                    <td>{{ $format->mcq_easy }}</td>
                                    <td>{{ $format->mcq_medium }}</td>
                                    <td>{{ $format->mcq_hard }}</td>

                                    <!-- FIB -->
                                    <td>{{ $format->fib_easy }}</td>
                                    <td>{{ $format->fib_medium }}</td>
                                    <td>{{ $format->fib_hard }}</td>

                                    <!-- RRQ -->
                                    <td>{{ $format->rrq_easy }}</td>
                                    <td>{{ $format->rrq_medium }}</td>
                                    <td>{{ $format->rrq_hard }}</td>

                                    <!-- ERQ -->
                                    <td>{{ $format->erq_easy }}</td>
                                    <td>{{ $format->erq_medium }}</td>
                                    <td>{{ $format->erq_hard }}</td>

                                    <!-- Totals -->
                                    <td class="font-weight-bold">{{ $overallTotal }}</td>

                                    <td>
                                        <button class="btn btn-sm btn-success"
                                            onclick="openEditModal({{ $format->toJson() }})">
                                            <i class="fa fa-edit"></i>
                                        </button>

                                        <form action="{{ route('paper-formats.destroy', $format->id) }}" method="POST"
                                            style="display:inline;"
                                            onsubmit="return confirm('Are you sure you want to delete this format?');">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="17" class="text-center text-muted">No paper formats found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $formats->links() }}
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <form id="editForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="modal-header bg-primary text-white">
                        <h5 class="modal-title">Edit Paper Format</h5>
                        <button type="button" class="close text-white" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><strong>Paper Type</strong></label>
                            <select name="paper_type" class="form-control" required>
                                <option value="formative">Formative</option>
                                <option value="semester">Semester</option>
                            </select>
                        </div>
                        <hr>
                        <h6 class="font-weight-bold">Questions Distribution</h6>
                        <div class="table-responsive">
                            <table class="table table-bordered text-center">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Type</th>
                                        <th>Easy</th>
                                        <th>Medium</th>
                                        <th>Hard</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach (['mcq', 'fib', 'rrq', 'erq'] as $key)
                                        <tr>
                                            <td><strong>{{ strtoupper($key) }}</strong></td>
                                            <td><input type="number" class="form-control" name="{{ $key }}_easy">
                                            </td>
                                            <td><input type="number" class="form-control"
                                                    name="{{ $key }}_medium"></td>
                                            <td><input type="number" class="form-control" name="{{ $key }}_hard">
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Append modal to body and populate data dynamically
        document.addEventListener('DOMContentLoaded', () => {
            const modal = document.getElementById('editModal');
            document.body.appendChild(modal); // ensure it's at end of body
        });

        // Populate and open modal
        function openEditModal(format) {
            const form = document.getElementById('editForm');
            form.action = `paper-formats/${format.id}`;
            form.querySelector('[name="paper_type"]').value = format.paper_type;

            ['mcq', 'fib', 'rrq', 'erq'].forEach(type => {
                ['easy', 'medium', 'hard'].forEach(level => {
                    const input = form.querySelector(`[name="${type}_${level}"]`);
                    input.value = format[`${type}_${level}`] ?? 0;
                });
            });

            $('#editModal').modal('show');
        }
    </script>
@endpush
