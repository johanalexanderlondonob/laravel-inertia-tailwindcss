<template>
    <input class="border-gray-300 px-3 py-1.5 text-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-25 rounded-sm shadow-sm"
           :value="value" @input="$emit('input', $event.target.value)" ref="input">
</template>

<script>
    export default {
        props: ['value'],

        methods: {
            focus() {
                this.$refs.input.focus()
            }
        }
    }
</script>

