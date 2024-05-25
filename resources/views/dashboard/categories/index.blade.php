<x-app-layout>

<x-form.breadcrumb :items="['Home', 'Products']" :routes="['/', '/products']" />
</x-app-layout>
@extends('layouts.dashboard')
@section('title', 'Categories')

{{-- @section('breadcrumbs')
    <nav aria-label="breadcrumb" class="flex items-center justify-between px-4 py-2 bg-gray-100 rounded-t-lg">
        <ol class="flex items-center space-x-4">
            <li class="text-sm font-medium">
                <a href="" class="text-gray-700 hover:text-gray-900">Dashboard</a>
            </li>
            <li class="text-sm font-medium">
                <span aria-current="page" class="text-gray-500">Categories</span>
            </li>
        </ol>
    </nav>
@endsection --}}

@section('content')
    <x-alert />

    <div class="flex flex-col mb-4">
        <div class="flex justify-between items-center px-4 py-2 bg-gray-100 rounded-t-lg">
            <form action="{{ route('dashboard.categories.index') }}" method="get" class="flex items-center space-x-4">
                <div>
                    <label for="status" class="text-sm font-medium text-gray-700">Status:</label>
                    <select name="status" id="status" class="form-select">
                        <option value="">All</option>
                        <option value="active" @if (request('status') == 'active') selected @endif>Active</option>
                        <option value="inactive" @if (request('status') == 'inactive') selected @endif>Inactive</option>
                    </select>
                </div>
                <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-danger">Trash</a>

                <div>
                    <label for="category" class="text-sm font-medium text-gray-700">Category:</label>
                    <input type="text" name="name" id="category" class="form-input"
                        value="@if (request('name')) {{ request('name') }} @endif">
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>

        <div class="overflow-x-auto rounded-lg shadow-md">

            <table class="table table-striped divide-y divide-gray-200 min-w-full">
                <thead>
                    <tr>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Slug</th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Parent Category
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Products
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status
                        </th>
                        <th class="px-4 py-2 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td class="px-4 py-2 text-sm font-medium text-gray-700">{{ $category->name }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $category->slug }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">
                                {{ $category->parent ? $category->parent->name : 'N/A' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $category->products_count ?? 'N/A' }}</td>
                            <td class="px-4 py-2 text-sm text-gray-500">{{ $category->status }}</td>
                            <td class="px-4 py-2 flex items-center space-x-2">
                                <a href="{{ route('dashboard.categories.edit', $category) }}"
                                    class="btn btn-primary btn-sm">
                                    Edit
                                </a>
                                <form action="{{ route('dashboard.categories.destroy', $category) }}" method="post"
                                    style="display: inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm hover:bg-red-700"
                                        onclick="return confirm('Are you sure?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-2 text-center text-gray-500">No categories found</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categories->links() }}
    </div>
@endsection
