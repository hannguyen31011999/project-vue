<template>
  <div>
    <navbarHome></navbarHome>
    <!-- slider -->
    <section class="home-slider owl-carousel">
      <div
        class="slider-item"
        style="background-image: url('/frontend/images/bg_1.jpg')"
      >
        <div class="overlay"></div>
        <div class="container">
          <div
            class="row no-gutters slider-text align-items-md-end align-items-center justify-content-end"
          >
            <div class="col-md-6 text p-4 ftco-animate">
              <h1 class="mb-3">Florida 5, Pinecrest, FL</h1>
              <span class="location d-block mb-3"
                ><i class="icon-my_location"></i> Melbourne, Vic 3004</span
              >
              <p>
                A small river named Duden flows by their place and supplies it
                with the necessary regelialia. It is a paradisematic country, in
                which roasted parts of sentences fly into your mouth.
              </p>
              <span class="price">$28,000</span>
              <a href="#" class="btn-custom p-3 px-4 bg-primary"
                >View Details <span class="icon-plus ml-1"></span
              ></a>
            </div>
          </div>
        </div>
      </div>

      <div
        class="slider-item"
        style="background-image: url('/frontend/images/bg_2.jpg')"
      >
        <div class="overlay"></div>
        <div class="container">
          <div
            class="row no-gutters slider-text align-items-md-end align-items-center justify-content-end"
          >
            <div class="col-md-6 text p-4 ftco-animate">
              <h1 class="mb-3">3015 Grand Avenue, CocoWalk</h1>
              <span class="location d-block mb-3"
                ><i class="icon-my_location"></i> Melbourne, Vic 3004</span
              >
              <p>
                A small river named Duden flows by their place and supplies it
                with the necessary regelialia. It is a paradisematic country, in
                which roasted parts of sentences fly into your mouth.
              </p>
              <span class="price">$28,000</span>
              <a href="#" class="btn-custom p-3 px-4 bg-primary"
                >View Details <span class="icon-plus ml-1"></span
              ></a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end slider -->

    <!-- seach -->
    <section class="ftco-search">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form action="#">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-7">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Tìm kiếm địa chỉ,khu vực"
                    />
                  </div>
                </div>
                <div class="col-md-2">
                  <div class="form-group">
                    <button type="submit" class="form-control">Tìm kiếm</button>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Trên toàn quốc</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Quận/huyện</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Phường/xã</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                      <option value="">Loại nhà đất</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Diện tích</option>
                      <option value="">&le;30m2</option>
                      <option value="">30-50m2</option>
                      <option value="">50-80m2</option>
                      <option value="">80-100m2</option>
                      <option value="">100-150m2</option>
                      <option value="">150-200m2</option>
                      <option value="">200-250m2</option>
                      <option value="">250-300m2</option>
                      <option value="">300-500m2</option>
                      <option value="">&ge;500</option>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Dự án</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Số phòng</option>
                      <option value="">Không xác định</option>
                      <option value="">+1</option>
                      <option value="">+2</option>
                      <option value="">+3</option>
                      <option value="">+4</option>
                      <option value="">+5</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Hướng nhà</option>
                      <option value="">KXĐ</option>
                      <option value="">Đông</option>
                      <option value="">Tây</option>
                      <option value="">Nam</option>
                      <option value="">Bắc</option>
                      <option value="">Đông-Bắc</option>
                      <option value="">Tây-Bắc</option>
                      <option value="">Đông-Nam</option>
                      <option value="">Tây-Nam</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control">
                      <option value="">Đường phố</option>
                    </select>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
    <!-- end seach -->

    <!-- post -->
    <section class="ftco-section">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Bản Tin</span>
            <h2>Tin Tiêu Điểm</h2>
          </div>
        </div>
        <div class="row d-flex">
          <div class="col-md-3 d-flex ftco-animate" v-for="(item,index) in post" :key="index">
            <div class="blog-entry align-self-stretch">
                <a
                  href=""
                  @click.prevent="redirectDetailPost(item.url)"
                  class="block-20"
                  :style="{ 'background-image': 'url(' + '/assets/image_post/' + item.image + ')' }"
                >
                </a>
              <div class="text mt-3 d-block">
                <div class="meta mb-3">
                  <div>{{ convertDate(item.created_at) }} ngày trước</div>
                </div>
                <h3 class="heading mt-3">
                    <a href="" @click.prevent="redirectDetailPost(item.url)">{{ item.title }}</a>
                </h3>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end post -->

    <!-- product -->
    <section class="ftco-section ftco-properties">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Sản Phẩm</span>
            <h2 class="mb-4">Bất Động Sản Dành Cho Bạn</h2>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12">
            <div class="properties-slider owl-carousel ftco-animate">
              <div class="item">
                <div class="properties">
                  <a
                    href="#"
                    class="img d-flex justify-content-center align-items-center"
                    style="
                      background-image: url('/frontend/images/properties-1.jpg');
                    "
                  >
                    <div
                      class="icon d-flex justify-content-center align-items-center"
                    >
                      <span class="icon-search2"></span>
                    </div>
                  </a>
                  <div class="text p-3">
                    <span class="status sale">Sale</span>
                    <div class="d-flex">
                      <div class="one">
                        <h3><a href="#">North Parchmore Street</a></h3>
                        <p>Apartment</p>
                      </div>
                      <div class="two">
                        <span class="price">$20,000</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="properties">
                  <a
                    href="#"
                    class="img d-flex justify-content-center align-items-center"
                    style="
                      background-image: url('/frontend/images/properties-2.jpg');
                    "
                  >
                    <div
                      class="icon d-flex justify-content-center align-items-center"
                    >
                      <span class="icon-search2"></span>
                    </div>
                  </a>
                  <div class="text p-3">
                    <div class="d-flex">
                      <span class="status rent">Rent</span>
                      <div class="one">
                        <h3><a href="#">North Parchmore Street</a></h3>
                        <p>Apartment</p>
                      </div>
                      <div class="two">
                        <span class="price">$2,000 <small>/ month</small></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="properties">
                  <a
                    href="#"
                    class="img d-flex justify-content-center align-items-center"
                    style="
                      background-image: url('/frontend/images/properties-3.jpg');
                    "
                  >
                    <div
                      class="icon d-flex justify-content-center align-items-center"
                    >
                      <span class="icon-search2"></span>
                    </div>
                  </a>
                  <div class="text p-3">
                    <span class="status sale">Sale</span>
                    <div class="d-flex">
                      <div class="one">
                        <h3><a href="#">North Parchmore Street</a></h3>
                        <p>Apartment</p>
                      </div>
                      <div class="two">
                        <span class="price">$20,000</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="properties">
                  <a
                    href="#"
                    class="img d-flex justify-content-center align-items-center"
                    style="
                      background-image: url('/frontend/images/properties-4.jpg');
                    "
                  >
                    <div
                      class="icon d-flex justify-content-center align-items-center"
                    >
                      <span class="icon-search2"></span>
                    </div>
                  </a>
                  <div class="text p-3">
                    <span class="status sale">Sale</span>
                    <div class="d-flex">
                      <div class="one">
                        <h3><a href="#">North Parchmore Street</a></h3>
                        <p>Apartment</p>
                      </div>
                      <div class="two">
                        <span class="price">$20,000</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="properties">
                  <a
                    href="#"
                    class="img d-flex justify-content-center align-items-center"
                    style="
                      background-image: url('/frontend/images/properties-5.jpg');
                    "
                  >
                    <div
                      class="icon d-flex justify-content-center align-items-center"
                    >
                      <span class="icon-search2"></span>
                    </div>
                  </a>
                  <div class="text p-3">
                    <span class="status rent">Rent</span>
                    <div class="d-flex">
                      <div class="one">
                        <h3><a href="#">North Parchmore Street</a></h3>
                        <p>Apartment</p>
                      </div>
                      <div class="two">
                        <span class="price">$900 <small>/ month</small></span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="item">
                <div class="properties">
                  <a
                    href="#"
                    class="img d-flex justify-content-center align-items-center"
                    style="
                      background-image: url('/frontend/images/properties-6.jpg');
                    "
                  >
                    <div
                      class="icon d-flex justify-content-center align-items-center"
                    >
                      <span class="icon-search2"></span>
                    </div>
                  </a>
                  <div class="text p-3">
                    <span class="status sale">Sale</span>
                    <div class="d-flex">
                      <div class="one">
                        <h3><a href="#">North Parchmore Street</a></h3>
                        <p>Apartment</p>
                      </div>
                      <div class="two">
                        <span class="price">$20,000</span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end product -->

    <!-- infomation -->
    <section
      class="ftco-section ftco-counter img"
      id="section-counter"
      style="background-image: url('/frontend/images/bg_1.jpg')"
    >
      <div class="container">
        <div class="row justify-content-center mb-3 pb-3">
          <div
            class="col-md-7 text-center heading-section heading-section-white ftco-animate"
          >
            <h2 class="mb-4">Những con số về chúng tôi</h2>
          </div>
        </div>
        <div class="row justify-content-center">
          <div class="col-md-10">
            <div class="row">
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                    <strong class="number" data-number="9000">0</strong>
                    <span>User</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                    <strong class="number" data-number="10000">0</strong>
                    <span>Product</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                    <strong class="number" data-number="1000">0</strong>
                    <span>Bản tin</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                    <strong class="number" data-number="100">0</strong>
                    <span>Lượt ghé thăm</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end infomation -->
    <footerHome></footerHome>
    <registerComponent></registerComponent>
    <loginComponent></loginComponent>
  </div>
</template>

<script>
import {apiDomainUser} from '../../../config';
export default {
  data(){
    return{
      post:[],
      product:[],
      keyword:{}
    }
  },
  methods:{
    getListPost(){
      axios.get(apiDomainUser + 'post')
      .then(res => {
        if(res.data.status===true){
          localStorage.setItem('post',res.data.data);
          this.post = res.data.data;
        }
      })
      .catch(e => {

      })
    },
    convertDate(date){
      let timePresent = new Date();
      let dateParams = new Date(date);
      return (timePresent.getDay() - dateParams.getDay()==0) ? 1 :timePresent.getDay() - dateParams.getDay();
    },
    redirectDetailPost(url){
      localStorage.setItem('urlDetailPost',url);
      window.location.href = '/bai-viet/' + url;
    }
  },
  created(){
    if(localStorage.getItem('post')!==null){
      this.post = localStorage.getItem('post');
    }
    this.getListPost();
  },
  mounted() {
  },
};
</script>