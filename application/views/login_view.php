<div class="container" id="auth">
    <div class="row justify-content-md-center">
        <form v-on:submit.prevent="auth" class="form-signin">
            <h1 class="h3 mb-3 font-weight-normal">Please sign in</h1>
            <div class="form-group">
                <label for="inputName" class="sr-only">User name</label>
                <input type="text" v-model="name" class="form-control" placeholder="User name" required autofocus>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="sr-only">Password</label>
                <input type="password" v-model="password" class="form-control" placeholder="Password" required>
            </div>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
            <a href="/"><< back</a>
        </form>
    </div>
    <div role="alert" aria-live="assertive" aria-atomic="true" class="toast" :class="{show: error}" data-autohide="false">
        <div class="toast-header">
            <strong class="mr-auto">Task manager</strong>
            <small>0 mins ago</small>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="toast-body">
            Error! The user name or password is not correct. Retype your user name and password.
        </div>
    </div>
</div>

<script src="/application/js/login.js"></script>