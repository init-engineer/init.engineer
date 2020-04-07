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
                        backgroundColor: [
                            "#ff5f54",
                            "#ffe74c",
                            "#33f78b",
                            "#3891a6"
                        ],
                        data: [0,0,0,0],
                    }
                ]
            },
            { responsive: true, maintainAspectRatio: false }
        );
    },
    watch: {
      	chartdata: function() {
            this.renderChart(
                {
                    labels: ["波型", "三期型", "遞減型", "四期型"],
                    datasets: [
                        {
                            backgroundColor: [
                                "#ff5f54",
                                "#ffe74c",
                                "#33f78b",
                                "#3891a6"
                            ],
                            data: this.chartdata,
                        }
                    ]
                },
                { responsive: true, maintainAspectRatio: false }
            );
        }
    }
};
</script>
