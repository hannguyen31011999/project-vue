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
                    <b>Ward</b>
                    <button
                      class="btn btn-icon waves-effect waves-light btn-primary"
                      style="margin-left: 95%; margin-top: 15px"
                      data-toggle="modal"
                      data-target="#createWard"
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
                      @keyup="seachWard()"
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
                        <th>Province</th>
                        <th>District</th>
                        <th>Ward</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,index) in ward" :key="index">
                        <td>{{item.id}}</td>
                        <td v-if="item.provinces!==undefined">{{item.provinces.province_name}}</td>
                        <td v-else>{{item.province_name}}</td>
                        <td v-if="item.districts!==undefined">{{item.districts.district_name}}</td>
                        <td v-else>{{item.district_name}}</td>
                        <td>{{item.ward_name}}</td>
                        <td>
                          <button
                            data-toggle="modal"
                            data-target="#editWard"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                            @click.prevent="editWard(item.id)"
                          >
                            <i class="fa fa-wrench"></i>
                          </button>
                          <button
                            class="btn btn-icon waves-effect waves-light btn-danger" @click.prevent="deleteWard(item.id)">
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
                            style="color:#3490dc"
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
          </div>
          <!-- end row -->
        </div>
      </div>
    </div>
    <!-- modal create -->
    <div
      id="createWard"
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
            <h5 class="modal-title" id="myModalLabel">Create Ward</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="createWard()">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="province">Province</label>
                    <select name="" id="" class="form-control" v-model="form.province_id" @change="changeDistrict()">
                      <option v-for="(item,index) in province" :key="index" :value="item.id">
                        {{ item.province_name }}
                      </option>
                    </select>
                    <span style="color: red; margin-top: 5px">{{ errors.province_id }}</span>
                  </div>
                  <div class="form-group">
                    <label for="district"></label>
                    <select name="" id="" class="form-control" v-model="form.district_id" v-if="district!==null">
                      <option v-for="(item,index) in district" :key="index" :value="item.id">
                        {{ item.district_name }}
                      </option>
                    </select>
                    <span style="color: red; margin-top: 5px">{{ errors.district_id }}</span>
                  </div>
                  <div class="form-group">
                    <label for="categories">Ward</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.ward_name"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.ward_name }}</span>
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
      id="editWard"
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
            <h5 class="modal-title" id="myModalLabel">Edit Ward</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updateWard(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="province">Province</label>
                    <select v-model="form.province_id" @change="changeDistrict()" class="form-control">
                        <option 
                          v-for="(item,index) in province" 
                          :key="index" v-bind:value="item.id"
                          :v-if="item.id===form.province_id"
                          selected>
                            {{ item.province_name }}
                        </option>
                    </select>
                    <span style="color: red; margin-top: 5px">{{ errors.province_id }}</span>
                  </div>
                  <div class="form-group">
                    <label for="district"></label>
                    <select name="" id="" class="form-control" v-model="form.district_id" v-if="district!==null">
                      <option v-for="(item,index) in district" :key="index" :value="item.id">
                        {{ item.district_name }}
                      </option>
                    </select>
                    <span style="color: red; margin-top: 5px">{{ errors.district_id }}</span>
                  </div>
                  <div class="form-group">
                    <label for="categories">Ward</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.ward_name"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.ward_name }}</span>
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
import {createWardUrl,listWardUrl,seachWardUrl,apiDomain, getToken} from '../../../config';
export default {
    data(){
        return{
            ward:[],
            district:[],
            province:[],
            form:{
            },
            errors:{},
            pagination:{},
            keyword:'',
        }
    },
    methods:{
        getListWard(){
            axios.get(listWardUrl + getToken())
            .then(res => {
                if(res.data.status === true){
                    if (res.data.data.ward.last_page === 1) {
                        $("#last").addClass("disabled");
                    }
                    this.ward = res.data.data.ward.data;
                    this.province = res.data.data.province;
                    this.pagination = res.data.data.ward;
                }
            })
            .catch(e => {

            })
        },
        changeDistrict(){
          axios.get(apiDomain + 'ward/change/district/' + this.form.province_id + '?token=' + getToken())
          .then(res => {
            if(res.data.status === true){
              this.district = res.data.data;
            }
          })
          .catch(e => {

          })
        },
        createWard(){
          axios.post(createWardUrl + getToken(),this.form)
          .then(res => {
            this.errors = {};
            if(res.data.status === true){
              this.form = {};
              this.getListWard();
              $('#createWard').modal('hide');
            }else{
              for(const [key,value] of Object.entries(res.data.errors))
              {
                this.errors[key] = value[0];
              }
              console.log(this.errors)
            }
          })
          .catch(e => {

          })
        },
        editWard(id){
          axios.get(apiDomain + 'ward/edit/'+id+'?token='+getToken())
          .then(res => {
            this.form = {};
            if(res.data.status===true){
              this.form = res.data.data;
              this.district = this.changeDistrict();
            }
          })
          .catch(e => {

          })
        },
        updateWard(id){
          axios.post(apiDomain + 'ward/update/' + id +'?token=' + getToken(),this.form)
          .then(res => {
              this.errors = {};
              if(res.data.status === true)
              {
                  let index = this.ward.findIndex((item) => item.id===id);
                  res.data.data.ward.provinces = res.data.data.province[0];
                  res.data.data.ward.districts = res.data.data.district[0];
                  this.ward[index] = res.data.data.ward;
                  $('#editWard').modal('hide');
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
        deleteWard(id){
          if (confirm("Do you really want to delete?")){
            axios.delete(apiDomain + 'ward/delete/'+id+'?token='+getToken())
            .then(res => {
              this.form = {};
              if(res.data.status===true){
                let index = this.ward.findIndex((item) => item.id===id);
                this.ward.splice(index,1);
                alert('xóa thành công');
              }
            })
            .catch(e => {

            })
          }
        },
        seachWard(){
          if(this.keyword!==''){
            $("#last").addClass("disabled");
            axios.get(seachWardUrl + getToken() + '&keyword=' + this.keyword)
            .then(res => {
              if(res.data.status===true){
                this.ward = [];
                for(let i = 0;i<res.data.data.length;i++)
                {
                    this.ward.push(res.data.data[i]);
                }
                this.pagination = {};
              }
            })
            .catch(e => {
              if(e.status === 429){
                alert('Server too many request')
              }
            })
          }else{
            this.getListWard();
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
            }else if (page === 1) {
                $("#first").addClass("disabled");
                this.getData(1);
                if (this.pagination.last_page > 1) {
                    $("#last").removeClass("disabled");
                }
            }
        },
        getData(page) {
            axios.get(listWardUrl + getToken() + "&page=" + page)
            .then((res) => {
            this.ward = res.data.data.ward.data;
            this.pagination = res.data.data.ward;
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
    created(){
        this.getListWard();
    },
    mounted() {
        
    },
}
</script>