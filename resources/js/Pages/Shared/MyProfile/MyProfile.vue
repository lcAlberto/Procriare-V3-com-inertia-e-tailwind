<template>
  <Head title="Meu perfil" />

  <BreezeAuthenticatedLayout>
    <template #header class="">
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
      <div class="flex gap-4 w-full xl:max-w-full mx-auto sm:px-6 lg:px-5">
        <div class="bg-white w-3/4 overflow-hidden shadow-sm sm:rounded-lg shadow-xl">
          <div class="p-6 bg-white border-b border-gray-200 grid gap-4">
            <fieldset class="border border-gray-300 rounded-md p-5">
              <legend class="text-gray-500 px-5">Pessoal data</legend>
              <p class="text-gray-400 text-sm">Dados relacionados a você e contato</p>
              <form @submit.prevent="submitPersonal()">
                <div class="flex flex-col justify-center p-2">
                  <div class="mb-2">
                    <label for="name" class="text-gray-600">Name:</label>
                    <input id="name" class="py-2 px-1 w-full rounded-md shadowl-md border border-indigo-200 focus:border-indigo-500 hover:border-indigo-800 focus:ring-0 outline-none" v-model="pessoalData.name" />
                  </div>
                  <div class="mb-2">
                    <label for="phone" class="text-gray-600">Phone:</label>
                    <input id="phone" class="py-2 px-1 w-full rounded-md shadowl-md border border-indigo-200 focus:border-indigo-500 hover:border-indigo-800 focus:ring-0 outline-none" v-model="pessoalData.phone" />
                  </div>
                  <div class="mb-2">
                    <label for="email" class="text-gray-600">email:</label>
                    <input id="email" class="py-2 px-1 w-full rounded-md shadowl-md border border-indigo-200 focus:border-indigo-500 hover:border-indigo-700 focus:ring-0 outline-none" v-model="pessoalData.email" />
                  </div>
                  <button type="submit" class="w-1/5 px-1 py-2 mx-auto rounded-md text-white bg-green-500 hover:bg-green-800">Submit</button>
                </div>
              </form>
            </fieldset>
            <fieldset class="border border-gray-300 rounded-md p-5">
              <legend class="text-gray-500 px-5">Update password</legend>
              <p class="text-gray-400 text-sm">Altere sua senha</p>
              <form @submit.prevent="submitPersonal()">
                <div class="flex flex-col justify-center p-2">
                  <div class="mb-2">
                    <label for="name" class="text-gray-600">Senha atual:</label>
                    <input id="name" @change="validatePassword()" class="py-2 px-1 w-full rounded-md shadowl-md border border-indigo-200 focus:border-indigo-500 hover:border-indigo-800 focus:ring-0 outline-none" v-model="pessoalData.name" />
                  </div>
                  <div class="mb-2">
                    <label for="phone" class="text-gray-600">Nova senha:</label>
                    <input id="phone" class="py-2 px-1 w-full rounded-md shadowl-md border border-indigo-200 focus:border-indigo-500 hover:border-indigo-800 focus:ring-0 outline-none" v-model="pessoalData.phone" />
                  </div>
                  <div class="mb-2">
                    <label for="email" class="text-gray-600">Confirmação de senha:</label>
                    <input id="email" class="py-2 px-1 w-full rounded-md shadowl-md border border-indigo-200 focus:border-indigo-500 hover:border-indigo-700 focus:ring-0 outline-none" v-model="pessoalData.email" />
                  </div>
                  <button type="submit" class="w-1/5 px-1 py-2 mx-auto rounded-md text-white bg-green-500 hover:bg-green-800">Submit</button>
                </div>
              </form>
            </fieldset>
          </div>
        </div>
        <div class="bg-white w-1/4 overflow-hidden shadow-sm sm:rounded-lg">
          <div
            class="
              flex flex-col
              items-center
              justify-center
              p-6
              bg-white
              border-b border-gray-200
            "
          >
            <div class="absolute -mt-30">
              <img
                src="https://thispersondoesnotexist.com/image"
                alt="imagem de perfil, clique para editar"
                width="150"
                height="150"
                class="rounded-full shadow lg"
              />
            </div>
          </div>
          <div class="mt-20 flex flex-col items-center justify-center">
            <h1 class="text-2xl text-indigo-500 bold">
              {{ $page.props.auth.user.name }}
            </h1>
            <span
              class="text-white py-1 px-3 rounded-md"
              :class="getRoleBadgeColor()"
              >{{ userRole }}</span
            >
            <span class="mt-2">Fazenda:</span>
            <h2 class="text-xl bold text-indigo-400">{{ userFarm }}</h2>
          </div>
          <div class="mt-2 mb-10 grid grid-cols-3 text-center">
            <div class="">
              <span>Lactantes</span>
              <h2 class="bold text-lg">32</h2>
            </div>
            <div>
              <span>Lactantes</span>
              <h2 class="bold text-lg">32</h2>
            </div>
            <div>
              <span>Lactantes</span>
              <h2 class="bold text-lg">32</h2>
            </div>
          </div>
        </div>
      </div>
    </div>
  </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.vue";
import { Head } from "@inertiajs/inertia-vue3";
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

  data() {
    return {
      pessoalData: {
        name: "",
        phone: "",
        email: "",
      },
      passwordData: {
        password: "",
        confirmPassword: "",
      },
      imagedata: "",
    };
  },

  computed: {
    userRole() {
      return this.$page.props.auth.user.roles[0].name || "Sem Cargo definido";
    },
    userFarm() {
      console.log(this.$page.props.auth.user.farm);
      return this.$page.props.auth.user.farm || "Sem Fazenda";
    },
  },

  methods: {
    getRoleBadgeColor() {
      switch (this.userRole) {
        case "root":
          return "bg-gray-700";
          break;
        case "admin":
          return "bg-indigo-500";
          break;
        case "client":
          return "bg-yellow-300";
          break;
        default:
          return "bg-gray-200 text-gray-500";
      }
    },
    submitPersonal() {
      // this.$inertia.post('/users', this.form)
      console.log("sending");
    },
    submitPassword() {
      // this.$inertia.post('/users', this.form)
      console.log("sending");
    },
    submitThumbnIL() {
      // this.$inertia.post('/users', this.form)
      console.log("sending");
    },
    validatePassword() {
        console.log('trazer a senhan do back e comparar com a atual')
    }
  },
};
</script>

<style scoped>
</style>
