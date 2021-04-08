@switch($announcement->area)
    @case('frontend')
        <span class='badge badge-warning'>@lang('Frontend')</span>
        @break

    @case('backend')
        <span class='badge badge-danger'>@lang('Backend')</span>
        @break

    @default
        <span class='badge badge-success'>@lang('Fullstack')</span>
        @break
@endswitch
