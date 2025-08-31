<header>
    <div class="my-nav">
      <div class="container">
        <div class="row">
          <div class="nav-items">
            <div class="logo">
            <a href="/">
                <img src="{{ $website->logo ? asset($website->logo) : asset('bandhu_battery.png') }}"
                    alt="Bandhu Battery Logo"
                    class="" style=" height: 50px;">
            </a>
            </div>
            <div class="menu-toggle">
              <div class="menu-hamburger"></div>
            </div>
            <div class="menu-items">
              <div class="menu">
                <ul>
                  <li><a href="/">Home</a></li>
                  <li><a href="{{ route('about') }}">About</a></li>
                  <li><a href="{{ route("services") }}">Services</a></li>
                  <li><a href="{{ route("product") }}">Product</a></li>
                  <li><a href="{{ route("contact") }}">Contact</a></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </header>
