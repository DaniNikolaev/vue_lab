import { createRouter, createWebHistory } from 'vue-router'

const routes = [
  {
    path: '/funerals/:id?',
    name: 'Funerals',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/FuneralsPage')
  },
  {
    path: '/plots',
    name: 'Plots',
    component: () => import('@/views/PlotsPage'),
  },
  {
    path: '/funeral-edit/:id?',
    name: 'FuneralEdit',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/FuneralEdit'),
  },
  {
    path: '/plot-edit/:id?',
    name: 'PlotEdit',
    props: (route) => {
      return {
        id: route.params.id,
      }
    },
    component: () => import('@/views/PlotEdit'),
  },
  {
    path: '/:catchAll(.*)',
    name: 'NotFound',
    component: () => import('@/views/FuneralsPage'),
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

export default router