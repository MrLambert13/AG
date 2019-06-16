
export const findItemWithField = (fieldName, fieldValue, array) => {
  return array.find((item) => (item[fieldName] == fieldValue));
};

export const filterItemsWithField = (fieldName, fieldValue, array) => {
  return array.filter((item) => (item[fieldName] == fieldValue));
};

export const removeItemsWithField = (fieldName, fieldValue, array) => {
  return array.filter((item) => (item[fieldName] != fieldValue));
};