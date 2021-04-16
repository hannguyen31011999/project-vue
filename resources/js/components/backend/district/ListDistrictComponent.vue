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
                    <b>District</b>
                    <button
                      class="btn btn-icon waves-effect waves-light btn-primary"
                      style="margin-left: 95%; margin-top: 15px"
                      data-toggle="modal"
                      data-target="#createDistrict"
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
                      @keyup="seachDistrict()"
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
                        <th>Province_name</th>
                        <th>District_name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,index) in district" :key="index">
                        <td>{{item.id}}</td>
                        <td v-if="item.provinces!==undefined">{{item.provinces.province_name}}</td>
                        <td v-else>{{item.province_name}}</td>
                        <td>{{item.district_name}}</td>
                        <td>
                          <button
                            data-toggle="modal"
                            data-target="#viewDistrict"
                            class="btn btn-icon waves-effect waves-light btn-primary"
                          >
                            <i class="fas fa-eye"></i>
                          </button>
                          <button
                            data-toggle="modal"
                            data-target="#editDistrict"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                            @click.prevent="editDistrict(item.id)"
                          >
                            <i class="fa fa-wrench"></i>
                          </button>
                          <button
                            class="btn btn-icon waves-effect waves-light btn-danger"
                            @click.prevent="deleteDistrict(item.id)"
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
      id="createDistrict"
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
            <h5 class="modal-title" id="myModalLabel">Create District</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="createDistrict()">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                        <label for="categories">Province</label>
                        <select v-model="form.province_id" class="form-control">
                            <option v-for="(item,index) in province" :key="index" v-bind:value="item.id">
                                {{ item.province_name }}
                            </option>
                        </select>
                        <span style="color: red; margin-top: 5px">{{ errors.province_id }}</span>
                    </div>
                    <div class="form-group">
                        <label for="categories">District</label>
                        <input v-model="form.district_name" type="text" class="form-control">
                        <span style="color: red; margin-top: 5px">{{ errors.district_name }}</span>
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
      id="editDistrict"
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
            <h5 class="modal-title" id="myModalLabel">Update District</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateDistrict(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                    <div class="form-group">
                        <label for="categories">Province</label>
                        <select v-model="form.province_id" class="form-control">
                            <option v-for="(item,index) in province" :key="index" v-bind:value="item.id" :v-if="item.id===form.id" selected>
                                {{ item.province_name }}
                            </option>
                        </select>
                        <span style="color: red; margin-top: 5px"></span>
                    </div>
                    <div class="form-group">
                        <label for="categories"></label>
                        <input
                        type="text"
                        class="form-control"
                        v-model="form.district_name"
                        />
                        <span style="color: red; margin-top: 5px">{{ errors.district_name }}</span>
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
  apiDomain,
  createDistrictUrl,
  listDistrictUrl,
  seachDistrictUrl,
  getToken,
  listProvinceUrl,
  getHeader
} from "../../../config";
export default {
  data() {
    return {
      district: [],
      province: [],
      form: {
      },
      pagination: {},
      errors: {},
      keyword: "",
    };
  },
  methods: {
    getListDistrict() {
      axios
        .get(listDistrictUrl + getToken())
        .then((res) => {
          if (res.data.data.last_page === 1) {
            $("#last").addClass("disabled");
          }
          this.district = res.data.data.district.data;
          this.province = res.data.data.province;
          this.pagination = res.data.data.district;
        })
        .catch((e) => {});
    },
    createDistrict(){
        axios.post(createDistrictUrl + getToken(),this.form)
        .then(res => {
            this.errors = {};
            if(res.data.status === true){
              this.getListDistrict();
              this.form = {};
              $('#createDistrict').modal('hide');
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
    editDistrict(id){
        axios.get(apiDomain + 'district/edit/' + id +'?token=' + getToken())
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
    updateDistrict(id){
        axios.post(apiDomain + 'district/update/' + id +'?token=' + getToken(),this.form)
        .then(res => {
            this.errors = {};
            if(res.data.status === true)
            {
                let index = this.district.findIndex((item) => item.id===id);
                res.data.data.district.provinces = res.data.data.province[0];
                this.district[index] = res.data.data.district;
                $('#editDistrict').modal('hide');
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
    deleteDistrict(id){
        if (confirm("Do you really want to delete?")){
            axios.delete(apiDomain + 'district/delete/'+id+'?token='+getToken())
            .then(res => {
                if(res.data.status === true)
                {
                    let index = this.district.findIndex((item) => item.id===id);
                    this.district.splice(index,1);
                    alert('Xóa thành công');
                }
            })
            .catch(e => {

            })
        }
    },
    seachDistrict(){
        if(this.keyword!==''){
            $("#last").addClass("disabled");
            axios.get(seachDistrictUrl + getToken() + '&keyword='+this.keyword)
            .then(res => {
                this.district = [];
                if(res.data.status === true)
                {
                    for(let i = 0;i<res.data.data.length;i++)
                    {
                        this.district.push(res.data.data[i]);
                    }
                    this.pagination = {};
                }
            })
            .catch(e => {

            })
        }else{
            this.getListDistrict();
        }
    },
    viewWard(id){

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
        axios.get(listDistrictUrl + getToken() + "&page=" + page)
        .then((res) => {
        this.district = res.data.data.district.data;
        this.pagination = res.data.data.district;
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
    this.getListDistrict();
  },
  mounted() {},
};
</script>