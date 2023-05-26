<!DOCTYPE html>
<html lang="ru">

<head>

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- PAGE TITLE HERE -->
    <title>Панель управления</title>

    <!-- FAVICONS ICON -->
    <link rel="shortcut icon" type="image/png" href="favicon.ico" />
    <!-- Datatable -->
    <link href="{{ asset('assets/css/jquery.dataTables.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/chartist.min.css') }}">
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/main.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/nice-select.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/bootstrap-datetimepicker.min.css') }}" rel="stylesheet">
    <!-- Pick date -->
    <link href="{{ asset('assets/css/daterangepicker.css') }}" rel="stylesheet">
    <!-- Style css -->
    <link href="{{ asset('assets/css/style.css') }}" rel="stylesheet">

</head>
