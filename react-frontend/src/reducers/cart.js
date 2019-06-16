import {
  GET_CART_BEGIN, GET_CART_SUCCESS, GET_CART_ERROR,
} from 'actions/client/CartActions';

const initialState = {
  cartItems: [],
  error: '',
  isFetching: false,
};

export function cartReducer(state = initialState, action) {
  console.log('cartReducer, Action: ', action.type);

  switch (action.type) {
    case GET_CART_BEGIN:
      return {...state, cartItems: [], isFetching: true, error: ''};
    case GET_CART_SUCCESS:
      return {...state, ...action.payload, isFetching: false, success: true};
    case GET_CART_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}