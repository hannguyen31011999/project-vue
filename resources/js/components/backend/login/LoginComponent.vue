<template>
  <div class="account-pages my-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card mt-4">
            <div class="card-header p-4 bg-primary">
              <h4 class="text-white text-center mb-0 mt-0">Đăng nhập</h4>
            </div>
            <div class="card-body">
              <form @submit.prevent="login()" method="POST" class="p-2">
                <div class="form-group mb-3">
                  <div v-if="errors.length > 0">
                    <div v-for="err in errors" :key="err.message" class="alert alert-danger">
                      {{ err.message }}
                    </div>
                  </div>
                </div>
                <div class="form-group mb-3">
                  <label for="emailaddress">Email Address :</label>
                  <input
                    v-model="form.email"
                    class="form-control"
                    type="email"
                    id="emailaddress"
                    name="email"
                    placeholder="Nhập email"
                  />
                </div>

                <div class="form-group mb-3">
                  <label for="password">Password :</label>
                  <input
                    v-model="form.password"
                    class="form-control"
                    type="password"
                    id="password"
                    name="password"
                    placeholder="Nhập mật khẩu"
                  />
                </div>

                <div class="form-group mb-4">
                  <div class="checkbox checkbox-success">
                    <input id="remember" v-model="form.remember_token" name="remember" type="checkbox" />
                    <label for="remember"> Ghi nhớ mật khẩu </label>
                    <a href="" class="text-muted float-right">Quên mật khẩu?</a>
                  </div>
                </div>

                <div class="form-group row text-center mt-4 mb-4">
                  <div class="col-12">
                    <button
                      class="btn btn-md btn-block btn-primary waves-effect waves-light"
                      type="submit"
                    >
                      Đăng nhập
                    </button>
                  </div>
                </div>
              </form>
            </div>
            <!-- end card-body -->
          </div>
          <!-- end card -->

          <!-- end row -->
        </div>
        <!-- end col -->
      </div>
      <!-- end row -->
    </div>
  </div>
</template>

<script>
import VueCookies from 'vue-cookies';
import {loginUrl} from '../../../config';
export default {
    data(){
        return{
            form:{
                email:'',
                password:'',
                remember_token:''
            },
            errors:[]
        }
    },
    methods:{
        login(){
          this.errors = [];
          axios.post(loginUrl,this.form)
          .then(res =>{
            if(res.data.status===true){
              VueCookies.set('_token' , res.data.token , "60min");
              window.location.href = '/admin/dashboard';
            }
            // localStorage.setItem('access_token',res.data.token);
            // axios.defaults.headers.common['Authorization'] = res.data.token
          })
          .catch(e => {
            this.errors.push();
          })
        }
    }
};
</script>