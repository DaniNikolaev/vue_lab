<template>
  <div :class="$style.root">
    <Table
        :headers="[
        {value: 'id', text: 'ID'},
        {value: 'name', text: 'Имя'},
        {value: 'surname', text: 'Фамилия'},
        {value: 'age', text: 'Возраст'},
        {value: 'photo', text:'Фото'},
        {value: 'plot', text: 'Участок'},
        {value: 'control', text: 'Действие'},
      ]"
        :items="items"
    >
      <template v-slot:photo="{ item }">
        <img style="height:150px;width:200px;"  :src="'http://localhost/vue_lab/API/inc/images/' + item.img_path">
      </template>
      <template v-slot:control="{ item }">
        <Btn @click="onClickEdit(item.id)" theme="info">Изменить</Btn>
        <Btn @click="onClickRemove(item.id)" theme="danger">Удалить</Btn>
      </template>
    </Table>
    <router-link :to="{ name: 'FuneralEdit' }">
      <Btn :class="$style.create" theme="info">Создать</Btn>
    </router-link>
  </div>
  <Btn v-if="$route.params.id" @click="onClickClear()" theme="danger" > Очистить фильтр </Btn>
</template>

<script>
import { useStore } from 'vuex';
import { computed, onMounted } from 'vue';
import {useRoute, useRouter} from 'vue-router';

import { selectItems, removeItem, fetchItems,fetchFiltered } from '@/store/funerals/selectors';
import { selectItems as selectPlotItems} from '@/store/plots/selectors';
import Table from '@/components/Table/Table';
import Btn from '@/components/Btn/Btn';

export default {
  name: 'FuneralList',
  components: {
    Table,
    Btn,
  },
  setup() {
    const store = useStore();
    const router = useRouter();
    const route=useRoute();
    onMounted(() => {
      if (typeof route.params.id !== "undefined") {
        fetchFiltered(store,  route.params.id);
      }
      else
      {
        fetchItems(store);
      }
    });
    return {
      plots: computed(()=>selectPlotItems(store)),
      items: computed(() => selectItems(store)),
      onClickRemove: id => {
        const isConfirmRemove = confirm('Вы действительно хотите удалить запись?')
        if (isConfirmRemove) {
          removeItem(store, id)
        }
      },
      onClickEdit: id => {
        router.push({ name: 'FuneralEdit', params: { id } })
      },
      onClickClear(){
        router.push({name:'Plots'});
        fetchItems(store);
      }
    }
  }

}
</script>

<style module lang="scss">
.root {

  .create {
    margin-top: 16px;
  }

}
</style>
