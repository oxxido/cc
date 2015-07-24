@extends('layouts.main')

@section('body')
<div id="header">
<div class="wrapper">
<div id="logo"><a href="/home"><img src="images/logo.png" width="265" height="70"></a></div>
<div class="login"><a href="auth/login">Client Login</a></div>
</div>
</div>
<div id="homebanner">
<div class="wrapper">
<div class="image"><img src="images/homeimg.png" width="361" height="291"></div>
<div class="description">
  <img src="images/homebannertxt.png" width="543" height="109"><br>
   <h4>Take the time to prove to your new clients that the comments displayed on your website are 100% authentic.</h4>
   <a href="requestform.htm"><img src="images/btn_req_black.png" width="240" height="60"></a> </div>
</div>
</div>

<div class="wrapper">
<div id="containerleft">
  <h3>Add a CertifiedComments <a href="http://www.certifiedcomments.com/review/idivorceforms.php" target="_blank">Trust Seal</a> to your website (<a href="http://www.certifiedcomments.com/review/mydivorcepapers.php" target="_blank">Real Customer Reviews</a>)</h3>
 <div id="containerleftbox"> 
  We validate each testimonial from your site with our Patent pending technology.  Your clients can rest assured that when they read a testimonial on your site that it is 100% real.  Our system will not only take the time to validate and certify that the comments on your site are real, but also offer you a validated logo and certificate for each testimonial we display on your website.<br>
<br>
<a href="requestform.htm">Sign up today</a> and start validating your customer comments today. 

<div class="borderbar"></div>

<div id="testimonial">
<div class="picture"><img src="images/customer1.png" width="100" height="150"></div>
<div class="testimonialtxt"><i><img src="images/quoteleft.png" width="20" height="16"> I am so grateful I found your service. I have been in gridlock over this matter for far too long as I do not know how to begin navigating the court systems/processes. THANK YOU!</i> <img src="images/quoteright.png" width="19" height="16" vspace="5" hspace="5" align="absmiddle"><br>

<span>Erin - Buena Park, California</span><br>
<a href="#" onClick="MM_openBrWindow('popup.htm','Customer Information','scrollbars=yes,width=600,height=800')"><img src="images/seal.png" width="124" height="32" vspace="5"></a>

</div>
<div class="clear"></div>

</div>
</div>
</div>
<div id="containerright">
@if (Auth::guest())
                        <li><a href="/auth/login">Login</a></li>
                        <li><a href="/auth/register">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->name }} <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/auth/logout">Logout</a></li>
                            </ul>
                        </li>
                    @endif
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
<a href="requestform.htm"><img src="images/btn_req_green.png" width="242" height="63"></a> </div>
</div>



<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42842708-1', 'certifiedcomments.com');
  ga('send', 'pageview');

</script>


@endsection
