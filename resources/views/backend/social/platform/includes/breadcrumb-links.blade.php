<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.social.platform.deactivated')"
    :text="__('Deactivated Platform')"
    permission="admin.social.platform.reactivate" />

@if ($logged_in_user->hasAllAccess() |
     $logged_in_user->can('admin.social') ||
     $logged_in_user->can('admin.social.platform') ||
     $logged_in_user->can('admin.social.platform.list') ||
     $logged_in_user->can('admin.social.platform.deactivate') ||
     $logged_in_user->can('admin.social.platform.reactivate'))
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.social.platform.deleted')" :text="__('Deleted Platform')" />
@endif
