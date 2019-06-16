import { GET, POST, PUT, DELETE } from 'utils/fetchHelper';

export const SET_TS_BEGIN = 'SET_TS_BEGIN';
export const SET_TS_SUCCESS = 'SET_TS_SUCCESS';
export const SET_TS_ERROR = 'SET_TS_ERROR';

export const UPDATE_TS_BEGIN = 'UPDATE_TS_BEGIN';
export const UPDATE_TS_SUCCESS = 'UPDATE_TS_SUCCESS';
export const UPDATE_TS_ERROR = 'UPDATE_TS_ERROR';

export const GET_TS_BEGIN = 'GET_TS_BEGIN';
export const GET_TS_SUCCESS = 'GET_TS_SUCCESS';
export const GET_TS_ERROR = 'GET_TS_ERROR';

export const DELETE_TS_BEGIN = 'DELETE_TS_BEGIN';
export const DELETE_TS_SUCCESS = 'DELETE_TS_SUCCESS';
export const DELETE_TS_ERROR = 'DELETE_TS_ERROR';

export function getTS(url) {
  return GET(url, GET_TS_BEGIN, GET_TS_SUCCESS, GET_TS_ERROR);
}

export function setTS(url, data) {
  return POST(url, data, SET_TS_BEGIN, SET_TS_SUCCESS, SET_TS_ERROR);
}

export function updateTS(url, data) {
  return PUT(url, data, UPDATE_TS_BEGIN, UPDATE_TS_SUCCESS, UPDATE_TS_ERROR);
}

export function deleteTS(url) {
  return DELETE(url, DELETE_TS_BEGIN, DELETE_TS_SUCCESS, DELETE_TS_ERROR);
}
