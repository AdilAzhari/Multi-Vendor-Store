@extends('layouts.dashboard')
@section('title', 'Import Product')
@section('breadcrumb')
    @parent
    <li class="breadcrumb-item">Import Product</li>
    <li class="breadcrumb-item active">Create</li>
@endsection
{{--
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h3 class="card-title
                        @if (session('success'))
                            text-success
                        @endif
                    ">
                        Import Product
                    </h3>
                </div>
                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif
                    <form action="{{ route('import-product.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group" id="file">
                            <label for="file">File</label>
                            <input type="file" name="file" id="file" class="form-control @error('file') is-invalid @enderror">
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection --}}

@section('content')
    <form action="{{ route('import-product.store') }}" method="post">
        @csrf
        <div class="form-group">
            <x-form.input lable="Product Count" name="product_count" class="form-control-lg" />
        </div>
        <button type="submit" class="btn btn-primary"> Start Import ....</button>
    </form>
@endsection
