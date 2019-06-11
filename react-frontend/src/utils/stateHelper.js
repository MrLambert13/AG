/**
 * Получает состояние из localStorage
 * @returns {*}
 */
export const loadState = () => {
  try {
    const serializedState = localStorage.getItem('state');
    if(serializedState === null) {
      return undefined;
    }
    const parsedState = JSON.parse(serializedState);
    // Для корректной работы с react-router не загружаем свойство router из хранилища
    delete parsedState['router'];

    return parsedState;
  } catch (e) {
    return undefined;
  }
};

/**
 * Сохраняет состояние в localStorage
 * @param state
 */
export const saveState = (state) => {
  try {
    // const serializedState = JSON.stringify({...state, router: ''});
    const serializedState = JSON.stringify(state);
    localStorage.setItem('state', serializedState);
  } catch (e) {
    // Ignore write errors;
  }
};

/**
 * Очищает состояние в localStorage
 */
export const clearState = () => {
  try {
    localStorage.removeItem('state');
  } catch (e) {
    // Ignore write errors;
  }
};

/**
 * Удаляет поле с ключом  itemName состояния из localStorage
 * @param itemName Имя удаляемого поля
 */
export const deleteStateItem = (itemName) => {
  try {
    let state = loadState();
    delete state[itemName];

    saveState(state);
  } catch (e) {
    // Ignore write errors;
  }
};