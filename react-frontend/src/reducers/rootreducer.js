import { combineReducers } from 'redux'
import { garageReducer } from './garage'
import { userReducer } from './user'
import { profileReducer } from './profile'
import { homeReducer } from './home'
import { orderReducer } from './order'
import { cartReducer } from './cart'

import { connectRouter } from 'connected-react-router'

// export const rootReducer = combineReducers({
//   garage: garageReducer,
//   user: userReducer,
// });

export default (history) => combineReducers({
  router: connectRouter(history),
  garage: garageReducer,
  user: userReducer,
  profile: profileReducer,
  home: homeReducer,
  order: orderReducer,
  cart: cartReducer,
})