<template>
  <div>
    <navbarHome></navbarHome>
    <!-- seach -->
    <section class="ftco-search">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <form @submit.prevent="submitSeach()">
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <select name="" id="" class="form-control" v-model="seach.categories_id">
                      <option value="0" selected>Loại nhà đất</option>
                      <option
                        v-for="(item, index) in categories"
                        :key="index"
                        :value="item.id"
                      >
                        {{ item.categories_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-9">
                  <div class="form-group">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Tìm kiếm địa chỉ,khu vực"
                      v-model="seach.keyword"
                    />
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-3">
                  <div class="form-group">
                    <select
                      name=""
                      id=""
                      class="form-control"
                      v-model="seach.province_id"
                      @change="changeProvince()"
                    >
                      <option value="0">Trên toàn quốc</option>
                      <option
                        v-for="(item, index) in province"
                        :key="index"
                        :value="item.id"
                      >
                        {{ item.province_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select
                      name=""
                      id=""
                      class="form-control"
                      v-model="seach.district_id"
                      @change="changeDistrict()"
                    >
                      <option value="0">Quận/huyện</option>
                      <option
                        v-for="(item, index) in district"
                        :key="index"
                        :value="item.id"
                      >
                        {{ item.district_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <select
                      name=""
                      id=""
                      class="form-control"
                      v-model="seach.ward_id"
                    >
                      <option value="0">Phường/xã</option>
                      <option
                        v-for="(item, index) in ward"
                        :key="index"
                        :value="item.id"
                      >
                        {{ item.ward_name }}
                      </option>
                    </select>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <button type="submit" class="form-control">Tìm kiếm</button>
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
        <div class="container-fluid">
          <div class="row">
            <div
              class="col-md-4 ftco-animate fadeInUp ftco-animated"
              v-for="(item,index) in posts"
              :key="index"
            >
              <div class="properties">
                <a
                  href=""
                  @click.prevent="redirectDetailPost(item.url)"
                  class="img img-2 d-flex justify-content-center align-items-center"
                  :style="{
                    'background-image':
                      'url(' + '/assets/image_post/' + item.image + ')',
                  }"
                >
                  <div
                    class="icon d-flex justify-content-center align-items-center"
                  >
                    <span class="icon-search2"></span>
                  </div>
                </a>
                <div class="text p-3">
                  <div style="height: 40px">
                    <a
                      href=""
                      @click.prevent="
                        redirectDetailPost(item.url)
                      "
                      >{{ item.title }}</a
                    >
                  </div>
                  <hr />
                  <p class="bottom-area d-flex">
                    <span>{{ convertDate(item.created_at) }} ngày trước</span
                    >
                  </p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end post -->

    <!-- product -->
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <span class="subheading">Tin tức nhà đất mới nhất</span>
            <h2 class="mb-4">Bất động sản dành cho bạn</h2>
          </div>
        </div>
      </div>
      <div class="container-fluid">
        <div class="row">
          <div
            class="col-md-4 ftco-animate fadeInUp ftco-animated"
            v-for="(product, index) in products"
            :key="index"
          >
            <div class="properties">
              <a
                href=""
                @click.prevent="redirectProductDetail(product.slugs[0].url)"
                class="img img-2 d-flex justify-content-center align-items-center"
                :style="{
                  'background-image':
                    'url(' + '/assets/image_product/' + product.image + ')',
                }"
              >
                <div
                  class="icon d-flex justify-content-center align-items-center"
                >
                  <span class="icon-search2"></span>
                </div>
              </a>
              <div class="text p-3">
                <span v-if="product.type_id === 6" class="status rent"
                  >Tin đặc biệt</span
                >
                <span v-else class="status sale">Tin vip</span>
                <div style="height: 68px">
                  <a
                    href=""
                    @click.prevent="redirectProductDetail(product.slugs[0].url)"
                    >{{ product.title }}</a
                  >
                </div>
                <hr />
                <p class="bottom-area d-flex">
                  <span
                    ><i class="flaticon-selection"></i>
                    {{ product.area }}m2</span
                  >
                  <span class="ml-auto" style="font-size: 18px; color: #c12f25"
                    >{{ (product.area * product.price) / 1000 }} tỷ</span
                  >
                </p>
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
                    <strong class="number">{{ count.user }}</strong>
                    <span>Khách hàng</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                    <strong class="number">{{ count.product }}</strong>
                    <span>Sản phẩm</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                    <strong class="number" >{{ count.post }}</strong>
                    <span>Tin tức</span>
                  </div>
                </div>
              </div>
              <div
                class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate"
              >
                <div class="block-18 text-center">
                  <div class="text">
                    <strong class="number">{{count.visitor}}</strong>
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
import {apiDomainUser,getTokenUser} from "../../../config";
export default {
  data() {
    return {
      posts: [],
      products: [],
      type: [],
      categories: [],
      province: [],
      district: [],
      ward: [],
      seach: {
        province_id: "0",
        district_id: "0",
        ward_id: "0",
        categories_id:"0",
        keyword:""
      },
      count:{}
    };
  },
  methods: {
    getListPost() {
      axios
        .get(apiDomainUser + "home/post/list")
        .then((res) => {
          if (res.data.status === true) {
            res.data.data.map((item) => {
              this.posts.push(item);
            })
          }
        })
        .catch((e) => {});
    },
    getListCategories() {
      axios
        .get(apiDomainUser + "home/categories/list")
        .then((res) => {
          this.categories = res.data.data;
        })
        .catch((e) => {});
    },
    getListProduct() {
      axios
        .get(apiDomainUser + "home/product/list")
        .then((res) => {
          if (res.data.status) { 
            res.data.data.map((item,index) => {
              this.products.push(item);
              this.products[index].product_images.map((img,i) => {
                if(i < 1){
                  this.products[index].image = img.image;
                  delete this.products[index].product_images;
                }
              });
            });
          }
        })
        .catch((e) => {});
    },
    getListProvince() {
      axios
        .get(apiDomainUser + "home/province/list")
        .then((res) => {
          this.province = res.data.data;
        })
        .catch((e) => {});
    },
    getCount(){
      axios.get(apiDomainUser + 'home/count/list')
      .then(res => {
        if(res.data.status){
          this.count = res.data.data;
        }
      })
      .catch(e => {

      })
    },
    changeProvince() {
      this.district = [];
      if (this.seach.province !== "0") {
        let index = this.province.findIndex(
          (item) => this.seach.province_id === item.id
        );
        this.district = this.province[index].districts;
      }
    },
    changeDistrict() {
      this.ward = [];
      if (this.seach.district !== "0") {
        let index = this.province.findIndex(
          (item) => this.seach.province_id === item.id
        );
        this.province[index].wards.map((item, index) => {
          if (item.district_id === this.seach.district_id) {
            this.ward.push(item);
          }
        });
      }
    },
    submitSeach(){
      axios.post(apiDomainUser + 'home/seach',this.seach)
      .then(res => {
        if(res.data.status){
          if(res.data.data.url!==undefined&&res.data.data.categories_name===undefined){
            localStorage.setItem('urlSeach',res.data.data.url);
            window.location.href = '/nha-dat-ban/' + localStorage.getItem('urlSeach');
          }else if(res.data.data.categories_name!==undefined){
            window.location.href = '/' + res.data.data.url;
          }
          else{
            localStorage.setItem('urlSeach',res.data.url);
            window.location.href = '/nha-dat-ban/' + res.data.data;
          }
        }
      })
      .catch(e => {

      })
    },
    convertDate(date) {
      let timePresent = new Date();
      let dateParams = new Date(date);
      return (timePresent.getDate() - dateParams.getDate()==0) ? 1 :timePresent.getDate() - dateParams.getDate();
    },
    redirectDetailPost(url) {
      localStorage.setItem("urlDetailPost", url);
      window.location.href = "/bai-viet/" + url;
    },
    redirectProductDetail(url) {
      localStorage.setItem("urlProductDetail", url);
      window.location.href = "/tin-rao-ban/" + url;
    },
  },
  beforeCreate() {
  },
  created() {
    this.getListPost();
    this.getListCategories();
    this.getListProduct();
    this.getListProvince();
    this.getCount();
  },
  mounted() {
    
  },
};
</script>