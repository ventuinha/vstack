<template>
    <div class="dropdown ml-2" style="position:relative;" v-if="data.filters.length>0">
        <span class="badge-number" v-if="qty_filters>0" v-html="qty_filters" />
        <button
            :class="`btn btn dropdown-toggle btn-secondary btn-sm`"
            style="height: 33px;"
            type="button"
            id="dropdownMenuButton"
            data-toggle="dropdown"
            aria-haspopup="true"
            aria-expanded="false"
            v-html="`Filtrar ${label}`"
        />
        <div class="dropdown-menu filter-content dropdown-menu-right" ref="content">
            <div class="row">
                <div class="col-12">
                    <table class="table table-striped table-sm mb-0">
                        <btn-body
                            v-for="(f,key) in data.filters"
                            :key="key"
                            :k="key"
                            :f="f"
                            :filter="filter"
                            :index="f.index"
                            :data="data"
                        />
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import VRuntimeTemplate from "v-runtime-template"
export default {
    props: ["data", "label"],
    data() {
        return {
            filter: {},
            timeout: null
        }
    },
    components: {
        "v-runtime-template": VRuntimeTemplate,
        "btn-body": require("./partials/-filter-btn-row.vue").default,
    },
    computed: {
        qty_filters() {
            const qty = Object.keys(this.filter).map(key => this.hasContent(key)).filter(x => x).length
            return qty || 0
        }
    },
    created() {
        this.initFormFilter()
    },
    mounted() {
        this.$refs.content.addEventListener('click', event => event.stopPropagation())
    },
    methods: {
        hasContent(key) {
            if (this.filter[key]) {
                if (Array.isArray(this.filter[key])) { return this.filter[key].length > 1 ? true : null }
                return true
            }
            return false
        },
        setFormValue(index, value, filter) {
            if (filter.component == "text-filter") value = String(value)
            if (filter.component == "check-filter") value = value === "true"
            if (filter.component == "select-filter") value = value ? (!isNaN(Number(value)) ? Number(value) : "") : ""
            if (filter.component == "rangedate-filter") value = value.split(",")
            this.$set(this.filter, index, value)
        },
        initFormFilter() {
            let filter_keys = Object.keys(this.data.filters)
            for (let i in filter_keys) {
                if (this.data.filters[filter_keys[i]]) {
                    if (this.data.filters[filter_keys[i]].index)
                        this.setFormValue(this.data.filters[filter_keys[i]].index, this.data.query[this.data.filters[filter_keys[i]].index] ? this.data.query[this.data.filters[filter_keys[i]].index] : '', this.data.filters[filter_keys[i]])
                }
            }
        },
    },
}
</script>
<style lang="scss">
.badge-number {
    background-color: #04a9ce;
    color: white;
    font-size: 10;
    padding: 2px;
    border-radius: 100%;
    position: absolute;
    z-index: 99;
    top: -5px;
    left: -5px;
    width: 15px;
    height: 15px !important;
    display: flex;
    align-items: center;
    justify-content: center;
}
.filter-content {
    width: 700;
    padding: 0;
    border-radius: 10px;
    border-color: #bacad6;
}
.with-filter {
    background-color: #ff7512;
    &:hover {
        background-color: #a74906;
        color: white;
        transition: 0.4s;
    }
}
.clean-filter {
    border-color: #343a40;
    background-color: transparent;
    color: #343a40;
    &:hover {
        background-color: #343a40;
        color: white;
        transition: 0.4s;
    }
}
</style>