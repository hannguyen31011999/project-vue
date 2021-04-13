<template>
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
      pagination: {},
      keyword: "",
    };
  },
  methods:{
    createCategories() {
      axios
        .post(createCategoriesUrl + getToken(), this.form)
        .then((res) => {
          if (res.data.status === true) {
            // this.categories.push(res.data.data);
            this.form.categories_name = '';
            this.getListCategories();
            $("#categories").modal("hide");
          } else {
            this.errors_categories = res.data.errors.categories_name[0];
          }
        })
        .catch((e) => {});
    },
    getListCategories(page) {
      axios
        .get(listCategoriesUrl + getToken())
        .then((res) => {
          if(res.data.data.last_page===1){
            $("#last").addClass('disabled');
          }
          this.categories.id = null;
          this.categories = res.data.data.data;
          this.pagination = res.data.data;
        })
        .catch((e) => {});
    },
  }
};
</script>