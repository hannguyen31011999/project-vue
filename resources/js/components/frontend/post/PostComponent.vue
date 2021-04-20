<template>
    <div>
        <navbarHome></navbarHome>
        <section class="ftco-section bg-light">
    	<div class="container">
            <div class="row d-flex">
                <div class="col-md-3 d-flex" v-for="(item,index) in post" :key="index">
                    <div class="blog-entry align-self-stretch">
                        <a href="" @click.prevent="redirectDetailPost(item.url)" class="block-20" :style="{ 'background-image': 'url(' + '/assets/image_post/' + item.image + ')' }">
                        </a>
                        <div class="text mt-3 d-block">
                            <div class="meta mb-3">
                                <span>{{ compactDate(item.created_at) }} {{ item.fullname }}</span>
                            </div>
                            <h4 class="heading mt-3"><a href="" @click.prevent="redirectDetailPost(item.url)">{{ item.title }}</a></h4>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col text-center">
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
    </section>
    <footerHome></footerHome>
    <registerComponent></registerComponent>
    <loginComponent></loginComponent>
    </div>
</template>

<script>
import {apiDomainUser} from '../../../config';
export default {
    data(){
        return{
            post:[],
            pagination:{}
        }
    },
    methods:{
        getListPost(){
            axios.get(apiDomainUser + 'post/list')
            .then(res => {
                if(res.data.status){
                    if (res.data.data.last_page === 1) {
                        $("#last").addClass("disabled");
                    }
                    this.post = res.data.data.data;
                    this.pagination = res.data.data;
                    localStorage.setItem('paginationPost',res.data.data);
                }
            })
            .catch(e => {

            })
        },
        compactDate(time){
            let date = new Date();
            return date.getDay(time) + '-' + date.getMonth(time) + '-' + date.getFullYear(time);
        },
        redirectDetailPost(url){
            localStorage.setItem('urlDetailPost',url);
            window.location.href = '/bai-viet/' + url;
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
            axios.get(apiDomainUser + 'post/list' + "?page=" + page)
            .then((res) => {
            this.post = res.data.data.data;
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
    created(){
        if(localStorage.getItem('listPost')!==null){
            this.post = localStorage.getItem('listPost');
        }
        this.getListPost();
    },
    mounted(){
        
    },
}
</script>