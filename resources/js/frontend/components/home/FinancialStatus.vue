<template>
  <div class="pb-2">
    <label class="pt-2 col-label bg-color-primary color-color-primary"
      >財務狀況</label
    >
    <div class="w-100 mb-2 p-2 bg-color-primary">
      <p class="text-center color-color-primary">【各項基金】</p>
      <div
        class="w-100 bg-color-primary mb-2 color-color-primary"
        v-for="基金 in 基金s"
        v-bind:key="基金.標題"
      >
        <p class="mb-0 text-center">
          <strong>{{ 基金.標題 }}</strong>
        </p>
        <div class="progress" style="height: 16px">
          <div
            class="progress-bar progress-bar-striped progress-bar-animated"
            :class="基金.顏色"
            role="progressbar"
            :aria-valuenow="基金.金額.百分比"
            aria-valuemin="0"
            aria-valuemax="100"
            :style="'width:' + 基金.金額.百分比 + '%'"
          ></div>
        </div>
        <div
          class="text-center text-dark"
          role="progressbar"
          style="width: 100%; height: 16px; margin-top: -18px"
        >
          $ {{ 基金.金額.目前.toLocaleString("en-US") }} ({{
            基金.金額.百分比
          }}%)
        </div>
        <div class="row">
          <div class="col-4 text-left">
            <p class="mb-0">$ 0</p>
          </div>
          <div class="col-8 text-right">
            <p class="mb-0">$ {{ 基金.金額.達標.toLocaleString("en-US") }}</p>
          </div>
        </div>
      </div>

      <div class="text-center">
        <p class="color-color-primary">
          希望標註一下您所想贊助的基金選項，若無標註預設將入款至頂端項目。
        </p>
        <a class="btn btn-success" href="https://p.ecpay.com.tw/1ADBA06"
          >單筆小額贊助</a
        >
        <a class="btn btn-success" href="https://p.ecpay.com.tw/3D1AF5E"
          >定期定額贊助</a
        >
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "FinancialStatus",
  data() {
    return {
      基金s: [
        {
          標題: "2021 年 伺服器 固定成本",
          顏色: "bg-primary",
          金額: {
            目前: 7401,
            達標: 10308,
            百分比: 0.0,
          },
        },
        {
          標題: "2021 年 伺服器 設備基金",
          顏色: "bg-primary",
          金額: {
            目前: 0,
            達標: 12000,
            百分比: 0.0,
          },
        },
        {
          標題: "你斗內，我穿毛，站上研討會！",
          顏色: "bg-warning",
          金額: {
            目前: 1069,
            達標: 60000,
            百分比: 0.0,
          },
        },
      ],
    };
  },
  mounted() {
    this.基金s.forEach((element) => {
      element.金額.百分比 = (
        (element.金額.目前 / element.金額.達標) *
        100
      ).toFixed(2);
    });
  },
};
</script>
