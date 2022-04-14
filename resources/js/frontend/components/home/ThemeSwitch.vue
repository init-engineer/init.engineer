<template>
  <div class="nav-link">
    <label class="switch">
      <input type="checkbox" v-model="checked" @click="toggleTheme" />
      <span class="slider round"></span>
    </label>
  </div>
</template>

<script>
export default {
  name: "ThemeSwitcher",
  data() {
    return {
      checked: false,
    };
  },
  mounted() {
    if (localStorage.getItem("theme") === "theme-dark") {
      this.setTheme("theme-dark");
      this.checked = false;
    } else {
      this.setTheme("theme-light");
      this.checked = true;
    }
  },
  methods: {
    setTheme(themeName) {
      localStorage.setItem("theme", themeName);
      document.documentElement.className = themeName;
    },
    toggleTheme() {
      if (localStorage.getItem("theme") === "theme-dark") {
        this.setTheme("theme-light");
      } else {
        this.setTheme("theme-dark");
      }
    },
  },
};
</script>

<style scoped>
/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 36px;
  height: 24px;
  margin-bottom: 0px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}
.slider:before {
  position: absolute;
  content: "";
  height: 24px;
  width: 24px;
  left: 0px;
  bottom: 4px;
  top: 0;
  bottom: 0;
  margin: auto 0;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  box-shadow: 0 0px 12px #2020203d;
  background: white url("https://i.ibb.co/FxzBYR9/night.png");
  background-repeat: no-repeat;
  background-position: center;
}
input:checked + .slider {
  background-color: #2196f3;
}
input:focus + .slider {
  box-shadow: 0 0 1px #2196f3;
}
input:checked + .slider:before {
  -webkit-transform: translateX(12px);
  -ms-transform: translateX(12px);
  transform: translateX(12px);
  background: white url("https://i.ibb.co/7JfqXxB/sunny.png");
  background-repeat: no-repeat;
  background-position: center;
}

/* Rounded sliders */
.slider.round {
  border-radius: 12px;
}
.slider.round:before {
  border-radius: 50%;
}
</style>
