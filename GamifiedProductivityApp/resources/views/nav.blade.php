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
                    <form class="mx-2" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="btn btn-primary"><b>Logout</b></button>
                    </form>
                @endauth
            </div>
        </ul>
    </nav>
</div>
