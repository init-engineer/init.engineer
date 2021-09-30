@if($card->isActive())
    {{-- 啟用 --}}
    <span class='badge badge-success'>@lang('Active')</span>
@else
    {{-- 尚未啟用 --}}
    <span class='badge badge-danger'>@lang('Inactive')</span>
@endif
