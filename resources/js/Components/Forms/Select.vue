<template>
    <div class="space-y-1 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-25">
        <div class="relative mt-1 focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-25" v-click-outside="closeSelect">
            <span class="inline-block w-full rounded-md shadow-sm focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-25">
                <button type="button" @click="openSelect = !openSelect" aria-haspopup="listbox" aria-expanded="true"
                        aria-labelledby="listbox-label"
                        :disabled="disabled"
                        class="relative w-full text-left truncate border appearance-none border-gray-300 px-3 py-1.5 text-sm cursor-pointer focus:border-primary focus:ring focus:ring-primary focus:ring-opacity-25 rounded-sm shadow-sm">
<!--                    <div class="flex items-center space-x-3">-->
<!--                        <span class="block truncate">-->
                            {{ value }}
<!--                        </span>-->
<!--                    </div>-->
                    
                    <span class="absolute inset-y-0 right-0 flex items-center pr-2 pointer-events-none">
                        <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="none" stroke="currentColor">
                            <path d="M7 7l3-3 3 3m0 6l-3 3-3-3" stroke-width="1.5" stroke-linecap="round"
                                  stroke-linejoin="round" />
                        </svg>
                    </span>
                </button>
            </span>
            <transition
                    enter-active-class="transition ease-out duration-300"
                    enter-class="transform opacity-0 translate-y-10 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-150"
                    leave-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 translate-y-5 scale-95">
                <div v-show="openSelect" class="absolute mt-1 w-full rounded-md bg-white shadow-lg">
                    <ul tabindex="-1" role="listbox" aria-labelledby="listbox-label"
                        aria-activedescendant="listbox-item-3"
                        class="max-h-56 rounded-md py-1 text-sm leading-6 shadow-xs overflow-auto focus:outline-none sm:text-sm sm:leading-5">
                        <li tabindex="0" @click="select(item)" @keypress.enter="select(item)" @keypress.space="select(item)" id="listbox-item-0" role="option"
                            v-for="item in list"
                            :key="item.id"
                            class="text-gray-500 hover:text-gray-600 hover:bg-gray-100 select-none relative py-1.5 pl-3 pr-9 cursor-pointer">
                            <div class="flex items-center space-x-3">
                                <span class="block truncate"
                                      :class="{ 'font-normal' : !isSelected(item) , 'font-semibold' : isSelected(item)}">
                                    {{ item.name }}
                                </span>
                            </div>
                            <span v-show="isSelected(item)" class="absolute inset-y-0 right-0 flex items-center pr-4">
                                <svg class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd"
                                          d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                          clip-rule="evenodd" />
                                </svg>
                            </span>
                        </li>
                    </ul>
                </div>
            </transition>
        </div>
    </div>
</template>

<script>
import vClickOutside from 'v-click-outside'

export default {
    name: 'Select',
    props: {
        list: Array,
        value: String,
        disabled: {
            type: Boolean,
            default: false,
        }
    },
    data() {
        return {
            openSelect: false
        }
    },
    methods: {
        isSelected(value) {
            return this.value === value;
        },
        
        closeSelect() {
          this.openSelect = false;
        },

        select(value) {
            this.closeSelect();
            this.$emit('value', value = {'id': value.id, 'name': value.name});
        }
    },

    directives: {
        clickOutside: vClickOutside.directive
    },
}
</script>
