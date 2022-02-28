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
                <h3 class="mb-3">Register</h3>
                <form action="{{ route('register') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="Please enter full name">
                        @error('name')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
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
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Enter password">
                        @error('password_confirmation')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                        @enderror
                    </div>
                    <strong class="d-block mb-3">Already have an account? <a href="{{ route('login') }}" class="custom-link">Login</a></strong>
                    <button type="submit" class="site-btn">Register</button>
                </form>
            </div>
        </div>
    </div>
</div>
