<template>
    <Head title="Meu perfil"/>

    <BreezeAuthenticatedLayout>
        <template #header>
            <breadcrumb header="home" icon="fas fa-home">
                <template slot="breadcrumb-item">
                    <breadcrumb-item href="/home">
                        <span class="text-white">
                          <i class="mr-1 fa fa-home"></i>
                          dfghj
                        </span>
                    </breadcrumb-item>
                    <breadcrumb-item href="/home">
                        <span class="text-white">
                          <i class="mr-1 fa fa-home"></i>
                          Perfil
                        </span>
                    </breadcrumb-item>
                </template>
            </breadcrumb>
        </template>

        <div class="pb-12">
            <div class="flex gap-4 w-11/12 xl:max-w-full mx-auto sm:px-6 lg:px-5">
                <div class="bg-white w-3/4 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Perfil do Admin
                    </div>
                </div>
                <div class="bg-white w-1/4 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        Perfil do Admin
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';
import BreadcrumbItem from "@/Components/Breadcrumb/BreadcrumbItem";
import Breadcrumb from "@/Components/Breadcrumb/Breadcrumb";

export default {
    name: "MyProfile",

    components: {
        BreadcrumbItem,
        Breadcrumb,
        BreezeAuthenticatedLayout,
        Head,
    },
}
</script>

<style scoped>

</style>
