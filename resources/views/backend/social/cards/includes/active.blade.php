@if ($card->isActive())
<span class="badge badge-success p-1">@lang('labels.general.yes')</span>
@else
<span class="badge badge-danger p-1">@lang('labels.general.no')</span>
@endif
