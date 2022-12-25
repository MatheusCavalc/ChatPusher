<script setup>
import { reactive, toRefs } from 'vue';
import axios from 'axios';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import ChatMessages from '@/Components/ChatMessages.vue';
import ChatForm from '@/Components/ChatForm.vue';

const state = reactive({
    messages: []
})

axios.get('/messages')
    .then(res => {
        const data = res.data
        state.messages = data
    })

const { messages } = toRefs(state);

const addMessage = (message) => {
    state.messages.push(message);
    axios.post('/messages', message)
}

Echo.private('chat')
    .listen('MessageSent', (e) => {
        state.messages.push({
            message: e.message.message,
            user: e.user
        });
    });

</script>

<template>
    <AuthenticatedLayout>
        <div class="py-3">
            <div class="mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div>
                        <div class="h-32"></div>

                        <div class="container mx-auto" style="margin-top: -128px;">
                            <div class="py-6 h-screen">
                                <div class="flex border border-grey rounded shadow-lg h-full">
                                    <div class="w-full border flex flex-col">
                                        <div
                                            class="py-2 px-3 bg-grey-lighter flex flex-row justify-between items-center">
                                            <div class="flex items-center">
                                                <div class="ml-4">
                                                    <p class="text-grey-darkest">
                                                        Chat
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                        <ChatMessages :messages="messages"></ChatMessages>
                                        <ChatForm v-on:messagesent="addMessage" :user="$page.props.auth.user"></ChatForm>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
