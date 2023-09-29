<template>

    <div ref="viewport" class="overflow-hidden pill-filter">

        <div>

            <h3 class="text-sm uppercase tracking-wide text-80 bg-30 p-3">
                {{ filter.name }}
            </h3>

            <div ref="content" class="flex px-2 pb-2" :class="{ 'flex-wrap': filter.mode === 'wrap' }">

                <Pill v-if="filter.showSelectNoneButton" :active="currentActive.length === 0"
                      @click.native="clearFilters()">

                    {{ filter.noneLabel }}

                </Pill>

                <Pill v-for="option in filter.options"
                      :key="option.value"
                      :active="currentActive.includes(option.value)"
                      @click.native="enableFilter(option.value)">

                    {{ option.name }}

                </Pill>

            </div>

        </div>

    </div>

</template>

<script>

    import Pill from './Pill'
    import ScrollBooster from 'scrollbooster'

    export default {
        name: 'PillFilter',
        components: { Pill },
        props: {
            resourceName: {
                type: String,
                required: true
            },
            filterKey: {
                type: String,
                required: true
            }
        },
        mounted() {


        },
        methods: {

        },
        computed: {
            filter() {
                return this.$store.getters[ `${ this.resourceName }/getFilter` ](this.filterKey)
            },
            currentActive() {
                return this.filter.currentValue || []
            }
        }
    }

</script>
