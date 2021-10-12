<div class="crt-header sticky">
    <div class="crt-header-content">
        <div class="crt-header-logo">
            <a href="{{ url('/') }}">CI Logos</a>
        </div>
        <div class="crt-search-btn">
            <i class="material-icons">search</i>
        </div>
        <div class="crt-header-search">
            <form>
                @csrf
                <label for="search"></label>
                <input type="text" class="crt__search-item" aria-describedby="search" id="search" name="keyword" placeholder="Rechercher..." autocomplete="on" />
                <input type="button" name="close" value="close" class="material-icons" />
            </form>
        </div>
        <div class="crt-clear-fix"></div>
    </div>
</div>
