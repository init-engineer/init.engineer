@if (! $media->isBanned())
<span class="badge badge-success p-1" data-toggle="tooltip" data-placement="bottom"
    title="{{ isset($media->banned_remarks)? $media->banned_remarks : '尚未填寫原因。' }}">@lang('labels.general.yes')</span>
@else
<span class="badge badge-danger p-1">@lang('labels.general.no')</span>
@endif
