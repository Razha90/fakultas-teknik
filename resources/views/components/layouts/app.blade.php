<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title', 'SB Admin 2 - Dashboard')</title>

    <!-- Custom fonts for this template-->
    <link rel="icon" type="image/png" href="{{ asset('sbAdmin/img/unimed.png') }}">
    <link href="{{asset('sbAdmin/vendor/fontawesome-free/css/all.min.css')}}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{asset('sbAdmin/css/sb-admin-2.min.css')}}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.20.2/standard/ckeditor.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        .timeline {
            border-left: 2px solid #ccc;
            margin-left: 15px;
            padding-left: 15px;
        }
        .timeline-item::before {
            content: '';
            width: 10px;
            height: 10px;
            background: #007bff;
            border-radius: 50%;
            display: inline-block;
            position: relative;
            left: -22px;
            top: 3px;
        }

        .dashboard-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        cursor: pointer;
    }
    .dashboard-card:hover {
        transform: translateY(-5px) scale(1.03);
        box-shadow: 0 0 25px rgba(0,0,0,0.15);
    }
        </style>

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" wire:navigate href="/dashboard">
                <div class="sidebar-brand-icon">
                    <img src="{{ asset('sbAdmin/img/unimed.png') }}" alt="Logo" style="width: 40px; height: 40px;">
                </div>
                <div class="sidebar-brand-text mx-3">FAKULTAS TEKNIK</div>
            </a>


            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" wire:navigate href="/dashboard">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
           <!-- Data Fakultas -->
            @auth
    @if (Auth::user()->role === 'admin')
        <!-- Hanya untuk Admin: Master Content & Setting Users -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterContent"
                aria-expanded="false" aria-controls="collapseMasterContent">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>Master Content</span>
            </a>
            <div id="collapseMasterContent" class="collapse" aria-labelledby="headingMasterContent" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" wire:navigate href="/content">Content</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterUser"
                aria-expanded="false" aria-controls="collapseMasterUser">
                <i class="fas fa-fw fa-users"></i>
                <span>Setting Users</span>
            </a>
            <div id="collapseMasterUser" class="collapse" aria-labelledby="headingMasterUser" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" wire:navigate href="/users/profile">Setting</a>
                </div>
            </div>
        </li>

    @elseif (Auth::user()->role === 'staff')
        <!-- Semua Menu (staff bisa lihat semua) -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseFakultas"
                aria-expanded="false" aria-controls="collapseFakultas">
                <i class="fas fa-fw fa-cog"></i>
                <span>Data Fakultas</span>
            </a>
            <div id="collapseFakultas" class="collapse" aria-labelledby="headingFakultas" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" wire:navigate href="/departments">Data Department</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterContent"
                aria-expanded="false" aria-controls="collapseMasterContent">
                <i class="fas fa-fw fa-newspaper"></i>
                <span>Master Content</span>
            </a>
            <div id="collapseMasterContent" class="collapse" aria-labelledby="headingMasterContent" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" wire:navigate href="/categories">Data Category Berita</a>
                    <a class="collapse-item" wire:navigate href="/contentType">Jenis Content</a>
                    <a class="collapse-item" wire:navigate href="/content">Content</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasterUser"
                aria-expanded="false" aria-controls="collapseMasterUser">
                <i class="fas fa-fw fa-users"></i>
                <span>Setting Users</span>
            </a>
            <div id="collapseMasterUser" class="collapse" aria-labelledby="headingMasterUser" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <a class="collapse-item" wire:navigate href="/users/profile">Setting</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" wire:navigate href="/users">
                <i class="fas fa-fw fa-users"></i>
                <span>Users</span></a>
        </li>
    @endif
@endauth

            <div class="text-center d-none d-md-inline">
                <form id="logoutForm" method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-danger rounded-circle" id="btnLogout" title="Keluar">
                            <i class="fas fa-sign-out-alt"></i>
                    </button>
                </form>
            </div>
            <br>

            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>
        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->


                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->


                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                @auth
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">{{ Auth::user()->fullname }}</span>
                                <img class="img-profile rounded-circle"
                                    src="{{ Auth::user()->image ? asset('storage/' . Auth::user()->image) : asset('sbAdmin/img/undraw_profile.svg') }}">
                                @endauth
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" wire:navigate href="/users/profile">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Profile
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        {{-- <h1 class="h3 mb-0 text-gray-800">Dashboard</h1> --}}
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <!-- Full Width Card -->
                        <div class="col-12">
                            <div class="card shadow mb-4 h-100">
                                <!-- Card Header -->
                                <!-- Card Body -->
                                <div class="card-body">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Content Row -->



                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('sbAdmin/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('sbAdmin/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{asset('sbAdmin/vendor/jquery-easing/jquery.easing.min.js')}}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{asset('sbAdmin/js/sb-admin-2.min.js')}}"></script>

    <!-- Page level plugins -->
    <script src="{{asset('sbAdmin/vendor/chart.js/Chart.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('sbAdmin/js/demo/chart-area-demo.js')}}"></script>
    <script src="{{asset('sbAdmin/js/demo/chart-pie-demo.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/editorjs@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/header@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/list@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/@editorjs/paragraph@latest"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>




<script>

    window.addEventListener('updateProfilSuccess', event => {
        Swal.fire({
            icon: 'success',
            title: 'Data Profil diUpdate!',
        });
    });
    </script>

<script>
    document.addEventListener("livewire:init", () => {
        const editor = CKEDITOR.replace('editor1');

        editor.on('change', () => {
            const data = editor.getData();

            // Ambil instance komponen Livewire v3
            const component = Livewire.find(document.querySelector('[wire\\:id]').getAttribute('wire:id'));

            // Set data ke property Livewire
            component.set('description', data);
        });
    });
</script>

<script>
    document.getElementById('btnLogout').addEventListener('click', function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Keluar dari akun?',
            text: "Anda akan keluar dari sesi saat ini.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#6c757d',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('logoutForm').submit();
            }
        });
    });

</script>


{{-- <script>
    document.addEventListener('DOMContentLoaded', function () {
        Livewire.on('openDeleteModal', () => {
            let modal = new bootstrap.Modal(document.getElementById('deleteConfirmModal'));
            modal.show();
        });

        Livewire.on('closeDeleteModal', () => {
            let modalEl = document.getElementById('deleteConfirmModal');
            let modalInstance = bootstrap.Modal.getInstance(modalEl);
            if (modalInstance) {
                modalInstance.hide();
            }
        });
    });
</script> --}}


</body>

</html>
