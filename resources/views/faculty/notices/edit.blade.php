@extends('layouts.app')
@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fw-bold">Edit Notice</h2>
        <a href="{{ route('faculty.dashboard') }}" class="text-decoration-none"><i class="fas fa-arrow-left me-1"></i>Back to My Notices</a>
    </div>
</div>
<div class="card shadow-sm col-md-8 mb-4">
    <div class="card-body p-4">
        <form action="{{ route('faculty.notices.update', $notice) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="title" class="form-label">Notice Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $notice->title) }}" required>
                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="category_id" class="form-label">Category</label>
                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id', $notice->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
                <div class="col-md-6">
                    <label for="expiry_date" class="form-label">Expiry Date (Optional)</label>
                    <input type="date" class="form-control @error('expiry_date') is-invalid @enderror" id="expiry_date" name="expiry_date" value="{{ old('expiry_date', $notice->expiry_date ? \Carbon\Carbon::parse($notice->expiry_date)->format('Y-m-d') : '') }}">
                    @error('expiry_date') <div class="invalid-feedback">{{ $message }}</div> @enderror
                </div>
            </div>
            <div class="mb-4">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="5" required>{{ old('description', $notice->description) }}</textarea>
                @error('description') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="alert alert-info py-2">
                <i class="fas fa-info-circle me-1"></i>Note: Modifying attachments is not supported in edit mode. Please create a new notice if you need to upload new files.
            </div>
            <button type="submit" class="btn btn-primary">Update Notice</button>
        </form>
    </div>
</div>
@endsection
