<template>
  <div>
    <label class="pt-2 col-label bg-color-primary color-color-primary">公告欄</label>
    <div class="w-100 mb-2 bg-color-primary overflow-auto" style="height: 24rem;">
      <div v-for="bulletin in bulletins" v-bind:key="bulletin">
        <p class="p-1 mx-2 my-0">{{ bulletin.date }}</p>
        <hr class="p-0 mx-2 my-0" style="border: 1px var(--font-primary-color) solid;">
        <p class="pt-2 mx-2 my-0 text-center"><strong>{{ bulletin.title }}</strong></p>
        <p class="pb-2 mx-2 my-0">{{ bulletin.content }}</p>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "BulletinBoard",
  data() {
    return {
        bulletins: [
            {
                date: "2021/01/16 (週六)",
                title: "更新首頁",
                content: "新增《音樂播放器》。",
            },
            {
                date: "2021/01/12 (週二)",
                title: "更新首頁",
                content: "部分區塊改為 Vue Component、新增財務狀況區塊。",
            },
            {
                date: "2021/01/04 (週一)",
                title: "更新服務",
                content: "《線上抽籤服務》新增了籤詩百科，《搜尋引擎》新增了直接搜尋或開啟新頁的選項。",
            },
            {
                date: "2020/12/30 (週三)",
                title: "新增服務",
                content: "新增了《線上抽籤服務》解決大家選擇困難症的煩惱。",
            },
            {
                date: "2020/12/27 (週日)",
                title: "更新首頁",
                content: "把首頁整個大翻新，並提供了閃亮模式、暗黑模式，",
            },
        ],
    };
  },
};
</script>
