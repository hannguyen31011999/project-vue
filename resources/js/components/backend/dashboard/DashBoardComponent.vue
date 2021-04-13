<template>
  <!-- Begin page -->
  <div id="wrapper">
    <navbarComponent></navbarComponent>
    <menuComponent></menuComponent>
    <!-- content -->
    <div class="content-page">
      <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
          <!-- start page title -->
          <div class="row">
            <div class="col-12">
              <div class="page-title-box">
                <div class="page-title-right">
                  <ol class="breadcrumb p-0 m-0">
                    <li class="breadcrumb-item"><a href="#">Admin</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                  </ol>
                </div>
                <div class="clearfix"></div>
              </div>
            </div>
          </div>
          <!-- end page title -->

          <div class="row">
            <div class="col-xl-3 col-sm-6">
              <div class="card bg-pink">
                <div class="card-body widget-style-2">
                  <div class="text-white media">
                    <div class="media-body align-self-center">
                      <h2 class="my-0 text-white">
                        <span data-plugin="counterup">50</span>
                      </h2>
                      <p class="mb-0">Daily Visits</p>
                    </div>
                    <i class="ion-md-eye"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card bg-purple">
                <div class="card-body widget-style-2">
                  <div class="text-white media">
                    <div class="media-body align-self-center">
                      <h2 class="my-0 text-white">
                        <span data-plugin="counterup">12056</span>
                      </h2>
                      <p class="mb-0">Sales</p>
                    </div>
                    <i class="ion-md-paper-plane"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card bg-info">
                <div class="card-body widget-style-2">
                  <div class="text-white media">
                    <div class="media-body align-self-center">
                      <h2 class="my-0 text-white">
                        <span data-plugin="counterup">1268</span>
                      </h2>
                      <p class="mb-0">New Orders</p>
                    </div>
                    <i class="ion-ios-pricetag"></i>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-xl-3 col-sm-6">
              <div class="card bg-primary">
                <div class="card-body widget-style-2">
                  <div class="text-white media">
                    <div class="media-body align-self-center">
                      <h2 class="my-0 text-white">
                        <span data-plugin="counterup">145</span>
                      </h2>
                      <p class="mb-0">New Users</p>
                    </div>
                    <i class="mdi mdi-comment-multiple"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- end container-fluid -->
      </div>
      <!-- end content -->
      <!-- Footer Start -->
      <footer class="footer">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              2021 &copy; BatDongSanQuan9 build by <a href="">Han Nguyen</a>
            </div>
          </div>
        </div>
      </footer>
      <!-- end Footer -->
    </div>
    <!-- end content -->
  </div>
  
</template>

<script>
export default {
  data() {
    return {};
  },
  created(){

  },
  method: {
    logout() {

    },
  },
  mounted() {

  },
};
</script>