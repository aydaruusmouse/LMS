<ul class="d-flex gap-30 justify-content-end">
    <li data-bs-custom-class="custom-tooltip"
        data-bs-toggle="tooltip" data-bs-placement="top"
        data-bs-title="{{ __('edit') }}">
        <a href="javascript:void(0)" class="edit_modal"
           data-fetch_url="{{ route('organization.assignments.edit',$assignment->id) }}"
           data-route="{{ route('organization.assignments.update',$assignment->id) }}" data-modal="edit_assignment"><i
                class="las la-edit"></i></a>
    </li>
    <li>
        <a href="#" onclick="delete_row('{{ route('organization.assignments.destroy', $assignment->id) }}')" data-bs-custom-class="custom-tooltip"
           data-bs-toggle="tooltip" data-bs-placement="top"
           data-bs-title="{{ __('delete') }}"><i
                class="las la-times"></i></a>
    </li>
</ul>
