@if($announcement->isEnabled())
    <span class='badge badge-success'>@lang('Enabled')</span>
@else
    <span class='badge badge-danger'>@lang('Inenabled')</span>
@endif
