@extends('welcome.master')

@section('content')

    <!-- ******PROMO****** -->
    <section id="promo" class="promo section offset-header">
        <div class="container text-center">
            <h2 class="title">Bit<span class="highlight">Sign</span></h2>
            <p class="intro">The act of signing a binding legal agreement using the bitcoin blockchain</p>

            <div class="btns">
                <a class="btn btn-cta-secondary" href="/signup">Sign Up</a>
                <a class="btn btn-cta-primary" href="/login">Login</a>
            </div>
        </div>
    </section><!--//promo-->
    
    <!-- ******ABOUT****** --> 
    <section id="features" class="about section">
        <div class="container">
          <h2 class="title text-center">What is the blockchain?</h2>
            <p class="intro text-center">The blockchain is a public ledger maintained by a network of computers across the globe, and it is virtually impossible for any single entity to change the records in it, as they would need to compete with the massive processing power of the rest of the network. What does this mean for your signatures? Once you BitSign a document and we store a record of it in the blockchain, it's tamper-proof and instantly verifiable from anywhere, at any time, even 100 years from now.</p>
           <div class="container">
		      <div class="row">
		          <div class="col-sm-4">
		            <div class="row">
		              <div class="col-sm-10 col-sm-offset-2 text-center">
		              	<i class="fa fa-pencil fa-5x"></i>
		              <h3>The next level of <br/>e-signing</h3><p>Incorporate multimedia into instant electronic contracts, independently verifiable <strong>forever</strong> on the bitcoin blockchain.</p></div>
		            </div>
		          </div>
		          <div class="col-sm-4 text-center">
		            <div class="row">
		              <div class="col-sm-10 col-sm-offset-1 text-center">
		              	<i class="fa fa-tasks fa-5x"></i>
		              <h3>Supports multisig escrow</h3><p>Integrate multisignature asset release agreements directly into the signing process.</p></div>
		            </div>
		          </div>
		          <div class="col-sm-4 text-center">
		            <div class="row">
		              <div class="col-sm-10 text-center">
		              	<i class="fa fa-thumbs-up fa-5x"></i>
		              <h3>Identity checking and KYC support</h3><p>Easily meet KYC regulations, and instantly cross check and verify signee identity.</p></div>
		            </div>
		          </div>
		      </div><!--/row-->
			   <div class="row"><br></div>
			  </div><!--/container-->
        </div><!--//container-->
    </section><!--//about-->

@stop