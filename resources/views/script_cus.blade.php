
	<!-- Messenger Plugin chat Code -->
    <div id="fb-root"></div>

    <!-- Your Plugin chat code -->
    <div id="fb-customer-chat" class="fb-customerchat">
    </div>

    <script>
      var chatbox = document.getElementById('fb-customer-chat');
      chatbox.setAttribute("page_id", "103152772003765");
      chatbox.setAttribute("attribution", "biz_inbox");
      window.fbAsyncInit = function() {
        FB.init({
          xfbml            : true,
          version          : 'v10.0'
        });
      };

      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = 'https://connect.facebook.net/vi_VN/sdk/xfbml.customerchat.js';
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
	<script src="{{asset('frontend/js/jquery.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery-migrate-3.0.1.min.js')}}"></script>
	<script src="{{asset('frontend/js/popper.min.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.easing.1.3.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.waypoints.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.stellar.min.js')}}"></script>
	<script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
	<script src="{{asset('frontend/js/jquery.animateNumber.min.js')}}"></script>
	<script src="{{asset('frontend/js/bootstrap-datepicker.js')}}"></script>
	<script src="{{asset('frontend/js/scrollax.min.js')}}"></script>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
	<script src="{{asset('frontend/js/google-map.js')}}"></script>
	<script src="{{asset('frontend/js/main.js')}}"></script>
	