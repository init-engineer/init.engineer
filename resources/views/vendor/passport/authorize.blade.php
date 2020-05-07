@extends('frontend.layouts.app-clear')

@section('title', app_name() . ' | ' . __('labels.frontend.auth.authorization_box_title'))

@section('content')
    <div class="container my-5">
        <div class="row justify-content-center align-items-center">
            <div class="col col-sm-8 align-self-center">
                <label class="col-label">authorization.blade.php</label>
                <div class="card text-white bg-img-rock rounded-0 border border-w-6">
                    <div class="card-header display-4">
                        <strong>
                            @lang('labels.frontend.auth.authorization_box_title')
                        </strong>
                    </div>
                    <!--card-header-->

                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="form-group clearfix">
                                    <!-- Introduction -->
                                    <h3><strong>{{ $client->name }}</strong>正在請求訪問您<a href="{{ route('frontend.index') }}">純靠北工程師</a>帳號的權限。</h3>

                                    <!-- Scope List -->
                                    @if (count($scopes) > 0)
                                        <h3><strong>{{ $client->name }}</strong>會使用到以下權限：</h3>
                                        <ul>
                                            @foreach ($scopes as $scope)
                                                <li><h4>{{ $scope->description }}</h4></li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </div>
                                <!--form-group-->
                            </div>
                            <!--col-->
                        </div>
                        <!--row-->

                        <div class="row">
                            <div class="col-12">
                                <!-- Authorize Button -->
                                <form method="post" action="{{ route('passport.authorizations.approve') }}">
                                    @csrf

                                    <input type="hidden" name="state" value="{{ $request->state }}">
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                    <button type="submit" class="btn btn-dos btn-lg btn-block my-4">授權該應用程式</button>
                                </form>
                            </div>
                            <!--col-->

                            <div class="col-12">
                                <!-- Cancel Button -->
                                <form method="post" action="{{ route('passport.authorizations.deny') }}">
                                    @csrf
                                    @method('DELETE')

                                    <input type="hidden" name="state" value="{{ $request->state }}">
                                    <input type="hidden" name="client_id" value="{{ $client->id }}">
                                    <input type="hidden" name="auth_token" value="{{ $authToken }}">
                                    <button class="btn btn-lg btn-danger py-2 px-5">取消</button>
                                </form>
                            </div>
                            <!--col-->
                        </div>
                        <!--row-->
                    </div>
                    <!--card body-->
                </div>
                <!--card-->
            </div><!-- col-md-8 -->
        </div><!-- row -->
    </div><!--container-->

    <img class="nyan mb-5" style="margin-left: -25vw; width: 80vw; height: auto;" src="https://ziad-saab.github.io/nyan/nyan.gif">
@endsection
