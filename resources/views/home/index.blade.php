@extends('layouts.main')

@section('body')
<div id="header">
	<div class="wrapper">
		<div id="logo"><a href="{{ url('home') }}"><img src="images/logo.png" width="265" height="70"></a></div>
    <!-- 
How It Works 
Pricing 
FAQs 
Login 
Buy Now (Button) 
Free 15 Day Trial (Button) 
    -->
    
    <div class="login">
			@if (Auth::guest())
			<a href="{{ url('/dashboard') }}">Client Login</a>
			@else
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ str_limit(Auth::user()->name,10) }} <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="{{ url('dashboard') }}">Dashboard</a></li>
                    <li><a href="{{ url('auth/logout') }}">Logout</a></li>
                </ul>
            </li>
            @endif

		</div>
    <div class="login s80">
      <a href="{{url('/faqs')}}" class="">FAQs</a>
    </div>
    <div class="login s80">
      <a href="{{url('/pricing')}}" class="">Pricing</a>
    </div>
    <div class="login">
      <a href="{{url('/howitworks')}}">How it works</a>
    </div>
	</div>
</div>
<div id="homebanner">
<div class="wrapper">
<div class="image"><img src="images/homeimg.png" width="361" height="291"></div>
<div class="description">
  <img src="images/homebannertxt.png" width="543" height="109"><br>
   <h4>Take the time to prove to your new clients that the comments displayed on your website are 100% authentic.</h4>
   <a href="{{ url('invite') }}"><img src="images/btn_req_black.png" width="240" height="60"></a> </div>
</div>
</div>

<div class="wrapper">
@if(\Session::has('message'))
    <div class="alert alert-warning">
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
      <p>{{ Session::get('message') }}</p>
    </div>
@endif
<div id="containerleft">
  <h3>Add a CertifiedComments <a href="http://www.certifiedcomments.com/review/idivorceforms.php" target="_blank">Trust Seal</a> to your website (<a href="http://www.certifiedcomments.com/review/mydivorcepapers.php" target="_blank">Real Customer Reviews</a>)</h3>
 <div id="containerleftbox"> 
  We validate each testimonial from your site with our Patent pending technology.  Your clients can rest assured that when they read a testimonial on your site that it is 100% real.  Our system will not only take the time to validate and certify that the comments on your site are real, but also offer you a validated logo and certificate for each testimonial we display on your website.<br>
<br>
<a href="{{ url('invite') }}">Sign up today</a> and start validating your customer comments today. 

<div class="borderbar"></div>

<div id="testimonial">
<div class="picture"><img src="images/customer1.png" width="100" height="150"></div>
<div class="testimonialtxt"><i><img src="images/quoteleft.png" width="20" height="16"> I am so grateful I found your service. I have been in gridlock over this matter for far too long as I do not know how to begin navigating the court systems/processes. THANK YOU!</i> <img src="images/quoteright.png" width="19" height="16" vspace="5" hspace="5" align="absmiddle"><br>

<span>Erin - Buena Park, California</span><br>
<a role="button" tabindex="0" data-toggle="popover" data-placement="bottom" data-html="true" data-content="
            <div class=&quot;bg-text&quot;>We validated the testimonial from data collected from the customer including but not limited to:</div>
            <table class=&quot;certification-table&quot;>
              <tbody><tr class=&quot;first-row&quot;>
                <td class=&quot;first-col&quot;>IP: 255.255.255.255</td>
                <td>Phone: 0123456789</td>
              </tr>
              <tr>
                <td class=&quot;first-col&quot;>State: California</td>
                <td>Email: erin@gmail.com</td>
              </tr>
            </tbody></table>
          " data-trigger="click" title="" data-original-title="<img src='/images/certification.png' alt='certification'>"><img src="images/seal.png" width="124" height="32" vspace="5"></a>
</div>
<div class="clear"></div>

</div>
</div>
</div>
<div id="containerright">

  <h3>Benefits of using CerifiedComments.com to validate your customer’s testimonials include:</h3>
<div class="benefitlisting"><img src="images/ico1.png" width="59" height="59"> <b>Testimonials listed in Google, Yahoo & Bing:</b>  Display Noteworthy comments from your clients online and boost your search rankings.</div>  
  
<div class="benefitlisting"><img src="images/ico2.png" width="59" height="59"> <b>Display the Certified Comments.com seal:</b>  Show your customers that you are real and that each of your testimonials has been validated by a third party as being 100% real.</div>  
  
<div class="benefitlisting"><img src="images/ico3.png" width="59" height="59"> <b>Validation of Comments:</b> We offer a 100% guarantee that we have exercised best practices to validate the testimonials displayed on your website.</div>  
  
<div class="benefitlisting"><img src="images/ico4.png" width="59" height="59"> <b>Our $250,000 Promise:</b>  We will not display our seal of approval on any testimonial unless we are confident that it is real and passes our inspection. If we do not, we will pay you $250,000.</div>  

<div class="benefitlisting"><img src="images/ico5.png" width="59" height="59"> <b>Follower Count:</b>  Learn which comments are read more than others, Sign up for Certified Comments and start showing all your loyal comments today.</div>  
  
</div>

<div class="seperator"></div>
<div style="text-align:center;">
<h2>Sign up for Certified Comments and start showing all your loyal comments today! </h2>
<a href="{{ url('invite') }}"><img src="images/btn_req_green.png" width="242" height="63"></a> </div>
</div>

@endsection

@section('footer')

<script>
$(function () {
  $('[data-toggle="popover"]').popover()
})
/*
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42842708-1', 'certifiedcomments.com');
  ga('send', 'pageview');*/

</script>


@endsection
