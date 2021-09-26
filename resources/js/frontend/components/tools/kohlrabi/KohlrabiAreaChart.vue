<script>
import { Line } from "vue-chartjs";

export default {
  extends: Line,
  props: {
    chartdata: {
      type: Object,
      default: null,
    },
  },
  data() {
    return {
      gradient: null,
      gradient2: null,
      gradient3: null,
      options: {
        responsive: true,
        maintainAspectRatio: false,
      },
    };
  },
  watch: {
    chartdata: function () {
      this.gradient = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
      this.gradient2 = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
      this.gradient3 = this.$refs.canvas
        .getContext("2d")
        .createLinearGradient(0, 0, 0, 450);
      this.gradient.addColorStop(0, "rgba(255, 186, 73, 1)");
      this.gradient.addColorStop(0.5, "rgba(255, 186, 73, 0.8)");
      this.gradient.addColorStop(1, "rgba(255, 186, 73, 0.6)");
      this.gradient2.addColorStop(0, "rgba(32, 163, 158, 0.4)");
      this.gradient2.addColorStop(0.5, "rgba(32, 163, 158, 0.2)");
      this.gradient2.addColorStop(1, "rgba(32, 163, 158, 0)");
      this.gradient3.addColorStop(0, "rgba(239, 91, 91, 0.4)");
      this.gradient3.addColorStop(0.5, "rgba(239, 91, 91, 0.2)");
      this.gradient3.addColorStop(1, "rgba(239, 91, 91, 0)");
      this.chartdata.datasets[0].backgroundColor = this.gradient;
      this.chartdata.datasets[1].backgroundColor = this.gradient2;
      this.chartdata.datasets[2].backgroundColor = this.gradient3;
      this.renderChart(this.chartdata, this.options);
    },
  },
};
</script>
