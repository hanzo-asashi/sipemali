<div class="row match-height">
    <!-- Goal Overview Card -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="card-title">Goal Overview</h4>
                <i data-feather="help-circle" class="font-medium-3 text-muted cursor-pointer"></i>
            </div>
            <div class="card-body p-0">
                <div id="goal-overview-radial-bar-chart" class="my-2"></div>
                <div class="row border-top text-center mx-0">
                    <div class="col-6 border-end py-1">
                        <p class="card-text text-muted mb-0">Completed</p>
                        <h3 class="fw-bolder mb-0">786,617</h3>
                    </div>
                    <div class="col-6 py-1">
                        <p class="card-text text-muted mb-0">In Progress</p>
                        <h3 class="fw-bolder mb-0">13,561</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--/ Goal Overview Card -->
    <div class="col-lg-4 col-md-6 col-12">
        <div class="row match-height">
            <!-- Bar Chart - Orders -->
            <div class="col-lg-6 col-md-3 col-6">
                <div class="card">
                    <div class="card-body pb-50">
                        <h6>Orders</h6>
                        <h2 class="fw-bolder mb-1">2,76k</h2>
                        <div id="statistics-order-chart"></div>
                    </div>
                </div>
            </div>
            <!--/ Bar Chart - Orders -->

            <!-- Line Chart - Profit -->
            <div class="col-lg-6 col-md-3 col-6">
                <div class="card card-tiny-line-stats">
                    <div class="card-body pb-50">
                        <h6>Profit</h6>
                        <h2 class="fw-bolder mb-1">6,24k</h2>
                        <div id="statistics-profit-chart"></div>
                    </div>
                </div>
            </div>
            <!--/ Line Chart - Profit -->

            <!-- Earnings Card -->
            <div class="col-lg-12 col-md-6 col-12">
                <div class="card earnings-card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-6">
                                <h4 class="card-title mb-1">Earnings</h4>
                                <div class="font-small-2">This Month</div>
                                <h5 class="mb-1">$4055.56</h5>
                                <p class="card-text text-muted font-small-2">
                                    <span class="fw-bolder">68.2%</span><span> more earnings than last month.</span>
                                </p>
                            </div>
                            <div class="col-6">
                                <div id="earnings-chart"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/ Earnings Card -->
        </div>
    </div>
</div>
