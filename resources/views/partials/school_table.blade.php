<table class="table table-bordered text-center">
    <thead class="thead-light">
        <tr>
            <th>#</th>
            <th>EMIS Code</th>
            <th>School Name</th>
            <th>District</th>
            <th>Tehsil</th>
            <th>Head Teacher</th>
            <th>Level</th>
            <th>Teachers</th>
            <th>Students</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($schools as $index => $school)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $school->emis_code }}</td>
                <td>{{ $school->school_name }}</td>
                <td>{{ $school->district->name ?? 'N/A' }}</td>
                <td>{{ $school->tehsil->name ?? 'N/A' }}</td>
                <td>{{ $school->head_teacher_name }}</td>
                <td>{{ $school->school_level }}</td>
                <td>{{ $school->number_of_teachers }}</td>
                <td>{{ $school->students_count }}</td>
                <td style="display: flex; gap: 0.2rem; justify-content: center;">
                    <a href="{{ route('schools.edit', $school->id) }}" class="btn btn-sm btn-primary">Edit</a>
                    <a href="{{ route('schools.show', $school->id) }}" class="btn btn-sm btn-info">View</a>
                    <form action="{{ route('schools.destroy', $school->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                            onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="10">No schools found</td></tr>
        @endforelse
    </tbody>
</table>
