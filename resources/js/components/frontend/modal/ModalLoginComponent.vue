<template>
<div
    id="loginUser"
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
          <h5 class="modal-title" id="myModalLabel">Đăng nhập tài khoản</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-hidden="true"
          >
            ×
          </button>
        </div>
        <form @submit.prevent="loginUser()">
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                    <div class="alert alert-danger" v-if="wrong!==''">
                        {{ wrong }}
                    </div>
                </div>
                <div class="form-group">
                  <label for="name"
                    ><span style="color: red">*</span>Email</label
                  >
                  <input
                    type="text"
                    v-model="form.email"
                    class="form-control"
                  />
                  <span style="color: red; margin-top: 5px">{{
                    errors.email
                  }}</span>
                </div>
                <div class="form-group">
                  <label for="name"
                    ><span style="color: red">*</span>Password</label
                  >
                  <input
                    type="password"
                    v-model="form.password"
                    class="form-control"
                  />
                  <span style="color: red; margin-top: 5px">{{
                    errors.password
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
              Đóng
            </button>
            <button
              type="submit"
              class="btn btn-primary waves-effect waves-light"
            >
              Đăng nhập
            </button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal login -->
</template>

<script>
import { apiDomainUser } from "../../../config";
export default {
    data(){
        return{
            form:{
                email:'',
                password:''
            },
            errors:{},
            wrong:''
        }
    },
    methods:{
        loginUser(){
            axios.post(apiDomainUser + 'login',this.form)
            .then((res) => {
                this.wrong = '';
                this.errors = {}
                if(res.data.status===true){
                    localStorage.setItem('bearer_token',res.data.data);
                    window.location.href = '/';
                }else{
                    if(res.data.wrong!==null){
                        this.wrong = res.data.wrong;
                    }else{
                        for(const [key,value] of Object.entries(res.data.errors))
                        {
                            this.errors[key] = value[0];
                        }
                    }
                    
                }
            })
            .catch((e) => {
                
            })
        }
    },
    created(){

    },
    mounted() {
        
    },
}
</script>