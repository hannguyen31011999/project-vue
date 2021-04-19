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
                    <b>Post</b>
                    <button
                      class="btn btn-icon waves-effect waves-light btn-primary"
                      style="margin-left: 95%; margin-top: 15px"
                      data-toggle="modal"
                      data-target="#createPost"
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
                      @keyup="seachPost()"
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
                        <th>User_create</th>
                        <th>Title</th>
                        <th>Content</th>
                        <th>image</th>
                        <th>Url</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,index) in post" :key="index">
                        <td>{{item.id}}</td>
                        <td v-if="item.users!==undefined">{{item.users.fullname}}</td>
                        <td v-else>{{item.fullname}}</td>
                        <td>{{item.title}}</td>
                        <td style="text-align:center;">
                          <button
                            :title="'view content'"
                            data-toggle="modal"
                            data-target="#viewContent"
                            class="btn btn-icon waves-effect waves-light btn-primary"
                            @click.prevent="viewContent(index)">
                            <i class="fas fa-eye"></i>
                          </button>
                        </td>
                        <td><img @click.prevent="previewImage(item.id)" :id="'image'+item.id" v-bind:src="'/assets/image_post/' + item.image" alt="" height="50" width="50"></td>
                        <td>{{item.url}}</td>
                        <td>
                          <button
                            data-toggle="modal"
                            data-target="#editPost"
                            class="btn btn-icon waves-effect waves-light btn-warning"
                            @click.prevent="editPost(item.id)"
                          >
                            <i class="fa fa-wrench"></i>
                          </button>
                          <button
                            @click="deletePost(item.id,index)"
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
      id="createPost"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Create Post</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="createPost()">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.title"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.title }}</span>
                  </div>
                  <div class="form-group">
                    <label for="title">Image</label>
                    <input
                      type="file"
                      id="example-fileinput"
                      class="form-control"
                      onchange="preview_image(event)"
                      v-on:change="onFileChange"
                    />
                    <div class="card" id="card" style="margin-top: 5px;display: none;">
                        <div class="card-body">
                            <div id="preview">
                            </div>
                            <img id="output" style="display:none;" height="150" width="200">
                        </div>
                    </div>
                    
                    <span style="color: red; margin-top: 5px">{{ errors.image }}</span>
                  </div>
                  <div class="form-group">
                    <label for="title">Content</label>
                    <textarea name="ckeditor"  id="ckeditor" cols="50" rows="10" class="form-control"></textarea>
                    <span style="color: red; margin-top: 5px">{{ errors.content }}</span>
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
    <!-- end modal create -->

    <!-- modal edit -->
    <div
      id="editPost"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">Edit Post</h5>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-hidden="true"
            >
              ×
            </button>
          </div>
          <form @submit.prevent="updatePost(form.id)">
            <div class="modal-body">
              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <label for="title">Title</label>
                    <input
                      type="text"
                      class="form-control"
                      v-model="form.title"
                    />
                    <span style="color: red; margin-top: 5px">{{ errors.title }}</span>
                  </div>
                  <div class="form-group">
                    <label for="title">Image</label>
                    <input
                      type="file"
                      id="example-fileinput"
                      class="form-control"
                      onchange="fileLoad(event)"
                      v-on:change="onFileChange"
                    />
                    <div class="card" id="card" style="margin-top: 5px;display: block;">
                        <div class="card-body">
                            <div id="preview">
                            </div>
                            <img v-bind:src="'/assets/image_post/' + form.image" id="output-edit" style="display: block;" alt="" height=150 width=200>
                        </div>
                    </div>
                    
                    <span style="color: red; margin-top: 5px">{{ errors.image }}</span>
                  </div>
                  <div class="form-group">
                    <label for="title">Content</label>
                    <textarea name="ckeditor" id="ckeditorEdit" cols="50" rows="10" class="form-control"></textarea>
                    <span style="color: red; margin-top: 5px">{{ errors.content }}</span>
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
      id="viewContent"
      class="modal fade"
      tabindex="-1"
      role="dialog"
      aria-labelledby="myModalLabel"
      style="display: none"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-xl">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="myModalLabel">View Content</h5>
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
              <div class="row">
                <div class="col-12" v-html="view.content" style="word-wrap:break-word;">
                </div>
              </div>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- end modal view -->


    <div id="overlay"></div>
  </div>
