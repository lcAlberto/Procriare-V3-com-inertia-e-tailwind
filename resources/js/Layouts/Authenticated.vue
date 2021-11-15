<template>
    <div class="flex gap-0 spacing-0">
        <aside class="fixed max-w-xs w-20">
            <div
                class="absolute flex top-0 h-screen z-0"
                :class="[right ? 'right-0 flex-row' : 'left-0 flex-row-reverse']">
                <div
                    ref="content"
                    class="transition-all duration-700 bg-indigo-500 overflow-y-auto flex justify-center"
                    :class="[open ? 'max-w-sm' : 'max-w-0']">
                    <div class="text-white">
                        <ul class="h-full flex flex-col p-3 overflow-auto">
                            <li class="w-full p-2 mb-8">
                                <img :src="'/assets/img/brands/112232.png'" alt="img" width="100" height="50"
                                     class="m-auto">
                            </li>
                            <li class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-tachometer"></i> Dashboard
                                </a>
                            </li>

                            <li v-if="can('farms index')"
                                class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-hat-cowboy-side"></i> Fazendas
                                </a>
                            </li>

                            <li v-if="can('users index')" @click="toggleUsersDropdown"
                                class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-users"></i> Usuários
                                </a>
                            </li>

                            <transition
                                enter-active-class="transition ease-out duration-200"
                                enter-from-class="transform opacity-0 scale-95"
                                enter-to-class="transform opacity-100 scale-100"
                                leave-active-class="transition ease-in duration-75"
                                leave-from-class="transform opacity-100 scale-100"
                                leave-to-class="transform opacity-0 scale-95">
                                <li
                                    v-show="showUsersDropdown"
                                    class="bg-white text-gray-800 cursor-pointer px-3 py-2 rounded-b-md border border-transparent hover:border-white mx-1 transition duration-150 ease-in-out"
                                    style="display: none">
                                    <div class="flex flex-col gap-2">
                                        <a class="w-11/12 hover:text-indigo-500">
                                            Clientes
                                        </a>
                                        <a class="w-11/12 hover:text-indigo-500">
                                            Funcionários
                                        </a>
                                    </div>
                                </li>
                            </transition>

                            <li class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-paw"></i> Animals
                                </a>
                            </li>

                            <li class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-venus-mars"></i> Cios
                                </a>
                            </li>

                            <li class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-briefcase-medical"></i> Tratamentos
                                </a>
                            </li>

                            <li class="text-center cursor-pointer px-6 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-syringe"></i> Medicamentos
                                </a>
                            </li>

                            <li class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-id-card-alt"></i> Auditoria
                                </a>
                            </li>

                            <li class="text-center cursor-pointer px-9 py-2 rounded-md border border-transparent hover:border-white mx-1">
                                <a class="w-11/12">
                                    <i class="fas fa-file-contract"></i> Planos
                                </a>
                            </li>

                            <li class="text-center cursor-pointer mt-auto mx-1">
                                <a class="border border-transparent hover:border-white rounded-full px-4 py-3"
                                   @click="toggle"
                                   title="Esconder painel">
                                    <i class="fas fa-angle-double-left"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <transition name="fade">
                <!-- Dimmer -->
                <div
                    v-if="dimmer && open"
                    @click="toggle()"
                    class="flex-1 bg-gray-400 bg-opacity-75 active:outline-none z-0"
                />
            </transition>
        </aside>

        <div :class="dimmer && open ? 'md:w-90 ml-auto' : 'w-full'" class="bg-gray-200">

            <nav class="bg-white border-b border-gray-100">
                <!-- Primary Navigation Menu -->
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="flex justify-between h-10">
                        <div class="flex">
                            <!-- Logo -->
                            <div class="flex flex-shrink-0 items-center">
                                <span v-if="!open" class="cursor-pointer" @click.prevent="toggle()">
                                    <i class="fas fa-list"></i>
                                </span>
                            </div>

                            <!-- Navigation Links -->
                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <BreezeNavLink v-if="role === 'root'" :href="route('root.dashboard')"
                                               :active="route().current('root.dashboard')">
                                    Dashboard
                                </BreezeNavLink>
                                <BreezeNavLink v-if="role === 'admin'" :href="route('admin.dashboard')"
                                               :active="route().current('admin.dashboard')">
                                    Dashboard
                                </BreezeNavLink>
                                <BreezeNavLink v-if="role === 'client'" :href="route('client.dashboard')"
                                               :active="route().current('client.dashboard')">
                                    Dashboard
                                </BreezeNavLink>
                            </div>

                            <div class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex">
                                <BreezeNavLink :href="route('root.users.index')"
                                               :active="route().current('root.users.index')">
                                    Users
                                </BreezeNavLink>
                            </div>
                        </div>

                        <div class="hidden sm:flex sm:items-center sm:ml-6">
                            <!-- Settings Dropdown -->
                            <div class="ml-3 relative">
                                <BreezeDropdown align="right" width="48">
                                    <template #trigger>
                                        <span class="inline-flex rounded-md">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                                {{ $page.props.auth.user.name }}

                                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd"
                                                          d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                                          clip-rule="evenodd"/>
                                                </svg>
                                            </button>
                                        </span>
                                    </template>

                                    <template #content>
                                        <BreezeDropdownLink :href="route('logout')" method="post" as="button">
                                            Log Out
                                        </BreezeDropdownLink>
                                    </template>
                                </BreezeDropdown>
                            </div>
                        </div>

                        <!-- Hamburger -->
                        <div class="-mr-2 flex items-center sm:hidden">
                            <button @click="showingNavigationDropdown = ! showingNavigationDropdown"
                                    class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                                    <path
                                        :class="{'hidden': showingNavigationDropdown, 'inline-flex': ! showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 6h16M4 12h16M4 18h16"/>
                                    <path
                                        :class="{'hidden': ! showingNavigationDropdown, 'inline-flex': showingNavigationDropdown }"
                                        stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M6 18L18 6M6 6l12 12"/>
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Responsive Navigation Menu -->
                <div :class="{'block': showingNavigationDropdown, 'hidden': ! showingNavigationDropdown}"
                     class="sm:hidden">
                    <div class="pt-2 pb-3 space-y-1">
                        <!--                        <BreezeResponsiveNavLink :href="route('dashboard')" :active="route().current('dashboard')">-->
                        <!--                            Dashboard-->
                        <!--                        </BreezeResponsiveNavLink>-->
                    </div>

                    <!-- Responsive Settings Options -->
                    <div class="pt-4 pb-1 border-t border-gray-200">
                        <div class="px-4">
                            <div class="font-medium text-base text-gray-800">{{ $page.props.auth.user.name }}</div>
                            <div class="font-medium text-sm text-gray-500">{{ $page.props.auth.user.email }}</div>
                        </div>

                        <div class="mt-3 space-y-1">
                            <BreezeResponsiveNavLink :href="route('logout')" method="post" as="button">
                                Log Out
                            </BreezeResponsiveNavLink>
                        </div>
                    </div>
                </div>
            </nav>

            <main>
                <div class="mt-3 h-full">
                    <header class="bg-white w-full h-16 shadow" v-if="$slots.header">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            <slot name="header"/>
                        </div>
                    </header>
                    <slot/>
                </div>
            </main>
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import BreezeDropdown from '@/Components/Dropdown.vue'
import BreezeDropdownLink from '@/Components/DropdownLink.vue'
import BreezeNavLink from '@/Components/NavLink.vue'
import BreezeResponsiveNavLink from '@/Components/ResponsiveNavLink.vue'
import {Link} from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        BreezeDropdown,
        BreezeDropdownLink,
        BreezeNavLink,
        BreezeResponsiveNavLink,
        Link,
    },

    props: {
        // user: Object,
        // permissions: Array,
        // role: String,
    },

    computed: {
        role() {
            return this.$page.props.auth.role;
        }
    },

    data() {
        return {
            showingNavigationDropdown: false,
            showUsersDropdown: false,
            open: true,
            dimmer: true,
            right: false,
        }
    },

    methods: {
        toggle() {
            this.open = !this.open;
        },
        toggleUsersDropdown() {
            this.showUsersDropdown = !this.showUsersDropdown;
        },

        can(permission) {
            return this.$page.props.auth.permissions.includes(permission);
        },
    }
}
</script>
