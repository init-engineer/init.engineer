<template>
  <div id="vote-content">
    <transition name="popup">
      <div v-if="isOpen" class="vote-list-content">
        <div class="title-content">
          <h2>群眾審核排行榜 !!!</h2>
          <h4 v-if="ranking !== -1">你的排名是第 {{ranking + 1}} 名 !</h4>
          <h4 v-else>你不再排行榜內請再接再厲</h4>
        </div>
        <ul>
          <li
            v-for="(item,index) in voteList"
            v-bind:key="item.id"
            :class="{active:item.id === id}"
          >
            <div>
              <span class="rank">{{index + 1}}</span>
              <img :src="item.picture" alt />
              <span class="name">{{item.name}}</span>
            </div>
            <span class="count">{{item.count}}</span>
          </li>
        </ul>
      </div>
    </transition>
    <button class="btn" v-on:click="toggle">純</button>
  </div>
</template>

<script>
export default {
  name: "SocialCardsReviewTop",
  props: {
    id: {
      type: Number,
      required: false,
      default: -1
    }
  },
  data() {
    return {
      voteList: [],
      isOpen: false
    };
  },
  computed: {
    ranking: function() {
      return this.voteList.findIndex(item => item.id === this.id);
    }
  },
  methods: {
    voteListData() {
      axios
        .get("./json/social/reviewTop.json")
        .then(response => {
          this.voteList = response.data;
        })
        .catch(error => console.log(error));
    },
    toggle() {
      this.isOpen = !this.isOpen;
    }
  },
  mounted() {
    this.voteListData();
  }
};
</script>

<style scoped>
#vote-content {
  position: fixed;
  display: flex;
  flex-direction: column;
  bottom: 0;
  left: 0;
  margin: 30px 30px;
}
.btn {
  cursor: pointer;
  border-radius: 50%;
  width: 60px;
  height: 60px;
  border: none;
  font-size: 25px;
  background-color: #ff6a2f;
  color: white;
  transition: 0.2s;
  outline: none;
}
.btn:hover {
  background-color: #0395b9;
}
.title-content {
  font-size: 20px;
  padding: 10px 20px;
  border-radius: 8px 8px 0 0;
  background-color: #4d4d4d;
}
.title-content h2 {
  margin: 0;
  color: white;
}
.title-content h4 {
  margin: 0;
  margin-top: 10px;
  color: white;
}
.vote-list-content {
  margin-bottom: 20px;
  transform-origin: bottom left;
}
.vote-list-content ul {
  margin: 0;
  list-style: none;
  max-height: 400px;
  overflow-y: scroll;
  padding: 0;
  background-color: #4d4d4d;
  border-radius: 0 0 8px 8px;
}
.vote-list-content ul img {
  max-width: 40px;
  margin-right: 5px;
}
.vote-list-content ul li {
  color: white;
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 5px 20px;
}
.vote-list-content ul li div {
  display: flex;
  align-items: center;
  margin-right: 5px;
  overflow: hidden;
}

.rank {
  width: 2em;
  text-align: left;
}
.name {
  max-width: 500px;
}
.vote-list-content li:nth-child(1) {
  animation: colorchange 3s linear infinite;
}
.vote-list-content li:nth-child(2) {
  background-color: #1f9db3;
}
.vote-list-content li:nth-child(3) {
  background-color: #924880;
}
.vote-list-content li:nth-child(4) {
  background-color: #dd5656;
}
.vote-list-content li:nth-child(5) {
  background-color: #4fa534;
}
.vote-list-content li.active {
  border: 3px solid rgb(218, 255, 84);
  background-image: linear-gradient(
    90deg,
    rgb(58, 180, 133),
    rgb(243, 104, 104)
  );
}
@keyframes colorchange {
  0% {
    background-color: #00f08c;
  }
  50% {
    background-color: #ff2d2d;
  }
  75% {
    background-color: #1407cf;
  }
  100% {
    background-color: #00f08c;
  }
}
.popup-enter {
  transform: scale(0);
}
.popup-enter-active {
  transition: all 0.3s ease;
}
.popup-leave-to {
  transform: scale(0);
}
.popup-leave-active {
  transition: all 0.3s ease;
}
@media screen and (max-width: 769px) {
  .name {
    max-width: 300px;
  }
}
@media screen and (max-width: 420px) {
  .name {
    max-width: 120px;
  }
}
</style>
