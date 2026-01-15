<!-- Footer -->
<footer class="modern-footer mt-5">
    <div class="container-fluid px-4">
        <div class="row align-items-center py-3">
            <div class="col-md-4 text-center text-md-start mb-2 mb-md-0">
                <img src="{{asset('images/logo_horizontal.png')}}" alt="logo" class="footer-logo"/>
            </div>
            <div class="col-md-4 text-center mb-2 mb-md-0">
                <p class="footer-tagline mb-0">
                    Empowering language learning through crowdsourcing
                </p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <div class="social-links mb-2">
                    <a href="#" class="social-icon"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-twitter"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="social-icon"><i class="bi bi-linkedin"></i></a>
                </div>
                <p class="copyright-text mb-0">
                    Copyright © {{\Carbon\Carbon::now()->year}} {{ config('app.name', 'CrowLL') }}
                </p>
                <small class="rights-text">All rights reserved</small>
            </div>
        </div>
    </div>
</footer>
