@php
    $user = auth()->user();
@endphp

<div class="app-brand demo">
    <a href="#" class="app-brand-link">
        <span class="app-brand-text menu-text fw-bolder fs-3 ms-2">LMS PPKD-JP</span>
    </a>

    <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
        <i class="bx bx-chevron-left bx-sm align-middle"></i>
    </a>
</div>

<div class="menu-inner-shadow"></div>

<ul class="menu-inner py-1">

    @php
        use App\Models\UserRole;
        $user = Auth::user();
        $roleId = $user ? UserRole::where('user_id', $user->id)->value('role_id') : null;
    @endphp

    {{-- SUPER ADMIN --}}
    @if ($roleId === 4)
        <!-- Dashboard -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Super Admin</span></li>

        <li class="menu-item active">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Administrator</span></li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-file-archive"></i>
                <div data-i18n="Form Elements">Master Data Users</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/users" class="menu-link">
                        <div data-i18n="Basic Inputs">Users</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/user_role" class="menu-link">
                        <div data-i18n="Basic Inputs">User Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/instructors" class="menu-link">
                        <div data-i18n="Input groups">Instructors</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/students" class="menu-link">
                        <div data-i18n="Input groups">Students</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-file-archive"></i>
                <div data-i18n="Form Elements">Master Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/roles" class="menu-link">
                        <div data-i18n="Basic Inputs">Roles</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/majors" class="menu-link">
                        <div data-i18n="Input groups">Majors</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Modul</span></li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-file-archive"></i>
                <div data-i18n="Form Elements">Moduls</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/moduls" class="menu-link">
                        <div data-i18n="Basic Inputs">Moduls</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/pos" class="menu-link">
                        <div data-i18n="Basic Inputs">Week 1</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-input-groups.html" class="menu-link">
                        <div data-i18n="Input groups">Week 2</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- PIC --}}
    @elseif($roleId === 1)
        <li class="menu-header small text-uppercase"><span class="menu-header-text">PIC</span></li>

        <li class="menu-item active">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data Users</span></li>

        <li class="menu-item">
            <a href="/users" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Analytics">Users</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Data PPKD</span></li>

        <li class="menu-item">
            <a href="/class" class="menu-link">
                <i class='menu-icon tf-icons bx bx-chalkboard'></i>
                <div data-i18n="Analytics">Class</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div data-i18n="Form Elements">Instructors Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/instructor" class="menu-link">
                        <div data-i18n="Basic Inputs">Web Programming</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="instructor/mobile" class="menu-link">
                        <div data-i18n="Input groups">Mobile Programming</div>
                    </a>
                </li>
            </ul>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bxs-group"></i>
                <div data-i18n="Form Elements">Students Data</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/pos" class="menu-link">
                        <div data-i18n="Basic Inputs">Web Programming</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="forms-input-groups.html" class="menu-link">
                        <div data-i18n="Input groups">Mobile Programming</div>
                    </a>
                </li>
            </ul>
        </li>
        {{-- INSTRUCTOR --}}
    @elseif ($roleId === 2)
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Instructor</span></li>

        <li class="menu-item active">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>

        <li class="menu-header small text-uppercase"><span class="menu-header-text">Modul Data</span></li>

        <li class="menu-item active">
            <a href="/moduls" class="menu-link">
                <i class="menu-icon tf-icons bx bxs-file-archive"></i>
                <div data-i18n="Analytics">Modul</div>
            </a>
        </li>

        <li class="menu-item">
            <a href="javascript:void(0);" class="menu-link menu-toggle">
                <i class="menu-icon tf-icons bx bx-calendar"></i>
                <div data-i18n="Form Elements">Courses</div>
            </a>
            <ul class="menu-sub">
                <li class="menu-item">
                    <a href="/users" class="menu-link">
                        <div data-i18n="Basic Inputs">Week 1</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a href="/user_role" class="menu-link">
                        <div data-i18n="Basic Inputs">Week 2</div>
                    </a>
                </li>
            </ul>
        </li>

        {{-- ADMIN --}}
    @elseif ($roleId === 3)
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Admin</span></li>

        <li class="menu-item active">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        {{-- STUDENT --}}
    @elseif ($roleId === 5)
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Student</span></li>

        <li class="menu-item active">
            <a href="/dashboard" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
    @endif

    <!-- Misc -->
    <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>
    <li class="menu-item">
        <a href="https://github.com/themeselection/sneat-html-admin-template-free/issues" target="_blank"
            class="menu-link">
            <i class="menu-icon tf-icons bx bx-support"></i>
            <div data-i18n="Support">Support</div>
        </a>
    </li>
    <li class="menu-item">
        <a href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/" target="_blank"
            class="menu-link">
            <i class="menu-icon tf-icons bx bx-file"></i>
            <div data-i18n="Documentation">Documentation</div>
        </a>
    </li>
</ul>
