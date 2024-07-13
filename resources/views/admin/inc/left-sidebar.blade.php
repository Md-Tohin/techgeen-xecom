<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

    <div class="app-brand demo ">
        <a href="index.html" class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z"
                        fill="#7367F0" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616" />
                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd"
                        d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616" />
                    <path fill-rule="evenodd" clip-rule="evenodd"
                        d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z"
                        fill="#7367F0" />
                </svg>
            </span>
            <span class="app-brand-text demo menu-text fw-bold">Vuexy</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto">
            <i class="ti menu-toggle-icon d-none d-xl-block align-middle"></i>
            <i class="ti ti-x d-block d-xl-none ti-md align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboards -->
        <li class="menu-item {{ Route::is('admin.dashboard') ? 'active' : '' }}">
            <a href="{{ route('admin.dashboard') }}" class="menu-link">
                <i class="menu-icon tf-icons ti ti-smart-home"></i>
                <div>Dashboard</div>
            </a>
        </li>

        <!-- Products Management -->
        <li
            class="menu-item {{ Route::is('brands.index') || Route::is('brands.create') || Route::is('brands.edit') || Route::is('attributes.index') || Route::is('attributes.create') || Route::is('attributes.edit') || Route::is('categories.index') || Route::is('categories.create') || Route::is('categories.edit') || Route::is('colors.index') || Route::is('colors.create') || Route::is('colors.edit') || Route::is('products.index') || Route::is('products.create') || Route::is('products.edit') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div>Products</div>
            </a>
            <ul class="menu-sub">
                @if (Auth::user()->can('products.create'))
                    <li
                        class="menu-item {{ Route::is('products.create') ? 'active' : '' }}">
                        <a href="{{ route('products.create') }}" class="menu-link">
                            <div>Add New Product</div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->can('products.view'))
                    <li
                        class="menu-item {{ Route::is('products.index') ? 'active' : '' }}">
                        <a href="{{ route('products.index') }}" class="menu-link">
                            <div>All Product</div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->can('category.view'))
                    <li
                        class="menu-item {{ Route::is('categories.index') || Route::is('categories.create') || Route::is('categories.edit') ? 'active' : '' }}">
                        <a href="{{ route('categories.index') }}" class="menu-link">
                            <div>Category</div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->can('attributes.view'))
                    <li
                        class="menu-item {{ Route::is('attributes.index') || Route::is('attributes.create') || Route::is('attributes.edit') ? 'active' : '' }}">
                        <a href="{{ route('attributes.index') }}" class="menu-link">
                            <div>Attributes</div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->can('brand.view'))
                    <li
                        class="menu-item {{ Route::is('brands.index') || Route::is('brands.create') || Route::is('brands.edit') ? 'active' : '' }}">
                        <a href="{{ route('brands.index') }}" class="menu-link">
                            <div>Brands</div>
                        </a>
                    </li>
                @endif
                @if (Auth::user()->can('colors.view'))
                    <li
                        class="menu-item {{ Route::is('colors.index') || Route::is('colors.create') || Route::is('colors.edit') ? 'active' : '' }}">
                        <a href="{{ route('colors.index') }}" class="menu-link">
                            <div>Colors</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <!-- User Management -->
        <li
            class="menu-item {{ Route::is('roles.index') || Route::is('roles.create') || Route::is('roles.edit') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div>User Management</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="app-user-list.html" class="menu-link">
                        <div>Administrators</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="app-user-list.html" class="menu-link">
                        <div>Users</div>
                    </a>
                </li>
                @if (Auth::user()->can('role.view'))
                    <li
                        class="menu-item {{ Route::is('roles.index') || Route::is('roles.create') || Route::is('roles.edit') ? 'active' : '' }}">
                        <a href="{{ route('roles.index') }}" class="menu-link">
                            <div>Roles & Permissions</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

        <!-- Website Setup -->
        <li class="menu-item {{ Route::is('setup.general-settings') ? 'active open' : '' }}">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons ti ti-users"></i>
                <div>Website Setup</div>
            </a>
            <ul class="menu-sub">
                @if (Auth::user()->can('Website Setup.General Settings View'))
                    <li class="menu-item {{ Route::is('setup.general-settings') ? 'active' : '' }}">
                        <a href="{{ route('setup.general-settings') }}" class="menu-link">
                            <div>General Settings</div>
                        </a>
                    </li>
                @endif
            </ul>
        </li>

    </ul>
</aside>
