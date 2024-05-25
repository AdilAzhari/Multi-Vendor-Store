<x-app-layout>
    <div class="container mx-auto py-8 px-4 md:px-8">
        <!-- Welcome Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-gray-800 dark:text-gray-100">Welcome to Our Store</h1>
            <p class="mt-4 text-gray-600 dark:text-gray-300">Discover the best products at the most affordable prices.</p>
            <a href="{{ route('products.index') }}"
                class="mt-6 inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 transition ease-in-out duration-150">
                Shop Now
            </a>
        </div>

        <!-- Navigation Section -->
        <div class="flex justify-center space-x-4 mb-12">
            <a href="{{ route('products.index') }}"
                class="px-4 py-2 bg-green-600 border border-transparent rounded-md font-semibold text-white hover:bg-green-500 active:bg-green-700 focus:outline-none focus:border-green-700 focus:ring ring-green-300 transition ease-in-out duration-150">
                Products
            </a>
            <a href="{{ route('dashboard.categories.index') }}"
                class="px-4 py-2 bg-yellow-600 border border-transparent rounded-md font-semibold text-white hover:bg-yellow-500 active:bg-yellow-700 focus:outline-none focus:border-yellow-700 focus:ring ring-yellow-300 transition ease-in-out duration-150">
                Categories
            </a>
            <a href="{{ route('stores.index') }}"
                class="px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-white hover:bg-red-500 active:bg-red-700 focus:outline-none focus:border-red-700 focus:ring ring-red-300 transition ease-in-out duration-150">
                Stores
            </a>
        </div>

        <!-- Featured Products Section -->
        <div class="mb-12">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-6">Featured Products</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($featuredProducts as $product)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-4">
                        <img src="{{ asset('uploads/products/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover rounded-lg">
                        <h3 class="text-lg font-bold text-gray-800 dark:text-gray-100 mt-4">{{ $product->name }}</h3>
                        <p class="text-gray-600 dark:text-gray-300 mt-2">{{ $product->price }} USD</p>
                        <a href="{{ route('front.products.show', $product) }}"
                            class="mt-4 inline-block text-blue-600 hover:underline">View Product</a>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- About Us Section -->
        <div class="bg-gray-100 dark:bg-gray-800 rounded-lg p-6 mb-12">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">About Us</h2>
            <p class="text-gray-600 dark:text-gray-300">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer nec odio. Praesent libero. Sed cursus ante dapibus diam. Sed nisi. Nulla quis sem at nibh elementum imperdiet. Duis sagittis ipsum. Praesent mauris. Fusce nec tellus sed augue semper porta. Mauris massa.</p>
        </div>

        <!-- Contact Section -->
        <div class="text-center mb-12">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100 mb-4">Get in Touch</h2>
            <p class="text-gray-600 dark:text-gray-300">If you have any questions, feel free to reach out to us.</p>
            <a href="{{ route('contact') }}"
                class="mt-4 inline-flex items-center px-6 py-3 bg-blue-600 border border-transparent rounded-md font-semibold text-white hover:bg-blue-500 active:bg-blue-700 focus:outline-none focus:border-blue-700 focus:ring ring-blue-300 transition ease-in-out duration-150">
                Contact Us
            </a>
        </div>
    </div>
</x-app-layout>
