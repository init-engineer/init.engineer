@if ($cards->trashed())
    <x-utils.form-button
        :action="route('admin.social.cards.restore', $cards)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>

    <x-utils.delete-button
        :href="route('admin.social.cards.permanently-delete', $cards)"
        :text="__('Permanently Delete')" />
@else
    <x-utils.view-button :href="route('admin.social.cards.show', $cards)" />
    <x-utils.edit-button :href="route('admin.social.cards.edit', $cards)" />

    @if (! $cards->isActive())
        <x-utils.form-button
            :action="route('admin.social.cards.mark', [$cards, 1])"
            method="patch"
            button-class="btn btn-primary btn-sm"
            icon="fas fa-sync-alt"
            name="confirm-item"
            permission="admin.social.cards.reactivate"
        >
            @lang('Reactivate')
        </x-utils.form-button>
    @endif

    <x-utils.delete-button :href="route('admin.social.cards.destroy', $cards)" />

    @if ($cards->isActive())
        <div class="dropdown d-inline-block">
            <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                @lang('More')
            </a>

            <div class="dropdown-menu" aria-labelledby="moreMenuLink">
                <x-utils.form-button
                    :action="route('admin.social.cards.platform', [$cards])"
                    method="patch"
                    name="confirm-item"
                    button-class="dropdown-item"
                >
                    @lang('Platform Publish')
                </x-utils.form-button>

                <x-utils.form-button
                    :action="route('admin.social.cards.notification', [$cards])"
                    method="patch"
                    name="confirm-item"
                    button-class="dropdown-item"
                >
                    @lang('Platform Notification')
                </x-utils.form-button>

                <x-utils.form-button
                    :action="route('admin.social.cards.mark', [$cards, 0])"
                    method="patch"
                    name="confirm-item"
                    button-class="dropdown-item"
                    permission="admin.social.cards.deactivate"
                >
                    @lang('Deactivate')
                </x-utils.form-button>
            </div>
        </div>
    @endif
@endif
