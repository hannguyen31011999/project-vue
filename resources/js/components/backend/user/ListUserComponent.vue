<template>
  <div id="wrapper">
    <navbarComponent></navbarComponent>
    <menuComponent></menuComponent>
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
                    <b>User</b>
                  </h4>
                  <div class="m-t-0 header-title mb-4">
                    <input
                      type="text"
                      class="form-control"
                      placeholder="Seach ...."
                      style="margin-left: 77%; width: 200px; margin-bottom: 5px"
                      v-model="keyword"
                      @keyup="seachUser()"
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
                        <th>Fullname</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>CMND</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(value,index) in user" :key="index">
                        <td>{{ value.id }}</td> 
                        <td>{{ value.fullname }}</td>
                        <td>{{ value.email }}</td>
                        <td>{{ value.address }}</td>
                        <td>{{ value.cmnd }}</td>
                        <td>{{ value.phone }}</td>
                        <td style="text-align: center">
                          <button
                            data-toggle="modal"
                            data-target="#editUser"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                            @click.prevent="editUser(value.id)"
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
        </div>
      </div>
    </div>
    <!-- modal edit user -->
    <div
      id="editUser"
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
            <h5 class="modal-title" id="myModalLabel">Edit User</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateUser(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="categories">Fullname</label>
                    <input
                      type="text"
                      v-model="form.fullname"
                      class="form-control"
                      value=""
                    />
                    <span style="color: red; margin-top: 5px">{{errors.fullname}}</span>
                  </div>
                  <div class="form-group">
                    <label for="categories">Email</label>
                    <input
                      type="text"
                      v-model="form.email"
                      class="form-control"
                      value=""
                    />
                    <span style="color: red; margin-top: 5px">{{errors.email}}</span>
                  </div>
                  <div class="form-group">
                    <label for="categories">Address</label>
                    <input
                      type="text"
                      v-model="form.address"
                      class="form-control"
                      value=""
                    />
                    <span style="color: red; margin-top: 5px">{{errors.address}}</span>
                  </div>
                  <div class="form-group">
                    <label for="categories">Cmnd</label>
                    <input
                      type="text"
                      v-model="form.cmnd"
                      class="form-control"
                      value=""
                    />
                    <span style="color: red; margin-top: 5px">{{errors.cmnd}}</span>
                  </div>
                  <div class="form-group">
                    <label for="categories">Phone</label>
                    <input
                      type="text"
                      v-model="form.phone"
                      class="form-control"
                      value=""
                    />
                    <span style="color: red; margin-top: 5px">{{errors.phone}}</span>
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
    <!-- end modal edit user -->
  </div>
</template>

<script>
import {
  listUserUrl,
  seachUserUrl,
  apiDomain,
  getToken,
} from "../../../config";
export default {
  data() {
    return {
        form:{},
        user: [],
        errors: {},
        pagination: {},
        keyword:''
    };
  },
  methods: {
    getListUser() {
        axios.get(listUserUrl + getToken())
        .then((res) => {
            if (res.data.data.last_page === 1) {
                $("#last").addClass("disabled");
            }
            this.user = res.data.data.data;
            this.pagination = res.data.data;
            })
        .catch((e) => {});
    },
    editUser(id){
        axios.get(apiDomain + 'user/edit/' + id + '?token=' + getToken())
        .then((res) => {
            if(res.data.status===true){
                this.form = res.data.data;
            }
        })
        .catch((e) => {

        })
    },
    updateUser(id){
        axios.post(apiDomain + 'user/update/' + id + '?token=' + getToken(),this.form)
        .then((res) => {
            this.errors = {};
            if(res.data.status === true){
                let index = this.user.findIndex((user) => user.id === id);
                this.user[index] = res.data.data;
                $('#editUser').modal('hide');
            }else{
                for(const[key,value] of Object.entries(res.data.errors)){
                    this.errors[key] = value[0];
                }
            }
        })
        .catch((e) => {

        })
    },
    seachUser(){
        if(this.keyword!==''){
            $("#last").addClass("disabled");
            axios.get(seachUserUrl + getToken() + '&keyword=' + this.keyword)
            .then((res) => {
                if (res.data.status === true) {
                    this.user = res.data.data;
                    this.pagination = {};
                }
            })
            .catch((e) => {

            })
        }else{
            $("#last").removeClass("disabled");
            this.getListUser();
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
      axios
        .get(listUserUrl + getToken() + "&page=" + page)
        .then((res) => {
          // console.log(res.data.data.data);
          this.user.id = null;
          this.user = res.data.data.data;
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
  },
  created() {
    this.getListUser();
  },
};
</script>