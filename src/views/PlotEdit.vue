<template>
  <Layout :title="id ? 'Редактирование записи' : 'Создание записи'">
    <PlotForm
        :id="id"
        @submit="onSubmit"
    />
  </Layout>
</template>

<script>
import { useStore } from 'vuex';

import { updateItem, addItem } from '@/store/plots/selectors';
import Layout from '@/components/Layout/Layout';
import PlotForm from '@/components/PlotForm/PlotForm';
export default {
  name: 'PlotEdit',
  props: {
    id: String,
  },
  components: {
    Layout,
    PlotForm,
  },
  setup() {
    const store = useStore();
    return {
      onSubmit: ({ id, plot, price }) => id ?
          updateItem(store, { id, plot,  price  }) :
          addItem(store, { plot, price }),
    };
  }
}
</script>

