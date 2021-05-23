@if($ads->isRender())
    <span class='badge badge-success'>@lang('Rainbow')</span>
@else
    <span class='badge badge-dark'>@lang('Grayscale')</span>
@endif
