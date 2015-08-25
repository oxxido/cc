@extends('layouts.main')



@section('body')

<!--div class="wrapper">
<br />
<h2>How it works</h2>
<br />
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt 
  ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco 
  laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in 
  voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat 
  non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
  <br />
</div-->
<section class="top-page">
    <div class="wrapper">

        <div class="logo-cnt"> Company Name</div>
        <div class="top-image">
            <img src="images/landscape.jpg" alt="">
            <div class="row company-info-cnt">
                <div class="col-sm-6">Company Name</div>
                <div class="col-sm-6 text-right">Company Adress | Company Phone</div>
            </div>
        </div>

    </div>
</section>
<section class="feedback">
    <div class="wrapper">
        <div class="bg-panel">
            <div class="top-section">
                <p class="title-section">Your Feedback</p>
            </div>
            <div class="bottom-section">
                <form>
                    <div class="form-group">
                        <label for="firstname">How likely is it that you would recommend our company to a friend or colleague?</label>
                        <div class="silver-bg">
                            <div class="radios-cnt clearfix">
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>1</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>2</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>3</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>4</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>5</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>6</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>7</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>8</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>9</p>
                                </div>
                                <div class="radio">
                                    <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked></label>
                                    <p>10</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-4">Not at all likely</div>
                                <div class="col-sm-4 text-center">Neutral</div>
                                <div class="col-sm-4 text-right">Very likely</div>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="firstname">Your First Name</label>
                        <input type="text" class="form-control small-width" id="firstname" placeholder="First Name">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Your Last Name</label>
                        <input type="text" class="form-control small-width" id="lastname" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" class="form-control small-width" id="email" placeholder="Email">
                    </div>
                    <div class="form-group">
                        <label for="experience">How did you feel about your experience with us?</label>
                        <div class="textarea-cnt">
                            <textarea class="form-control" rows="3" id="experience" placeholder="Write comments here..."></textarea>
                            <p class="max-chars">0 / 500 characters maximum</p>
                        </div>
                    </div>
                    <p class="text-center"><button type="submit" class="btn btn-warning"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Submit Feedback</button></p>
                </form>
                <p class="text-center">By submitting this feedback you agree to our <a href="#"><strong>feedback and review policy</strong></a></p>

            </div>
        </div>
    </div>
</section>

@endsection
