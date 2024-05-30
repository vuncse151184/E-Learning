<template>
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <a class="nav-link menu-btn" data-widget="pushmenu" href="#!" role="button"><i class="fas fa-bars"></i></a>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fa fa-user-cog"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <a href="#" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media"> -->
              <!-- <img src="../../dist/img/user1-128x128.jpg" alt="User Avatar" class="img-size-50 mr-3 img-circle"> -->
              <!-- <div class="media-body">
                <h3 class="dropdown-item-title">
                  Brad Diesel
                  <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">Call me whenever you can...</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          <!-- </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media"> -->
              <!-- <img src="../../dist/img/user8-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
              <!-- <div class="media-body">
                <h3 class="dropdown-item-title">
                  John Pierce
                  <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">I got your message bro</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          <!-- </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item"> -->
            <!-- Message Start -->
            <!-- <div class="media"> -->
              <!-- <img src="../../dist/img/user3-128x128.jpg" alt="User Avatar" class="img-size-50 img-circle mr-3"> -->
              <!-- <div class="media-body">
                <h3 class="dropdown-item-title">
                  Nora Silvester
                  <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                </h3>
                <p class="text-sm">The subject goes here</p>
                <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
              </div>
            </div> -->
            <!-- Message End -->
          <!-- </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
        </div>
      </li> -->
      <!-- Notifications Dropdown Menu -->
      <!-- <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"> ユーザー名 <i class="fas fa-caret-down"></i> </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> 4 new messages
            <span class="float-right text-muted text-sm">3 mins</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-users mr-2"></i> 8 friend requests
            <span class="float-right text-muted text-sm">12 hours</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item">
            <i class="fas fa-file mr-2"></i> 3 new reports
            <span class="float-right text-muted text-sm">2 days</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
        </div>
      </li> -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#"> {{ admin_name }} <i class="fas fa-caret-down"></i> </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="min-width:200px !important;max-width:200px !important;">
          <!-- <a href="#" class="dropdown-item"> <i class="fas fa-key mr-2"></i> Change Password</a>
          <div class="dropdown-divider"></div> -->
          <a href="/administrator/logout" class="dropdown-item"> <i class="fas fa-unlock mr-2"></i> ログアウト</a>
        </div>
      </li>
    </ul>
  </nav>
</template>

<script>
import { mapGetters, mapActions } from "vuex";
export default {
  name: "Navbar",
  data() {
    return {
      admin_name: ""
    };
  },
  computed: {
    ...mapGetters("admin", ["isLogin", "adminData"])
  },
  mounted() {
    if (this.adminData) {
      this.admin_name = this.adminData.name;
    }
  }
};
</script>
