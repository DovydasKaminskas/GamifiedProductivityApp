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
            <div class="d-flex mt-4" style="">
                <div class="customCard px-5 py-3" style="width:100%">
                    <span> {{ $user->username }} </span><br>
                    <div class="mt-5">
                        <div class="d-flex">
                            <label style="" for="level">Level Progress (level {{ $user->level }})</label><br>
                            <label class="ms-auto" for="level">{{ $user->xp }}/{{ $level->max }} XP</label><br>
                        </div>
                        <progress class="progressBarMain" id="level" value="{{ Auth::user()->xp }}" max="{{ $level->max }}"> 32% </progress>
                    </div>
                    <div class="d-flex justify-content-center mt-4" style="text-align: center">
                        <div class="centered">
                            <span>{{ $user->tasks_completed }}</span>
                            <p style="font-weight: normal">Tasks Completed</p>
                        </div>
                        <div class="centered ms-5">
                            <span>{{ $user->day_streak }}</span>
                            <p style="font-weight: normal">Day Streak</p>
                        </div>
                        <div class="centered ms-5">
                            <span>{{ $user->achievements_earned }}</span>
                            <p style="font-weight: normal">Achievements Earned</p>
                        </div>
                        <div class="centered ms-5">
                            <span>{{ $user->xp_today }}</span>
                            <p style="font-weight: normal">XP Earned Today</p>
                        </div>
                        <div class="centered ms-5">
                            <span>{{ $user->tasks_completed_today }}</span>
                            <p style="font-weight: normal">Tasks Completed Today</p>
                        </div>
                    </div>
                </div>
        </div>
            {{--Today's quests. Using paddings for every element instead of just putting it in div
            because we want horizontal line to be in full width of div card--}}
            <div class="customCard mt-4 pb-4" style="width:100%">
                <div class="d-flex px-5 pt-3 align-items-center">
                    <h4 class="">Today's Quests</h4>
                    <a id="createBtn" class="ms-auto me-0 mb-2 px-3" style="font-weight:normal"><i class="fa-solid fa-plus me-1" style="color: white !important;"></i> Add Task</a>
                </div>
                <div class="horizontal-line" style="width:100%"></div> {{--This div is used to display line--}}
                @foreach($tasks as $task)
                    <div class="taskCardWrapper" data-task-id="{{ $task->id }}">
                        <form action="{{ route('editTask', $task->id) }}" method="POST"></form>
                            @csrf
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
                                    <span class="text-center">+{{ $task->xp }} XP</span>
                                    <form action="{{ route('destroyTask', $task->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button id="completeBtn" class="completeBtn text-center mt-2" onclick="return confirm('Are you sure?');">Complete</button>
                                    </form>
                                </div>
                            </div>
                    </div>
                @endforeach
            </div>
        </div>
    <div class="customCard py-3 ms-3 mt-4" style="width:20%; height: 50%">
        <h4 class="px-4">Achievement Progress</h4>
        <div class="horizontal-line" style="width: 100%"></div> {{--This div is used to display line--}}
        @foreach($user->userAchievements->all() as $userAchievement)
            <div class="px-4 mt-3">
                <div class="d-flex">
                    <label style="" for="level">{{ $userAchievement->achievement->achievement_name }}</label><br>
                    <label class="ms-auto" for="level"> {{ $userAchievement->current_value }} / {{ $userAchievement->max_value }} {{ $userAchievement->unit }}</label><br>
                </div>
                <p class="my-0" style="font-size: 13px; font-weight: normal">{{ $userAchievement->achievement->description }} @if($userAchievement->start_date)
                        (Day {{ round($userAchievement->start_date->diffInDays(now()) + 1) }})
                    @endif</p>
                <progress class="progressBarAchievement" id="level" value="{{ $userAchievement->current_value }}" max="{{ $userAchievement->max_value }}"> 32% </progress>
            </div>
        @endforeach
    </div>
</div>
<script src="js/modalVisibility.js"></script>
<script>
    const tasks = @json($tasks);
</script>
<script src="js/taskCard.js"></script>
</body>
</html>
