<div>
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h3>Category Management</h3>
        </div>
        <div class="card-body">
            @if (!$editMode)
                <form wire:submit.prevent="createCategory">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name"
                            placeholder="Enter category name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent Category</label>
                        <select wire:model="parentId" class="form-control" id="parent_id">
                            <option value="">None</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </form>

            @else
                <form wire:submit.prevent="updateCategory">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input wire:model.defer="name" type="text" class="form-control" id="name"
                            placeholder="Enter category name">
                        @error('name')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="parent_id">Parent Category</label>
                        <select wire:model="parentId" class="form-control" id="parent_id">
                            <option value="">None</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}"
                                    {{ $category->id === $selectedId ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                    <button type="button" wire:click="$emit('confirmDelete', {{ $selectedId }})"
                        class="btn btn-danger">Delete Category</button>
                </form>
            @endif
        </div>
    </div>

    <div wire:loading wire:target="createCategory, updateCategory, deleteCategory">
        Processing...
    </div>

    @livewire('confirm-delete') <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                @if (optional($categories->first())->parent_id)
                    <th>Parent</th>
                @endif
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $category)
                <tr>
                    <td>{{ $category->name }}</td>
                    @if (optional($category->parent)->name)
                        <td>{{ $category->parent->name }}</td>
                    @endif
                    <td>
                        <button wire:click="editCategory({{ $category->id }})" class="btn btn-sm btn-info">Edit</button>
                        <button wire:click="$emit('confirmDelete', {{ $category->id }})"
                            class="btn btn-sm btn-danger">Delete</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $categories->links() }}
</div>

@push('scripts')
    <script>
        Livewire.on('confirmDelete', categoryId => {
            if (confirm('Are you sure you want to delete this category?')) {
                Livewire.emit('deleteCategory', categoryId);
            }
        });
    </script>
@endpush
