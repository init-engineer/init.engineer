<template>
  <div v-if="block && !close" class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close" @click="adclose()">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading">什麼？你居然有掛 AdBlock 來阻擋我們的廣告！</h4>
    <p>為了維持平台的營運，希望您不要使用 AdBlock 之類的軟體來封鎖本網站的廣告。<br />但我們知道大家都討厭廣告，所以也寫了一個很方便的功能，就是如果你關閉了這則通知，那它今後就不會再跳出來煩你了。</p>
  </div>
</template>

<script>
export default {
  name: "AdBlockWarning",
  data() {
    return {
      block: false,
      close: false,
    };
  },
  mounted() {
    if (localStorage.getItem("ad-block-warning-close") != null) {
      this.close = localStorage.getItem("ad-block-warning-close");
    }

    let vm = this;
    setTimeout(function () {
      if (typeof window.google_ad_modifications === "undefined") {
        vm.block = true;
      } else {
        vm.block = false;
      }
    }, 1000);
  },
  methods: {
    adclose() {
      localStorage.setItem("ad-block-warning-close", true);
      this.close = true;
    },
  },
};
</script>
