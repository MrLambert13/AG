import {
  GET_BRAND_BEGIN, GET_BRAND_SUCCESS, GET_BRAND_ERROR,
  GET_MODEL_BEGIN, GET_MODEL_SUCCESS, GET_MODEL_ERROR,
  GET_SERVICE_BEGIN, GET_SERVICE_SUCCESS, GET_SERVICE_ERROR,
  GET_STO_BEGIN, GET_STO_SUCCESS, GET_STO_ERROR,
} from 'actions/all/HomeActions';

const initialState = {
  brandItems: [],
  modelItems: [],
  motorItems: [],
  stoItems: [],
  serviceItems: [],
  error: '',
  isFetching: false,
};

export function homeReducer(state = initialState, action) {
  console.log('homeReducer, Action: ', action.type);

  switch (action.type) {
    case GET_BRAND_BEGIN:
    case GET_MODEL_BEGIN:
    case GET_SERVICE_BEGIN:
    case GET_STO_BEGIN:
      return {...state, isFetching: true, stoItems: [], error: ''};
    case GET_BRAND_SUCCESS:
      return {...state, brandItems: action.payload, modelItems: [], isFetching: false, success: true};
    case GET_MODEL_SUCCESS:
      return {...state, modelItems: action.payload[1], isFetching: false, success: true};
    case GET_SERVICE_SUCCESS:
      return {...state, serviceItems: action.payload, isFetching: false, success: true};
    case GET_STO_SUCCESS:
      return {...state, stoItems: action.payload, isFetching: false, success: true};
    case GET_BRAND_ERROR:
    case GET_MODEL_ERROR:
    case GET_SERVICE_ERROR:
    case GET_STO_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}