<template>
    <form>
        <b-field grouped>
            <b-field label="Name">
                <b-input
                    v-model="searchData.name"
                />
            </b-field>
            <b-field label="Bedrooms">
                <b-numberinput
                    v-model="searchData.bedrooms"
                    type="is-light"
                    min="0"
                    :editable="true"
                    controls-position="compact"
                    controls-rounded
                />
            </b-field>
            <b-field label="Bathrooms">
                <b-numberinput
                    v-model="searchData.bathrooms"
                    type="is-light"
                    min="0"
                    :editable="true"
                    controls-position="compact"
                    controls-rounded
                />
            </b-field>
            <b-field label="Storeys">
                <b-numberinput
                    v-model="searchData.storeys"
                    type="is-light"
                    min="0"
                    :editable="true"
                    controls-position="compact"
                    controls-rounded
                />
            </b-field>
            <b-field label="Garages">
                <b-numberinput
                    v-model="searchData.garages"
                    type="is-light"
                    min="0"
                    :editable="true"
                    controls-position="compact"
                    controls-rounded
                />
            </b-field>
        </b-field>
        <b-field
            :label="`Price ($${searchData.price[0]}-$${searchData.price[1]} )`"
            expanded
        >
            <b-slider
                v-model="searchData.price"
                :min="1"
                :max="20000"
                :step="10"
                ticks
                rounded
            />
        </b-field>
        <b-field>
            <b-button type="is-primary" @click="handleSearch">Search</b-button>
        </b-field>
    </form>
</template>

<script>
export default {
    data() {
        return {
          searchData: {
            name: '',
            bedrooms: 0,
            bathrooms: 0,
            storeys: 0,
            garages: 0,
            price: [],
          },
        }
    },
    watch: {
        searchData: {
            handler (val) {
                const data = this.normlizeData(val)

                this.$emit('change', data)
            },
            deep: true,
        },
    },
    methods: {
        handleSearch() {
            const data = this.normlizeData(this.searchData)

            this.$emit('change', data)
        },

        normlizeData(data) {
            const [start, end] = data.price;

            return {
                ...data,
                price: { start, end }
            }
        }
    }
}
</script>

<style>

</style>
