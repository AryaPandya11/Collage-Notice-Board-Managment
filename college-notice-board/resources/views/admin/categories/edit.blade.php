@extends('layouts.app')
@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Edit Category</h2>
        <a href="{{ route('admin.categories.index') }}" class="text-decoration-none"><i class="fas fa-arrow-left me-1"></i>Back to Categories</a>
    </div>
</div>
<div class="card shadow-sm col-md-6">
    <div class="card-body p-4">
        <form action="{{ route('admin.categories.update', $category) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="name" class="form-label">Category Name</label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $category->name) }}" required autofocus>
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Update Category</button>
        </form>
    </div>
</div>
@endsection
