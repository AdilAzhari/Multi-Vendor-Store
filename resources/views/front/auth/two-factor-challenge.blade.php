<x-front-layout title="Two Factor Authentication">

    <!-- Start Account Login Area -->
    <div class="account-login section">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-10 offset-md-1 col-12">
                    <form class="card login">
                        <div class="card-body">
                            <div class="title">
                                <h3>Two Factor Challenge</h3>
                                <p>You must enter your authentication code to continue.</p>
                            </div>
                            <div class="form-group
                                @error('code') is-invalid @enderror">
                                <label for="code">Code</label>
                                <input type="text" name="code" id="code" class="form-control" required>
                                @error('code')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="button">
                                <button class="btn" type="submit">Verify</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-front-layout>
