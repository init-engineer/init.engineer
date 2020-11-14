@extends('backend.layouts.app')

@section('title', __('labels.backend.access.users.management') . ' | ' . __('labels.backend.access.users.edit'))

@section('breadcrumb-links')
    @include('backend.auth.user.includes.breadcrumb-links')
@endsection

@section('content')
{{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->open() }}
    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-sm-5">
                    <h4 class="card-title mb-0">
                        @lang('labels.backend.access.users.management')
                        <small class="text-muted">@lang('labels.backend.access.users.edit')</small>
                    </h4>
                </div><!--col-->
            </div><!--row-->

            <hr>

            <div class="row mt-4 mb-4">
                <div class="col">
                    <div class="form-group row">
                    {{ html()->label(__('validation.attributes.backend.access.users.first_name'))->class('col-md-2 form-control-label')->for('first_name') }}

                        <div class="col-md-10">
                            {{ html()->text('first_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.first_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.last_name'))->class('col-md-2 form-control-label')->for('last_name') }}

                        <div class="col-md-10">
                            {{ html()->text('last_name')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.last_name'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('validation.attributes.backend.access.users.email'))->class('col-md-2 form-control-label')->for('email') }}

                        <div class="col-md-10">
                            {{ html()->email('email')
                                ->class('form-control')
                                ->placeholder(__('validation.attributes.backend.access.users.email'))
                                ->attribute('maxlength', 191)
                                ->required() }}
                        </div><!--col-->
                    </div><!--form-group-->

                    <div class="form-group row">
                        {{ html()->label(__('labels.backend.access.users.table.abilities'))->class('col-md-2 form-control-label') }}
                        <div class="col-md-10">
                            <p>@lang('labels.backend.access.users.table.roles')</p>
                            <div class="row no-gutters">
                                @if($roles->count())
                                    @foreach($roles as $role)
                                        <div class="col-3 border-right border-bottom p-2">
                                            <div class="checkbox d-flex align-items-center">
                                                {{ html()->label(
                                                        html()->checkbox('roles[]', in_array($role->name, $userRoles), $role->name)
                                                                ->class('switch-input')
                                                                ->id('role-'.$role->id)
                                                        . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                    ->class('switch switch-label switch-pill switch-primary mr-2 mb-0')
                                                    ->for('role-'.$role->id) }}
                                                @if($role->id != 1)
                                                    @if($role->permissions->count())
                                                        @foreach($role->permissions as $permission)
                                                            <label for="{{'role-'.$role->id}}" class="mb-0" title="{{ ucwords($permission->name) }}">{{ ucwords($role->name) }}</label>
                                                        @endforeach
                                                    @else
                                                    <label for="{{'role-'.$role->id}}" class="mb-0" title="@lang('labels.general.none')">{{ ucwords($role->name) }}</label>
                                                    @endif
                                                @else
                                                    <label for="{{'role-'.$role->id}}" class="mb-0" title="@lang('labels.backend.access.users.all_permissions')">{{ ucwords($role->name) }}</label>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <hr>
                            <p>@lang('labels.backend.access.users.table.permissions')</p>
                            <div class="row no-gutters">
                                @if($permissions->count())
                                    @foreach($permissions as $permission)
                                        <div class="col-3 border-right border-bottom p-2">
                                            <div class="checkbox d-flex align-items-center">
                                                {{ html()->label(
                                                        html()->checkbox('permissions[]', in_array($permission->name, $userPermissions), $permission->name)
                                                                ->class('switch-input')
                                                                ->id('permission-'.$permission->id)
                                                            . '<span class="switch-slider" data-checked="on" data-unchecked="off"></span>')
                                                        ->class('switch switch-label switch-pill switch-primary mr-2')
                                                    ->for('permission-'.$permission->id) }}
                                                {{ html()->label(ucwords($permission->name))->for('permission-'.$permission->id) }}
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div><!--form-group-->
                </div><!--col-->
            </div><!--row-->
        </div><!--card-body-->

        <div class="card-footer">
            <div class="row">
                <div class="col">
                    {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                </div><!--col-->

                <div class="col text-right">
                    {{ form_submit(__('buttons.general.crud.update')) }}
                </div><!--row-->
            </div><!--row-->
        </div><!--card-footer-->
    </div><!--card-->
{{ html()->closeModelForm() }}
@endsection
