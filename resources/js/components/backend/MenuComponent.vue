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
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-ios-apps"></i>
              <span> Components </span>
              <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="components-grid.html">Grid</a></li>
              <li><a href="components-portlets.html">Portlets</a></li>
              <li><a href="components-widgets.html">Widgets</a></li>
              <li><a href="components-nestable-list.html">Nesteble</a></li>
              <li><a href="components-calendar.html">Calendar</a></li>
              <li><a href="components-range-sliders.html">Range Slider</a></li>
            </ul>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-md-speedometer"></i>
              <span> Forms </span>
              <span class="badge badge-danger badge-pill float-right"> 8 </span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="forms-elements.html">General Elements</a></li>
              <li><a href="forms-validation.html">Form Validation</a></li>
              <li><a href="forms-advanced.html">Advanced Form</a></li>
              <li><a href="forms-wizard.html">Form Wizard</a></li>
              <li><a href="form-quilljs.html">Quilljs Editor</a></li>
              <li><a href="forms-uploads.html">Multiple File Upload</a></li>
              <li><a href="forms-image-crop.html">Image Crop</a></li>
              <li><a href="forms-xeditable.html">X-Editable</a></li>
            </ul>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-ios-list"></i>
              <span> Tables </span>
              <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="tables-basic.html">Basic Tables</a></li>
              <li><a href="tables-datatable.html">Data Table</a></li>
              <li><a href="tables-editable.html">Editable Table</a></li>
              <li><a href="tables-responsive.html">Responsive Table</a></li>
            </ul>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-md-pie"></i>
              <span> Charts </span>
              <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="charts-morris.html">Morris Chart</a></li>
              <li><a href="charts-chartjs.html">Chartjs</a></li>
              <li><a href="charts-flot.html">Flot Chart</a></li>
              <li><a href="charts-rickshaw.html">Rickshaw Chart</a></li>
              <li><a href="charts-peity.html">Peity Chart</a></li>
              <li><a href="charts-c3.html">C3 Chart</a></li>
              <li><a href="charts-other.html">Other Chart</a></li>
            </ul>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-md-mail"></i>
              <span> Mail </span>
              <span class="badge badge-warning badge-pill float-right">12</span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="email-inbox.html">Inbox</a></li>
              <li><a href="email-compose.html">Compose Mail</a></li>
              <li><a href="email-read.html">View Mail</a></li>
              <li><a href="email-templates.html">Email Templates</a></li>
            </ul>
          </li>

          <li>
            <a href="javascript: void(0);" class="waves-effect">
              <i class="ion-md-map"></i>
              <span> Maps </span>
              <span class="menu-arrow"></span>
            </a>
            <ul class="nav-second-level" aria-expanded="false">
              <li><a href="maps-gmap.html"> Google Map</a></li>
              <li><a href="maps-vector.html"> Vector Map</a></li>
            </ul>
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
        default:{

        }
      }
    }
  }
}
</script>