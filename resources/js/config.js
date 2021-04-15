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

import VueCookies from 'vue-cookies';

export const getToken = function(){
    return VueCookies.get('_token');
}

export const getTokenUser = function(){
    return localStorage.getItem('bearer_token');
}

export const getHeader = function(){
    const token = localStorage.getItem('access_token');
    const headers = {
        'Accept':'application/json',
        'Authorization':'Bearer ' + token,

    }
    return headers;
}

