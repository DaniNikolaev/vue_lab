<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <FuneralForm @submit="onSubmit" :id="id"  />
  </Layout>
</template>

<script>
import { useStore } from 'vuex';

import { updateItem, addItem } from '@/store/funerals/selectors';
import FuneralForm from '@/components/FuneralForm/FuneralForm';
import Layout from '@/components/Layout/Layout';

export default {
  name: 'FuneralEdit',
  props: {
    id: String,
  },
  components: {
    Layout,
    FuneralForm,
  },
  setup() {
    const store = useStore();
    return {
      onSubmit: ({ id, name, surname, age, plot }) => id ?
          updateItem(store, { id, name, surname, age, plot }) :
          addItem(store, { name, surname, age, plot } )
    }
  }

}
</script>

