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

        <div class="py-12 p-10">
            <div class="mx-auto">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex items-center justify-between">
                            <div><h1>Nva fazenda</h1>
                                <p> kjflkdsjfkl jlk hdfh dlkshldsf</p>
                            </div>
                            <a :href="route('root.farms.index')" class="btn-primary">
                                <i class="fa fa-arrow-left mr-2"></i>
                                Voltar
                            </a>
                        </div>
                        <div class="lg:mt-5 flex flex-col gap-4 w-full">
                            <fieldset class="border border-gray-300 rounded-md p-5">
                                <legend class="text-gray-500 px-5">Identificação</legend>
                                <form @submit.prevent="submitPersonal()" class="flex flex-col justify-center">
                                    <div class="grid md:grid-cols-2 sm:grid-cols-1 gap-4 justify-center p-2">
                                        <div class="mb-2">
                                            <label for="name" class="text-gray-600">Name:</label>
                                            <input id="name" name="name" class="input-text" v-model="formData.name"/>
                                        </div>
                                        <div class="mb-2">
                                            <label for="owner" class="text-gray-600">Owner:</label>
                                            <input id="owner" name="owner" class="input-text" v-model="formData.owner"/>
                                        </div>
                                    </div>
                                    <div class="grid md:grid-cols-3 sm:grid-cols-1 gap-4 justify-center p-2">
                                        <div class="mb-2">
                                            <label for="postalCode" class="text-gray-600">Postal Code:</label>
                                            <input id="postalCode" name="postal_code" class="input-text"
                                                   v-model="formData.postal_code"/>
                                        </div>
                                        <div class="mb-2">
                                            <label for="owner" class="text-gray-600">Owner:</label>
                                            <input id="owner" name="owner" class="input-text"
                                                   v-model="formData.city_id"/>
                                        </div><div class="mb-2">
                                            <label for="owner" class="text-gray-600">Owner:</label>
                                            <input id="owner" name="owner" class="input-text"
                                                   v-model="formData.city_id"/>
                                        </div>
                                    </div>
                                    <div class="mt-auto mx-auto w-1/5">
                                        <button type="submit"
                                                class="w-full px-1 py-2 mx-auto rounded-md text-white bg-green-500 hover:bg-green-800">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </fieldset>
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
    name: "create",
    components: {
        BreadcrumbItem,
        Breadcrumb,
        BreezeAuthenticatedLayout,
        Head,
    },
    data() {
        return {
            formData: {
                name: '',
                owner: '',
                postal_code: '',
                city_id: '',
                state_id: ''
            }
        }
    },
    methods: {
        submitPersonal() {
            console.log('submete')
        }
    }
}
</script>

<style scoped>

</style>
