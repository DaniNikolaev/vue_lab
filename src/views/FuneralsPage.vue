<template>
  <Layout title="Похороны">
    <FuneralList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import FuneralList from '@/components/FuneralList/FuneralList';

export default {
  name: 'FuneralsPage',
  components: {
    Layout,
    FuneralList,
  }
}
</script>
