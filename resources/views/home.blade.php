@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="mb-2 row">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div></div></div></div>
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $transactionCount }}</h3>
                            <p>Jumlah Transaksi</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="{{ route('transaksis.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $providers }}</h3>
                            <p>Jumlah Providers</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="{{ route('providers.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $users }}</h3>
                            <p>Jumlah User</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="{{ route('users.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
            <div class="row">
                <section class="col-lg-12 connectedSortable">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="mr-1 fas fa-chart-pie"></i>
                                Grafik Transaksi
                            </h3>
                        </div>
                        <div class="card-body">
                            <div class="chart tab-pane active" id="revenue-chart"
                                    style="position: relative; height: 300px;">
                                <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            </div></section>
@endsection

@push('scripts')
    <script>
        $(function() {
            'use strict'

            var labels = {!! json_encode($labels) !!};
            var data = {!! json_encode($data) !!};

            if (labels.length > 0) {
                var ticksStyle = {
                    fontColor: '#495057',
                    fontStyle: 'bold'
                }
                var mode = 'index'
                var intersect = true
                var $salesChart = $('#revenue-chart-canvas')
                var salesChart = new Chart($salesChart, {
                    type: 'bar',
                    data: {
                        labels: labels,
                        datasets: [{
                            backgroundColor: '#007bff',
                            borderColor: '#007bff',
                            data: data
                        }, ]
                    },
                    options: {
                        maintainAspectRatio: false,
                        tooltips: { mode: mode, intersect: intersect },
                        hover: { mode: mode, intersect: intersect },
                        legend: { display: false },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: true,
                                    lineWidth: '4px',
                                    color: 'rgba(0, 0, 0, .2)',
                                    zeroLineColor: 'transparent'
                                },
                                ticks: $.extend({
                                    beginAtZero: true,
                                    callback: function(value) {
                                        if (value >= 1000) {
                                            value /= 1000
                                            value += 'k'
                                        }
                                        return value
                                    }
                                }, ticksStyle)
                            }],
                            xAxes: [{
                                display: true,
                                gridLines: { display: false },
                                ticks: ticksStyle
                            }]
                        }
                    }
                })
            } else {
                $('#revenue-chart').html('<p class="text-center">Belum ada data transaksi untuk ditampilkan.</p>');
            }
        })
    </script>
@endpush
