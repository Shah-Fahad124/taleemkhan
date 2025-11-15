<div class="table-wrapper">
    <div class="table-container">
        <table class="modern-table">
            <thead>
                <tr>
                    <th class="serial">#</th>
                    <th class="student-name">Student Name</th>
                    <th class="father-name">Father Name</th>
                    <th class="gender">Gender</th>
                    <th class="class">Class</th>
                    <th class="section">Section</th>
                    <th class="bform">B-Form</th>
                    <th class="dob">Date of Birth</th>
                    <th class="actions">Actions</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($students as $index => $student)
                    <tr class="table-row">
                        <td class="serial">{{ $index + 1 }}</td>
                        <td class="student-name">
                            <div class="student-info">
                                <span class="name">{{ $student->full_name }}</span>
                            </div>
                        </td>
                        <td class="father-name">
                            <span class="text">{{ $student->father_name ?? '-' }}</span>
                        </td>
                        <td class="gender">
                            <span class="badge {{ $student->gender == 'Male' ? 'badge-male' : ($student->gender == 'Female' ? 'badge-female' : 'badge-default') }}">
                                {{ $student->gender ?? '-' }}
                            </span>
                        </td>
                        <td class="class">
                            <span class="text">{{ $student->grade->name ?? 'N/A' }}</span>
                        </td>
                        <td class="section">
                            <span class="text">{{ $student->section ?? '-' }}</span>
                        </td>
                        <td class="bform">
                            <span class="text">{{ $student->birth_certificate_number ?? '-' }}</span>
                        </td>
                        <td class="dob">
                            <span class="date">{{ $student->date_of_birth ? \Carbon\Carbon::parse($student->date_of_birth)->format('d M Y') : '-' }}</span>
                        </td>
                        <td class="actions">
                            <div class="action-buttons">
                                <a href="{{ route('school.students.show', $student->id) }}" class="btn-action btn-view" title="View Details">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('school.students.edit', $student->id) }}" class="btn-action btn-edit" title="Edit Student">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('school.students.destroy', $student->id) }}" method="POST" class="action-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action btn-delete"
                                            onclick="return confirm('Are you sure you want to delete this student?')"
                                            title="Delete Student">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr class="empty-row">
                        <td colspan="10">
                            <div class="empty-state">
                                <i class="fas fa-users empty-icon"></i>
                                <h3 class="empty-title">No Students Found</h3>
                                <p class="empty-message">No student records match your current filters.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($students->hasPages())
        <div class="table-footer">
            <div class="pagination-container">
                {{ $students->links() }}
            </div>
        </div>
    @endif
</div>

