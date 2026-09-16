<template>
    <button :type="type" class="inline-flex items-center px-3 py-1.5 bg-primary border border-transparent rounded-sm font-semibold text-xs text-white active:bg-secondary focus:outline-none transition ease-in-out duration-150">
        <slot></slot>
    </button>
</template>

<script>
    export default {
        props: {
            type: {
                type: String,
                default: 'submit',
            },
        }
    }
</script>
