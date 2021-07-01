<template>
  <div>
    <!-- Page Container -->
    <div
      id="page-container"
      class="
        sidebar-o sidebar-dark
        enable-page-overlay
        side-scroll
        page-header-fixed
        main-content-narrow
        side-trans-enabled
      "
      :class="[
        showSidebarMini ? 'sidebar-mini' : '',
        toggleMenu ? 'sidebar-o-xs' : '',
      ]"
    >
      <div id="page-overlay" />

      <nav id="sidebar" aria-label="Main Navigation">
        <!-- Side Header -->
        <div class="content-header bg-white-5">
          <!-- Logo -->
          <nuxt-link to="/admin" class="font-w600 text-dual">
            <span class="smini-visible">
              <i class="fa fa-circle-notch text-primary" />
            </span>
            <span class="smini-hide font-size-h5 tracking-wider">
              ELITE PRINTS
            </span>
          </nuxt-link>
          <a
            class="d-lg-none btn btn-sm btn-dual ml-1"
            data-toggle="layout"
            href="javascript:void(0)"
            @click="toggleMenu = !toggleMenu"
          >
            <i class="fa fa-fw fa-times"></i>
          </a>
          <!-- END Logo -->
        </div>
        <!-- END Side Header -->

        <!-- Side Navigation -->
        <div class="content-side">
          <ul class="nav-main">
            <li
              class="nav-main-item"
              @click="
                toggleNavMainOpen = false;
                toggleMenu = false;
              "
            >
              <nuxt-link
                to="/admin"
                exact
                :class="[
                  exactPageMatch('/admin') ? activeClass : '',
                  'nav-main-link',
                ]"
                data-toggle="submenu"
              >
                <i class="nav-main-link-icon far fa-chart-bar" />
                <span class="nav-main-link-name">Reports</span>
              </nuxt-link>
            </li>
            <li
              class="nav-main-item"
              @click="
                toggleNavMainOpen = false;
                toggleMenu = false;
              "
            >
              <nuxt-link
                to="/admin/orders"
                exact
                :class="[
                  currentPage.includes('orders') ? activeClass : '',
                  'nav-main-link',
                ]"
                data-toggle="submenu"
              >
                <i class="nav-main-link-icon si si-handbag" />
                <span class="nav-main-link-name">Orders</span>
              </nuxt-link>
            </li>
            <li
              class="nav-main-item"
              :class="{ open: toggleNavMainOpen }"
              @click="toggleNavMainOpen = !toggleNavMainOpen"
            >
              <nuxt-link
                to="#"
                exact
                :class="[
                  currentPage.includes('admin/products') ? activeClass : '',
                  'nav-main-link',
                  'nav-main-link-submenu',
                ]"
                data-toggle="submenu"
              >
                <i
                  :class="[
                    currentPage.includes('admin/products') ? menuActive : '',
                    'nav-main-link-icon-menu',
                    'fa fa-boxes',
                  ]"
                />
                <span class="nav-main-link-name">Products</span>
              </nuxt-link>
              <ul class="nav-main-submenu">
                <nuxt-link
                  to="/admin/products"
                  :class="[
                    exactPageMatch('/admin/products') ? activeClass : '',
                    'nav-main-link',
                  ]"
                >
                  <i class="nav-main-link-icon fa fa-boxes" />
                  <span class="nav-main-link-name">All Products</span>
                </nuxt-link>
              </ul>
              <ul class="nav-main-submenu">
                <li class="nav-main-item">
                  <nuxt-link
                    to="/admin/products/add-product"
                    exact
                    :class="[
                      currentPage.includes('add-product') ? activeClass : '',
                      'nav-main-link',
                    ]"
                  >
                    <i class="nav-main-link-icon fa fa-plus-square" />
                    <span class="nav-main-link-name">Add Product</span>
                  </nuxt-link>
                </li>
              </ul>
            </li>
            <li
              class="nav-main-item"
              @click="
                toggleNavMainOpen = false;
                toggleMenu = false;
              "
            >
              <nuxt-link
                to="/admin/brands"
                exact
                :class="[
                  currentPage.includes('brands') ? activeClass : '',
                  'nav-main-link',
                ]"
                data-toggle="submenu"
              >
                <i class="nav-main-link-icon fa fa-registered" />
                <span class="nav-main-link-name">Brands</span>
              </nuxt-link>
            </li>
            <li
              class="nav-main-item"
              @click="
                toggleNavMainOpen = false;
                toggleMenu = false;
              "
            >
              <nuxt-link
                to="/admin/customers"
                exact
                :class="[
                  currentPage.includes('customers') ? activeClass : '',
                  'nav-main-link',
                ]"
                data-toggle="submenu"
              >
                <i class="nav-main-link-icon fa fa-users" />
                <span class="nav-main-link-name">Customers</span>
              </nuxt-link>
            </li>
            <li
              class="nav-main-item"
              @click="
                toggleNavMainOpen = false;
                toggleMenu = false;
              "
            >
              <nuxt-link
                to="/admin/admin-users"
                exact
                :class="[
                  currentPage.includes('admin-users') ? activeClass : '',
                  'nav-main-link',
                ]"
                data-toggle="submenu"
              >
                <i class="nav-main-link-icon fa fa-user-shield" />
                <span class="nav-main-link-name">Admin Users</span>
              </nuxt-link>
            </li>
            <li
              class="nav-main-item"
              @click="
                toggleNavMainOpen = false;
                toggleMenu = false;
              "
            >
              <nuxt-link
                to="/admin/settings"
                exact
                :class="[
                  currentPage.includes('settings') ? activeClass : '',
                  'nav-main-link',
                ]"
                data-toggle="submenu"
              >
                <i class="nav-main-link-icon fa fa-cogs" />
                <span class="nav-main-link-name">Settings</span>
              </nuxt-link>
            </li>
          </ul>
        </div>
        <!-- END Side Navigation -->
      </nav>
      <!-- END Sidebar -->

      <!-- Header -->
      <header id="page-header">
        <!-- Header Content -->
        <div class="content-header">
          <!-- Left Section -->
          <div class="d-flex align-items-center">
            <!-- Toggle Sidebar -->
            <!-- Layout API, functionality initialized in Template._uiApiLayout()-->
            <button
              type="button"
              class="btn btn-sm btn-dual mr-2 d-lg-none"
              data-toggle="layout"
              @click="toggleMenu = !toggleMenu"
            >
              <i class="fa fa-fw fa-bars" />
            </button>
            <!-- END Toggle Sidebar -->

            <!-- Toggle Mini Sidebar -->
            <button
              type="button"
              class="btn btn-sm btn-dual mr-2 d-none d-lg-inline-block"
              @click="showSidebarMini = !showSidebarMini"
            >
              <i class="fa fa-fw fa-ellipsis-v" />
            </button>
            <!-- END Toggle Mini Sidebar -->
          </div>
          <!-- END Left Section -->

          <!-- Right Section -->
          <div class="d-flex align-items-center">
            <!-- User Dropdown -->
            <div
              class="dropdown d-inline-block ml-2"
              :class="{ show: toggleDropdown }"
              @click="toggleDropdown = !toggleDropdown"
            >
              <button
                id="page-header-user-dropdown"
                type="button"
                class="btn btn-sm btn-dual d-flex align-items-center"
              >
                <img
                  class="rounded-circle"
                  src="/images/avatar10.jpg"
                  alt="Header Avatar"
                  style="width: 21px"
                />
                <span class="d-none d-sm-inline-block ml-2">{{ name }}</span>
                <i
                  class="
                    fa fa-fw fa-angle-down
                    d-none d-sm-inline-block
                    ml-1
                    mt-1
                  "
                />
              </button>
              <div
                class="
                  dropdown-menu dropdown-menu-md dropdown-menu-right
                  p-0
                  border-0
                "
                :class="{ show: toggleDropdown }"
              >
                <div class="p-2">
                  <a
                    class="
                      dropdown-item
                      d-flex
                      align-items-center
                      justify-content-between
                    "
                    href="#"
                    @click.prevent="logout"
                  >
                    <span class="font-size-sm font-w500">Log Out</span>
                  </a>
                </div>
              </div>
            </div>
            <!-- END User Dropdown -->
          </div>
          <!-- END Right Section -->
        </div>
        <!-- END Header Content -->

        <!-- Header Search -->
        <div id="page-header-search" class="overlay-header bg-white">
          <div class="content-header">
            <form
              class="w-100"
              action="be_pages_generic_search.html"
              method="POST"
            >
              <div class="input-group">
                <div class="input-group-prepend">
                  <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                  <button
                    type="button"
                    class="btn btn-alt-danger"
                    data-toggle="layout"
                    data-action="header_search_off"
                  >
                    <i class="fa fa-fw fa-times-circle" />
                  </button>
                </div>
                <input
                  id="page-header-search-input"
                  type="text"
                  class="form-control"
                  placeholder="Search or hit ESC.."
                  name="page-header-search-input"
                />
              </div>
            </form>
          </div>
        </div>
        <!-- END Header Search -->

        <!-- Header Loader -->
        <!-- Please check out the Loaders page under Components category to see examples of showing/hiding it -->
        <div id="page-header-loader" class="overlay-header bg-white">
          <div class="content-header">
            <div class="w-100 text-center">
              <i class="fa fa-fw fa-circle-notch fa-spin" />
            </div>
          </div>
        </div>
        <!-- END Header Loader -->
      </header>
      <!-- END Header -->

      <!-- Main Container -->

      <nuxt />

      <!-- END Main Container -->

      <!-- Footer -->
      <footer id="page-footer" class="bg-body-light">
        <div class="content py-3">
          <div class="row font-size-sm">
            <div class="col-sm-6 order-sm-1 py-1 text-center text-sm-left">
              <nuxt-link to="/" target="_blank" class="font-w600">
                Elite Prints
              </nuxt-link>
              ©<span data-toggle="year-copy" class="js-year-copy-enabled">{{
                currentYear
              }}</span>
            </div>
          </div>
        </div>
      </footer>
      <!-- END Footer -->
    </div>
    <!-- END Page Container -->
  </div>
</template>

<script>
export default {
  data() {
    return {
      showSidebarMini: false,
      toggleNavMainOpen: false,
      toggleDropdown: false,
      toggleMenu: false,
      currentYear: new Date().getFullYear(),
      name: this.$auth.user.name,
      menuActive: 'menu-active',
      activeClass: 'active',
      subMenu: 'nav-main-link-submenu',
    };
  },
  head: {
    titleTemplate: '',
    link: [
      {
        rel: 'stylesheet',
        href: 'https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&amp;display=swap',
      },
      { rel: 'stylesheet', href: '/admin/css/oneui.css' },
      { rel: 'stylesheet', href: '/admin/css/data-table.css' },
    ],
    script: [
      {
        src: '/js/jquery-3.5.1.min.js',
      },
      {
        src: '/js/popper.min.js',
        body: true,
      },
      {
        src: '/bootstrap/js/bootstrap.min.js',
        body: true,
      },
      {
        src: 'https://unpkg.com/autonumeric',
      },
    ],
  },

  computed: {
    currentPage() {
      return this.$route.path;
    },
  },
  methods: {
    logout() {
      this.$auth.logout();
    },

    exactPageMatch(path) {
      return path === this.currentPage;
    },
  },
};
</script>
