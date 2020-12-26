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
        <button class="input-group-text bg-color-primary color-color-primary" type="button" @click="search">
          <i class="fa fa-search" aria-hidden="true"></i>
        </button>
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
      content: null,
    };
  },
  mounted() {
    if (localStorage.getItem("search") != "null") {
      this.platform = localStorage.getItem("search");
    }
  },
  methods: {
    setSearch(value) {
      localStorage.setItem("search", value);
    },
    search() {
        let keywords = this.content.replace(' ', '+');
        switch (this.platform) {
            case 'Google':
                document.location.href = 'https://www.google.com/search?q=' + keywords;
                break;
            case 'Yahoo':
                document.location.href = 'https://tw.search.yahoo.com/search?q=' + keywords;
                break;
            case 'PTT':
                document.location.href = 'https://www.pttweb.cc/ptt-search#gsc.q=' + keywords;
                break;
            case 'StackOverflow':
                document.location.href = 'https://stackoverflow.com/search?q=' + keywords;
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
