<template>
    <nav aria-label="breadcrumb" class="flex">
        <ol class="flex w-full">
            <li v-if="header" class="mr-1" :class="customTextColor ? customTextColor : 'text-gray-500'">
                <i v-if="icon" :class="icon"></i>
                {{ header }}
            </li>
            <li> 》</li>
            <li :class="customTextColor ? customTextColor : 'text-gray-500'">
                <slot name="breadcrumb-item">
                    <breadcrumb-item></breadcrumb-item>
                </slot>
            </li>
        </ol>
    </nav>
</template>

<script>
import BreadcrumbItem from "@/Components/Breadcrumb/BreadcrumbItem";
export default {
    name: "Breadcrumb",
    components: {BreadcrumbItem},
    props: {
        header: {
            type: String,
            required: false,
        },
        icon:{
            type: String,
            required: false,
        },
        customTextColor: {
            type: String,
            required: false
        }
    },
}
</script>
<style>
.breadcrumb{
    background-color: rgba(0,0,0,0.0);
    /*background-image: linear-gradient(to right, rgba(0,0,0,1), transparent);*/
    opacity: 100%;
}
</style>
