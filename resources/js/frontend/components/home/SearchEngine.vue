<template>
  <div>
    <div class="text-center">
      <div class="switch">
        <input type="radio" id="google" value="Google" v-model="platform" @click="setSearch('Google')" hidden />
        <label for="google" class="switch switch--on">Google</label>
        <input type="radio" id="yahoo" value="Yahoo" v-model="platform" @click="setSearch('Yahoo')" hidden />
        <label for="yahoo" class="switch switch--on">Yahoo</label>
        <input type="radio" id="ptt" value="PTT" v-model="platform" @click="setSearch('PTT')" hidden />
        <label for="ptt" class="switch switch--on">PTT</label>
        <input type="radio" id="stackoverflow" value="StackOverflow" v-model="platform" @click="setSearch('StackOverflow')" hidden />
        <label for="stackoverflow" class="switch switch--on">StackOverflow</label>
      </div>
    </div>
    <div class="input-group mb-3">
      <div class="input-group-prepend">
        <span class="input-group-text bg-color-primary color-color-primary" id="basic-addon3">{{ platform }}</span>
      </div>
      <input
        type="text" class="form-control color-color-primary bg-color-secondary" v-model="content"
        :placeholder="'來跟 ' + platform + ' 說，你想要跟 ' + platform + ' 問甚麼？'"
        :aria-label="'來跟 ' + platform + ' 說，你想要跟 ' + platform + ' 問甚麼？'"
        v-on:keyup.enter="search" />
      <div class="input-group-append">
        <button class="input-group-text bg-color-primary color-color-primary dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ action }}</button>
        <div class="dropdown-menu">
          <a class="dropdown-item" @click="setAction('直接搜尋')">直接搜尋</a>
          <a class="dropdown-item" @click="setAction('開啟新頁')">開啟新頁</a>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "SearchEngine",
  data() {
    return {
      platform: "Google",
      action: "直接搜尋",
      content: null,
    };
  },
  mounted() {
    if (localStorage.getItem("search") != null) {
      this.platform = localStorage.getItem("search");
    }
    if (localStorage.getItem("action") != null) {
      this.action = localStorage.getItem("action");
    }
  },
  methods: {
    setSearch(value) {
      localStorage.setItem("search", value);
    },
    setAction(value) {
      localStorage.setItem("action", value);
      this.action = value;
    },
    search() {
      let url = this.content.replace(" ", "+");
      url = encodeURIComponent(url);
      switch (this.platform) {
        case "Google":
          url = "https://www.google.com/search?q=" + url;
          break;
        case "Yahoo":
          url = "https://tw.search.yahoo.com/search?q=" + url;
          break;
        case "PTT":
          url = "https://www.pttweb.cc/ptt-search#gsc.q=" + url;
          break;
        case "StackOverflow":
          url = "https://stackoverflow.com/search?q=" + url;
          break;
      }

      switch (this.action) {
        case '直接搜尋':
          document.location.href = url;
          break;
        case '開啟新頁':
          window.open(url, '_blank');
          break;
      }
    },
  },
};
</script>

<style scoped>
.switch {
  cursor: pointer;
  font-weight: 600;
  line-height: 1.5em;
  border-radius: 3px;
  padding: 0.125em 0.5em;
  display: inline-block;
  transition: 0.15s ease;
}
input[type="radio"]:checked + .switch {
  color: var(--font-primary-color);
  padding-left: 1em;
  padding-right: 1em;
}
input[type="radio"]:checked + .switch--on {
  color: var(--color-dark-dark);
  background-color: var(--color-success-light);
}
input[type="radio"]:checked + .switch--off {
  color: var(--color-dark-dark);
  background-color: var(--color-danger-light);
}
</style>
