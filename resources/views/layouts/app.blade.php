<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Skydash - Dashboard</title>
    
    <!-- Bootstrap 5 CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
</head>
<body>
    <div class="wrapper">
        <!-- Sidebar -->
        @include('layouts.sidebar')

        <!-- Main Content -->
        <div class="main-content">
            <!-- Top Navbar -->
            @include('layouts.navbar')

            <!-- Dashboard Content -->
            <div class="container-fluid p-4">
                <!-- Welcome Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="welcome-section">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <h2 class="mb-2">Welcome John</h2>
                                    <p class="text-muted mb-0">All systems are running smoothly! You have <span class="text-primary">3 unread alerts!</span></p>
                                </div>
                                <div class="col-md-6 text-end">
                                    <div class="dropdown">
                                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="bi bi-calendar3 me-2"></i>Today (10 Jan 2021)
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stats Cards Row -->
                <div class="row mb-4">
                    <!-- Main Illustration Card -->
                    <div class="col-lg-5 mb-4">
                        <div class="card main-card h-100">
                            <div class="card-body position-relative">
                                <div class="weather-info">
                                    <div class="d-flex align-items-center mb-3">
                                        <i class="bi bi-sun weather-icon me-2"></i>
                                        <span class="temperature">31°</span>
                                        <div class="ms-3">
                                            <div class="fw-bold">Chicago</div>
                                            <div class="text-muted small">Illinois</div>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Illustration placeholder -->
                                <div class="illustration-area">
                                    <div class="illustration-placeholder">
                                        <i class="bi bi-people-fill text-primary" style="font-size: 4rem;"></i>
                                        <p class="text-muted mt-2">Team Collaboration</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Stats Cards -->
                    <div class="col-lg-7">
                        <div class="row h-100">
                            <div class="col-md-6 mb-4">
                                <div class="card stat-card stat-card-blue h-100">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-white-50">Today's Bookings</h6>
                                        <h2 class="card-title text-white mb-2">4006</h2>
                                        <small class="text-white-50">10.00% (30 days)</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card stat-card stat-card-purple h-100">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-white-50">Total Bookings</h6>
                                        <h2 class="card-title text-white mb-2">61344</h2>
                                        <small class="text-white-50">22.00% (30 days)</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card stat-card stat-card-indigo h-100">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-white-50">Number of Meetings</h6>
                                        <h2 class="card-title text-white mb-2">34040</h2>
                                        <small class="text-white-50">2.00% (30 days)</small>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4">
                                <div class="card stat-card stat-card-orange h-100">
                                    <div class="card-body">
                                        <h6 class="card-subtitle mb-2 text-white-50">Number of Clients</h6>
                                        <h2 class="card-title text-white mb-2">47033</h2>
                                        <small class="text-white-50">0.22% (30 days)</small>
                                        
                                        <!-- Upgrade to Pro Button -->
                                        <div class="upgrade-btn">
                                            <button class="btn btn-warning btn-sm rounded-pill">
                                                <i class="bi bi-crown me-1"></i>
                                                Upgrade to Pro
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Bottom Section -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">Order Details</h5>
                                    <i class="bi bi-circle-fill text-warning"></i>
                                </div>
                                <div class="order-list">
                                    <div class="order-item mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Processing Orders</span>
                                            <span class="fw-bold">125</span>
                                        </div>
                                    </div>
                                    <div class="order-item mb-3">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Completed Orders</span>
                                            <span class="fw-bold">1,456</span>
                                        </div>
                                    </div>
                                    <div class="order-item">
                                        <div class="d-flex justify-content-between">
                                            <span class="text-muted">Cancelled Orders</span>
                                            <span class="fw-bold">12</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h5 class="card-title mb-0">Sales Report</h5>
                                    <a href="#" class="text-primary text-decoration-none">View all</a>
                                </div>
                                <div class="sales-chart-placeholder">
                                    <div class="d-flex align-items-center justify-content-center" style="height: 120px;">
                                        <i class="bi bi-bar-chart-line text-primary" style="font-size: 3rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle CDN -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom JavaScript -->
    <script src="{{ asset('assets/js/script.js') }}"></script>
</body>
</html>