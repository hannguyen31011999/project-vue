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
                        <div class="row">
                            <div class="col-md-2"></div>
                            <div class="col-md-7">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Nhập mã hóa đơn của quý khách">
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-success">Tìm kiếm</button>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive-md">
                                    <table class="table">
                                        <thead style="background-color:rgb(5, 86, 153);color:white;">
                                            <th>Mã hóa đơn</th>
                                            <th>Loại tin</th>
                                            <th>Giá tiền</th>
                                            <th>Ngày bắt đầu</th>
                                            <th>Ngày kết thúc</th>
                                            <th>Đường dẫn</th>
                                            <th>Trạng thái</th>
                                            <th>Tổng tiền(10% VAT)</th>
                                        </thead>
                                        <tbody>
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
export default {
    
}
</script>