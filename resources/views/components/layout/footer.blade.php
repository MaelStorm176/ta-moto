<footer class="footer p-10 bg-base-200 text-base-content">
    <div>
        <div class="flex items-center">
            <x-application-logo class="w-10 h-10 fill-current " />
            <h2 class="text-2xl ml-1 font-bold inline-block">Ta moto</h2>
        </div>
        <p>TAMOTO Industries Ltd.<br/>Spécialiste de la vente de moto en ligne depuis 1992</p>
    </div>
    <div>
        <span class="footer-title">A propos de nous</span>
        <a class="link link-hover" href="{{ route('about') }}">Notre société</a>
        <a class="link link-hover" href="{{ route('contact') }}">Contactez nous</a>
    </div>
    <div>
        <span class="footer-title">Legal</span>
        <a class="link link-hover" href="{{ route('terms') }}">Conditions d'utilisation</a>
        <a class="link link-hover" href="{{ route('privacy') }}">Politique de confidentialité</a>
        <a class="link link-hover" href="{{ route('cookie-policy') }}">Politique des cookies</a>
    </div>
</footer>
