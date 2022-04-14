@if($ads->isPayment())
    <span class='badge badge-success'>@lang('Payment')</span>
@else
    <span class='badge badge-danger'>@lang('Unpayment')</span>
@endif
