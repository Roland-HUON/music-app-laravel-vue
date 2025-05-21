<script lang="ts">
    import MusicLayout from '@/layouts/MusicLayout.vue';
    import { Head, Link } from '@inertiajs/vue3';
    import Track from '@/components/Track.vue';
    export default {
        name: 'TrackIndex',
        components: {
            MusicLayout,
            Head,
            Link,
            Track
        },
        props: {
            tracks: Array
        },
        data() {
            return {
                audio: null,
                currentTrack: null,
                filter: '',
            }
        },
        computed: {
            filteredTracks() {
                return this.tracks.filter(track => track.title.toLowerCase().includes(this.filter.toLowerCase()) || track.artist.toLowerCase().includes(this.filter.toLowerCase()));
            }
        },
        methods: {
            play(track) {
                if(! this.currentTrack){
                    this.audio = new Audio('storage/' + track.music).play();
                    this.currentTrack = track.uuid;
                } else if(this.currentTrack === track.uuid){
                    this.audio.paused ? this.audio.play() : this.audio.pause();
                } else {
                    this.audio.pause();
                    this.audio.src = 'storage/' + track.music;
                    this.audio.play();
                }
                this.currentTrack = track.uuid;
            }
        }
    }
</script>

<template>
    <Head title="Tracks" />
    <MusicLayout>
        <template #title>
            Tracks
        </template>
        <template #content>
            <input type="text" name="filter" v-model="filter" placeholder="Filter" class="shadow border rounded py-2 px-3 text-gray-700 appearance-none leading-tight focus:outline-none focus:shadow-outline mb-2">
            <div class="grid grid-cols-3 gap-4">
                <Track v-for="track in filteredTracks" :key="track.uuid" :track="track" @playTrack="play"/>
            </div>
        </template>
        <template #actions>
            <Link v-show="$page.props.auth.is_admin" :href="route('tracks.create')">
                Add Track
            </Link>
        </template>
    </MusicLayout>
</template>