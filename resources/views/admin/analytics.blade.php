@extends('layouts.admin.app')
@section('scripts')
<script type="text/javascript" src="{{ asset('backend/js/plugins/visualization/d3/d3.min.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/visualization/d3/d3_tooltip.js') }}"></script>
<script type="text/javascript" src="{{ asset('backend/js/plugins/visualization/echarts/echarts.min.js') }}"></script>
<script>
    $(document).ready(function() {
        var line_stacked_element = document.getElementById('line_stacked');
        var pie_donut_element = document.getElementById('pie_donut');
        // Stacked lines chart
        if (line_stacked_element) {
            // Initialize chart
            var line_stacked = echarts.init(line_stacked_element);
            // Options
            line_stacked.setOption({
                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },
                // Chart animation duration
                animationDuration: 750,
                // Setup grid
                grid: {
                    left: 0,
                    right: 20,
                    top: 35,
                    bottom: 0,
                    containLabel: true
                },
                // Add legend
                legend: {
                    data: ['Visitors', 'PageViews'],
                    itemHeight: 8,
                    itemGap: 20
                },
                // Add tooltip
                tooltip: {
                    trigger: 'axis',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    }
                },
                // Horizontal axis
                xAxis: [{
                    type: 'category',
                    boundaryGap: false,
                    data: {!!$dates_json!!},
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    }
                }],
                // Vertical axis
                yAxis: [{
                    type: 'value',
                    axisLabel: {
                        color: '#333'
                    },
                    axisLine: {
                        lineStyle: {
                            color: '#999'
                        }
                    },
                    splitLine: {
                        lineStyle: {
                            color: ['#eee']
                        }
                    },
                    splitArea: {
                        show: true,
                        areaStyle: {
                            color: ['rgba(250,250,250,0.1)', 'rgba(0,0,0,0.01)']
                        }
                    }
                }],
                // Add series
                series: [{
                        name: 'Visitors',
                        type: 'line',
                        stack: 'Total',
                        smooth: true,
                        symbolSize: 7,
                        data: {!!$visitors_json!!},
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        }
                    },
                    {
                        name: 'PageViews',
                        type: 'line',
                        stack: 'Total',
                        smooth: true,
                        symbolSize: 7,
                        data: {!!$page_views_json!!},
                        itemStyle: {
                            normal: {
                                borderWidth: 2
                            }
                        }
                    }
                ]
            });
        }
        // Daterange picker
        // ------------------------------
        $('.daterange-ranges').daterangepicker({
                startDate: moment().subtract(29, 'days'),
                endDate: moment(),
                minDate: '01/01/2012',
                maxDate: moment(),
                dateLimit: {
                    days: 60
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                    'This Year': [moment().startOf('year'), moment().endOf('month')],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                },
                opens: 'left',
                applyClass: 'btn-small bg-slate-600 btn-block',
                cancelClass: 'btn-small btn-default btn-block',
                format: 'MM/DD/YYYY'
            },
            function(start, end) {
                $('.daterange-ranges span').html(start.format('MMMM D') + ' - ' + end.format('MMMM D'));
                window.location.href = "{{ route('admin.google-analytics') }}?start_date=" + start.format('YYYY-MM-DD') + "&end_date=" + end.format('YYYY-MM-DD')
                // alert(start.format('MMMM D') + ' - ' + end.format('MMMM D'))
            }
        );
        // Basic donut chart
        if (pie_donut_element) {
            // Initialize chart
            var pie_donut = echarts.init(pie_donut_element);
            // Options
            pie_donut.setOption({
                // Colors
                color: [
                    '#2ec7c9', '#b6a2de', '#5ab1ef', '#ffb980', '#d87a80',
                    '#8d98b3', '#e5cf0d', '#97b552', '#95706d', '#dc69aa',
                    '#07a2a4', '#9a7fd1', '#588dd5', '#f5994e', '#c05050',
                    '#59678c', '#c9ab00', '#7eb00a', '#6f5553', '#c14089'
                ],
                // Global text styles
                textStyle: {
                    fontFamily: 'Roboto, Arial, Verdana, sans-serif',
                    fontSize: 13
                },
                // Add title
                title: {
                    text: 'Browser popularity',
                    subtext: 'Open source information',
                    left: 'center',
                    textStyle: {
                        fontSize: 17,
                        fontWeight: 500
                    },
                    subtextStyle: {
                        fontSize: 12
                    }
                },
                // Add tooltip
                tooltip: {
                    trigger: 'item',
                    backgroundColor: 'rgba(0,0,0,0.75)',
                    padding: [10, 15],
                    textStyle: {
                        fontSize: 13,
                        fontFamily: 'Roboto, sans-serif'
                    },
                    formatter: "{a} <br/>{b}: {c} ({d}%)"
                },
                // Add legend
                legend: {
                    orient: 'vertical',
                    top: 'center',
                    left: 0,
                    data: {!!$browser_json!!},
                    itemHeight: 8,
                    itemWidth: 8
                },
                // Add series
                series: [{
                    name: 'Browsers',
                    type: 'pie',
                    radius: ['50%', '70%'],
                    center: ['50%', '57.5%'],
                    itemStyle: {
                        normal: {
                            borderWidth: 1,
                            borderColor: '#fff'
                        }
                    },
                    data: {!!$browser_value_json!!}
                }]
            });
        }
        $('.daterange-ranges span').html(moment().subtract(7, 'days').format('MMMM D') + ' - ' + moment().format('MMMM D'));
    });
