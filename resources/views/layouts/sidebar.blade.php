        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="card-title d-flex align-items-center">
                    <i class="bi bi-speedometer2 text-primary me-2"></i>
                    <span class="fw-bold">{{ config('app.name') }}</span>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Welcome, {{ Auth::user()->name }}!</small>
                </div>
            </div>

            <!-- User Profile Section -->
            <div class="sidebar-profile p-3 border-bottom">
                <div class="d-flex align-items-center">
                    <div class="profile-avatar me-3">
                        @if(Auth::user()->avatar)
                            <img src="{{ asset('storage/' . Auth::user()->avatar) }}" 
                                 alt="{{ Auth::user()->name }}" 
                                 class="rounded-circle"
                                 style="width: 50px; height: 50px; object-fit: cover;">
                        @else
                            <div class="rounded-circle bg-primary d-flex align-items-center justify-content-center"
                                 style="width: 50px; height: 50px;">
                                <span class="text-white fw-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                            </div>
                        @endif
                    </div>
                    <div class="profile-info flex-grow-1">
                        <div class="fw-bold card-title">{{ Auth::user()->name }}</div>
                        <div class="text-muted small">{{ ucfirst(Auth::user()->role) }}</div>
                        <div class="text-muted small">{{ Auth::user()->email }}</div>
                    </div>
                </div>
                <div class="mt-2">
                    <a href="{{ route('dashboard.profile.show') }}" class="btn btn-outline-primary btn-sm w-100">
                        <i class="bi bi-person-gear me-1"></i>View Profile
                    </a>
                </div>
            </div>

            <div class="sidebar-menu">
                <ul class="list-unstyled">
                    <li class="menu-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <a href="{{ route('dashboard') }}" class="menu-link" data-title="Dashboard">
                            <i class="bi bi-house-door"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    @if(Auth::user()->role === 'admin')
                    <!-- Admin Section -->

                    <li class="menu-item {{ request()->routeIs('dashboard.users') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.users') }}" class="menu-link" data-title="Users">
                            <i class="bi bi-people"></i>
                            <span>Users</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('dashboard.categories') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.categories') }}" class="menu-link" data-title="Categories">
                            <i class="bi bi-folder"></i>
                            <span>Categories</span>
                        </a>
                    </li>
                    @endif

                    <!-- Profile Section -->

                    <!-- Content Section -->
                    <li class="menu-item {{ request()->routeIs('dashboard.posts') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.posts') }}" class="menu-link" data-title="Posts">
                            <i class="bi bi-file-earmark-text"></i>
                            <span>Posts</span>
                        </a>
                    </li>
                    <li class="menu-item {{ request()->routeIs('dashboard.tags') ? 'active' : '' }}">
                        <a href="{{ route('dashboard.tags') }}" class="menu-link" data-title="Tags">
                            <i class="bi bi-tags"></i>
                            <span>Tags</span>
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
