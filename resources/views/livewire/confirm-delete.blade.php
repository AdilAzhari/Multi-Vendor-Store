<div wire:ignore.self x-data="{ open: false }">
    <button type="button" wire:click="$emit('openModal')">Delete</button>

    <div x-show="open" @keydown.esc="open = false" class="fixed z-10 inset-0 overflow-y-auto px-4 py-6 sm:px-0">
        <div class="relative bg-gray-500/50 rounded-lg shadow-md mx-auto w-full sm:max-w-md p-4">
            <h1 class="text-xl font-bold text-center">Confirm Delete</h1>
            <p class="mt-3 text-sm text-gray-700">Are you sure you want to delete this item?</p>

            <div class="flex justify-end mt-4 space-x-2">
                <button type="button" wire:click="$emit('closeModal')" x-data="{ open: false }" @click.away="open = false" class="btn btn-secondary">Cancel</button>
                <button wire:click="$emit('confirmedDelete')" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('openModal', () => {
            $Alpine.data('confirm-delete').open = true;
        });

        Livewire.on('closeModal', () => {
            $Alpine.data('confirm-delete').open = false;
        });
    </script>
@endpush
