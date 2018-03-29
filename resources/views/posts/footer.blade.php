<footer id="footer" class="dark footer-4">
    <div class="container">

        <div class="f-logo-center">
            <a href="{{ route('home') }}" class="footer-logo">
                <img class="sretina" src="{{ asset('assets') }}/img/footer-logo.png" alt="" />
            </a>
        </div>
        <div class="col-md-6">
            <div class="copyright">
                &copy; {{ config('app.name') }} {{ date(now()->format('Y')) }}
            </div>
            <div class="copyright-sub-title stext-uppercase">
                {{ mb_strtoupper('Оптимизация препятствует эволюции.') }} <small>(Алан.Дж.Перлис)</small>
            </div>
        </div>
        <div class="col-md-6">
            <div class="social-link pull-right circle ">
                <a href="javascript: void(0)"><i class="fa fa-facebook"></i></a>
                {{-- <a href="#"><i class="fa fa-twitter"></i></a> --}}
                <a href="javascript: void(0)"><i class="fa fa-vk"></i></a>
                <a href="javascript: void(0)"><i class="fa fa-google-plus"></i></a>
                {{-- <a href="#"><i class="fa fa-behance"></i></a> --}}
            </div>
        </div>


    </div>
</footer>