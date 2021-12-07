<script>
    let dashboard = Vue.createApp({
        data(){
            return {
                downstream_month : {{$downstream_month}},
                downstream_graph: {!! json_encode(array_reverse($downstream_graph)) !!},
                downstream_diff_last_month: {{$downstream_diff_last_month * 100}},

                upstream_month : {{$upstream_month}},
                upstream_graph: {!! json_encode(array_reverse($upstream_graph)) !!},
                upstream_diff_last_month: {{$upstream_diff_last_month * 100}}
            }
        },
        created(){

        },
        mounted(){

        },
        methods :{
            stringFormatNumber(string){
                return stringFormatNumber(string)
            }
        }
    }).mount('#dashboard')
</script>
<script>
    $(document).ready(function(){

        'use strict';
        var $avgSessionStrokeColor2 = '#ebf0f7';
        var $textHeadingColor = '#5e5873';
        var $white = '#fff';
        var $strokeColor = '#ebe9f1';

        var $gainedChart = document.querySelector('#gained-chart');
        var $orderChart = document.querySelector('#order-chart');
        var $avgSessionsChart = document.querySelector('#avg-sessions-chart');
        var $avgSessionsChart2 = document.querySelector('#avg-sessions-chart-2');
        // var $supportTrackerChart = document.querySelector('#support-trackers-chart');

        var gainedChartOptions;
        var orderChartOptions;
        var avgSessionsChartOptions;
        var avgSessionsChart2Options;
        // var supportTrackerChartOptions;

        var gainedChart;
        var orderChart;
        var avgSessionsChart;
        var avgSessionsChart2;
        // var supportTrackerChart;

        var array_stats = []
        for (let j = 0; j < dashboard.downstream_graph.length; j++) {
            if(j+1 ==dashboard.downstream_graph.length){
                array_stats.push(window.colors.solid.primary)            
            }else{
                array_stats.push($avgSessionStrokeColor2)            
            }
            
        }

        // On load Toast
        setTimeout(function () {
            toastr['success'](
            'Selamat datang di BPOM INRASFF. Silahkan gunakan informasi dengan bijak',
            '👋 Hello BPOM INRASFF!',
            {
                closeButton: true,
                tapToDismiss: false,
            }
            );
        }, 2000);

        // Subscribed Gained Chart
        // ----------------------------------

        gainedChartOptions = {
            chart: {
            height: 100,
            type: 'area',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            },
            grid: {
                show: false,
                padding: {
                left: 0,
                right: 0
                }
            }
            },
            colors: [window.colors.solid.primary],
            dataLabels: {
            enabled: false
            },
            stroke: {
            curve: 'smooth',
            width: 2.5
            },
            fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.9,
                opacityFrom: 0.7,
                opacityTo: 0.5,
                stops: [0, 80, 100]
            }
            },
            series: [
            {
                name: 'Jumlah Kasus',
                // data: [1,2,1]
                data: dashboard.downstream_graph
            }
            ],
            xaxis: {
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            }
            },
            yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: { left: 0, right: 0 }
            }
            ],
            tooltip: {
            x: { show: false }
            }
        };
        gainedChart = new ApexCharts($gainedChart, gainedChartOptions);
        gainedChart.render();

        // Order Received Chart
        // ----------------------------------

        orderChartOptions = {
            chart: {
            height: 100,
            type: 'area',
            toolbar: {
                show: false
            },
            sparkline: {
                enabled: true
            },
            grid: {
                show: false,
                padding: {
                left: 0,
                right: 0
                }
            }
            },
            colors: [window.colors.solid.warning],
            dataLabels: {
            enabled: false
            },
            stroke: {
            curve: 'smooth',
            width: 2.5
            },
            fill: {
            type: 'gradient',
            gradient: {
                shadeIntensity: 0.9,
                opacityFrom: 0.7,
                opacityTo: 0.5,
                stops: [0, 80, 100]
            }
            },
            series: [
            {
                name: 'Jumlah Kasus',
                // data: [1,2,1]
                data: dashboard.upstream_graph
            }
            ],
            xaxis: {
            labels: {
                show: false
            },
            axisBorder: {
                show: false
            }
            },
            yaxis: [
            {
                y: 0,
                offsetX: 0,
                offsetY: 0,
                padding: { left: 0, right: 0 }
            }
            ],
            tooltip: {
            x: { show: false }
            }
        };
        orderChart = new ApexCharts($orderChart, orderChartOptions);
        orderChart.render();

        // Average Session Chart
        // ----------------------------------
        avgSessionsChartOptions = {
            chart: {
            type: 'bar',
            height: 200,
            sparkline: { enabled: true },
            toolbar: { show: false }
            },
            states: {
            hover: {
                filter: 'none'
            }
            },
            // colors: [
            //     $avgSessionStrokeColor2,
            //     $avgSessionStrokeColor2,
            //     window.colors.solid.primary,
            //     $avgSessionStrokeColor2,
            //     $avgSessionStrokeColor2,
            //     $avgSessionStrokeColor2
            // ],
            colors: array_stats,
            series: [
            {
                name: 'Jumlah Kasus',
                data: dashboard.downstream_graph
            }
            ],
            grid: {
            show: false,
            padding: {
                left: 0,
                right: 0
            }
            },
            plotOptions: {
            bar: {
                columnWidth: '45%',
                distributed: true,
                endingShape: 'rounded'
            }
            },
            tooltip: {
            x: { show: false }
            },
            xaxis: {
            type: 'numeric'
            }
        };
        avgSessionsChart = new ApexCharts($avgSessionsChart, avgSessionsChartOptions);
        avgSessionsChart.render();

        // Average Session Chart
        // ----------------------------------
        avgSessionsChart2Options = {
            chart: {
            type: 'bar',
            height: 200,
            sparkline: { enabled: true },
            toolbar: { show: false }
            },
            states: {
            hover: {
                filter: 'none'
            }
            },
            // colors: [
            //     $avgSessionStrokeColor2,
            //     $avgSessionStrokeColor2,
            //     window.colors.solid.primary,
            //     $avgSessionStrokeColor2,
            //     $avgSessionStrokeColor2,
            //     $avgSessionStrokeColor2
            // ],
            colors: array_stats,
            series: [
            {
                name: 'Jumlah Kasus',
                data: dashboard.upstream_graph
            }
            ],
            grid: {
            show: false,
            padding: {
                left: 0,
                right: 0
            }
            },
            plotOptions: {
            bar: {
                columnWidth: '45%',
                distributed: true,
                endingShape: 'rounded'
            }
            },
            tooltip: {
            x: { show: false }
            },
            xaxis: {
            type: 'numeric'
            }
        };
        avgSessionsChart2 = new ApexCharts($avgSessionsChart2, avgSessionsChart2Options);
        avgSessionsChart2.render();

        // Support Tracker Chart
        // -----------------------------
        // supportTrackerChartOptions = {
        //     chart: {
        //     height: 270,
        //     type: 'radialBar'
        //     },
        //     plotOptions: {
        //     radialBar: {
        //         size: 150,
        //         offsetY: 20,
        //         startAngle: -150,
        //         endAngle: 150,
        //         hollow: {
        //         size: '65%'
        //         },
        //         track: {
        //         background: $white,
        //         strokeWidth: '100%'
        //         },
        //         dataLabels: {
        //         name: {
        //             offsetY: -5,
        //             color: $textHeadingColor,
        //             fontSize: '1rem'
        //         },
        //         value: {
        //             offsetY: 15,
        //             color: $textHeadingColor,
        //             fontSize: '1.714rem'
        //         }
        //         }
        //     }
        //     },
        //     colors: [window.colors.solid.danger],
        //     fill: {
        //     type: 'gradient',
        //     gradient: {
        //         shade: 'dark',
        //         type: 'horizontal',
        //         shadeIntensity: 0.5,
        //         gradientToColors: [window.colors.solid.primary],
        //         inverseColors: true,
        //         opacityFrom: 1,
        //         opacityTo: 1,
        //         stops: [0, 100]
        //     }
        //     },
        //     stroke: {
        //     dashArray: 8
        //     },
        //     series: [47.23],
        //     labels: ['Kasus Selesai']
        // };
        // supportTrackerChart = new ApexCharts($supportTrackerChart, supportTrackerChartOptions);
        // supportTrackerChart.render();


    })
</script>