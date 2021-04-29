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
                        <span data-plugin="counterup">{{ count.visit }}</span>
                      </h2>
                      <p class="mb-0">Lượt xem trong ngày</p>
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
                        <span data-plugin="counterup">{{ count.post }}</span>
                      </h2>
                      <p class="mb-0">Bài viết mới</p>
                    </div>
                    <i class="ion-ios-create"></i>
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
                        <span data-plugin="counterup">{{ count.order }}</span>
                      </h2>
                      <p class="mb-0">Đơn hàng mới</p>
                    </div>
                    <i class="ion-ios-cart"></i>
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
                        <span data-plugin="counterup">{{ count.user }}</span>
                      </h2>
                      <p class="mb-0">Người dùng mới</p>
                    </div>
                    <i class="mdi mdi-account-multiple-outline"></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="text-center" style="font-size:18px">Biểu đồ doanh thu theo tháng {{ date }}</div>
        <line-chart :data="order" thousands="." :round="3" label="Doanh thu" xtitle="Ngày" ytitle="Đơn vị: VND" :legend="true" :curve="false"></line-chart>
        <br><br>
        <div class="text-center" style="font-size:18px">Biểu đồ tin đăng theo danh mục</div>
        <pie-chart :data="categories"></pie-chart>
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
import {listDashBoardUrl,getToken} from '../../../config';
export default {
  data() {
    return {
      order:{},
      categories:[],
      count:[],
      date:null
    };
  },
  created(){
    this.getListDashBoard();
    let time = new Date();
    this.date = time.getMonth() + 1;
  },
  methods: {
    getListDashBoard(){
      axios.get(listDashBoardUrl + getToken())
      .then(res => {
        if(res.data.status){
          let data = res.data.data.data;
          let temp = {};
          let tempCategories = [];
          data.map((item) => {
            temp[item.days] = item.total;
          });
          res.data.data.categories.map((item) => {
            let temp1 = [];
            temp1.push(item.categories.categories_name);
            temp1.push(item.total);
            this.categories.push(temp1);
          });
          this.count = res.data.data.count;
          this.order = temp;
        }
      })
      .catch(e => {

      })
    }
  },
  mounted() {
  },
};
</script>