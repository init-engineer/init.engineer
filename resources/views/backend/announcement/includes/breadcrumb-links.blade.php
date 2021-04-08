<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.announcement.deactivated')"
    :text="__('Deactivated Announcements')"
    permission="admin.announcement.reactivate" />

<x-utils.link
    class="c-subheader-nav-link"
    :href="route('admin.announcement.deleted')"
    :text="__('Deleted Announcements')" />
