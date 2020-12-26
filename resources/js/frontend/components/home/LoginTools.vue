<template>
  <div>
    <label class="col-label bg-color-primary color-color-primary" v-if="!login">Hi, 您還沒有登入哦</label>
    <label class="col-label bg-color-primary color-color-primary" v-if="login">Hi, {{ username }} !</label>
    <dir class="w-100 m-0 p-2 bg-color-primary text-center">
      <div class="row">
        <div class="col-12 text-left" style="padding: 0rem 1.7rem 0.4rem 1.2rem;" v-if="!login">
          <a class="btn btn-dos btn-lg btn-block my-2 px-2" href="/login">登入</a>
        </div>
        <div class="col-12 text-left" style="display: flex;" v-if="login">
          <img :src="avatar" :alt="email" class="avatar" style="position: relative;" />
          <div style="position: relative; display: grid;">
            <p class="m-0 px-1" style="font-size: 150%;">{{ username }}</p>
            <p class="m-0 px-1" style="font-size: 120%;">{{ email }}</p>
          </div>
          <div class="w-100 text-right">
              <a class="text-center btn btn-warning-bg p-2 m-0" style="border-radius: 0rem;" href="/logout">登出<br />Logout</a>
          </div>
        </div>
      </div>
    </dir>
  </div>
</template>

<script>
export default {
  name: "LoginTools",
  props: {
    login: {
      type: Boolean,
      default: false,
    },
    avatar: {
      type: String,
      default: null,
    },
    username: {
      type: String,
      default: null,
    },
    email: {
      type: String,
      default: null,
    },
  },
  data() {
    return {};
  },
  mounted() {},
  methods: {
    setSearch(value) {
      localStorage.setItem("search", value);
    },
    search() {
      let keywords = this.content.replace(" ", "+");
      switch (this.platform) {
        case "Google":
          document.location.href =
            "https://www.google.com/search?q=" + keywords;
          break;
        case "Yahoo":
          document.location.href =
            "https://tw.search.yahoo.com/search?q=" + keywords;
          break;
        case "PTT":
          document.location.href =
            "https://www.pttweb.cc/ptt-search#gsc.q=" + keywords;
          break;
        case "Stack Overflow":
          document.location.href =
            "https://stackoverflow.com/search?q=" + keywords;
          break;
      }
    },
  },
};
</script>

<style scoped>
img.avatar {
  max-width: 64px;
  max-height: 64px;
}
</style>
