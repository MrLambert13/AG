import {
  LOGIN_BEGIN, LOGIN_SUCCESS, LOGIN_WRONG, LOGIN_ERROR,
  REGISTRY_BEGIN, REGISTRY_SUCCESS, REGISTRY_ERROR,
  LOGOUT_BEGIN, LOGOUT_SUCCESS, LOGOUT_ERROR,
} from 'actions/client/UserActions';

const initialState = {
  username: '',
  // token: '',
  // expired: '',
  error: '',
  isFetching: false,
  isRegistered: false,
  authError: false,
};

export function userReducer(state = initialState, action) {
  console.log('UserReducer, Action: ', action.type);

  switch (action.type) {
    case LOGIN_BEGIN:
      return {...state, username: action.payload, isFetching: true, error: ''};
    case LOGOUT_BEGIN:
    case REGISTRY_BEGIN:
      return {...state, isFetching: true, error: ''};
    case LOGIN_SUCCESS:
      return {...state, ...action.payload, isFetching: false};
    case LOGOUT_SUCCESS:
      return {...initialState, ...action.payload, isFetching: false};
    case REGISTRY_SUCCESS:
      return {...state, ...action.payload, isFetching: false, isRegistered: true};
    case LOGIN_WRONG:
      return {...state, ...action.payload, username: '', isFetching: false, authError: true};
    case LOGIN_ERROR:
    case REGISTRY_ERROR:
    case LOGOUT_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}
