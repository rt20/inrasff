<script>
    let dashboard = Vue.createApp({
        data(){
            return {
                downstream_month : {{$downstream_month}},
                downstream_graph: {!! json_encode(array_reverse($downstream_graph)) !!},
                downstream_graph_year: {!! json_encode(array_reverse($downstream_graph_year)) !!},
                downstream_diff_last_month: {{$downstream_diff_last_month * 100}},

                upstream_month : {{$upstream_month}},
                upstream_graph: {!! json_encode(array_reverse($upstream_graph)) !!},
                upstream_graph_year: {!! json_encode(array_reverse($upstream_graph_year)) !!},
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
        var array_stats_2 = []

        for (let j = 0; j < dashboard.downstream_graph.length; j++) {
            if(j+1 ==dashboard.downstream_graph.length){
                array_stats.push(window.colors.solid.primary)            
            }else{
                array_stats.push($avgSessionStrokeColor2)            
            }
            
        }

        for (let j = 0; j < dashboard.upstream_graph.length; j++) {
            if(j+1 ==dashboard.upstream_graph.length){
                array_stats_2.push(window.colors.solid.primary)            
            }else{
                array_stats_2.push($avgSessionStrokeColor2)            
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
            x: { show: true }
            },
            xaxis: {
                // type: 'numeric'
                categories: dashboard.downstream_graph_year,
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
            colors: array_stats_2,
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
            x: { show: true }
            },
            xaxis: {
                // type: 'numeric',
                categories: dashboard.upstream_graph_year,
            }
        };
        avgSessionsChart2 = new ApexCharts($avgSessionsChart2, avgSessionsChart2Options);
        avgSessionsChart2.render();

        var chartColors = {
        column: {
            series1: '#826af9',
            series2: '#d2b0ff',
            bg: '#f8d3ff'
        },
        success: {
            shade_100: '#7eefc7',
            shade_200: '#06774f'
        },
        donut: {
            series1: '#ffe700',
            series2: '#00d4bd',
            series3: '#826bf8',
            series4: '#2b9bf4',
            series5: '#FFA1A1'
        },
        area: {
            series3: '#a4f8cd',
            series2: '#60f2ca',
            series1: '#2bdac7'
        }
        };
        
        // Column Chart
        // --------------------------------------------------------------------
        var columnChartEl = document.querySelector('#column-chart'),
            columnChartConfig = {
            chart: {
                height: 400,
                type: 'bar',
                stacked: true,
                // parentHeightOffset: 0,
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    columnWidth: '15%',
                    colors: {
                        // backgroundBarColors: [
                        //     chartColors.column.bg,
                        //     chartColors.column.bg,
                        //     chartColors.column.bg,
                        //     chartColors.column.bg,
                        //     chartColors.column.bg
                        // ],
                        backgroundBarRadius: 10
                    }
                }
            },
            dataLabels: {
                enabled: false
            },
            legend: {
                show: true,
                position: 'top',
                horizontalAlign: 'start'
            },
            colors: [chartColors.column.series1, chartColors.column.series2],
            stroke: {
                show: true,
                colors: ['transparent']
            },
            grid: {
                xaxis: {
                lines: {
                    show: true
                }
                }
            },
            series: [
                {
                name: 'Downstream',
                // data: [90, 120, 55, 100, 80]
                data: {!! json_encode($axis_downstream) !!}
                },
                {
                name: 'Upstream',
                // data: [85, 100, 30, 40, 95]
                data: {!! json_encode($axis_upstream) !!}
                }
            ],
            xaxis: {
                // categories: ['7/12', '8/12', '9/12', '10/12', '11/12']
                categories: {!! json_encode($axis_institution) !!}
            },
            fill: {
                opacity: 1
            },
            yaxis: {
                // opposite: isRtl
            }
            };
        if (typeof columnChartEl !== undefined && columnChartEl !== null) {
            var columnChart = new ApexCharts(columnChartEl, columnChartConfig);
            columnChart.render();
        }

    })
</script>