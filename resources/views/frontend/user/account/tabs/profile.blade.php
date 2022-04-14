{{-- 大頭貼 --}}
<div class="form-group row">
    <label for="avatar" class="col-sm-2 col-form-label text-md-right">@lang('Avatar')</label>
    <div class="col-sm-10">
        <img src="{{ $logged_in_user->avatar }}" class="user-profile-image rounded" />
    </div>
</div><!--form-group-->

{{-- 類型 --}}
<div class="form-group row">
    <label for="type" class="col-sm-2 col-form-label text-md-right">@lang('Type')</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="type" value="@include('backend.auth.user.includes.type', ['user' => $logged_in_user])" disabled>
    </div>
</div><!--form-group-->

{{-- 名稱 --}}
<div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label text-md-right">@lang('Name')</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="name" value="{{ $logged_in_user->name }}" disabled>
    </div>
</div><!--form-group-->

{{-- 電子郵件地址 --}}
<div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label text-md-right">@lang('E-mail Address')</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="email" value="{{ $logged_in_user->email }}" disabled>
    </div>
</div><!--form-group-->

{{-- 社群平台 --}}
@if ($logged_in_user->isSocial())
    <div class="form-group row">
        <label for="provider" class="col-sm-2 col-form-label text-md-right">@lang('Social Provider')</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="provider" value="{{ ucfirst($logged_in_user->provider) }}" disabled>
        </div>
    </div><!--form-group-->
@endif

{{-- 時區 --}}
<div class="form-group row">
    <label for="timezone" class="col-sm-2 col-form-label text-md-right">@lang('Timezone')</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="timezone" value="{{ $logged_in_user->timezone ? str_replace('_', ' ', $logged_in_user->timezone) : __('N/A') }}" disabled>
    </div>
</div><!--form-group-->

{{-- 使用者建立時間 --}}
<div class="form-group row">
    <label for="created_at" class="col-sm-2 col-form-label text-md-right">@lang('Account Created')</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="created_at" value="@displayDate($logged_in_user->created_at) ({{ $logged_in_user->created_at->diffForHumans() }})" disabled>
    </div>
</div><!--form-group-->

{{-- 最近更新時間 --}}
<div class="form-group row">
    <label for="updated_at" class="col-sm-2 col-form-label text-md-right">@lang('Last Updated')</label>
    <div class="col-sm-10">
       <input type="text" class="form-control" id="updated_at" value="@displayDate($logged_in_user->updated_at) ({{ $logged_in_user->updated_at->diffForHumans() }})" disabled>
    </div>
</div><!--form-group-->
