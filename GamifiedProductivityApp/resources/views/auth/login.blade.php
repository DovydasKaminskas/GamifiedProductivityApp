<!DOCTYPE html>
<html lang="en">
@include('head')
<body class="d-flex justify-content-center">
    <form class="form px-5 py-4 my-5" action="{{ route('login') }}" method="POST">
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
            <label for="emailOrUsername" class="form-label"><b>Email or Username</b></label>
            <input type="text" class="form-control" id="emailOrUsername" name="emailOrUsername" required value="{{ old('emailOrUsername') }}">
        </div>
        <div class="mb-5">
            <label for="password" class="form-label"><b>Password</b></label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-5">
            <button type="submit" class="mx-auto d-block">Login</button>
        </div>
        <div class="mb-0">
            <p class="text-center" style="font-size:20px">Don't have an account? <a href="{{ route('show.register') }}">Register</a></p>
        </div>
    </form>
</body>
</html>
