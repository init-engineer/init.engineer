<template>
    <div class="social-cards">
        <vue-gallery
            :images="images"
            :index="gallery"
            @close="gallery = null" />

        <div class="cards bg-black rounded p-2">
            <div class="cards-image mb-4">
                <vue-content-loading
                    class="animated faster"
                    :class="{ 'fadeOut position-absolute': loaded.image }"
                    :width="100"
                    :height="40"
                    :speed="1"
                    primary="#333333"
                    secondary="#666666">
                    <rect x="20" y="0" rx="1" ry="1" width="60" height="40" />
                </vue-content-loading>
                <img class="rounded img-fluid mx-auto d-block animated faster" :class="{ fadeIn: loaded.image }" v-show="loaded.image" :src="image" @load="loadedImage" @click="gallery = 0" />
            </div>
            <!-- cards image -->

            <div class="cards-content mb-4">
                <vue-content-loading
                    class="animated faster"
                    :class="{ 'fadeOut position-absolute': loaded.avatar }"
                    :width="100"
                    :height="24"
                    :speed="1"
                    primary="#333333"
                    secondary="#666666">
                    <rect x="1" y="0" rx="1" ry="1" width="10" height="10" />
                    <rect x="1" y="11" rx="1" ry="1" width="10" height="2" />
                    <rect x="88" y="0" rx="1" ry="1" width="12" height="3" />
                    <rect x="12" y="6" rx="1" ry="1" width="80" height="2" />
                    <rect x="12" y="9" rx="1" ry="1" width="80" height="2" />
                    <rect x="12" y="12" rx="1" ry="1" width="80" height="2" />
                    <rect x="12" y="15" rx="1" ry="1" width="80" height="2" />
                    <rect x="12" y="18" rx="1" ry="1" width="80" height="2" />
                    <rect x="12" y="21" rx="1" ry="1" width="36" height="2" />
                </vue-content-loading>
                <div
                    class="d-flex flex-row"
                    v-show="loaded.avatar">
                    <div class="avatar text-center">
                        <img class="rounded img-fluid p-1 mb-2 animated faster" :class="{ fadeIn: loaded.avatar }" :src="profile.avatar" @load="loadedAvatar" />
                        <p class="text-white">匿名{{ profile.name }}</p>
                    </div>
                    <div class="content w-100">
                        <p class="text-right text-white mb-2">
                            <small>{{ created }}</small>
                        </p>
                        <pre
                            class="read text-white text-wrap"
                            v-html="wrapContent"></pre>
                    </div>
                </div>
            </div>
            <!-- cards content -->

            <div class="cards-links border-bottom border-white border-w-3 text-right mb-4 pb-2">
                <vue-content-loading
                    class="animated faster"
                    :class="{ 'fadeOut position-absolute': loaded.links }"
                    :width="100"
                    :height="3"
                    :speed="1"
                    primary="#333333"
                    secondary="#666666">
                    <rect x="61" y="0" rx="1" ry="1" width="9" height="3" />
                    <rect x="71" y="0" rx="1" ry="1" width="9" height="3" />
                    <rect x="81" y="0" rx="1" ry="1" width="9" height="3" />
                    <rect x="91" y="0" rx="1" ry="1" width="9" height="3" />
                </vue-content-loading>

                <a class="btn btn-sm mx-1 animated faster"
                    :class="[ 'btn-' + link.type, { fadeInUp: loaded.avatar } ]"
                    :name="`tippy-${link.type}-${link.connections}`"
                    v-for="link in links"
                    :key="link.id"
                    :href="link.url"
                    target="_blank">

                    <tippy :to="`tippy-${link.type}-${link.connections}`"
                        flip=false
                        placement="top"
                        multiple>
                        <p class="m-1"><i class="fas fa-heart"></i> {{ link.like }}</p>
                    </tippy>
                    <tippy :to="`tippy-${link.type}-${link.connections}`"
                        flip=false
                        placement="bottom"
                        multiple>
                        <p class="m-1"><i class="fas fa-share"></i> {{ link.share }}</p>
                    </tippy>
                    {{ link.type.toUpperCase() }} {{ (link.connections === 'primary') ? '主站' : '次站' }}
                </a>
            </div>
            <!-- cards links -->

            <div class="cards-comments">
                <div class="d-flex flex-row media pb-2 animated fadeInUp faster"
                    v-for="(comment, $index) in comments"
                    :key="$index">
                    <div class="avatar text-center">
                        <img class="align-self-start rounded img-fluid p-1 mb-2 animated faster" :class="{ fadeIn: loaded.avatar }" :src="comment.avatar" onerror="javascript:this.src='https://image.flaticon.com/icons/svg/675/675564.svg'" />
                        <p class="text-white">{{ comment.name }}</p>
                    </div>
                    <div class="media-body content">
                        <div class="d-flex mb-2">
                            <span class="btn btn-sm ml-1 animated fadeInUp faster" :class="'btn-' + comment.media.type">{{ comment.media.type.toUpperCase() }} {{ (comment.media.connections === 'primary') ? '主站' : '次站' }}</span>
                            <small class="ml-auto text-white">{{ comment.created }}</small>
                        </div>
                        <pre class="read text-white text-wrap" v-html="comment.content"></pre>
                    </div>
                </div>
                <!-- media -->

                <infinite-loading @infinite="infiniteHandler">
                    <div slot="spinner">
                        <vue-content-loading
                            :width="100"
                            :height="32"
                            :speed="1"
                            primary="#333333"
                            secondary="#666666">
                            <rect x="1" y="0" rx="1" ry="1" width="10" height="10" />
                            <rect x="1" y="11" rx="1" ry="1" width="10" height="2" />
                            <rect x="12" y="0" rx="1" ry="1" width="12" height="3" />
                            <rect x="88" y="0" rx="1" ry="1" width="12" height="3" />
                            <rect x="12" y="6" rx="1" ry="1" width="80" height="2" />
                            <rect x="12" y="9" rx="1" ry="1" width="80" height="2" />
                            <rect x="12" y="12" rx="1" ry="1" width="36" height="2" />
                            <rect x="12" y="17" rx="1" ry="1" width="10" height="10" />
                            <rect x="12" y="28" rx="1" ry="1" width="10" height="2" />
                            <rect x="23" y="17" rx="1" ry="1" width="12" height="3" />
                            <rect x="88" y="17" rx="1" ry="1" width="12" height="3" />
                            <rect x="23" y="23" rx="1" ry="1" width="69" height="2" />
                            <rect x="23" y="26" rx="1" ry="1" width="69" height="2" />
                            <rect x="23" y="29" rx="1" ry="1" width="36" height="2" />
                        </vue-content-loading>
                    </div>
                    <div class="text-white border-top border-white border-w-3 pt-5 pb-5" slot="no-more">沒有其他留言了。</div>
                    <div class="text-white border-top border-white border-w-3 pt-5 pb-5" slot="no-results">沒有其他留言了。</div>
                </infinite-loading>
                <!-- infinit loading -->
            </div>
            <!-- cards comments -->
        </div>
        <!-- cards -->

        <go-top bg-color="#13cf13" weight="bold" :size="60" :right="92" :bottom="24" />
        <!-- go to the top -->
    </div>
    <!-- social cards -->
