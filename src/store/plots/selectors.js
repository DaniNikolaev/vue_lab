

export const fetchItems = ( store ) => {
  const { dispatch } = store;
  dispatch('plots/fetchItems');
};

export const selectItems = ( store ) => {
  const { getters } = store;
  return getters['plots/items']
}

export const removeItem = ( store, id ) => {
  const { dispatch } = store;
  dispatch('plots/removeItem', id);
}

export const addItem = ( store, { plot, price } ) => {
  const { dispatch } = store;
  dispatch('plots/addItem', { plot, price });
}

export const updateItem = ( store, { id, plot, price }) => {
  const { dispatch } = store;
  dispatch('plots/updateItem', { id, plot, price });

}

export const selectItemById = (store, id) => {
  const { getters } = store;
  return getters['plots/itemsByKey'][id] || {};
}
