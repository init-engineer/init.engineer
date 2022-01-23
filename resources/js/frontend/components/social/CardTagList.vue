<template>
  <div>
    <div
      class="tag-wrapper"
      v-for="(link, index) in links"
      v-bind:key="index"
      :style="'top: ' + (-160 + 40 * index) + 'px;'"
    >
      <div class="card-tag-shadow" :class="`btn-${link.type}`"></div>
      <div class="card-tag text-center" :class="`btn-${link.type}`">
        <a class="text-white text-decoration-none" :href="link.url">
          {{ link.type.toUpperCase() }}
        </a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "CardTagList",
  props: {
    cid: {
      type: Number,
      required: true,
    },
  },
  data() {
    return {
      links: [],
    };
  },
  mounted() {
    let self = this;
    axios
      .get(`/api/social/cards/${this.cid}/links`)
      .then(function (response) {
        self.links = response.data.data;
      })
      .catch(function (error) {
        Swal.fire(
          "噢噗！怪怪的？",
          '載入留言時發生了一些錯誤，可以的話，把這項問題拿到<a href="https://github.com/init-engineer/init.engineer"> GitHub repo </a>發個 issue 給我，謝謝你 m(_ _)m',
          "error"
        );
      });
  },
};
</script>
