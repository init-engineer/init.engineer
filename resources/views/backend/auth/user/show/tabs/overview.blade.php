<div class="col">
    <div class="table-responsive">
        <table class="table table-hover">
            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.avatar')</th>
                <td><img src="{{ $user->picture }}" class="user-profile-image" /></td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.name')</th>
                <td>{{ $user->name }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.email')</th>
                <td>{{ $user->email }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.status')</th>
                <td>@include('backend.auth.user.includes.status', ['user' => $user])</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.confirmed')</th>
                <td>@include('backend.auth.user.includes.confirm', ['user' => $user])</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.timezone')</th>
                <td>{{ $user->timezone }}</td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_at')</th>
                <td>
                    @if($user->last_login_at)
                        {{ timezone()->convertToLocal($user->last_login_at) }}
                    @else
                        N/A
                    @endif
                </td>
            </tr>

            <tr>
                <th>@lang('labels.backend.access.users.tabs.content.overview.last_login_ip')</th>
                <td>{{ $user->last_login_ip ?? 'N/A' }}</td>
            </tr>

            <tr>
                <th>發表文章</th>
                <td>
                    <ul>
                        @forelse (\App\Models\Social\Cards::where('model_id', $user->id)->active()->get() as $card)
                            <li>
                                <span class="badge badge-secondary">{{ $card->created_at->diffForHumans() }}</span>
                                <p>{{ (mb_strlen($card->content, "utf-8") > 72)? mb_substr($card->content, 0, 72, "utf-8") . " ..." : $card->content }}</p>
                            </li>
                        @empty
                            <li>無</li>
                        @endforelse
                    </ul>
                </td>
            </tr>

            <tr>
                <th>已被刪除的文章</th>
                <td>
                    <ul>
                        @forelse (\App\Models\Social\Cards::where('model_id', $user->id)->where('active', 0)->get() as $card)
                            <li>
                                <span class="badge badge-secondary">{{ $card->created_at->diffForHumans() }}</span>
                                <p>
                                    {{ (mb_strlen($card->content, "utf-8") > 72)? mb_substr($card->content, 0, 72, "utf-8") . " ..." : $card->content }}
                                    <br>
                                    刪除原因: {{ (isset($card->banned_remarks))? $card->banned_remarks : '尚未填寫原因。' }}
                                </p>
                            </li>
                        @empty
                            <li>無</li>
                        @endforelse
                    </ul>
                </td>
            </tr>
        </table>
    </div>
</div><!--table-responsive-->