</script>
@endsection
@section('page-header')
<div class="page-header page-header-default">
    <div class="page-header-content">
        <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Home</span> -
                Dashboard</h4>
        </div>
    </div>
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{ route('admin.dashboard') }}"><i class="icon-home2 position-left"></i> Home</a>
            </li>
            <li class="active">Dashboard</li>
        </ul>
    </div>
</div>
@endsection
@section('content')
<!-- Dashboard content -->
<div class="row">
    <div class="col-lg-12">
        <!-- Main charts -->
        <div class="row">

            <div class="col-lg-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Reports</h6>
                        <div class="heading-elements">
                            <button type="button" class="btn btn-link daterange-ranges heading-btn text-semibold">
                                <i class="icon-calendar3 position-left"></i> <span></span> <b class="caret"></b>
                            </button>
                        </div>
                    </div>

                </div>
            </div>
            <div class="col-lg-6">

                <!-- Sales stats -->
                <div class="panel panel-flat">

                    <div class="panel-body">
                        <div class="chart-container">
                            <div class="chart has-fixed-height" id="line_stacked"></div>
                        </div>
                    </div>
                </div>
                <!-- /sales stats -->

            </div>

            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-body">
                        <div class="chart-container has-scroll">
                            <div class="chart has-fixed-height has-minimum-width" id="pie_donut"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Most Visited Pages</h6>

                    </div>
                    <div class="panel-body">
                        <table class="table" width="100%">
                            <tr>
                                <th width="20%">Page</th>
                                {{-- <td>Title</td> --}}
                                <th>Title</th>
                                <th width="20%">Views</th>
                            </tr>
                            @foreach($visitedPages as $page)
                            <tr>
                                <td>{{$page['url']}}</td>
                                <td>{{ $page['pageTitle'] }}</td>
                                {{-- <td>{{$page['pageTitle']}}</td> --}}
                                <td>{{$page['pageViews']}}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Most searched keywords</h6>
                    </div>
                    <div class="panel-body">
                        <table class="table">
                            <tr>
                                <th>Keyword</th>
                                <th>Count</th>
                            </tr>
                            @foreach($searchReport as $report)
                            <tr>
                                <td>{{ $report->keyword }}</td>
                                <td>{{ $report->total }}</td>
                            </tr>
                            @endforeach
                        </table>
                    </div>
                </div>
            </div>
            @can('master-policy.perform', ['sales-report', 'view'])
            <div class="col-lg-6">
                <div class="panel panel-flat">
                    <div class="panel-heading">
                        <h6 class="panel-title">Sales Reporting</h6>

                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <a href="#" class="btn bg-transparent border-teal text-teal rounded-round border-2 btn-icon mr-3">
                                        <i class="icon-cash4"></i>

                                        <div>
                                            <div class="font-weight-semibold">NPR</div>
                                            <span class="text-muted">{{ number_format($sales_collection_npr,2) }}</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-75 mx-auto mb-3" id="new-visitors"></div>
                            </div>

                            <div class="col-sm-4">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <a href="#" class="btn bg-transparent border-warning-400 text-warning-400 rounded-round border-2 btn-icon mr-3">
                                        <i class="icon-cash2"></i>

                                        <div>
                                            <div class="font-weight-semibold">INR</div>
                                            <span class="text-muted">{{ number_format($sales_collection_inr / 1.6,2) }}</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-75 mx-auto mb-3" id="new-sessions"></div>
                            </div>

                            <div class="col-sm-4">
                                <div class="d-flex align-items-center justify-content-center mb-2">
                                    <a href="#" class="btn bg-transparent border-indigo-400 text-indigo-400 rounded-round border-2 btn-icon mr-3">
                                        <i class=" icon-cash"></i>

                                        <div>
                                            <div class="font-weight-semibold">USD</div>
                                            <span class="text-muted"><span class="badge badge-mark border-success mr-2"></span> {{ number_format($sales_collection_usd,2) }}</span>
                                        </div>
                                    </a>
                                </div>
                                <div class="w-75 mx-auto mb-3" id="total-online"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endcan
        </div>
    </div>
</div>
<!-- /dashboard content -->
@endsection