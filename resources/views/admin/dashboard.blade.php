@extends('admin.layout.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">{{ __('admin.dashboard_stats.overview') }}</h1>

    {{-- 🔹 Stats Cards --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card text-center shadow-sm border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ __('admin.dashboard_stats.total_properties') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalProperties }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ __('admin.dashboard_stats.total_brokers') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalBrokers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm border-left-info h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                {{ __('admin.dashboard_stats.total_users') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card text-center shadow-sm border-left-warning h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                {{ __('admin.dashboard_stats.open_leads') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $openLeads }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-phone-volume fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-3">
            <div class="card text-center shadow-sm border-left-secondary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                                {{ __('admin.dashboard_stats.total_reservations') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalReservations }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar-check fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-3">
            <div class="card text-center shadow-sm border-left-primary h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                {{ __('admin.dashboard_stats.upcoming_checkins') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $upcomingCheckins }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-door-open fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3 mt-3">
            <div class="card text-center shadow-sm border-left-success h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                {{ __('admin.dashboard_stats.total_paid_amount') }}
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalPaidAmount, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- 🔹 Charts --}}
    <div class="row">
        {{-- 1. Properties Per Month --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.dashboard_stats.properties_per_month') }}</h6>
                </div>
                <div class="card-body">
                    <div id="propertiesChart"></div>
                </div>
            </div>
        </div>

        {{-- 2. Property Type Distribution --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.dashboard_stats.property_type_distribution') }}</h6>
                </div>
                <div class="card-body">
                    <div id="propertyTypeChart"></div>
                </div>
            </div>
        </div>

        {{-- 3. Top Brokers --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.dashboard_stats.top_brokers') }}</h6>
                </div>
                <div class="card-body">
                    <div id="topBrokersChart"></div>
                </div>
            </div>
        </div>

        {{-- 4. Payments Per Month --}}
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.dashboard_stats.payments_per_month') }}</h6>
                </div>
                <div class="card-body">
                    <div id="paymentsChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    // 1. Line Chart: Properties Per Month
    new ApexCharts(document.querySelector("#propertiesChart"), {
        chart: { type: 'line', height: 300, toolbar: { show: false } },
        series: [{ name: 'Properties', data: @json($propertyData) }],
        xaxis: { categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] },
        colors: ['#0d6efd']
    }).render();

    // Payments Per Month
    new ApexCharts(document.querySelector("#paymentsChart"), {
        chart: { type: 'bar', height: 300, toolbar: { show: false } },
        series: [{ name: 'Paid Amount', data: @json($paymentData) }],
        xaxis: { categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] },
        colors: ['#198754']
    }).render();

    // 2. Donut Chart: Property Type Distribution
    new ApexCharts(document.querySelector("#propertyTypeChart"), {
        chart: { type: 'donut', height: 300 },
        labels: @json($propertyTypes->keys()),
        series: @json($propertyTypes->values()),
        colors: ['#0dcaf0','#6f42c1','#20c997','#ffc107']
    }).render();

    // 3. Bar Chart: Top Brokers
    new ApexCharts(document.querySelector("#topBrokersChart"), {
        chart: { type: 'bar', height: 300, toolbar: { show: false } },
        plotOptions: { bar: { horizontal: true } },
        series: [{ name: 'Properties', data: @json($topBrokers->pluck('total_properties')) }],
        xaxis: { categories: @json($topBrokers->pluck('name')) },
        colors: ['#6610f2']
    }).render();
</script>
@endsection
