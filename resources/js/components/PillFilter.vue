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

            if (this.filter.mode === 'drag') {

                const scrollBooster = new ScrollBooster({
                    viewport: this.$refs.viewport,
                    direction: 'horizontal',
                    emulateScroll: true,
                    textSelection: true,
                    onUpdate: data => {
                        this.$refs.content.style.transform = `translateX(${ -data.position.x }px)`
                    }
                })

                this.$on('beforeDestroy', () => scrollBooster.destroy())

            }

        },
        methods: {
            setFilter(value) {

                this.$store.commit(`${ this.resourceName }/updateFilterState`, {
                    filterClass: this.filterKey, value
                })

                this.$emit('change')

            },
            clearFilters() {

                this.setFilter([])

            },
            enableFilter(value) {

                if (this.filter.single) {

                    return this.setFilter([ value ])

                }

                if (this.currentActive.includes(value)) {

                    this.currentActive.splice(this.currentActive.indexOf(value), 1)

                } else {

                    this.currentActive.push(value)

                }

                this.setFilter(this.currentActive)

            }
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
