<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.social.ads.deactivated')"
    :text="__('Deactivated Ads')"
    permission="admin.social.ads.reactivate" />

@if ($logged_in_user->hasAllAccess())
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.social.ads.deleted')" :text="__('Deleted Ads')" />
@endif
