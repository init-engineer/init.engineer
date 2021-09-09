<template>
    <div>
        <!-- 主要留言元件 -->
        <div class="content py-2">
            <div class="inputGroup">
                <img :src="picture"
                    class="rounded mx-auto text-left"
                    style="height: 64px;" />
                <div style="font-size: 18px; display: inline-block;">
                    <p class="mb-0 ml-2">{{ name }} 留下您的回覆：</p>
                </div>
                <textarea
                    class="form-control cards-editor mt-2"
                    rows="3"
                    minlength="6"
                    maxlength="4096"
                    required
                    v-model="comments"
                    placeholder="你在想什麼？"></textarea>
            </div>
            <div class="buttons text-right my-2">
                <button class="btn btn-info btn-lg"
                    @click="submit()"
                    :disabled="comments.length < 6 || status === 'submit'">
                    <div v-if="status === 'wait'">
                        送出
                    </div>
                    <div v-else>
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        <span class="sr-only">Loading...</span>
                    </div>
                </button>
            </div>
        </div>

        <!-- 假的即時渲染 -->
        <div class="media"
            v-for="(c, index) in comment"
            v-bind:key="index">
            <img class="rounded mr-2"
                style="width: 48px; height: 48px;"
                :src="c.user_avatar"
                :alt="c.user_name" />
            <div class="media-body">
                <div style="display: flow-root;">
                    <h5 class="float-left mt-0">{{ c.user_name }}</h5>
                    <p class="float-right mt-0">{{ c.created_at }}</p>
                </div>
                <p>{{ c.content }}</p>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CommentsReply",
    props: {
        cid: {
            type: Number,
            required: true,
        },
        picture: {
            type: String,
            required: true,
        },
        name: {
            type: String,
            required: true,
        },
    },
    data() {
        return {
            comments: '',
            comment: [],
            status: 'wait',
        }
    },
    methods: {
        submit() {
            let self = this;
            let data = { comments: self.comments };
            self.status = 'submit';
            axios.post(`/api/social/cards/${this.cid}/comments`, data)
                .then(function (response) {
                    self.comments = '';
                    self.status = 'wait';
                    self.comment.unshift(response.data.data);
                })
                .catch(function (error) {
                    self.status = 'wait';
                    Swal.fire(
                        '噢噗！怪怪的？',
                        '留言時發生了一些錯誤，可以的話，把這項問題拿到<a href="https://github.com/init-engineer/init.engineer"> GitHub repo </a>發個 issue 給我，謝謝你 m(_ _)m',
                        'error'
                    );
                });
        },
    },
};
</script>
