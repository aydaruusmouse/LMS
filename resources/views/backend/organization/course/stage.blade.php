@if($course->is_published == 1)
    <div class="badge badge-sm badge-success text-capitalize p-1 py-0">published</div>
@else
    <div class="badge badge-sm badge-danger text-capitalize p-1 py-0">unpublished</div>
@endif
