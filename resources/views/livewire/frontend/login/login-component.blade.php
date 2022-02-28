<div>
    <style>
        .custom-mid{
            max-width: 500px;
            margin: 50px auto;
        }
        .custom-link{
            color: #2666CF;
            font-weight: normal;
        }
        .custom-link:hover{
            color: #395B64;
        }
    </style>
    <div class="custom-mid">
        <div class="card shadow-sm">
            <div class="card-body">
                <h3 class="mb-3">Login</h3>
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror" placeholder="Please enter valid email">
                        @error('email')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Enter password">
                        @error('password')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="remember" value="" id="remember">
                        <label class="form-check-label" for="remember">
                            Remember me
                        </label>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                        <strong>Have no account? <a href="{{ route('register') }}" class="custom-link">Register</a></strong>
                        </div>
                        <div class="col-sm-6">
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="custom-link ml-auto d-table">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                        </div>
                    </div>
                    <button type="submit" class="site-btn">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
