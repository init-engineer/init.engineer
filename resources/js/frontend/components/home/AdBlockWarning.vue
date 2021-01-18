<template>
  <div v-if="block" class="alert alert-danger alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
    <h4 class="alert-heading">什麼？你居然有掛 AdBlock 來阻擋我們的廣告！</h4>
    <p>為了維持平台的營運，希望您不要使用 AdBlock 之類的軟體來封鎖本網站的廣告，在台灣靠斗內來支撐一個平台服務已經很困難了，你還掛 AdBlock 阻擋我們其他金流來源，台灣就是因為有你這種人的存在，台灣才會難以在世界上發光發熱，說實在這樣的行為很缺德，難辭其咎，你傷害的是這平台的營運，你傷害的是在乎這平台的使用者，謀的僅是你個人的利益，你忽略了我們的廣告，以此來贏得你的版面，最終你將輸了你的人生，你的人生一生都在節儉只為了撿角。</p>
    <hr />
    <p class="mb-0">當然這只是善意的提醒，你甚至可以把這個提醒給關閉，畢竟撿角只是一時，眼不見為淨。</p>
  </div>
</template>

<script>
export default {
  name: "AdBlockWarning",
  data() {
    return {
      block: false,
    };
  },
  mounted() {
    setTimeout(function () {
      if (typeof window.google_jobrunner === "undefined") {
        this.block = true;
      } else {
        this.block = false;
      }
    }, 1000);
  },
};
</script>
