<?= $this->extend('layouts/main') ?>

<?= $this->section('breadcrumb') ?>
<div class="row">
    <div class="col-sm-6"><h3 class="mb-0">Dashboard v2</h3></div>
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-end">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Dashboard v2</li>
        </ol>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-primary shadow-sm"><i class="bi bi-gear-fill"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">CPU Traffic</span>
                <span class="info-box-number">10<small>%</small></span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-danger shadow-sm"><i class="bi bi-hand-thumbs-up-fill"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Likes</span>
                <span class="info-box-number">41,410</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-success shadow-sm"><i class="bi bi-cart-fill"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Sales</span>
                <span class="info-box-number">760</span>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-6 col-md-3">
        <div class="info-box">
            <span class="info-box-icon text-bg-warning shadow-sm"><i class="bi bi-people-fill"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">New Members</span>
                <span class="info-box-number">2,000</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card mb-4">
            <div class="card-header">
                <h5 class="card-title">Monthly Recap Report</h5>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-8">
                        <p class="text-center"><strong>Sales: 1 Jan, 2023 - 30 Jul, 2023</strong></p>
                        <div id="sales-chart"></div>
                    </div>
                    <div class="col-md-4">
                        <p class="text-center"><strong>Goal Completion</strong></p>
                        <div class="progress-group">Add Products to Cart<span class="float-end"><b>160</b>/200</span><div class="progress progress-sm"><div class="progress-bar text-bg-primary" style="width: 80%"></div></div></div>
                        <div class="progress-group">Complete Purchase<span class="float-end"><b>310</b>/400</span><div class="progress progress-sm"><div class="progress-bar text-bg-danger" style="width: 75%"></div></div></div>
                        <div class="progress-group"><span class="progress-text">Visit Premium Page</span><span class="float-end"><b>480</b>/800</span><div class="progress progress-sm"><div class="progress-bar text-bg-success" style="width: 60%"></div></div></div>
                        <div class="progress-group">Send Inquiries<span class="float-end"><b>250</b>/500</span><div class="progress progress-sm"><div class="progress-bar text-bg-warning" style="width: 50%"></div></div></div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-md-3 col-6"><div class="text-center border-end"><span class="text-success"><i class="bi bi-caret-up-fill"></i> 17%</span><h5 class="fw-bold mb-0">$35,210.43</h5><span class="text-uppercase">TOTAL REVENUE</span></div></div>
                    <div class="col-md-3 col-6"><div class="text-center border-end"><span class="text-info"><i class="bi bi-caret-left-fill"></i> 0%</span><h5 class="fw-bold mb-0">$10,390.90</h5><span class="text-uppercase">TOTAL COST</span></div></div>
                    <div class="col-md-3 col-6"><div class="text-center border-end"><span class="text-success"><i class="bi bi-caret-up-fill"></i> 20%</span><h5 class="fw-bold mb-0">$24,813.53</h5><span class="text-uppercase">TOTAL PROFIT</span></div></div>
                    <div class="col-md-3 col-6"><div class="text-center"><span class="text-danger"><i class="bi bi-caret-down-fill"></i> 18%</span><h5 class="fw-bold mb-0">1200</h5><span class="text-uppercase">GOAL COMPLETIONS</span></div></div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Latest Orders</h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-lte-toggle="card-collapse">
                        <i data-lte-icon="expand" class="bi bi-plus-lg"></i>
                        <i data-lte-icon="collapse" class="bi bi-dash-lg"></i>
                    </button>
                </div>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table m-0">
                        <thead>
                            <tr><th>Order ID</th><th>Item</th><th>Status</th><th>Popularity</th></tr>
                        </thead>
                        <tbody>
                            <tr><td><a href="#" class="link-primary">OR9842</a></td><td>Call of Duty IV</td><td><span class="badge text-bg-success">Shipped</span></td><td><div id="table-sparkline-1"></div></td></tr>
                            <tr><td><a href="#" class="link-primary">OR1848</a></td><td>Samsung Smart TV</td><td><span class="badge text-bg-warning">Pending</span></td><td><div id="table-sparkline-2"></div></td></tr>
                            <tr><td><a href="#" class="link-primary">OR7429</a></td><td>iPhone 6 Plus</td><td><span class="badge text-bg-danger">Delivered</span></td><td><div id="table-sparkline-3"></div></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer clearfix">
                <a href="javascript:void(0)" class="btn btn-sm btn-primary float-start">Place New Order</a>
                <a href="javascript:void(0)" class="btn btn-sm btn-secondary float-end">View All Orders</a>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="info-box mb-3 text-bg-warning"><span class="info-box-icon"><i class="bi bi-tag-fill"></i></span><div class="info-box-content"><span class="info-box-text">Inventory</span><span class="info-box-number">5,200</span></div></div>
        <div class="info-box mb-3 text-bg-success"><span class="info-box-icon"><i class="bi bi-heart-fill"></i></span><div class="info-box-content"><span class="info-box-text">Mentions</span><span class="info-box-number">92,050</span></div></div>
        <div class="info-box mb-3 text-bg-danger"><span class="info-box-icon"><i class="bi bi-cloud-download"></i></span><div class="info-box-content"><span class="info-box-text">Downloads</span><span class="info-box-number">114,381</span></div></div>
        <div class="info-box mb-3 text-bg-info"><span class="info-box-icon"><i class="bi bi-chat-fill"></i></span><div class="info-box-content"><span class="info-box-text">Direct Messages</span><span class="info-box-number">163,921</span></div></div>
    </div>
</div>
<?= $this->endSection() ?>

<?= $this->section('javascript') ?>
<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.min.js" integrity="sha256-+vh8GkaU7C9/wbSLIcwq82tQ2wTf44aOHA8HlBMwRI8=" crossorigin="anonymous"></script>
<script>
const sales_chart = new ApexCharts(document.querySelector('#sales-chart'), {
    series: [{name: 'Digital Goods', data: [28, 48, 40, 19, 86, 27, 90]}, {name: 'Electronics', data: [65, 59, 80, 81, 56, 55, 40]}],
    chart: {height: 180, type: 'area', toolbar: {show: false}},
    legend: {show: false},
    colors: ['#0d6efd', '#20c997'],
    dataLabels: {enabled: false},
    stroke: {curve: 'smooth'},
    xaxis: {type: 'datetime', categories: ['2023-01-01', '2023-02-01', '2023-03-01', '2023-04-01', '2023-05-01', '2023-06-01', '2023-07-01']},
    tooltip: {x: {format: 'MMMM yyyy'}}
});
sales_chart.render();

[[25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54], [12, 56, 21, 39, 73, 45, 64, 52, 36, 59, 44], [15, 46, 21, 59, 33, 15, 34, 42, 56, 19, 64]].forEach((data, i) => {
    new ApexCharts(document.querySelector('#table-sparkline-' + (i + 1)), {
        series: [{data}],
        chart: {type: 'line', width: 150, height: 30, sparkline: {enabled: true}},
        colors: ['var(--bs-primary)'],
        stroke: {width: 2},
        tooltip: {fixed: {enabled: false}, x: {show: false}, y: {title: {formatter() {return '';}}}, marker: {show: false}}
    }).render();
});
</script>
<?= $this->endSection() ?>
