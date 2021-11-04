@extends('frontend.layouts.app')

@section('title', __('Companie Update - :name', ['name' => $companie->name]))

@section('content')
    <div class="container">
        {{-- 頂端公司名稱、相關連結 --}}
        <div class="row pb-2">
            <div class="col-12 col-md-8 media">
                <img src="{{ ($companie->getLogo() !== null) ? $companie->getLogo() : '/img/default/512x512.png' }}" class="mr-3 rounded" alt="Logo" style="width: 48px; height: 48px;">
                <div class="media-body">
                    <input type="text" name="companie_name" class="form-control form-control-lg" placeholder="請輸入您的公司名稱，例如：ＯＯ股份有限公司" value="{{ old('name') ?? $companie->name }}" required />
                </div>
            </div>

            <div class="col-12 col-md-4">
                {{-- ... --}}
            </div>
        </div><!--row-->

        {{-- 橫幅、簡介、相關資訊 --}}
        <div class="row">
            <div class="col-12 col-md-8 media my-2">
                <img src="{{ ($companie->getBanner() !== null) ? $companie->getBanner() : '/img/default/1280x720.png' }}" class="w-100 rounded multi-form" alt="Banner">
            </div>

            <div class="col-12 col-md-4 my-2">
                <div class="card h-100">
                    <div class="card-body">
                        <textarea class="form-control card-text" style="font-size: 16px;" rows="3">{{ $companie->description }}</textarea>
                        <hr>
                        <ul class="p-0" style="list-style: none;">
                            <li>
                                <select class="form-control mb-2" id="companie_area" required>
                                    <option selected disabled hidden>請選擇您公司所在的區域。</option>
                                    <option value="臺北市" {{ $companie->area === '臺北市' ? 'selected' : '' }}>臺北市</option>
                                    <option value="新北市" {{ $companie->area === '新北市' ? 'selected' : '' }}>新北市</option>
                                    <option value="桃園市" {{ $companie->area === '桃園市' ? 'selected' : '' }}>桃園市</option>
                                    <option value="臺中市" {{ $companie->area === '臺中市' ? 'selected' : '' }}>臺中市</option>
                                    <option value="臺南市" {{ $companie->area === '臺南市' ? 'selected' : '' }}>臺南市</option>
                                    <option value="高雄市" {{ $companie->area === '高雄市' ? 'selected' : '' }}>高雄市</option>
                                    <option value="基隆市" {{ $companie->area === '基隆市' ? 'selected' : '' }}>基隆市</option>
                                    <option value="新竹市" {{ $companie->area === '新竹市' ? 'selected' : '' }}>新竹市</option>
                                    <option value="嘉義市" {{ $companie->area === '嘉義市' ? 'selected' : '' }}>嘉義市</option>
                                    <option value="新竹縣" {{ $companie->area === '新竹縣' ? 'selected' : '' }}>新竹縣</option>
                                    <option value="苗栗縣" {{ $companie->area === '苗栗縣' ? 'selected' : '' }}>苗栗縣</option>
                                    <option value="彰化縣" {{ $companie->area === '彰化縣' ? 'selected' : '' }}>彰化縣</option>
                                    <option value="南投縣" {{ $companie->area === '南投縣' ? 'selected' : '' }}>南投縣</option>
                                    <option value="雲林縣" {{ $companie->area === '雲林縣' ? 'selected' : '' }}>雲林縣</option>
                                    <option value="嘉義縣" {{ $companie->area === '嘉義縣' ? 'selected' : '' }}>嘉義縣</option>
                                    <option value="屏東縣" {{ $companie->area === '屏東縣' ? 'selected' : '' }}>屏東縣</option>
                                    <option value="宜蘭縣" {{ $companie->area === '宜蘭縣' ? 'selected' : '' }}>宜蘭縣</option>
                                    <option value="花蓮縣" {{ $companie->area === '花蓮縣' ? 'selected' : '' }}>花蓮縣</option>
                                    <option value="臺東縣" {{ $companie->area === '臺東縣' ? 'selected' : '' }}>臺東縣</option>
                                    <option value="澎湖縣" {{ $companie->area === '澎湖縣' ? 'selected' : '' }}>澎湖縣</option>
                                    <option value="金門縣" {{ $companie->area === '金門縣' ? 'selected' : '' }}>金門縣</option>
                                    <option value="連江縣" {{ $companie->area === '連江縣' ? 'selected' : '' }}>連江縣</option>
                                    <option value="海外" {{ $companie->area === '海外' ? 'selected' : '' }}>海外</option>
                                </select>
                            </li>
                            <li>
                                <div class="input-group input-group-sm mb-2">
                                    <input type="text" class="form-control" id="address" name="address" value="{{ $companie->address }}">
                                </div>
                            </li>
                            <li>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">員工約</span>
                                    </div>
                                    <input type="text" class="form-control" id="scale" name="scale" value="{{ $companie->scale }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">人</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">資本額</span>
                                    </div>
                                    <input type="text" class="form-control" id="capital" name="capital" value="{{ $companie->capital }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">萬</span>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="input-group input-group-sm mb-2">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text">統一編號</span>
                                    </div>
                                    <input type="text" class="form-control" id="tax" name="tax" value="{{ $companie->tax }}">
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div><!--row-->

        {{-- 中間內容 --}}
        <div class="row">
            {{-- 公司介紹 --}}
            <div class="col-12 col-md-9">
                @foreach($companie->content as $key => $value)
                    <div class="card my-4" id="{{ $key }}">
                        <div class="card-header">
                            <input type="text" name="companie_name" class="form-control" style="font-size: 32px;" placeholder="請輸入您的公司名稱，例如：ＯＯ股份有限公司" value="{{ $key }}" required />
                        </div>
                        <div class="card-body">
                            <textarea class="form-control card-text" style="font-size: 18px;" rows="3">{{ $value }}</textarea>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- 相關圖片 --}}
            <div class="col-12 col-md-3 pt-3">
                @foreach($companie->getPictures() as $picture)
                    <img class="gallery-slideshow w-100 p-2 multi-form" src="{{ $picture }}" />
                @endforeach
            </div>
        </div>

        {{-- 員工 --}}
        <div class="row">
            <div class="col-12">
                @if($companie->members()->count() !== 0)
                    {{-- ... --}}
                @endif
            </div>
        </div>

        {{-- 相關職缺 --}}
        <div class="row">
            <div class="col-12">
                <div class="card my-4">
                    <div class="card-header">
                        <h1 class="my-2" style="font-size: 32px;">公司職缺</h1>
                    </div>
                    <div class="card-body">
                        @if($companie->jobs()->count() !== 0)
                            {{-- ... --}}
                        @else
                            <p>公司目前沒有任何工作。</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div><!--container-->
@endsection
