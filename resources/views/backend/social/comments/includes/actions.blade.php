@if ($comments->trashed())
    <x-utils.form-button
        :action="route('admin.social.comments.restore', $comments)"
        method="patch"
        button-class="btn btn-info btn-sm"
        icon="fas fa-sync-alt"
        name="confirm-item"
    >
        @lang('Restore')
    </x-utils.form-button>

    <x-utils.delete-button
        :href="route('admin.social.comments.permanently-delete', $comments)"
        :text="__('Permanently Delete')" />
@else
    @if (! $comments->isActive())
        <x-utils.form-button
            :action="route('admin.social.comments.mark', [$comments, 1])"
            method="patch"
            button-class="btn btn-primary btn-sm"
            icon="fas fa-sync-alt"
            name="confirm-item"
            permission="admin.social.comments.reactivate"
        >
            @lang('Reactivate')
        </x-utils.form-button>
    @endif

    <x-utils.delete-button :href="route('admin.social.comments.destroy', $comments)" />

    @if ($comments->isActive())
        <div class="dropdown d-inline-block">
            <a class="btn btn-sm btn-secondary dropdown-toggle" id="moreMenuLink" href="#" role="button" data-toggle="dropdown" data-boundary="window" aria-haspopup="true" aria-expanded="false">
                @lang('More')
            </a>

            <div class="dropdown-menu" aria-labelledby="moreMenuLink">
                <x-utils.form-button
                    :action="route('admin.social.comments.mark', [$comments, 0])"
                    method="patch"
                    name="confirm-item"
                    button-class="dropdown-item"
                    permission="admin.social.comments.deactivate"
                >
                    @lang('Deactivate')
                </x-utils.form-button>
            </div>
        </div>
    @endif
@endif
