<template>
  <div class="d-flex justify-content-center">
    <!-- 載入狀態 -->
    <div v-if="states === 'loading'" class="spinner-border" role="states">
      <span class="sr-only">Loading...</span>
    </div>

    <!-- 等待投票狀態、投票當中狀態 -->
    <div
      v-else-if="states === 'vote' || states === 'voting'"
      style="position: relative;"
    >
      <button
        type="button"
        class="btn yes mb-2 mx-0"
        @click="yesVoting()"
        :disabled="states === 'voting'"
      >
        <div v-if="voting !== 'yes'">通過</div>
        <div v-else>
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          <span class="sr-only">Loading...</span>
        </div>
      </button>

      <button
        type="button"
        class="btn no mb-2 mx-0"
        @click="noVoting()"
        :disabled="states === 'voting'"
      >
        <div v-if="voting !== 'no'">否決</div>
        <div v-else>
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          <span class="sr-only">Loading...</span>
        </div>
      </button>
    </div>

    <!-- 已投票狀態 -->
    <div v-else-if="states === 'complete'">
      <div class="clearfix">
        <p
          class="float-left mb-0"
          style="color: rgb(26, 188, 156)"
          v-show="voting === 'yes'"
        >
          您投了同意票
        </p>
        <p
          class="float-right mb-0"
          style="color: rgb(216, 73, 90)"
          v-show="voting === 'no'"
        >
          您投了反對票
        </p>
      </div>
      <div
        class="progress"
        style="position: relative; height: 48px;"
      >
        <div
          class="progress-bar progress-bar-striped progress-bar-animated"
          role="progressbar"
          :style="
            'width: ' +
            ((count.yes / (count.yes + count.no)) * 100).toFixed(2) +
            '%; border-style: solid none solid solid; background-color: rgb(26, 188, 156);'
          "
          :aria-valuenow="count.yes"
          :aria-valuemin="0"
          :aria-valuemax="count.yes + count.no"
        >
          {{ ((count.yes / (count.yes + count.no)) * 100).toFixed(2) }}%
        </div>
        <div
          class="progress-bar progress-bar-striped progress-bar-animated"
          role="progressbar"
          :style="
            'width: ' +
            ((count.no / (count.yes + count.no)) * 100).toFixed(2) +
            '%; border-style: solid solid solid none; background-color: rgb(216, 73, 90);'
          "
          :aria-valuenow="count.no"
          :aria-valuemin="0"
          :aria-valuemax="count.yes + count.no"
        >
          {{ ((count.no / (count.yes + count.no)) * 100).toFixed(2) }}%
        </div>
      </div>
      <div class="clearfix">
        <p class="float-left" style="color: rgb(26, 188, 156)">
          {{ count.yes }}
        </p>
        <p class="float-right" style="color: rgb(216, 73, 90)">
          {{ count.no }}
        </p>
      </div>
    </div>

    <!-- 不明不白的例外狀況 -->
    <div v-else>
      <h1><span class="badge badge-secondary">?</span></h1>
    </div>
  </div>
</template>

<script>
export default {
  name: "ReviewButton",
  props: {
    /**
     * 文章編號
     */
    cid: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      /**
       * 判斷狀態的暫存資訊
       */
      states: "loading",

      /**
       * 使用者投票的選項
       */
      voting: null,

      /**
       * 文章的投票資訊
       */
      count: {
        yes: 0,
        no: 0,
      },
    };
  },
  mounted() {
    /**
     * 抓取該篇貼文的通過、否決資訊
     */
    let self = this;
    axios
      .get(`/api/social/cards/${this.cid}/voted`)
      .then(function (response) {
        if (response.data.voted) {
          /**
           * 如果已經投票了，會獲得文章的總體資訊、投票結果
           */
          self.count.yes = response.data.count.yes;
          self.count.no = response.data.count.no;
          self.voting = response.data.selector ? "yes" : "no";
          self.states = "complete";
        } else {
          /**
           * 如果尚未投票，只會收到一個 false 的結果
           */
          self.states = "vote";
        }
      })
      .catch(function (error) {
        /**
         * 處理不明的例外錯誤
         */
        self.states = "error";
        Swal.fire(
          "噢噗！怪怪的？",
          '載入投票資訊時發生了一些錯誤，可以的話，把這項問題拿到<a href="https://github.com/init-engineer/init.engineer"> GitHub repo </a>發個 issue 給我，謝謝你 m(_ _)m',
          "error"
        );
      });
  },
  methods: {
    /**
     * 投票事件，通過
     *
     * @return void
     */
    yesVoting() {
      this.states = "voting";
      this.voting = "yes";

      let self = this;
      axios
        .get(`/api/social/cards/${this.cid}/voting/1`)
        .then(function (response) {
          self.count.yes = response.data.count.yes;
          self.count.no = response.data.count.no;
          self.states = "complete";
        })
        .catch(function (error) {
          /**
           * 處理不明的例外錯誤
           */
          self.states = "vote";
          Swal.fire(
            "噢噗！怪怪的？",
            '投票時發生了一些錯誤，可以的話，把這項問題拿到<a href="https://github.com/init-engineer/init.engineer"> GitHub repo </a>發個 issue 給我，謝謝你 m(_ _)m',
            "error"
          );
        });
    },
    /**
     * 投票事件，否決
     *
     * @return void
     */
    noVoting() {
      this.states = "voting";
      this.voting = "no";

      let self = this;
      axios
        .get(`/api/social/cards/${this.cid}/voting/0`)
        .then(function (response) {
          self.count.yes = response.data.count.yes;
          self.count.no = response.data.count.no;
          self.states = "complete";
        })
        .catch(function (error) {
          /**
           * 處理不明的例外錯誤
           */
          self.states = "vote";
          Swal.fire(
            "噢噗！怪怪的？",
            '投票時發生了一些錯誤，可以的話，把這項問題拿到<a href="https://github.com/init-engineer/init.engineer"> GitHub repo </a>發個 issue 給我，謝謝你 m(_ _)m',
            "error"
          );
        });
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
