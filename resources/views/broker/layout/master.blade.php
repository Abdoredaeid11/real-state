@include('broker.layout.header')
@include('broker.layout.sidebar')
<div class="layout-page">
    @include('admin.layout.navbar')
    <div class="content-wrapper">
        <div class="container-xxl flex-grow-1 container-p-y">
            @yield('content')
        </div>
    </div>
</div>
@include('broker.layout.footer')
