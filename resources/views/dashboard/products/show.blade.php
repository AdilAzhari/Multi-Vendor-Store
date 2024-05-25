<x-app-layout>
    <div class="container mx-auto py-8 px-4 md:px-8">

        {{-- <x-form.breadcrumb :items="['Home', 'Products', $product->name]" :route /> --}}
        <x-form.breadcrumb :items="['Home', 'Products', $product->name]" :routes="['/', '/products']" />

        <x-alert />

        <div class="container mx-auto py-8 px-4 md:px-8">
            <div class="max-w-3xl mx-auto p-4 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">{{ $product->name }}</h2>
                <div class="mb-4">
                    <x-form.label for="name">Product Name</x-form.label>
                    <p>{{ $product->name }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="slug">Slug</x-form.label>
                    <p>{{ $product->slug }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="description">Description</x-form.label>
                    <p>{{ $product->description }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="category">Category</x-form.label>
                    <p>{{ $product->category->name }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="store">Store</x-form.label>
                    <p>{{ $product->store->name }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="price">Price</x-form.label>
                    <p>${{ $product->price }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="compare_price">Compare Price</x-form.label>
                    <p>${{ $product->compare_price }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="options">Options</x-form.label>
                    <p>{{ $product->options }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="rating">Rating</x-form.label>
                    <p>{{ $product->rating }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="featured">Featured</x-form.label>
                    <p>{{ $product->featured ? 'Yes' : 'No' }}</p>
                </div>
                <div class="mb-4">
                    <x-form.label for="status">Status</x-form.label>
                    <p>{{ $product->status }}</p>
                </div>
                <div class="flex justify-end mt-4">
                    <a href="{{ route('products.edit', $product) }}" class="btn btn-primary mr-2">Edit</a>
                    <form action="{{ route('products.destroy', $product) }}" method="POST"
                        onsubmit="return confirm('Are you sure you want to delete this product?');">
                        @csrf
                        @method('DELETE')
                        <x-form.button type="submit">Delete</x-form.button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
