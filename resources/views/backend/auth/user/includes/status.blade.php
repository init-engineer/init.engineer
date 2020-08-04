@if($user->isActive())
<a href="{{ route('admin.auth.user.mark', [$user, 0]) }}" data-toggle="tooltip" data-placement="top"
    title="@lang('buttons.backend.access.users.deactivate')" name="active_item">
    <span class='badge badge-success p-1' style="cursor:pointer">@lang('labels.general.active')</span>
</a>
@else
<a href="{{ route('admin.auth.user.mark', [$user, 1,]) }}" data-toggle="tooltip" data-placement="top"
    title="@lang('buttons.backend.access.users.activate')" name="active_item">
    <span class='badge badge-danger p-1' style="cursor:pointer">@lang('labels.general.inactive')</span>
</a>
@endif
