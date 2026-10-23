@extends('layouts.app')
@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Create Notice</h2>
        <a href="{{ route('faculty.dashboard') }}" class="text-decoration-none"><i class="fas fa-arrow-left me-1"></i>Back to My Notices</a>
    </div>
</div>
<div class="card shadow-sm col-md-8">
    <div class="card-body p-4">
        <form action="{{ route('faculty.notices.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Notice Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="expiry_date" class="form-label">Expiry Date (Optional)</label>
                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date') }}">
                    @error('expiry_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description') }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-4">
                <label for="file" class="form-label">Attachments (PDF, JPG, PNG)</label>
                <input type="file" class="form-control @error('file.*') is-invalid @enderror" id="file" name="file[]" multiple accept=".pdf,.jpg,.jpeg,.png">
                @error('file.*') <div class="invalid-feedback">{{ $message }}</div> @enderror
                <small class="text-muted">You can select multiple files. Max 10MB per file.</small>
            </div>
            <button type="submit" class="btn btn-primary">Submit for Approval</button>
        </form>
    </div>
</div>
@endsection
