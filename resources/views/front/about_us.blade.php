@extends('front.layout.master')
@section('content')

<section>
	<div class="container-fluid">
		<div class="row">
			<div class="inner-header">&nbsp;</div>
		</div>
	</div>
</section>

	
<section class="top-space">
	<div class="container-xxl container-xl container-md container-sm">
		<div class="row">
			
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
				<div class="web-content about-box">
					<h1>About Us</h1>
					<p>FJS Plant was established in 1993 we are based approximately 25 miles from Dublin city centre. FJS Plant currently employ 22 skilled and highly experienced Staff across the area of Sales, Service, Repair, Spare Parts, Marketing and Administration. They are now a market leader in the Sales, Supply and Service of mobile plant and demolition equipment in Ireland.</p>
				</div>
			</div>
			
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-12">
				<img src="{{asset('assets/front/images/machine06.jpg')}}" alt="" class="img-fluid">
			</div>
			
		</div>
	</div>
</section>
	
	
<section class="top-space">
	<div class="container-xxl container-xl container-md container-sm">
		<div class="row">
						
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12">
				<div class="director-box">
					<img src="{{asset('assets/front/images/director.jpg')}}" alt="" class="img-fluid d-block mx-auto">
					
					<div class="web-content">
						<h2 class="sub-hdng">Director: Frank Smyth</h2>
						<p>Frank started his career with Philip McCormack Plant, holders of the main dealership for Moxy Dump trucks and Daewoo, where he worked as a field service engineer. From there Frank moved on to ASCON (BAM) where he specialised as the hydraulic and electrical fault-finding technician on the crane fleet. After two years with ASCON, Frank moved to McHale Plant Sales (a Komatsu dealership) to gain further experience within a main dealer environment. Not long after commencing his employment there, Frank was appointed as technical support engineer for the eastern and western regions. In 2003, Frank joined the family business, coming in as a partner to Fintan and Joan, his parents. Here, he gained first-hand experience in parts and sales within the industry.</p>
						
						<p>Frank is currently the Managing Director of FJS Plant, a role which requires a considerable focus on business development.</p>
					</div>
				</div>
			</div>
			
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
				<div class="web-content achivement-box">
					<h3 class="sub-hdng">Achievements</h3>
				<ul class="achievements-list">
					<li>A qualified construction plant fitter</li>
					<li>Was national apprentice of the year (junior 1999 and senior 2001)</li>
					<li>Underwent City and Guilds training in turning</li>
					<li>Is competent in testing, safety certificates, plant, crane and lifting equipment</li>
					<li>Has completed numerous Komatsu, Cummins and self-development courses</li>
					<li>Was a designer and developer of the Komatsu forest harvesting head hydraulic system</li>
				</ul>
				</div>
			</div>
		</div>
	</div>
</section>

@endsection