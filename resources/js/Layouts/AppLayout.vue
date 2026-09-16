<template>
    <div>
        <jet-banner />
        <nav class="bg-gray-50 shadow fixed w-full z-50">
            <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
                <div class="relative flex items-center justify-between h-16">
                    <div class="absolute inset-y-0 left-0 flex items-center sm:hidden">
                        <!-- Mobile menu button-->
                        <button
                                @click="mobileMenu = !mobileMenu"
                                class="inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:text-gray-500"
                                aria-expanded="false">
                            <span class="sr-only">Open main menu</span>
                            <svg class="block h-6 w-6 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            <svg class="hidden h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                                 viewBox="0 0 24 24"
                                 stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            </button>
                    </div>
                    
                    <div class="flex-1 flex items-center justify-center sm:items-stretch sm:justify-start">
                        <div class="flex-shrink-0 flex items-center">
                            <application-logo class="hidden lg:block h-9 w-auto"></application-logo>
                            <jet-application-mark class="block lg:hidden h-9 w-auto"></jet-application-mark>
                        </div>
                        
                        <div class="hidden sm:block sm:ml-6">
                            <div class="flex space-x-4">
                                <a v-for="(link, i) in linksNavbar" :key="i" :href="route(link.url)"
                                   class="text-gray-400 hover:text-gray-500 px-3 py-2 text-sm font-medium"> {{
                                        link.page
                                    }} </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
                        <!-- Guest Dropdown -->
                        <div class="ml-3 relative focus:outline-black">
                            <div>
                                <button
                                        @click="showWelcomeDropdown = !showWelcomeDropdown"
                                        class="inline-flex items-center justify-center p-2 rounded-full text-gray-400 hover:text-gray-500"
                                        id="user-menu" aria-haspopup="true">
                                    <span class="sr-only">Open user menu</span>
                                    <span class="text-sm px-1 md:block hidden">{{
                                            $page.props.user ? $page.props.user.email : 'Guest'
                                        }}
                                    </span>
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                         stroke="currentColor" class="h-6 w-6 md:hidden block">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor"
                                         class="h-6 w-6">
                                        <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                                    </svg>
                                </button>
                            </div>
                            <transition
                                    enter-active-class="transition ease-out duration-200"
                                    enter-class="transform opacity-0 scale-95"
                                    enter-to-class="transform opacity-100 scale-100"
                                    leave-active-class="transition ease-in duration-75"
                                    leave-class="transform opacity-100 scale-100"
                                    leave-to-class="transform opacity-0 scale-95">
                                <div
                                        v-show="showWelcomeDropdown"
                                        class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow py-1 bg-gray-50 ring-1 ring-black ring-opacity-5 divide-y divide-gray-200"
                                        role="menu" aria-orientation="vertical" aria-labelledby="user-menu">
                                    <a v-if="!existsUser" :href="route('login')"
                                       class="block px-4 py-2 text-sm text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                                       role="menuitem">
                                        Login
                                    </a>
                                    <a v-if="!existsUser" :href="route('third.new')"
                                       class="block px-4 py-2 text-sm text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                                       role="menuitem">
                                        Register
                                    </a>
                                    <div v-if="existsUser" class="py-1">
                                        <span class="block px-4 py-2 text-xs text-gray-300">Apps</span>
                                        <a :href="route('worksheet.index')"
                                           class="block pl-6 py-2 text-sm text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                                           role="menuitem">
                                            Worksheet
                                        </a>
                                        <a :href="route('profile.show')"
                                           class="block pl-6 py-2 text-sm text-gray-400 hover:text-gray-500 hover:bg-gray-100"
                                           role="menuitem">
                                            Update my profile
                                        </a>
                                    </div>
                                    <form @submit.prevent="logout" v-if="existsUser" class="block pt-1">
                                        <button type="submit" role="menuitem"
                                                class="w-full px-4 py-2 text-sm text-red-300 hover:text-red-500 hover:bg-red-50 inline-flex items-center justify-between">
                                            Logout
                                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                 stroke="currentColor" class="w-5 h-5">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </transition>
                        </div>
                    </div>
                </div>
            </div>
            <transition
                    enter-active-class="transition ease-out duration-300"
                    enter-class="transform opacity-0 translate-y-10 scale-95"
                    enter-to-class="transform opacity-100 scale-100"
                    leave-active-class="transition ease-in duration-150"
                    leave-class="transform opacity-100 scale-100"
                    leave-to-class="transform opacity-0 translate-y-5 scale-95">
                <div v-show="mobileMenu" class="px-2 pt-2 pb-3 space-y-1">
                    <a v-for="(link, i) in linksNavbar" :key="i" :href="route(link.url)"
                       class="text-gray-400 hover:text-gray-500 block px-3 py-2 text-base font-medium"> {{
                            link.page
                        }} </a>
                </div>
            </transition>
        </nav>
        
        <main class="max-w-7xl mx-auto pt-24 pb-8 sm:px-6 lg:px-8">
            <slot name="content"></slot>
        </main>
        
        <portal-target name="modal" multiple></portal-target>
    </div>

</template>

<script>
import ApplicationLogo from "@/Jetstream/ApplicationLogo";
import JetApplicationMark from "@/Jetstream/ApplicationMark";
import JetBanner from "@/Jetstream/Banner";
import vClickOutside from 'v-click-outside'

export default {
    components: {
        ApplicationLogo,
        JetApplicationMark,
        JetBanner
    },

    props: {
        canLogin: Boolean,
        canRegister: Boolean,
    },

    data() {
        return {
            showWelcomeDropdown: false,
            mobileMenu: false,
            linksNavbar: [
                {'page': 'Nosotros', 'url': 'about'},
                {'page': 'Servicios', 'url': 'services'},
                {'page': 'Contacto', 'url': 'contact'},
            ]
        };
    },

    mounted() {
         // console.log(this.$page.props.user)
    },

    computed: {
        existsUser() {
            return this.$page.props.user
        }
    },

    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },
        
        closeDropdown() {
            this.showWelcomeDropdown = false;
        }
    },
    
    directives: {
        clickOutside: vClickOutside.directive
    }
};
</script>
