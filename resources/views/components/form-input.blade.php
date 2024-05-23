<div class="mb-3">
    <label for="{{ $id }}" class="form-label text-sm font-medium text-gray-700">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $id }}" name="{{ $name }}"
        class="form-control @error($name) border border-red-500 @enderror" value="{{ $value }}">
    @error($name)
        <span class="text-xs text-red-500">{{ $message }}</span>
    @enderror
</div>
