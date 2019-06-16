import {
  GET_CART_BEGIN, GET_CART_SUCCESS, GET_CART_ERROR,
  SET_CART_BEGIN, SET_CART_SUCCESS, SET_CART_ERROR,
  DELETE_CART_BEGIN, DELETE_CART_SUCCESS, DELETE_CART_ERROR,
} from 'actions/client/CartActions';

import {SET_ORDER_SUCCESS} from 'actions/client/OrderActions'

import {removeItemsWithField} from "utils/arrayHelper";

const initialState = {
  cartItems: [],
  error: '',
  isFetching: false,
  deleteSuccess: false,
};

export function cartReducer(state = initialState, action) {
  console.log('cartReducer, Action: ', action.type);

  switch (action.type) {
    case GET_CART_BEGIN:
      return {...state, cartItems: [], isFetching: true, error: ''};
    case SET_CART_BEGIN:
    case DELETE_CART_BEGIN:
      return {...state, isFetching: true, deleteSuccess: false, error: ''};
    case GET_CART_SUCCESS:
      return {...state, cartItems: action.payload, isFetching: false, success: true};
    case SET_ORDER_SUCCESS:
      return {...state, cartItems: [], isFetching: false, success: true};
    case DELETE_CART_SUCCESS:
    {
      if (action.payload) {
        let newItems = [...state.cartItems];
        return {...state, cartItems: removeItemsWithField('id', action.payload, newItems), isFetching: false, deleteSuccess: true, success: true};
      } else {
        return {...state, isFetching: false, deleteSuccess: true, success: true};
      }
    }
    case SET_CART_SUCCESS:
    {
      let newItems = [...state.cartItems];
      newItems.push(action.payload);

      return {...state, cartItems: newItems, isFetching: false, success: true};
    }

    case GET_CART_ERROR:
    case SET_CART_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    case DELETE_CART_ERROR:
      return {...state, isFetching: false, deleteSuccess: false, error: action.payload.message};
    default:
      return state;
  }
}