<footer>
    <div class="container">
      <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
          <div class="footer-content">
            <h2>{{ $website->name }}</h2>
            <p>{{ $website->title }}</p>
            <ul>
              <li><a class="text-light" href="{{ $website->fb }}"><i class="fab fa-facebook-f"></i></a></li>
              <li><a class="text-light" href="{{ $website->youtube }}"><i class="fab fa-youtube"></i></a></li>
              <li><a class="text-light" href="{{ $website->linkedin }}"><i class="fab fa-linkedin"></i></a></li>
              <li><i class="fab fa-skype"></i></li>
            </ul>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
          <div class="footer-content">
            <h2>Quick Links</h2>
            <ol>
              <li><a href="{{ route("about") }}"><i class="fal fa-angle-double-right"></i>About</a></li>
              <li><a href="{{ route("services") }}"><i class="fal fa-angle-double-right"></i>Services</a></li>
              <li><a href="{{ route("contact") }}"><i class="fal fa-angle-double-right"></i>Contact</a></li>
            </ol>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
          <div class="footer-content">
            <h2>Services</h2>
            <ol>
                <li><a href="{{ route("product") }}"><i class="fal fa-angle-double-right"></i>Products</a></li>
                <li><a href="{{ route("gallery") }}"><i class="fal fa-angle-double-right"></i>Gallery</a></li>
                <li><a href="{{ route("video") }}"><i class="fal fa-angle-double-right"></i>Videos</a></li>

            </ol>
          </div>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-6 col-6">
          <div class="footer-content">
            <h2>News Letters</h2>
            <p>{{ $website->name }}</p>
            <div class="form-group">
              <input class="form-control" role="" name="email" type="email" placeholder="Enter Your Email">
              <i class="fal fa-paper-plane"></i>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copy-right">
      <div class="container">
        <div class="copy-right-card">
         <p>{{ date("Y") }} @ All Rights Reserved Designed and developed by<a
             href="https://www.facebook.com/arshahin201" target="_blank" style="color: #EBB50C">Anisur Rahman Shahin</a></p>
        </div>
      </div>
    </div>
  </footer>
