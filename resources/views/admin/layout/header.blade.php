<!DOCTYPE html>

<!-- =========================================================
* Sneat - Bootstrap 5 HTML Admin Template - Pro | v1.0.0
==============================================================

* Product Page: https://themeselection.com/products/sneat-bootstrap-html-admin-template/
* Created by: ThemeSelection
* License: You must have a valid license purchased in order to legally use the theme for your project.
* Copyright ThemeSelection (https://themeselection.com)

=========================================================
 -->
<!-- beautify ignore:start -->
<html
  lang="{{ app()->getLocale() }}"
  class="light-style layout-menu-fixed"
  dir="{{ app()->getLocale() == 'ar' ? 'rtl' : 'ltr' }}"
  data-theme="theme-default"
  data-assets-path="{{ asset('admin/assets') }}/"
  data-template="vertical-menu-template-free"
>
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0"
    />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard - Analytics | RealEstate Admin</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('admin/assets/img/favicon/favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
      href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700&family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
      rel="stylesheet"
    />

    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/boxicons.css') }}" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/core.css') }}" class="template-customizer-core-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/css/theme-default.css') }}" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="{{ asset('admin/assets/css/demo.css') }}" />

    @if(app()->getLocale() == 'ar')
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.rtl.min.css" integrity="sha384-nU14brUcp6StFntEOOEBvcJm4huWjB0OcIeKr9Dk6YotBtQDmqC6V9sd3formBvn" crossorigin="anonymous">
        <style>
            body { font-family: 'Cairo', sans-serif !important; }
            html[dir="rtl"] .layout-menu { right: 0 !important; left: auto !important; }
            html[dir="rtl"] .layout-page { margin-right: 260px !important; margin-left: 0 !important; }
            html[dir="rtl"] .menu-inner .menu-item .menu-link .menu-icon { margin-left: .5rem !important; margin-right: 0 !important; }
            html[dir="rtl"] .menu-inner .menu-item .menu-link .menu-text { margin-right: .5rem !important; margin-left: 0 !important; }
            html[dir="rtl"] .layout-menu-toggle .bx-chevron-left { transform: scaleX(-1); }
            html[dir="rtl"] .navbar-nav.flex-row { flex-direction: row; }
            html[dir="rtl"] .navbar-nav.flex-row.ms-auto { margin-left: 0 !important; margin-right: auto !important; }
            html[dir="rtl"] .dropdown-menu-end { left: 0; right: auto; }
            html[dir="rtl"] .navbar-nav .me-3 { margin-left: 1rem !important; margin-right: 0 !important; }
        </style>
    @endif

<!-- Vendors CSS -->
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
<link rel="stylesheet" href="{{ asset('admin/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

<!-- Helpers -->
<script src="{{ asset('admin/assets/vendor/js/helpers.js') }}"></script>


    <!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
    <!--? Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
    <script src="{{ asset('admin/assets/js/config.js') }}"></script>
  </head>

  <body>
    <!-- Layout wrapper -->
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
