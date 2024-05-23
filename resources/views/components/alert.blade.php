<div>
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if ($errors->any())
        <div class="bg-yellow-100 border border-yellow-400 text-yellow-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Whoops! Looks like your form has a case of the wiggles!</strong>
            <ul class="list-disc pl-5 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <p class="mt-2 text-right text-sm">Try smoothing things out and submit again. </p>
        </div>
    @endif
    <!-- Always remember that you are absolutely unique. Just like everyone else. - Margaret Mead -->
</div>
