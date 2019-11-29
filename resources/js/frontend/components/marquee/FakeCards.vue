<template>
    <marquee-text class="mb-3" :repeat="2" :duration="60">
        <div class="d-flex justify-content-start">
            <div class="card bg-img-rock text-white m-2">
                <div class="card-body">
                    <h5 class="card-title">
                        <img src="https://truth.bahamut.com.tw/s01/201901/4514c51c09d19e530dfcf7f02effffbc.JPG" class="rounded-circle" style="max-height: 32px;max-width: 32px;">
                        海**豹
                    </h5>
                    <p class="card-text">在剛剛發表了一篇廢文。</p>
                    <h5><span class="badge badge-success ml-2">140.113.***.***</span></h5>
                </div>
            </div>
            <div class="card bg-img-rock text-white m-2">
                <div class="card-body">
                    <h5 class="card-title">
                        <img src="https://truth.bahamut.com.tw/s01/201301/4e0293916ae1023aeadbda4a9ec9b4cd.PNG" class="rounded-circle" style="max-height: 32px;max-width: 32px;">
                        冬**瓜
                    </h5>
                    <p class="card-text">在 4 分鐘前發表了一篇廢文。</p>
                    <h5><span class="badge badge-success ml-2">140.116.***.***</span></h5>
                </div>
            </div>
            <div class="card bg-img-rock text-white m-2">
                <div class="card-body">
                    <h5 class="card-title">
                        <img src="https://pic.pimg.tw/david05tw/5abec20641dfc765087370b18583538f.jpg" class="rounded-circle" style="max-height: 32px;max-width: 32px;">
                        ㄩ**ㄒ
                    </h5>
                    <p class="card-text">在 12 分鐘前發表了一篇廢文。</p>
                    <h5><span class="badge badge-success ml-2">140.137.***.***</span></h5>
                </div>
            </div>
            <div class="card bg-img-rock text-white m-2">
                <div class="card-body">
                    <h5 class="card-title">
                        <img src="https://i.redd.it/k1jfqj1d4la31.jpg" class="rounded-circle" style="max-height: 32px;max-width: 32px;">
                        bbb***456
                    </h5>
                    <p class="card-text">在 21 分鐘前發表了一篇廢文。</p>
                    <h5><span class="badge badge-success ml-2">140.127.***.***</span></h5>
                </div>
            </div>
        </div>
    </marquee-text>
</template>

<script>
import MarqueeText from "vue-marquee-text-component";

export default {
    name: "FakeCards",
    components: {
        MarqueeText,
    },
}
</script>
