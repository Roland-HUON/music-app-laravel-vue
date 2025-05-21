<script lang="ts">
    import MusicLayout from '@/layouts/MusicLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    export default {
        name: 'PlaylistIndex',
        components: {
            MusicLayout,
            Head,
            Link,
        },
        props: {
            playlists: Array
        },
    }
</script>

<template>
    <Head title="Playlists" />
    <MusicLayout>
        <template #title>
            Playlists
        </template>
        <template #content>
            <div class="grid grid-cols-3 gap-4">
                <ul>
                    <li v-for="playlist in playlists" :key="playlist.uuid">
                        {{ playlist.title }} {{ playlist.tracks_count }} musics
                    </li>
                </ul>
            </div>
        </template>
        <template #actions>
            <Link :href="route('playlists.create')">
                Add a playlist
            </Link>
        </template>
    </MusicLayout>
</template>