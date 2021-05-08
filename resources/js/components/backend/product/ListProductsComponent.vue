<template>
<div id="wrapper">
    <navbarComponent></navbarComponent>
    <menuComponent></menuComponent>
    <!-- content -->
    <div class="content-page">
        <div class="content">
        <!-- Start Content-->
            <div class="container-fluid">
            <!-- start page title -->
                <br /><br />
                <div class="row">
                    <div class="col-12">
                    <div class="card">
                        <div class="card-body table-responsive">
                        <h4 class="m-t-0 header-title mb-4">
                            <b>Product</b>
                            <button
                            class="btn btn-icon waves-effect waves-light btn-primary"
                            style="margin-left: 95%; margin-top: 15px"
                            data-toggle="modal"
                            data-target="#"
                            >
                            <i class="fas fa-folder-plus"></i>
                            </button>
                        </h4>
                        <div class="m-t-0 header-title mb-4">
                            <input
                            type="text"
                            class="form-control"
                            placeholder="Seach ...."
                            @change="seachProduct()"
                            v-model="keyword"
                            style="margin-left: 77%; width: 200px; margin-bottom: 5px"
                            />
                        </div>
                        <table
                            id="datatable"
                            class="table table-bordered dt-responsive nowrap"
                            style="
                            border-collapse: collapse;
                            border-spacing: 0;
                            width: 100%;
                            "
                        >
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Date_start</th>
                                <th>Date_end</th>
                                <th>Price(tr/m2)</th>
                                <th>Area(m2)</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(product,index) in products" :key="index">
                                <td>{{ product.id }}</td>
                                <td>{{ product.title }}</td>
                                <td>{{ converDateTime(product.date_start) }}</td>
                                <td>{{ converDateTime(product.date_end) }}</td>
                                <td>{{ product.price }}</td>
                                <td>{{ product.area }}</td>
                                <td>
                                <button
                                    data-toggle="modal"
                                    data-target="#editProduct"
                                    @click.prevent="editProduct(product.id,index)"
                                    class="btn btn-icon waves-effect waves-light btn-warning"
                                >
                                    <i class="fa fa-wrench"></i>
                                </button>
                                <button
                                    @click.prevent="deleteProduct(item.id,index)"
                                    class="btn btn-icon waves-effect waves-light btn-danger">
                                    <i class="fas fa-trash"></i>
                                </button>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        <nav
                            aria-label="Page navigation example"
                            style="margin-top: 5px"
                        >
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
                                v-if="page < pagination.current_page + 3 && page !== pagination.current_page"
                                :id="page"
                                href=""
                                @click.prevent="changePage(page)"
                                >{{ page }}</a
                                >
                            </li>
                            <li id="last" class="page-item">
                                <a
                                class="page-link"
                                href=""
                                @click.prevent="changePage(0)"
                                >Next</a
                                >
                            </li>
                            </ul>
                        </nav>
                        </div>
                    </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
    </div>

    <!-- modal edit -->
    <div
      id="editProduct"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Edit Product</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateProduct(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="categories">Categories</label>
                    <select name="" id="" class="form-control" v-model="form.categories_id">
                        <option v-for="(item,index) in categories" :key="index" :value="item.id">{{ item.categories_name }}</option>
                    </select>
                    <span style="color: red; margin-top: 5px"></span>
                  </div>
                  <div class="form-group">
                      <label for="categories">Province</label>
                      <select name="" id="" class="form-control" v-model="form.province_id">
                        <option v-for="(item,index) in province" :key="index" :value="item.id">{{ item.province_name }}</option>
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="categories">District</label>
                      <select name="" id="" class="form-control" v-model="form.district_id">
                        <option v-for="(item,index) in district" :key="index" :value="item.id">{{ item.district_name }}</option>
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="categories">Ward</label>
                      <select name="" id="" class="form-control" v-model="form.ward_id">
                        <option v-for="(item,index) in ward" :key="index" :value="item.id">{{ item.ward_name }}</option>
                    </select>
                  </div>
                  <div class="form-group">
                      <label for="categories">Title</label>
                      <input type="text" v-model="form.title" class="form-control">
                      <span style="color: red; margin-top: 5px">{{ errors.title }}</span>
                  </div>
                  <div class="form-group">
                      <label for="categories">Area</label>
                      <input type="number" v-model="form.area" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="categories">Price</label>
                      <input type="number" v-model="form.price" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="categories">Address</label>
                      <input type="text" v-model="form.address" class="form-control">
                  </div>
                  <div class="form-group">
                      <label for="categories">Desc</label>
                      <textarea  cols="30" rows="5" v-model="form.desc" class="form-control"></textarea>
                  </div>
                </div>
              </div>
            </div>

            <div class="modal-footer">
              <button
                type="button"
                class="btn btn-secondary waves-effect"
                data-dismiss="modal"
              >
                Close
              </button>
              <button
                type="submit"
                class="btn btn-primary waves-effect waves-light"
              >
                Update
              </button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- end modal edit -->
</div>
</template>

<script>
import {apiDomain,getToken,listProductUrl,seachProductUrl} from '../../../config';
export default {
    data(){
        return{
            products:{},
            categories:[],
            province:[],
            district:[],
            ward:[],
            pagination:{},
            errors:{},
            form:{
            },
            keyword:null
        }
    },
    methods:{
        getListProduct(){
            axios.get(listProductUrl + getToken())
            .then(res => {
                if(res.data.status){
                    if(res.data.data.last_page === 1){
                        $("#last").addClass("disabled");
                    }
                    $("#last").removeClass("disabled");
                    this.products = res.data.data.data;
                    this.pagination = res.data.data;
                }
            })
            .catch(e => {

            })
        },
        editProduct(id,index){
            axios.get(apiDomain + 'product/edit/' + id + '?token=' + getToken())
            .then(res => {
                if(res.data.status){
                    this.categories = res.data.data.categories;
                    this.province = res.data.data.province;
                    this.district = res.data.data.district;
                    this.ward = res.data.data.ward;
                    this.form = this.products[index];
                }
            })
            .catch(e => {

            })
        },
        updateProduct(id){
            axios.post(apiDomain + 'product/update/' + id + '?token=' + getToken(),this.form)
            .then(res => {
                if(res.data.status){
                    let index = this.products.findIndex((item) => item.id === id);
                    this.products[index] = res.data.data;
                    $('#editProduct').modal('hide');
                }else{
                    this.errors = {};
                    for(const [key,value] of Object.entries(res.data.errors)){
                        this.errors[key] = value[0];
                    }
                }
            })
            .catch(e => {

            })
        },
        deleteProduct(id,index){
            if (confirm("Do you really want to delete?")) {
                axios
                .delete(
                    apiDomain + "product/delete/" + id + "?token=" + getToken()
                )
                .then((res) => {
                    if (res.data.status === true) {
                        this.product.splice(index,1);
                    }
                })
                .catch((e) => {});
            }
        },
        seachProduct(){
            if(this.keyword !==''){
                axios.get(seachProductUrl + getToken() + '&keyword=' + this.keyword)
                .then(res => {
                    if(res.data.status){
                        $("#last").addClass("disabled");
                        this.pagination = {};
                        this.products = res.data.data;
                    }
                })
                .catch(e => {

                })
            }else{
                this.getListProduct();
            }
        },
        changePage(page) {
            if (page === 0) {
                $('#'+this.pagination.current_page).css('display','none');
                page += this.pagination.current_page + 1;
                if (this.pagination.last_page <= page) {
                $("#last").addClass("disabled");
                this.getData(page);
                }
                $("#first").removeClass("disabled");
                this.getData(page);
            } else if (page === -1) {
                page = this.pagination.current_page - 1;
                $('#'+ page).css('display','block');
                $('#'+ (page-1)).css('display','block');
                $('#'+ (page-2)).css('display','block');
                if (page < 2) {
                $("#first").addClass("disabled");
                this.getData(page);
                }
                this.getData(page);
            } else if (page > 1) {
                if(page>3){
                for(let i = page -1;i > 0;i--){
                    $('#'+i).css('display','none');
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
            axios.get(listProductUrl + getToken() + "&page=" + page)
            .then((res) => {
            this.products.id = null;
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
        converDateTime(time){
            let date = new Date(time);
            return date.getDate() + '-' + parseInt(date.getMonth()+1) + '-' + date.getFullYear();
        }
    },
    created(){
        this.getListProduct();
    },
    mounted(){
        
    },
}
</script>