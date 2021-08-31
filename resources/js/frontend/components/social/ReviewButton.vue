<template>
    <div class="d-flex justify-content-center">
        <div v-if="states === 'loading'" class="spinner-border" role="states">
            <span class="sr-only">Loading...</span>
        </div>

        <div v-else-if="states === 'vote' || states === 'voting'" style="position: relative; width: 130px;">
            <button type="button"
                class="btn yes"
                @click="yesVoting()"
                :disabled="states === 'voting'">
                <div v-if="voting !== 'yes'">
                    通過
                </div>
                <div v-else>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>

            <button type="button"
                class="btn no"
                @click="noVoting()"
                :disabled="states === 'voting'">
                <div v-if="voting !== 'no'">
                    否決
                </div>
                <div v-else>
                    <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    <span class="sr-only">Loading...</span>
                </div>
            </button>
        </div>

        <div v-else-if="states === 'complete'">
            <div class="progress" style="position: relative; width: 130px; height: 48px;">
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-success"
                    role="progressbar"
                    style="width: 60%; border-style: solid none solid solid;"
                    aria-valuenow="60"
                    aria-valuemin="0"
                    aria-valuemax="100">60.0%</div>
                <div class="progress-bar progress-bar-striped progress-bar-animated bg-danger"

                    role="progressbar"
                    style="width: 40%; border-style: solid solid solid none;"
                    aria-valuenow="40"
                    aria-valuemin="0"
                    aria-valuemax="100">40.0%</div>
            </div>
        </div>

        <div v-else>
            <h1><span class="badge badge-secondary">?</span></h1>
        </div>
    </div>
</template>

<script>
export default {
    name: "ReviewButton",
    props: {
        cid: {
            type: Number,
            required: true,
        },
    },
    data() {
        return {
            states: 'loading',
            voting: null,
        }
    },
    mounted() {
        let vm = this;
        axios.get(`/api/social/cards/${this.cid}/voted`)
            .then(function (response) {
                if (response.data.haveVoted) {
                    vm.states = 'complete';
                } else {
                    vm.states = 'vote';
                }
            })
            .catch(function (error) {
                vm.states = 'error';
            });
    },
    methods: {
        yesVoting() {
            this.states = 'voting';
            this.voting = 'yes';
        },
        noVoting() {
            this.states = 'voting';
            this.voting = 'no';
        },
    },
};
</script>

<style scoped>
    .btn {
        display: inline-block;
        margin: 0px;
        padding: 2px;
        width: 60px;
        height: 48px;
        border-radius: 4px;
        color: #ffffff;
        position: relative;
        cursor: pointer;
    }
    .btn.yes {
        background-color: rgb(26, 188, 156);
        margin-right: 6px;
    }
    .btn.yes:hover {
        background-color: rgb(29, 200, 166);
    }
    .btn.no {
        background-color: rgb(216, 73, 90);
    }
    .btn.no:hover {
        background-color: rgb(231, 79, 97);
    }
</style>
