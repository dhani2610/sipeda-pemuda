<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sipeda Admin Panel</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables Bootstrap 5 CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Dropify CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.min.css">

    <style>
        body {
            background-color: #f4f7f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .sidebar {
            background: #0d47a1;
            min-height: 100vh;
            color: #fff;
        }

        /* Dominan Biru */
        .sidebar a {
            color: #bbdefb;
            text-decoration: none;
            padding: 12px 20px;
            display: block;
            border-radius: 5px;
            margin-bottom: 5px;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: #1976d2;
            color: #fff;
        }

        .topbar {
            background: #fff;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            padding: 15px 20px;
        }

        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05);
        }

        .btn-primary {
            background-color: #1976d2;
            border: none;
        }
    </style>
</head>
<body>
    @include('layouts.sidebar')

    <div class="main-content-wrapper">
        @include('layouts.header')

        <div class="p-4">
            @yield('content')
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.min.js"></script>

    <script>
        $(document).ready(function() {
            // Inisialisasi Dropify
            $('.dropify').dropify({
                messages: {
                    'default': 'Drag and drop file atau klik di sini',
                    'replace': 'Drag and drop atau klik untuk mengganti',
                    'remove': 'Hapus',
                    'error': 'Ooops, sesuatu yang salah terjadi.'
                }
            });

            // Inisialisasi DataTables
            $('table').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/id.json',
                }
            });
        });
    </script>

    @stack('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = document.getElementById('toggleSidebarBtn');
            const closeBtn = document.getElementById('closeSidebarBtn');
            const overlay = document.getElementById('sidebarOverlay');

            const mainContent = document.querySelector('.main-content-wrapper');

            function toggleSidebar() {
                if (window.innerWidth >= 992) {
                    sidebar.classList.toggle('hide');
                    if (mainContent) mainContent.classList.toggle('expanded');
                } else {
                    sidebar.classList.toggle('show');
                    overlay.classList.toggle('show');
                }
            }

            if (toggleBtn) toggleBtn.addEventListener('click', toggleSidebar);

            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }

            if (overlay) {
                overlay.addEventListener('click', function() {
                    sidebar.classList.remove('show');
                    overlay.classList.remove('show');
                });
            }
        });
    </script>
</body>

</html>
