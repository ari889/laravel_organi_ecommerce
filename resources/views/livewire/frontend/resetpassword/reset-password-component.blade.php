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
                    <button type="submit" class="site-btn">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>

