<script lang="ts">
import { Link } from '@inertiajs/vue3';
export default {
    name: 'Track',
    components: {
        Link,
    },
    props: {
        track: Object
    },
    methods: {
        playTrack() {
          this.$emit('playTrack', this.track);
        },
        destroyTrack() {
            this.$inertia.delete(route('tracks.destroy', { track: this.track }), {
              preserveScroll: true,
            });
        } 
    }
}
</script>
<template>
    <div>
        <div class="max-w-sm rounded shadow-lg">
          <div class="w-full">
            <img :src="'/storage/' + track.image" />
          </div>
          <div class="px-6 py-4">
            <div class="font-bold text-xl mb-2">{{ track.title }}</div>
            <small class="text-gray-700 text-base">{{ track.artist }}</small>
          </div>
          <Link v-show="$page.props.auth.is_admin" :href="route('tracks.edit', { track: track })" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mb-1">
            Update
          </Link>
          <!-- <Link :href="route('tracks.destroy', { track: track })" method="delete" as="button" preserve-scroll class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mb-1">
            Delete
          </Link> -->
          <button v-show="$page.props.auth.is_admin" @click="destroyTrack" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-6 rounded w-full mb-1">
            Delete
          </button>
          <button @click="playTrack" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded w-full mb-1">
            Play
          </button>
        </div>
    </div>
</template>