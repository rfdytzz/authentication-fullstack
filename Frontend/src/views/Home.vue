<script setup>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';

const user = ref({})

onMounted( async () => {
    try {
        const token = localStorage.getItem('token')

        const res = await axios.get(
            'http://127.0.0.1:8000/api/user',
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        console.log(res.data)
        user.value = res.data
    } catch (error) {
        console.log(error)
    }
})
</script>

<template>
    <Navbar />
    <h1 class="mt-10 text-black"></h1>
</template>