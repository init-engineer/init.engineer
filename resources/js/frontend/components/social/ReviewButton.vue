<template>
    <!-- 載入當中 -->
    <!-- <div class="d-flex justify-content-center">
        <div class="spinner-border" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->

    <!-- 等待投票 -->
    <!-- <div style="position: relative; width: 130px;">
        <button type="button" class="btn yes">通過</button>
        <button type="button" class="btn no">否決</button>
    </div> -->

    <!-- axios -->
    <!-- <div style="position: relative; width: 130px;">
        <button type="button" class="btn yes" disabled>通過</button>
        <button type="button" class="btn no" disabled>
            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
            <span class="sr-only">Loading...</span>
        </button>
    </div> -->

    <!-- 已投票 -->
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
</template>

<script>
export default {
    name: "ReviewButton",
    data() {
        return {
            // ...
        }
    },
    mounted() {
        // ...
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
