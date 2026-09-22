// Minimal Vue 3 replacement for the `v-click-outside` npm package (which only supports
// Vue 2). Usage is unchanged: v-click-outside="handler".
export default {
    beforeMount(el, binding) {
        el.__clickOutsideHandler__ = (event) => {
            if (!(el === event.target || el.contains(event.target))) {
                binding.value(event);
            }
        };
        document.addEventListener('click', el.__clickOutsideHandler__, true);
    },
    unmounted(el) {
        document.removeEventListener('click', el.__clickOutsideHandler__, true);
        delete el.__clickOutsideHandler__;
    },
};
