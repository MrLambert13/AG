import {  POST, DELETE } from 'utils/fetchHelper';

export const GET_ORDER_BEGIN = 'GET_ORDER_BEGIN';
export const GET_ORDER_SUCCESS = 'GET_ORDER_SUCCESS';
export const GET_ORDER_ERROR = 'GET_ORDER_ERROR';

export const SET_ORDER_BEGIN = 'SET_ORDER_BEGIN';
export const SET_ORDER_SUCCESS = 'SET_ORDER_SUCCESS';
export const SET_ORDER_ERROR = 'SET_ORDER_ERROR';

export const UPDATE_ORDER_BEGIN = 'UPDATE_ORDER_BEGIN';
export const UPDATE_ORDER_SUCCESS = 'UPDATE_ORDER_SUCCESS';
export const UPDATE_ORDER_ERROR = 'UPDATE_ORDER_ERROR';

export const DELETE_ORDER_BEGIN = 'DELETE_ORDER_BEGIN';
export const DELETE_ORDER_SUCCESS = 'DELETE_ORDER_SUCCESS';
export const DELETE_ORDER_ERROR = 'DELETE_ORDER_ERROR';

export function getOrder(url, data) {
  return POST(url, data, GET_ORDER_BEGIN, GET_ORDER_SUCCESS, GET_ORDER_ERROR);
}

export function setOrder(url, data) {
  return POST(url, data, SET_ORDER_BEGIN, SET_ORDER_SUCCESS, SET_ORDER_ERROR, true);
}

export function deleteOrder(url) {
  return DELETE(url, DELETE_ORDER_BEGIN, DELETE_ORDER_SUCCESS, DELETE_ORDER_ERROR);
}
