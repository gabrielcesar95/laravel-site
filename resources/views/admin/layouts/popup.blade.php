<section class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
    <div class="modal-content">
        <header class="modal-header @yield('header_class')">
            @yield('header')
        </header>
        <article class="modal-body @yield('body_class')">
            @yield('content')
        </article>
        <footer class="modal-footer @yield('footer_class')">
            @yield('footer')
        </footer>
    </div>
</section>
