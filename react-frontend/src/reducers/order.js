import {
  GET_ORDER_BEGIN, GET_ORDER_SUCCESS, GET_ORDER_ERROR,
  SET_ORDER_BEGIN, SET_ORDER_SUCCESS, SET_ORDER_ERROR,
} from 'actions/client/OrderActions';

const initialState = {
  orderItems: [],
  error: '',
  isFetching: false,
  basketId: null
};

export function orderReducer(state = initialState, action) {
  console.log('orderReducer, Action: ', action.type);

  switch (action.type) {
    case GET_ORDER_BEGIN:
    case SET_ORDER_BEGIN:
      return {...state, orderItems: [], isFetching: true, error: ''};
    case GET_ORDER_SUCCESS:
      return {...state, orderItems: action.payload, isFetching: false, success: true};
    case SET_ORDER_SUCCESS:
      // Тут я должен сообщить в стор из какой корзины я сформировал заказ, чтобы удалить эту корзину
      //console.log(action.payload.idCart);
      return {...state, orderItems: action.payload, basketId: action.payload.idCart, isFetching: false, success: true};
    case 'RESET_CART_ID':
      return {...state, basketId: null};
    case GET_ORDER_ERROR:
    case SET_ORDER_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}