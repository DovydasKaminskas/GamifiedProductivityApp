<div class="navigationbar">
    <nav>
        <ul class="d-flex align-items-center my-0">
            <li> <a href="{{ route('show.index') }}"><img src="images/logoold.png" style="width: 170px" alt="BetterMe"></a></li>
            <li class="mx-5"><a href="{{ route('show.index') }}"><b>Home</b></a></li>
            @auth
                <li class="mx-5"><a href="{{ route('show.dashboard') }}"><b>Dashboard</b></a></li>
            @endauth
            <li class="mx-5"><a href="{{ route('show.leaderboard') }}"><b>Leaderboard</b></a></li>
            <li class="mx-5" style="white-space: nowrap;"><a href="{{ route('show.howToPlay') }}"><b>How to play?</b></a></li>
            <div class="d-flex" style="margin-left: 35%;">
                @guest
                    <li class="mx-2 btn btn-primary"><a  href="{{ route('show.register') }}"><b>Register</b></a></li>
                    <li class="mx-2 btn btn-primary"><a  href="{{ route('show.login') }}"><b>Login</b></a></li>
                @endguest
                @auth
                    <form class="mx-2" action="{{ route('logout') }}" method="POST" class="m-0">
                        @csrf
                        <button class="btn btn-primary"><b>Logout</b></button>
                    </form>
                @endauth
            </div>
        </ul>
    </nav>
</div>
{{--<nav class="d-flex align-items-center ps-5" style="width: 100%">--}}
{{--        <a href="/tasks.html"><img src="images/logoold.png" style="width: 170px" alt="BetterMe"></a>--}}
{{--        <a class="mx-5" href="/tasks.html"><b>Home</b></a>--}}
{{--        <a class="mx-5" href="/skills.html"><b>Leaderboard</b></a>--}}
{{--        <a class="mx-5" style="white-space: nowrap;" href="/calendar.html"><b>How to play?</b></a>--}}
{{--        <div class="d-flex" style="margin-left: 35%;">--}}
{{--            <a  class="mx-2 btn btn-primary" href="{{ route('show.register') }}"><b>Register</b></a>--}}
{{--            <a class="mx-2 btn btn-primary" href="{{ route('show.login') }}"><b>Login</b></a>--}}
{{--            <form class="mx-2" action="{{ route('logout') }}" method="POST" class="m-0">--}}
{{--                @csrf--}}
{{--                <button class="btn btn-primary"><b>Logout</b></button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--</nav>--}}

