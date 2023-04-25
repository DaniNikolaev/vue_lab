<template>
  <Layout title="Участки">
    <PlotList />
  </Layout>
</template>

<script>
import Layout from '@/components/Layout/Layout';
import PlotList from '@/components/PlotList/PlotList';

export default {
  name: 'PlotsPage',
  components: {
    Layout,
    PlotList,
  }
}
</script>
