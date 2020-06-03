<template>
    <div class="jumbotron py-4">
        <h1>您代表了 {{ point }} 張票，好棒！</h1>
        <p class="lead">文章審核通過規則:</p>
        <ul>
            <li>文章發表時間在 30 分鐘內，通過票數大於否決票數 5 票。</li>
            <li>文章發表時間在 1 小時內，通過票數大於否決票數 10 票。</li>
            <li>文章發表時間在 3 小時內，通過票數大於否決票數 20 票。</li>
            <li>文章發表時間在 6 小時內，通過票數大於否決票數 30 票。</li>
            <li>文章發表時間已經超過 6 小時以上，通過票數大於否決票數 50 票。</li>
        </ul>
        <hr class="my-2">
        <h3><span class="badge badge-pill badge-dark m-1" v-for="(role, index) in roles" :key="index">{{ role.name }}</span></h3>
    </div>
    <!-- social cards -->
</template>

<script>
export default {
    name: "SocialCardsPoint",
    data() {
        return {
            point: 0,
            roles: [],
        };
    },
    mounted() {
        this.getPoint();
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
        randerPoint() {
            this.point = 0;
            this.roles.forEach(element => {
                this.point += element.point;
            });
        },
    }
};
</script>
