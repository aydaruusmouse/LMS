@push('js')
<!-- sorce change for get only book and course -->
<script>
    $(document).ready(function(){
        getsourceChange();
        findActionType();  
    });

    $(document).on('change','.source', function(){
        getsourceChange();
    });
    
    $(document).on('change','.search-action-to', function(){
        findActionType()
    });

    function findActionType()
    {
        var action_type = $('.search-action-to').val();
        if(action_type =='course'){
            $('.course').show();
            $('.book').hide();
        }
        if(action_type =='book'){
            $('.book').show();
            $('.course').hide();
        }
    }

    function getsourceChange()
    {
        var source = $('#source').val();
        if(source =='custom_image'){
            $('.custom-image').show();
            $('.course').hide();
            $('.book').hide();
        }

        if(source =='course'){
            $('.course').show();
            $('.custom-image').hide();
            $('.book').hide();
        }
        if(source =='book'){
            $('.book').show();
            $('.custom-image').hide();
            $('.course').hide();
        }

    }
</script>
@endpush
