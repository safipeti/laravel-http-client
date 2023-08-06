<form class=" g-3 align-items-center" action="" method="GET">
    @csrf
    <div class="row">
        <div class="col-md-3">
            <label for="" class="form-label">Name</label>
            <input
                type="text"
                class="form-control"
                id="name"
                name="name"
                value="{{ request()->get('name') }}"
            >
        </div>
        <div class="col-md-3">
            <label for="" class="form-label">Created from</label>
            <input
                type="date"
                class="form-control"
                name="createdFrom"
                value="{{ request()->get('createdFrom') }}"
            >
        </div>
        <div class="col-md-3">
            <label for="" class="form-label">Created to</label>
            <input
                type="date"
                class="form-control"
                name="createdTo"
                value="{{ request()->get('createdTo') }}"
            >
        </div>
        <div class="col-md-3">
            <label class="form-label">Order</label>
            <select name="orderBy" class="form-select">
                <option value=""></option>
                <option value="episode.asc" {{ request()->get('orderBy') === 'episode.asc' ? 'selected' : ''}}>Episode ASC</option>
                <option value="episode.desc" {{ request()->get('orderBy') === 'episode.desc' ? 'selected' : ''}}>Episode DESC</option>
                <option value="name.asc"{{ request()->get('orderBy') === 'name.asc' ? 'selected' : ''}}>Name ASC</option>
                <option value="name.desc" {{ request()->get('orderBy') === 'name.desc' ? 'selected' : ''}}>Name DESC</option>
                <option value="air.asc" {{ request()->get('orderBy') === 'air.asc' ? 'selected' : ''}}>Air Date ASC</option>
                <option value="air.desc" {{ request()->get('orderBy') === 'air.desc' ? 'selected' : ''}}>Air Date DESC</option>
                <option value="created.asc" {{ request()->get('orderBy') === 'created.asc' ? 'selected' : ''}}>Created ASC</option>
                <option value="created.desc" {{ request()->get('orderBy') === 'created.desc' ? 'selected' : ''}}>Created DESC</option>
            </select>
        </div>
    </div>
    <div class="row mt-5 text-center">
        <div class="col-md-12">
            <button type="submit" class="btn btn-primary ">Submit</button>
            <a href="/" class="btn btn-secondary">Reset</a>
        </div>
    </div>
</form>
