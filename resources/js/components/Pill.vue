<template>

    <div class="rounded-lg form-control cursor-pointer dim text-sm p-2 px-4 mr-2 mt-2 select-none whitespace-no-wrap"
         :class="{ 'bg-primary text-white': active, 'bg-20': !active }">

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
