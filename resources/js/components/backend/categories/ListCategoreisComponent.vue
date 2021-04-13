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
                            class="btn btn-icon waves-effect waves-light btn-warning"
                          >
                            <i class="fa fa-wrench"></i>
                          </button>
                          <button
                            class="btn btn-icon waves-effect waves-light btn-danger"
                          >
                            <i class="fas fa-trash"></i>
                          </button>
                        </td>
                      </tr>
                    </tbody>
                    <nav aria-label="Page navigation example" style="margin-top:5px;margin-right:43%;">
                        <ul class="pagination justify-content-center">
                          <li class="page-item disabled">
                            <a class="page-link" href="#" tabindex="-1"
                              >Previous</a
                            >
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">1</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">2</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">3</a>
                          </li>
                          <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                          </li>
                        </ul>
                      </nav>
                  </table>
                </div>
              </div>
            </div>
          </div>
          <!-- end row -->
        </div>
      </div>
    </div>
    <!-- sample modal content -->
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
    <!-- /.modal -->
  </div>
</template>
<script>
import {
  createCategoriesUrl,
  getToken,
  listCategoriesUrl,
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
      showModal: false,
    };
  },
  methods: {
    createCategories() {
      axios
        .post(createCategoriesUrl + getToken(), this.form)
        .then((res) => {
          if (res.data.status === true) {
            this.categories.push(res.data.data);
            $("#categories").modal("hide");
          } else {
            this.errors_categories = res.data.errors.categories_name[0];
          }
        })
        .catch((e) => {});
    },
    getListCategories() {
      axios
        .get(listCategoriesUrl + getToken())
        .then((res) => {
          this.categories.id = null;
          this.categories = res.data.data;
        })
        .catch((e) => {});
    },
  },
  created() {
    this.getListCategories();
  },
};
</script>