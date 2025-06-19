<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="d-flex justify-content-center">
    <form class="form px-5 py-5 my-5" style="width:30%" action="{{ route('login') }}" method="POST">
        @csrf
        @if ($errors->any())
            <ul class="px-4 py-2 bg-danger" style="border-radius: 5px">
                @foreach ($errors->all() as $error)
                    <li class="my-2">{{ $error }}</li>
                @endforeach
            </ul>
        @endif
        <img src="images/logoold.png" class="mb-5 mx-auto d-block">

        <div class="mb-5">
            <label for="email" class="form-label"><b>Email or Username</b></label>
            <input type="email" class="form-control" id="email" name="email" required value="{{ old('email') }}">
        </div>
        <div class="mb-5">
            <label for="password" class="form-label"><b>Password</b></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-5">
            <button type="submit" class="mx-auto d-block">Login</button>
        </div>
        <div class="mb-5">
            <p class="text-center">Don't have an account? <a href="{{ route('show.register') }}">Register</a></p>
        </div>
    </form>
</body>
</html>
