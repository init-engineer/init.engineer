<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">@lang('menus.backend.social.cards.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item"
                    href="{{ route('admin.social.cards.index') }}">@lang('menus.backend.social.cards.all')</a>
                <a class="dropdown-item"
                    href="{{ route('admin.social.cards.deactivated') }}">@lang('menus.backend.social.cards.deactivated')</a>
                <a class="dropdown-item"
                    href="{{ route('admin.social.cards.deleted') }}">@lang('menus.backend.social.cards.deleted')</a>
            </div>
        </div>
        <!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div>
    <!--btn-group-->
</li>
