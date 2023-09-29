<template>

    <button
        class="pill-element rounded cursor-pointer font-bold text-sm p-2 px-4 mr-2 mt-2 select-none whitespace-nowrap active:ring"
        :class="{ '--active': active }">

        <slot/>

    </button>

</template>

<script>

    export default {
        name: 'Pill',
        props: {
            active: {
                type: Boolean,
                required: true,
            },
        },
    }

</script>

<style lang="scss">

    .dark {

        .pill-element.\--active {

            background: rgba(var(--colors-primary-500));
            color: rgba(var(--colors-gray-800));

            &:hover {
                background: rgba(var(--colors-primary-400));
                color: rgba(var(--colors-gray-800));
            }

        }

        .pill-element {

            background: rgba(var(--colors-gray-800));
            color: rgba(var(--colors-gray-400));
            --tw-ring-color: rgba(var(--colors-gray-600));

            &:hover {
                background: rgba(var(--colors-gray-700));
                color: rgba(var(--colors-gray-200));
            }

        }

    }

    .pill-element {

        --tw-ring-color: rgba(var(--colors-primary-200));

        background: rgba(var(--colors-gray-100));
        color: rgba(var(--colors-gray-500));

        &:hover {
            background: rgba(var(--colors-gray-200));
            color: rgba(var(--colors-gray-500));
        }

    }

    .pill-element.\--active {

        background: rgba(var(--colors-primary-500));
        color: white;

        &:hover {
            background: rgba(var(--colors-primary-400));
        }

    }

</style>
