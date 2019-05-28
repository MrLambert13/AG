// import { createStore, applyMiddleware  } from 'redux';
// import { rootReducer } from '../reducers/rootreducer';
// // import logger from 'redux-logger';
// import thunk from 'redux-thunk';
//
// export const store = createStore(rootReducer, applyMiddleware(thunk));

import { createBrowserHistory } from 'history';
import { applyMiddleware, compose, createStore } from 'redux';
import { routerMiddleware } from 'connected-react-router';
import thunk from 'redux-thunk';
import createRootReducer from 'reducers/rootreducer';
import throttle from 'utils/throttle';
import { saveState } from 'utils/stateHelper';

export const history = createBrowserHistory();

export default function configureStore(preloadedState) {
  const store = createStore(
    createRootReducer(history), // root reducer with router state
    preloadedState,
    compose(
      applyMiddleware(
        routerMiddleware(history), // for dispatching history actions
        thunk
      ),
    ),
  );

  store.subscribe(throttle(() => {
    saveState(store.getState());
  }, 1000));

  // store.subscribe(() => {
  //   saveState(store.getState());
  // });

  return store
}