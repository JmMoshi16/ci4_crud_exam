<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<!-- Breadcrumbs handled by topbar -->
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-md-row justify-content-between align-items-md-end mb-5 gap-3">
    <div>
        <h2 class="mb-2" style="font-size: 1.75rem; font-weight: 700; color: var(--text-primary); letter-spacing: -0.03em;">Platform Overview</h2>
        <p class="mb-0" style="font-size: 0.95rem; color: var(--text-secondary);">Here is what's happening across your platform today.</p>
    </div>
    <div class="d-flex gap-2">
        <button class="clean-btn-primary"><i class="bi bi-download me-2"></i> Download Report</button>
    </div>
</div>

<!-- Key Metrics Row -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="clean-card p-4 h-100 position-relative">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em;">Total Users</div>
                <div class="icon-shape bg-indigo-50 text-indigo-600"><i class="bi bi-people"></i></div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-primary); line-height: 1;">1,248</div>
            <div class="mt-2 d-flex align-items-center" style="font-size: 0.75rem; color: #34d399; font-weight: 600;">
                <i class="bi bi-arrow-up-right me-1"></i> 12% from last month
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="clean-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em;">Active Students</div>
                <div class="icon-shape bg-emerald-50 text-emerald-600"><i class="bi bi-person-check"></i></div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-primary); line-height: 1;">892</div>
            <div class="mt-2 d-flex align-items-center" style="font-size: 0.75rem; color: #34d399; font-weight: 600;">
                <i class="bi bi-arrow-up-right me-1"></i> 5% from last month
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="clean-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em;">New Registrations</div>
                <div class="icon-shape bg-amber-50 text-amber-600"><i class="bi bi-person-plus"></i></div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-primary); line-height: 1;">156</div>
            <div class="mt-2 d-flex align-items-center" style="font-size: 0.75rem; color: #fb7185; font-weight: 600;">
                <i class="bi bi-arrow-down-right me-1"></i> 2% from last month
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="clean-card p-4 h-100">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <div style="font-size: 0.75rem; font-weight: 600; text-transform: uppercase; color: var(--text-secondary); letter-spacing: 0.05em;">System Status</div>
                <div class="icon-shape bg-rose-50 text-rose-600"><i class="bi bi-activity"></i></div>
            </div>
            <div style="font-size: 2rem; font-weight: 700; color: var(--text-primary); line-height: 1;">99.9%</div>
            <div class="mt-2 d-flex align-items-center" style="font-size: 0.75rem; color: var(--text-secondary); font-weight: 500;">
                All services operational
            </div>
        </div>
    </div>
</div>

<!-- Charts Row -->
<div class="row g-4">
    <div class="col-lg-8">
        <div class="clean-card h-100">
            <div class="clean-card-header d-flex justify-content-between align-items-center">
                <h6 class="mb-0" style="font-size: 0.95rem; font-weight: 600; color: var(--text-primary);">Platform Activity (Last 6 Months)</h6>
            </div>
            <div class="p-4">
                <div id="revenue-chart"></div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-4">
        <div class="clean-card h-100">
            <div class="clean-card-header">
                <h6 class="mb-0" style="font-size: 0.95rem; font-weight: 600; color: var(--text-primary);">Global Traffic</h6>
            </div>
            <div class="p-4">
                <div id="world-map" style="height: 300px; border-radius: 8px; overflow: hidden; border: 1px solid var(--border-light);"></div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/js/jsvectormap.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/maps/world.js" crossorigin="anonymous"></script>
<script>
const activityChart = new ApexCharts(document.querySelector('#revenue-chart'), {
    theme: { mode: 'dark' },
    series: [
        {name: 'Logins', data: [850, 920, 1100, 1050, 1250, 1320]}, 
        {name: 'Registrations', data: [120, 150, 110, 130, 180, 156]}
    ],
    chart: {
        height: 330, 
        type: 'area', 
        toolbar: {show: false},
        fontFamily: 'Inter, sans-serif',
        background: 'transparent'
    },
    legend: {
        position: 'top',
        horizontalAlign: 'right'
    },
    colors: ['#818cf8', '#34d399'],
    dataLabels: {enabled: false},
    stroke: {curve: 'smooth', width: 2},
    fill: {
        type: 'gradient',
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.4,
            opacityTo: 0.05,
            stops: [0, 100]
        }
    },
    xaxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
        axisBorder: {show: false},
        axisTicks: {show: false}
    },
    grid: {
        borderColor: 'rgba(255,255,255,0.05)',
        strokeDashArray: 4
    }
});
activityChart.render();

new jsVectorMap({
    selector: '#world-map', 
    map: 'world',
    zoomOnScroll: false,
    regionStyle: {
        initial: {
            fill: 'rgba(255,255,255,0.1)',
            "fill-opacity": 1,
            stroke: 'none',
        },
        hover: {
            fill: '#6366f1',
            "fill-opacity": 0.8
        }
    }
});
</script>
<?= $this->endSection() ?>
