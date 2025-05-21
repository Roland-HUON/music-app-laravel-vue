<script lang="ts">
    import MusicLayout from '@/layouts/MusicLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    export default {
        name: 'PlaylistCreate',
        components: {
            MusicLayout,
            Head,
            Link
        },
        props: {
            tracks: Array
        },
        data() {
            return{
                form : this.$inertia.form({
                    title: '',
                    tracks: [],
                })
            }
        },
        methods: {
            submit() {
                this.form.post(route('playlists.store'));
            }
        }
    }
</script>

<template>
    <Head title="Create Playlist" />
    <MusicLayout>
        <template #title>
            Playlists
        </template>
        <template #content>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title" v-model="form.title" :class="{ 'border-red-500': form.errors.title }" class="shadow border rounded py-2 px-3 text-gray-700 appearance-none leading-tight focus:outline-none focus:shadow-outline mb-2" placeholder="Title of the song">
                    <div class="text-red-500 text-xs italic">{{ form.errors.title }}</div>
                </div>
                <label for="tracks" class="block text-gray-700 text-sm font-bold mb-2">Tracks</label>
                <div v-for="track in tracks" :key="track.uuid">
                    <input type="checkbox" name="tracks" v-model="form.tracks" :value="track.uuid">
                    <label :for="track.uuid">{{ track.title }}</label>
                </div>
                <button type="submit" class="text-white font-bold rounded py-2 px-4 bg-blue-500 hover:bg-blue-700">Create</button>
            </form>
        </template>
        <template #actions>
            <Link :href="route('tracks.index')">
                Back to tracks
            </Link>
        </template>
    </MusicLayout>
</template>