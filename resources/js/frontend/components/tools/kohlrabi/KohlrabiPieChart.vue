<script>
import { Pie } from "vue-chartjs";

export default {
  extends: Pie,
  props: {
    chartdata: {
      type: Array,
      default: null,
    },
  },
  mounted() {
    this.renderChart(
      {
        labels: ["波型", "三期型", "遞減型", "四期型"],
        datasets: [
          {
            backgroundColor: ["#ff5f54", "#ffe74c", "#33f78b", "#3891a6"],
            data: [0, 0, 0, 0],
          },
        ],
      },
      { responsive: true, maintainAspectRatio: false }
    );
  },
  watch: {
    chartdata: function () {
      this.addPlugin({
        afterDraw: function (chart) {
          var e = 0;
          chart.data.datasets[0].data.forEach((element) => {
            e += element;
          });
          if (e === 0) {
            // No data is present
            var ctx = chart.chart.ctx;
            var width = chart.chart.width;
            var height = chart.chart.height;
            // chart.clear();
            ctx.save();
            ctx.textAlign = "center";
            ctx.textBaseline = "middle";
            ctx.font = "36px 'Helvetica'";
            ctx.fillText("慘了 ... 預測失效", width / 2, height / 2);
            ctx.restore();
          }
        },
      });
      this.renderChart(
        {
          labels: ["波型", "三期型", "遞減型", "四期型"],
          datasets: [
            {
              backgroundColor: ["#ff5f54", "#ffe74c", "#33f78b", "#3891a6"],
              data: this.chartdata,
            },
          ],
        },
        { responsive: true, maintainAspectRatio: false }
      );
      // var ctx = this.$refs.canvas.getContext("2d");
      // var width = this.$refs.canvas.width;
      // var height = this.$refs.canvas.height;
      // chart.clear();
      // ctx.save();
      // ctx.textAlign = 'center';
      // ctx.textBaseline = 'middle';
      // ctx.font = "32px normal 'Helvetica Nueue'";
      // ctx.fillText('No data to display', width / 2, height / 2);
      // ctx.restore();
    },
  },
};
</script>
