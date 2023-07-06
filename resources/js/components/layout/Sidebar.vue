<template>
    <!-- Sidebar -->
    <ul
        class="navbar-nav sidebar sidebar-dark accordion bg-primary-blue"
        id="accordionSidebar"
    >
        <!-- Sidebar - Brand -->
        <router-link
            class="sidebar-brand d-flex align-items-center justify-content-center"
            :to="{ name: 'Dashboard' }"
        >
            <div class="sidebar-brand-icon rotate-n-15">
                <img style="width: 45px" src="/assets/img/healthy.png" alt="" />
            </div>
            <div class="sidebar-brand-text mx-3" style="white-space: nowrap">
                FLimen Health
            </div>
        </router-link>

        <!-- Divider -->
        <!-- <hr class="sidebar-divider my-0" /> -->

        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Dashboard' }">
                <i class="fa fa-bar-chart mr-1"></i>
                <span>Dashboard</span></router-link
            >
        </li>

        <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Home' }">
                <i class="fa fa-home mr-1"></i>
                <span>Home</span></router-link
            >
        </li>
        <li class="nav-item">
            <router-link class="nav-link" :to="{ name: 'Sections' }">
                <i class="fa fa-stethoscope mr-1" aria-hidden="true"></i>
                <span>Sections</span></router-link
            >
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">Interface</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="#"
                data-toggle="collapse"
                data-target="#collapseTwo"
                aria-expanded="true"
                aria-controls="collapseTwo"
            >
                <i class="fas fa-fw fa-cog mr-1"></i>
                <span>Components</span>
            </a>
            <div
                id="collapseTwo"
                class="collapse"
                aria-labelledby="headingTwo"
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Components:</h6>
                    <a class="collapse-item" href="buttons.html">Buttons</a>
                    <a class="collapse-item" href="cards.html">Cards</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Utilities Collapse Menu -->
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="#"
                data-toggle="collapse"
                data-target="#collapseUtilities"
                aria-expanded="true"
                aria-controls="collapseUtilities"
            >
                <i class="fas fa-fw fa-wrench mr-1"></i>
                <span>Utilities</span>
            </a>
            <div
                id="collapseUtilities"
                class="collapse"
                aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Custom Utilities:</h6>
                    <a class="collapse-item" href="utilities-color.html"
                        >Colors</a
                    >
                    <a class="collapse-item" href="utilities-border.html"
                        >Borders</a
                    >
                    <a class="collapse-item" href="utilities-animation.html"
                        >Animations</a
                    >
                    <a class="collapse-item" href="utilities-other.html"
                        >Other</a
                    >
                </div>
            </div>
        </li>

        <!-- Heading -->
        <div class="sidebar-heading">Addons</div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a
                class="nav-link collapsed"
                href="#"
                data-toggle="collapse"
                data-target="#collapsePages"
                aria-expanded="true"
                aria-controls="collapsePages"
            >
                <i class="fas fa-fw fa-folder mr-1"></i>
                <span>Pages</span>
            </a>
            <div
                id="collapsePages"
                class="collapse"
                aria-labelledby="headingPages"
                data-parent="#accordionSidebar"
            >
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Login Screens:</h6>
                    <a class="collapse-item" href="login.html">Login</a>
                    <a class="collapse-item" href="register.html">Register</a>
                    <a class="collapse-item" href="forgot-password.html"
                        >Forgot Password</a
                    >
                    <div class="collapse-divider"></div>
                    <h6 class="collapse-header">Other Pages:</h6>
                    <a class="collapse-item" href="404.html">404 Page</a>
                    <a class="collapse-item" href="blank.html">Blank Page</a>
                </div>
            </div>
        </li>

        <!-- Nav Item - Charts -->
        <li class="nav-item">
            <a class="nav-link" href="charts.html">
                <i class="fas fa-fw fa-chart-area mr-1"></i>
                <span>Charts</span></a
            >
        </li>

        <!-- Nav Item - Tables -->
        <li class="nav-item">
            <a class="nav-link" href="tables.html">
                <i class="fas fa-fw fa-table mr-1"></i>
                <span>Tables</span></a
            >
        </li>

        <!-- Sidebar Toggler (Sidebar) -->
        <div class="text-center d-none d-md-inline" v-if="false">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <!-- End of Sidebar -->
</template>

<script>
export default {};
</script>

<style scoped>
.router-link-exact-active {
    color: rgb(255, 255, 255) !important;
}
.router-link-exact-active i {
    color: white !important;
}
</style>
