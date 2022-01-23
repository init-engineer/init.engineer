<template>
  <div>
    <img
      v-for="(image, i) in images"
      v-bind:key="i"
      :class="_class"
      :style="_style"
      :src="image"
      :width="width"
      :height="height"
      @click="index = i"
    />
    <vue-gallery-slideshow
      :images="images"
      :index="index"
      @close="index = null"
    />
  </div>
</template>

<script>
import VueGallerySlideshow from "vue-gallery-slideshow";

export default {
  name: "GallerySlideshow",
  components: {
    VueGallerySlideshow,
  },
  props: {
    src: {
      type: String,
      required: true,
    },
    width: {
      type: Number,
      required: false,
      default: 100,
    },
    height: {
      type: Number,
      required: false,
      default: 100,
    },
    _class: {
      type: String,
      required: false,
      defalut: "img-fluid rounded",
    },
    _style: {
      type: String,
      required: false,
      defalut: "",
    },
  },
  data() {
    return {
      images: [],
      index: null,
    };
  },
  mounted() {
    this.images.push(this.src);
  },
};
</script>

<style>
img {
  object-fit: cover;
  max-width: 100vw;
  max-height: 100vh;
}
.vgs__container {
  margin: 0.5rem auto 0.5rem !important;
  height: auto !important;
}
</style>
