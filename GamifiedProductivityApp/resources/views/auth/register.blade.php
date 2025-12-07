<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="d-flex justify-content-center">
<form class="form px-5 py-4 my-5" action="{{ route('register') }}" method="POST">
    @csrf
    <img src="images/logoold.png" class="mb-5 mx-auto d-block">
    @if ($errors->any())
        <ul class="px-4 py-2 bg-danger" style="border-radius: 5px">
            @foreach ($errors->all() as $error)
                <li class="my-2">{{ $error }}</li>
            @endforeach
        </ul>
    @endif
    <div class="mb-5">
        <label for="username" class="form-label"><b>Username *</b></label>
        <input type="text" class="form-control" id="username" name="username" required value="{{ old('username') }}">
    </div>
    <div class="mb-5">
        <label for="email" class="form-label"><b>Email *</b></label>
        <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
    </div>
    <div class="mb-5">
        <label for="password" class="form-label"><b>Password *</b></label>
        <input type="password" class="form-control" id="password" name="password" required>
        <p class="mt-2">Must be at least 8 characters with numbers and uppercase and lower case letters</p>
    </div>
    <div class="mb-5">
        <label for="password_confirmation" class="form-label"><b>Confirm Password *</b></label>
        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" required>
        <p class="mt-2">By clicking the button below, you are indicating that you have read and agree to the Terms of Service and Privacy Policy.</p>
    </div>
    <div class="mb-5">
        <button type="submit" class="mx-auto d-block">Create Account</button>
    </div>
    <div class="mb-0">
        <p class="text-center" style="font-size: 20px;">Already have an account? <a href="{{ route('show.login') }}">Login</a></p>
    </div>
</form>
</body>
</html>
