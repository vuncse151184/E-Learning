<template>
  <aside class="main-sidebar sidebar-dark-primary">
    <!-- Brand Logo -->
    <a href="#!" class="brand-link">
      <img src="/assets/img/logo-branch-image.png" alt="Logo PrimeDX Image" class="brand-image">
      <img src="/assets/img/logo-branch-text.png" alt="Logo PrimeDX Text" class="brand-text">
    </a>

    <!-- Sidebar -->
    <div class="sidebar">

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false" ref="left-admin-menu">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview user-page">
            <router-link :to="{ name: 'admin.dashboard' }"  class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>求職者データ管理</p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <router-link :to="{ name: 'admin.dashboard_company' }"  class="nav-link">
              <i class="nav-icon fas fa-building"></i>
              <p>求人企業データ管理</p>
            </router-link>
          </li> 
          <li class="nav-item has-treeview">
            <router-link :to="{ path: '/administrator/job' }" router-link-active class="nav-link">
              <i class="nav-icon fas fa-list-ul"></i>
              <p>求人案件管理</p>
            </router-link>
          </li>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>ニュース管理 <i class="fas fa-angle-left right"></i></p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#!" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dropdown 01</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#!" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Dropdown 02</p>
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Sidebar",
  computed: {
    ...mapGetters("admin", ["isLogin"])
  },
  watch: {
      '$route': 'setMenu'
  },
  mounted() {
    this.setMenu();
  },
  methods: {
    setMenu() {
      if (this.$route.name != 'admin.dashboard' && this.$route.name != 'admin.user.detail') {
        $(this.$refs['left-admin-menu']).find('li.user-page a').first().removeClass('active');
      } else {
        $(this.$refs['left-admin-menu']).find('li.user-page a').first().addClass('active');
      }
    },
  },
};
</script>
