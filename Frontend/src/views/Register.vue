<script setup>
import axios from 'axios';
import { ref } from 'vue';
import { useRouter } from 'vue-router';


const isOpen = ref(false)

const toggle = () => {
    isOpen.value = !isOpen.value
}

const name = ref('')
const email = ref('')
const password = ref('')
const message = ref('')
const router = useRouter()
const isHide = ref(false)

const hideSession = () => {
    isHide.value = !isHide.value
}

const getRegister = async () => {
    try {
        const res = await axios.post('http://localhost:8000/api/register',
            {
                name: name.value,
                email: email.value,
                password: password.value
            }
        )
        router.push('/login')
    } catch (error) {
        message.value = 'Email has been taken'
        console.log(error)
    }
}

</script>

<template>
    <div class="w-full bg-gray-900 md:bg-gray-900 lg:bg-gray-200 justify-center items-center h-screen flex">
        <div class="flex flex-col gap-5 w-120 bg-gray-900 text-white rounded px-5 py-10">
            <h1 class="font-bold text-center text-[40px]">Regi<span class="text-lime-500">ster</span></h1>
            <div :class="isHide ? 'hidden' : 'block'" v-if="message" class="bg-red-500/20 flex text-red-300 justify-between items-center border-2 border-red-500 flex-1 p-3 rounded">{{ message }}<i @click="hideSession" class='bx bx-x cursor-pointer'></i></div>
            <form @submit.prevent="getRegister" action="" class="flex flex-col gap-5">
                <div class="flex flex-col gap-2">
                    <label for="">Name</label>
                    <input required v-model="name" type="text" placeholder="Your Name" class="flex-1 outline-2 p-3 focus:outline-2 focus:outline-lime-500 rounded  outline-lime-600 transition duration-100">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Email</label>
                    <input required v-model="email" placeholder="email@example.com" type="text" class="flex-1 outline-2 p-3 focus:outline-2 focus:outline-lime-500 rounded  outline-lime-600 transition duration-100">
                </div>
                <div class="flex flex-col gap-2">
                    <label for="">Password</label>
                    <input minlength="8" required v-model="password" placeholder="Password" :type="isOpen ? 'text' : 'password'" class="flex-1 outline-2 p-3 focus:outline-2 focus:outline-lime-500 rounded  outline-lime-600 transition duration-100">
                    <div class="flex gap-2 items-center">
                        <input @click="toggle" type="checkbox" name="" id=""> Show Password
                    </div>
                </div>
                <button type="submit" class="bg-lime-500 rounded p-3 mt-5 text-[16px] cursor-pointer">Register</button>
                <p class="text-center">Have an account? <router-link to="/login" class="text-lime-500">Login</router-link></p>
            </form>
        </div>
    </div>
</template>