<!DOCTYPE html>
<html lang="en">
@include('head')
<body>
@include('nav')

<div style="width:100%; background-color:#476B83" class="ps-5 py-3">
    <h1><b>Your DashBoard</b></h1>
    <p><b>Track your progress, manage tasks, and earn rewards</b></p>
</div>
{{--1 divas visam contentui uzcentruot, 2 divas skirtas kiekvienam stulpeliui--}}
<div class="d-flex justify-content-center">
        <div style="width:60%">
            {{--profile--}}
            <div class="customCard px-5 py-3 mt-4" style="width:100%">
                <span> {{ Auth::user()->username }} </span><br>
                <div class="mt-5">
                    <label for="level">Level Progress</label><br>
{{--                    <progress id="level" value="{{ Auth::user()->xp }}" max="100"> 32% </progress>--}}
                    @include('dashboard.xpProgress')
{{--                    SUKURTI LEVELIUS DUOMENU BAZEJE, PADARYTI, KAD VEIKTU IR RODYTU. VISA LOGIKA XPPROGRESS.BLADE.PHP--}}
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <div class="centered">
                        <span>{{ Auth::user()->tasks_completed }}</span>
                        <p style="font-weight: normal">Tasks Completed</p>
                    </div>
                    <div class="centered ms-5">
                        <span>{{ Auth::user()->day_streak }}</span>
                        <p style="font-weight: normal">Day Streak</p>
                    </div>
                    <div class="centered ms-5">
                        <span>5</span>
                        <p style="font-weight: normal">Badges Earned</p>
                    </div>
                    <div class="centered ms-5">
                        <span>{{ Auth::user()->xp }}</span>
                        <p style="font-weight: normal">Total XP</p>
                    </div>
                </div>
            </div>
            {{--Today's quests. Using paddings for every element instead of just putting it in div
            because we want horizontal line to be in full width of div card--}}
            <div class="customCard mt-4 pb-4" style="width:100%">
                <div class="d-flex px-5 pt-3 align-items-center">
                    <h4 class="">Today's Quests</h4>
                    <a id="createBtn" href="#" class="ms-auto me-0 mb-2 px-3" style="font-weight:normal"><i class="fa-solid fa-plus me-1" style="color: white !important;"></i> Add Task</a>
                </div>
                <div class="horizontal-line" style="width:100%"></div> {{--This div is used to display line--}}
                @foreach($tasks as $task)
                <div class="d-flex taskCard px-5 mx-4 mt-3">
                    <div>
                        <h5>{{ $task->task_name }}</h5>
                        <small>
                            <i class="fas fa-clock me-2 fa-lg"></i><span>Due {{ $task->due_to }}</span><br>
                            <i class="fas fa-tag me-2 fa-lg"></i><span>{{ $task->type }}</span><br>
                            <i class="fas fa-signal me-2 fa-lg"></i><span>{{ $task->priority }}</span><br>
                        </small>
                    </div>
                    <div class="taskXPAndComplete ms-auto d-flex flex-column justify-content-center">
                        <span class="px-5 text-center">+{{ $task->xp }} XP</span>
                        <a class="text-center mt-2">Complete</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@include('dashboard.modal.createTask')
</body>
</html>
