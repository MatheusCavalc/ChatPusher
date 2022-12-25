<script setup>
const props = defineProps(['user'])

const emit = defineEmits(['messagesent']);

const myInput = ''

</script>

<template>
    <div class="bg-grey-lighter px-4 py-4 flex items-center">
        <div class="flex-1 mx-4">
            <input id="btn-input"
                   class="w-full border rounded px-2 py-2"
                   type="text"
                   placeholder="Type your message here..."
                   v-model="myInput"
                   @keydown.enter="$emit('messagesent', {user: props.user, message: myInput})"
                   @keyup.enter="myInput = ''"
            />
        </div>
        <div>
            <button @click="$emit('messagesent', {user: props.user, message: myInput})">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 12L3.269 3.126A59.768 59.768 0 0121.485 12 59.77 59.77 0 013.27 20.876L5.999 12zm0 0h7.5" /></svg>
            </button>
        </div>
    </div>
</template>
