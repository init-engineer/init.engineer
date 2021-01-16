<template>
  <div>
    <label class="col-label bg-color-primary color-color-primary">音樂播放器</label>
    <div class="w-100 mb-2 p-2 bg-color-primary">
      <iframe type="text/html" width="100%" height="100%" :src="'https://www.youtube.com/embed/' + video_id + '?autoplay=' + autoplay" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
    </div>
  </div>
</template>

<script>
export default {
  name: "MusicPlayer",
  data() {
    return {
        autoplay: 0,
        video_id: "RYhKUKzD6IQ",
    };
  },
};
</script>
