<template>
    <tr>
        <td v-if="label" v-html="label ? label : ''"></td>
        <td>
            <div class="d-flex flex-column">
                <div class="input-group">
                    <div class="input-group-prepend" v-if="prepend">
                        <span class="input-group-text">
                            <span v-html="prepend ? prepend : ''"></span>
                        </span>
                    </div>
                    <the-mask
                        :disabled="disabled"
                        class="form-control"
                        v-if="mask"
                        :mask="mask"
                        :masked="true"
                        v-model="val"
                        v-bind:class="{'is-invalid' : errors}"
                        :placeholder="placeholder ? placeholder : ''"
                        name="email"
                        :type="type ? type : 'text'"
                    />
                    <input
                        :disabled="disabled"
                        class="form-control"
                        v-else
                        v-model="val"
                        v-bind:class="{'is-invalid' : errors}"
                        :placeholder="placeholder ? placeholder : ''"
                        name="email"
                        :type="type ? type : 'text'"
                    />

                    <div class="input-group-append" v-if="append">
                        <span class="input-group-text">
                            <span v-html="append ? append : ''"></span>
                        </span>
                    </div>
                    <div class="invalid-feedback" v-if="errors">
                        <ul class="pl-3 mb-0">
                            <li v-for="(e,i) in errors" :key="i">{{e}}</li>
                        </ul>
                    </div>
                </div>
                <small v-if="description" class="mt-1" style="color: gray;">
                    <span v-html="description"></span>
                </small>
            </div>
        </td>
    </tr>
</template>
<script>
export default {
    props: ["label", "type", "placeholder", "errors", "prepend", "append", "disabled", "mask", "description"],
    data() {
        return {
            val: null
        }
    },
    watch: {
        val(val) {
            return this.$emit("input", val)
        }
    },
    async created() {
        this.val = this.$attrs.value
    }
}
</script>