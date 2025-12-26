<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>PDF Report</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <style>
        @page {
            margin: 2cm;
        }

        .page-break {
            page-break-after: always;
        }


        body {
            font-family: 'Poppins', sans-serif;
            font-size: 9px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        td,
        th {
            border: 1px solid #ddd;
            padding: 8px;
            font-size: 9px;
        }

        .text-center {
            text-align: center;
        }

        .text-primary {
            color: #003366;
        }
        .text-white {
            color: #ffffff;
        }
        .bg-primary {
            background-color: #003366!important;
        }

        .bg-title {
            background-color: #6e718c!important;
            color: white;
        }

        .fw-bold {
            font-weight: bold;
        }

        .fs-7 {
            font-size: 13px;
        }

        .fs-8 {
            font-size: 10px;
        }

        .mb-0 {
            margin-bottom: 0px;
        }

        .background-image {
            position: fixed;
            top: 50mm;
            left: 130mm;
            width: 450px;
            opacity: 0.08;
            z-index: -1;
        }

        .content {
            position: relative;
            z-index: 1;
        }
    </style>
</head>

<body>
    <img class="background-image" src="{{ public_path('/storage/logo/logo.png') }}" alt="Background">

    <div class="content">
        @yield('content')
    </div>
</body>

</html>
