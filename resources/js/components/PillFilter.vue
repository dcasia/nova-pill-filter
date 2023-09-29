<template>

    <div class="pill-filter overflow-hidden relative" ref="viewport">

        <div class="pt-2 pb-3">

            <h3 class="px-3 text-xs uppercase font-bold tracking-wide flex justify-between items-center">

                <span>{{ filter.name }}</span>

                <svg v-if="filter.mode === 'drag' && !this.filter.stack"
                     fill="none"
                     viewBox="0 0 24 24"
                     stroke-width="1.5"
                     stroke="currentColor"
                     class="w-6 h-5">

                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 9h16.5m-16.5 6.75h16.5"/>

                </svg>

            </h3>

            <div class="flex mt-1 px-3" :class="{ 'flex-wrap': filter.mode === 'wrap', 'grid': filter.stack }"
                 ref="content">

                <Pill v-if="filter.showSelectNoneButton"
                      :active="currentActive.length === 0"
                      :class="{ 'pointer-events-none' : isDragging }"
                      @click.native="clearFilters()">

                    {{ filter.noneLabel }}

                </Pill>

                <Pill v-for="option in filter.options"
                      :key="option.value"
                      :class="{ 'pointer-events-none' : isDragging }"
                      :active="currentActive.includes(option.value)"
                      @click.native="enableFilter(option.value)">

                    {{ option.label }}

                </Pill>

            </div>

        </div>

    </div>

</template>

<script>

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
            isDragging: false,
            scrollBooster: null,
            timeout: null,
            value: null,
        }),

        created() {

            this.setCurrentFilterValue()

        },

        mounted() {

            Nova.$on('filter-reset', this.setCurrentFilterValue)

            if (this.filter.mode === 'drag' && !this.filter.stack) {

                this.timeout = setTimeout(() => {

                    if (this.$refs.viewport && this.$refs.content) {

                        this.scrollBooster = new ScrollBooster({
                            viewport: this.$refs.viewport,
                            content: this.$refs.content,
                            scrollMode: 'transform',
                            direction: 'horizontal',
                            inputsFocus: false,
                            textSelection: false,
                            onUpdate: state => this.isDragging = state.isDragging,
                        })

                    }

                }, 2000)

            }

        },

        beforeUnmount() {

            Nova.$off('filter-reset', this.setCurrentFilterValue)

            if (this.timeout) {
                clearTimeout(this.timeout)
            }

            if (this.scrollBooster) {
                this.scrollBooster.destroy()
            }

        },

        methods: {
            setCurrentFilterValue() {
                this.value = this.filter.currentValue
            },

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
