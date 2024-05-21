@extends('layouts.dashboard')
@section('title', 'Categories')
@section('breadcrumbs')
    <nav aria-label="breadcrumb" class="breadcrumb-nav">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-table">
                <div class="card-header">
                    <h3 class="card-title">Categories</h3>
                    <div class="card-options">
                        <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary">Add Category</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped table-vcenter">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Parent</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>{{ $category->parent ? $category->parent->name : 'N/A' }}</td>
                                    <td>
                                        <a href="{{ route('dashboard.categories.edit', $category) }}"
                                            class="btn btn-primary btn-sm">Edit</a>
                                        <form action="{{ route('dashboard.categories.destroy', $category) }}" method="post"
                                            style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm"
                                                onclick="return confirm('Are you sure?')">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4">No categories found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $categories->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
