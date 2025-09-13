            <nav class="navbar navbar-expand-lg navbar-light bg-white border-bottom">
                <div class="container-fluid">
                    <button class="btn btn-link sidebar-toggle me-3" id="sidebarToggle">
                        <i class="bi bi-list s"></i>
                    </button>
                    
                    <div class="search-box me-auto">

                    </div>
                    
                    <div class="navbar-nav flex-row align-items-center">
                        <button class="btn btn-link me-3" id="themeToggle" title="Toggle Theme">
                            <i class="bi bi-sun theme-icon"></i>
                        </button>
                    
                        
                        <div class="dropdown">
                            <button class="btn btn-link d-flex align-items-center" data-bs-toggle="dropdown">
                                <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center me-2" style="width: 32px; height: 32px;">
                                    <span class="text-white fw-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                                </div>
                                <span class="me-2">{{ Auth::user()->name }}</span>
                                <i class="bi bi-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><h6 class="dropdown-header">{{ Auth::user()->email }}</h6></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" class="d-inline">
                                        @csrf
                                        <button type="submit" class="dropdown-item text-danger">
                                            <i class="bi bi-box-arrow-right me-2"></i>Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </nav>