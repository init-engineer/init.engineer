<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.social.ads.deactivated')"
    :text="__('Deactivated Ads')"
    permission="admin.social.ads.reactivate" />

@if ($logged_in_user->hasAllAccess() |
     $logged_in_user->can('admin.social') ||
     $logged_in_user->can('admin.social.ads') ||
     $logged_in_user->can('admin.social.ads.list') ||
     $logged_in_user->can('admin.social.ads.deactivate') ||
     $logged_in_user->can('admin.social.ads.reactivate'))
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.social.ads.deleted')" :text="__('Deleted Ads')" />
@endif
