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
                    <b>Image</b>
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
                      @keyup="seachImage()"
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
                        <th>Image</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(item,index) in image" :key="index">
                        <td>{{ item.id }}</td>
                        <td><a href="" @click.prevent="previewImage(item.id)"><img :id="'image' + item.id " :src="'/assets/image_product/' + item.image" height="100" width="100" ></a></td>
                        <td>
                          <button
                            @click.prevent="deleteImage(item.id,index)"
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
    <div id="overlay"></div>
</div>
</template>

<script>
import {listImageUrl,seachImageUrl,getToken, apiDomain} from '../../../config'
export default {
    data(){
        return{
            image:[],
            pagination:{},
            keyword:''
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
        getListImage(){
            axios.get(listImageUrl + getToken())
            .then(res => {
                if(res.data.status){
                    if(res.data.data.last_page === 1){
                        $("#last").addClass("disabled");
                    }
                    $("#last").removeClass("disabled");
                    this.image = res.data.data.data;
                    this.pagination = res.data.data;
                }
            })
            .catch(e => {

            })
        },
        deleteImage(id,index){
            if (confirm("Do you really want to delete?")){
                axios.delete(apiDomain + 'image/delete/' + id + '?token=' + getToken())
                .then(res => {
                    if(res.data.status){
                        this.image.splice(index,1);
                    }
                })
                .catch(e => {

                })
            }
        },
        seachImage(){
            if(this.keyword!==''){
                axios.get(seachImageUrl + getToken() + '&keyword=' + this.keyword)
                .then(res => {
                    if(res.data.status){
                        $("#last").addClass("disabled");
                        this.pagination = {};
                        this.image = res.data.data;
                    }
                })
                .catch(e => {

                })
            }else{
                this.getListImage();
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
            axios.get(listImageUrl + getToken() + "&page=" + page)
            .then((res) => {
            this.image.id = null;
            this.image = res.data.data.data;
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
        this.getListImage();
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