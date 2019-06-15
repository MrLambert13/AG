import {GET} from "utils/fetchHelper";

export const GET_BRAND_BEGIN = 'GET_BRAND_BEGIN';
export const GET_BRAND_SUCCESS = 'GET_BRAND_SUCCESS';
export const GET_BRAND_ERROR = 'GET_BRAND_ERROR';

export const GET_MODEL_BEGIN = 'GET_MODEL_BEGIN';
export const GET_MODEL_SUCCESS = 'GET_MODEL_SUCCESS';
export const GET_MODEL_ERROR = 'GET_MODEL_ERROR';

export const GET_SERVICE_BEGIN = 'GET_SERVICE_BEGIN';
export const GET_SERVICE_SUCCESS = 'GET_SERVICE_SUCCESS';
export const GET_SERVICE_ERROR = 'GET_SERVICE_ERROR';

export const GET_MOTOR_BEGIN = 'GET_MOTOR_BEGIN';
export const GET_MOTOR_SUCCESS = 'GET_MOTOR_SUCCESS';
export const GET_MOTOR_ERROR = 'GET_MOTOR_ERROR';


export function getBrand(url) {
  return GET(url, GET_BRAND_BEGIN, GET_BRAND_SUCCESS, GET_BRAND_ERROR);
}

export function getModel(url) {
  return GET(url, GET_MODEL_BEGIN, GET_MODEL_SUCCESS, GET_MODEL_ERROR);
}

export function getService(url) {
  return GET(url, GET_SERVICE_BEGIN, GET_SERVICE_SUCCESS, GET_SERVICE_ERROR);
}

export function getMotor(url) {
  return GET(url, GET_MOTOR_BEGIN, GET_MOTOR_SUCCESS, GET_MOTOR_ERROR);
}