<script setup>
import moment from 'moment'

const props = defineProps(['messages'])

const time = (iso) => {
    return moment(iso).format('h:mm a');
}
</script>

<template>
    <div class="flex-1 overflow-auto bg-stone-300">
        <div class="py-2 px-3">
            <div class="flex mb-2" v-for="message in messages" :key="message.id">
                <div class="rounded py-2 px-3 bg-slate-100">
                    <p class="text-sm text-teal font-bold">
                        {{ message.user.name }}
                    </p>
                    <p class="text-sm mt-1 font-normal">
                        {{ message.message }}
                    </p>
                    <p class="text-right text-xs text-grey-dark mt-1">
                        {{ time(message.created_at) }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</template>
