<script setup>
import Navbar from '@/components/Navbar.vue';
import axios from 'axios';
import { onMounted, ref } from 'vue';
import { useRouter } from 'vue-router';

const user = ref({})
const router = useRouter()

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
        user.value = res.data
    } catch (error) {
        console.log(error)
    }
})

const logout = async () => {
    try {
        const token = localStorage.getItem('token')
        await axios.post(
            'http://127.0.0.1:8000/api/logout',
            {},
            {
                headers: {
                    Authorization: `Bearer ${token}`
                }
            }
        )
        localStorage.removeItem('token')
        router.push('/login')
    } catch (error) {
        console.log(error)
    }
}

</script>

<template>
    <div class="w-full h-20 flex justify-between px-5 items-center bg-gray-900">
        <h2 class="font-bold text-white text-[30px]">My<span class="text-lime-500">Logo</span></h2>
        <ul class="text-white flex gap-5">
            <router-link to="" class="text-lime-500">Home</router-link>
            <router-link to="" class="hover:text-lime-500 transition duration-200">About</router-link>
            <router-link to="" class="hover:text-lime-500 transition duration-200">Profile</router-link>
            <router-link to="" class="hover:text-lime-500 transition duration-200">Contract</router-link>
        </ul>
        <div class="flex gap-4 items-center">
            <button @click="logout" class="text-white bg-red-500/20 border-2 border-red-500 cursor-pointer px-3 py-2 rounded">Logout</button>
            <router-link to="" class="text-white">{{ user.name }}</router-link>
        </div>
    </div>
</template>