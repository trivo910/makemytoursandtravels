<footer class="site-footer">
    <div class="container">
        <div class="site-footer__main">
            <div class="site-footer__brand">
                <a class="brand brand--footer" href="{{ route('home') }}" aria-label="Make My Tours &amp; Travels home">
                    <img class="brand__logo" src="{{ asset('images/make-my-tours-logo.png') }}" alt="Make My Tours &amp; Travels" width="1600" height="406" loading="lazy">
                </a>
                <p>Make My Tours &amp; Travels offers comfortable buses and travel services for journeys, tours, events, and group travel in Mumbai.</p>
                <a class="site-footer__email" href="mailto:makemytoursplanner@gmail.com">makemytoursplanner@gmail.com</a>
            </div>

            <div class="site-footer__links">
                <h2 class="site-footer__heading">Explore</h2>
                <ul class="footer-links">
                    <li><a href="{{ rtrim(url('/about'), '/') . '/' }}">About</a></li>
                    <li><a href="{{ rtrim(url('/our-standards'), '/') . '/' }}">Our Standards</a></li>
                    <li><a href="{{ rtrim(url('/bus-hire'), '/') . '/' }}">Bus Hire</a></li>
                    <li><a href="{{ rtrim(url('/urbania'), '/') . '/' }}">Urbania</a></li>
                    <li><a href="{{ rtrim(url('/tempo-traveller-hire'), '/') . '/' }}">Tempo Traveller Hire</a></li>
                    <li><a href="{{ rtrim(url('/faqs'), '/') . '/' }}">FAQ's</a></li>
                </ul>
            </div>

            <div class="site-footer__contact">
                <h2 class="site-footer__heading">Get in touch</h2>
                <address>E-120, Puspanjali Bldg,<br>Seven Bunglow, Andheri West,<br>Mumbai</address>
                <a class="footer-contact" href="tel:+917718036300">+91 77180 36300</a>
                <a class="footer-contact" href="{{ rtrim(url('/contact'), '/') . '/' }}">Contact Make My Tours &amp; Travels</a>
            </div>

            <div class="site-footer__updates">
                <h2 class="site-footer__heading">Plan Your Trip</h2>
                <p>Contact our team for vehicle options, availability, and help planning your next journey.</p>
                <a class="button button--primary" href="tel:+917718036300">Call +91 77180 36300</a>
            </div>
        </div>

        <div class="site-footer__bottom">
            <p>Bus Service by Make My Tours &amp; Travels.</p>
            <p>&copy; {{ now()->year }} Make My Tours &amp; Travels</p>
            <span>Designed &amp; Marketed By Trivo</span>
        </div>
    </div>
</footer>
