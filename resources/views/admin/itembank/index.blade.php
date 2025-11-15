@extends('layouts.app')

@section('content')
<div class="app-content">
    <section class="section">
        <div class="page-header p-2">
            <h4 class="page-title font-weight-bold">Item Bank</h4>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}" class="text-light-color">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Item Bank</li>
            </ol>
        </div>

        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="mb-0">All Items</h4>
                <a href="{{ route('item-bank.create') }}" class="btn btn-sm btn-primary" style="width: 8rem !important;">Add Item</a>
            </div>

            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered text-center">
                        <thead class="thead-light">
                            <tr>
                                <th>#</th>
                                <th>Subject</th>
                                <th>Grade</th>
                                <th>Item Type</th>
                                <th>SLO</th>
                                <th>Difficulty</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($items as $index => $item)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $item->subject->name ?? 'N/A' }}</td>
                                    <td>{{ $item->grade->name ?? 'N/A' }}</td>
                                    <td>{{ $item->item_type }}</td>
                                    <td>{{ $item->slo ?? '-' }}</td>
                                    <td>{{ $item->difficulty ?? '-' }}</td>
                                    <td>{{ $item->created_at->format('d M Y') }}</td>
                                    <td class="d-flex" style="gap: 3px">
                                        <a href="{{ route('item-bank.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="{{ route('item-bank.show', $item->id) }}" class="btn btn-sm btn-info">view</a>
                                        <form action="{{ route('item-bank.destroy', $item->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this item?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8">No items found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="d-flex justify-content-end mt-3">
                    {{ $items->links() }}
                </div>
            </div>
        </div>
    </section>
</div>
@endsection
