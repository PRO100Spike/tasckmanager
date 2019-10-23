// create Vue application
var auth = new Vue({
    // element to mount to
    el: '#auth',
    // initial data
    data: {
        name: '',
        password: '',
        error: false
    },
    // methods
    methods: {
        auth: function () {
            axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
            axios
                .post('/?controller=auth&action=login', {
                    name: this.name,
                    password: this.password
                })
                .then(response => (
                    console.log('Response:', response),
                    !response.data ? setTimeout(() => window.location.href = '/', 1500) : this.error = true
                ));
        }
    }
});