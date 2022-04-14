@inject('model', '\App\Domains\Announcement\Models\Announcement')

@extends('backend.layouts.app')

@section('title', __('Update Announcement'))

@push('before-styles')
    <style>
        .table > tbody > tr > th {
            vertical-align: middle;
        }
    </style>
@endpush

@push('before-scripts')
    <script>
        window.onload = function() {
            let messageElement = document.getElementById('message');
            messageElement.onkeyup = function() {
                let messageDemoElemennts = document.getElementsByClassName("message-demo");
                for(var i=0; i<messageDemoElemennts.length; i++) {
                    messageDemoElemennts[i].innerHTML = messageElement.value;
                }
            }
        }
    </script>
@endpush

@section('content')
    <x-forms.patch :action="route('admin.announcement.update', $announcement)">
        <x-backend.card>
            <x-slot name="header">
                @lang('Update Announcement')
            </x-slot>

            <x-slot name="headerActions">
                <x-utils.link class="card-header-action" :href="route('admin.announcement.index')" :text="__('Cancel')" />
            </x-slot>

            <x-slot name="body">
                <div class="form-group row">
                    <label for="area" class="col-md-2 col-form-label">@lang('Area')</label>

                    <div class="col-md-10">
                        <select name="area" class="form-control" required>
                            <option value="all" {{ $announcement->area === null ? 'selected' : '' }}>@lang('All')</option>
                            <option value="{{ $model::AREA_FRONTEND }}" {{ $announcement->area === $model::AREA_FRONTEND ? 'selected' : '' }}>@lang('Frontend')</option>
                            <option value="{{ $model::AREA_BACKEND }}" {{ $announcement->area === $model::AREA_BACKEND ? 'selected' : '' }}>@lang('Backend')</option>
                        </select>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="message" class="col-md-2 col-form-label">@lang('Message')</label>

                    <div class="col-md-10">
                        <textarea type="message" name="message" id="message" class="form-control" placeholder="{{ __('Message') }}" required>{{ $announcement->message }}</textarea>
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="starts_at" class="col-md-2 col-form-label">@lang('Starts At')</label>

                    <div class="col-md-5">
                        <input type="date" name="starts_at_date" class="form-control" placeholder="{{ __('Starts At Date') }}" value="{{ isset($announcement->starts_at) ? $announcement->starts_at->toDateString() : null }}" />
                    </div>
                    <div class="col-md-5">
                        <input type="time" name="starts_at_time" class="form-control" placeholder="{{ __('Starts At Time') }}" value="{{ isset($announcement->starts_at) ? $announcement->starts_at->toTimeString() : null }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="ends_at" class="col-md-2 col-form-label">@lang('Ends At')</label>

                    <div class="col-md-5">
                        <input type="date" name="ends_at_date" class="form-control" placeholder="{{ __('Ends At Date') }}" value="{{ isset($announcement->ends_at) ? $announcement->ends_at->toDateString() : null }}" />
                    </div>
                    <div class="col-md-5">
                        <input type="time" name="ends_at_time" class="form-control" placeholder="{{ __('Ends At Time') }}" value="{{ isset($announcement->ends_at) ? $announcement->ends_at->toTimeString() : null }}" />
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="enabled" class="col-md-2 col-form-label">@lang('Enabled')</label>

                    <div class="col-md-10">
                        <div class="form-check">
                            <input type="checkbox"name="enabled" id="enabled" class="form-check-input" value="1" {{ old('enabled', $announcement->isEnabled()) ? 'checked' : '' }} />
                            <label for="enabled" class="check-box"></label>
                        </div><!--form-check-->
                    </div>
                </div><!--form-group-->

                <div class="form-group row">
                    <label for="type" class="col-md-2 col-form-label">@lang('Type')</label>

                    <div class="col-md-10">
                        <table class="table table-borderless table-sm">
                            <thead>
                                <tr>
                                    <th scope="col"></th>
                                    <th scope="col" style="width: 100%;"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_PRIMARY }}" {{ $announcement->type === $model::TYPE_PRIMARY ? 'checked' : '' }} />
                                            <span>@lang('Primary')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-primary m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_SECONDARY }}" {{ $announcement->type === $model::TYPE_SECONDARY ? 'checked' : '' }} />
                                            <span>@lang('Secondary')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-secondary m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_SUCCESS }}" {{ $announcement->type === $model::TYPE_SUCCESS ? 'checked' : '' }} />
                                            <span>@lang('Success')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-success m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_DANGER }}" {{ $announcement->type === $model::TYPE_DANGER ? 'checked' : '' }} />
                                            <span>@lang('Danger')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-danger m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_WARNING }}" {{ $announcement->type === $model::TYPE_WARNING ? 'checked' : '' }} />
                                            <span>@lang('Warning')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-warning m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_INFO }}" {{ $announcement->type === $model::TYPE_INFO ? 'checked' : '' }} />
                                            <span>@lang('Info')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-info m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_LIGHT }}" {{ $announcement->type === $model::TYPE_LIGHT ? 'checked' : '' }} />
                                            <span>@lang('Light')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-light m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <th scope="row">
                                        <label>
                                            <input type="radio" name="type" value="{{ $model::TYPE_DARK }}" {{ $announcement->type === $model::TYPE_DARK ? 'checked' : '' }} />
                                            <span>@lang('Dark')</span>
                                        </label>
                                    </th>
                                    <td>
                                        <div class="alert alert-dark m-1 message-demo" role="alert">
                                            Message
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div><!--form-group-->
            </x-slot>

            <x-slot name="footer">
                <button class="btn btn-sm btn-primary float-right" type="submit">@lang('Update Announcement')</button>
            </x-slot>
        </x-backend.card>
    </x-forms.patch>
@endsection
