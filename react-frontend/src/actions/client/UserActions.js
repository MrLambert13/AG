import { LOGIN, POST } from 'utils/fetchHelper';

export const LOGIN_BEGIN = 'LOGIN_BEGIN';
export const LOGIN_SUCCESS = 'LOGIN_SUCCESS';
export const LOGIN_WRONG = 'LOGIN_WRONG';
export const LOGIN_ERROR = 'LOGIN_ERROR';

export const REGISTRY_BEGIN = 'REGISTRY_BEGIN';
export const REGISTRY_SUCCESS = 'REGISTRY_SUCCESS';
export const REGISTRY_ERROR = 'REGISTRY_ERROR';

export const LOGOUT_BEGIN = 'LOGOUT_BEGIN';
export const LOGOUT_SUCCESS = 'LOGOUT_SUCCESS';
export const LOGOUT_ERROR = 'LOGOUT_ERROR';

export function login(url, data) {
  return LOGIN(url, data, LOGIN_BEGIN, LOGIN_SUCCESS, LOGIN_WRONG, LOGIN_ERROR);
}

export function registry(url, data) {
  return POST(url, data, REGISTRY_BEGIN, REGISTRY_SUCCESS, REGISTRY_ERROR);
}

export function logout(url, data) {
  return POST(url, data, LOGOUT_BEGIN, LOGOUT_SUCCESS, LOGOUT_ERROR);
}
