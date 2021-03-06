export const apiDomain = 'http://localhost:8000/api/admin/';
export const apiDomainUser = 'http://localhost:8000/api/';
export const loginUrl = apiDomain + 'login';
export const getUserUrl = apiDomain + 'user?token=';
export const logoutUrl = apiDomain + 'logout?token=';
// ADMIN
// categories
export const createCategoriesUrl = apiDomain + 'categories/create?token=';
export const listCategoriesUrl = apiDomain + 'categories/list?token=';
export const seachCategoriesUrl = apiDomain + 'categories/seach?token=';
// type
export const createTypeUrl = apiDomain + 'type/create?token=';
export const listTypeUrl = apiDomain + 'type/list?token=';
export const seachTypeUrl = apiDomain + 'type/seach?token=';
// user
export const listUserUrl = apiDomain + 'user/list?token=';
export const seachUserUrl = apiDomain + 'user/seach?token=';
// province
export const createProvinceUrl = apiDomain + 'province/create?token=';
export const listProvinceUrl = apiDomain + 'province/list?token=';
export const seachProvinceUrl = apiDomain + 'province/seach?token=';
// district
export const createDistrictUrl = apiDomain + 'district/create?token=';
export const listDistrictUrl = apiDomain + 'district/list?token=';
export const seachDistrictUrl = apiDomain + 'district/seach?token=';
// ward
export const createWardUrl = apiDomain + 'ward/create?token=';
export const listWardUrl = apiDomain + 'ward/list?token=';
export const seachWardUrl = apiDomain + 'ward/seach?token=';
// post
export const createPostUrl = apiDomain + 'post/create?token=';
export const listPostUrl = apiDomain + 'post/list?token=';
export const seachPostUrl = apiDomain + 'post/seach?token=';
// product
export const listProductUrl = apiDomain + 'product/list?token=';
export const seachProductUrl = apiDomain + 'product/seach?token=';
// image
export const listImageUrl = apiDomain + 'image/list?token=';
export const seachImageUrl = apiDomain + 'image/seach?token=';
// order
export const listOrderUrl = apiDomain + 'order/list?token=';
export const seachOrderUrl = apiDomain + 'order/seach?token=';
// dashboard
export const listDashBoardUrl = apiDomain + 'dashboard/list?token=';


import VueCookies from 'vue-cookies';

export const getToken = function(){
    return VueCookies.get('_token');
}

export const removeToken = function(){
    VueCookies.remove('_token');
}

export const getTokenUser = function(){
    return localStorage.getItem('bearer_token');
}

export const getHeader = function(){
    const token = VueCookies.get('_token');
    const headers = {
        'Accept':'application/json',
        'Authorization':'Bearer ' + token,

    }
    return headers;
}

export const getMonth = function(month){
    switch(month){
        case '0':
            return 1;
        case '1':
            return 2;
        case '2':
            return 3;
        case '3':
            return 4;
        case '4':
            return 5;
        case '5':
            return 6;
        case '6':
            return 7;
        case '7':
            return 8;
        case '8':
            return 9;
        case '9':
            return 10;
        case '10':
            return 11;
        case '11':
            return 12;
    }
}