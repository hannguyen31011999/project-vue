<template>
  <div>
    <navbarHome></navbarHome>
    <!-- product -->
    <section class="ftco-section bg-light">
      <div class="container">
        <div class="row">
          <div class="col-md-4 ftco-animate fadeInUp ftco-animated" v-for="(product,index) in products" :key="index">
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
        <div class="row mt-5">
          <div class="col text-center">
            <nav aria-label="Page navigation example" style="margin-top: 5px">
              <ul class="pagination justify-content-center">
                <li id="first" class="page-item disabled">
                  <a
                    class="page-link"
                    href=""
                    @click.prevent="changePage(-1)"
                    tabindex="-1"
                    >Previous</a
                  >
                </li>
                <li
                  class="page-item"
                  v-for="(page, index) in pagination.last_page"
                  :key="index"
                >
                  <a
                    class="page-link"
                    v-if="pagination.current_page === page"
                    style="background-color: #dcdcdc"
                    :id="page"
                    href=""
                    @click.prevent="changePage(page)"
                    >{{ page }}</a
                  >
                  <a
                    class="page-link"
                    v-if="
                      page < pagination.current_page + 3 &&
                      page !== pagination.current_page
                    "
                    :id="page"
                    href=""
                    @click.prevent="changePage(page)"
                    >{{ page }}</a
                  >
                </li>
                <li id="last" class="page-item">
                  <a
                    class="page-link"
                    @click.prevent="changePage(0)"
                    href=""
                    >Next</a
                  >
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>
    </section>
    <!-- end product -->
    <footerHome></footerHome>
    <registerComponent></registerComponent>
    <loginComponent></loginComponent>
  </div>
</template>

<script>
import { apiDomainUser } from "../../../config";
export default {
  data() {
    return {
      products: [],
      pagination: {},
    };
  },
  methods: {
    getListProductByCategories(url) {
      axios
        .get(apiDomainUser + "product/list/" + url)
        .then((res) => {
            if (res.data.status) {
                if (res.data.data.last_page === 1) {
                    $("#last").addClass("disabled");
                }
                this.products = res.data.data.data;
                this.pagination = res.data.data;
                this.products.map((item,index) => {
                  this.products[index].product_images.map((img,i) => {
                    if(i < 1){
                      this.products[index].image = img.image;
                      delete this.products[index].product_images;
                    }
                  })
                });
            }
        })
        .then((e) => {});
    },
    changePage(page) {
      if (page === 0) {
        $("#" + this.pagination.current_page).css("display", "none");
        page += this.pagination.current_page + 1;
        if (this.pagination.last_page <= page) {
          $("#last").addClass("disabled");
          this.getData(page);
        }
        $("#first").removeClass("disabled");
        this.getData(page);
      } else if (page === -1) {
        page = this.pagination.current_page - 1;
        $("#" + page).css("display", "block");
        $("#" + (page - 1)).css("display", "block");
        $("#" + (page - 2)).css("display", "block");
        if (page < 2) {
          $("#first").addClass("disabled");
          this.getData(page);
        }
        this.getData(page);
      } else if (page > 1) {
        if (page > 3) {
          for (let i = page - 1; i > 0; i--) {
            $("#" + i).css("display", "none");
          }
        }
        $("#first").removeClass("disabled");
        this.getData(page);
        if (page == this.pagination.last_page) {
          $("#last").addClass("disabled");
        } else {
          $("#last").removeClass("disabled");
        }
      } else if (page === 1) {
        $("#first").addClass("disabled");
        this.getData(1);
        if (this.pagination.last_page > 1) {
          $("#last").removeClass("disabled");
        }
      }
    },
    getData(page) {
      axios
        .get(listWardUrl + getToken() + "&page=" + page)
        .then((res) => {
          this.products = res.data.data.data;
          this.pagination = res.data.data;
          if (
            this.pagination.current_page === 1 &&
            this.pagination.last_page > 1
          ) {
            $("#last").removeClass("disabled");
          }
        })
        .catch((e) => {});
    },
    redirectProductDetail(url) {
      window.location.href = "/tin-rao-ban/" + url;
    },
  },
  created() {
      this.getListProductByCategories(window.location.pathname.split('/')[1]);
  },
  mounted() {},
};
</script>