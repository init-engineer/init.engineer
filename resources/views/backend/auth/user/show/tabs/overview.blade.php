<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <img src="{{ $user->getPicture() }}" class="avatar img-circle img-thumbnail"
                    style="height: 128px;width: 128px;object-fit: cover;" alt="avatar">
                <h1>{{ $user->name }}</h1>
                <h6>{{ $user->email }}</h6>
            </div>

            <hr />

            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th style="border-top: 0px;">@lang('labels.backend.access.users.tabs.content.overview.status')
                        </th>
                        <td style="border-top: 0px;">@include('backend.auth.user.includes.status', ['user' => $user])
                        </td>
                    </tr>

                    <tr>
                        <th style="border-top: 0px;">
                            @lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                        <td style="border-top: 0px;">@include('backend.auth.user.includes.confirm', ['user' => $user])
                        </td>
                    </tr>
                </table>
            </div>

            <hr />

            <div class="panel panel-default">
                <div class="panel-heading">@lang('labels.backend.access.users.table.social')</div>
                <div class="panel-body display-4">
                    @include('backend.auth.user.includes.social-buttons', ['user' => $user])
                </div>
            </div>

            <hr />

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('labels.backend.access.users.tabs.content.overview.last_login_at')<br />
                    -
                    {{ $user->last_login_at ? timezone()->convertToLocal($user->last_login_at, 'Y-m-d h:i:s') : 'N/A' }}
                </div>
                <div class="panel-heading">
                    @lang('labels.backend.access.users.tabs.content.overview.last_login_ip')<br />
                    - {{ $user->last_login_ip ?? 'N/A' }}
                </div>
            </div>
        </div>
        <!--/col-3-->

        <div class="col-sm-9">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#abilities"
                        role="tab">@lang('labels.backend.access.users.table.abilities')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#active"
                        role="tab">@lang('labels.backend.social.cards.active')<span
                            class="badge badge-light p-1">{{ \App\Models\Social\Cards::where('model_id', $user->id)->banned(false)->count() }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#deactivated"
                        role="tab">@lang('labels.backend.social.cards.deactivated')<span
                            class="badge badge-light p-1">{{ \App\Models\Social\Cards::where('model_id', $user->id)->banned(true)->count() }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#review"
                        role="tab">@lang('labels.backend.social.cards.table.review')<span
                            class="badge badge-light p-1">{{ \App\Models\Social\Review::where('model_id', $user->id)->count() }}</span></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="abilities" role="tabpanel">
                    {{ html()->modelForm($user, 'PATCH', route('admin.auth.user.update', $user->id))->class('form-horizontal')->open() }}
                    <div class="form-group row">
                        <div class="col-12">
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
                                        <label for="{{'role-'.$role->id}}" class="mb-0"
                                            title="{{ ucwords($permission->name) }}">{{ ucwords($role->name) }}</label>
                                        @endforeach
                                        @else
                                        <label for="{{'role-'.$role->id}}" class="mb-0"
                                            title="@lang('labels.general.none')">{{ ucwords($role->name) }}</label>
                                        @endif
                                        @else
                                        <label for="{{'role-'.$role->id}}" class="mb-0"
                                            title="@lang('labels.backend.access.users.all_permissions')">{{ ucwords($role->name) }}</label>
                                        @endif
                                    </div>
                                </div>
                                @endforeach
                                @endif
                            </div>
                            <hr />
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
                            <hr />
                        </div>

                        <div class="col">
                            {{ form_cancel(route('admin.auth.user.index'), __('buttons.general.cancel')) }}
                        </div>
                        <!--col-->

                        <div class="col text-right">
                            {{ form_submit(__('buttons.general.crud.update')) }}
                        </div>
                        <!--col-->
                    </div>
                    <!--form-group-->
                    {{ html()->closeModelForm() }}
                </div>
                <div class="tab-pane" id="active" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('labels.backend.social.cards.table.id')</th>
                                    <th>@lang('labels.backend.social.cards.table.content')</th>
                                    <th>@lang('labels.backend.social.cards.table.active')</th>
                                    <th>@lang('labels.backend.social.cards.table.socials')</th>
                                    <th>@lang('labels.backend.social.cards.table.last_updated')</th>
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (\App\Models\Social\Cards::where('model_id',
                                $user->id)->banned(false)->orderBy('id', 'desc')->get() as $card)
                                <tr>
                                    <td>
                                        <h4><span class="badge badge-dark" data-toggle="tooltip" data-placement="top"
                                                title="ID: {{ $card->id }}">#{{ app_name() . base_convert($card->id, 10, 36) }}</span>
                                        </h4>
                                    </td>
                                    <td style="max-width: 16rem;">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object img-fluid rounded mr-1" data-toggle="tooltip"
                                                    data-placement="bottom" title="{{ $card->content }}"
                                                    src="{{ $card->images->first()->getPicture() }}"
                                                    style="max-width: 128px;max-height: 128px;"
                                                    alt="{{ $card->content }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>@include('backend.social.cards.includes.active', ['card' => $card])</td>
                                    <td>@include('backend.social.cards.includes.banned', ['card' => $card])</td>
                                    <td>
                                        <ul>
                                            @forelse ($card->medias as $media)
                                            <li><span href="#" class="badge badge-light p-1">{{ $media->social_type }} |
                                                    {{ ($media->social_connections == 'primary') ? '主站' : '次站' }}</a>
                                            </li>
                                            @empty
                                            <span class="badge badge-danger p-1">NaN</span>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{ $card->updated_at->diffForHumans() }}</td>
                                    <td>@include('backend.social.cards.includes.actions', ['card' => $card])</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">NaN</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="deactivated" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('labels.backend.social.cards.table.id')</th>
                                    <th>@lang('labels.backend.social.cards.table.content')</th>
                                    <th>@lang('labels.backend.social.cards.table.active')</th>
                                    <th>@lang('labels.backend.social.cards.table.banned')</th>
                                    <th>@lang('labels.backend.social.cards.table.socials')</th>
                                    <th>@lang('labels.backend.social.cards.table.last_updated')</th>
                                    <th>@lang('labels.general.actions')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (\App\Models\Social\Cards::where('model_id',
                                $user->id)->banned(true)->orderBy('id', 'desc')->get() as $card)
                                <tr>
                                    <td>
                                        <h4><span class="badge badge-dark" data-toggle="tooltip" data-placement="top"
                                                title="ID: {{ $card->id }}">#{{ app_name() . base_convert($card->id, 10, 36) }}</span>
                                        </h4>
                                    </td>
                                    <td style="max-width: 16rem;">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object img-fluid rounded mr-1" data-toggle="tooltip"
                                                    data-placement="bottom" title="{{ $card->content }}"
                                                    src="{{ $card->images->first()->getPicture() }}"
                                                    style="max-width: 128px;max-height: 128px;"
                                                    alt="{{ $card->content }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>@include('backend.social.cards.includes.active', ['card' => $card])</td>
                                    <td>@include('backend.social.cards.includes.banned', ['card' => $card])</td>
                                    <td>
                                        <ul>
                                            @forelse ($card->medias as $media)
                                            <li><span href="#" class="badge badge-light p-1">{{ $media->social_type }} |
                                                    {{ ($media->social_connections == 'primary') ? '主站' : '次站' }}</a>
                                            </li>
                                            @empty
                                            <span class="badge badge-danger p-1">NaN</span>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{ $card->updated_at->diffForHumans() }}</td>
                                    <td>@include('backend.social.cards.includes.actions', ['card' => $card])</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="6">NaN</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="tab-pane" id="review" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('labels.backend.social.cards.table.id')</th>
                                    <th>@lang('labels.backend.social.cards.table.content')</th>
                                    <th>@lang('labels.backend.social.cards.table.active')</th>
                                    <th>@lang('labels.backend.social.cards.table.banned')</th>
                                    <th>@lang('labels.backend.social.cards.table.review')</th>
                                    <th>@lang('labels.backend.social.cards.table.socials')</th>
                                    <th>@lang('labels.backend.social.cards.table.last_updated')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse (\App\Models\Social\Review::where('model_id',
                                $user->id)->orderBy('id', 'desc')->get() as $review)
                                <tr>
                                    <td>
                                        <h4><span class="badge badge-dark" data-toggle="tooltip" data-placement="top"
                                                title="ID: {{ $review->card_id }}">#{{ app_name() . base_convert($review->card_id, 10, 36) }}</span>
                                        </h4>
                                    </td>
                                    <td style="max-width: 16rem;">
                                        <div class="media">
                                            <div class="media-left">
                                                <img class="media-object img-fluid rounded mr-1" data-toggle="tooltip"
                                                    data-placement="bottom" title="{{ $review->card->content }}"
                                                    src="{{ $review->card->images->first()->getPicture() }}"
                                                    style="max-width: 128px;max-height: 128px;"
                                                    alt="{{ $review->card->content }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>@include('backend.social.cards.includes.active', ['card' => $review->card])
                                    </td>
                                    <td>@include('backend.social.cards.includes.banned', ['card' => $review->card])
                                    </td>
                                    <td>
                                        @if ($review->point > 0)
                                        <span class="badge badge-success p-1">通過</span>
                                        @else
                                        <span class="badge badge-danger p-1">否決</span>
                                        @endif
                                    </td>
                                    <td>
                                        <ul>
                                            @forelse ($review->card->medias as $media)
                                            <li><span href="#" class="badge badge-light p-1">{{ $media->social_type }} |
                                                    {{ ($media->social_connections == 'primary') ? '主站' : '次站' }}</a>
                                            </li>
                                            @empty
                                            <span class="badge badge-danger p-1">NaN</span>
                                            @endforelse
                                        </ul>
                                    </td>
                                    <td>{{ $review->card->updated_at->diffForHumans() }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td class="text-center" colspan="7">NaN</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->
</div>
<!--/row-->
