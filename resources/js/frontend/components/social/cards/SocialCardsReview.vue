<template>
    <div class="social-cards">
        <vue-gallery
            :images="images"
            :index="gallery"
            @close="gallery = null" />

        <div class="card-columns">
            <div v-if="cards.length === 0">
                <vue-content-loading
                    class="mx-2 mb-2"
                    :width="100"
                    :height="96"
                    :speed="1"
                    primary="#333333"
                    secondary="#666666">
                    <rect x="0" y="0" rx="2" ry="2" width="100" height="86" />
                    <rect x="0" y="88" rx="1" ry="1" width="20" height="8" />
                    <rect x="22" y="88" rx="1" ry="1" width="56" height="8" />
                    <rect x="80" y="88" rx="1" ry="1" width="20" height="8" />
                </vue-content-loading>
                <vue-content-loading
                    class="mx-2 mb-2"
                    :width="100"
                    :height="64"
                    :speed="1"
                    primary="#333333"
                    secondary="#666666">
                    <rect x="0" y="0" rx="2" ry="2" width="100" height="54" />
                    <rect x="0" y="56" rx="1" ry="1" width="20" height="8" />
                    <rect x="22" y="56" rx="1" ry="1" width="56" height="8" />
                    <rect x="80" y="56" rx="1" ry="1" width="20" height="8" />
                </vue-content-loading>
                <vue-content-loading
                    class="mx-2 mb-2"
                    :width="100"
                    :height="96"
                    :speed="1"
                    primary="#333333"
                    secondary="#666666">
                    <rect x="0" y="0" rx="2" ry="2" width="100" height="86" />
                    <rect x="0" y="88" rx="1" ry="1" width="20" height="8" />
                    <rect x="22" y="88" rx="1" ry="1" width="56" height="8" />
                    <rect x="80" y="88" rx="1" ry="1" width="20" height="8" />
                </vue-content-loading>
            </div>
            <div class="card animated fadeInUp faster"
                v-for="(card, $index) in cards"
                :key="$index">
                <img class="card-img-top img-fluid mx-auto d-block animated fadeIn faster"
                    :src="card.image"
                    @click="gallery = $index" />
                <div class="card-body py-0 px-1">
                    <div class="card-text d-flex justify-content-between">
                        <div class="p-1">#純靠北工程師{{ card.id.toString(36) }}</div>
                        <div class="p-1">{{ card.created_diff }}</div>
                        <div class="p-1"><a :href="`/cards/show/${card.id}`" class="ml-auto p-1">詳細內容</a></div>
                    </div>
                    <div class="card-text d-flex justify-content-between">
                        <div class="p-1"><a href="#" class="btn btn-success btn-block ml-auto" v-bind:class="{ disabled: card.review != 0 }" v-on:click="cardSucceeded(card.id)"><h1><span class="badge badge-light">{{ card.succeeded }}</span></h1> 通過</a></div>
                        <div class="p-1 text-success h3" v-if="card.review > 0">◀</div>
                        <div class="p-1 text-danger h3" v-if="card.review < 0">▶</div>
                        <div class="p-1"><a href="#" class="btn btn-danger btn-block ml-auto" v-bind:class="{ disabled: card.review != 0 }" v-on:click="cardFailed(card.id)"><h1><span class="badge badge-light">{{ card.failed }}</span></h1> 否決</a></div>
                    </div>
                </div>
            </div>

            <infinite-loading @infinite="infiniteHandler">
                <div slot="spinner">
                    <vue-content-loading
                        class="mx-2 mb-2"
                        :width="100"
                        :height="96"
                        :speed="1"
                        primary="#333333"
                        secondary="#666666">
                        <rect x="0" y="0" rx="2" ry="2" width="100" height="86" />
                        <rect x="0" y="88" rx="1" ry="1" width="20" height="8" />
                        <rect x="22" y="88" rx="1" ry="1" width="56" height="8" />
                        <rect x="80" y="88" rx="1" ry="1" width="20" height="8" />
                    </vue-content-loading>
                    <vue-content-loading
                        class="mx-2 mb-2"
                        :width="100"
                        :height="64"
                        :speed="1"
                        primary="#333333"
                        secondary="#666666">
                        <rect x="0" y="0" rx="2" ry="2" width="100" height="54" />
                        <rect x="0" y="56" rx="1" ry="1" width="20" height="8" />
                        <rect x="22" y="56" rx="1" ry="1" width="56" height="8" />
                        <rect x="80" y="56" rx="1" ry="1" width="20" height="8" />
                    </vue-content-loading>
                    <vue-content-loading
                        class="mx-2 mb-2"
                        :width="100"
                        :height="96"
                        :speed="1"
                        primary="#333333"
                        secondary="#666666">
                        <rect x="0" y="0" rx="2" ry="2" width="100" height="86" />
                        <rect x="0" y="88" rx="1" ry="1" width="20" height="8" />
                        <rect x="22" y="88" rx="1" ry="1" width="56" height="8" />
                        <rect x="80" y="88" rx="1" ry="1" width="20" height="8" />
                    </vue-content-loading>
                </div>
                <div class="text-white border-top border-white border-w-3 pt-5 pb-5" slot="no-more">沒有其他文章了。</div>
                <div class="text-white border-top border-white border-w-3 pt-5 pb-5" slot="no-results">沒有其他文章了。</div>
            </infinite-loading>
        </div>
        <!-- card-columns -->

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
    name: "SocialCardsReview",
    components: {
        GoTop,
        VueGallery,
        InfiniteLoading,
        VueContentLoading
    },
    data() {
        return {
            timerCount: 0,
            cards: [],
            images: [],
            gallery: null,
            cardsNext: `/api/frontend/social/cards/token/review`
        };
    },
    created() {
        this.timer();
    },
    methods: {
        infiniteHandler($state) {
            axios.get(this.cardsNext)
                .then((response) => {
                    let cards = response.data.data;
                    cards.forEach(element => {
                        this.images.push(element.image);
                    });
                    this.cards.push(...cards);
                    if (response.data.meta.pagination.links.next) {
                        this.cardsNext = response.data.meta.pagination.links.next;
                        $state.loaded();
                    } else {
                        $state.complete();
                    }
                })
                .catch(error => console.log(error));
        },
        cardSucceeded(id) {
            axios.get(`/api/frontend/social/cards/token/review/${id}/succeeded`)
                .then((response) => {
                    let card = response.data.data;
                    this.cards.find(x => x.id === card.id).succeeded = card.succeeded;
                    this.cards.find(x => x.id === card.id).review = 1;
                })
                .catch(error => console.log(error));
        },
        cardFailed(id) {
            axios.get(`/api/frontend/social/cards/token/review/${id}/failed`)
                .then((response) => {
                    let card = response.data.data;
                    this.cards.find(x => x.id === card.id).failed = card.failed;
                    this.cards.find(x => x.id === card.id).review = -1;
                })
                .catch(error => console.log(error));
        },
        reloadData() {
            axios.get(this.cardsNext)
                .then((response) => {
                    let cards = response.data.data;
                    cards.forEach(element => {
                        const _image = this.cards.find(x => x.id === element.id)
                        if (_image === undefined)
                        {
                            this.images.unshift(element.image);
                            this.cards.unshift(element);
                        }
                    });
                })
                .catch(error => console.log(error));
        },
        timer() {
            return setTimeout(() => {
                this.reloadData();
                this.timerCount += 1;
            }, 60000);
        },
    },
    watch: {
        timerCount() {
            this.timer();
        }
    },
    destroyed() {
        clearTimeout(this.timer);
    },
};
</script>
