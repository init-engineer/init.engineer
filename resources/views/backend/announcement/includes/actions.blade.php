<x-utils.edit-button :href="route('admin.announcement.edit', $announcement)" />

@if (! $announcement->isEnabled())
    <x-utils.form-button
        :action="route('admin.announcement.mark', [$announcement, 1])"
        method="patch"
        button-class="btn btn-primary btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
        permission="admin.announcement.reactivate"
    >
        @lang('Reactivate')
    </x-utils.form-button>
@endif

<x-utils.delete-button :href="route('admin.announcement.destroy', $announcement)" />

<div class="dropdown d-inline-block">
    <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
        @lang('More')
    </a>

    <div class="dropdown-menu" aria-labelledby="moreMenuLink">
        <x-utils.form-button
            :action="route('admin.announcement.mark', [$announcement, 0])"
            method="patch"
            name="confirm-item"
            button-class="dropdown-item"
            permission="admin.announcement.deactivate"
        >
            @lang('Deactivate')
        </x-utils.form-button>
    </div>
</div>
