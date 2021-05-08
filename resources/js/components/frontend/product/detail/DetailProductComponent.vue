<template>
  <div>
    <navbarHome></navbarHome>
    <section class="ftco-section">
      <div class="container">
        <div class="row">
          <div class="col-lg-8">
            <div class="row">
              <div class="col-md-12 ftco-animate">
                <div class="slideshow-container">
                    <vue-carousel :data="data"></vue-carousel>
                </div>
              </div>
              <div class="col-md-12 Properties-single mt-4 mb-5 ftco-animate">
                <h2>{{ product.title }}</h2>
                <p class="rate mb-4">
                  <span class="loc"
                    ><a href="#"
                      ><i class="icon-map"></i> {{ product.address }}</a
                    ></span
                  >
                </p>
                <hr>
                <ul style="list-style-type: none;">
                    <li style="">Mức giá: {{ product.price * product.area / 1000 }} tỷ</li>
                    <li style="">Diện tích: {{ product.area }}m2</li>
                </ul>
                <span style="font-size:18px;margin-bottom:5px;">Thông tin mô tả</span>
                <p>
                    {{ product.desc }}
                </p>
                <hr>
              </div>
              <div class="col-md-12 properties-single ftco-animate mb-5 mt-5">
                <h4 class="mb-4">Tin tức khác</h4>
                <div class="row">
                  <div class="col-md-6 ftco-animate" v-for="(product,index) in relate" :key="index">
                    <div class="properties">
                    <a
                        href=""
                        class="img img-2 d-flex justify-content-center align-items-center"
                        @click.prevent="redirectProductDetail(product.slugs[0].url)"
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
                        <span class="status rent" v-if="product.type_id===6">Tin đặc biệt</span>
                        <span class="status sale" v-if="product.type_id > 2 && product.type_id < 6">Tin vip</span>
                        <div style="height:68px;">
                        <a href="" 
                            @click.prevent="redirectProductDetail(product.slugs[0].url)">
                            {{ product.title }}
                        </a>
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
            </div>
          </div>
          <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <img src="/assets/image_post/bds_cuchi.jpg" alt="" height="295" width="300" style="margin-bottom:5px">
                <img src="/assets/image_post/sunbay.gif" alt="">
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Bài viết</h3>
              <div class="block-21 mb-4 d-flex" v-for="(item,index) in post" :key="index">
                <a class="blog-img mr-4" href="" @click.prevent="redirectDetailPost(item.url)" :style="{ 'background-image': 'url(' + '/assets/image_post/' + item.image + ')' }"></a>
                <div class="text">
                  <h3 class="heading"><a href="" @click.prevent="redirectDetailPost(item.url)">{{ item.title }}</a></h3>
                  <div class="meta">
                    <div><span class="icon-calendar"></span> {{ convertDate(item.created_at) }} ngày trước</div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- .section -->
    <footerHome></footerHome>
    <registerComponent></registerComponent>
    <loginComponent></loginComponent>
  </div>
</template>

<script>
import {apiDomainUser} from '../../../../config';
export default {
    data(){
        return{
            data:[
            ],
            product:{},
            post:[],
            relate:[],
            image:[]
        }
    },
    methods:{
        getListProduct(url){
            axios.get(apiDomainUser + 'product/detail/' + url)
            .then(res => {
                if(res.data.status){
                    this.product = res.data.data.product;
                    this.post = res.data.data.post;
                    res.data.data.relate.map((item,index) => {
                      this.relate.push(item);
                      this.relate[index].product_images.map((img,i) => {
                        if(i < 1){
                          this.relate[index].image = img.image;
                          delete this.relate[index].product_images;
                        }
                      });
                    });
                    this.product.product_images.map((item,index) => {
                        this.data.push('<div class="example-slide"><img src="/assets/image_product/'+ item.image +'" height="350" width="730"></div>');
                    });
                }else{
                  alert('Tin đăng bán đã hết hạn');
                  window.location.href = '/';
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
        redirectDetailPost(url){
            window.location.href = '/bai-viet/' + url ;
        },
        redirectProductDetail(url) {
            window.location.href = "/tin-rao-ban/" + url;
        }
    },
    created(){
      this.getListProduct(window.location.pathname.split('/')[2]);
    },
    mounted(){

    },
};
</script>