<style>
    /* Modern Table Design */
    .table-wrapper {
        background: white;
        border-radius: 12px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        border: 1px solid #f1f5f9;
    }

    .table-container {
        overflow-x: auto;
    }

    .modern-table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        min-width: 1000px;
    }

    .modern-table thead {
        background: linear-gradient(135deg, #f8fafc, #f1f5f9);
        border-bottom: 2px solid #e2e8f0;
    }

    .modern-table th {
        padding: 1rem 0.75rem;
        font-weight: 600;
        font-size: 0.875rem;
        color: #475569;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
        border: none;
        white-space: nowrap;
    }

    .modern-table .serial {
        width: 60px;
        text-align: center;
    }

    .modern-table .student-name {
        width: 180px;
    }

    .modern-table .father-name {
        width: 150px;
    }

    .modern-table .gender {
        width: 100px;
    }

    .modern-table .class {
        width: 120px;
    }

    .modern-table .section {
        width: 100px;
    }

    .modern-table .roll {
        width: 100px;
    }

    .modern-table .bform {
        width: 140px;
    }

    .modern-table .dob {
        width: 120px;
    }

    .modern-table .actions {
        width: 150px;
        text-align: center;
    }

    /* Table Rows */
    .table-row {
        border-bottom: 1px solid #f1f5f9;
        transition: all 0.2s ease;
    }

    .table-row:hover {
        background: #f8fafc;
        transform: translateY(-1px);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .modern-table td {
        padding: 1rem 0.75rem;
        border: none;
        font-size: 0.875rem;
        color: #475569;
        vertical-align: middle;
    }

    /* Student Info */
    .student-info {
        display: flex;
        align-items: center;
    }

    .student-info .name {
        font-weight: 500;
        color: #1e293b;
    }

    /* Badges */
    .badge {
        padding: 0.25rem 0.75rem;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .badge-male {
        background: #dbeafe;
        color: #1e40af;
        border: 1px solid #bfdbfe;
    }

    .badge-female {
        background: #fce7f3;
        color: #be185d;
        border: 1px solid #fbcfe8;
    }

    .badge-default {
        background: #f1f5f9;
        color: #64748b;
        border: 1px solid #e2e8f0;
    }

    /* Date Styling */
    .date {
        font-family: 'Courier New', monospace;
        font-size: 0.8rem;
        color: #64748b;
        background: #f8fafc;
        padding: 0.25rem 0.5rem;
        border-radius: 6px;
        border: 1px solid #f1f5f9;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 0.5rem;
    }

    .btn-action {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 36px;
        height: 36px;
        border: none;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.2s ease;
        cursor: pointer;
        font-size: 0.875rem;
    }

    .btn-view {
        background: #4984d1;
        color: #1d4ed8;
    }

    .btn-view:hover {
        background: #3b82f6;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);
    }

    .btn-edit {
        background: #c5b05c;
        color: #d97706;
    }

    .btn-edit:hover {
        background: #f59e0b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
    }

    .btn-delete {
        background: #d46363;
        color: #dc2626;
    }

    .btn-delete:hover {
        background: #ef4444;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
    }

    .action-form {
        margin: 0;
        display: inline;
    }

    /* Empty State */
    .empty-row td {
        padding: 0;
    }

    .empty-state {
        padding: 3rem 2rem;
        text-align: center;
        background: #f8fafc;
    }

    .empty-icon {
        font-size: 3rem;
        color: #cbd5e1;
        margin-bottom: 1rem;
    }

    .empty-title {
        font-size: 1.25rem;
        font-weight: 600;
        color: #64748b;
        margin: 0 0 0.5rem 0;
    }

    .empty-message {
        font-size: 0.875rem;
        color: #94a3b8;
        margin: 0;
    }

    /* Table Footer */
    .table-footer {
        padding: 1.5rem;
        border-top: 1px solid #f1f5f9;
        background: #f8fafc;
    }

    .pagination-container {
        display: flex;
        justify-content: center;
    }

    /* Pagination Styling */
    .pagination {
        display: flex;
        gap: 0.5rem;
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        display: inline-block;
    }

    .pagination a, .pagination span {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 40px;
        height: 40px;
        padding: 0 0.75rem;
        border: 1px solid #e2e8f0;
        border-radius: 8px;
        text-decoration: none;
        font-size: 0.875rem;
        font-weight: 500;
        color: #475569;
        background: white;
        transition: all 0.2s ease;
    }

    .pagination a:hover {
        background: #3C3B3F;
        color: white;
        border-color: #3C3B3F;
        transform: translateY(-1px);
    }

    .pagination .active span {
        background: #3C3B3F;
        color: white;
        border-color: #3C3B3F;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .table-wrapper {
            margin: 0 -1rem;
            border-radius: 0;
            border-left: none;
            border-right: none;
        }

        .modern-table th,
        .modern-table td {
            padding: 0.75rem 0.5rem;
            font-size: 0.8rem;
        }

        .action-buttons {
            gap: 0.25rem;
        }

        .btn-action {
            width: 32px;
            height: 32px;
            font-size: 0.8rem;
        }

        .empty-state {
            padding: 2rem 1rem;
        }

        .empty-icon {
            font-size: 2.5rem;
        }
    }
</style>
