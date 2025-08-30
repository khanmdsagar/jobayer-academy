<!-- Footer -->
    <footer class="footer as-bg-text as-color-white as-mt-10px">
        <div class="footer-content">
            <div class="footer-section">
                <h3>{{$site_data[0]->site_name}}</h3>
                <p>{{$site_data[0]->site_slogan}}</p>
            </div>
            <div class="footer-section">
                <h3>যোগাযোগ</h3>
                <div class="footer-contact-info">
                    <div class="footer-info-item">
                        <i class="fas fa-map-marker-alt"></i>
                        <p>{{$site_data[0]->site_address}}</p>
                    </div>
                    <div class="footer-info-item">
                        <i class="fas fa-phone"></i>
                        <p>{{$site_data[0]->site_phone}}</p>
                    </div>
                    <div class="footer-info-item">
                        <i class="fas fa-envelope"></i>
                        <p>{{$site_data[0]->site_email}}</p>
                    </div>
                </div>
            </div>
            <div class="footer-section">
                <h3>লিঙ্কসমূহ</h3>
                <ul>
                    <li><a class="as-app-cursor" href="/">হোম</a></li>
                    <li><a class="as-app-cursor" href="#featured-course">কোর্সসমূহ</a></li>
                    @foreach ($page as $pg)
                        <li><a class="as-app-cursor" href="/page/{{$pg->page_slug}}">{{$pg->page_name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="footer-section">
                <h3>আমাদের ফলো করুন</h3>
                <div class="social-links">
                    @foreach($social_link as $link)
                        <a class="as-app-cursor" href="{{$link->link}}" target="_blank"><i class="{{ $link->link_logo }}"></i></a>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="footer-bottom" style="text-align: center; font-size: 14px">
            <span id="copyright" style="font-family: sans-serif"></span>
            <span>সর্বস্বত্ব সংরক্ষিত।</span>
        </div>
        <div style="text-align: center; font-family: sans-serif; font-size: 14px">Developed by <a class="as-app-cursor" style="color: var(--secondary-color)" href="https://www.facebook.com/profile.php?id=61576235612401">Nobogram Technologies</a></div>
    </footer>