@extends('frontend.layouts.app')

@section('title', __('Companie Viewer - :name', ['name' => $companie->name]))

@section('content')
    <div class="container">
        {{-- 頂端公司名稱、相關連結 --}}
        <div class="row pb-2">
            <div class="col-12 col-md-8 media">
                <img src="{{ ($companie->getLogo() !== null) ? $companie->getLogo() : '/img/default/512x512.png' }}" class="mr-3 rounded" alt="Logo" style="width: 48px; height: 48px;">
                <div class="media-body">
                    <h1 class="m-0">{{ $companie->name }}</h1>
                </div>
            </div>

            <div class="col-12 col-md-4">

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
                        <pre style="font-size: 16px; white-space: pre-line; color: var(--font-primary-color);">{{ $companie->description }}</pre>
                        <hr>
                        <ul class="p-0" style="list-style: none;">
                            <li>
                                <i class="fas fa-map-marker-alt px-2" style="width: 40px;"></i>
                                {{ ($companie->area !== '海外') ? '台灣 ' : '' }}{{ $companie->area }}
                            </li>
                            <li>
                                <i class="fas fa-map-marked-alt px-2" style="width: 40px;"></i>
                                {{ $companie->address }}
                            </li>
                            @if(isset($companie->scale))
                                <li>
                                    <i class="fas fa-users px-2" style="width: 40px;"></i>
                                    員工約 {{ $companie->scale }} 人
                                </li>
                            @endif
                            @if(isset($companie->capital))
                                <li>
                                    <i class="fas fa-wallet px-2" style="width: 40px;"></i>
                                    資本額 {{ $companie->capital }} 萬
                                </li>
                            @endif
                            @if(isset($companie->tax))
                                <li>
                                    <i class="fas fa-building px-2" style="width: 40px;"></i>
                                    統一編號 {{ $companie->capital }}
                                </li>
                            @endif
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
                            <h1 class="my-2" style="font-size: 32px;">{{ $key }}</h1>
                        </div>
                        <div class="card-body">
                            <pre class="card-text" style="font-size: 18px;">{{ $value }}</pre>
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
