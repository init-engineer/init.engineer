@if($cards->isBlockade())
    <span class='badge badge-danger'>@lang('Blockade')</span>
@else
    <span class='badge badge-success'>@lang('Unblocked')</span>
@endif
