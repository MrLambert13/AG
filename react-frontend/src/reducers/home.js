import {
  GET_BRAND_BEGIN, GET_BRAND_SUCCESS, GET_BRAND_ERROR,
  GET_MODEL_BEGIN, GET_MODEL_SUCCESS, GET_MODEL_ERROR,
} from 'actions/all/HomeActions';

const initialState = {
  brandItems: [],
  modelItems: [],
  serviceItems: [],
  error: '',
  isFetching: false,
};

export function homeReducer(state = initialState, action) {
  console.log('homeReducer, Action: ', action.type);

  switch (action.type) {
    case GET_BRAND_BEGIN:
    case GET_MODEL_BEGIN:
      return {...state, isFetching: true, error: ''};
    case GET_BRAND_SUCCESS:
      return {...state, brandItems: action.payload, modelItems: [], isFetching: false, success: true};
    case GET_MODEL_SUCCESS:
      return {...state, modelItems: action.payload[1], isFetching: false, success: true};
    case GET_BRAND_ERROR:
    case GET_MODEL_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}