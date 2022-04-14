<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.social.cards.deactivated')"
    :text="__('Deactivated Cards')"
    permission="admin.social.cards.reactivate" />

@if ($logged_in_user->hasAllAccess() |
     $logged_in_user->can('admin.social') ||
     $logged_in_user->can('admin.social.cards') ||
     $logged_in_user->can('admin.social.cards.list') ||
     $logged_in_user->can('admin.social.cards.deactivate') ||
     $logged_in_user->can('admin.social.cards.reactivate'))
    <x-utils.link class="c-subheader-nav-link" :href="route('admin.social.cards.deleted')" :text="__('Deleted Cards')" />
@endif
