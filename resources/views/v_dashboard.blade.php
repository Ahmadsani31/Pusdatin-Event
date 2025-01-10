@extends('layouts.app')
@section('content')
    <div class="pt-10 pb-18"></div>

    <div class="container-fluid mt-n22 px-6">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-12">
                <!-- Page header -->
                <div class="d-flex justify-content-between align-items-center mb-5">
                    <h3 class="mb-0 ">Dashboard</h3>
                </div>
            </div>
        </div>
        <div class="bg-info rounded-3">
            <div class="row mb-5 ">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="p-6 d-lg-flex justify-content-between align-items-center ">
                        <div class="d-md-flex align-items-center">
                            <div class="ms-md-4 mt-3 mt-md-0 lh-1">
                                <h3 class="text-white mb-0">Selamat Datang</h3>
                                <small class="text-white">pada Website Pusdatin Dinas Perindustrian, Perdagangan, Koperasi
                                    dan Usaha Kecil Menengah Jakarta</small>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <!-- row  -->
        <div class="row my-6">
            <div class="col-lg-12 col-md-12 col-12 mb-6 mb-2">
                <!-- card  -->
                <div class="card">
                    <div class="card-header">
                        <h5>Peserta</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table text-center" id="DTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Usaha</th>
                                        <th>Total Transaksi</th>
                                        <th>Total Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-xl-12 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card ">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center  justify-content-between">
                            <div>
                                <h4 class="mb-0">5 Event Transaksi Qris Tertinggi</h4>
                            </div>

                        </div>
                        <div id="diagramBatang"></div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card ">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center  justify-content-between">
                            <div>
                                <h4 class="mb-0">Nama-nama usaha peserta Qris</h4>
                            </div>

                        </div>
                        <div id="diagramPie"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 col-lg-6 col-md-12 col-12 mt-6">
                <!-- card -->
                <div class="card ">
                    <!-- card body -->
                    <div class="card-body">
                        <div class="d-flex align-items-center  justify-content-between">
                            <div>
                                <h4 class="mb-0">Transaksi Qris Perbulan</h4>
                            </div>

                        </div>
                        <div id="diagramLine"></div>
                    </div>
                </div>
            </div>


        </div>


    </div>
@endsection
@pushOnce('scripts')
    <script>
        $('#program_id').on('change', function() {
            DTable.ajax.reload(null, false);
        });

        let DTable = new DataTable('#DTable', {
            ajax: {
                url: "{{ route('datatable', ['tabel' => 'peserta_qris']) }}",
            },
            processing: true,
            serverSide: true,
            columnDefs: [{
                className: "align-middle text-center",
                targets: ['_all'],
            }, {
                targets: 0,
                searchable: false,
                orderable: false,
                createdCell: function(td, cellData, rowData, row, col) {
                    $(td).html(row + 1 + '. '); // Updates the first column with index
                }
            }],
            order: [
                [0, 'asc']
            ],
            columns: [{
                data: null,
            }, {
                data: 'nama_pemilik',
            }, {
                data: 'nama_usaha',
            }, {
                data: 'total_transaksi',
            }, {
                data: 'total_nominal',
            }, ],
        });


        var options = {
            series: [],
            chart: {
                type: 'bar',
                height: 350
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '55%',
                    borderRadius: 5,
                    borderRadiusApplication: 'end'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            xaxis: {
                categories: [],
            },
            yaxis: {
                title: {
                    text: 'Rp (rupiah)'
                }
            },
            fill: {
                opacity: 1
            },
            tooltip: {
                y: {
                    formatter: function(val) {
                        return "Rp " + val + " (Rupiah)"
                    }
                }
            }
        };

        var chartBatang = new ApexCharts(document.querySelector("#diagramBatang"), options);
        chartBatang.render();

        var optionsLine = {
            series: [],
            chart: {
                height: 350,
                type: 'line',
                zoom: {
                    enabled: false
                }
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                curve: 'straight'
            },
            grid: {
                row: {
                    colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                    opacity: 0.5
                },
            },
            xaxis: {
                categories: [],
            }
        };

        var chartLine = new ApexCharts(document.querySelector("#diagramLine"), optionsLine);
        chartLine.render();


        var optionsPie = {
            series: [],
            chart: {
                width: 680,
                type: 'pie',
            },
            labels: [],
            responsive: [{
                breakpoint: 480,
                options: {
                    chart: {
                        width: 400
                    },
                    legend: {
                        position: 'bottom'
                    }
                }
            }]
        };

        var chartPie = new ApexCharts(document.querySelector("#diagramPie"), optionsPie);
        chartPie.render();

        getDiagramBatang();
        async function getDiagramBatang() {
            // console.log(value);

            try {
                var response = await axios.get("{{ route('diagram.batang') }}");
                console.log(response);
                var dSeries = response.data.items.series;
                var dCategories = response.data.items.categories;
                chartBatang.updateOptions({
                    series: dSeries,
                    xaxis: {
                        categories: dCategories,
                    }
                })
            } catch (error) {
                console.error(error);
            }
        }

        getDiagramLine();
        async function getDiagramLine() {
            // console.log(value);

            try {
                var response = await axios.get("{{ route('diagram.line') }}");
                console.log(response);
                var dSeries = response.data.items.series;
                var dCategories = response.data.items.categories;
                chartLine.updateOptions({
                    series: dSeries,
                    xaxis: {
                        categories: dCategories,
                    }
                })
            } catch (error) {
                console.error(error);
            }
        }

        getDiagramPie();
        async function getDiagramPie() {
            // console.log(value);

            try {
                var response = await axios.get("{{ route('diagram.pie') }}");
                console.log(response);
                var dSeries = response.data.items.series;
                var dCategories = response.data.items.categories;
                chartPie.updateOptions({
                    series: dSeries,
                    labels: dCategories

                })
            } catch (error) {
                console.error(error);
            }
        }
    </script>
@endPushOnce
