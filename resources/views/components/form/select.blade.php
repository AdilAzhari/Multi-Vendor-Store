
@props([
    'name',
    'id' => null,
    'class' => 'form-control',
    'options' => [],
    'selected' => null,
])

<div class="form-group">
    <select name="{{ $name }}" id="{{ $id ?? $name }}" {{ $attributes->merge(['class' => $class]) }}>
        @foreach ($options as $value => $label)
            <option value="{{ $value }}" {{ $value == $selected ? 'selected' : '' }}>
                {{ $label }}
            </option>
        @endforeach
    </select>
</div>
