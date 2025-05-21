<script lang="ts">
    import MusicLayout from '@/layouts/MusicLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    export default {
        name: 'TrackEdit',
        components: {
            MusicLayout,
            Head,
            Link
        },
        props: {
            track: Object,
        },
        data() {
            return{
                form : this.$inertia.form({
                    title: this.track.title,
                    artist: this.track.artist,
                    display: this.track.display ? true : false,
                })
            }
        },
        methods: {
            submit() {
                // this.$inertia.post(route('tracks.store'), this.form);
                this.form.put(route('tracks.update', { track: this.track }));
            }
        }
    }
</script>

<template>
    <Head title="Update Track" />
    <MusicLayout>
        <template #title>
            Tracks
        </template>
        <template #content>
            <form @submit.prevent="submit">
                <div class="mb-3">
                    <label for="title" class="block text-gray-700 text-sm font-bold mb-2">Title</label>
                    <input type="text" name="title" id="title" v-model="form.title" :class="{ 'border-red-500': form.errors.title }" class="shadow border rounded py-2 px-3 text-gray-700 appearance-none leading-tight focus:outline-none focus:shadow-outline mb-2" placeholder="Title of the song">
                    <div class="text-red-500 text-xs italic">{{ form.errors.title }}</div>
                </div>
                <div class="mb-3">
                    <label for="artist" class="block text-gray-700 text-sm font-bold mb-2">Artist</label>
                    <input type="text" name="artist" id="artist" v-model="form.artist" :class="{ 'border-red-500': form.errors.artist }" class="shadow border rounded py-2 px-3 text-gray-700 appearance-none leading-tight focus:outline-none focus:shadow-outline mb-2" placeholder="Artist">
                    <div class="text-red-500 text-xs italic">{{ form.errors.artist }}</div>
                </div>
                <div class="mb-3 flex gap-2 items-center">
                    <input type="checkbox" name="display" id="display" v-model="form.display" placeholder="Display">
                    <label for="display" class="block text-gray-700 text-sm font-bold">Display</label>
                </div>
                <button type="submit" class="text-white font-bold rounded py-2 px-4 bg-blue-500 hover:bg-blue-700">Update</button>
            </form>
        </template>
        <template #actions>
            <Link :href="route('tracks.index')">
                Back to tracks
            </Link>
        </template>
    </MusicLayout>
</template>