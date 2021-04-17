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
                    <b>Province</b>
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
                      @keyup="seachProvince()"
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
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,index) in province" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.province_name }}</td>
                        <td>
                          <button
                            data-toggle="modal"
                            data-target="#viewDistrict"
                            class="btn btn-icon waves-effect waves-light btn-primary"
                            @click.prevent="viewDistrict(item.id)"
                          >
                            <i class="fas fa-eye"></i>
                          </button>
                          <button
                            data-toggle="modal"
                            data-target="#editProvince"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                            @click.prevent="editProvince(item.id)"
                          >
                            <i class="fa fa-wrench"></i>
                          </button>
                          <button
                            @click.prevent="deleteProvince(item.id)"
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

    <!-- modal create -->
    <div
      id="createProvince"
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
            <h5 class="modal-title" id="myModalLabel">Create Province</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="createProvince()">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="categories">Province</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.province_name"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.province_name }}</span>
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
                Create
              </button>
            </div>
          </form>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal create -->

    <!-- modal edit -->
    <div
      id="editProvince"
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
            <h5 class="modal-title" id="myModalLabel">Edit Province</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateProvince(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="categories">Province</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.province_name"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.province_name }}</span>
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

    <!-- modal view -->
    <div
      id="viewDistrict"
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
            <h5 class="modal-title" id="myModalLabel">List District</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <div class="modal-body">
            <table
              id="datatable"
              class="table table-bordered dt-responsive nowrap"
              style="border-collapse: collapse;border-spacing: 0;width: 100%;">
              <thead>
                <th>ID</th>
                <th>District_name</th>
              </thead>
              <tbody>
                <tr v-for="(item,index) in district" :key="index">
                  <td>{{item.id}}</td>
                  <td>{{item.district_name}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- end modal view -->
  </div>
</template>

<script>
import {listProvinceUrl,createProvinceUrl,seachProvinceUrl,getToken,apiDomain} from '../../../config';
export default {
    data(){
        return{
          province:[],
          district:[],
          form:{
            id:null,
            province_name:''
          },
          errors:{},
          pagination:{},
          keyword:''
        }
    },
    methods:{
        getListProvince(){
          axios.get(listProvinceUrl + getToken())
          .then(res => {
            if (res.data.data.last_page === 1) {
              $("#last").addClass("disabled");
            }
            this.province.id = null;
            this.province = res.data.data.data;
            this.pagination = res.data.data;
          })
          .catch(e =>{

          })
        },
        createProvince(){
          axios.post(createProvinceUrl + getToken(),this.form)
          .then(res => {
            this.errors = {};
            if(res.data.status === true){
              this.getListProvince();
              this.form = {};
              $('#createProvince').modal('hide');
            }else{
              for(const [key,value] of Object.entries(res.data.errors))
              {
                this.errors[key] = value[0];
              }
            }
          })
          .catch(e => {

          })
        },
        editProvince(id){
          axios.get(apiDomain + 'province/edit/' + id + '?token=' + getToken())
          .then(res => {
            this.form = {};
            if(res.data.status === true)
            {
              this.form = res.data.data;
            }
          })
          .catch(e => {

          })
        },
        updateProvince(id){
          axios.post(apiDomain + 'province/update/' + id + '?token=' + getToken(),this.form)
          .then(res => {
            this.errors = {};
            if(res.data.status === true){
              let index = this.province.findIndex((item) => item.id === id);
              this.province[index] = res.data.data;
              $('#editProvince').modal('hide');
            }else{
              for(const [key,value] of Object.entries(res.data.errors))
              {
                this.errors[key] = value[0];
              }
            }
          })
          .catch(e => {

          })
        },
        deleteProvince(id){
          if (confirm("Do you really want to delete?")) {
            axios.delete(apiDomain + 'province/delete/' + id +'?token=' + getToken())
            .then(res => {
              if(res.data.status === true)
              {
                let index = this.province.findIndex((item) => item.id === id);
                this.province.splice(index,1);
                alert('Xóa thành công');
              }
            })
            .catch(e => {

            })
          }
        },
        seachProvince(){
          if(this.keyword!==''){
            $("#last").addClass("disabled");
            axios.get(seachProvinceUrl + getToken() + '&keyword=' + this.keyword)
            .then(res => {
              if (res.data.status === true) {
                this.province = res.data.data;
                this.pagination = {};
              }
            })
            .catch(e => {

            })
          }else{
            this.getListProvince();
          }
        },
        viewDistrict(id){
          axios.get(apiDomain + 'province/view/' + id + '?token=' + getToken())
          .then(res => {
            if(res.data.status === true)
            {
              this.district = res.data.data;
            }
          })
          .catch(e => {

          })
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
            axios.get(listProvinceUrl + getToken() + "&page=" + page)
            .then((res) => {
            this.province.id = null;
            this.province = res.data.data.data;
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
      this.getListProvince();
    },
    mounted() {
        
    },
};
</script>