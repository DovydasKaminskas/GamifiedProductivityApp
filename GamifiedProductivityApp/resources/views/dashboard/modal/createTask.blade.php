{{--@include('head')--}}
<!-- The Modal -->
<div id="modal" class="taskModal">
    <!-- Modal content -->
    <div class="taskModal-content">
        <div class="taskModal-header">
            <span class="close">&times;</span>
            <h4 class="px-4 pt-3 pb-2">Create Task</h4>
        </div>
        <div class="taskModal-body">
            <form class="my-5" style="" action="{{ route('storeTask') }}" method="POST">
                @csrf
                <div class="mt-3 px-5">
                    <label for="task_name" class="form-label"><b>Task Name</b></label>
                    <input value="{{ old('task_name') }}" type="text" class="form-control" id="task_name" name="task_name" placeholder="Enter task name">
                </div>
                <div class="my-4 px-5">
                    <label for="priority" class="form-label"><b>Priority</b></label>
                    <select id="priority" name="priority" class="form-control">
                        <option value="Select priority"  disabled selected>Select priority</option>
                        <option value="Low" {{ old('priority') == "Low" ? 'selected' : '' }}>Low</option>
                        <option value="Medium" {{ old('priority') == "Medium" ? 'selected' : '' }}>Medium</option>
                        <option value="High" {{ old('priority') == "High" ? 'selected' : '' }}>High</option>
                        <option value="Very high" {{ old('priority') == "Very high" ? 'selected' : '' }}>Very High</option>
                    </select>
                </div>
                <div class="mt-4 px-5">
                    <label for="xp" class="form-label"><b>XP</b></label>
                    <input value="{{ old('xp') }}" type="number" class="form-control" id="xp" name="xp" placeholder="Enter XP" min="1" max="200">
                    <p class="mt-1 ms-1" id="xpInfo">Enter XP between 1 and 200</p>     <!-- The interval will change based on selected priority -->
                </div>
                <div class="mt-4 px-5">
                    <label for="type" class="form-label"><b>Type</b></label>
                    <select id="type" name="type" class="form-control">
                        <option value="Select task type" disabled selected>Select task type</option>
                        <option value="Work" {{ old('type') == "Work" ? 'selected' : '' }}>Work</option>
                        <option value="School" {{ old('type') == "School" ? 'selected' : '' }}>School</option>
                        <option value="Exercise" {{ old('type') == "Exercise" ? 'selected' : '' }}>Exercise</option>
                        <option value="Creativity" {{ old('type') == "Creativity" ? 'selected' : '' }}>Creativity</option>
                        <option value="Chores" {{ old('type') == "Chores" ? 'selected' : '' }}>Chores</option>
                        <option value="Health" {{ old('type') == "Health" ? 'selected' : '' }}>Health</option>
                        <option value="Religion" {{ old('type') == "Religion" ? 'selected' : '' }}>Religion</option>
                        <option value="Other" {{ old('type') == "Other" ? 'selected' : '' }}>Other</option>
                    </select>
                </div>
                <div class="mt-4 px-5">
                    <label for="due_to" class="form-label"><b>Due to</b></label>
                    <input value="{{ old('due_to') }}" type="datetime-local" class="form-control" id="due_to" name="due_to"  min="3000-01-01">
                </div>
                <div class="mt-4 mb-5">
                    <button id="create" type="submit" class="form mx-auto d-block">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
{{--    createTask sricpt is used to make default <select> option grey instead of black--}}

