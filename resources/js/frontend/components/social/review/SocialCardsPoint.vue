<template>
  <div class="jumbotron py-4 color-dark">
    <h3>
      您代表了 {{ point }} 張票，好棒！
      <button
        class="btn btn-info"
        type="button"
        data-toggle="collapse"
        data-target="#展開詳細規則"
        aria-expanded="false"
        aria-controls="展開詳細規則"
      >展開詳細規則</button>
      <button
        class="btn btn-info"
        type="button"
        data-toggle="collapse"
        data-target="#展開你與身份組的距離"
        aria-expanded="false"
        aria-controls="展開你與身份組的距離"
      >展開你與身份組的距離</button>
    </h3>
    <div class="collapse" id="展開你與身份組的距離">
      <hr />
      <h3>你與下個身份組的距離：</h3>
      <div class="flex-wrapper">
        <div class="single-chart" v-if="percentage.junior != null">
          <svg viewBox="0 0 36 36" class="circular-chart red">
            <path
              class="circle-bg"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path
              class="circle"
              :stroke-dasharray="`${percentage.junior}, 100`"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text x="18" y="18.35" class="percentage">{{ percentage.junior }}%</text>
            <text x="18" y="24.35" class="percentage-text">Junior</text>
          </svg>
        </div>

        <div class="single-chart" v-if="percentage.senior != null">
          <svg viewBox="0 0 36 36" class="circular-chart orange">
            <path
              class="circle-bg"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path
              class="circle"
              :stroke-dasharray="`${percentage.senior}, 100`"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text x="18" y="18.35" class="percentage">{{ percentage.senior }}%</text>
            <text x="18" y="24.35" class="percentage-text">Senior</text>
          </svg>
        </div>

        <div class="single-chart" v-if="percentage.expert != null">
          <svg viewBox="0 0 36 36" class="circular-chart yellow">
            <path
              class="circle-bg"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path
              class="circle"
              :stroke-dasharray="`${percentage.expert}, 100`"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text x="18" y="18.35" class="percentage">{{ percentage.expert }}%</text>
            <text x="18" y="24.35" class="percentage-text">Expert</text>
          </svg>
        </div>

        <div class="single-chart" v-if="percentage.legend != null">
          <svg viewBox="0 0 36 36" class="circular-chart green">
            <path
              class="circle-bg"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <path
              class="circle"
              :stroke-dasharray="`${percentage.legend}, 100`"
              d="M18 2.0845
                            a 15.9155 15.9155 0 0 1 0 31.831
                            a 15.9155 15.9155 0 0 1 0 -31.831"
            />
            <text x="18" y="18.35" class="percentage">{{ percentage.legend }}%</text>
            <text x="18" y="24.35" class="percentage-text">Legend</text>
          </svg>
        </div>
      </div>
    </div>
    <div class="collapse" id="展開詳細規則">
      <hr />
      <div class="card card-body">
        <p class="lead">文章審核通過規則:</p>
        <ul>
          <li>文章發表時間在 1 小時內，通過票數大於否決票數 10 票。</li>
          <li>文章發表時間在 3 小時內，通過票數大於否決票數 20 票。</li>
          <li>文章發表時間在 6 小時內，通過票數大於否決票數 30 票。</li>
          <li>文章發表時間已經超過 6 小時以上，通過票數大於否決票數 50 票。</li>
        </ul>
        <hr class="my-2" />
        <p class="lead">獎勵辦法:</p>
        <p>只要參與投票，並且達到參與數量的話，就會給予身份以資鼓勵。</p>
        <ul>
          <li>凡是使用者(User)身份，都擁有 1 票。</li>
          <li>凡是初級使用者(Junior)身份，會再附加 1 票，也就是 2 票。</li>
          <li>凡是資深使用者(Senior)身份，會再附加 1 票，也就是 3 票。</li>
          <li>凡是專家使用者(Expert)身份，會再附加 2 票，也就是 5 票。</li>
          <li>凡是傳奇使用者(Legend)身份，會再附加 3 票，也就是 8 票。</li>
        </ul>
        <hr class="my-2" />
        <h3>
          <span class="badge badge-pill badge-dark m-1" v-for="(role, index) in roles" :key="index">
            {{ role.name }}
            <br />
            + {{ role.point }} 票
          </span>
        </h3>
      </div>
    </div>
  </div>
  <!-- social cards -->
