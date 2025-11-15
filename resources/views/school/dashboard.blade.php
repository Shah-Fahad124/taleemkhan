@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        {{-- ======= STYLESHEET ======= --}}
    <link rel="stylesheet" href="{{ asset('assets/css/school-dashboard.css') }}">

        {{-- ======= HEADER BAR ======= --}}
        <div class="dashboard-header">
            <div class="header-content">
                <div class="header-main">
                    <h1 class="page-title">School Dashboard</h1>
                    <p class="page-subtitle text-capitalize">overview of fee management and student records</p>
                    <div class="current-month-badge">
                        Currently Viewing Record: <strong id="currentMonthDisplay">{{ $selectedMonth }}</strong>
                    </div>
                </div>
                     <div class="stat-item">
                        <div class="stat-icon total">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number" id="totalStudents">{{ number_format($totalSchoolStudents ?? 0) }}</h3>
                            <span class="stat-label">Total Students</span>
                        </div>
                    </div>

                <div class="month-selector">
                    <select id="monthSelector" class="select2">
                        @foreach(['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'] as $month)
                            <option value="{{ $month }}" {{ $selectedMonth == $month ? 'selected' : '' }}>{{ $month }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="header-stats">
                    <div class="stat-item">
                        <div class="stat-icon paid">
                            <i class="fas fa-check-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number" id="totalPaid">{{ number_format($overall['paid'] ?? 0) }}</h3>
                            <span class="stat-label">Paid</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon partial">
                            <i class="fas fa-clock"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number" id="totalPartial">{{ number_format($overall['partial'] ?? 0) }}</h3>
                            <span class="stat-label">Partial</span>
                        </div>
                    </div>
                    <div class="stat-item">
                        <div class="stat-icon unpaid">
                            <i class="fas fa-exclamation-circle"></i>
                        </div>
                        <div class="stat-info">
                            <h3 class="stat-number" id="totalUnpaid">{{ number_format($overall['unpaid'] ?? 0) }}</h3>
                            <span class="stat-label">Unpaid</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ======= GRADE CARDS ======= --}}
        <div class="cards-section">
            <div id="gradeCardsContainer">
                @if (!empty($gradeStats) && count($gradeStats) > 0)
                    <div class="cards-grid">
                        @foreach ($gradeStats as $stat)
                            <a href="{{ route('fees.index', ['class_id' => $stat['id'] ?? '']) }}" class="card-link">
                                <div class="grade-card">
                                    <div class="card-header">
                                        <h3 class="grade-name">{{ $stat['grade'] ?? 'N/A' }}</h3>
                                        <div class="total-students">
                                            <i class="fas fa-users"></i>
                                            {{ $stat['total_students'] ?? 0 }} Students
                                        </div>
                                    </div>
                                    <div class="card-stats">
                                        <div class="stat paid">
                                            <span class="stat-value">{{ number_format($stat['paid'] ?? 0) }}</span>
                                            <span class="card-stat-label">Paid</span>
                                        </div>
                                        <div class="stat partial">
                                            <span class="stat-value">{{ number_format($stat['partial'] ?? 0) }}</span>
                                            <span class="card-stat-label">Partial</span>
                                        </div>
                                        <div class="stat unpaid">
                                            <span class="stat-value">{{ number_format($stat['unpaid'] ?? 0) }}</span>
                                            <span class="card-stat-label">Unpaid</span>
                                        </div>
                                    </div>
                                    <div class="card-progress">
                                        @php
                                            $total = ($stat['paid'] ?? 0) + ($stat['partial'] ?? 0) + ($stat['unpaid'] ?? 0);
                                            $paidPercentage = $total > 0 ? (($stat['paid'] ?? 0) / $total) * 100 : 0;
                                        @endphp
                                        <div class="progress-bar">
                                            <div class="progress-fill" style="width: {{ $paidPercentage }}%"></div>
                                        </div>
                                        <span class="progress-text">{{ number_format($paidPercentage, 1) }}% Paid</span>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="empty-state">
                        <div class="empty-icon">
                            <i class="fas fa-chart-pie"></i>
                        </div>
                        <h3 class="empty-title">No Grade Data Available</h3>
                        <p class="empty-message">Fee statistics by grade will appear here once data is available.</p>
                        <a href="{{ route('fees.index') }}" class="btn-primary">
                            <i class="fas fa-money-bill-wave"></i>
                            Manage Fees
                        </a>
                    </div>
                @endif
            </div>
        </div>

        {{-- ======= CHARTS SECTION ======= --}}
        @if (!empty($gradeStats) && count($gradeStats) > 0)
            <div class="charts-section">
                <div class="charts-grid">
                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Fee Summary by Grade ({{ $selectedMonth ?? 'All Months' }})</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="barChart"></canvas>
                        </div>
                    </div>

                    <div class="chart-card">
                        <div class="chart-header">
                            <h3 class="chart-title">Overall Fee Distribution</h3>
                        </div>
                        <div class="chart-container">
                            <canvas id="pieChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        {{-- ======= ANALYTICS TABLES ======= --}}
        <div class="tables-section">
            <div class="tables-grid">
                {{-- Top Defaulters --}}
                <div class="table-card">
                    <div class="table-header danger">
                        <div class="table-title">
                            <i class="fas fa-exclamation-circle"></i>
                            <h3>Top 5 Defaulters</h3>
                        </div>
                        <span class="badge danger" id="defaultersCount">{{ count($topDefaulters ?? []) }}</span>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Due Amount</th>
                                </tr>
                            </thead>
                            <tbody id="defaultersTable">
                                @forelse($topDefaulters ?? [] as $defaulter)
                                    <tr>
                                        <td class="student-cell">
                                            <div class="student-info">
                                                <span class="student-name">{{ $defaulter->student->full_name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $defaulter->class->name ?? '-' }}</td>
                                        <td class="amount due">{{ number_format($defaulter->due_amount ?? 0) }}</td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="3">
                                            <div class="empty-table">
                                                <i class="fas fa-check-circle"></i>
                                                <span>No defaulters found</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Recent Payments --}}
                <div class="table-card">
                    <div class="table-header success">
                        <div class="table-title">
                            <i class="fas fa-money-bill-wave"></i>
                            <h3>Recent Payments</h3>
                        </div>
                        <span class="badge success" id="paymentsCount">{{ count($recentPayments ?? []) }}</span>
                    </div>
                    <div class="table-container">
                        <table class="data-table">
                            <thead>
                                <tr>
                                    <th>Student</th>
                                    <th>Class</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody id="paymentsTable">
                                @forelse($recentPayments ?? [] as $payment)
                                    <tr>
                                        <td class="student-cell">
                                            <div class="student-info">
                                                <span class="student-name">{{ $payment->student->full_name ?? 'N/A' }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $payment->class->name ?? '-' }}</td>
                                        <td class="amount paid">{{ number_format($payment->paid_amount ?? 0) }}</td>
                                        <td class="date">
                                            {{ \Carbon\Carbon::parse($payment->payment_date ?? now())->format('d M') }}
                                        </td>
                                    </tr>
                                @empty
                                    <tr class="empty-row">
                                        <td colspan="4">
                                            <div class="empty-table">
                                                <i class="fas fa-receipt"></i>
                                                <span>No recent payments</span>
                                            </div>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
