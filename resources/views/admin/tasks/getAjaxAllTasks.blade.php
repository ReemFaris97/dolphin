<label>المهمات</label>
@foreach($allTasks as $task)
    <div class="m-checkbox-inline fixed-width-checks">
        <label class="m-checkbox">
            <input class="md-check" id="check-all" name="tasks[]"
                   value="{{$task->id}}" type="checkbox">{{$task->name}}
            <span></span>
        </label>
    </div>
@endforeach
