<template>
    <div class="min-h-screen bg-gray-100">
        <!-- Sidebar -->
        <aside
            class="fixed inset-y-0 left-0 z-30 w-64 bg-secondary text-white transform transition-transform duration-200 lg:translate-x-0"
            :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'"
        >
            <div class="h-16 flex items-center px-6 border-b border-gray-700">
                <Link :href="route('welcome')" class="font-semibold text-lg truncate">Arketops</Link>
            </div>

            <div class="px-6 py-4 border-b border-gray-700" v-if="$page.props.user">
                <img
                    class="h-10 w-10 rounded-full mb-2"
                    :src="$page.props.user.profile_photo_url"
                    :alt="$page.props.user.name"
                />
                <p class="text-sm font-medium truncate">{{ $page.props.user.name }}</p>
                <p class="text-xs text-gray-400 truncate">{{ $page.props.user.email }}</p>
            </div>

            <nav class="px-2 py-4 space-y-1">
                <Link
                    v-for="(item, i) in items"
                    :key="i"
                    :href="route(item.to)"
                    class="flex items-center px-4 py-2 rounded-md text-sm text-gray-200 hover:bg-gray-700"
                >
                    {{ item.title }}
                </Link>
            </nav>

            <div class="absolute bottom-0 left-0 right-0 p-4">
                <button
                    @click="logout"
                    class="w-full flex items-center justify-center px-4 py-2 rounded-md text-sm text-red-300 hover:bg-red-900 hover:text-red-200"
                >
                    Cerrar sesión
                </button>
            </div>
        </aside>

        <!-- Mobile overlay -->
        <div v-if="sidebarOpen" class="fixed inset-0 z-20 bg-black opacity-50 lg:hidden" @click="sidebarOpen = false"></div>

        <div class="lg:pl-64 flex flex-col min-h-screen">
            <!-- Topbar -->
            <header class="h-16 bg-white shadow flex items-center px-4 sm:px-6">
                <button class="lg:hidden mr-4 text-gray-500" @click="sidebarOpen = !sidebarOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-lg font-semibold text-gray-800">
                    <slot name="toolbarTitle"></slot>
                </h1>
            </header>

            <main class="flex-1 p-4 sm:p-6">
                <slot name="main"></slot>
            </main>

            <footer class="text-center text-xs text-gray-400 py-4">
                Copyright (c) {{ new Date().getFullYear() }}.
            </footer>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            sidebarOpen: false,
            items: [
                { title: 'Hojas de trabajo', to: 'worksheet.index' },
                { title: 'Nueva hoja de trabajo', to: 'worksheet.new' },
            ],
        };
    },

    methods: {
        logout() {
            this.$inertia.post(route('logout'));
        },
    },
};
</script>
