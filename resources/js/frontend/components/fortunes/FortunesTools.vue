<template>
    <div>
        <label class="col-label bg-color-primary color-color-primary">【抽籤抽起來】</label>
        <label class="col-label bg-color-primary color-color-gray">【每日抽籤運】</label>
        <div class="w-100 m-0 p-2 bg-color-primary text-center">
            <div v-if="籤號 === null" class="descendant-main">
                <img class="descendant-C" src="https://images.669pic.com/element_min_new_pic/16/10/0/53/b5b0118a0da191f257b51d2485e6ec7b.png" v-if="求籤" />
                <img class="descendant-A" src="/img/frontend/fortunes/chim.png" v-if="求籤" />
                <img class="descendant-B" src="/img/frontend/fortunes/kauchim.png" alt="求籤筒" v-bind:class="{ 'shake-hard': !求籤 }" @click="kauchim" />

                <img class="shake-slow shake-constant shake-constant--hover" style="height: 72px; margin-top: -120px; margin-right: 120px;" src="/img/frontend/fortunes/clickme_right.png" />
                <img class="shake-slow shake-constant shake-constant--hover" style="height: 72px; margin-top: 80px;" src="/img/frontend/fortunes/clickme_left.png" />
            </div>
            <div v-if="籤號 !== null">
                <button class="btn btn-dos btn-lg btn-block my-2 px-2" @click="reset">重新抽籤</button>
                <FortuneCards :index="籤號"></FortuneCards>
            </div>
        </div>
    </div>
</template>

<script>
import FortuneCards from "./FortunesCards.vue";
export default {
  name: "FortunesTools",
  components: {
    FortuneCards,
  },
  props: {},
  data() {
    return {
      求籤: false,
      籤號: null,
    };
  },
  mounted() {},
  methods: {
    kauchim() {
      this.求籤 = true;
      let 籤號 = Math.floor(Math.random() * 100);
      Swal.fire('搖啊搖～', "抽到了！是 " + (籤號 + 1) + " 號。");
      window.setTimeout(( () => {
          this.籤號 = 籤號;
      } ), 2000);
    },
    reset() {
      this.求籤 = false;
      this.籤號 = null;
    },
  },
};
</script>

<style scoped>
div.descendant-main {
  width: 100%;
  height: 32rem;
  display: flex;
  justify-content: center;
  align-items: center;
}
div.descendant-main .descendant-A {
  height: 128px;
  top: 260px;
  position: absolute;
  animation-name: upA;
  animation-duration: 2s;
  transition-timing-function: cubic-bezier(1, 0, .5, 1);
}
div.descendant-main .descendant-B {
  height: 128px;
  position: absolute;
}
div.descendant-main .descendant-C {
  height: 192px;
  top: 176px;
  position: absolute;
  animation: upB 2s, fadein 3s, rotate 6s linear infinite;
  transition-timing-function: cubic-bezier(1, 0, .5, 1);
}
@keyframes upA {
  from{
    top: 392px;
  }
  to{
    top: 260px;
  }
}
@keyframes upB {
  from{
    top: 392px;
  }
  to{
    top: 176px;
  }
}
@keyframes fadein {
  0% {opacity: 0;}
  20% {opacity: .1;}
  40% {opacity: .3;}
  60% {opacity: .5;}
  80% {opacity: .7;}
  100% {opacity: 1;}
}
@keyframes rotate{
    from{transform: rotate(0deg)}
    to{transform: rotate(359deg)}
}
</style>
