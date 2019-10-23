<!-- component template -->
<script type="text/x-template" id="grid-template">
    <table class="table table-hover">
        <thead>
        <tr>
            <th v-for="key in columns"
                @click="sortBy(key)"
                :class="{ active: sortKey == key }">
                {{ key | capitalize }}
                <i class="fas " :class="sortOrders[key] > 0 ? 'fa-sort-down' : 'fa-sort-up'"></i>
          </span>
            </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="entry in filteredHeroes">
            <td v-for="key in columns">
                <span v-html="entry[key]"></span>
            </td>
        </tr>
        </tbody>
    </table>
</script>

<!-- demo root element -->
<div id="tasks">
    <ul class="nav justify-content-end">
        <li class="d-inline p-2 nav-item">
            <form id="search">
                Search <input name="query" v-model="searchQuery">
            </form>
        </li>
        <li class="d-inline p-1  nav-item mr-2 ml-2">
            <a href="/add"><button type="button" class="btn btn-primary">Add</button></a>
        </li>
        <li class="d-inline p-2  nav-item">
            <a class="nav-link" href="#">login</a>
        </li>
    </ul>

    <div class="container">

        <div class="row justify-content-md-center mb-3">
            <h1>Task manager</h1>
        </div>

        <div class="row justify-content-md-center">
            <div class="col-md-auto">
                <task-grid
                        :heroes="gridData"
                        :columns="gridColumns"
                        :filter-key="searchQuery">
                </task-grid>
            </div>
        </div>
    </div>
</div>

<script src="/application/js/table.js"></script>