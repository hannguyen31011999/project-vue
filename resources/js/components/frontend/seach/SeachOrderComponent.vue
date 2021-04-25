<template>
<div>
    <navbarHome></navbarHome>
    <!-- seach -->
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        Tìm kiếm hóa đơn
                    </div>
                    <div class="card-body">
                        <form @submit.prevent="seachOrder()">
                            <div class="row">
                                <div class="col-md-2"></div>
                                <div class="col-md-7">
                                    <div class="form-group">
                                        <input type="text" v-model="seach" class="form-control" placeholder="Nhập mã hóa đơn của quý khách">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive-md">
                                    <table class="table">
                                        <thead style="background-color:rgb(5, 86, 153);color:white;">
                                            <th>Loại tin</th>
                                            <th>Giá tiền</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Đường dẫn</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng tiền(10% VAT)</th>
                                        </thead>
                                        <tbody>
                                            <td v-if="product.status!==undefined">{{ type.name }}</td>
                                            <td v-if="product.status!==undefined">{{ convertCurrency(order.price) }}</td>
                                            <td v-if="product.status!==undefined">{{ convertDatetime(product.date_start) }}</td>
                                            <td v-if="product.status!==undefined">{{ convertDatetime(product.date_end) }}</td>
                                            <td><a :href="'../tin-rao-ban/' + slug.url">{{ slug.url }}</a></td>
                                            <td v-if="product.status!==undefined&&product.status === 1">Tin còn thời hạn</td>
                                            <td v-if="product.status!==undefined&&product.status === 0">Tin hết hạn</td>
                                            <td v-if="product.status===undefined"></td>
                                            <td v-if="order.price!==undefined">{{ convertCurrency(order.total_date * order.price) }}</td>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1"></div>
        </div>
    </div>
    <br><br>
    <!-- end seach -->
    <footerHome></footerHome>
    <registerComponent></registerComponent>
    <loginComponent></loginComponent>
</div>
</template>

<script>
import { apiDomainUser } from "../../../config";
export default {
    data(){
        return{
            product:{},
            type:{},
            slug:{},
            order:{},
            seach:''
        }
    },
    methods:{
        seachOrder(){
            if(this.seach!==''){
                axios.get(apiDomainUser + 'seach/order/' + this.seach)
                .then(res => {
                    if(res.data.status){
                        this.product = res.data.data.product;
                        this.type = res.data.data.type;
                        this.slug = res.data.data.slug;
                        this.order = res.data.data.order;
                    }else{
                        this.product = {};
                        this.type = {};
                        this.slug = {};
                        this.order = {};
                        this.seach = '';
                        alert('Không tìm thấy tin đăng của quý khách');
                    }
                })
                .catch(e => {

                })
            }
        },
        convertDatetime(time){
            let date = new Date(time);
            return date.getDate() + '-' + parseInt(date.getMonth() + 1) + '-' + date.getFullYear();
        },
        convertCurrency(money){
            return money.toLocaleString('it-IT', {style : 'currency', currency : 'VND'});
        }
    },
    created(){
    },
    mounted() {
        
    },
}
</script>