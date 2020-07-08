@if($user->isActive())
<span class='badge badge-success p-1'>@lang('labels.general.active')</span>
@else
<span class='badge badge-danger p-1'>@lang('labels.general.inactive')</span>
@endif
