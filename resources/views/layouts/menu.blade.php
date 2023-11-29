<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a href="index.html" class="app-brand-link">
            <img style="width: 60px;" src="{{ asset('logo.png') }}" alt="">
            <span class="demo menu-text fw-bolder ms-2" style="font-size: 20px;">{{ __('messages.panel_name') }}</span>
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
        <li class="menu-item {{ request()->is('admin') ? 'active' : '' }}">
            <a href="/" class="menu-link">
                <i class='menu-icon tf-icons bx bxs-dashboard'></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <!-- Layouts -->
        @can('user_management_access')
            <li
                class="menu-item {{ request()->is('admin/users') || request()->is('admin/users/*') || request()->is('admin/roles') || request()->is('admin/roles/*') || request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxs-user-circle'></i>
                    <div data-i18n="Layouts">User Management</div>
                </a>

                <ul class="menu-sub">
                    @can('permission_access')
                        <li
                            class="menu-item {{ request()->is('admin/permissions') || request()->is('admin/permissions/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.permissions.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Permission</div>
                            </a>
                        </li>
                    @endcan
                    @can('role_access')
                        <li
                            class="menu-item {{ request()->is('admin/roles') || request()->is('admin/roles/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.roles.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Roles</div>
                            </a>
                        </li>
                    @endcan
                    @can('user_access')
                        <li
                            class="menu-item {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.users.index') }}" class="menu-link">
                                <div data-i18n="Without menu">Users</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Partners</span>
        </li>

        @can('principle_access')
            <li
                class="menu-item {{ request()->is('admin/principles') || request()->is('admin/principles/*') ? 'active' : '' }}">
                <a href="{{ route('admin.principles.index') }}" class="menu-link">
                    <i class='menu-icon tf-icons bx bxs-user-check'></i>
                    <div data-i18n="Analytics">{{ __('messages.principle.title') }}</div>
                </a>
            </li>
        @endcan

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">PRODUCTS</span>
        </li>
        @can('product_management_access')
            <li
                class="menu-item {{ request()->is('admin/ingredients') || request()->is('admin/ingredients/*') || request()->is('admin/products') || request()->is('admin/products/*') || request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active open' : '' }}">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                    <i class='menu-icon tf-icons bx bxs-capsule'></i>
                    <div data-i18n="Account Settings">Products Management</div>
                </a>
                <ul class="menu-sub">
                    @can('category_access')
                        <li
                            class="menu-item {{ request()->is('admin/categories') || request()->is('admin/categories/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.categories.index') }}" class="menu-link">
                                <div data-i18n="Account">{{ __('messages.category.title') }}</div>
                            </a>
                        </li>
                    @endcan
                    @can('ingredient_access')
                        <li
                            class="menu-item {{ request()->is('admin/ingredients') || request()->is('admin/ingredients/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.ingredients.index') }}" class="menu-link">
                                <div data-i18n="Account">{{ __('messages.ingredient.title') }}</div>
                            </a>
                        </li>
                    @endcan

                    @can('product_access')
                        <li
                            class="menu-item {{ request()->is('admin/products') || request()->is('admin/products/*') ? 'active open' : '' }}">
                            <a href="{{ route('admin.products.index') }}" class="menu-link">
                                <div data-i18n="Account">{{ __('messages.product.title') }}</div>
                            </a>
                        </li>
                    @endcan
                </ul>
            </li>
        @endcan
    </ul>
</aside>
