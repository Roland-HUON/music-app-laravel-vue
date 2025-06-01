<script lang="ts">
import AppLayout from '@/layouts/AppLayout.vue';
import { Head, Link } from '@inertiajs/vue3';
import PlaceholderPattern from '../components/PlaceholderPattern.vue';

export default {
  name: 'Index',
  components: {
    Head,
    Link,
    AppLayout,
    PlaceholderPattern,
  },
  props: {
    apiKeys: Array,
  },
  methods: {
    destroy(uuid) {
      this.$inertia.delete(route('apikeys.destroy', { apikey: uuid }));
    },
  }
}
</script>

<template>

  <Head title="Dashboard" />

  <AppLayout>
    <div class="flex h-full flex-1 flex-col gap-4 rounded-xl p-4">
      <div class="grid auto-rows-min gap-4 md:grid-cols-3">
        <div
          class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border text-white">
          {{ apiKeys.key }}
        </div>
        <div
          class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <PlaceholderPattern />
        </div>
        <div
          class="relative aspect-video overflow-hidden rounded-xl border border-sidebar-border/70 dark:border-sidebar-border">
          <PlaceholderPattern />
        </div>
      </div>
      <div
        class="relative min-h-[100vh] flex-1 rounded-xl border border-sidebar-border/70 dark:border-sidebar-border md:min-h-min p-4">
        <h1 class="text-2xl font-bold">Bienvenue sur votre dashboard, {{ $page.props.auth.user.name }} !</h1>
        <div class="flex flex-col gap-4">
          <p>Vous retrouverez ci-dessous vos clés API. Vous pouvez les utiliser pour accéder à l'API de l'application.</p>
          <div class="relative overflow-x-auto">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            Nom de la Clé API
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Clé API
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Date de création
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="key in apiKeys" :key="key.uuid" class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                        <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                            {{ key.name }}
                        </th>
                        <td class="px-6 py-4">
                            {{ key.key }}
                        </td>
                        <td class="px-6 py-4">
                            {{ key.created_at }}
                        </td>
                        <td class="px-6 py-4">
                          <button @click="destroy(key.uuid)" class="bg-red-500 text-white px-4 py-2 rounded-md">Supprimer</button>
                        </td>
                    </tr>
                </tbody>
            </table>
          </div>
          <Link :href="route('apikeys.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-fit mb- self-end">
        Ajouter une clé API
        </Link>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
