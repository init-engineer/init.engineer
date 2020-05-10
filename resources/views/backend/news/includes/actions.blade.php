@if ($news->trashed())
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.news.news_actions')">
        <a href="{{ route('admin.news.restore', $news) }}" name="confirm_item" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.news.restore_news')">
            <i class="fas fa-sync"></i>
        </a>

        <a href="{{ route('admin.news.delete-permanently', $news) }}" name="confirm_item" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="@lang('buttons.backend.news.delete_permanently')">
            <i class="fas fa-trash"></i>
        </a>
    </div>
@else
    <div class="btn-group" role="group" aria-label="@lang('labels.backend.news.news_actions')">
        <a href="{{ route('admin.news.edit', $news) }}" data-toggle="tooltip" data-placement="top" title="@lang('buttons.general.crud.edit')" class="btn btn-primary">
            <i class="fas fa-edit"></i>
        </a>

        <div class="btn-group btn-group-sm" role="group">
            <button id="newsActions" type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                @lang('labels.general.more')
            </button>
            <div class="dropdown-menu" aria-labelledby="newsActions">
                @switch($news->active)
                    @case(0)
                        <a href="{{ route('admin.news.mark', [$news, 1,]) }}" class="dropdown-item py-2">@lang('buttons.backend.access.users.activate')</a>
                    @break

                    @case(1)
                        <a href="{{ route('admin.news.mark', [$news, 0]) }}" class="dropdown-item py-2">@lang('buttons.backend.access.users.deactivate')</a>
                    @break
                @endswitch
                <a href="{{ route('admin.news.destroy', $news) }}"
                    data-method="delete"
                    data-trans-button-cancel="@lang('buttons.general.cancel')"
                    data-trans-button-confirm="@lang('buttons.general.crud.delete')"
                    data-trans-title="@lang('strings.backend.general.are_you_sure')"
                    class="dropdown-item py-2">@lang('buttons.general.crud.delete')</a>
            </div>
        </div>
    </div>
@endif
