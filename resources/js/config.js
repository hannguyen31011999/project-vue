export const apiDomain = 'http://localhost:8000/api/admin/';
export const loginUrl = apiDomain + 'login';
export const getUserUrl = apiDomain + 'user?token=';
export const logoutUrl = apiDomain + 'logout?token=';
export const createCategoriesUrl = apiDomain + 'categories/create?token=';
export const listCategoriesUrl = apiDomain + 'categories/list?token=';
import VueCookies from 'vue-cookies';

export const getToken = function(){
    return VueCookies.get('_token');
}

export const getHeader = function(){
    const token = localStorage.getItem('access_token');
    const headers = {
        'Accept':'application/json',
        'Authorization':'Bearer ' + token,

    }
    return headers;
}

