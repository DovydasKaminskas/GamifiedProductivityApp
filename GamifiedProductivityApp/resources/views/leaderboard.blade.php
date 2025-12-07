<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('nav')
    <div style="width:100%; background-color:#476B83" class="ps-5 py-3">
        <h1><b>LeaderBoard</b></h1>
        <p><b>See how you stack up against other productivity champions</b></p>
    </div>
    <div class="d-flex flex-column align-items-center">
        <div class="sortButton mt-5 mb-4">
            <a class="px-3 py-2"
               href="{{ route('show.leaderboard', array_merge(request()->all(), [
           'sort' => [
               0 => request('sort.0') == 'level,asc' ? 'level,desc' : 'level,asc',
               1 => request('sort.0') == 'level,asc' ? 'xp,desc'    : 'xp,asc',
               2 => request('sort.0') == 'level,asc' ? 'tasks_completed,desc'    : 'tasks_completed,asc'
           ]
       ])) }}"
               style="{{ request('sort.0') == 'level,asc' || request('sort.0') == 'level,desc' || !request()->has('sort')
           ? 'background-color: rgb(0, 157, 255)'
           : '' }}">
                Level</a>
            {{-- Tasks --}}
            <a class="px-3 py-2"
               href="{{ route('show.leaderboard', array_merge(request()->all(), [
           'sort' => [
               0 => request('sort.0') == 'tasks_completed,desc' ? 'tasks_completed,asc'  : 'tasks_completed,desc',
               1 => request('sort.0') == 'tasks_completed,desc' ? 'level,asc'  : 'level,desc',
               2 => request('sort.0') == 'tasks_completed,desc' ? 'xp,asc'  : 'xp,desc'

           ]
       ])) }}"
               style="{{ request('sort.0') == 'tasks_completed,asc' || request('sort.0') == 'tasks_completed,desc'
           ? 'background-color: rgb(0, 157, 255)'
           : '' }}">
                Tasks</a>
        </div>
        @foreach($users as $user)
            <div class="d-flex leaderboardCard px-3 py-3 mx-4 mt-3" style="width: 50%; {{ $users->onFirstPage() ? ($loop->iteration == 1 ? 'border-left: 7px solid #ffd700;' : ($loop->iteration == 2 ? 'border-left: 7px solid #C0C0C0;' : ($loop->iteration == 3 ? 'border-left: 7px solid #CD7F32;' : ''))) : '' }} {{ auth()->user() && $user->id == auth()->user()->id ? 'background-color: #ECE5FF;' : ''}} {{ auth()->user() && $user->id == auth()->user()->id && $loop->iteration > 3 ? 'border-left: 7px solid #7E57C2' : '' }}">
                <span>{{ ($users->currentPage() - 1) * $users->perpage() + $loop->iteration }}</span>
                <div class="round ms-3">{{ $user->level }}</div>
                <span class="ms-3">{{ $user->username }}</span>
                @if ($users->onFirstPage())
                    @if ($loop->iteration == 1)
                        <i class="ms-2 fa-solid fa-crown" style="color: #FFD700"></i>
                    @elseif ($loop->iteration == 2)
                        <i class="ms-2 fa-solid fa-medal" style="color: #C0C0C0"></i>
                    @elseif ($loop->iteration == 3)
                        <i class="ms-2 fa-solid fa-award" style="color: #CD7F32"></i>
                    @endif
                @endif
                @if(auth()->user() && $user->id == auth()->user()->id)
                    <button disabled class="px-2 ms-2">You</button>
                @endif
                <div class="leaderboardStats ms-auto" style="">
                    <span>{{ $user->xp }} XP</span><br>
                    <span style="font-weight: normal; font-size: 17px">{{ $user->tasks_completed }} Tasks Completed</span><br>
                </div>
            </div>
        @endforeach
        <div class="mt-5">
            {{ $users->links() }}
        </div>
    </div>
</body>
</html>
