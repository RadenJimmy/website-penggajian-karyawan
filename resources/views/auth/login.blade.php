@extends('layouts.auth')

@section('content')
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow-lg border-0 rounded-lg overflow-hidden" style="max-width: 800px; width: 100%;">
        <div class="row g-0">
            <!-- Bagian Kiri: Logo SIGAWAi -->

            <div class="col-md-6 d-none d-md-flex justify-content-center align-items-center"
                style="background:rgb(39, 6, 102)">
                <img src="{{ asset('logo.png') }}" alt="SIGAWAi Logo" class="img-fluid" style="max-width: 150px;">
            </div>

            <!-- Bagian Kanan: Form Login -->
            <div class="col-md-6 p-5">
                <h3 class="text-center fw-bold mb-3">Login</h3>

                <!-- Flash Message -->
                @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-3">
                        <label for="email" class="form-label"><i class="fas fa-envelope"></i> Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter email" required autofocus>
                        @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label"><i class="fas fa-lock"></i> Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter password" required>
                            <span class="input-group-text"><i class="fas fa-eye-slash toggle-password"></i></span>
                        </div>
                        @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between mb-3">
                        <div>
                            <input type="checkbox" id="remember" name="remember">
                            <label for="remember">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none" style="color: #6a0dad;">Forgot password?</a>
                    </div>

                    <!-- Tombol Login -->
                    <div class="d-grid">
                        <button type="submit" class="btn btn-lg text-white" style="background:rgb(39, 6, 102); border: none;">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Auto Fade-out Flash Messages -->
<script>
    setTimeout(() => {
        document.querySelectorAll('.alert').forEach(alert => {
            alert.classList.add('fade');
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);

    // Toggle password visibility
    document.querySelector('.toggle-password').addEventListener('click', function() {
        let passwordField = document.querySelector('input[name="password"]');
        if (passwordField.type === "password") {
            passwordField.type = "text";
            this.classList.remove("fa-eye-slash");
            this.classList.add("fa-eye");
        } else {
            passwordField.type = "password";
            this.classList.remove("fa-eye");
            this.classList.add("fa-eye-slash");
        }
    });
</script>
@endsection