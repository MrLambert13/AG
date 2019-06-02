// import {LOGIN_BEGIN, LOGIN_ERROR, LOGIN_SUCCESS, LOGIN_WRONG} from "actions/client/UserActions";
// import history from 'store/history';
import { push } from 'connected-react-router'

const checkStatus = function (response) {
  console.log("response: ", response);
  // console.log("response.json: ", response.json());
  if (!response.ok) {
    return Promise.reject(new Error(response.statusText))
  }
  return Promise.resolve(response)
};


const getJson = function (response) {
  const contentType = response.headers.get("content-type");
  console.log("contentType: ", contentType);
  if (contentType && contentType.includes("application/json")) {
    return response.json();
  }
  throw new TypeError("We haven't got JSON in response!");
};

const sendMethod = function (methodType, URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION, successRedirectURL) {
  return dispatch => {
    dispatch({
      type: BEGIN_ACTION,
    });

    // Тут Ajax запрос
    fetch(URL, {
      method: methodType,
      headers: {
        // 'Accept': 'application/json, text/plain, */*',
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(checkStatus)
      .then(getJson)
      .then(function (json) {
        console.log(json);
        dispatch({
          type: SUCCESS_ACTION,
          payload: json,
        });
      })
      .catch(function (ex) {
        dispatch({
          type: ERROR_ACTION,
          error: true,
          payload: new Error(ex),
        });
      })
  }
};

/**
 * Функция реализует GET запрос на указанный URL
 * @param URL
 * @param BEGIN_ACTION Действие начала запроса
 * @param SUCCESS_ACTION Действие при успешном запросе
 * @param ERROR_ACTION Дейтсвие при ошибке
 * @returns {Function}
 * @constructor
 */
export function GET(URL, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION) {
  return dispatch => {
    dispatch({
      type: BEGIN_ACTION,
    });

    fetch(URL)
      .then(checkStatus)
      .then(getJson)
      .then(function (json) {
        dispatch({
          type: SUCCESS_ACTION,
          payload: json,
        })
      })
      .catch(function (ex) {
        dispatch({
          type: ERROR_ACTION,
          error: true,
          payload: new Error(ex),
        });
      })
  }
}

/**
 * Функция реализует POST запрос на указанный URL
 * @param URL
 * @param data  данные для передачи
 * @param BEGIN_ACTION Действие начала запроса
 * @param SUCCESS_ACTION Действие при успешном запросе
 * @param ERROR_ACTION Дейтсвие при ошибке
 * @returns {Function}
 * @constructor
 */
export function POST(URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION) {
  return sendMethod('POST', URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION);
}

/**
 * Функция реализует PATCH запрос на указанный URL
 * @param URL
 * @param data  данные для передачи
 * @param BEGIN_ACTION Действие начала запроса
 * @param SUCCESS_ACTION Действие при успешном запросе
 * @param ERROR_ACTION Дейтсвие при ошибке
 * @returns {Function}
 * @constructor
 */
export function PATCH(URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION) {
  return sendMethod('PATCH', URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION);
}

/**
 * Функция реализует PUT запрос на указанный URL
 * @param URL
 * @param data  данные для передачи
 * @param BEGIN_ACTION Действие начала запроса
 * @param SUCCESS_ACTION Действие при успешном запросе
 * @param ERROR_ACTION Дейтсвие при ошибке
 * @returns {Function}
 * @constructor
 */
export function PUT(URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION) {
  return sendMethod('PUT', URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION);
}

/**
 * Функция реализует DELETE запрос на указанный URL
 * @param URL
 * @param BEGIN_ACTION Действие начала запроса
 * @param SUCCESS_ACTION Действие при успешном запросе
 * @param ERROR_ACTION Дейтсвие при ошибке
 * @returns {Function}
 * @constructor
 */
export function DELETE(URL, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION) {
  return dispatch => {
    dispatch({
      type: BEGIN_ACTION,
    });

    fetch(URL, {
      method: 'DELETE',
    })
      .then(checkStatus)
      .then(function () {
        dispatch({
          type: SUCCESS_ACTION
        })
      })
      .catch(function (ex) {
        dispatch({
          type: ERROR_ACTION,
          error: true,
          payload: new Error(ex),
        });
      })
  }
}


/**
 * Метод авторизации пользователя на сайте
 * @param URL
 * @param data
 * @param LOGIN_BEGIN Действие начала запроса
 * @param LOGIN_SUCCESS Действие при успешной авторизации
 * @param LOGIN_WRONG Действие при ошибке авторизации (неправильное имя/пароль)
 * @param LOGIN_ERROR Дейтсвие при ошибке
 * @returns {Function}
 * @constructor
 */
export function LOGIN(URL, data, LOGIN_BEGIN, LOGIN_SUCCESS, LOGIN_WRONG, LOGIN_ERROR) {
  console.log('data:', data );
  return dispatch => {
    dispatch({
      type: LOGIN_BEGIN,
      payload: data.username
    });

    fetch(URL, {
      method: 'POST',
      headers: {
        'Accept': 'application/json',
        'Content-Type': 'application/json'
      },
      body: JSON.stringify(data)
    })
      .then(checkStatus)
      .then(getJson)
      .then(function (json) {
        console.log("response.json: ", json);
        if (json.token) {
          dispatch({
            type: LOGIN_SUCCESS,
            payload: json,
          });
          // При успешной авторизации перенаправляемся в профиль
          dispatch(push('/client/cabinet/profile'));
        } else {
          dispatch({
            type: LOGIN_WRONG,
            payload: json,
          });
        }
      })
      .catch(function (ex) {
        dispatch({
          type: LOGIN_ERROR,
          error: true,
          payload: new Error(ex),
        });
      })
  }
};