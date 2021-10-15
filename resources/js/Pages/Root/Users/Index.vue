<template>
    <Head title="Dashboard" />

    <BreezeAuthenticatedLayout>
        <template #header>
            <breadcrumb header="home" icon="fas fa-home">
                <slot slot="breadcrumb-item">
                    sdfgh<i class="fas fa-home"></i>
                </slot>
            </breadcrumb>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in my procriareprocriare!!!
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import { Head } from '@inertiajs/inertia-vue3';
import Breadcrumb from "@/Components/Breadcrumb/Breadcrumb";
export default {
    name: "Index",
    components: {
        Breadcrumb,
        BreezeAuthenticatedLayout,
        Head,
    },
}
</script>

<style scoped>

</style>
