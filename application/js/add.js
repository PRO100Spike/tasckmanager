var emailRE = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/

var tasksRef = [];

// create Vue app
var app = new Vue({
    // element to mount to
    el: '#app',
    // initial data
    data: {
        newTask: {
            name: '',
            email: '',
            text: '',
        },
        isSubmit: false,
        isDone: false,
    },
    // computed property for form validation state
    computed: {
        validation: function () {
            return {
                name: !!this.newTask.name.trim() ||  !this.isSubmit,
                email: emailRE.test(this.newTask.email) || !this.isSubmit,
                text: !!this.newTask.text.trim() || !this.isSubmit,
            }
        },
        isValid: function () {
            var validation = this.validation
            return Object.keys(validation).every(function (key) {
                return validation[key]
            })
        }
    },
    // methods
    methods: {
        addTask: function () {
            if (this.isValid && this.isSubmit) {
                tasksRef.push(this.newTask)
                axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
                axios
                    .post('/add', {
                        name: this.newTask.name,
                        email: this.newTask.email,
                        text: this.newTask.text
                    })
                    .then(response => (
                        console.log('Response:', response.data),
                        this.isDone = true,
                        this.newTask.name = '',
                        this.newTask.email = '',
                        this.newTask.text = '',
                        this.isSubmit = false,
                        setTimeout(() => window.location.href = '/', 1500)
            ));
            }
        }
    }
});