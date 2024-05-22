@extends('layouts.dashboard')
@section('title', 'Edit Category')
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">Categories</a></li>
    <li class="breadcrumb-item active">Edit Category</li>
@endsection
@section('content')
    <div class="container">
        <h1>Edit Category</h1>
        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                {{-- <label for="name">Name</label> --}}
                <x-form-input lable="Name" type="text" name="name" id="name" class="form-control" value="{{ $category->name }}"/>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control">{{ $category->description }}</textarea>
            </div>
            <div class="form-group">
                <label for="parent_id">Parent</label>
                <select name="parent_id" id="parent_id" class="form-control">
                    <option value="">Select a parent category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @if ($category->id == $category->parent_id) selected @endif>
                            {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="status">Status</label>
                <select name="status" id="status" class="form-control">
                    <option value="active" @if ($category->status == 'active') selected @endif>Active</option>
                    <option value="inactive" @if ($category->status == 'inactive') selected @endif>Inactive</option>
                </select>
            </div>
            <div class="form-group">
                <label for="image">Image</label>
                <input type="file" name="image" id="image" class="form-control">
            </div>
            <dialog class="form-group">
                <label for="slug">Slug</label>
                <input type="text" name="slug" id="slug" class="form-control" value="{{ $category->slug }}">
            </dialog>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>


            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
@endsection
