import {
  GET_ORDER_BEGIN, GET_ORDER_SUCCESS, GET_ORDER_ERROR,
} from 'actions/client/OrderActions';

const initialState = {
  orderItems: [],
  error: '',
  isFetching: false,
};

export function orderReducer(state = initialState, action) {
  console.log('orderReducer, Action: ', action.type);

  switch (action.type) {
    case GET_ORDER_BEGIN:
      return {...state, orderItems: [], isFetching: true, error: ''};
    case GET_ORDER_SUCCESS:
      return {...state, orderItems: action.payload, isFetching: false, success: true};
    case GET_ORDER_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}