export const fetchItems = (store) => {
  const { dispatch } = store;
  dispatch('funerals/fetchItems');
};

export const selectItems = (store) => {
  const { getters } = store;
  return getters['funerals/items']
}
export const fetchFiltered=(store,id)=>{
  const {dispatch}=store;
  dispatch('funerals/fetchFiltered',id);
}

export const removeItem = (store, id) => {
  const { dispatch } = store;
  dispatch('funerals/removeItem', id);
}

export const addItem = (store, { name, surname, age,img_path, plot }) => {
  const { dispatch } = store;
  dispatch('funerals/addItem', { name, surname, age,img_path, plot });
}

export const updateItem = (store, { id, name, surname, age,img_path, plot }) => {
  const { dispatch } = store;
  dispatch('funerals/updateItem', { id, name, surname, age,img_path, plot });
}

export const selectItemById = (store, id) => {
  const { getters } = store;
  return getters['funerals/itemsByKey'][id] || {};
}
