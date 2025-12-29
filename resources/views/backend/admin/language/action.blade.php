<ul class="d-flex gap-30 justify-content-end">
    @if(hasPermission('language.translations.page'))
        <li><a href="{{ route('language.translations.page',['lang' => $language->id])}}"><i class="las la-language"></i></a></li>
    @endif
    @if(hasPermission('languages.edit'))
        <li><a href="javascript:void(0)" class="edit_modal"
               data-fetch_url="{{ route('languages.edit', $language->id) }}"
               data-route="{{ route('languages.update', $language->id) }}" data-modal="language"
            ><i class="las la-edit"></i></a></li>
    @endif
    @if(hasPermission('languages.destroy'))
        <li><a href="#" onclick="delete_row('{{ route('languages.destroy', $language->id) }}')" data-toggle="tooltip"
               data-original-title="{{ __('delete') }}"><i class="las la-trash-alt"></i></a></li>
    @endif
</ul>
