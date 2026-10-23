@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h2 class="fw-bold">Categories</h2>
    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary"><i class="fas fa-plus me-2"></i>New Category</a>
</div>

<div class="card shadow-sm">
    <div class="card-body p-0 table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th class="text-end">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($categories as $category)
                <tr>
                    <td class="align-middle">{{ $category->id }}</td>
                    <td class="align-middle fw-medium">{{ $category->name }}</td>
                    <td class="text-end align-middle">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-outline-primary me-2"><i class="fas fa-edit"></i> Edit</a>
                        <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this category?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fas fa-trash"></i> Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No categories found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
