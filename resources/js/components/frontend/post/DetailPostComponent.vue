<template>
<div>
    <navbarHome></navbarHome>
    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
            <div class="content" v-html="post.content"></div>
            <div style="float:right;"><p style="font-weight:bold;">{{ post.fullname }}</p></div>
            <div class="tag-widget post-tag-container mb-5 mt-5">
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">Life</a>
                <a href="#" class="tag-cloud-link">Sport</a>
                <a href="#" class="tag-cloud-link">Tech</a>
                <a href="#" class="tag-cloud-link">Travel</a>
              </div>
            </div>
            
            <div class="about-author d-flex p-4 bg-light">
              <div class="bio align-self-md-center mr-4">
                <img src="/frontend/images/person_1.jpg" alt="Image placeholder" class="img-fluid mb-4">
              </div>
              <div class="desc align-self-md-center">
                <h3>Nguyễn Việt Hân</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ducimus itaque, autem necessitatibus voluptate quod mollitia delectus aut, sunt placeat nam vero culpa sapiente consectetur similique, inventore eos fugit cupiditate numquam!</p>
              </div>
            </div>

          </div> 
          <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box">
              <form action="#" class="search-form">
                <div class="form-group">
                  <span class="icon fa fa-search"></span>
                  <input type="text" class="form-control" placeholder="Tìm kiếm bài viết">
                </div>
              </form>
            </div>
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <img src="/assets/image_post/bds_cuchi.jpg" alt="" height="295" width="300" style="margin-bottom:5px">
                <img src="/assets/image_post/jamja-gdn-banner-300x250.jpg" alt="" height="300" width="300">
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Bài viết liên quan</h3>
              <div class="block-21 mb-4 d-flex" v-for="(item,index) in postRelation" :key="index">
                <a class="blog-img mr-4" :style="{ 'background-image': 'url(' + '/assets/image_post/' + item.image + ')' }"></a>
                <div class="text">
                  <h3 class="heading"><a href="#">{{ item.title }}</a></h3>
                  <div class="meta">
                    <div><span class="icon-calendar"></span> {{ convertDate(item.created_at) }} ngày trước</div>
                  </div>
                </div>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <h3>Thẻ</h3>
              <div class="tagcloud">
                <a href="#" class="tag-cloud-link">dish</a>
                <a href="#" class="tag-cloud-link">menu</a>
                <a href="#" class="tag-cloud-link">food</a>
                <a href="#" class="tag-cloud-link">sweet</a>
                <a href="#" class="tag-cloud-link">tasty</a>
                <a href="#" class="tag-cloud-link">delicious</a>
                <a href="#" class="tag-cloud-link">desserts</a>
                <a href="#" class="tag-cloud-link">drinks</a>
              </div>
            </div>

            <div class="sidebar-box ftco-animate">
              <img src="/assets/image_post/quangcao.jpg" alt="">
              <img src="/assets/image_post/sunbay.gif" alt="">
            </div>
          </div>

        </div>
    </div>
    </section> <!-- .section -->
    <footerHome></footerHome>
    <registerComponent></registerComponent>
    <loginComponent></loginComponent>
</div>
</template>

<script>
import {apiDomainUser} from '../../../config';
export default {
  data(){
    return {
      post:{},
      postRelation:[],
      url:localStorage.getItem('urlDetailPost'),
    }
  },
  methods:{
    getDetailPost(){
      axios.get(apiDomainUser + 'post/detail/' + this.url)
      .then(res => {
        if(res.data.status){
          this.post = res.data.data.post;
          this.postRelation = res.data.data.relate;
          localStorage.setItem('detailPost',res.data.data.post);
          localStorage.setItem('relatePost',res.data.data.relate);
        }
      })
      .catch(e => {

      })
    },
    convertDate(date){
      let timePresent = new Date();
      let dateParams = new Date(date);
      return (timePresent.getDay() - dateParams.getDay()==0) ? 1 :timePresent.getDay() - dateParams.getDay();
    },
  },
  created(){
    if(localStorage.getItem('detailPost') !==null && localStorage.getItem('relatePost') !==null){
      this.post = localStorage.getItem('detailPost');
      this.postRelation = localStorage.getItem('relatePost');
    }
    this.getDetailPost();
  }
}
</script>

<style scoped>
</style>