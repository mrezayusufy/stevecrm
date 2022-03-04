<div class=" mb-3">
    <label class="form-label" for="title">Task Title</label>
    <input type="text" name="title" class="form-control" id="title">
</div>
<div class=" mb-3">
    <label class="form-label" for="date">Date</label>
    <input type="date" name="date" class="form-control" id="date">
</div>
<div class="d-flex flex-row gap-2">
    <div class="form-check">
        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
        <label class="form-label" class="form-check-label" for="flexCheckDefault">
            At a time
        </label>
    </div>
    <div class="mb-3 row">
        <input type="time" name="time" class="form-control" id="time">
    </div>
</div>
<div class="mb-3">
    <label class="form-label" for="assign_to">Assign to</label>
    <input type="text" name="assign_to" class="form-control" id="assign_to">
</div>
<div class="form-check">
    <label class="form-label" class="form-check-label" for="send_notification">
        Send notifications of new task to the assigned people
    </label>
    <input class="form-check-input" name="send_notification" type="checkbox" value="true" id="send_notification">
</div>
<div class="form-check mb-3">
    <input class="form-check-input" name="invite" type="checkbox" value="" id="invite">
    <label class="form-label" class="form-check-label" for="invite">
        Send a calendar invite to the assigned people
    </label>
</div>
<div class="mb-3">
    <label class="form-label" for="notes">Notes</label>
    <textarea name="notes" class="form-control" placeholder="Leave a comment here" id="notes" style="height: 100px"></textarea>
</div>
<div class="d-flex flex-row gap-1">
    <div class="mb-3 col-auto">
        <label class="form-label" for="link_to">Link this task to</label>
        <input name="link_to" type="text" class="form-control" id="link_to">
    </div>
    <div class="mb-3 col-auto">
        <label class="form-label" for="associate_with">Associate to a customer</label>
        <input name="associate_with" type="text" class="form-control" id="associate_with">
    </div>
</div>
<div class="d-flex flex-row text-primary">
    <i class="mdi mdi-plus d-flex align-items center p-1 me-1 rounded border border-primary fs-s"></i>
    Add a Subtask
</div>
