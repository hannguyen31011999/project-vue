<template>
  <div>
    <navbarHome></navbarHome>
    <section class="ftco-section ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-lg-8 ftco-animate">
            <div class="text-center"><h1 style="font-size:22px;color:#069;"><i class="icon-edit"></i>ĐĂNG TIN RAO BÁN,CHO THUÊ NHÀ ĐẤT</h1></div>
            <form @submit.prevent="createOrder()">
            <!-- card info -->
            <div class="card">
                <div class="card-header" style="background: #055699;color: white;font-size:16px;">THÔNG TIN CƠ BẢN</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="title"><span style="color:red;">*</span>Tiêu đề</label>
                                <input type="text" v-model="form.title" class="form-control">
                                <span style="color: red; margin-top: 5px">{{ errors.title }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="title"><span style="color:red;">*</span>Loại</label>
                                <select name="" id="" class="form-control" v-model="form.categories_id">
                                    <option value="" selected>Chọn</option>
                                    <option v-for="(item,index) in categories" :key="index" :value="item.id">{{ item.categories_name }}</option>
                                </select>
                                <span style="color: red; margin-top: 5px">{{ errors.categories_id }}</span>
                            </div>
                            <div class="form-group">
                                <label for="title"><span style="color:red;">*</span>Quận/huyện</label>
                                <select name="" id="" class="form-control" v-model="form.district_id" @change="onchangeDistrict()">
                                    <option value="">--Quận/huyện--</option>
                                    <option v-for="(item,index) in district" :key="index" :value="item.id">{{ item.district_name }}</option>
                                </select>
                                <span style="color: red; margin-top: 5px">{{ errors.district_id }}</span>
                            </div>
                            <div class="form-group">
                                <label for="title"><span style="color:red;">*</span>Đường/phố</label>
                                <input type="text" class="form-control" @change="onchangeStreet()" v-model="form.street" placeholder="Nhập đường/phố">
                            </div>
                            <div class="form-group">
                                <label for="title"><span style="color:red;">*</span>Giá</label>
                                <input type="number" v-model="form.price" @change="onchangePrice()" class="form-control" placeholder="Nhập giá tiền triệu/m2">
                                <span style="color: red; margin-top: 5px">{{ errors.price }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="province"><span style="color:red;">*</span>Tỉnh/TP</label>
                                <select name="" id="" class="form-control" v-model="form.province_id" @change="onchangeProvince()">
                                    <option value="">--Tỉnh/tp--</option>
                                    <option v-for="(item,index) in province" :key="index" :value="item.id">{{ item.province_name }}</option>
                                </select>
                                <span style="color: red; margin-top: 5px">{{ errors.province_id }}</span>
                            </div>
                            <div class="form-group">
                                <label for="province"><span style="color:red;">*</span>Phường/xã</label>
                                <select name="" id="" class="form-control" @change="onchangeWard()" v-model="form.ward_id">
                                    <option value="">--Phường/xã--</option>
                                    <option v-for="(item,index) in ward" :key="index" :value="item.id">{{ item.ward_name }}</option>
                                </select>
                                <span style="color: red; margin-top: 5px">{{ errors.ward_id }}</span>
                            </div>
                            <div class="form-group">
                                <label for="title"><span style="color:red;">*</span>Diện tích</label>
                                <input type="number" @change="onchangeArea()" v-model="form.area" class="form-control" placeholder="Nhập diện tích">
                                <span style="color: red; margin-top: 5px">{{ errors.area }}</span>
                            </div>
                            <div class="form-group">
                                <label for="province"><span style="color:red;">*</span>Hình thức</label>
                                <select name="" id="" class="form-control" v-model="hinhThucBan">
                                    <option value="">--Hình thức--</option>
                                    <option value="1">Nhà đất bán</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <span>Tổng giá tiền:</span><span style="color:red;">&nbsp;{{ totalPrice.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) }}</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="address"><span style="color:red;">*</span>Địa chỉ</label>
                                <input type="text" class="form-control" v-model="form.address">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card info -->
            <br>
            <!-- card desc -->
            <div class="card">
                <div class="card-header" style="background: #055699;color: white;font-size:16px;">THÔNG TIN CƠ BẢN</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for=""><span style="color:red;">*</span>Tổi đa chỉ 3000 ký tự</label>
                                <textarea @keyup="keyupDesc()" v-model="form.desc" name="" id="" cols="10" rows="5" class="form-control"></textarea>
                                <span style="color: red; margin-top: 5px">{{ errors.desc }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <span style="color:red;font-size:13px;">{{ countChar }}</span><br>
                            <span style="font-size:13px;word-break:all;"><i class="icon-caret-right"></i> Giới thiệu chung về bất động sản của bạn. Ví dụ: Khu nhà có vị trí thuận lợi: Gần công viên, gần trường học ... Tổng diện tích 52m2, đường đi ô tô vào tận cửa.
                            <br><span style="color:red;">Lưu ý: tin rao chỉ để mệnh giá tiền Việt Nam Đồng.</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card desc -->
            <br>
            <!-- card variant -->
            <div class="card">
                <div class="card-header" style="background: #055699;color: white;font-size:16px;">THÔNG TIN KHÁC</div>
                <div class="card-body">
                    <span style="font-size:12px;">Quý vị nên điền đầy đủ thông tin vào các mục dưới đây để tin đăng có hiệu quả hơn</span>
                    <br><br>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Mặt tiền</label>
                                <input type="number" class="form-control" v-model="form.facade">
                            </div>
                            <div class="form-group">
                                <label for="">Hướng nhà</label>
                                <select name="" id="" class="form-control" v-model="form.direction">
                                    <option value="">--Chọn hướng--</option>
                                    <option value="">Đông</option>
                                    <option value="">Tây</option>
                                    <option value="">Nam</option>
                                    <option value="">Bắc</option>
                                    <option value="">Đông-Bắc</option>
                                    <option value="">Tây-Bắc</option>
                                    <option value="">Đông-Nam</option>
                                    <option value="">Tây-Nam</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Số tầng</label>
                                <input type="number" class="form-control" v-model="form.num_floor">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Đường vào</label>
                                <input type="number" class="form-control" v-model="form.access_road">
                            </div>
                            <div class="form-group">
                                <label for="">Hướng ban công</label>
                                <select name="" id="" class="form-control">
                                    <option value="">--Chọn hướng--</option>
                                    <option value="">Đông</option>
                                    <option value="">Tây</option>
                                    <option value="">Nam</option>
                                    <option value="">Bắc</option>
                                    <option value="">Đông-Bắc</option>
                                    <option value="">Tây-Bắc</option>
                                    <option value="">Đông-Nam</option>
                                    <option value="">Tây-Nam</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Số phòng ngủ</label>
                                <input type="number" class="form-control" v-model="form.num_bedroom">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Nội thất</label>
                                <textarea name="" id="" cols="30" rows="5" class="form-control" v-model="form.furniture"></textarea>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="">Thông tin pháp lý</label>
                                <textarea name="" id="" cols="30" rows="2" class="form-control" v-model="form.juridical" placeholder="Ví dụ: Đã có sổ đỏ. Đã có sổ hồng. Đã được phê duyệt quyết định đầu tư..."></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card desc -->
            <br>
            <!-- card image -->
            <div class="card">
                <div class="card-header" style="background: #055699;color: white;font-size:16px;">HÌNH ẢNH</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="custom-file">
                                <input type="file" name="image[]" v-on:change="onFileChange" class="custom-file-input" id="customFile" multiple>
                                <label class="custom-file-label" for="customFile">Chọn ảnh</label>
                            </div>
                            <span style="color: red; margin-top: 5px">{{ errors.image }}</span>
                            <span style="color: red; margin-top: 5px">{{ limitImage }}</span>
                            <div class="card cardResult" id="cardResult"  style="margin-top: 5px;display: none;">
                                <div class="card-body">
                                    <div id="result">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card image -->
            <br>
            <!-- card contact -->
            <div class="card">
                <div class="card-header" style="background: #055699;color: white;font-size:16px;">LIÊN HỆ</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><span style="color:red;">*</span>Tên liên hệ</label>
                                <input type="text" class="form-control" v-model="form.fullname">
                                <span style="color: red; margin-top: 5px">{{ errors.fullname }}</span>
                            </div>
                            <div class="form-group">
                                <label for=""><span style="color:red;">*</span>Địa chỉ</label>
                                <input type="text" class="form-control" v-model="form.address_guest">
                                <span style="color: red; margin-top: 5px">{{ errors.address_guest }}</span>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for=""><span style="color:red;">*</span>Điện thoại</label>
                                <input type="number" class="form-control" v-model="form.phone">
                                <span style="color: red; margin-top: 5px">{{ errors.phone }}</span>
                            </div>
                            <div class="form-group">
                                <label for=""><span style="color:red;">*</span>Email</label>
                                <input type="text" class="form-control" v-model="form.email">
                                <span style="color: red; margin-top: 5px">{{ errors.email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card contact -->
            <br>
            <!-- card time -->
            <div class="card">
                <div class="card-header" style="background: #055699;color: white;font-size:16px;">LỊCH ĐĂNG TIN</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Loại tin rao</label>
                                <select name="" id="" class="form-control" v-model="form.type_id" @change="onchangeType()">
                                    <option value="">Loại tin</option>
                                    <option v-for="(item,index) in type" :key="index" :value="item.id">{{ item.name }}</option>
                                </select>
                                <span style="color: red; margin-top: 5px">{{ errors.type_id }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ngày bắt đầu</label>
                                <input type="date" class="form-control" @change="onchangeDate()" v-model="form.date_start">
                                <span style="color: red; margin-top: 5px">{{ errors.date_start }}</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="">Ngày kết thúc</label>
                                <input type="date" class="form-control" @change="onchangeDate()" v-model="form.date_end">
                                <span style="color: red; margin-top: 5px">{{ errors.date_end }}</span>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <span style="font-size:14px;">Tin thường: Là loại tin đăng bằng chữ <span style="color:#009AD2;">màu xanh</span>, khung <span style="color:#009AD2;">màu xanh</span></span>
                            <br><span>Đơn giá cuối cùng: <span style="color:#069;font-size:20px;">2.722 đồng/Ngày</span></span>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card time -->
            <br>
            <!-- card total price -->
            <div class="card">
                <div class="card-header" style="background: #055699;color: white;font-size:16px;">THÀNH TIỀN</div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table class="table">
                                <tr>
                                    <th style="background-color:#390;color:white;">Phí đăng tin</th>
                                    <th style="background-color:#390;color:white;">VAT(10%)</th>
                                    <th style="border:0;"></th>
                                    <th style="background-color:#f60;color:white;">Thành tiền</th>
                                </tr>
                                <tr>
                                    <th style="color:#390;">{{ totalTypePrice.toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) }}</th>
                                    <th style="color:#390;">{{ (totalTypePrice/100*10).toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) }}</th>
                                    <th style="border:0;"></th>
                                    <th style="color:#f60;">{{ (totalTypePrice + (totalTypePrice/100*10)).toLocaleString('it-IT', {style : 'currency', currency : 'VND'}) }}</th>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <button type="submit" id="submit-checkout" class="btn btn-success">Xác nhận đăng tin</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- card total price -->
            </form>
          </div>
          <!-- .col-md-8 -->
          <div class="col-lg-4 sidebar ftco-animate">
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <img src="/assets/image_post/bds_cuchi.jpg" alt="" height="295" width="300" style="margin-bottom:5px">
                <img src="/assets/image_post/jamja-gdn-banner-300x250.jpg" alt="" height="300" width="300">
              </div>
            </div>
            <div class="sidebar-box ftco-animate">
              <div class="categories">
                <img src="/assets/image_post/bds_cuchi.jpg" alt="" height="295" width="300" style="margin-bottom:5px">
                <img src="/assets/image_post/jamja-gdn-banner-300x250.jpg" alt="" height="300" width="300">
              </div>
            </div>
            <div class="sidebar-box ftco-animate">
              <img src="/assets/image_post/quangcao.jpg" alt="">
              <img src="/assets/image_post/sunbay.gif" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- .section -->
    <footerHome></footerHome>
    <registerComponent></registerComponent>
    <loginComponent></loginComponent>
    {{ loader }}
  </div>
</template>

<script>
import {apiDomainUser,getTokenUser} from '../../../config';
export default {
    data(){
        return{
            type:[],
            province:[],
            categories:[],
            district:[],
            ward:[],
            user:{
                'fullname':'',
                'email':'',
                'phone':'',
                'address':''
            },
            form:{
                type_id:'',
                categories_id:'',
                province_id:'',
                district_id:'',
                ward_id:'',
                title:'',
                area:null,
                price:null,
                address:'',
                date_start:'',
                date_end:'',
                desc:'',
                facade:'',
                access_road:'',
                direction:'',
                num_floor:'',
                num_bedroom:'',
                furniture:'',
                juridical:'',
                user_id:'',
                fullname:'',
                address_guest:'',
                phone:'',
                email:'',
                image:[],
                street:'',
            },
            hinhThucBan:'',
            totalPrice:0,
            countChar:3000,
            totalTypePrice:0,
            limitImage:'',
            errors:{},
            loader:'',
            message:''
        }
    },
    methods:{
        getList(){
            axios.get(apiDomainUser + 'product')
            .then(res => {
                if(res.data.status){
                    this.province = res.data.data.province;
                    this.type = res.data.data.type;
                    this.categories =res.data.data.categories;
                }
            })
            .catch(e => {

            })
        },
        onchangeProvince(){
            this.district = [];
            let index = this.province.findIndex((item) => item.id === this.form.province_id);
            this.district = this.province[index].districts;
        },
        onchangeDistrict(){
            this.ward = [];
            let index = this.province.findIndex((item) => this.form.province_id === item.id);
            this.province[index].wards.map((item,index) => {
                if(item.district_id===this.form.district_id){
                    this.ward.push(item);
                }
            })
        },
        onchangeWard(){
            if(this.form.ward_id!=='0'){
                let province = this.province.filter((item) => item.id === this.form.province_id)[0].province_name;
                let district = this.district.filter((item) => item.id === this.form.district_id)[0].district_name;
                let ward = this.ward.filter((item) => item.id === this.form.ward_id)[0].ward_name;
                this.form.address = this.form.street + ', ' + ward + ', ' + district + ', ' + province;
            }
        },
        onchangeStreet(){
            let province = this.province.filter((item) => item.id === this.form.province_id)[0].province_name;
            let district = this.district.filter((item) => item.id === this.form.district_id)[0].district_name;
            let ward = this.ward.filter((item) => item.id === this.form.ward_id)[0].ward_name;
            if(this.form.street !==''&&this.form.district_id!=='0'&&this.form.province_id!=='0'&&this.form.ward_id!=='0'){
                this.form.address = this.form.street + this.form.address;
            }else if(this.form.street === ''){
                this.form.address = ', ' + ward + ', ' + district + ', ' + province;
            }
        },
        onchangeArea(){
            if(this.form.area !==0 && this.form.price !==0){
                this.totalPrice = this.form.area * this.form.price * 1000 * 1000;
            }
        },
        onchangePrice(){
            if(this.form.area !==0 && this.form.price !==0){
                this.totalPrice = this.form.area * this.form.price * 1000 * 1000;
            }
        },
        keyupDesc(){
            if(this.form.desc!==''){
                this.countChar--;
            }else if(this.form.desc===''){
                this.countChar = 3000;
            }
        },
        onchangeType(){
            if(this.form.type_id==='0'){
                this.totalTypePrice = 0;
            }else{
                axios.get(apiDomainUser + 'product/range?date_start=' + this.form.date_start + '&date_end=' + this.form.date_end + '&type_id=' + this.form.type_id)
                .then(res => {
                    if(res.data.status){
                        this.totalTypePrice = res.data.data;
                    }
                })
                .catch(e => {

                })
            }
        },
        onchangeDate(){
            axios.get(apiDomainUser + 'product/range?date_start=' + this.form.date_start + '&date_end=' + this.form.date_end + '&type_id=' + this.form.type_id)
            .then(res => {
                if(res.data.status){
                    this.totalTypePrice = res.data.data;
                }else{
                    alert('Ngày bắt đầu phải nhỏ hơn ngày kết thúc');
                }
            })
            .catch(e => {

            })
        },
        onFileChange(e){
            this.form.image.push(e.target.files[0]);
        },
        createOrder(){
            $('#submit-checkout').attr('disable','disable');
            const config = {
                headers: { 'content-type': 'multipart/form-data' }
            }
            let formData = new FormData();
            formData.append('type_id',this.form.type_id);
            formData.append('categories_id',this.form.categories_id);
            formData.append('province_id',this.form.province_id);
            formData.append('district_id',this.form.district_id);
            formData.append('ward_id',this.form.ward_id);
            formData.append('title',this.form.title);
            formData.append('area',this.form.area);
            formData.append('price',this.form.price);
            formData.append('address',this.form.address);
            formData.append('desc',this.form.desc);
            formData.append('date_start',this.form.date_start);
            formData.append('date_end',this.form.date_end);
            formData.append('facade',this.form.facade);
            formData.append('access_road',this.form.access_road);
            formData.append('direction',this.form.direction);
            formData.append('num_floor',this.form.num_floor);
            formData.append('num_bedroom',this.form.num_bedroom);
            formData.append('furniture',this.form.furniture);
            formData.append('juridical',this.form.juridical);
            formData.append('user_id',this.form.user_id);
            formData.append('fullname',this.form.fullname);
            formData.append('address',this.form.address);
            formData.append('address_guest',this.form.address_guest);
            formData.append('phone',this.form.phone);
            formData.append('email',this.form.email);
            for (let i = 0; i < this.form.image.length; i++) {
                formData.append('image[' + i + ']', this.form.image[i]);
            }
            axios.post(apiDomainUser + 'checkout/create',formData,config)
            .then(res => {
                this.errors = {};
                if(res.data.status){
                    localStorage.setItem('checkout_success','Quý khách vui lòng kiểm tra mail để kiểm tra thanh toán');
                    window.location.href = res.data.data;
                }else{
                    $('#submit-checkout').removeAttr('disable');
                    if(res.data.limit!==null){
                        this.limitImage = res.data.limit
                    }else{
                        for(const [key,value] of Object.entries(res.data.errors)){
                            this.errors[key] = value[0];
                        }
                    }
                }
            })
            .catch(e => {

            })
        },
        getUser(token){
        axios.get(apiDomainUser + 'user?token='+token)
        .then((res) => {
            if(res.data.status){
                this.form.fullname = res.data.data.fullname;
                this.form.address_guest = res.data.data.address;
                this.form.phone = res.data.data.phone;
                this.form.email = res.data.data.email;
                this.form.user_id = res.data.data.id;
            }
        })
        .catch((e) => {

        })
        },
    },
    created(){
        this.getList();
        if(localStorage.getItem('checkout_success')!==null){
            alert(localStorage.getItem('checkout_success'));
            localStorage.removeItem('checkout_success');
            window.location.href = '/dang-tin-rao-ban';
        }
        if(getTokenUser()!==null){
            this.getUser(getTokenUser());
        }
    },
    mounted(){

    },
};
</script>