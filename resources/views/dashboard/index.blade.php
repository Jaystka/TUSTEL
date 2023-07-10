@extends('../layout/' . $layout)

@section('subhead')
<title>Dashboard - Icewall - Tailwind HTML Admin Template</title>
@endsection

@section('subcontent')
<div class="grid grid-cols-12 gap-6">
    <div class="col-span-12 ">
        <div class="grid grid-cols-12 gap-6">
            <!-- BEGIN: General Report -->
            <div class="col-span-12 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">General Report</h2>
                    <a href="" class="ml-auto flex items-center text-primary">
                        <i data-feather="refresh-ccw" class="w-4 h-4 mr-3"></i> Reload Data
                    </a>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-5">
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="shopping-cart" class="report-box__icon text-primary"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6 ">{{ $rental }}</div>
                                <div class="text-base text-slate-500 mt-1">Rental Aktif</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="credit-card" class="report-box__icon text-pending"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $payment }}</div>
                                <div class="text-base text-slate-500 mt-1">Total Pemasukan</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="monitor" class="report-box__icon text-warning"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $product }}</div>
                                <div class="text-base text-slate-500 mt-1">Alat Tersedia</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-span-12 sm:col-span-6 xl:col-span-3 intro-y">
                        <div class="report-box zoom-in">
                            <div class="box p-5">
                                <div class="flex">
                                    <i data-feather="user" class="report-box__icon text-success"></i>
                                    <div class="ml-auto">
                                    </div>
                                </div>
                                <div class="text-3xl font-medium leading-8 mt-6">{{ $customer }}</div>
                                <div class="text-base text-slate-500 mt-1">Pelanggan</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: General Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Sales Report</h2>
                </div>
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                    <div class="flex flex-col xl:flex-row xl:items-center">
                        <div class="flex">
                            <div>
                                <div class="text-primary dark:text-slate-300 text-lg xl:text-xl font-medium">Rp.{{
                                    $payment
                                    }}
                                </div>
                                <div class="mt-0.5 text-slate-500">Bulan Ini</div>
                            </div>
                            <div
                                class="w-px h-12 border border-r border-dashed border-slate-200 dark:border-darkmode-300 mx-4 xl:mx-5">
                            </div>
                            <div>
                                <div class="text-slate-500 text-lg xl:text-xl font-medium">Rp.{{ $lastPayment }}</div>
                                <div class="mt-0.5 text-slate-500">Bulan Lalu</div>
                            </div>
                        </div>
                    </div>
                    <div class="report-chart">
                        <canvas id="report-line-char" height="169" class="mt-6"></canvas>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Weekly Top Seller -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Weekly Top Seller</h2>
                    <a href="" class="ml-auto text-primary truncate">Show More</a>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="report-pie-chart" height="300"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                            <span class="truncate">17 - 30 Years old</span>
                            <span class="font-medium xl:ml-auto">62%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                            <span class="truncate">31 - 50 Years old</span>
                            <span class="font-medium xl:ml-auto">33%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                            <span class="truncate">>= 50 Years old</span>
                            <span class="font-medium xl:ml-auto">10%</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Weekly Top Seller -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-3 mt-8">
                <div class="intro-y flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Sales Report</h2>
                    <a href="" class="ml-auto text-primary truncate">Show More</a>
                </div>
                <div class="intro-y box p-5 mt-5">
                    <canvas class="mt-3" id="report-donut-chart" height="300"></canvas>
                    <div class="mt-8">
                        <div class="flex items-center">
                            <div class="w-2 h-2 bg-primary rounded-full mr-3"></div>
                            <span class="truncate">17 - 30 Years old</span>
                            <span class="font-medium xl:ml-auto">62%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-pending rounded-full mr-3"></div>
                            <span class="truncate">31 - 50 Years old</span>
                            <span class="font-medium xl:ml-auto">33%</span>
                        </div>
                        <div class="flex items-center mt-4">
                            <div class="w-2 h-2 bg-warning rounded-full mr-3"></div>
                            <span class="truncate">>= 50 Years old</span>
                            <span class="font-medium xl:ml-auto">10%</span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END: Sales Report -->
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dayjs@1/dayjs.min.js"></script>
<script src="./dist/js/colors.js"></script>
<script src="./dist/js/helper.js"></script>
<script type="text/javascript">
    var labels = {{ Js:: from($labels) }};
    var totals = {{ Js:: from($data) }};

    // Chart
    (function () {
        "use strict";
        // Chart
        if ($("#report-line-char").length) {
            let ctx = $("#report-line-char")[0].getContext("2d");
            let myChart = new Chart(ctx, {
                type: "line",
                data: {
                    labels: labels,
                    datasets: [
                        {
                            label: "Tahun Ini",
                            data: totals,
                            borderWidth: 2,
                            borderColor: "rgba(52, 152, 219, 0.8)",
                            backgroundColor: "transparent",
                            pointBorderColor: "transparent",
                        }
                    ],
                },
                options: {
                    legend: {
                        display: false,
                    },
                    scales: {
                        xAxes: [
                            {
                                ticks: {
                                    fontSize: "12",
                                    fontColor: "rgba(119, 152, 191, 0.8)",
                                },
                                gridLines: {
                                    display: false,
                                },
                            },
                        ],
                        yAxes: [
                            {
                                ticks: {
                                    fontSize: "12",
                                    fontColor: "rgba(119, 152, 191, 0.8)",
                                    callback: function (value, index, values) {
                                        return "$" + value;
                                    },
                                },
                                gridLines: {
                                    color: $("html").hasClass("dark")
                                        ? "rgba(119, 152, 191, 0.3)"
                                        : "rgba(119, 152, 191, 0.3)",
                                    zeroLineColor: $("html").hasClass("dark")
                                        ? "rgba(119, 152, 191, 0.3)"
                                        : "rgba(119, 152, 191, 0.3)",
                                    borderDash: [2, 2],
                                    zeroLineBorderDash: [2, 2],
                                    drawBorder: false,
                                },
                            },
                        ],
                    },
                },
            });
        }
    })();
</script>
@endsection