let barChart, pieChart;

document.addEventListener('DOMContentLoaded', function() {
    initializeCharts();

    // Month selector change event
    $('#monthSelector').on('change', function() {
        const selectedMonth = $(this).val();
        loadMonthData(selectedMonth);
    });

    function initializeCharts() {
        // Bar Chart
        const barCtx = document.getElementById('barChart');
        if (barCtx) {
            barChart = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: @json(array_column($gradeStats ?? [], 'grade')),
                    datasets: [
                        { label: 'Paid', backgroundColor: '#10b981', data: @json(array_column($gradeStats ?? [], 'paid')), borderRadius: 4 },
                        { label: 'Partial', backgroundColor: '#f59e0b', data: @json(array_column($gradeStats ?? [], 'partial')), borderRadius: 4 },
                        { label: 'Unpaid', backgroundColor: '#ef4444', data: @json(array_column($gradeStats ?? [], 'unpaid')), borderRadius: 4 }
                    ]
                },
                options: {
                    responsive: true,
                    plugins: { legend: { position: 'top' } },
                    scales: {
                        y: {
                            beginAtZero: true,
                            ticks: { callback: function(value) { return value.toLocaleString(); } }
                        }
                    }
                }
            });
        }

        // Pie Chart
        const pieCtx = document.getElementById('pieChart');
        if (pieCtx) {
            pieChart = new Chart(pieCtx, {
                type: 'doughnut',
                data: {
                    labels: ['Paid', 'Partial', 'Unpaid'],
                    datasets: [{
                        data: [{{ $overall['paid'] ?? 0 }}, {{ $overall['partial'] ?? 0 }}, {{ $overall['unpaid'] ?? 0 }}],
                        backgroundColor: ['#10b981', '#f59e0b', '#ef4444'],
                        borderWidth: 0
                    }]
                },
                options: {
                    responsive: true,
                    cutout: '70%',
                    plugins: { legend: { position: 'bottom' } }
                }
            });
        }
    }

    function loadMonthData(month) {
        // Show loading state
        showLoadingState();

        $.ajax({
            url: "{{ route('school.dashboard') }}",
            type: 'GET',
            data: { month: month },
            success: function(response) {
                if (response.success) {
                    updateDashboard(response.data);
                }
            },
            error: function(xhr) {
                console.error('Error loading month data:', xhr);
                hideLoadingState();
                alert('Error loading data for selected month. Please try again.');
            }
        });
    }

    function showLoadingState() {
        $('body').append(`
            <div class="loading-overlay" id="globalLoading">
                <div class="loading-spinner"></div>
            </div>
        `);
    }

    function hideLoadingState() {
        $('#globalLoading').remove();
    }

    function updateDashboard(data) {
        // Update header stats
        $('#totalStudents').text(data.totalSchoolStudents.toLocaleString());
        $('#totalPaid').text(data.overall.paid.toLocaleString());
        $('#totalPartial').text(data.overall.partial.toLocaleString());
        $('#totalUnpaid').text(data.overall.unpaid.toLocaleString());
        $('#currentMonthDisplay').text(data.selectedMonth);

        // Update grade cards
        updateGradeCards(data.gradeStats);

        // Update tables
        updateDefaultersTable(data.topDefaulters);
        updatePaymentsTable(data.recentPayments);

        // Update charts
        updateCharts(data.gradeStats, data.overall);

        hideLoadingState();
    }

    function updateGradeCards(gradeStats) {
        const container = $('#gradeCardsContainer');

        if (gradeStats.length > 0) {
            let html = '<div class="cards-grid">';

            gradeStats.forEach(stat => {
                const total = stat.paid + stat.partial + stat.unpaid;
                const paidPercentage = total > 0 ? (stat.paid / total) * 100 : 0;

                html += `
                    <a href="{{ route('fees.index') }}?class_id=${stat.id}" class="card-link">
                        <div class="grade-card">
                            <div class="card-header">
                                <h3 class="grade-name">${stat.grade}</h3>
                                <div class="total-students">
                                    <i class="fas fa-users"></i>
                                    ${stat.total_students} Students
                                </div>
                            </div>
                            <div class="card-stats">
                                <div class="stat paid">
                                    <span class="stat-value">${stat.paid.toLocaleString()}</span>
                                    <span class="card-stat-label">Paid</span>
                                </div>
                                <div class="stat partial">
                                    <span class="stat-value">${stat.partial.toLocaleString()}</span>
                                    <span class="card-stat-label">Partial</span>
                                </div>
                                <div class="stat unpaid">
                                    <span class="stat-value">${stat.unpaid.toLocaleString()}</span>
                                    <span class="card-stat-label">Unpaid</span>
                                </div>
                            </div>
                            <div class="card-progress">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: ${paidPercentage}%"></div>
                                </div>
                                <span class="progress-text">${paidPercentage.toFixed(1)}% Paid</span>
                            </div>
                        </div>
                    </a>
                `;
            });

            html += '</div>';
            container.html(html);
        } else {
            container.html(`
                <div class="empty-state">
                    <div class="empty-icon">
                        <i class="fas fa-chart-pie"></i>
                    </div>
                    <h3 class="empty-title">No Grade Data Available</h3>
                    <p class="empty-message">Fee statistics by grade will appear here once data is available.</p>
                    <a href="{{ route('fees.index') }}" class="btn-primary">
                        <i class="fas fa-money-bill-wave"></i>
                        Manage Fees
                    </a>
                </div>
            `);
        }
    }

    function updateDefaultersTable(defaulters) {
        const tableBody = $('#defaultersTable');
        const countBadge = $('#defaultersCount');

        countBadge.text(defaulters.length);

        if (defaulters.length > 0) {
            let html = '';
            defaulters.forEach(defaulter => {
                html += `
                    <tr>
                        <td class="student-cell">
                            <div class="student-info">
                                <span class="student-name">${defaulter.student?.full_name || 'N/A'}</span>
                            </div>
                        </td>
                        <td>${defaulter.class?.name || '-'}</td>
                        <td class="amount due">${(defaulter.due_amount || 0).toLocaleString()}</td>
                    </tr>
                `;
            });
            tableBody.html(html);
        } else {
            tableBody.html(`
                <tr class="empty-row">
                    <td colspan="3">
                        <div class="empty-table">
                            <i class="fas fa-check-circle"></i>
                            <span>No defaulters found</span>
                        </div>
                    </td>
                </tr>
            `);
        }
    }

    function updatePaymentsTable(payments) {
        const tableBody = $('#paymentsTable');
        const countBadge = $('#paymentsCount');

        countBadge.text(payments.length);

        if (payments.length > 0) {
            let html = '';
            payments.forEach(payment => {
                const paymentDate = new Date(payment.payment_date).toLocaleDateString('en-GB', {
                    day: '2-digit', month: 'short'
                });

                html += `
                    <tr>
                        <td class="student-cell">
                            <div class="student-info">
                                <span class="student-name">${payment.student?.full_name || 'N/A'}</span>
                            </div>
                        </td>
                        <td>${payment.class?.name || '-'}</td>
                        <td class="amount paid">${(payment.paid_amount || 0).toLocaleString()}</td>
                        <td class="date">${paymentDate}</td>
                    </tr>
                `;
            });
            tableBody.html(html);
        } else {
            tableBody.html(`
                <tr class="empty-row">
                    <td colspan="4">
                        <div class="empty-table">
                            <i class="fas fa-receipt"></i>
                            <span>No recent payments</span>
                        </div>
                    </td>
                </tr>
            `);
        }
    }

    function updateCharts(gradeStats, overall) {
        // Update Bar Chart
        if (barChart) {
            barChart.data.labels = gradeStats.map(stat => stat.grade);
            barChart.data.datasets[0].data = gradeStats.map(stat => stat.paid);
            barChart.data.datasets[1].data = gradeStats.map(stat => stat.partial);
            barChart.data.datasets[2].data = gradeStats.map(stat => stat.unpaid);
            barChart.update();
        }

        // Update Pie Chart
        if (pieChart) {
            pieChart.data.datasets[0].data = [overall.paid, overall.partial, overall.unpaid];
            pieChart.update();
        }
    }
});

        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                width: '100%',
                placeholder: 'Select option',
                allowClear: true,
            });
        });
</script>
@endpush
