<template>
    <Head title="Dashboard"/>

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
                </template>
            </breadcrumb>
        </template>

        <div class="md:py-12 md:p-10 sm:p-3">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex flex-col items-stretch md:items-center md:flex-row space-y-4 items-center md:justify-between sm:justify-center">
                            <div class="">
                                <h1>Fazendas</h1>
                            </div>
                            <div class="md:w-1/2 flex justify-center">
                                <input type="text" name="search"
                                       class="py-2 px-1 w-max rounded-l-md shadowl-md border border-indigo-200 focus:border-indigo-500 hover:border-indigo-700 focus:ring-0 outline-none">
                                <a href="#"
                                   class="py-2 px-4 bg-transparent border border-l-none border-indigo-200 text-gray-600 font-semibold rounded-r-lg shadow-md hover:bg-gray-700 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-opacity-75"
                                   title="Clique para pesquisar">
                                    <i class="fa fa-search"></i>
                                </a>
                            </div>
                            <a :href="route('root.farms.create')" class="btn-primary">
                                <i class="fa fa-plus mr-2"></i>
                                Nova Fazenda
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'
import {Head} from '@inertiajs/inertia-vue3';
import Breadcrumb from "@/Components/Breadcrumb/Breadcrumb";
import BreadcrumbItem from "@/Components/Breadcrumb/BreadcrumbItem";

export default {
    name: "index",
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
