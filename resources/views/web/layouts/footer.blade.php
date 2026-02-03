<!-- Footer -->
<footer class="modern-footer mt-5">
    <div class="container-fluid px-4">
        <div class="row align-items-center py-3">
            <div class="col-md-4 text-center text-md-start mb-2 mb-md-0">
                <div class="d-flex align-items-center justify-content-center justify-content-md-start gap-3">
                    <img src="{{asset('images/logo_horizontal.png')}}" alt="logo" class="footer-logo"/>
                    <a href="https://www.uc.pt/celga-iltec/crowll/"
                       target="_blank"
                       class="btn-project">
                        🔗 Project
                    </a>
                </div>
            </div>
            <div class="col-md-4 text-center mb-2 mb-md-0">
                <p class="footer-tagline mb-0">
                    Empowering language teaching through crowdsourcing
                </p>
            </div>
            <div class="col-md-4 text-center text-md-end">
                <p class="copyright-text mb-0">
                    Copyright © {{\Carbon\Carbon::now()->year}} {{ config('app.name', 'CrowLL') }}
                </p>
                <small class="rights-text">All rights reserved</small>
            </div>
        </div>
    </div>
</footer>

<style>
    /* Footer Styles */
    .modern-footer {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(10px);
        border-radius: 20px 20px 0 0;
        margin-top: auto;
        box-shadow: 0 -8px 32px 0 rgba(31, 38, 135, 0.15);
        padding: 1rem 0;
    }

    .footer-logo {
        height: 35px;
        width: auto;
        opacity: 0.9;
    }

    .footer-tagline {
        color: rgba(255, 255, 255, 0.9);
        font-size: 0.95rem;
        font-weight: 400;
        letter-spacing: 0.3px;
    }

    /* Project Button */
    .btn-project {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255, 255, 255, 0.2);
        backdrop-filter: blur(10px);
        color: white;
        padding: 0.6rem 1.25rem;
        border-radius: 50px;
        text-decoration: none;
        font-weight: 600;
        font-size: 0.9rem;
        border: 2px solid rgba(255, 255, 255, 0.3);
        transition: all 0.3s ease;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        white-space: nowrap;
    }

    .btn-project:hover {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        border-color: transparent;
        transform: translateY(-3px);
        box-shadow: 0 6px 20px rgba(102, 126, 234, 0.4);
        color: white;
    }

    .copyright-text {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.25rem !important;
    }

    .rights-text {
        font-size: 0.75rem;
        color: rgba(255, 255, 255, 0.6);
        display: block;
    }

    /* Mobile Responsive */
    @media (max-width: 768px) {
        .modern-footer {
            padding: 1.5rem 0;
        }

        .footer-logo {
            height: 30px;
        }

        .footer-tagline {
            font-size: 0.85rem;
        }

        .btn-project {
            font-size: 0.85rem;
            padding: 0.5rem 1rem;
        }

        .col-md-4 .d-flex {
            flex-wrap: wrap;
            gap: 0.75rem !important;
        }
    }
</style>
