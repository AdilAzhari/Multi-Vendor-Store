<div>
    @props(['type' => 'text', 'name', 'value' => '', 'required' => true, 'lable' => ''])
    @if ($lable)
        <label for="{{ $name }}" class="block text-sm font-medium text-gray-700">{{ $name }}</label>
    @endif

    <input type="{{ $type }}" name="{{ $name }}" id="{{ $name }}"
        class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500"
        value="{{ $value }}">
    <!-- When there is no desire, all things are at peace. - Laozi -->
</div>
