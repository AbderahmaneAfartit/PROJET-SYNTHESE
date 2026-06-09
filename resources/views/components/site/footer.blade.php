<footer class="footer">
    <div class="container">
        <div class="row text-center text-md-start">
            <div class="col-md-4 mb-4">
                <h2 class="footer-logo">Freelance-Job</h2>
                <p class="footer-text">
                    Crafted services marketplace connecting skilled artisans with people who need quality work.
                </p>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="footer-title">Explore</h5>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}#services">Services</a></li>
                    <li><a href="{{ route('posts') }}">Posts</a></li>
                    <li><a href="{{ route('providers') }}">Artisans</a></li>
                    <li><a href="{{ route('about') }}">About</a></li>
                    <li><a href="{{ route('contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="col-md-4 mb-4">
                <h5 class="footer-title">Follow</h5>
                <div class="footer-social">
                    <a href="#" aria-label="Facebook">f</a>
                    <a href="#" aria-label="Instagram">i</a>
                    <a href="mailto:support@freelance-job.com" aria-label="Email">@</a>
                </div>
            </div>
        </div>

        <div class="footer-bottom text-center">
            © {{ now()->year }} Freelance - Job
        </div>
    </div>
</footer>
