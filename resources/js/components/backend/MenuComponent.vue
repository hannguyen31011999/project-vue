<template>
  <!-- ========== Left Sidebar Start ========== -->
  <div class="left-side-menu">
    <div class="slimscroll-menu">
      <!--- Sidemenu -->
      <div id="sidebar-menu">
        <ul class="metismenu" id="side-menu">
          <li class="menu-title">Navigation</li>

          <li>
            <a @click.prevent="redirectURL(1)" class="waves-effect">
              <i class="ion ion-md-home"></i>
              <span>Trang chủ</span>
            </a>
          </li>

          <li>
            <a @click.prevent="redirectURL(2)" class="waves-effect">
              <i class="ion ion-md-menu"></i>
              <span>Quản lý danh mục</span>
            </a>
          </li>

          <li>
            <a href="" @click.prevent="redirectURL(3)" class="waves-effect">
              <i class="ion-ios-apps"></i>
              <span> Quản lý loại tin </span>
            </a>
          </li>

          <li>
            <a href="" @click.prevent="redirectURL(4)" class="waves-effect">
              <i class="fas fa-users"></i>
              <span> Quản lý người dùng </span>
            </a>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-ios-list"></i>
              <span>Quản lý địa điểm</span>
              <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="" @click.prevent="redirectURL(5)">Tỉnh/TP</a></li>
              <li><a href="" @click.prevent="redirectURL(6)">Quận/huyện</a></li>
              <li><a href="" @click.prevent="redirectURL(7)">Phường/xã</a></li>
            </ul>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="fab fa-product-hunt"></i>
              <span> Quản lý sản phẩm </span>
              <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="">Tin đăng bán</a></li>
              <li><a href="">Kho hình ảnh</a></li>
            </ul>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="fas fa-shopping-cart"></i>
              <span> Quản lý hóa đơn </span>
            </a>
          </li>

          <li>
            <a href="javascript: void(0);" @click.prevent="redirectURL(8)" class="waves-effect">
              <i class="fab fa-blogger"></i>
              <span> Quản lý bài viết </span>
            </a>
          </li>
          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-md-mail"></i>
              <span> Mail </span>
            </a>
          </li>
          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="mdi mdi-settings"></i>
              <span> Setting </span>
            </a>
          </li>
        </ul>
      </div>
      <!-- End Sidebar -->

      <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
  </div>
  <!-- Left Sidebar End -->
</template>

<script>

export default {
  data(){
    return{

    }
  },
  methods:{
    redirectURL(action){
      switch(action){
        case 1:{
          window.location.href = '/admin/dashboard'
          break;
        }
        case 2:{
          window.location.href = '/admin/categories'
          break;
        }
        case 3:{
          window.location.href = '/admin/type'
          break;
        }
        case 4:{
          window.location.href = '/admin/user'
          break;
        }
        case 5:{
          window.location.href = '/admin/province'
          break;
        }
        case 6:{
          window.location.href = '/admin/district'
          break;
        }
        case 7:{
          window.location.href = '/admin/ward'
          break;
        }
        case 8:{
          window.location.href = '/admin/post'
          break;
        }
        case 9:{
          
        }
        case 10:{
          
        }
        default:{

        }
      }
    }
  }
}
</script>