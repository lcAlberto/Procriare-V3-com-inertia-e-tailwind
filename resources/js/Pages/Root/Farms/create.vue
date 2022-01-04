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
                <div class="bg-white h-auto shadow-sm sm:rounded-lg">
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
                                            <input
                                                type="text"
                                                v-mask="'#####-###'"
                                                maxlength="9"
                                                placeholder="00000-000"
                                                id="postalCode"
                                                class="input-text"
                                                @blur="getPostalCode()"
                                                v-model="formData.postal_code"/>
                                        </div>
                                        <div class="mb-2">
                                            <label for="state" class="text-gray-600">Estado:</label>
                                            <Multiselect
                                                required
                                                searchable
                                                mode="single"
                                                :disabled="loading"
                                                noOptionsText="Nenhum estado encontrado"
                                                noResultsText="Nenhum estado encontrado"
                                                name="state"
                                                :loading="loading"
                                                v-model="formData.state"
                                                :options="states"
                                            />
                                        </div>
                                        <div class="mb-2">
                                            <label for="owner"
                                                   class="text-gray-600">Cidade:{{ formData.city_id }}</label>
                                            <Multiselect
                                                required
                                                searchable
                                                mode="single"
                                                :disabled="loading"
                                                noOptionsText="Nenhuma cidade encontrada"
                                                noResultsText="Nenhuma cidade encontrada"
                                                :loading="loading"
                                                v-model="selectedCity"
                                                :options="cities"
                                            />
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
import Multiselect from '@vueform/multiselect';
import {brStates} from "@/constants";
import { VueMaskDirective } from 'v-mask'

export default {
    name: "create",
    components: {
        BreadcrumbItem,
        Breadcrumb,
        BreezeAuthenticatedLayout,
        Head,
        Multiselect,
    },
    directives: {'mask': VueMaskDirective},
    created() {
        this.getStates()
    },
    data() {
        return {
            formData: this.$inertia.form({
                name: '',
                owner: '',
                postal_code: '',
                city: {},
                state: {},
            }),
            states: {},
            selectedState: [],
            cities: {},
            selectedCity: '',
            loading: false,
            mask: '#####-###'
        }
    },
    watch: {
        selectedState(value) {
            if (!this.formData.postal_code) {
                this.formData.state_id = value
                this.getCities()
            }
        },
        selectedCity(value) {
            console.log('city: ' + value);
            this.formData.city_id = value
        }
    },
    methods: {
        async getStates() {
            this.loading = true
            try {
                const response = await axios.get('/ajax/get-states')
                    .then(response => (
                        this.states = response.data
                    ))
                    .finally(
                        this.loading = false
                    )
            } catch (error) {
                this.$alert.open(error.response ? error.response.data.mensagem : 'Não foi possível encontrar o estado', 'error')
                this.loading = false
            }
        },
        async getCities() {
            this.loading = true
            console.log('aki');
            try {
                const response = await axios.get('/ajax/get-cities/' + this.selectedState)
                    .then(response => (
                        this.cities = response.data
                    ))
                    .finally(
                        this.loading = false
                    )
            } catch (error) {
                this.$alert.open(error.response ? error.response.data.mensagem : 'Não foi possível encontrar a cidade', 'error')
                this.loading = false
            }
        },
        getPostalCode() {
            if (this.formData.postal_code.length >= 8) {
                this.loading = true
                axios.get(`https://viacep.com.br/ws/${this.formData.postal_code}/json/`)
                    .then((response) => {
                        if (response.status === 200) {
                            this.formData.postal_code = response.data.cep
                            // this.getStateAbbr(response.data.uf)
                            // this.formData.city_id = response.data.ibge
                            this.loading = false
                        }
                    }).catch((error) => {
                    alert('CEP não encontrado!')
                })
            }
        },
        getStateAbbr(uf) {
            brStates().map((value, index) => {
                if (value.abbr === uf) {
                    this.selectedState = value
                }
            })
        },
        getCityName(cityName) {
            //
        },
        submitPersonal() {
            this.loading = true;
            // this.formData.state = this.selectedState;
            // this.formData.city = this.selectedCity;
            try {
                this.formData.post(this.route('root.farms.store'), {
                    onFinish: () => {}
                })
            } catch (error) {
                console.log(error);
            }
        }
    },
}
</script>

<style src="@vueform/multiselect/themes/default.css"></style>

