        <nav class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="d-flex align-items-center">
                    <i class="bi bi-speedometer2 text-primary me-2"></i>
                    <span class="fw-bold">{{ config('app.name') }}</span>
                </div>
                <div class="mt-2">
                    <small class="text-muted">Welcome, {{ Auth::user()->name }}!</small>
                    <div class="mt-1">
                        <span class="badge bg-{{ Auth::user()->role === 'admin' ? 'danger' : 'primary' }}">
                            {{ ucfirst(Auth::user()->role) }}
                        </span>
                    </div>
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
