<template>
  <div>
    <div
      class="w-100 p-2"
      style="display: flex; flex-direction: row; justify-content: center"
    >
      <button
        class="btn btn-warning-bg btn-lg m-1 px-2"
        @click="switchPages('抽籤算命')"
      >
        抽籤算命
      </button>
      <button
        class="btn btn-warning-bg btn-lg m-1 px-2"
        @click="switchPages('籤詩百科')"
      >
        籤詩百科
      </button>
    </div>
    <fortunes-tools v-if="頁面 === '抽籤算命'"></fortunes-tools>
    <fortunes-wiki v-if="頁面 === '籤詩百科'"></fortunes-wiki>
  </div>
</template>

<script>
import FortunesTools from "./FortunesTools.vue";

export default {
  name: "FortunesSwitch",
  components: {
    FortunesTools,
  },
  data() {
    return {
      頁面: "抽籤算命",
    };
  },
  methods: {
    switchPages(page) {
      this.頁面 = page;
    },
  },
};
</script>
