@php
use App\Helper\Helper;
Helper::loadPermission();

$secondParam = Request::segment(2);
$thirdParam = Request::segment(3);
@endphp
<div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <li class="nav-item me-auto">
                <a class="navbar-brand" href="">
                    <span class="brand-logo">

                    </span>
                    <h2 class="brand-text">{{ config('app.name') }}</h2>
                </a>
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i
                        class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i
                        class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc"
                        data-ticon="disc"></i></a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class=" nav-item"><a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}"><i
                        data-feather="home"></i><span class="menu-title text-truncate"
                        data-i18n="Dashboards">Dashboards</span></a>
                <ul class="menu-content">
                    <li class="{{ $secondParam == 'dashboard' ? 'active' : '' }}"><a class="d-flex align-items-center"
                            href="{{ route('admin.dashboard') }}"><i data-feather="left-arrow"></i><span
                                class="menu-item text-truncate" data-i18n="Analytics">Dashboard</span></a>
                    </li>
                    @can('master-policy.performArray', [['layout'], 'view'])
                        <li class="{{ $secondParam == 'layout' ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('admin.layout.index') }}"><i data-feather="left-arrow"></i><span
                                    class="menu-item text-truncate" data-i18n="Analytics">Layout</span></a>
                        </li>
                    @endcan
                    @can('master-policy.performArray', [['site-setting'], 'view'])
                        <li class="{{ $secondParam == 'setting' ? 'active' : '' }}"><a class="d-flex align-items-center"
                                href="{{ route('admin.setting.index') }}"><i data-feather="left-arrow"></i><span
                                    class="menu-item text-truncate" data-i18n="Analytics">Setting</span></a>
                        </li>
                    @endcan
                    @if (!Auth::guest() && Auth::user()->admin_type_id == 1)
                        <li class="{{ $secondParam == 'admin-type' ? 'active' : '' }}"><a
                                class="d-flex align-items-center" href="{{ route('admin.admin-type.index') }}"><i
                                    data-feather="left-arrow"></i><span class="menu-item text-truncate"
                                    data-i18n="Analytics">Role</span></a>
                        </li>
                    @endif
                    {{-- @can('master-policy.performArray', [['users'], 'view']) --}}
                        <li class="{{ $secondParam == 'users' ? 'active' : '' }}"><a
                                class="d-flex align-items-center" href="{{ route('admin.users.index') }}"><i
                                    data-feather="left-arrow"></i><span class="menu-item text-truncate"
                                    data-i18n="Analytics">Users</span></a>
                        </li>
                    {{-- @endcan --}}
                </ul>
            </li>
            <li class=" navigation-header"><span data-i18n="Apps &amp; Pages">Apps &amp; Pages</span><i
                    data-feather="more-horizontal"></i>
            </li>
        </ul>
    </div>
</div>
