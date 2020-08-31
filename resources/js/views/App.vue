<template>
    <section class="section">
        <div class="container">
            <Search
              @change="search"
            />
            <h5 class="title is-5 mt-30">Results</h5>
            <b-table :data="results" :columns="columns" :loading="loading">
                <template slot="empty">
                    <section class="section">
                        <div class="content has-text-grey has-text-centered">
                            <p>
                                <b-icon
                                    icon="emoticon-sad"
                                    size="is-large">
                                </b-icon>
                            </p>
                            <p>{{emptySearchText}}</p>
                        </div>
                    </section>
                </template>
            </b-table>
        </div>
    </section>
</template>

<script>
import Search from '../components/Search.vue'

export default {
    components: {
        Search
    },
    data () {
        return {
            loading: false,
            data: [],
            emptyText: 'Nothing here.',
            columns: [
                {
                    field: 'id',
                    label: 'ID',
                    width: '40',
                    numeric: true,
                },
                {
                    field: 'name',
                    label: 'Name',
                },
                {
                    field: 'bedrooms',
                    label: 'Bedrooms',
                    centered: true,
                },
                {
                    field: 'bathrooms',
                    label: 'Bathrooms',
                },
                {
                    field: 'storeys',
                    label: 'Storeys',
                },
                {
                    field: 'garages',
                    label: 'Garages',
                },
                {
                    field: 'price',
                    label: 'Price',
                },
                {
                    field: 'created_at',
                    label: 'Date',
                },
            ],
        }
    },
    computed: {
        results () {
            return this.data
        },
        emptySearchText () {
            return this.emptyText
        },
    },

    methods: {
        async search (data) {
            try {
                this.setLoading(true);

                const response = await axios.get('/api/hotels/search', { params: this.normlizeSearchData(data) });
                const newData = [...response.data.data]
                this.setData(newData)

            } catch (error) {
                console.log(error)
                const { response: { data: { message } } } = error;
                this.setEmptyTest(message);
            } finally {
                this.setLoading(false);
            }
        },

        setLoading(value) {
            this.loading = value;
        },

        setData(value) {
            this.data = value;
        },

        setEmptyTest(value){
            this.emptyText = value;
        },

        normlizeSearchData(data) {
            return Object.keys(data)
                        .filter(key => data[key] !== 0)
                        .reduce((obj, key) => {
                            obj[key] = data[key]
                            return obj
                        }, {})
        }
    },
}
</script>
