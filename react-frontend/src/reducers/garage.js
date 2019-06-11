import {
  SET_TS_BEGIN, SET_TS_SUCCESS, SET_TS_ERROR,
  GET_TS_BEGIN, GET_TS_SUCCESS, GET_TS_ERROR,
  UPDATE_TS_BEGIN, UPDATE_TS_SUCCESS, UPDATE_TS_ERROR,
} from '../actions/client/GarageActions';

const initialState = {
  TS: [], // Массив транспортных средств в гараже
  error: '', // добавили для сохранения текста ошибки
  isFetching: false, // добавили для реакции на статус "загружаю" или нет (на будущее)
};

export function garageReducer(state = initialState, action) {
  console.log('GarageReducer, Action: ', action.type);

  switch (action.type) {
    case SET_TS_BEGIN:
    case GET_TS_BEGIN:
    case UPDATE_TS_BEGIN:
      return {...state, isFetching: true, error: ''};
    case GET_TS_SUCCESS:
      return {...state, TS: [...state.TS, ...action.payload], isFetching: false};
    case SET_TS_SUCCESS:
      return {...state, TS: [...state.TS, action.payload], isFetching: false};
    case UPDATE_TS_SUCCESS:
      let newTS = [...state.TS];

      for (let key in newTS) {
        if (newTS[key].id === action.payload.id) {
          newTS[key] = action.payload;
          break;
        }
      }
      return {...state, TS: newTS, isFetching: false};

    case SET_TS_ERROR:
    case GET_TS_ERROR:
    case UPDATE_TS_ERROR:
      return {...state, isFetching: false, error: action.payload.message};
    default:
      return state;
  }
}
