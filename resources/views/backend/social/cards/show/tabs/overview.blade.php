<div class="container">
    <div class="row">
        <div class="col-sm-3">
            <div class="text-center">
                <img src="{{ $card->model->getPicture() }}" class="avatar img-circle img-thumbnail"
                    style="height: 128px;width: 128px;object-fit: cover;" alt="avatar">
                <h1>{{ $card->model->name }}</h1>
                <h6>{{ $card->model->email }}</h6>
            </div>

            <hr />

            <div class="table-responsive">
                <table class="table table-hover">
                    <tr>
                        <th style="border-top: 0px;">@lang('labels.backend.access.users.tabs.content.overview.status')
                        </th>
                        <td style="border-top: 0px;">@include('backend.auth.user.includes.status', ['user' => $card->model])
                        </td>
                    </tr>

                    <tr>
                        <th style="border-top: 0px;">
                            @lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                        <td style="border-top: 0px;">@include('backend.auth.user.includes.confirm', ['user' => $card->model])
                        </td>
                    </tr>
                </table>
            </div>

            <hr />

            <div class="panel panel-default">
                <div class="panel-heading">@lang('labels.backend.access.users.table.social')</div>
                <div class="panel-body display-4">
                    @include('backend.auth.user.includes.social-buttons', ['user' => $card->model])
                </div>
            </div>

            <hr />

            <div class="panel panel-default">
                <div class="panel-heading">
                    @lang('labels.backend.access.users.tabs.content.overview.last_login_at')<br />
                    -
                    {{ $card->model->last_login_at ? timezone()->convertToLocal($card->model->last_login_at, 'Y-m-d h:i:s') : 'N/A' }}
                </div>
                <div class="panel-heading">
                    @lang('labels.backend.access.users.tabs.content.overview.last_login_ip')<br />
                    - {{ $card->model->last_login_ip ?? 'N/A' }}
                </div>
            </div>
        </div>
        <!--/col-3-->

        <div class="col-sm-9">
            <!-- Nav tabs -->
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab" href="#detail"
                        role="tab">@lang('labels.backend.social.cards.detail')</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#link"
                        role="tab">@lang('labels.backend.social.cards.link')<span
                            class="badge badge-light p-1">{{ \App\Models\Social\MediaCards::where('card_id', $card->id)->count() }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#comment"
                        role="tab">@lang('labels.backend.social.cards.comment')<span
                            class="badge badge-light p-1">{{ \App\Models\Social\Comments::where('card_id', $card->id)->count() }}</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#review"
                        role="tab">@lang('labels.backend.social.cards.review')<span
                            class="badge badge-light p-1">{{ \App\Models\Social\Review::where('card_id', $card->id)->count() }}</span></a>
                </li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div class="tab-pane active" id="detail" role="tabpanel">
                    <div class="form-group row">
                        <div class="col-12">
                            <img class="media-object img-fluid rounded w-100" data-toggle="tooltip"
                                data-placement="bottom" title="{{ $card->content }}"
                                {{-- src="{{ ($card->images->first() !== null)? $card->images->first()->getPicture() : asset('img/frontend/default-image.png') }}"
                                --}} src="{{ asset('img/frontend/default-image.png') }}" alt="{{ $card->content }}">
                            <hr />
                            <code class="read" style="white-space: pre-line; font-size: 2rem;">
                                {{ $card->content }}
                            </code>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="link" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>@lang('labels.backend.social.cards.table.socials')</th>
                                    <th>@lang('labels.backend.social.cards.table.like')</th>
                                    <th>@lang('labels.backend.social.cards.table.share')</th>
                                    <th>@lang('labels.backend.social.cards.table.active')</th>
                                    <th>@lang('labels.backend.social.cards.table.banned')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($card->medias as $media)
                                <tr>
                                    <td>
                                        <a class="btn btn-sm m-1 animated faster btn-{{ $media->social_type }}"
                                            href="{{ $media->getLink() }}" target="_blank">
                                            <p class="m-1"><i class="fas fa-share"></i> {{ $media->social_type }}
                                                {{ ($media->social_connections === 'primary') ? '主站' : '次站' }}</p>
                                        </a>
                                    </td>
                                    <td>{{ $media->num_like }}</td>
                                    <td>{{ $media->num_share }}</td>
                                    <td>{{ $media->num_like }}</td>
                                    <td>@include('backend.social.cards.show.includes.banned', ['media' => $media])</td>
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
                <div class="tab-pane" id="comment" role="tabpanel">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>-</th>
                                    <th>@lang('labels.backend.social.cards.table.user')</th>
                                    <th>@lang('labels.backend.social.cards.table.content')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($card->comments as $comment)
                                <tr>
                                    <td>
                                        <div class="comment">
                                            <div class="media-left">
                                                <img class="media-object img-fluid rounded mr-1"
                                                    src="{{ $comment->user_avatar }}"
                                                    style="max-width: 48px;max-height: 48px;"
                                                    alt="{{ $comment->user_name }}">
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="media-body p-0">
                                            <h4 class="media-heading">{{ $comment->user_name }}</h4>
                                            <p>{{ $comment->user_id }}</p>
                                        </div>
                                    </td>
                                    <td>
                                        <code class="read" style="white-space: pre-line; font-size: 1.2rem">{{ $comment->content }}</code>
                                    </td>
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
                                    <th>@lang('labels.backend.social.cards.table.user')</th>
                                    <th>@lang('labels.backend.social.cards.table.review')</th>
                                    <th>@lang('labels.backend.social.cards.table.roles')</th>
                                    <th>@lang('labels.backend.social.cards.table.last_updated')</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($card->reviews as $review)
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="media-left">
                                                <a href="{{ route('admin.auth.user.show', $review->model) }}">
                                                    <img class="media-object img-fluid rounded mr-1"
                                                    src="{{ $review->model->getPicture() ?? asset('img/frontend/default-image.png') }}"
                                                    style="max-width: 48px;max-height: 48px;"
                                                    alt="{{ $review->model->email }}">
                                                </a>
                                            </div>
                                            <div class="media-body p-0">
                                                <h4 class="media-heading">{{ $review->model->full_name }}</h4>
                                                <p>{{ $review->model->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h4>
                                            @if ($review->point > 0)
                                                <span class="badge badge-success p-1">@lang('labels.general.yes')</span>
                                            @else
                                                <span class="badge badge-danger p-1">@lang('labels.general.no')</span>
                                            @endif
                                        </h4>
                                    </td>
                                    <td>
                                        <ul>
                                            @foreach (json_decode($review->roles, true) as $role)
                                                <li><span class="badge badge-info p-1">{{ $role }}</span></li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $review->updated_at->diffForHumans() }}</td>
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
            </div>
        </div>
        <!--/tab-content-->

    </div>
    <!--/col-9-->
</div>
<!--/row-->
