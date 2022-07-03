<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title> @yield('title') | Pemerintah Kabupaten Kolaka Utara</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('assets/images/favicon.ico') }}">
    <!-- <link rel="stylesheet" href="{{ URL::asset('/assets/css/print.css') }}"> -->
    <style>
        body {
            font-family: sans-serif;
        }
        .page-break {
            page-break-after: always;
        }
        h1 {
        font-weight: bold;
        font-size: 20pt;
        }

        table {
            border-collapse: collapse;
            width: 100%;
            font-size: 12px;
        }
        .no-border thead th, .no-border tbody td {
            border: 0 !important;
        }
        .table thead {
            font-size: 12px;
        }
        .table thead th {
            border: 1px solid #000000;
        }
        .table thead h4 {
            font-size: 18px;
        }
        .table thead h5 {
            font-size: 14px;
        }
        .table thead p {
            margin: 5px 0;
            font-weight: normal;
        }
        .table tbody {
        }
        .table tbody th {
            border: 1px solid #000000;
            padding: 3px;
        }

        .table tbody td {
            border: 1px solid #000000;
            padding: 3px 4px;
            word-wrap: break-word;
        }

        .text-center {
            text-align: center;
        }
        .text-end {
            text-align: right;
        }
        .mt-0 {
            margin-top: 0;
        }
        .mt-30 {
            margin-top: 30px;
        }
        .mb-0 {
            margin-bottom: 0 !important;
        }
        .p-0 {
            padding: 0 !important;
        }
        .p-10 {
            padding: 10px;
        }
        .p-20 {
            padding: 20px;
        }
        .unstyle {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .unstyle li {
            padding-bottom: 10px;
        }
        .unstyle li b {
            display: flex;
            width: 180px;
        }
        .unstyle li b::after {
            content: " :";
            float: right;
        }
        .two-coloumn {
            list-style: none;
            margin: 0;
            padding: 0;
        }
        .two-coloumn li {
            display: inline-block;
            width: 50%;
        }
        .qrcode {
            text-align: left;
            padding: 10px;
            border: 1px solid #000;
            display: inline-block;
        }
    </style>
</head>
<body>
@yield('content')
</body>
</html>
