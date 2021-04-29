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
                    <b>Order</b>
                    <button
                      class="btn btn-icon waves-effect waves-light btn-primary"
                      style="margin-left: 95%; margin-top: 15px"
                      data-toggle="modal"
                      data-target="#createProvince"
                    >
                      <i class="fas fa-folder-plus"></i>
                    </button>
                  </h4>
                  <div class="m-t-0 header-title mb-4">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Seach ...."
                      style="margin-left: 77%; width: 200px; margin-bottom: 5px"
                      v-model="keyword"
                      @change="seachOrder()"
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
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Total_date</th>
                        <th>Price</th>
                        <th>Created</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,index) in order" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.fullname }}</td>
                        <td>{{ item.address }}</td>
                        <td>{{ item.phone }}</td>
                        <td>{{ item.email }}</td>
                        <td>{{ item.total_date }}</td>
                        <td>{{ item.price }}</td>
                        <td>{{ converDateTime(item.created_at) }}</td>
                        <td>
                          <button
                            data-toggle="modal"
                            data-target="#editOrder"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                            @click.prevent="editOrder(item.id,index)"
                          >
                            <i class="fa fa-wrench"></i>
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

    <!-- modal create -->
    <div
      id="editOrder"
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
            <h5 class="modal-title" id="myModalLabel">Edit Order</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateOrder(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="fullname">Fullname</label>
                    <input
                      type="text"
                      v-model="form.fullname"
                      class="form-control"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.fullname }}</span>
                  </div>
                  <div class="form-group">
                    <label for="address">Address</label>
                    <input
                      type="text"
                      v-model="form.address"
                      class="form-control"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.address }}</span>
                  </div>
                  <div class="form-group">
                    <label for="email">Email</label>
                    <input
                      type="text"
                      v-model="form.email"
                      class="form-control"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.email }}</span>
                  </div>
                  <div class="form-group">
                    <label for="phone">Phone</label>
                    <input
                      type="text"
                      v-model="form.phone"
                      class="form-control"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.phone }}</span>
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
    <!-- /.modal create -->
</div>
</template>

<script>
import {apiDomain,getToken,listOrderUrl,seachOrderUrl} from '../../../config';
export default {
    data(){
        return{
            order:[],
            pagination:{},
            form:{},
            errors:{},
            keyword:''
        }
    },
    methods:{
        getListOrder(){
            axios.get(listOrderUrl + getToken())
            .then(res => {
                if(res.data.status){
                    if(res.data.data.last_page === 1){
                        $("#last").addClass("disabled");
                    }
                    $("#last").addClass("disabled");
                    this.order = res.data.data.data;
                    this.pagination = res.data.data;
                }
            })
            .catch(e => {

            })
        },
        editOrder(id,index){
            this.form = this.order[index];
        },
        updateOrder(id){
            axios.post(apiDomain + 'order/update/' + id + '?token=' + getToken(),this.form)
            .then(res => {
                if(res.data.status){
                    let index = this.order.findIndex((item) => item.id===id);
                    this.order[index] = res.data.data;
                    $('#editOrder').modal('hide');
                }else{
                    this.errors = {};
                    for (const [key,value] of Object.entries(res.data.errors)) 
                    {
                        this.errors[key] = value[0];
                    }
                }
            })
            .catch(e => {

            })
            
        },
        seachOrder(){
            if(this.keyword!==''){
                axios.get(seachOrderUrl + getToken() + '&keyword=' + this.keyword)
                .then(res => {
                    if(res.data.status){
                        $("#last").addClass("disabled");
                        this.order = res.data.data;
                        this.pagination = {};
                    }
                })
                .catch(e => {

                })
            }else{
                this.getListOrder();
            }
        },
        converDateTime(time){
            let date = new Date(time);
            return date.getDate() + '-' + parseInt(date.getMonth()+1) + '-' + date.getFullYear();
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
            axios.get(listOrderUrl + getToken() + "&page=" + page)
            .then((res) => {
            this.order.id = null;
            this.order = res.data.data.data;
            this.pagination = res.data.data;
            if (
                this.pagination.current_page === 1 &&
                this.pagination.last_page > 1
            ) {
                $("#last").removeClass("disabled");
            }
            })
            .catch((e) => {});
        }
    },
    created(){
        this.getListOrder();
    },
    mounted(){
        
    },
}
</script>