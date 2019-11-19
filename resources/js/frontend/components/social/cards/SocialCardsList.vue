<template>
    <div class="row">
        <vue-gallery
            :images="images"
            :index="gallery"
            @close="gallery = null" />

        <div class="card-columns">
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

        <go-top bg-color="#4ec425" />
        <!-- go to the top -->
    </div>
    <!-- row -->
</template>

<script>
import GoTop from '@inotom/vue-go-top';
import VueGallery from "vue-gallery";
import InfiniteLoading from 'vue-infinite-loading';
import VueContentLoading from "vue-content-loading";

export default {
    name: "SocialCardsList",
    components: {
        GoTop,
        VueGallery,
        InfiniteLoading,
        VueContentLoading
    },
    data() {
        return {
            cards: [],
            images: [],
            gallery: null,
            cardsNext: `/api/frontend/social/cards`
        }
    },
    mounted() {
        this.infiniteHandler();
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
    }
};
</script>
