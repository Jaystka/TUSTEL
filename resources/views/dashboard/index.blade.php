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
                    <a class="btn btn-primary shadow-md mr-2" href="{{ route('rental.create') }}">Tambah Rental</a>
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
            <!-- BEGIN: Weekly Top Seller -->
            <div class="col-span-12 sm:col-span-6 lg:col-span-6 mt-8 table-data">
                <!-- BEGIN: Weekly Top Products -->
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Rental Aktif</h2>
                </div>
                <div class="intro-y overflow-auto lg:overflow-visible mt-8 sm:mt-0">
                    <table class="table table-report sm:mt-2 ">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap">NAMA PELANGGAN</th>
                                <th class="text-center whitespace-nowrap">DURASI</th>
                                <th class="text-center whitespace-nowrap">TANGGAL SEWA</th>
                                <th class="text-center whitespace-nowrap">JUMLAH</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($rentals as $rentall)
                            <tr class="intro-x">
                                <td>
                                    <a href="" class="font-medium whitespace-nowrap">{{ $rentall['nama']
                                        }}</a>
                                    <div class="text-slate-500 text-xs whitespace-nowrap mt-0.5">{{
                                        $rentall['camera'] }}</div>
                                </td>
                                <td class="text-center">{{ $rentall['durasi'] == '6' ? '6 Jam' : ($rentall['durasi'] ==
                                    '12' ? '12
                                    Jam': ($rentall['durasi'] == '24' ? '1 Hari' :
                                    ($rentall['durasi'] == '48' ? '2 Hari' : ($rentall['durasi'] == '96' ? '4 Hari' :
                                    ($rentall['durasi'] == '144' ? '7 Hari' : ($rentall['durasi'] == '288' ? '14 Hari' :
                                    'Kosong')) )
                                    )))}}</td>
                                <td class="w-80">
                                    <div class="text-center">{{
                                        $rentall['tanggal_sewa'] }}
                                    </div>
                                </td>
                                <td class="table-report__action w-40">
                                    <div class="flex justify-center items-center">
                                        {{
                                        $rentall['jumlah'] }}
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="intro-y flex flex-wrap sm:flex-row sm:flex-nowrap items-center mt-3">
                    {{ $rentals->links('vendor.pagination.customLinks') }}
                </div>
                <!-- END: Weekly Top Products -->
            </div>
            <!-- END: Sales Report -->
            <!-- BEGIN: Sales Report -->
            <div class="col-span-12 lg:col-span-6 mt-8">
                <div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Laporan Rental</h2>
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
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
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
                            borderColor: "rgba(22, 78, 99, 1)",
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
                                        ? "rgba(22, 78, 99, 1))"
                                        : "rgba(22, 78, 99, 1)",
                                    zeroLineColor: $("html").hasClass("dark")
                                        ? "rgba(22, 78, 99, 1)"
                                        : "rgba(22, 78, 99, 1)",
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
    //pagination
    $(document).on('click','.pagination a', function(e){
    e.preventDefault();
    let page = $(this).attr('href').split('page=')[1]
    record(page)
    })
    
    function record(page){
    $.ajax({
    url:"/paginate?page="+page,
    success:function(res){
    $('.table-data').html(res);
    }
    })
    }
</script>
@endsection