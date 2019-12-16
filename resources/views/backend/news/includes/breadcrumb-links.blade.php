<li class="breadcrumb-menu">
    <div class="btn-group" role="group" aria-label="Button group">
        <div class="dropdown">
            <a class="btn dropdown-toggle" href="#" role="button" id="breadcrumb-dropdown-1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">@lang('menus.backend.news.main')</a>

            <div class="dropdown-menu" aria-labelledby="breadcrumb-dropdown-1">
                <a class="dropdown-item" href="{{ route('admin.news.index') }}">@lang('menus.backend.news.all')</a>
                <a class="dropdown-item" href="{{ route('admin.news.create') }}">@lang('menus.backend.news.create')</a>
                <a class="dropdown-item" href="{{ route('admin.news.deactivated') }}">@lang('menus.backend.news.deactivated')</a>
                <a class="dropdown-item" href="{{ route('admin.news.deleted') }}">@lang('menus.backend.news.deleted')</a>
            </div>
        </div><!--dropdown-->

        <!--<a class="btn" href="#">Static Link</a>-->
    </div><!--btn-group-->
</li>
