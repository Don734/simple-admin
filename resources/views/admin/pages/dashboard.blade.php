@extends('layouts.admin')

@section('title', 'Dashboard')

@section('breadcrumb')
    @include('admin.partials.breadcrumb', [
        'title' => 'Dashboard',
        'list' => [
            [
                'name' => 'Dashboard',
                'current' => true
            ]
        ]
    ])
@endsection

@section('content')
<div class="row row-cols-1 row-cols-lg-4 g-4 mb-4">
    <div class="col">
        <div class="card card-dashboard">
            <div class="card-body d-flex">
                <div class="flex-shrink-0">
                    <span class="avatar rotation-90"><i class="bi bi-text-right"></i></span>
                </div>
                <div class="flex-grow-1">
                    <p class="text">Earnings</p>
                    <p class="number">$350.4</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-dashboard">
            <div class="card-body d-flex">
                <div class="flex-shrink-0">
                    <span class="avatar"><i class="bi bi-currency-dollar"></i></span>
                </div>
                <div class="flex-grow-1">
                    <p class="text">Sales</p>
                    <p class="number">$574.34</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-dashboard">
            <div class="card-body d-flex">
                <div class="flex-shrink-0">
                    <span class="avatar"><i class="bi bi-list-task"></i></span>
                </div>
                <div class="flex-grow-1">
                    <p class="text">New Tasks</p>
                    <p class="number">154</p>
                </div>
            </div>
        </div>
    </div>
    <div class="col">
        <div class="card card-dashboard">
            <div class="card-body d-flex">
                <div class="flex-shrink-0">
                    <span class="avatar"><i class="bi bi-card-checklist"></i></span>
                </div>
                <div class="flex-grow-1">
                    <p class="text">Total Projects</p>
                    <p class="number">2935</p>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row mb-4 g-4">
    <div class="col col-md-6">
        <div class="card card-chart-dashboard">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <button class="btn btn-dashboard-filter"><span class="icon"><i class="bi bi-calendar"></i></span> This month</button>
                    <span class="icon rotation-90"><i class="bi bi-text-right"></i></span>
                </div>
            </div>
            <div class="card-body">
                <div class="d-flex flex-column flex-md-row w-100 h-100">
                    <div class="flex-shrink-0">
                        <h4>$37.5K</h4>
                        <p>Total Spent <small class="percent plus"><span class="icon"></span> +2.45%</small></p>
                    </div>
                    <div class="flex-grow-1">
                        <div class="chart">
                            <canvas id="lineChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-6">
        <div class="card card-chart-dashboard">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Weekle Revenue</h5>
                    <span class="icon rotation-90"><i class="bi bi-text-right"></i></span>
                </div>
            </div>
            <div class="card-body">
                <div class="chart">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row g-4">
    <div class="col col-md-6">
        <div class="card">
            <div class="card-header">
                <div class="d-flex justify-content-between align-items-center">
                    <h5>Recent Posts</h5>
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="icon"><i class="bi bi-three-dots"></i></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li class="dropdown-item"><a href="#">Action</a></li>
                            <li class="dropdown-item"><a href="#">Another action</a></li>
                            <li class="dropdown-item"><a href="#">Something else here</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive w-100">
                    <table class="table table-dashboard w-100">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Published At</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Публичная оферта</td>
                                <td>12.Jan.2021 13:39:37</td>
                                <td><span class="badge text-bg-success">PUBLISHED</span></td>
                            </tr>
                            <tr>
                                <td>Публичная оферта</td>
                                <td>12.Jan.2021 13:39:37</td>
                                <td><span class="badge text-bg-danger">DISABLED</span></td>
                            </tr>
                            <tr>
                                <td>Публичная оферта</td>
                                <td>12.Jan.2021 13:39:37</td>
                                <td><span class="badge text-bg-success">PUBLISHED</span></td>
                            </tr>
                            <tr>
                                <td>Публичная оферта</td>
                                <td>12.Jan.2021 13:39:37</td>
                                <td><span class="badge text-bg-success">PUBLISHED</span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="col col-md-6">
        <div class="row g-4">
            <div class="col col-md-6">
                <div class="card card-chart-dashboard">
                    <div class="card-body">
                        <div class="d-flex flex-column">
                            <p>Daily Traffic</p>
                            <div class="d-flex align-items-end">
                                <h4>2.579 </h4><p><small>Visitors</small></p>
                            </div>
                        </div>
                        <div class="chart">
                            <canvas id="barChart2"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <h5>Pie Chart</h5>
                            <span class="icon rotation-90"><i class="bi bi-text-right"></i></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="chart pieChart">
                            <canvas id="pieChart"></canvas>
                        </div>
                        <!-- <div class="row row-cols-2 customPieLegend">
                            <div class="col">
                                <p class="legend-title">Legend 1</p>
                                <p class="legend-value">63%</p>
                            </div>
                            <div class="col">
                                <p class="legend-title">Legend 2</p>
                                <p class="legend-value">25%</p>
                            </div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection