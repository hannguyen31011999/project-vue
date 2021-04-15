<template>
  <!-- modal register -->
  <div
    id="register"
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
          <h5 class="modal-title" id="myModalLabel">Đăng kí tài khoản</h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-hidden="true"
          >
            ×
          </button>
        </div>
        <form @submit.prevent="submitRegister()">
          <div class="modal-body">
            <div class="row">
              <div class="col-12">
                <div class="form-group">
                  <label for="name"
                    ><span style="color: red">*</span>Họ và tên</label
                  >
                  <input
                    type="text"
                    v-model="form.fullname"
                    class="form-control"
                  />
                  <span style="color: red; margin-top: 5px">{{
                    errors.fullname
                  }}</span>
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
                  <span style="color: red; margin-top: 5px"></span>
                </div>
                <div class="form-group">
                  <label for="name">*Ngày sinh</label>
                  <input
                    type="date"
                    v-model="form.birth_date"
                    class="form-control"
                  />
                  <span style="color: red; margin-top: 5px"> </span>
                </div>
                <div class="form-group">
                  <label for="name">*Giới tính</label>
                  <select
                    name=""
                    v-model="form.gender"
                    id=""
                    class="form-control"
                  >
                    <option value="-1">Giới tính</option>
                    <option value="0">Nam</option>
                    <option value="1">Nữ</option>
                  </select>
                  <span style="color: red; margin-top: 5px"> </span>
                </div>
                <div class="form-group">
                  <label for="name">*Địa chỉ</label>
                  <input
                    type="text"
                    v-model="form.address"
                    class="form-control"
                  />
                  <span style="color: red; margin-top: 5px"> </span>
                </div>
                <div class="form-group">
                  <label for="name"
                    ><span style="color: red">*</span>Chứng minh nhân dân</label
                  >
                  <input type="text" v-model="form.cmnd" class="form-control" />
                  <span style="color: red; margin-top: 5px">{{
                    errors.cmnd
                  }}</span>
                </div>
                <div class="form-group">
                  <label for="name"
                    ><span style="color: red">*</span>Số điện thoại</label
                  >
                  <input
                    type="text"
                    v-model="form.phone"
                    class="form-control"
                  />
                  <span style="color: red; margin-top: 5px">{{
                    errors.phone
                  }}</span>
                </div>
                <div class="form-group">
                  <label for="name" style="font-size: 15px"
                    >Lưu ý: <span style="color: red">*</span> là thông tin bắt
                    buộc</label
                  >
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
              Đăng kí
            </button>
          </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.modal register -->
</template>

<script>
import { apiDomainUser } from "../../../config";
export default {
  data() {
    return {
      form: {
        fullname: "",
        email: "",
        password: "",
        birth_date: "",
        gender: "",
        address: "",
        cmnd: "",
        phone: "",
      },
      errors: {},
      user: {},
    };
  },
  methods: {
    submitRegister() {
      axios
        .post(apiDomainUser + "register", this.form)
        .then((res) => {
          this.errors = {};
          if (res.data.status === true) {
            this.form = {
              fullname: "",
              email: "",
              password: "",
              birth_date: "",
              gender: "",
              address: "",
              cmnd: "",
              phone: "",
            };
            alert("Đăng kí tài khoản thành công");
          } else {
            for (const [key, value] of Object.entries(res.data.errors)) {
              this.errors[key] = value[0];
            }
          }
        })
        .catch((e) => {});
    },
  },
  created() {},
  mounted() {},
};
</script>