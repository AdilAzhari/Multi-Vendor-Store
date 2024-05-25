<x-app-layout>
    <div class="container mx-auto py-8 px-4 md:px-8">

        <x-form.breadcrumb :items="['Home', 'Products', 'Trashed Products']" :routes="['/', '/products']" />
        <x-alert />

        <div class="container mx-auto py-8 px-4 md:px-8">
            <div class="max-w-4xl mx-auto p-6 bg-white dark:bg-gray-800 rounded-lg shadow-md">
                <h2 class="text-3xl font-bold text-gray-800 dark:text-gray-100 mb-6">Trashed Products</h2>

                @if ($trashedProducts->isEmpty())
                    <p class="text-gray-600 dark:text-gray-300">No trashed products found.</p>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full table-auto">
                            <thead>
                                <tr class="bg-gray-100 dark:bg-gray-700">
                                    <th
                                        class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">
                                        Name</th>
                                    <th
                                        class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">
                                        Category</th>
                                    <th
                                        class="px-6 py-3 text-left text-sm font-semibold text-gray-600 dark:text-gray-200">
                                        Deleted At</th>
                                    <th
                                        class="px-6 py-3 text-right text-sm font-semibold text-gray-600 dark:text-gray-200">
                                        Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($trashedProducts as $product)
                                    <tr class="border-b border-gray-200 dark:border-gray-700">
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                            {{ $product->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                            {{ $product->category->name }}</td>
                                        <td class="px-6 py-4 text-sm text-gray-800 dark:text-gray-300">
                                            {{ $product->deleted_at->format('Y-m-d H:i:s') }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <form action="{{ route('products.restore', $product->id) }}" method="POST"
                                                class="inline">
                                                @csrf
                                                @method('PUT')
                                                <x-form.button type="submit"
                                                    class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                                    Restore
                                                </x-form.button>
                                            </form>
                                            <form action="{{ route('products.forceDelete', $product->id) }}"
                                                method="POST" class="inline"
                                                onsubmit="return confirm('Are you sure you want to permanently delete this product?');">
                                                @csrf
                                                @method('DELETE')
                                                <x-form.button type="submit"
                                                    class="ml-2 bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">
                                                    Delete Permanently
                                                </x-form.button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
                <div class="mt-4">
                    {{ $trashedProducts->links() }}
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
