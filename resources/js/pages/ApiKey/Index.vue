<template>

    <Head title="ApiKeys" />
  
    <MusicLayout>
      <template #title>
        Clés API
      </template>
  
      <template #action>
        <Link :href="route('apikeys.create')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mb-">
        Ajouter une clé API
        </Link>
      </template>
  
      <template #content>
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
        </div>
      </template>
    </MusicLayout>
</template>

<script lang="ts">
import { Head, Link } from '@inertiajs/vue3';
import MusicLayout from '@/layouts/MusicLayout.vue';

export default {
  name: 'Index',
  components: {
    Head,
    MusicLayout,
    Link,
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