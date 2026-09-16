<template>
    <v-app>
        <v-app-bar app clipped-left fixed elevate-on-scroll dense :dark="dark">
            <!-- Actioner for visible/invisible bar side -->
            <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>

            <v-toolbar-title>
                <slot name="toolbarTitle"></slot>
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon>
                <v-icon>mdi-magnify</v-icon>
            </v-btn>

            <v-btn icon>
                <v-icon @click="changeTheme">mdi-theme-light-dark</v-icon>
            </v-btn>

            <!-- Vertical menu. Open options in the top appbar -->
            <v-menu bottom left>
                <template v-slot:activator="{ on, attrs }">
                    <v-btn icon v-bind="attrs" v-on="on">
                        <v-icon>mdi-dots-vertical</v-icon>
                    </v-btn>
                </template>

                <v-list>
                    <v-list-item v-for="n in 5" :key="n" @click="() => {}">
                        <v-list-item-title>Option {{ n }}</v-list-item-title>
                    </v-list-item>
                </v-list>
            </v-menu>
        </v-app-bar>

        <!-- Bar side -->
        <!-- Profile information -->
        <v-navigation-drawer app v-model="drawer" clipped :dark="dark">
            <template #prepend>
                <v-list-item two-line>
                    <v-list-item-avatar>
                        <img :src="$page.props.user.profile_photo_url" :alt="$page.props.user.name" />
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>
                            {{ $page.props.user.name }}
                        </v-list-item-title>
                        <v-list-item-subtitle>
                            {{ $page.props.user.email }}
                        </v-list-item-subtitle>
                    </v-list-item-content>
                </v-list-item>
            </template>

            <!-- Link items of Worksheet -->
            <v-list nav dense flat :dark="dark">
                <v-list-item-group v-model="group" mandatory color="primary" :dark="dark">
                    <v-list-item
                            v-for="(item, i) in items"
                            :key="i"
                            :href="route(item.to)"
                            input-value="'ok'"
                    >
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item>
                </v-list-item-group>
            </v-list>
            <v-spacer></v-spacer>

            <!-- End of the drawer -->
            <template #append>
                <!-- Button to exit from Worksheet -->
                <v-btn
                        plain
                        block
                        @click="logout"
                        color="red"
                        class="d-flex justify-space-center"
                >
                    Logout
                    <v-icon right>mdi-exit-to-app</v-icon>
                </v-btn>
            </template>
        </v-navigation-drawer>

        <v-main>
            <v-container>
                <slot name="main"></slot>
            </v-container>
        </v-main>

        <v-footer app fixed>
            <p class="mb-0"> <small> Copyright (c) 2021. Lorem ipsum dolor sit amet, consectetur adipiscing elit. </small> </p>
        </v-footer>
    </v-app>
</template>

<script>

export default {
    components: {},

    data() {
        return {
            group: 0,
            drawer: false,
            dark: false,
            items: [
                {
                    title: 'Index',
                    to: 'worksheet.index',
                    icon: 'mdi-home'
                },
                {
                    title: 'New worksheet',
                    to: 'worksheet.new',
                    icon: 'mdi-newspaper'
                },
            ],
        };
    },

    methods: {
        logout() {
            this.$inertia.post(route("logout"));
        },

        changeTheme() {
            this.dark = !this.dark
            this.$vuetify.theme.dark = this.dark
        }
    },

    mounted() {
        // console.log(this.$page.props.user);
    }
};
</script>
