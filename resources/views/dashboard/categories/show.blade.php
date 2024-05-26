<x-app-layout>
    <div class="container mx-auto py-8 px-4 md:px-8">
        <x-form.breadcrumb :items="['Home', 'Categories', $category->name]" :routes="['/', '/categories', route('categories.show', $category->id)]" />
        <x-alert />
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Category Details</h1>
        <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <div class="mb-4">
                <x-form.label :value="__('Name')" />
                <p>{{ $category->name }}</p>
            </div>
            <div class="mb-4">
                <x-form.label :value="__('Description')" />
                <p>{{ $category->description }}</p>
            </div>
            <div class="mb-4">
                <x-form.label :value="__('Slug')" />
                <p>{{ $category->slug }}</p>
            </div>
            <div class="mb-4">
                <x-form.label :value="__('Image')" />
                <img src="{{ asset('uploads/categories/' . $category->image) }}" alt="{{ $category->name }}" class="w-24 h-24 object-cover rounded-md">
            </div>
            <div class="mb-4">
                <x-form.label :value="__('Parent Category')" />
                <p>{{ $category->parent ? $category->parent->name : 'N/A' }}</p>
            </div>
            <div class="mb-4">
                <x-form.label :value="__('Status')" />
                <p>{{ $category->status }}</p>
            </div>
            <div class="flex justify-end space-x-2">
                <a href="{{ route('categories.edit', $category->id) }}"
                    class="inline-flex items-center px-4 py-2 bg-yellow-500 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-yellow-400 active:bg-yellow-600 focus:outline-none focus:border-yellow-600 focus:ring ring-yellow-300 disabled:opacity-25 transition ease-in-out duration-150">
                    Edit
                </a>
                <form action="{{ route('categories.destroy', $category->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure?');" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 disabled:opacity-25 transition ease-in-out duration-150">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
