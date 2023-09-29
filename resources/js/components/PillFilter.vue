<template>

    <div class="pill-filter overflow-hidden relative" ref="viewport">

        <FilterContainer>

            <span>{{ filter.name }}</span>

            <template #filter>

                <div class="flex relative" :class="{ 'flex-wrap': filter.mode === 'wrap' }" ref="content">


                    <Pill v-if="filter.showSelectNoneButton" :active="currentActive.length === 0"
                          @click.native="clearFilters()">

                        {{ filter.noneLabel }}

                    </Pill>

                    <Pill v-for="option in filter.options"
                          :key="option.value"
                          :active="currentActive.includes(option.value)"
                          @click.native="enableFilter(option.value)">

                        {{ option.label }}

                    </Pill>

                </div>

            </template>

        </FilterContainer>

    </div>

</template>

<script>

    import debounce from 'lodash/debounce'
    import Pill from './Pill.vue'
    import ScrollBooster from 'scrollbooster'

    export default {
        components: { Pill },
        emits: [ 'change' ],

        props: {
            resourceName: {
                type: String,
                required: true,
            },
            filterKey: {
                type: String,
                required: true,
            },
            lens: String,
        },

        data: () => ({
            value: null,
            debouncedHandleChange: null,
        }),

        created() {
            this.debouncedHandleChange = debounce(() => this.handleChange(), 500)

            this.setCurrentFilterValue()
        },

        mounted() {
            Nova.$on('filter-reset', this.setCurrentFilterValue)

            if (this.filter.mode === 'drag') {

                const scrollBooster = new ScrollBooster({
                    viewport: this.$refs.viewport,
                    content: this.$refs.content,
                    scrollMode: 'transform',
                    direction: 'horizontal',
                    // textSelection: true,
                    // preventDefaultOnEmulateScroll: true,
                    // emulateScroll: true,
                    // emulateScroll: true,
                    textSelection: false,
                    // onUpdate: data => {
                    //     // this.$refs.content.style.transform = `translateX(${ -data.position.x }px)`
                    // },
                })

                // this.$on('beforeDestroy', () => scrollBooster.destroy())

            }

        },

        beforeUnmount() {
            Nova.$off('filter-reset', this.setCurrentFilterValue)
        },

        watch: {
            value() {
                this.debouncedHandleChange()
            },
        },

        methods: {
            setCurrentFilterValue() {
                this.value = this.filter.currentValue
            },

            handleChange() {
                this.$store.commit(`${ this.resourceName }/updateFilterState`, {
                    filterClass: this.filterKey,
                    value: this.value,
                })

                this.$emit('change')
            },
            ///
            setFilter(value) {

                this.$store.commit(`${ this.resourceName }/updateFilterState`, {
                    filterClass: this.filterKey, value,
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

            },
        },

        computed: {
            filter() {
                return this.$store.getters[ `${ this.resourceName }/getFilter` ](
                    this.filterKey,
                )
            },
            currentActive() {
                return this.filter.currentValue || []
            },
        },
    }
</script>
