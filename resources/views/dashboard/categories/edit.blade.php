<x-app-layout>
    <div class="container mx-auto py-8 px-4 md:px-8">
        <x-form.breadcrumb :items="['Home', 'Categories', 'Edit']" :routes="['/', '/categories', '/categories/' . $category->id . '/edit']" />
        <x-alert />
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Edit Category</h1>
        <div class="max-w-5xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <x-form.label for="name" :value="__('Name')" />
                    <x-form.input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $category->name)" required autofocus />
                </div>
                <div class="mb-4">
                    <x-form.label for="description" :value="__('Description')" />
                    <x-form.textarea id="description" name="description" class="mt-1 block w-full">{{ old('description', $category->description) }}</x-form.textarea>
                </div>
                <div class="mb-4">
                    <x-form.label for="slug" :value="__('Slug')" />
                    <x-form.input id="slug" name="slug" type="text" class="mt-1 block w-full" :value="old('slug', $category->slug)" />
                </div>
                <div class="mb-4">
                    <x-form.label for="image" :value="__('Image')" />
                    <x-form.input id="image" name="image" type="file" class="mt-1 block w-full" />
                </div>
                <div class="mb-4">
                    <x-form.label for="parent_id" :value="__('Parent Category')" />
                    <select id="parent_id" name="parent_id" class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="">Select a parent category</option>
                        @foreach ($categories as $parentCategory)
                            <option value="{{ $parentCategory->id }}" @selected(old('parent_id', $category->parent_id) == $parentCategory->id)>{{ $parentCategory->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <x-form.label for="status" :value="__('Status')" />
                    <select id="status" name="status" class="form-select mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                        <option value="active" @selected(old('status', $category->status) == 'active')>Active</option>
                        <option value="inactive" @selected(old('status', $category->status) == 'inactive')>Inactive</option>
                    </select>
                </div>
                <div class="flex justify-end">
                    <x-form.button class="bg-blue-600 hover:bg-blue-700">
                        {{ __('Update') }}
                    </x-form.button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
