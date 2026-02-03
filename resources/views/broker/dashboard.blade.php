@extends('broker.layout.master')

@section('content')
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">
        {{ $broker->name }}
    </h1>

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

        <div class="col-md-3">
            <div class="card text-center shadow-sm border-left-primary h-100 py-2 mt-3 mt-md-0">
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
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                ${{ number_format($totalPaidAmount, 2) }}
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-credit-card fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.dashboard_stats.properties_per_month') }}</h6>
                </div>
                <div class="card-body">
                    <div id="brokerPropertiesChart"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.dashboard_stats.payments_per_month') }}</h6>
                </div>
                <div class="card-body">
                    <div id="brokerPaymentsChart"></div>
                </div>
            </div>
        </div>

        <div class="col-lg-6 mb-4">
            <div class="card shadow-sm">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('admin.dashboard_stats.property_type_distribution') }}</h6>
                </div>
                <div class="card-body">
                    <div id="brokerPropertyTypeChart"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    new ApexCharts(document.querySelector("#brokerPropertiesChart"), {
        chart: { type: 'line', height: 300, toolbar: { show: false } },
        series: [{ name: 'Properties', data: @json($propertyData) }],
        xaxis: { categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] },
        colors: ['#0d6efd']
    }).render();

    new ApexCharts(document.querySelector("#brokerPaymentsChart"), {
        chart: { type: 'bar', height: 300, toolbar: { show: false } },
        series: [{ name: 'Paid Amount', data: @json($paymentData) }],
        xaxis: { categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'] },
        colors: ['#198754']
    }).render();

    new ApexCharts(document.querySelector("#brokerPropertyTypeChart"), {
        chart: { type: 'donut', height: 300 },
        labels: @json($propertyTypes->keys()),
        series: @json($propertyTypes->values()),
        colors: ['#0dcaf0','#6f42c1','#20c997','#ffc107']
    }).render();
</script>
@endsection
