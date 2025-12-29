@if ($course->status == 'draft')
    <div class="badge badge-sm bg-secondary text-capitalize p-1 py-0">{{ __($course->status) }}</div>
@elseif ($course->status == 'in_review')
    <div class="badge badge-sm badge-warning text-capitalize p-1 py-0">{{ __($course->status) }}</div>
@elseif ($course->status == 'approved')
    <div class="badge badge-sm badge-success text-capitalize p-1 py-0">{{ __($course->status) }}</div>
@elseif ($course->status == 'published')
    <div class="badge badge-sm badge-success text-capitalize p-1 py-0">{{ __($course->status) }}</div>
@elseif ($course->status == 'rejected')
    <div class="badge badge-sm badge-danger text-capitalize p-1 py-0">{{ __($course->status) }}</div>
@endif