</template>
<script>
import {createPostUrl,listPostUrl,seachPostUrl,apiDomain,getToken} from '../../../config';
export default {
  data(){
    return{
      post:[],
      errors:{},
      keyword:'',
      pagination:{},
      form:{
        title:'',
        image:'',
        content:''
      },
      title:'',
      image:'',
      content:'',
      view:{

      }
    }
  },
  methods:{
    previewImage(id){
        $('#image'+id).on('click', function() {
          $('#overlay')
          .css({backgroundImage: `url(${this.src})`})
          .addClass('open')
          .one('click', function() { $(this).removeClass('open'); });
        });
    },
    onFileChange(e){
      this.form.image = e.target.files[0];
    },
    viewContent(index){
      this.view = this.post[index];
    },
    getListPost(){
      axios.get(listPostUrl + getToken())
      .then(res => {
        if(res.data.data.last_page === 1){
          $("#last").addClass("disabled");
        }
        if(res.data.status === true){
          this.post = res.data.data.data;
          this.pagination = res.data.data;
        }
      })
      .catch(e => {

      })
    },
    createPost(){
      this.form.content = CKEDITOR.instances.ckeditor.getData();
      const config = {
        headers: { 'content-type': 'multipart/form-data' }
      }
      let formData = new FormData();
      formData.append('title',this.form.title);
      formData.append('image',this.form.image);
      formData.append('content',this.form.content);
      axios.post(createPostUrl + getToken(),formData,config)
      .then(res => {
        console.log(res.data)
        this.errors = {};
        if(res.data.status===true){
          this.form.title = '',
          this.form.image = '',
          this.form.content = '';
          $('#createPost').modal('hide');
          $("#createPost form")[0].reset();
          $('#output').removeAttr('src');
          CKEDITOR.instances.ckeditor.setData('');
          this.getListPost();
        }else{
          for(const [key,value] of Object.entries(res.data.errors)){
            this.errors[key] = value[0];
          }
        }
      })
      .catch(e => {

      })
    },
    editPost(id){
      let index = this.post.findIndex((item) => item.id === id);
      CKEDITOR.instances.ckeditorEdit.setData(this.post[index].content);
      this.form = this.post[index];
    },
    updatePost(id){
      const config = {
        headers: { 'content-type': 'multipart/form-data' }
      }
      let formData = new FormData();
      formData.append('title',this.form.title);
      formData.append('image',this.form.image);
      formData.append('content',CKEDITOR.instances.ckeditorEdit.getData());
      axios.post(apiDomain + 'post/update/' + id + '?token=' + getToken(),formData,config)
      .then(res => {
        if(res.data.status === true){
          this.form.form = {};
          this.getListPost();
          $('#editPost').modal('hide');
        }else{
          this.errors = {};
          for(const [key,value] of Object.entries(res.data.errors))
          {
            this.errors[key] = value[0];
          }
        }
      })
      .catch(e => {

      })
    },
    deletePost(id,index){
      if (confirm("Do you really want to delete?")){
        console.log(index)
        axios.delete(apiDomain + 'post/delete/' + id + '?token=' + getToken())
        .then(res => {
          if(res.data.status){
            this.post.splice(index,1);
            alert('Xóa thành công')
          }
        })
        .catch(e => {

        })
      }
    },
    seachPost(){
      if(this.keyword!==''){
        axios.get(seachPostUrl + getToken() + '&keyword=' + this.keyword)
        .then(res => {
          if(res.data.status === true)
          {
            this.post = [];
            for(let i = 0;i<res.data.data.length;i++)
            {
                this.post.push(res.data.data[i]);
            }
            this.pagination = {};
          }
        })
        .catch(e => {

        })
      }else{
        this.getListPost();
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
        axios.get(listPostUrl + getToken() + "&page=" + page)
        .then((res) => {
          this.post.id = null;
          this.post = res.data.data;
          this.pagination = res.data;
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
    this.getListPost();
  },
  mounted(){
    
  },
}
</script>

<style scope>
    #overlay{
      position: fixed;
      top:25%;
      left:35%;
      bottom: 25%;
      right: 25%;
      width:50%;
      height:50%;
      background: rgba(0,0,0,0.8) none 50% / contain no-repeat;
      cursor: pointer;
      transition: 0.3s;
      
      visibility: hidden;
      opacity: 0;
    }
    #overlay.open {
      visibility: visible;
      opacity: 1;
    }

    #overlay:after { /* X button icon */
      content: "\2715";
      position: absolute;
      color:#fff;
      top: 10px;
      right:20px;
      font-size: 2em;
    }
    img {
      max-width:1100px;
    }
    @media only screen and (max-width: 500px){
      img {
        max-width:498px;
      }
    }
</style>