<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRoute, useRouter } from 'vue-router';

const router = useRouter()
const isOpen = ref(false)
const email = ref('')
const password = ref('')
const errorMessage = ref('')
const isActive = ref(true)
const isHide = ref(false)

const hideSession = () => {
    isHide.value = !isHide.value
}

const toggle = () => {
    isOpen.value = !isOpen.value
}

const getLogin = async () => {
    try {
        const res = await axios.post('http://localhost:8000/api/login',
            {
                email: email.value,
                password: password.value
            }
        )
        localStorage.setItem('token', res.data.token)
        router.push('/')
    } catch (error) {
        if (error.response) {
            errorMessage.value = error.response.data.message 
        } else {
            errorMessage.value = 'Server Error'
        }
    }
}
</script>

<template>
    <div class="w-full bg-gray-900 md:bg-gray-900 lg:bg-gray-200 justify-center items-center h-screen flex">
        <div class="flex flex-col shadow shadow-gray-900 gap-5 w-100 bg-gray-900 text-white rounded px-5 py-10">
            <h1 class="font-bold text-center text-[40px]">Log<span class="text-lime-500">in</span></h1>
            <div :class="isHide ? 'hidden' : 'block'" v-if="errorMessage" class="bg-red-500/20 text-red-300 flex justify-between items-center border-2 border-red-500 flex-1 p-3 rounded">{{ errorMessage }}<i @click="hideSession" class='bx bx-x cursor-pointer'></i></div>
            <form @submit.prevent="getLogin" action="" class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <label for="">Email</label>
                    <input placeholder="Email" required v-model="email" type="text" class="flex-1 outline-2 p-3 focus:outline-2 focus:outline-lime-500 rounded  outline-lime-600 transition duration-100">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Password</label>
                    <input placeholder="Password" required minlength="8" v-model="password" :type="isOpen ? 'text' : 'password'" class="flex-1 outline-2 p-3 focus:outline-2 focus:outline-lime-500 rounded  outline-lime-600 transition duration-100">
                    <div class="flex gap-2 items-center">
                        <input @click="toggle" type="checkbox" name="" id=""> Show Password
                    </div>
                </div>
                <button type="submit" class="bg-lime-500 rounded p-3 mt-5 text-[16px] cursor-pointer">Login</button>
                <p class="text-center">Dont have an account? <router-link to="/register" class="text-lime-500">Register</router-link></p>
            </form>
        </div>
    </div>
</template>