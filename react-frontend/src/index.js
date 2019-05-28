
import React from 'react';
import ReactDOM from 'react-dom';
import './index.css';
import { Provider } from 'react-redux'
import configureStore, { history } from './store/configureStore';
import { ConnectedRouter } from 'connected-react-router'
import App from './components/app/App';
import * as serviceWorker from './serviceWorker';

import { loadState } from 'utils/stateHelper';
const initialState = loadState();

const store = configureStore(initialState);

ReactDOM.render(
  <Provider store={store}>
    <ConnectedRouter history={history}>
      <App />
    </ConnectedRouter>
  </Provider>,
  document.getElementById('root')
);

// If you want your app to work offline and load faster, you can change
// unregister() to register() below. Note this comes with some pitfalls.
// Learn more about service workers: https://bit.ly/CRA-PWA
serviceWorker.unregister();
