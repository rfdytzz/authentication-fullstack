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

const isClose = ref(true)
const openSidebar = () => {
    isClose.value = !isClose.value
}

</script>

<template>
    <div class="w-full h-20 flex fixed z-20 border-b-2 border-lime-500 justify-between px-5 items-center bg-gray-900">
        <h2 class="font-bold text-white text-[30px]">My<span class="text-lime-500">Logo</span></h2>
        <div class="hidden md:block lg:block">
            <ul class="text-white flex gap-5">
                <router-link to="" class="text-lime-500">Home</router-link>
                <router-link to="" class="hover:text-lime-500 transition duration-200">About</router-link>
                <router-link to="" class="hover:text-lime-500 transition duration-200">Profile</router-link>
                <router-link to="" class="hover:text-lime-500 transition duration-200">Contract</router-link>
            </ul>
        </div>
        <div class="flex gap-4 hidden md:block lg:block items-center">
            <router-link to="" class="text-white">{{ user.name }}</router-link>
        </div>
        <div class="block md:hidden lg:hidden">
            <button @click="openSidebar" class="flex items-center justify-center transition-all duration-all flex-col relative cursor-pointer">
                <span :class="isClose ? '-translate-y-2' : 'rotate-45'" class="h-0.5 transition duration-500 w-7 bg-white"></span>
                <span :class="isClose ? 'block, opacity-100' : 'hidden, opacity-0'" class="h-0.5 w-7 transition duration-500 bg-white"></span>
                <span :class="isClose ? 'translate-y-2' : '-rotate-45'" class="h-0.5 w-7 transiton duration-500 bg-white"></span>
            </button>
        </div>
    </div>

    <div :class="isClose ? 'translate-x-full' : 'translate-x-0'" class="w-64 transition-all duration-200 h-screen bg-gray-900 right-0 z-10 fixed">
        <ul class="flex flex-col gap-2 text-white pt-25 p-5">
            <router-link to="" class="text-lime-500 text-[20px] p-3 bg-gray-800">Home</router-link>
            <router-link to="" class="hover:text-lime-500 text-[20px] p-3 transition hover:bg-gray-800 duration-200">About</router-link>
            <router-link to="" class="hover:text-lime-500 transition text-[20px] p-3 hover:bg-gray-800 duration-200">Profile</router-link>
            <router-link to="" class="hover:text-lime-500 transition text-[20px] p-3 hover:bg-gray-800 duration-200">Contract</router-link>
        </ul>
    </div>
</template>