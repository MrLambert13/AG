import { POST, GET, PUT, DELETE } from 'utils/fetchHelper';

export const GET_CART_BEGIN = 'GET_CART_BEGIN';
export const GET_CART_SUCCESS = 'GET_CART_SUCCESS';
export const GET_CART_ERROR = 'GET_CART_ERROR';

export const SET_CART_BEGIN = 'SET_CART_BEGIN';
export const SET_CART_SUCCESS = 'SET_CART_SUCCESS';
export const SET_CART_ERROR = 'SET_CART_ERROR';

export const UPDATE_CART_BEGIN = 'UPDATE_CART_BEGIN';
export const UPDATE_CART_SUCCESS = 'UPDATE_CART_SUCCESS';
export const UPDATE_CART_ERROR = 'UPDATE_CART_ERROR';

export const DELETE_CART_BEGIN = 'DELETE_CART_BEGIN';
export const DELETE_CART_SUCCESS = 'DELETE_CART_SUCCESS';
export const DELETE_CART_ERROR = 'DELETE_CART_ERROR';

export function getCart(url) {
  return GET(url, GET_CART_BEGIN, GET_CART_SUCCESS, GET_CART_ERROR);
}

export function setCart(url, data) {
  return POST(url, data, SET_CART_BEGIN, SET_CART_SUCCESS, SET_CART_ERROR);
}

export function updateCart(url, data) {
  return PUT(url, data, UPDATE_CART_BEGIN, UPDATE_CART_SUCCESS, UPDATE_CART_ERROR);
}

export function deleteCart(url, id) {
  return DELETE(url, DELETE_CART_BEGIN, DELETE_CART_SUCCESS, DELETE_CART_ERROR, id);
}
