@extends('layouts.admin.app')

@section('content')
    <h4 class="page-title">DashBoard</h4>

    <div class="row pb-3 mb-3">
        <div class="col-md-4">
            <div class="card card-stats card-info h-100 border-bottom" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="bi bi-people"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Jumlah Pengguna</p>
                                <h4 class="card-title">{{ \App\Models\User::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-success h-100 border-bottom" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="bi bi-lightbulb-fill"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Total Kategori</p>
                                <h4 class="card-title">{{ \App\Models\Kategori::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-stats card-warning h-100 border-bottom" style="border-radius: 12px;">
                <div class="card-body">
                    <div class="row">
                        <div class="col-5">
                            <div class="icon-big text-center">
                                <i class="bi bi-newspaper"></i>
                            </div>
                        </div>
                        <div class="col-7 d-flex align-items-center">
                            <div class="numbers">
                                <p class="card-category">Total Ide</p>
                                <h4 class="card-title">{{ \App\Models\Ide::count() }}</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row row-card-no-pd" style="border-radius: 12px;">
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <p class="fw-bold mt-1">User</p>
                    <h4><b>$ 3,018</b></h4>
                    <a href="#" class="btn btn-primary btn-full text-left mt-3 mb-3"><i class="la la-plus"></i> Add
                        Balance</a>
                </div>
                <div class="card-footer">
                    <ul class="nav">
                        <li class="nav-item"><a class="btn btn-default btn-link" href="#"><i
                                    class="la la-history"></i> History</a></li>
                        <li class="nav-item ml-auto"><a class="btn btn-default btn-link" href="#"><i
                                    class="la la-refresh"></i> Change User</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <div class="progress-card">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Profit</span>
                            <span class="text-muted fw-bold"> $3K</span>
                        </div>
                        <div class="progress mb-2" style="height: 7px;">
                            <div class="progress-bar bg-success" role="progressbar" style="width: 78%" aria-valuenow="78"
                                aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top"
                                title="78%"></div>
                        </div>
                    </div>
                    <div class="progress-card">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Orders</span>
                            <span class="text-muted fw-bold"> 576</span>
                        </div>
                        <div class="progress mb-2" style="height: 7px;">
                            <div class="progress-bar bg-info" role="progressbar" style="width: 65%" aria-valuenow="60"
                                aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top"
                                title="65%"></div>
                        </div>
                    </div>
                    <div class="progress-card">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Tasks Complete</span>
                            <span class="text-muted fw-bold"> 70%</span>
                        </div>
                        <div class="progress mb-2" style="height: 7px;">
                            <div class="progress-bar bg-primary" role="progressbar" style="width: 70%"
                                aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"
                                data-placement="top" title="70%"></div>
                        </div>
                    </div>
                    <div class="progress-card">
                        <div class="d-flex justify-content-between mb-1">
                            <span class="text-muted">Open Rate</span>
                            <span class="text-muted fw-bold"> 60%</span>
                        </div>
                        <div class="progress mb-2" style="height: 7px;">
                            <div class="progress-bar bg-warning" role="progressbar" style="width: 60%"
                                aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip"
                                data-placement="top" title="60%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card h-100" style="border-radius: 12px;">
                <div class="card-header">
                    <h4 class="card-title">Task</h4>
                    <p class="card-category">Complete</p>
                </div>
                <div class="card-body">
                    <div id="task-complete" class="chart-circle mt-4 mb-3"></div>
                </div>
                <div class="card-footer">
                    <div class="legend"><i class="la la-circle text-primary"></i>Completed</div>
                </div>
            </div>
        </div>

        <div class="col-md-9">
            <div class="card h-100" style="border-radius: 12px;">
                <div class="card-header">
                    <h4 class="card-title mb-0">Table</h4>
                    <p class="card-category mb-0">Users Table</p>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border-radius: 8px;">
                        <table class="table table-head-bg-success table-striped table-hover mb-0">
                            <thead class="table-success">
                                <tr>
                                    <th scope="col">No</th>
                                    <th scope="col">Pengguna</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                    <td>@fat</td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td>Larry the Bird</td>
                                    <td>@twitter</td>
                                    <td>ye</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
