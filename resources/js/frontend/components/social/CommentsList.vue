<template>
    <div>
        <div class="media"
            v-for="(comment, index) in comments"
            v-bind:key="index">
            <img class="rounded mr-2"
                style="width: 48px; height: 48px;"
                :src="comment.user_avatar"
                :alt="comment.user_name" />
            <div class="media-body">
                <div style="display: flow-root;">
                    <h5 class="float-left mt-0">{{ comment.user_name }}</h5>
                    <p class="float-right mt-0">{{ comment.created_at }}</p>
                </div>
                <p>{{ comment.content }}</p>
                <div class="media mt-2"
                    v-for="(reply, rindex) in comment.replys"
                    v-bind:key="rindex">
                    <img class="rounded mr-2"
                        style="width: 48px; height: 48px;"
                        :src="reply.user_avatar"
                        :alt="reply.user_name" />
                    <div class="media-body">
                        <div style="display: flow-root;">
                            <h5 class="float-left mt-0">{{ reply.user_name }}</h5>
                            <p class="float-right mt-0">{{ reply.created_at }}</p>
                        </div>
                        <p>{{ reply.content }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-center py-4">
            <!-- 載入當中 -->
            <h4 v-if="comments.length === 0 && meta.last_page === null">Loading ...</h4>
            <!-- 可以瀏覽更多留言 -->
            <button v-if="last_page !== null && meta.current_page < meta.last_page" @click="nextPage()">瀏覽更多留言</button>
            <!-- 無法瀏覽更多留言 -->
            <h4 v-if="last_page !== null && meta.current_page === meta.last_page">目前沒有更多留言了</h4>
        </div>
    </div>
</template>

<script>
export default {
    name: "CommentsList",
    props: {
        cid: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            meta: {
                current_page: 0,
                last_page: null,
            },
            comments: [],
        }
    },
    mounted() {
        this.nextPage();
    },
    methods: {
        nextPage() {
            let vm = this;
            axios.get(`/api/social/cards/${this.cid}/comments?page=${this.meta.current_page + 1}`)
                .then(function (response) {
                    vm.meta.current_page = response.data.meta.current_page;
                    vm.meta.last_page = response.data.meta.last_page;
                    vm.comments = vm.comments.concat(response.data.data);
                })
                .catch(function (error) {
                    // 需要有個 Error 提示訊息
                });
        },
    },
};
</script>
