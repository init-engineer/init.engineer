@if($card->isBlockade())
    {{-- 已封鎖 --}}
    <span class='badge badge-danger'>@lang('Blockade')</span>
@else
    {{-- 無封鎖 --}}
    <span class='badge badge-success'>@lang('Unblocked')</span>
@endif
