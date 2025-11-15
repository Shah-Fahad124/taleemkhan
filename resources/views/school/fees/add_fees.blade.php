@extends('layouts.app')

@section('content')
    <div class="app-content">
        <section class="section">
            <div class="card shadow-sm">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="mb-0">Add Monthly Fees</h4>
                </div>

                <div class="card-body">
                    <form id="add-fees-form" action="{{ route('fees.store') }}" method="POST">
                        @csrf

                        <div class="row mb-4">
                            <div class="col-md-4">
                                <label class="form-label">Select Class</label>
                                <select name="class_id" id="class_id" class="form-control select2" required>
                                    <option value="">Select Class</option>
                                    @foreach ($classes as $class)
                                        <option value="{{ $class->id }}">{{ $class->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Month</label>
                                <select name="month" class="form-control select2" required>
                                    <option value="">Select Month</option>
                                    @foreach (['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                                        <option value="{{ $month }}">{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label class="form-label">Year</label>
                                <input type="number" name="year" class="form-control" value="{{ date('Y') }}">
                            </div>
                        </div>

                        <hr>
                        <div class="table-responsive">
                            <table class="table table-bordered align-middle" id="studentsTable">
                                <thead class="bg-light">
                                    <tr>
                                        <th>Student Name</th>
                                        <th>Total Fee</th>
                                        <th>Discount</th>
                                        <th>Paid</th>
                                        <th>Due</th>
                                        <th>Status</th>
                                        <th>Remarks</th>
                                    </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>

                        <div class="text-end mt-3">
                            <button type="submit" class="btn btn-primary px-4">Save Fees</button>
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
            $('.select2').select2({
                width: '100%'
            });

            // Function to apply row colors based on status
            function applyRowColor(row, status) {
                row.removeClass('table-success table-warning table-danger');
                if (status === 'Paid') {
                    row.addClass('table-success'); // Green
                } else if (status === 'Partial') {
                    row.addClass('table-warning'); // Yellow
                } else {
                    row.addClass('table-danger'); // Red
                }
            }

            // Fetch Students + Existing Fees
            $('#class_id, [name="month"], [name="year"]').change(function() {
                const classId = $('#class_id').val();
                const month = $('[name="month"]').val();
                const year = $('[name="year"]').val();

                if (!classId || !month || !year) return;

                $.post('{{ route('fees.fetch') }}', {
                    _token: '{{ csrf_token() }}',
                    class_id: classId,
                    month: month,
                    year: year
                }, function(response) {
                    const {
                        students
                    } = response;
                    const tbody = $('#studentsTable tbody');
                    tbody.empty();

                    students.forEach(student => {
                        const f = student.fee;

                        const row = $(`
                    <tr>
                        <td>
                            <input type="hidden" name="records[${student.id}][student_id]" value="${student.id}">
                            <input type="hidden" name="records[${student.id}][class_id]" value="${classId}">
                            ${student.full_name}
                        </td>
                        <td><input type="number" name="records[${student.id}][total_fee]" class="form-control total" value="${f.total_fee}" readonly></td>
                        <td><input type="number" name="records[${student.id}][discount]" class="form-control discount" value="${f.discount}"></td>
                        <td><input type="number" name="records[${student.id}][paid_amount]" class="form-control paid" value="${f.paid_amount}"></td>
                        <td><input type="number" name="records[${student.id}][due_amount]" class="form-control due" value="${f.due_amount}" readonly></td>
                        <td><input type="text" name="records[${student.id}][status]" class="form-control status" value="${f.status}" readonly></td>
                        <td><input type="text" name="records[${student.id}][remarks]" class="form-control" value="${f.remarks}" placeholder="Optional"></td>
                    </tr>
                `);

                        // Apply color based on existing status
                        applyRowColor(row, f.status);
                        tbody.append(row);
                    });
                });
            });

            // Dynamic discount & paid recalculation
            $('#studentsTable').on('input', '.discount, .paid', function() {
                const row = $(this).closest('tr');
                const total = parseFloat(row.find('.total').val()) || 0;
                const discount = parseFloat(row.find('.discount').val()) || 0;
                const paid = parseFloat(row.find('.paid').val()) || 0;

                // Correct calculation logic
                // adjustedTotal = total - discount
                const adjustedTotal = Math.max(0, total - discount);

                // Paid should never exceed adjustedTotal
                const adjustedPaid = Math.min(paid, adjustedTotal);
                const due = Math.max(0, adjustedTotal - adjustedPaid);

                row.find('.due').val(due);
                const status = (due <= 0) ? 'Paid' : (adjustedPaid > 0 ? 'Partial' : 'Unpaid');
                row.find('.status').val(status);

                // Update row color
                applyRowColor(row, status);
            });
        });


        // Initialize Select2
        $('.select2').select2({
            width: '100%',
            placeholder: 'Select an option',
            allowClear: true
        });
    </script>
@endpush
