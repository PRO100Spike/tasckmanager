// register the grid component
Vue.component('task-grid', {
    template: '#grid-template',
    props: {
        heroes: Array,
        columns: Array,
        filterKey: String
    },
    data: function () {
        var sortOrders = {}
        this.columns.forEach(function (key) {
            sortOrders[key] = 1
        })
        return {
            sortKey: '',
            sortOrders: sortOrders
        }
    },
    computed: {
        filteredHeroes: function () {
            var sortKey = this.sortKey
            var filterKey = this.filterKey && this.filterKey.toLowerCase()
            var order = this.sortOrders[sortKey] || 1
            var heroes = this.heroes
            if (filterKey) {
                heroes = heroes.filter(function (row) {
                    return Object.keys(row).some(function (key) {
                        return String(row[key]).toLowerCase().indexOf(filterKey) > -1
                    })
                })
            }
            if (sortKey) {
                heroes = heroes.slice().sort(function (a, b) {
                    a = a[sortKey]
                    b = b[sortKey]
                    return (a === b ? 0 : a > b ? 1 : -1) * order
                })
            }
            return heroes
        }
    },
    filters: {
        capitalize: function (str) {
            return str.charAt(0).toUpperCase() + str.slice(1)
        }
    },
    methods: {
        sortBy: function (key) {
            this.sortKey = key
            this.sortOrders[key] = this.sortOrders[key] * -1
        }
    }
})

// bootstrap the demo
var demo = new Vue({
    el: '#tasks',
    data: {
        searchQuery: '',
        gridColumns: ['id', 'name', 'email', 'text', 'status'],
        gridData: [],
        page: 1,
        perPage: 3,
        pages: 1
    },
    mounted() {
        axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
        axios
            .get('/')
            .then(response => (
                console.log('Response:', response),
                this.gridData =  response.data.task,
                this.pages = Math.ceil(response.data.task_count / this.perPage)
            ));
    },
    methods: {
        paginate () {
            console.log('Aaaa', this.page);
            axios
                .post('/', {page: this.page})
                .then(response => (
                    console.log('Response:', response),
                        this.gridData =  response.data.task
                ));
        }
    },
})