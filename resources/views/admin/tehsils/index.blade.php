@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="page-header p-2">
            <h4 class="page-title font-weight-bold">Tehsil Management</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Tehsils</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">All Tehsils</h4>
                <button class="btn btn-sm btn-primary" data-toggle="modal" data-target="#addTehsilModal" style="width: 8rem !important">
                    Add Tehsil
                </button>
            </div>

            <div class="card-body">

                {{-- Tehsils Table --}}
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Tehsil Name</th>
                                <th>District</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tehsils as $index => $tehsil)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $tehsil->name }}</td>
                                    <td>{{ $tehsil->district->name ?? 'N/A' }}</td>
                                    <td>{{ $tehsil->created_at->format('d M Y') }}</td>
                                    <td>
                                        <button class="btn btn-sm btn-primary editBtn"
                                            data-id="{{ $tehsil->id }}"
                                            data-name="{{ $tehsil->name }}"
                                            data-district="{{ $tehsil->district_id }}">
                                            Edit
                                        </button>

                                        <form action="{{ route('tehsils.destroy', $tehsil->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this tehsil?')">
                                                Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5">No tehsils found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $tehsils->links() }}
                </div>
            </div>
        </div>
    </section>
</div>

{{-- Add Tehsil Modal --}}
<div class="modal fade" id="addTehsilModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="{{ route('tehsils.store') }}">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title">Add Tehsil</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{-- Tehsil Name --}}
                    <div class="form-group">
                        <label>Tehsil Name</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    {{-- District --}}
                    <div class="form-group">
                        <label>Select District</label>
                        <select id="districtSelect" name="district_id" class="form-control" required>
                            <option value="">-- Select District --</option>
                            @foreach ($districts as $district)
                                <option value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
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

{{-- Edit Tehsil Modal --}}
<div class="modal fade" id="editTehsilModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form id="editTehsilForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-header">
                    <h5 class="modal-title">Edit Tehsil</h5>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    {{-- Tehsil Name --}}
                    <div class="form-group">
                        <label>Tehsil Name</label>
                        <input type="text" id="editName" name="name" class="form-control" required>
                    </div>

                    {{-- District --}}
                    <div class="form-group">
                        <label>Select District</label>
                        <select id="editDistrict" name="district_id" class="form-control" required>
                            <option value="">-- Select District --</option>
                            @foreach ($districts as $district)
                                <option  value="{{ $district->id }}">{{ $district->name }}</option>
                            @endforeach
                        </select>
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
        const name = this.dataset.name;
        const districtId = this.dataset.district;

        document.getElementById('editName').value = name;
        document.getElementById('editDistrict').value = districtId;

        document.getElementById('editTehsilForm').action = `/admin/tehsils/${id}`;
        $('#editTehsilModal').modal('show');
    });
});
</script>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Initialize Select2 only for District and Tehsil
    $('#districtSelect').select2({
        width: '100%',
        placeholder: 'Select an option',
        allowClear: true
    });

})
</script>
@endpush
