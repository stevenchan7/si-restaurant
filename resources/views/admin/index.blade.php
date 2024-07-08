<x-layouts.admin-layout>
    @section('css')
    <link href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    @endsection

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        <form action="{{ route('generateReport') }}">
            <input id="reportFrom" type="hidden" name="from">
            <input id="reportTo" type="hidden" name="to">
            <button id="generateReportBtn" type="submit"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-download fa-sm text-white-50"></i> Generate Report
            </button>
        </form>
    </div>

    <div class="row mb-4 px-3">
        <form id="fromToDateForm" action="">
            <div class="d-flex flex-column flex-sm-row" style="gap: 0.5rem">
                <div class="d-flex align-items-center" style="gap: 0.5rem">
                    <p class="m-0">From</p>
                    <input type="date" name="from" id="fromDateInput" class="ml-1 ml-sm-0">
                </div>

                <div class="d-flex align-items-center" style="gap: 0.5rem">
                    <p class="m-0">To</p>
                    <input type="date" name="to" id="toDateInput" class="ml-4 ml-sm-0">
                </div>
            </div>
        </form>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total orders</div>
                            <div id="totalOrder" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Revenue</div>
                            <div id="revenue" class="h5 mb-0 font-weight-bold text-gray-800"></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Area Chart -->
        <div class="col-xl-8 col-lg-7">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Order overview</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div class="chart-area">
                        <canvas id="orderAreaChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-5">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Top Menus</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <div id="topMenus">

                    </div>
                </div>
            </div>
        </div>

    </div>

    @section('script')
    <!-- Page level plugins -->
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <!-- Page level custom scripts -->
    {{-- Area chart script --}}
    <script type="text/javascript">
        var orderTotalPerMonth = @json($orderTotalPerMonth);
        var months = [];
        var counts = [];

        orderTotalPerMonth.forEach(item => {
            // console.log(item);
            months.push(item.month);
            counts.push(item.count);
        });

        // console.log(months);
        // console.log(counts);

        // Area Chart Example
        var ctx = document.getElementById("orderAreaChart");
        var myLineChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: months,
            datasets: [{
            label: "Orders",
            lineTension: 0.3,
            backgroundColor: "rgba(78, 115, 223, 0.05)",
            borderColor: "rgba(78, 115, 223, 1)",
            pointRadius: 3,
            pointBackgroundColor: "rgba(78, 115, 223, 1)",
            pointBorderColor: "rgba(78, 115, 223, 1)",
            pointHoverRadius: 3,
            pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
            pointHoverBorderColor: "rgba(78, 115, 223, 1)",
            pointHitRadius: 10,
            pointBorderWidth: 2,
            data: counts,
            }],
        },
        options: {
            maintainAspectRatio: false,
            layout: {
            padding: {
                left: 10,
                right: 25,
                top: 25,
                bottom: 0
            }
            },
            scales: {
            xAxes: [{
                time: {
                unit: 'date'
                },
                gridLines: {
                display: false,
                drawBorder: false
                },
                ticks: {
                maxTicksLimit: 7
                }
            }],
            yAxes: [{
                ticks: {
                maxTicksLimit: 5,
                padding: 10,
                // Include a dollar sign in the ticks
                // callback: function(value, index, values) {
                //     return '$' + number_format(value);
                // }
                },
                gridLines: {
                color: "rgb(234, 236, 244)",
                zeroLineColor: "rgb(234, 236, 244)",
                drawBorder: false,
                borderDash: [2],
                zeroLineBorderDash: [2]
                }
            }],
            },
            legend: {
            display: false
            },
            tooltips: {
            backgroundColor: "rgb(255,255,255)",
            bodyFontColor: "#858796",
            titleMarginBottom: 10,
            titleFontColor: '#6e707e',
            titleFontSize: 14,
            borderColor: '#dddfeb',
            borderWidth: 1,
            xPadding: 15,
            yPadding: 15,
            displayColors: false,
            intersect: false,
            mode: 'index',
            caretPadding: 10,
            // callbacks: {
            //     label: function(tooltipItem, chart) {
            //     var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
            //     return datasetLabel + ': $' + number_format(tooltipItem.yLabel);
            //     }
            // }
            }
        }
        });
    </script>

    {{-- Ajax script --}}
    <script type="text/javascript">
        $(document).ready(function() {
            // Show top menus
            function showTopMenus(topMenus) {
                var topMenusContainer = $('#topMenus');
                        
                // Clear existing content (if any)
                topMenusContainer.empty();

                // Iterate over each menu in the data array
                $.each(topMenus, function(index, menu) {
                    // Create a card element for each menu
                    var card = $('<div>').addClass('card mb-3');
                    var cardBody = $('<div>').addClass('card-body d-flex align-items-center');
                    var ranking = $('<span>').addClass('badge badge-primary mr-2').text(index + 1); // Ranking number
                    var menuName = $('<h5>').addClass('card-title m-0').text(menu.name);
                    
                    // Append ranking and menuName to cardBody
                    cardBody.append(ranking, menuName);
                    
                    // Append cardBody to card
                    card.append(cardBody);
                    
                    // Append card to topMenusContainer
                    topMenusContainer.append(card);
                });
            }

            // Submit form
            function submitDateForm() {
                // Handle form submit
                var form = $('#fromToDateForm')

                var data = form.serialize();
                var url = "{{ route('admin.dashboardDataByDate') }}";

                $.ajax({
                    type: 'GET',
                    url: url,
                    data: data,
                    dataType: 'json',
                    success: function(data) {
                        console.log(data); // Verify that data is received correctly
                        
                        showTopMenus(data.topMenus);

                        $('#totalOrder').text(data.count);

                        const formattedRevenue = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(data.revenue);
                        $('#revenue').text(formattedRevenue)
                    },
                    error: function(data) {
                        console.log(data);
                    }
                });
            };

            function areDatesFilled() {
                var fromDate = $('#fromDateInput').val();
                var toDate = $('#toDateInput').val();
                return fromDate !== '' && toDate !== '';
            };

            $('#fromToDateForm input[type=date]').change(function() {
                if (areDatesFilled()) {
                    submitDateForm();
                } else {
                    console.log('Date is not filled');
                }
            });

            $('#fromDateInput').change(function() {
                $('#reportFrom').val($(this).val());
            })

            $('#toDateInput').change(function() {
                $('#reportTo').val($(this).val());
            })
        });
    </script>
    @endsection
</x-layouts.admin-layout>