@if(isset($errors) && $errors->any())
<x-utils.alert type="danger" class="rounded m-2">
    <i class="fas fa-exclamation-triangle"></i>
    @foreach($errors->all() as $error)
    {{ $error }}<br />
    @endforeach
</x-utils.alert>
@endif

@if(session()->get('flash_success'))
<x-utils.alert type="success" class="rounded m-2">
    <i class="fas fa-check-circle"></i>
    {{ session()->get('flash_success') }}
</x-utils.alert>
@endif

@if(session()->get('flash_warning'))
<x-utils.alert type="warning" class="rounded m-2">
    <i class="fas fa-exclamation-circle"></i>
    {{ session()->get('flash_warning') }}
</x-utils.alert>
@endif

@if(session()->get('flash_info') || session()->get('flash_message'))
<x-utils.alert type="info" class="rounded m-2">
    <i class="fas fa-info-circle"></i>
    {{ session()->get('flash_info') }}
</x-utils.alert>
@endif

@if(session()->get('flash_danger'))
<x-utils.alert type="danger" class="rounded m-2">
    <i class="fas fa-exclamation-triangle"></i>
    {{ session()->get('flash_danger') }}
</x-utils.alert>
@endif

@if(session()->get('status'))
<x-utils.alert type="success" class="rounded m-2">
    <i class="fas fa-check-circle"></i>
    {{ session()->get('status') }}
</x-utils.alert>
@endif

@if(session()->get('resent'))
<x-utils.alert type="success" class="rounded m-2">
    <i class="fas fa-check-circle"></i>
    @lang('A fresh verification link has been sent to your email address.')
</x-utils.alert>
@endif

@if(session()->get('verified'))
<x-utils.alert type="success" class="rounded m-2">
    <i class="fas fa-check-circle"></i>
    @lang('Thank you for verifying your e-mail address.')
</x-utils.alert>
@endif
