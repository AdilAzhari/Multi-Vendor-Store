<x-app-layout>
    <div class="container mx-auto py-8 px-4 md:px-8">

        <x-form.breadcrumb :items="['Home', 'Products', 'Create New Product']" :routes="['/', '/products']" />
        <x-alert />
        <div class="container mx-auto py-8 px-4 md:px-8">
            <div class="max-w-3xl mx-auto p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Create New Product</h2>
                <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')

                    <!-- Product Name -->
                    <div class="mb-4">
                        <x-form.label for="name">Product Name</x-form.label>
                        <x-form.input id="name" class="block mt-1 w-full" type="text" name="name"
                            :value="old('name')" required autofocus />
                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Description -->
                    <div class="mb-4">
                        <x-form.label for="description">Description</x-form.label>
                        <textarea id="description" name="description" rows="4"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50"
                            required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Product Image -->
                    <div class="mb-4">
                        <x-form.label for="image">Product Image</x-form.label>
                        <input
                            class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                            aria-describedby="image_help" id="image" type="file" name="image" accept="image/*">
                        <div class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="image_help">A profile picture is
                            useful to confirm you are logged into your account</div>
                        @error('image')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Category -->
                    <div class="mb-4">
                        <x-form.label for="category">Category</x-form.label>
                        <select id="category" name="category_id"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Select a category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}" @selected(old('category_id') == $category->id)>{{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Parent Category -->
                    <div class="mb-4">
                        <x-form.label for="parent_category">Parent Category</x-form.label>
                        <select id="parent_category" name="parent_category_id"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Select a parent category</option>
                            @foreach ($parentCategories as $parentCategory)
                                <option value="{{ $parentCategory->id }}" @selected(old('parent_category_id') == $parentCategory->id)>
                                    {{ $parentCategory->name }}</option>
                            @endforeach
                        </select>
                        @error('parent_category_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Store -->
                    <div class="mb-4">
                        <x-form.label for="store">Store</x-form.label>
                        <select id="store" name="store_id"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="">Select a store</option>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}" @selected(old('store_id') == $store->id)>{{ $store->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('store_id')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div class="mb-4">
                        <x-form.label for="price">Price</x-form.label>
                        <x-form.input id="price" class="block mt-1 w-full" type="number" step="0.01"
                            name="price" :value="old('price')" required />
                        @error('price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Compare Price -->
                    <div class="mb-4">
                        <x-form.label for="compare_price">Compare Price</x-form.label>
                        <x-form.input id="compare_price" class="block mt-1 w-full" type="number" step="0.01"
                            name="compare_price" :value="old('compare_price')" />
                        @error('compare_price')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Options -->
                    <div class="mb-4">
                        <x-form.label for="options">Options</x-form.label>
                        <textarea id="options" name="options" rows="4"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">{{ old('options') }}</textarea>
                        @error('options')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Rating -->
                    <div class="mb-4">
                        <x-form.label for="rating">Rating</x-form.label>
                        <x-form.input id="rating" class="block mt-1 w-full" type="number" step="0.1"
                            name="rating" :value="old('rating')" />
                        @error('rating')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Featured -->
                    <div class="mb-4">
                        <x-form.label for="featured">Featured</x-form.label>
                        <select id="featured" name="featured"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="0" @selected(old('featured') == '0')>No</option>
                            <option value="1" @selected(old('featured') == '1')>Yes</option>
                        </select>
                        @error('featured')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Status -->
                    <div class="mb-4">
                        <x-form.label for="status">Status</x-form.label>
                        <select id="status" name="status"
                            class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-500 focus:ring-opacity-50">
                            <option value="published" @selected(old('status') == 'published')>Published</option>
                            <option value="draft" @selected(old('status') == 'draft')>Draft</option>
                            <option value="archived" @selected(old('status') == 'archived')>Archived</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end mt-4">
                        <x-form.button type="submit">
                            Create
                        </x-form.button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
