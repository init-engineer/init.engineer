<template>
    <div class="jumbotron py-4">
        <h3>
            您代表了 {{ point }} 張票，好棒！
            <button class="btn btn-info" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">展開詳細規則</button>
        </h3>
        <hr>
        <h3>你與下個身份組的距離：</h3>
        <div class="flex-wrapper">
                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart orange">
                    <path class="circle-bg"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <path class="circle"
                        :stroke-dasharray="count + ', 200'"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <text x="18" y="18.35" class="percentage">{{ Math.round((count * 100) / 200) }}%</text><br />
                    <text x="18" y="24.35" class="percentage-text">Junior</text>
                    </svg>
                </div>

                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart green">
                    <path class="circle-bg"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <path class="circle"
                        :stroke-dasharray="count + ', 500'"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <text x="18" y="18.35" class="percentage">{{ Math.round((count * 100) / 500) }}%</text><br />
                    <text x="18" y="24.35" class="percentage-text">Senior</text>
                    </svg>
                </div>

                <div class="single-chart">
                    <svg viewBox="0 0 36 36" class="circular-chart blue">
                    <path class="circle-bg"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <path class="circle"
                        :stroke-dasharray="count + ', 1000'"
                        d="M18 2.0845
                        a 15.9155 15.9155 0 0 1 0 31.831
                        a 15.9155 15.9155 0 0 1 0 -31.831"
                    />
                    <text x="18" y="18.35" class="percentage">{{ Math.round((count * 100) / 1000) }}%</text><br />
                    <text x="18" y="24.35" class="percentage-text">Legend</text>
                    </svg>
                </div>
            </div>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <p class="lead">文章審核通過規則:</p>
                <ul>
                    <li>文章發表時間在 30 分鐘內，通過票數大於否決票數 5 票。</li>
                    <li>文章發表時間在 1 小時內，通過票數大於否決票數 10 票。</li>
                    <li>文章發表時間在 3 小時內，通過票數大於否決票數 20 票。</li>
                    <li>文章發表時間在 6 小時內，通過票數大於否決票數 30 票。</li>
                    <li>文章發表時間已經超過 6 小時以上，通過票數大於否決票數 50 票。</li>
                </ul>
                <hr class="my-2">
                <p class="lead">獎勵辦法:</p>
                <p>只要參與投票，並且達到參與數量的話，就會給予身份以資鼓勵。</p>
                <ul>
                    <li>凡是使用者(User)身份，都擁有 1 票。</li>
                    <li>凡是初級使用者(Junior)身份，會再附加 1 票，也就是 2 票。</li>
                    <li>凡是資深使用者(Senior)身份，會再附加 2 票，也就是 4 票。</li>
                    <li>凡是傳奇使用者(Legend)身份，目前還沒想到。</li>
                </ul>
                <hr class="my-2">
                <h3><span class="badge badge-pill badge-dark m-1" v-for="(role, index) in roles" :key="index">{{ role.name }}<br />+ {{ role.point }} 票</span></h3>
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
        };
    },
    mounted() {
        this.getPoint();
        this.getCount();
    },
    methods: {
        getPoint() {
            axios.get('/api/frontend/user/profile/roles')
                .then((response) => {
                    response.data.forEach(element => {
                        if (element == "administrator") this.roles.push({name: element, point: 99});
                        if (element == "junior vip") this.roles.push({name: element, point: 1});
                        if (element == "senior vip") this.roles.push({name: element, point: 2});
                        if (element == "junior donate") this.roles.push({name: element, point: 2});
                        if (element == "senior donate") this.roles.push({name: element, point: 4});
                        if (element == "junior user") this.roles.push({name: element, point: 1});
                        if (element == "senior user") this.roles.push({name: element, point: 2});
                        if (element == "junior manager") this.roles.push({name: element, point: 4});
                        if (element == "senior manager") this.roles.push({name: element, point: 9});
                        if (element == "user") this.roles.push({name: element, point: 1});
                    });

                    this.randerPoint();
                })
                .catch(error => console.log(error));
        },
        getCount() {
            axios.get('/api/frontend/user/profile/reviewCount')
                .then((response) => {
                    this.count = response.data.count;

                    $('.chart').easyPieChart({
                        scaleColor: "#ecf0f1",
                        lineWidth: 20,
                        lineCap: 'butt',
                        barColor: '#1abc9c',
                        trackColor:	"#ecf0f1",
                        size: 160,
                        animate: 500
                    });
                })
                .catch(error => console.log(error));
        },
        randerPoint() {
            this.point = 0;
            this.roles.forEach(element => {
                this.point += element.point;
            });
        },
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
  justify-content: space-around ;
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

.circular-chart.orange .circle {
  stroke: #ff9f00;
}

.circular-chart.green .circle {
  stroke: #4CC790;
}

.circular-chart.blue .circle {
  stroke: #3c9ee5;
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
