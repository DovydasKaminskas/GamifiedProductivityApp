@include('head')
<!-- The Modal -->
<div id="ModalCreate"   class="taskModal" style="@if($errors->any()) display: flex; @else display: none; @endif">
    <!-- Modal content -->
    <div class="taskModal-content">
        <div class="taskModal-header">
            <span class="close">&times;</span>
            <h4 class="px-4 pt-3 pb-2">Create Task</h4>
        </div>
        <div class="taskModal-body">
            @if ($errors->any())
                <ul class="px-4 py-2 bg-danger" style="border-radius: 5px">
                    @foreach ($errors->all() as $error)
                        <li class="my-2" style="color:white">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
            <form class="my-5" style="" action="{{ route('createTask') }}" method="POST">
                @csrf
                <div class="mt-3 px-5">
                    <label for="task_name" class="form-label"><b>Task Name</b></label>
                    <input type="text" class="form-control" id="task_name" name="task_name" placeholder="Enter task name">
                </div>
                <div class="mt-4 px-5">
                    <label for="xp" class="form-label"><b>XP</b></label>
                    <input type="number" class="form-control" id="xp" name="xp" placeholder="Enter XP" min="1" max="200">
                </div>
                <div class="mt-4 px-5">
                    <label for="type" class="form-label"><b>Type</b></label>
                    <select id="type" name="type" class="form-control">
                        <option value="" disabled selected>Select task type</option>
                        <option value="Work">Work</option>
                        <option value="Study">Study</option>
                        <option value="Personal">Personal</option>
                        <option value="Other">Other</option>
                    </select>
                </div>
                <div class="mt-4 px-5">
                    <label for="due_to" class="form-label"><b>Due to</b></label>
                    <input type="datetime-local" class="form-control" id="due_to" name="due_to">
                </div>
                <div class="my-4 px-5">
                    <label for="priority" class="form-label"><b>Priority</b></label>
                    <select id="priority" name="priority" class="form-control">
                        <option value="" disabled selected>Select priority</option>
                        <option value="Low">Low</option>
                        <option value="Medium">Medium</option>
                        <option value="High">High</option>
                        <option value="Very high">Very High</option>
                    </select>
                </div>
                <div class="mb-5">
                    <button id="create" type="submit" class="form mx-auto d-block">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    createTask sricpt is used to make default <select> option grey instead of black--}}
{{--    <script src="/js/createTask.js"></script>--}}
    <script src="/js/modal.js"></script>
