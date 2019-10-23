<div id="app">
    <div class="container">
        <form id="form" v-on:submit.prevent="addTask" @submit="isSubmit = true">
            <div class="form-group">
                <label for="exampleFormControlInput1">User name</label>
                <input
                        type="text"
                        v-model="newTask.name"
                        class="form-control"
                        :class="{'is-invalid': !validation.name}"
                        id="exampleFormControlInput1"
                        placeholder="User name"
                >
                <div :class="!validation.name ? 'invalid-feedback' : 'valid-feedback'">
                    Name cannot be empty.
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlInput2">Email address</label>
                <input
                        type="email"
                        v-model="newTask.email"
                        class="form-control"
                        :class="!validation.email ? 'is-invalid' : ''"
                        id="exampleFormControlInput1"
                        placeholder="email@email.com">
                <div :class="!validation.email ? 'invalid-feedback' : 'valid-feedback'">
                    Please provide a valid email address.
                </div>
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1">Example textarea</label>
                <textarea
                        class="form-control"
                        :class="!validation.text ? 'is-invalid' : ''"
                        v-model="newTask.text"
                        id="exampleFormControlTextarea1"
                        rows="3">
            </textarea>
                <div :class="!validation.text ? 'invalid-feedback' : 'valid-feedback'">
                    Please add text task.
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add Task</button>
        </form>
    </div>
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" :class="{show: isDone}" data-autohide="false">
        <div class="toast-header">
            <strong class="mr-auto">Task manager</strong>
            <small>0 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" @click="isDone = false">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Done! Add task successful.
        </div>
    </div>
</div>

<script src="/app/js/add.js"></script>