<template>
    <nav aria-label="breadcrumb" class="flex">
        <ol class="flex w-full">
            <li v-if="header" class="mr-1 text-gray-500">
                <i v-if="icon" :class="icon"></i>
                {{ header }}
            </li>
            <li> 》</li>
            <li class="text-gray-500">
                <slot name="breadcrumb-item"></slot>
            </li>
        </ol>
    </nav>
</template>

<script>
export default {
    name: "Breadcrumb",

    props: {
        header: {
            type: String,
            required: false,
        },
        icon:{
            type: String,
            required: false,
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
