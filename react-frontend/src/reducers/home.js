import {
  GET_BRAND_BEGIN, GET_BRAND_SUCCESS, GET_BRAND_ERROR,
  GET_MODEL_BEGIN, GET_MODEL_SUCCESS, GET_MODEL_ERROR,
  GET_MOTOR_BEGIN, GET_MOTOR_SUCCESS, GET_MOTOR_ERROR,
} from 'actions/all/HomeActions';

const initialState = {
  brandItems: [],
  modelItems: [],
  motorItems: [],
  serviceItems: [],
  error: '',
  isFetching: false,
};

export function homeReducer(state = initialState, action) {
  console.log('homeReducer, Action: ', action.type);

  switch (action.type) {
    case GET_BRAND_BEGIN:
    case GET_MODEL_BEGIN:
    case GET_MOTOR_BEGIN:
      return {...state, isFetching: true, error: ''};
    case GET_BRAND_SUCCESS:
      return {...state, brandItems: action.payload, modelItems: [], isFetching: false, success: true};
    case GET_MODEL_SUCCESS:
      return {...state, modelItems: action.payload[1], isFetching: false, success: true};
    case GET_MOTOR_SUCCESS:
      return {...state, motorItems: action.payload, isFetching: false, success: true};
    case GET_BRAND_ERROR:
    case GET_MODEL_ERROR:
    case GET_MOTOR_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}