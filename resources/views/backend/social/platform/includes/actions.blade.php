@if ($platform->trashed())
    <x-utils.form-button
        :action="route('admin.social.platform.restore', $platform)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>

    <x-utils.delete-button
        :href="route('admin.social.platform.permanently-delete', $platform)"
        :text="__('Permanently Delete')" />
@else
    <x-utils.edit-button :href="route('admin.social.platform.edit', $platform)" />

    @if (! $platform->isActive())
        <x-utils.form-button
            :action="route('admin.social.platform.mark', [$platform, 1])"
            method="patch"
            button-class="btn btn-primary btn-sm"
            icon="fas fa-sync-alt"
            name="confirm-item"
            permission="admin.social.platform.reactivate"
        >
            @lang('Reactivate')
        </x-utils.form-button>
    @endif

    <x-utils.delete-button :href="route('admin.social.platform.destroy', $platform)" />

    @if ($platform->isActive())
        <div class="dropdown d-inline-block">
            <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                @lang('More')
            </a>

            <div class="dropdown-menu" aria-labelledby="moreMenuLink">
                <x-utils.form-button
                    :action="route('admin.social.platform.mark', [$platform, 0])"
                    method="patch"
                    name="confirm-item"
                    button-class="dropdown-item"
                    permission="admin.social.platform.deactivate"
                >
                    @lang('Deactivate')
                </x-utils.form-button>
            </div>
        </div>
    @endif
@endif
