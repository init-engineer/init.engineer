<template>
  <div class="p-2 bg-color-primary">
    <table class="table table-sm table-responsive table-hover">
      <thead>
        <tr>
          <th colspan="10" v-if="index !== null">
            <button class="btn btn-dos btn-sm m-2 p-2" @click="reset">
              返回
            </button>
          </th>
        </tr>
      </thead>
      <tbody v-if="index === null">
        <tr v-for="i in 10" v-bind:key="i">
          <th scope="col" v-for="j in 10" v-bind:key="j">
            <button
              class="btn btn-dos btn-sm m-2 p-2"
              @click="setIndex((i - 1) * 10 + j)"
            >
              第 {{ (i - 1) * 10 + j }} 籤
            </button>
          </th>
        </tr>
      </tbody>
      <tbody v-if="index !== null">
        <tr>
          <th colspan="10">
            <FortunesCards :index="index - 1"></FortunesCards>
          </th>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
import FortunesCards from "./FortunesCards.vue";

export default {
  name: "FortunesWiki",
  components: {
    FortunesCards,
  },
  data() {
    return {
      index: null,
    };
  },
  mounted() {},
  methods: {
    setIndex(value) {
      this.index = value;
    },
    reset() {
      this.index = null;
    },
  },
};
</script>

<style scoped>
th {
  padding: 0px;
}
</style>