</template>

<script>
import GoTop from '@inotom/vue-go-top';
import VueGallery from "vue-gallery";
import InfiniteLoading from 'vue-infinite-loading';
import VueContentLoading from "vue-content-loading";

export default {
    name: "SocialCardsShow",
    components: {
        GoTop,
        VueGallery,
        InfiniteLoading,
        VueContentLoading
    },
    props: {
        id: {
            type: String,
            required: true
        },
        content: {
            type: String,
            required: true
        },
        image: {
            type: String,
            required: true
        },
        created: {
            type: String,
            required: true
        }
    },
    data() {
        return {
            gallery: null,
            wrapContent: null,
            links: [],
            images: [],
            comments: [],
            commentsNext: `/api/frontend/social/cards/${this.id}/comments`,
            commentsPage: 1,
            profile: {
                name: null,
                avatar: null,
            },
            loaded: {
                avatar: false,
                commentsOver: false,
                image: false,
                links: false,
            },
        };
    },
    mounted() {
        this.wrapContent = this.content.replace(/\n/g, "<br />");
        this.getRandomName();
        this.getLinks();
    },
    methods: {
        getLinks() {
            axios.get(`/api/frontend/social/cards/${this.id}/links`)
                .then(
                    response => (
                        (this.links.push(...response.data.data)),
                        (this.loaded.links = true)
                    )
                )
                .catch(error => console.log(error));
        },
        infiniteHandler($state) {
            axios.get(this.commentsNext)
                .then((response) => {
                    this.comments.push(...response.data.data);
                    if (response.data.meta.pagination.links.next) {
                        this.commentsNext = response.data.meta.pagination.links.next;
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch(error => console.log(error));
        },
        getRandomName() {
            const nameList = [{
                    name: "蝙蝠",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219690.svg"
                },
                {
                    name: "青鳥",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219694.svg"
                },
                {
                    name: "鬥牛",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219696.svg"
                },
                {
                    name: "駱駝",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219698.svg"
                },
                {
                    name: "貓咪",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219700.svg"
                },
                {
                    name: "公雞",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219702.svg"
                },
                {
                    name: "牛牛",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219704.svg"
                },
                {
                    name: "鱷魚",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219706.svg"
                },
                {
                    name: "公鹿",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219707.svg"
                },
                {
                    name: "狗勾",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219709.svg"
                },
                {
                    name: "老天鵝",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219710.svg"
                },
                {
                    name: "大象",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219711.svg"
                },
                {
                    name: "狐狸",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219712.svg"
                },
                {
                    name: "長頸鹿",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219715.svg"
                },
                {
                    name: "山羊",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219718.svg"
                },
                {
                    name: "鴨子",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219720.svg"
                },
                {
                    name: "猩猩",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219723.svg"
                },
                {
                    name: "馬兒",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219724.svg"
                },
                {
                    name: "袋鼠",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219726.svg"
                },
                {
                    name: "獅子",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219730.svg"
                },
                {
                    name: "猴子",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219733.svg"
                },
                {
                    name: "麋鹿",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219736.svg"
                },
                {
                    name: "老鼠",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219739.svg"
                },
                {
                    name: "鴕鳥",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219743.svg"
                },
                {
                    name: "豬豬",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219746.svg"
                },
                {
                    name: "兔子",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219750.svg"
                },
                {
                    name: "浣熊",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219755.svg"
                },
                {
                    name: "犀牛",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219758.svg"
                },
                {
                    name: "鯊魚",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219762.svg"
                },
                {
                    name: "綿羊",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219765.svg"
                },
                {
                    name: "樹懶",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219769.svg"
                },
                {
                    name: "蛇蛇",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219773.svg"
                },
                {
                    name: "松鼠",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219777.svg"
                },
                {
                    name: "老虎",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219783.svg"
                },
                {
                    name: "火雞",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219786.svg"
                },
                {
                    name: "烏龜",
                    avatar: "https://image.flaticon.com/icons/svg/2219/2219791.svg"
                }
            ];
            this.profile = nameList[Math.floor(Math.random() * nameList.length)];
        },
        loadedAvatar() {
            this.loaded.avatar = true;
        },
        loadedImage() {
            this.images.push(this.image);
            this.loaded.image = true;
        }
    }
};
</script>
