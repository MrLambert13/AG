import {POST} from "utils/fetchHelper";

export const GET_PROFILE_BEGIN = 'GET_PROFILE_BEGIN';
export const GET_PROFILE_SUCCESS = 'GET_PROFILE_SUCCESS';
export const GET_PROFILE_ERROR = 'GET_PROFILE_ERROR';

export function getProfile(url, data) {
  return POST(url, data, GET_PROFILE_BEGIN, GET_PROFILE_SUCCESS, GET_PROFILE_ERROR);
}