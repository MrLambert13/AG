import { push } from 'connected-react-router'
import {SETTINGS} from 'settings';

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

export const sendMethod = function (methodType, URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION, dispatchData) {
  return dispatch => {
    dispatch({
      type: BEGIN_ACTION,
    });

    // Тут Ajax запрос
    fetch(SETTINGS.domain + URL, {
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
        let payload = dispatchData ? {...json, ...data} : json;

        dispatch({
          type: SUCCESS_ACTION,
          payload: payload,
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

    fetch(SETTINGS.domain + URL)
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

// /**
//  * Функция реализует GET запрос с отправкой данных на указанный URL
//  * @param URL
//  * @param data
//  * @param BEGIN_ACTION
//  * @param SUCCESS_ACTION
//  * @param ERROR_ACTION
//  * @param dispatchData
//  * @returns {*}
//  * @constructor
//  */
// export function GET_WITH_BODY(URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION, dispatchData = false) {
//   return dispatch => {
//     dispatch({
//       type: BEGIN_ACTION,
//     });
//
//     var xhr = new XMLHttpRequest();
//     xhr.open('GET', URL, true);
//     xhr.setRequestHeader('Content-Type', 'application/json');
//
//     xhr.send(JSON.stringify(data));
//
//     xhr.onreadystatechange = function() {
//       if (xhr.status != 200) {
//         dispatch({
//           type: ERROR_ACTION,
//           error: true,
//           payload: new Error("Ошибка получения корзины"),
//         });
//       } else {
//         console.log(JSON.parse(xhr.responseText));
//         dispatch({
//           type: SUCCESS_ACTION,
//           payload: JSON.parse(xhr.responseText),
//         })
//       }
//
//     };
//   };
// }

/**
 * Функция реализует POST запрос на указанный URL
 * @param URL
 * @param data  данные для передачи
 * @param BEGIN_ACTION Действие начала запроса
 * @param SUCCESS_ACTION Действие при успешном запросе
 * @param ERROR_ACTION Дейтсвие при ошибке
 * @param dispatchData Если true, при успешном запросе в payload попадают и переданные данные
 * @returns {Function}
 * @constructor
 */
export function POST(URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION, dispatchData = false) {
  return sendMethod('POST', URL, data, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION, dispatchData);
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
 * @param id Идентификатор удаляемой сущности
 * @returns {Function}
 * @constructor
 */
export function DELETE(URL, BEGIN_ACTION, SUCCESS_ACTION, ERROR_ACTION, id) {
  return dispatch => {
    dispatch({
      type: BEGIN_ACTION,
    });

    let pathId = id ? '/' + id : '';

    fetch(SETTINGS.domain + URL + pathId, {
      method: 'DELETE',
    })
      .then(checkStatus)
      .then(function () {
        dispatch({
          type: SUCCESS_ACTION,
          payload: id
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

    fetch(SETTINGS.domain + URL, {
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
          dispatch(push('/client/cabinet'));
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
}

export function UPDATE_PROFILE(URL, data, UPDATE_PROFILE_BEGIN, UPDATE_PROFILE_SUCCESS, UPDATE_PROFILE_ERROR) {
  return dispatch => {
    dispatch({
      type: UPDATE_PROFILE_BEGIN,
    });

    fetch(SETTINGS.domain + URL, {
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
        console.log(json);
        if (json.result === 'ok') {
          dispatch({
            type: UPDATE_PROFILE_SUCCESS,
            payload: json.user_info_upd === 'success' ? {...data, ...json} : json,
          });
        } else if (json.result === 'error'){
          throw new TypeError("We have update error. User_upd: " + json.user_upd + ". User_info_upd: " + json.user_info_upd);
        }
      })
      .catch(function (ex) {
        dispatch({
          type: UPDATE_PROFILE_ERROR,
          error: true,
          payload: new Error(ex),
        });
      })
  }
}


export function UPDATE_PASSWORD(URL, data, UPDATE_PASSWORD_BEGIN, UPDATE_PASSWORD_SUCCESS, UPDATE_PASSWORD_ERROR) {
  return dispatch => {
    dispatch({
      type: UPDATE_PASSWORD_BEGIN,
    });

    fetch(SETTINGS.domain + URL, {
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
        console.log(json);
        if (json.result === 'ok') {
          dispatch({
            type: UPDATE_PASSWORD_SUCCESS,
            payload: json,
          });
        } else if (json.result === 'error'){
          throw new TypeError("Error: " + json.message);
        }
      })
      .catch(function (ex) {
        dispatch({
          type: UPDATE_PASSWORD_ERROR,
          error: true,
          payload: new Error(ex),
        });
      })
  }
}