<div class="text-start">
    <p>{{ __('admin_earning') }} : {{ get_price($enroll->system_commission, userCurrency()) }}</p>
    <p>{{ __('organization_earning') }} : {{ get_price($enroll->organization_commission, userCurrency()) }}</p>
</div>