</template>

<script>
export default {
  name: "SocialCardsPoint",
  data() {
    return {
      point: 0,
      count: 0,
      roles: [],
      percentage: {
        junior: null,
        senior: null,
        expert: null,
        legend: null
      }
    };
  },
  mounted() {
    this.getPoint();
    this.getCount();
  },
  methods: {
    getPoint() {
      axios
        .get("/api/frontend/user/profile/roles")
        .then(response => {
          response.data.forEach(element => {
            if (element == "administrator")
              this.roles.push({ name: element, point: 99 });
            if (element == "junior vip")
              this.roles.push({ name: element, point: 1 });
            if (element == "senior vip")
              this.roles.push({ name: element, point: 2 });
            if (element == "expert vip")
              this.roles.push({ name: element, point: 3 });
            if (element == "legend vip")
              this.roles.push({ name: element, point: 4 });
            if (element == "junior donate")
              this.roles.push({ name: element, point: 1 });
            if (element == "senior donate")
              this.roles.push({ name: element, point: 2 });
            if (element == "expert donate")
              this.roles.push({ name: element, point: 3 });
            if (element == "legend donate")
              this.roles.push({ name: element, point: 4 });
            if (element == "junior user")
              this.roles.push({ name: element, point: 1 });
            if (element == "senior user")
              this.roles.push({ name: element, point: 1 });
            if (element == "expert user")
              this.roles.push({ name: element, point: 2 });
            if (element == "legend user")
              this.roles.push({ name: element, point: 3 });
            if (element == "junior manager")
              this.roles.push({ name: element, point: 2 });
            if (element == "senior manager")
              this.roles.push({ name: element, point: 2 });
            if (element == "expert manager")
              this.roles.push({ name: element, point: 3 });
            if (element == "legend manager")
              this.roles.push({ name: element, point: 4 });
            if (element == "user") this.roles.push({ name: element, point: 1 });
          });

          this.randerPoint();
        })
        .catch(error => console.log(error));
    },
    getCount() {
      axios
        .get("/api/frontend/user/profile/reviewCount")
        .then(response => {
          this.count = response.data.count;

          this.percentage.junior = Math.round((this.count * 100) / 200);
          this.percentage.senior = Math.round((this.count * 100) / 500);
          this.percentage.expert = Math.round((this.count * 100) / 1000);
          this.percentage.legend = Math.round((this.count * 100) / 3000);

          this.percentage.junior =
            this.percentage.junior > 100 ? 100 : this.percentage.junior;
          this.percentage.senior =
            this.percentage.senior > 100 ? 100 : this.percentage.senior;
          this.percentage.expert =
            this.percentage.expert > 100 ? 100 : this.percentage.expert;
          this.percentage.legend =
            this.percentage.legend > 100 ? 100 : this.percentage.legend;
        })
        .catch(error => console.log(error));
    },
    randerPoint() {
      this.point = 0;
      this.roles.forEach(element => {
        this.point += element.point;
      });
    }
  }
};
</script>

<style scoped>
.flex-wrapper {
  display: flex;
  flex-flow: row nowrap;
}

.single-chart {
  width: 33%;
  justify-content: space-around;
}

.circular-chart {
  display: block;
  margin: 10px auto;
  max-width: 80%;
  max-height: 250px;
}

.circle-bg {
  fill: none;
  stroke: #cacaca;
  stroke-width: 3.8;
}

.circle {
  fill: none;
  stroke-width: 2.8;
  stroke-linecap: round;
  animation: progress 1s ease-out forwards;
}

@keyframes progress {
  0% {
    stroke-dasharray: 0 100;
  }
}

.circular-chart.red .circle {
  stroke: #e76f51;
}

.circular-chart.orange .circle {
  stroke: #f4a261;
}

.circular-chart.yellow .circle {
  stroke: #e9c46a;
}

.circular-chart.green .circle {
  stroke: #2a9d8f;
}

.percentage {
  fill: #666;
  font-family: sans-serif;
  font-size: 0.5em;
  text-anchor: middle;
}

.percentage-text {
  fill: #666;
  font-family: sans-serif;
  font-size: 0.3em;
  text-anchor: middle;
}
</style>
