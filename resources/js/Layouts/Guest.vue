<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-img-login xs:bg-red-500">
        <div>
            <Link href="/">
                <BreezeApplicationLogo class="w-100 h-100 fill-current text-gray-500" />
            </Link>
        </div>

        <div class="w-full text-white sm:max-w-md mt-6 px-6 py-4 bg-white-transparent shadow-md overflow-hidden sm:rounded-md">
            <slot />
        </div>
    </div>
</template>

<script>
import BreezeApplicationLogo from '@/Components/ApplicationLogo.vue'
import { Link } from '@inertiajs/inertia-vue3';

export default {
    components: {
        BreezeApplicationLogo,
        Link,
    }
}
</script>

<style>
.bg-white-transparent{
    background-color: rgba(255, 255, 255, 0.50) !important;
}
.bg-img-login{
    background-image: url('/assets/img/backgrounds/auth.jpg');
    background-size: 100%;
}
.bg-img-login-sm{
    background-image: url('/assets/img/backgrounds/auth.jpg');
    background-repeat: no-repet;
    /*background-size: 100%;*/
}
</style>
