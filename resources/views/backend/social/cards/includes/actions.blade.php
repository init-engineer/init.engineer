@if ($card->trashed())
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.social.cards.card_actions')">
        <a href="{{ route('admin.social.cards.restore', $card) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.social.cards.restore_card')">
            <i class="fas fa-sync"></i>
        </a>

        <a href="{{ route('admin.social.cards.delete-permanently', $card) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.social.cards.delete_permanently')">
            <i class="fas fa-trash"></i>
        </a>
    </div>
@elseif($card->isBanned())
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.social.cards.card_actions')">
        <a href="{{ route('admin.social.cards.show', $card) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </a>

        <div class="btn-group btn-group-sm" role="group">
            <button id="cardActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('labels.general.more')
            </button>
            <div class="dropdown-menu" aria-labelledby="cardActions">
                <a href="{{ route('admin.social.cards.destroy', $card) }}"
                    data-method="delete"
                    data-trans-button-cancel="@lang('buttons.general.cancel')"
                    data-trans-button-confirm="@lang('buttons.general.crud.delete')"
                    data-trans-title="@lang('strings.backend.general.are_you_sure')"
                    class="dropdown-item">@lang('buttons.general.crud.soft_delete')</a>
            </div>
        </div>
    </div>
@else
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.social.cards.card_actions')">
        <a href="{{ route('admin.social.cards.show', $card) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.view')" class="btn btn-info">
            <i class="fas fa-eye"></i>
        </a>

        <div class="btn-group btn-group-sm" role="group">
            <button id="cardActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('labels.general.more')
            </button>
            <div class="dropdown-menu" aria-labelledby="cardActions">
                <a href="{{ route('admin.social.cards.banned', $card) }}"
                    data-method="delete"
                    data-trans-button-cancel="@lang('buttons.general.cancel')"
                    data-trans-button-confirm="@lang('buttons.general.crud.delete')"
                    data-trans-title="@lang('strings.backend.general.are_you_sure')"
                    class="dropdown-item">@lang('buttons.general.crud.banned')</a>
                <a href="{{ route('admin.social.cards.publish', $card) }}"
                    data-method="post"
                    data-trans-button-cancel="@lang('buttons.general.cancel')"
                    data-trans-button-confirm="@lang('buttons.general.crud.delete')"
                    data-trans-title="@lang('strings.backend.general.are_you_sure')"
                    class="dropdown-item">@lang('buttons.general.crud.publish')</a>
            </div>
        </div>
    </div>
@endif
