<template>

    <div class="shadow rounded cursor-pointer text-sm p-2 px-4 mr-2 mt-2 select-none whitespace-nowrap hover:bg-primary-400 active:ring ring-primary-200 dark:ring-gray-600"
         :class="{
            'bg-primary-500 text-gray-800 font-bold': active,
            'bg-gray-800 text-gray-400': !active
         }">

        <slot/>

    </div>

</template>

<script>

    export default {
        name: 'Pill',
        props: {
            active: {
                type: Boolean,
                required: true
            }
        }
    }

</script>
