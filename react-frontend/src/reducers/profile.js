import {
  LOGOUT_BEGIN, LOGOUT_SUCCESS, LOGOUT_ERROR,
} from 'actions/client/UserActions';

import {
  GET_PROFILE_BEGIN, GET_PROFILE_SUCCESS, GET_PROFILE_ERROR,
  UPDATE_PROFILE_BEGIN, UPDATE_PROFILE_SUCCESS, UPDATE_PROFILE_ERROR,
} from 'actions/client/ProfileActions';

const initialState = {
  error: '',
  isFetching: false,
  success: false,
  result: '',
  user_upd: '',
  user_info_upd: '',
};

export function profileReducer(state = initialState, action) {
  console.log('ProfileReducer, Action: ', action.type);

  switch (action.type) {
    case GET_PROFILE_BEGIN:
    case UPDATE_PROFILE_BEGIN:
      return {...state, result: '', user_upd: '', user_info_upd: '', isFetching: true, error: ''};
    case GET_PROFILE_SUCCESS:
    case UPDATE_PROFILE_SUCCESS:
      return {...state, ...action.payload, isFetching: false, success: true};
    case GET_PROFILE_ERROR:
    case UPDATE_PROFILE_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    case LOGOUT_SUCCESS:
      return {...initialState, ...action.payload, isFetching: false};
    default:
      return state;
  }
}
