<template>
  <div>
    <div class="top">
      <div class="container">
        <div class="row d-flex align-items-center">
          <div class="col">
            <p class="social d-flex">
              <a href="#"><span class="icon-facebook"></span></a>
              <a href="#"><span class="icon-twitter"></span></a>
              <a href="#"><span class="icon-google"></span></a>
              <a href="#"><span class="icon-pinterest"></span></a>
            </p>
          </div>
          <div class="col d-flex justify-content-end">
            <p class="num"><span class="icon-phone"></span> + 0382 484 093</p>
          </div>
        </div>
      </div>
    </div>
    <nav
      class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light"
      id="ftco-navbar"
    >
      <div class="container">
        <a class="navbar-brand" href="/">Bất Động Sản<span> Quận 9</span></a>
        <button
          class="navbar-toggler"
          type="button"
          data-toggle="collapse"
          data-target="#ftco-nav"
          aria-controls="ftco-nav"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a href="/" class="nav-link">Trang chủ</a>
            </li>
            <li class="nav-item dropdown">
              <a
                class="nav-link dropdown-toggle"
                data-toggle="dropdown"
                href="#"
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
                >Loại nhà đất</a
              >
              <div class="dropdown-menu"  style="font-size: 13px" >
                <a class="dropdown-item" v-for="(item,index) in categories"
                :key="index" href="" @click.prevent="redirectListProduct(item.url)" >{{item.categories_name}}</a>
              </div>
            </li>
            <li class="nav-item"><a href="/bai-viet" class="nav-link">Tin tức</a></li>
            <li class="nav-item"><a href="#" class="nav-link">Liên hệ</a></li>
            <li class="nav-item dropdown">
              <a 
                href="#" 
                class="nav-link dropdown-toggle" 
                data-toggle="dropdown" 
                role="button"
                aria-haspopup="true"
                aria-expanded="false"
                v-if="user.email!==undefined">
                <span class="icon-user"></span> {{ user.email }}
              </a>
              <div class="dropdown-menu"  style="font-size: 13px" >
                <a class="dropdown-item" href="#" >Trang cá nhân</a>
                <a class="dropdown-item" href="#" @click.prevent="logoutUser()">Thoát</a>
              </div>
            </li>
            <li class="nav-item" v-if="user.email===undefined">
              <a href="#" class="nav-link " data-toggle="modal" data-target="#loginUser" >
                <span class="icon-user"></span> Đăng nhập
              </a>
            </li>
            <li class="nav-item" v-if="user.email===undefined">
              <a href="#" class="nav-link" data-toggle="modal" data-target="#register" >
                <span class="icon-pencil"></span> Đăng kí
              </a>
            </li>
            <li class="nav-item cta cta-colored">
              <a href="/dang-tin-rao-ban" class="nav-link">Đăng tin</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- END nav -->
  </div>
</template>

<script>
import {apiDomainUser,getTokenUser} from '../../config';
export default {
  data(){
    return{
      categories:[
      ],
      user:{
      },
    }
  },
  methods:{
    getListCategories(){
      axios.get(apiDomainUser + 'home/categories/list')
      .then((res) => {
        this.categories = res.data.data;
      })
      .catch((e) => {

      })
    },
    redirectListProduct(url){
      localStorage.setItem('listProductUrl',url);
      window.location.href = "/" + url;
    },
    getUser(token){
      axios.get(apiDomainUser + 'user?token='+token)
      .then((res) => {
        if(res.data.status){
          this.user = res.data.data;
        }
      })
      .catch((e) => {

      })
    },
    logoutUser(){
      axios.get(apiDomainUser + 'logout?token=' + getTokenUser())
      .then((res) => {
        if(res.data.status===true)
        {
          localStorage.removeItem('bearer_token');
          window.location.href = '/';
        }
      })
      .catch((e) => {
        if(e.status===500){
          alert('Đăng xuất thất bại')
        }
      })
    }
  },
  created(){
    this.getListCategories();
    if(getTokenUser()!==null){
      this.getUser(getTokenUser());
    }
  },
  mounted() {
    
  },
};
</script>