<template>
    <div class="social-cards">
        <vue-gallery :images="images" :index="gallery" @close="gallery = null"></vue-gallery>
        <div class="cards bg-black rounded p-5">
            <vue-content-loading v-show="!loaded.avatar" :width="100" :height="20" primary="#000000" secondary="#00FF00" :speed="1">
                <rect x="0" y="0" rx="2" ry="2" width="10" height="10" />
                <rect x="12" y="0" rx="1" ry="1" width="24" height="4" />
                <rect x="12" y="6" rx="1" ry="1" width="88" height="2" />
                <rect x="12" y="9" rx="1" ry="1" width="88" height="2" />
                <rect x="12" y="12" rx="1" ry="1" width="88" height="2" />
                <rect x="12" y="15" rx="1" ry="1" width="88" height="2" />
            </vue-content-loading>

            <div class="cards-image">
                <vue-content-loading :class="{ 'position-absolute animated fadeOut': loaded.image }" :width="100" :height="40" primary="#000000" secondary="#00FF00">
                    <rect x="20" y="0" rx="1" ry="1" width="60" height="40" />
                </vue-content-loading>
                <img v-show="loaded.image" :src="card.image" @load="loadedImage" class="img-fluid mx-auto d-block animated" :class="{ fadeIn: loaded.image }" @click="gallery = 0" style="max-height: 400px;">
            </div>
        </div>
    </div><!--container-->
</template>

<script>
    import VueGallery from 'vue-gallery';
    import VueContentLoading from 'vue-content-loading';

    export default {
        components: {
            VueGallery,
            VueContentLoading,
        },
        props: [
            'id',
        ],
        data() {
            return {
                gallery: null,
                images: [],
                card: {
                    id: null,
                    content: null,
                    image: null,
                },
                loaded: {
                    avatar: false,
                    conetns: false,
                    image: false,
                },
            }
        },
        mounted() {
            this.getSocialCard();
        },
        methods: {
            getSocialCard() {
                axios.get(`/api/frontend/social/cards/${this.id}`)
                    .then(response => (this.card = response.data.data))
                    .catch(error => (console.log(error)));
            },
            loadedImage() {
                this.images.push(this.card.image);
                this.loaded.image = true;
            },
        },
    }
</script>
