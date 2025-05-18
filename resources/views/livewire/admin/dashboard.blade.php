@section('title', 'Dashboard | FT')
<div>
    <div class="page-breadcrumb">
        <div class="row">
            <div class="col-5 align-self-center">
                <h4 class="page-title">Selamat Datang  @auth {{ Auth::user()->fullname }} @endauth</h4>
                <h4 class="page-title">@auth {{ Auth::user()->department->name }} @endauth</h4>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- disini isi kontent dashboard--}}
                        <div class="row">
                            <!-- Department -->
                            <div class="col-md-3 col-sm-6">
                                <div class="card text-white bg-primary mb-3 shadow dashboard-card animate__animated animate__fadeInUp">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Departments</h5>
                                                <h2>{{ $departments }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fa fa-building fa-3x animate__animated animate__pulse animate__infinite"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Categories -->
                            <div class="col-md-3 col-sm-6">
                                <div class="card text-white bg-success mb-3 shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Categories</h5>
                                                <h2>{{ $categories }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fa fa-folder fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contents -->
                            <div class="col-md-3 col-sm-6">
                                <div class="card text-white bg-warning mb-3 shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Contents</h5>
                                                <h2>{{ $contents }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fa fa-file-alt fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Users -->
                            <div class="col-md-3 col-sm-6">
                                <div class="card text-white bg-danger mb-3 shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Users</h5>
                                                <h2>{{ $users }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fa fa-users fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="card text-white bg-info mb-3 shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Content by Publish</h5>
                                                <h2>{{ $publishedContents }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                                <i class="fa fa-upload fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-sm-6">
                                <div class="card text-white bg-secondary mb-3 shadow">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between">
                                            <div>
                                                <h5 class="card-title">Content by Unpublished</h5>
                                                <h2>{{ $unpublishedContents }}</h2>
                                            </div>
                                            <div class="align-self-center">
                                               <i class="fa fa-times fa-3x"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Grafik Views --}}
                        <div class="row mt-4">
                            <div class="col-md-12">
                                <div class="card shadow">
                                    <div class="card-header bg-info text-white">
                                        <h4 class="mb-0">Content Views per Category</h4>
                                    </div>
                                    <div class="card-body">
                                        <canvas id="viewsChart" height="120"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Right sidebar -->
        <!-- ============================================================== -->
        <!-- .right-sidebar -->
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>

    {{-- <script>
    const ctx = document.getElementById('viewsChart').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode($viewData->pluck('category')) !!},
            datasets: [{
                label: 'Total Views',
                data: {!! json_encode($viewData->pluck('total_views')) !!},
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 2
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        precision:0
                    }
                }
            }
        }
    });
</script> --}}
</div>
