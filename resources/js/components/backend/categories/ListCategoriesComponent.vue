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
                    <b>Categories</b>
                    <button
                      class="btn btn-icon waves-effect waves-light btn-primary"
                      style="margin-left: 95%; margin-top: 15px"
                      data-toggle="modal"
                      data-target="#categories"
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
                      @keyup="seachCategories()"
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
                        <th>Categories</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item, index) in categories" :key="index">
                        <td>{{ item.id }}</td>
                        <td>{{ item.categories_name }}</td>
                        <td>
                          <button
                            @click="editCategories(item.id)"
                            data-toggle="modal"
                            data-target="#editCategories"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                          >
                            <i class="fa fa-wrench"></i>
                          </button>
                          <button
                            @click="deleteCategories(item.id)"
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
          <!-- end row -->
        </div>
      </div>
    </div>

    <!-- modal create -->
    <div
      id="categories"
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
            <h5 class="modal-title" id="myModalLabel">Create Categories</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="createCategories()">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="categories">Categories</label>
                    <input
                      type="text"
                      v-model="form.categories_name"
                      class="form-control"
                    />
                    <span style="color: red; margin-top: 5px">{{
                      errors_categories
                    }}</span>
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
      id="editCategories"
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
            <h5 class="modal-title" id="myModalLabel">Edit Categories</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateCategories(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="categories">Categories</label>
                    <input
                      type="text"
                      v-model="form.categories_name"
                      class="form-control"
                      value=""
                    />
                    <span style="color: red; margin-top: 5px">{{
                      errors_categories
                    }}</span>
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
import {
  createCategoriesUrl,
  getToken,
  listCategoriesUrl,
  apiDomain,
  seachCategoriesUrl,
} from "../../../config";
export default {
  data() {
    return {
      categories: {
        categories_name: "",
      },
      form: {
        categories_name: "",
      },
      errors_categories: "",
      pagination: {},
      keyword: "",
    };
  },
  methods: {
    getListCategories(page) {
      axios
        .get(listCategoriesUrl + getToken())
        .then((res) => {
          if (res.data.data.last_page === 1) {
            $("#last").addClass("disabled");
          }
          this.categories.id = null;
          this.categories = res.data.data.data;
          this.pagination = res.data.data;
        })
        .catch((e) => {});
    },
    createCategories() {
      axios
        .post(createCategoriesUrl + getToken(), this.form)
        .then((res) => {
          if (res.data.status === true) {
            // this.categories.push(res.data.data);
            this.getListCategories();
            this.form.categories_name = "";
            $("#categories").modal("hide");
          } else {
            this.errors_categories = res.data.errors.categories_name[0];
          }
        })
        .catch((e) => {});
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
        .get(listCategoriesUrl + getToken() + "&page=" + page)
        .then((res) => {
          // console.log(res.data.data.data);
          this.categories.id = null;
          this.categories = res.data.data.data;
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
    editCategories(id) {
      axios
        .get(apiDomain + "categories/edit/" + id + "?token=" + getToken())
        .then((res) => {
          if (res.data.status === true) {
            this.form.id = null;
            this.form = res.data.data;
          }
        })
        .catch((e) => {});
    },

    deleteCategories(id) {
      if (confirm("Do you really want to delete?")) {
        axios
          .delete(
            apiDomain + "categories/delete/" + id + "?token=" + getToken()
          )
          .then((res) => {
            if (res.data.status === true) {
              this.categories.splice(this.categories.indexOf(id), 1);
            }
          })
          .catch((e) => {});
      }
    },
    updateCategories(id) {
      this.errors_categories = "";
      axios
        .post(
          apiDomain + "categories/update/" + id + "?token=" + getToken(),
          this.form
        )
        .then((res) => {
          if (res.data.status === true) {
            let index = this.categories.findIndex((cate) => cate.id === id);
            this.categories[index].categories_name =
              res.data.data.categories_name;
            $("#editCategories").modal("hide");
          } else {
            this.errors_categories = res.data.errors.categories_name[0];
          }
        })
        .catch((e) => {});
    },
    seachCategories() {
      if(this.keyword!==''){
        $("#last").addClass("disabled");
        axios
        .get(seachCategoriesUrl + getToken() + "&keyword=" + this.keyword)
        .then((res) => {
          if (res.data.status === true) {
            this.categories.id = null;
            this.categories = res.data.data;
            this.pagination = {};
          }
        })
        .catch((e) => {});
      }
      else{
        $("#last").removeClass("disabled");
        this.getListCategories();
      }
    },
  },
  created() {
    this.getListCategories();
  },
};
</script>