<template>
    <Head title="ApiKeys" />

    <MusicLayout>
      <template #title>
        Clés API
      </template>
  
      <template #action>
        <Link :href="route('apikeys.index')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full mb-">
        Retour à la liste des clés API
        </Link>
      </template>
  
      <template #content>
        <form @submit.prevent="send" class="max-w-lg mx-auto bg-white p-8 rounded-lg shadow-md border border-gray-200 mt-8">
          <div class="relative z-0 w-full mb-5 group">
              <input 
                type="text" 
                v-model="form.name" 
                name="name" 
                id="name" 
                class="block py-2.5 px-0 w-full text-sm text-gray-900 bg-transparent border-0 border-b-2 border-gray-300 appearance-none dark:text-blue-500 dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer" 
                placeholder="Nom de la clé API" 
                required />
              <label 
                for="name" 
                class="peer-focus:font-medium absolute text-sm text-gray-500 dark:text-gray-400 duration-300 transform -translate-y-6 scale-75 top-3 -z-10 origin-[0] peer-focus:start-0 rtl:peer-focus:translate-x-1/4 rtl:peer-focus:left-auto peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:translate-y-0 peer-focus:scale-75 peer-focus:-translate-y-6">
                Nom de la clé API
              </label>
              <div 
                v-if="form.errors.name" 
                class="text-red-500 text-xs italic mt-1">
                {{ form.errors.name }}
              </div>
          </div>
          <input type="submit" value="Créer la clé API"
            class="w-full text-white font-bold rounded py-2 px-4 bg-blue-500 hover:bg-blue-700">
        </form>
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
  data() {
    return {
      form: this.$inertia.form({
        name: '',
      })
    }
  },
  methods: {
    send() {
      this.form.post(route('apikeys.store'));
    }
  }
}
</script>