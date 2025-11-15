@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="page-header p-2">
            <h4 class="page-title font-weight-bold">Subject Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Subjects</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">All Subjects</h4>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addSubjectModal" style="width: 8rem !important">
                    Add Subject
                </button>
            </div>

            <div class="card-body">
                <!-- Table -->
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Description</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($subjects as $index => $subject)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $subject->name }}</td>
                                    <td>{{ $subject->code ?? '-' }}</td>
                                    <td>{{ $subject->description ?? '-' }}</td>
                                    <td>{{ $subject->created_at->format('d M Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary editBtn"
                                            data-id="{{ $subject->id }}"
                                            data-name="{{ $subject->name }}"
                                            data-code="{{ $subject->code }}"
                                            data-description="{{ $subject->description }}">
                                            Edit
                                        </button>
                                        <form action="{{ route('subjects.destroy', $subject->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this subject?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6">No subjects found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $subjects->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add Modal -->
<div class="modal fade" id="addSubjectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('subjects.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Subject</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Subject Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Subject Code (Optional)</label>
                        <input type="text" name="code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description (Optional)</label>
                        <textarea name="description" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editSubjectModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editSubjectForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Subject</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label>Subject Name</label>
                        <input type="text" id="editName" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label>Subject Code</label>
                        <input type="text" id="editCode" name="code" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea id="editDescription" name="description" class="form-control" rows="2"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Save Changes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.querySelectorAll('.editBtn').forEach(button => {
    button.addEventListener('click', function() {
        const id = this.dataset.id;
        document.getElementById('editName').value = this.dataset.name;
        document.getElementById('editCode').value = this.dataset.code || '';
        document.getElementById('editDescription').value = this.dataset.description || '';
        document.getElementById('editSubjectForm').action = `/admin/subjects/${id}`;
        $('#editSubjectModal').modal('show');
    });
});
</script>
@endsection
