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
                    <b>TypeProduct</b>
                    <button
                      class="btn btn-icon waves-effect waves-light btn-primary"
                      style="margin-left: 95%; margin-top: 15px"
                      data-toggle="modal"
                      data-target="#createType"
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
                      @keyup="seachType()"
                      v-model="keyword"
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
                        <th>Type Name</th>
                        <th>Price</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,index) in type" :key="index">
                        <td>{{item.id}}</td>
                        <td>{{item.name}}</td>
                        <td>{{item.price.toLocaleString('it-IT', {style : 'currency', currency : 'VND'})}}</td>
                        <td>
                          <button
                            data-toggle="modal"
                            data-target="#editType"
                            @click="editType(item.id)"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                          >
                            <i class="fa fa-wrench"></i>
                          </button>
                          <button
                            @click="deleteType(item.id)"
                            class="btn btn-icon waves-effect waves-light btn-danger"
                          >
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
                            href=""
                            @click.prevent="changePage(page)"
                            >{{ page }}</a
                          >
                          <a
                            class="page-link"
                            v-else
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

    <!-- modal create -->
    <div
      id="createType"
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
            <h5 class="modal-title" id="myModalLabel">Create TypeProduct</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="createType()">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="name">TypeName</label>
                    <input type="text" v-model="form.name" class="form-control" />
                    <span style="color: red; margin-top: 5px">
                      {{ errors_type[0] }}
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" v-model="form.price" class="form-control" />
                    <span style="color: red; margin-top: 5px">
                      {{ errors_type[1] }}
                    </span>
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
      id="editType"
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
            <h5 class="modal-title" id="myModalLabel">Edit TypeProduct</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateType(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="name">TypeName</label>
                    <input type="text" v-model="form.name" class="form-control" />
                    <span style="color: red; margin-top: 5px">
                      {{ errors_type[0] }}
                    </span>
                  </div>
                  <div class="form-group">
                    <label for="price">Price</label>
                    <input type="number" v-model="form.price" class="form-control" />
                    <span style="color: red; margin-top: 5px">
                      {{ errors_type[1] }}
                    </span>
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
    <!-- /.modal edit -->
  </div>
</template>
<script>
import { createTypeUrl, listTypeUrl, seachTypeUrl,getToken,apiDomain} from "../../../config";
export default {
  data() {
    return {
      type: {},
      form: {
        'name':'',
        'price':'',
      },
      errors_type:[],
      pagination: {},
      keyword: "",
    };
  },
  methods: {
    getListTypeProduct(){
      axios.get(listTypeUrl + getToken())
      .then((res) => {
          if (res.data.data.last_page === 1) {
            $("#last").addClass("disabled");
          }
          this.type.id = null;
          this.type = res.data.data.data;
          this.pagination = res.data.data;
      })
      .catch((e) => {

      })
    },
    createType(){
      axios.post(createTypeUrl + getToken(),this.form)
      .then((res) => {
        if (res.data.status === true) {
            this.getListTypeProduct();
            this.form = {};
            $("#createType").modal("hide");
          } else {
            for (const [key, value] of Object.entries(res.data.errors)) {
              this.errors_type.push(value[0])
            }
          }
      })
      .catch((e) => {

      })
    },
    editType(id){
      this.errors_type = [];
      axios
        .get(apiDomain + "type/edit/" + id + "?token=" + getToken())
        .then((res) => {
          if (res.data.status === true) {
            
            this.form.id = null;
            this.form = res.data.data;
          }
        })
        .catch((e) => {});
    },
    updateType(id){
      axios
        .post(
          apiDomain + "type/update/" + id + "?token=" + getToken(),
          this.form
        )
        .then((res) => {
          if (res.data.status === true) {
            let index = this.type.findIndex((type) => type.id === id);
            this.type[index].name = res.data.data.name;
            this.type[index].price = res.data.data.price;
            $("#editType").modal("hide");
          } else {
            for (const [key, value] of Object.entries(res.data.errors)) {
              this.errors_type.push(value[0])
            }
          }
        })
        .catch((e) => {});
    },
    deleteType(id){
      if (confirm("Do you really want to delete?")) {
        axios
          .delete(
            apiDomain + "type/delete/" + id + "?token=" + getToken()
          )
          .then((res) => {
            if (res.data.status === true) {
              this.type.splice(this.type.indexOf(id), 1);
            }
          })
          .catch((e) => {});
      }
    },
    seachType(){
      if(this.keyword!==''){
        $("#last").addClass("disabled");
        axios
        .get(seachTypeUrl + getToken() + "&keyword=" + this.keyword)
        .then((res) => {
          if (res.data.status === true) {
            this.type.id = null;
            this.type = res.data.data;
            this.pagination = {};
          }
        })
        .catch((e) => {});
      }
      else{
        $("#last").removeClass("disabled");
        this.getListTypeProduct();
      }
    },
    changePage(page) {
      if (page === 0) {
        page += this.pagination.current_page + 1;
        if (this.pagination.last_page <= page) {
          $("#last").addClass("disabled");
          this.getData(page);
        }
        $("#first").removeClass("disabled");
        this.getData(page);
      } else if (page === -1) {
        page = this.pagination.current_page - 1;
        if (page < 2) {
          $("#first").addClass("disabled");
          this.getData(page);
        }
        this.getData(page);
      } else if (page > 1) {
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
        .get(listTypeUrl + getToken() + "&page=" + page)
        .then((res) => {
          // console.log(res.data.data.data);
          this.type.id = null;
          this.type = res.data.data.data;
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
    this.getListTypeProduct();
  },
};
</script>