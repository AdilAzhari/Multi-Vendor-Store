@extends('layouts.dashboard')
@section('title', 'Edit Category')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('dashboard.categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection
@section('content')
    <div class="container">
        <x-alert />
        <h1>Edit Category</h1>
        <form action="{{ route('dashboard.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <x-form-input label="Name" type="text" name="name" id="name" :value="$category->name" />
                @error('name')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
                @error('description')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror

            </div>
            <div class="form-group">
                <label for="parent_id">Parent</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">Select a parent category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if (old('parent_id', $category->id) == $category->id) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" @if (old('status', 'active')) selected @endif>Active</option>
                    <option value="inactive" @if (old('status', 'inactive')) selected @endif>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
                @error('image')
                    <span class="invalid-feedback">{{ $message }}</span>
                @enderror
            </div>
            <dialog class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}">
            </dialog>
            <a href="{{ route('dashboard.categories.index') }}" class="btn btn-secondary">Cancel</a>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
