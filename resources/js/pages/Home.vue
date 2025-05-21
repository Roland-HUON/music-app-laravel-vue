<script lang="ts">
import MusicLayout from "@/layouts/MusicLayout.vue"
import { Head } from "@inertiajs/vue3"
export default{
    name: "Home",
    components: {
        MusicLayout,
        Head
    },
    data() {
        return{
            firstName: 'John',
            lastName: 'Doe',
            age: 30,
            email: 'john.doe@example.com',
            phone: '+1234567890',
            address: '123 Main St, Anytown, USA',
        }
    },
    computed: {
        fullName() {
            return this.firstName + ' ' + this.lastName;
        }
    }
}
</script>
<template>
    <Head title="Home" />
    <MusicLayout>
        <template #title>
            Home
        </template>
        <template #content>
            <div>
                <h1>Home</h1>
            </div>
        </template>
        <template #actions>
            <Link :href="route('tracks.create')">
                Add Track
            </Link>
        </template>
    </MusicLayout>
    <div v-show="firstName && lastName && age && email && phone && address">
        <input type="text" v-model="firstName">
        <input type="text" v-model="lastName">
        <p v-show="fullName">{{ fullName }}</p>
        <p v-show="age">{{ age }}</p>
        <p v-show="email">{{ email }}</p>
        <p v-show="phone">{{ phone }}</p>
        <p v-show="address">{{ address }}</p>
    </div>
    <div v-show="!firstName && !lastName && !age && !email && !phone && !address">
        Tracks
    </div>
</template>