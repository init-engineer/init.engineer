<template>
    <marquee-text class="mb-3" :repeat="10" :duration="60">
        <div class="d-flex justify-content-start">
            <div class="card bg-img-rock text-white m-2 animated fadeIn" v-for="(card, $index) in cards" :key="$index" :style="`animation-delay: ${$index * 2}00ms`">
                <div class="card-body">
                    <h5 class="card-title">
                        <img class="rounded-circle" style="max-height: 32px;max-width: 32px;" :src="card.imageUrl" />
                        {{ card.username }}
                    </h5>
                    <p class="card-text">{{ card.message }}</p>
                    <h5><span class="badge badge-success ml-2">{{ card.ipAddress }}</span></h5>
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
        MarqueeText
    },
    data() {
        return {
            cards: [
                {
                    imageUrl: "https://truth.bahamut.com.tw/s01/201901/4514c51c09d19e530dfcf7f02effffbc.JPG",
                    username: "海**豹",
                    message: "在剛剛發表了一篇廢文。",
                    ipAddress: "140.113.***.***"
                },
                {
                    imageUrl: "https://www.gravatar.com/avatar/default.jpg?s=80&d=mm&r=g",
                    username: "仁愛國小黃**昌",
                    message: "在 25 分鐘前發表了一篇廢文。",
                    ipAddress: "192.168.***.***"
                },
                {
                    imageUrl: "https://www.gravatar.com/avatar/default.jpg?s=80&d=mm&r=g",
                    username: "館**長",
                    message: "在 42 分鐘前發表了一篇廢文。",
                    ipAddress: "192.168.***.***"
                },
                {
                    imageUrl: "https://truth.bahamut.com.tw/s01/201301/4e0293916ae1023aeadbda4a9ec9b4cd.PNG",
                    username: "冬**瓜",
                    message: "在 56 分鐘前發表了一篇廢文。",
                    ipAddress: "140.116.***.***"
                },
                {
                    imageUrl: "https://pic.pimg.tw/david05tw/5abec20641dfc765087370b18583538f.jpg",
                    username: "ㄩ**ㄒ",
                    message: "在 1 小時前發表了一篇廢文。",
                    ipAddress: "140.137.***.***"
                },
                {
                    imageUrl: "https://www.gravatar.com/avatar/default.jpg?s=80&d=mm&r=g",
                    username: "陳**助",
                    message: "在 2 小時前發表了一篇廢文。",
                    ipAddress: "192.168.***.***"
                },
                {
                    imageUrl: "https://www.gravatar.com/avatar/default.jpg?s=80&d=mm&r=g",
                    username: "eav**tor",
                    message: "在 2 小時前發表了一篇廢文。",
                    ipAddress: "192.168.***.***"
                },
                {
                    imageUrl: "https://avatars.plurk.com/6820974-big17396954.jpg",
                    username: "小風**姊",
                    message: "在 4 小時前發表了一篇廢文。",
                    ipAddress: "192.168.***.***"
                },
                {
                    imageUrl: "https://www.gravatar.com/avatar/default.jpg?s=80&d=mm&r=g",
                    username: "紫色斑紋嗆辣**貓咪",
                    message: "在 5 小時前發表了一篇廢文。",
                    ipAddress: "192.168.***.***"
                },
                {
                    imageUrl: "https://i.redd.it/k1jfqj1d4la31.jpg",
                    username: "bbb***456",
                    message: "在 5 小時前發表了一篇廢文。",
                    ipAddress: "140.127.***.***"
                }
            ]
        };
    }
};
</script>
