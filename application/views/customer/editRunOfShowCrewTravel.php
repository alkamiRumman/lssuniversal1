<div class="modal fade in" id="modal-default" style="display: block;overflow: auto;">
	<div class="modal-dialog modal-lg" style="width: 90%">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close">Close
				</button>
				<h4 class="modal-title"><b>Update Production Crew Traveler</b></h4>
			</div>
			<form id="formEdit" action="<?= customer_url('updateRunOfShowCrewTravel/') . $data->id ?>" method="post">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Production Crew Traveler Information</label>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-6">
											<label for="crewMemberId">First Name </label><br>
											<select class="form-control input-sm" style="width: 100%"
													name="crewMemberId"
													id="crewMemberId" required>
												<option selected
														value="<?= $data->crewMemberId ?>"><?= $data->firstName ?></option>
											</select>
										</div>
										<div class="col-md-6">
											<label for="lastName">Last Name </label>
											<input class="form-control input-sm" type="text" name="lastName"
												   id="lastName" value="<?= $data->lastName ?>" readonly>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Travel-To Info</label>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-4">
											<label for="travelTypeTo">Travel Type </label>
											<select class="form-control input-sm" name="travelTypeTo"
													id="travelTypeTo">
												<option <?= $data->travelTypeTo == 'Airline' ? 'selected' : '' ?>
													value="Airline">Airline
												</option>
												<option <?= $data->travelTypeTo == 'Amtrak' ? 'selected' : '' ?>
													value="Amtrak">Amtrak
												</option>
												<option <?= $data->travelTypeTo == 'Bus' ? 'selected' : '' ?>
													value="Bus">Bus
												</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="airlineTo">Airline </label><br>
											<select class="form-control input-sm" name="airlineTo"
													id="airlineTo" style="width: 100%">
												<option value="">Select Airline</option>
												<option <?= $data->airlineTo == 'Alaska Airlines' ? 'selected' : '' ?>
													value="Alaska Airlines">Alaska Airlines
												</option>
												<option <?= $data->airlineTo == 'Allegiant Air' ? 'selected' : '' ?>
													value="Allegiant Air">Allegiant Air
												</option>
												<option <?= $data->airlineTo == 'American Airlines' ? 'selected' : '' ?>
													value="American Airlines">American Airlines
												</option>
												<option <?= $data->airlineTo == 'Breeze Airways' ? 'selected' : '' ?>
													value="Breeze Airways">Breeze Airways
												</option>
												<option <?= $data->airlineTo == 'Delta Air' ? 'selected' : '' ?>
													value="Delta Air Lines">Delta Air Lines
												</option>
												<option <?= $data->airlineTo == 'Frontier Airlines' ? 'selected' : '' ?>
													value="Frontier Airlines">Frontier Airlines
												</option>
												<option <?= $data->airlineTo == 'Hawaiian Airlines' ? 'selected' : '' ?>
													value="Hawaiian Airlines">Hawaiian Airlines
												</option>
												<option <?= $data->airlineTo == 'JetBlue"' ? 'selected' : '' ?>
													value="JetBlue">JetBlue
												</option>
												<option <?= $data->airlineTo == 'Southwest Airlines' ? 'selected' : '' ?>
													value="Southwest Airlines">Southwest Airlines
												</option>
												<option <?= $data->airlineTo == 'Spirit Airlines' ? 'selected' : '' ?>
													value="Spirit Airlines">Spirit Airlines
												</option>
												<option <?= $data->airlineTo == 'Sun Country Airlines' ? 'selected' : '' ?>
													value="Sun Country Airlines">Sun Country Airlines
												</option>
												<option <?= $data->airlineTo == 'United Airlines' ? 'selected' : '' ?>
													value="United Airlines">United Airlines
												</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-4">
											<label for="specifyTravelTo">Specify Travel </label>
											<input class="form-control input-sm"
												   type="text" <?= $data->travelTypeTo == 'Airline' ? 'readonly' : '' ?>
												   name="specifyTravelTo" id="specifyTravelTo"
												   value="<?= $data->specifyTravelTo ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="airportFromTo">Airport From</label><br>
											<select class="form-control input-sm" name="airportFromTo"
													style="width: 100%"
													id="airportFromTo">
												<option value="">Select Airline From</option>
												<!-- Alabama -->
												<optgroup label="Alabama - AL">
													<option value="Birmingham International Airport - BHM">Birmingham
														International
														Airport - BHM
													</option>
													<option value="Dothan Regional Airport - DHN">Dothan Regional
														Airport - DHN
													</option>
													<option value="Huntsville International Airport - HSV">Huntsville
														International
														Airport - HSV
													</option>
													<option value="Mobile - MOB">Mobile - MOB</option>
													<option value="Montgomery - MGM">Montgomery - MGM</option>
												</optgroup>

												<!-- Alaska -->
												<optgroup label="Alaska - AK">
													<option value="Anchorage International Airport - ANC">Anchorage
														International
														Airport - ANC
													</option>
													<option value="Fairbanks International Airport - FAI">Fairbanks
														International
														Airport - FAI
													</option>
													<option value="Juneau International Airport - JNU">Juneau
														International Airport -
														JNU
													</option>
												</optgroup>

												<!-- Arizona -->
												<optgroup label="Arizona - AZ">
													<option value="Flagstaff - FLG">Flagstaff - FLG</option>
													<option
														value="Phoenix, Phoenix Sky Harbor International Airport - PHX">
														Phoenix,
														Phoenix Sky Harbor International Airport - PHX
													</option>
													<option value="Tucson International Airport - TUS">Tucson
														International Airport -
														TUS
													</option>
													<option value="Yuma International Airport - YUM">Yuma International
														Airport - YUM
													</option>
												</optgroup>

												<!-- Arkansas -->
												<optgroup label="Arkansas - AR">
													<option value="Fayetteville - FYV">Fayetteville - FYV</option>
													<option value="Little Rock National Airport - LIT">Little Rock
														National Airport -
														LIT
													</option>
													<option value="Northwest Arkansas Regional Airport - XNA">Northwest
														Arkansas
														Regional Airport - XNA
													</option>
												</optgroup>

												<!-- California -->
												<optgroup label="California - CA">
													<option value="Burbank - BUR">Burbank - BUR</option>
													<option value="Fresno - FAT">Fresno - FAT</option>
													<option value="Long Beach - LGB">Long Beach - LGB</option>
													<option value="Los Angeles International Airport - LAX">Los Angeles
														International
														Airport - LAX
													</option>
													<option value="Oakland - OAK">Oakland - OAK</option>
													<option value="Ontario - ONT">Ontario - ONT</option>
													<option value="Palm Springs - PSP">Palm Springs - PSP</option>
													<option value="Sacramento - SMF">Sacramento - SMF</option>
													<option value="San Diego - SAN">San Diego - SAN</option>
													<option value="San Francisco International Airport - SFO">San
														Francisco
														International Airport - SFO
													</option>
													<option value="San Jose - SJC">San Jose - SJC</option>
													<option value="Santa Ana - SNA">Santa Ana - SNA</option>
												</optgroup>

												<!-- Colorado -->
												<optgroup label="Colorado - CO">
													<option value="Aspen - ASE">Aspen - ASE</option>
													<option value="Colorado Springs - COS">Colorado Springs - COS
													</option>
													<option value="Denver International Airport - DEN">Denver
														International Airport -
														DEN
													</option>
													<option value="Grand Junction - GJT">Grand Junction - GJT</option>
													<option value="Pueblo - PUB">Pueblo - PUB</option>
												</optgroup>

												<!-- Connecticut -->
												<optgroup label="Connecticut - CT">
													<option value="Hartford - BDL">Hartford - BDL</option>
													<option value="Tweed New Haven - HVN">Tweed New Haven - HVN</option>
												</optgroup>

												<optgroup label="District of Columbia - DC">
													<option value="Washington, Dulles International Airport - IAD">
														Washington, Dulles
														International Airport
													</option>
													<option value="Washington National Airport - DCA">Washington
														National Airport -
														DCA
													</option>
												</optgroup>

												<!-- Florida -->
												<optgroup label="Florida - FL">
													<option value="Daytona Beach - DAB">Daytona Beach - DAB</option>
													<option
														value="Fort Lauderdale-Hollywood International Airport - FLL">
														Fort
														Lauderdale-Hollywood International Airport - FLL
													</option>
													<option value="Fort Myers - RSW">Fort Myers - RSW</option>
													<option value="Jacksonville - JAX">Jacksonville - JAX</option>
													<option value="Key West International Airport - EYW">Key West
														International Airport
														- EYW
													</option>
													<option value="Miami International Airport - MIA">Miami
														International Airport -
														MIA
													</option>
													<option value="Orlando - MCO">Orlando - MCO</option>
													<option value="Pensacola - PNS">Pensacola - PNS</option>
													<option value="St. Petersburg - PIE">St. Petersburg - PIE</option>
													<option value="Sarasota - SRQ">Sarasota - SRQ</option>
													<option value="Tampa - TPA">Tampa - TPA</option>
													<option value="West Palm Beach - PBI">West Palm Beach - PBI</option>
													<option value="Panama City-Bay County International Airport - PFN">
														Panama City-Bay
														County International Airport - PFN
													</option>
												</optgroup>

												<!-- Georgia -->
												<optgroup label="Georgia - GA">
													<option value="Atlanta Hartsfield International Airport - ATL">
														Atlanta Hartsfield
														International Airport - ATL
													</option>
													<option value="Augusta - AGS">Augusta - AGS</option>
													<option value="Savannah - SAV">Savannah - SAV</option>
												</optgroup>

												<!-- Hawaii -->
												<optgroup label="Hawaii - HI">
													<option value="Hilo - ITO">Hilo - ITO</option>
													<option value="Honolulu International Airport - HNL">Honolulu
														International Airport
														- HNL
													</option>
													<option value="Kahului - OGG">Kahului - OGG</option>
													<option value="Kailua - KOA">Kailua - KOA</option>
													<option value="Lihue - LIH">Lihue - LIH</option>
												</optgroup>

												<!-- Idaho -->
												<optgroup label="Idaho - ID">
													<option value="Boise - BOI">Boise - BOI</option>
												</optgroup>

												<!-- Illinois -->
												<optgroup label="Illinois - IL">
													<option value="Chicago Midway Airport - MDW">Chicago Midway Airport
														- MDW
													</option>
													<option value="Chicago, O'Hare International Airport - ORD">Chicago,
														O'Hare
														International Airport - ORD
													</option>
													<option value="Moline - MLI">Moline - MLI</option>
													<option value="Peoria - PIA">Peoria - PIA</option>
												</optgroup>

												<!-- Indiana -->
												<optgroup label="Indiana - IN">
													<option value="Evansville - EVV">Evansville - EVV</option>
													<option value="Fort Wayne - FWA">Fort Wayne - FWA</option>
													<option value="Indianapolis International Airport - IND">
														Indianapolis International
														Airport - IND
													</option>
													<option value="South Bend - SBN">South Bend - SBN</option>
												</optgroup>

												<!-- Iowa -->
												<optgroup label="Iowa - IA">
													<option value="Cedar Rapids - CID">Cedar Rapids - CID</option>
													<option value="Des Moines - DSM">Des Moines - DSM</option>
												</optgroup>

												<!-- Kansas -->
												<optgroup label="Kansas - KS">
													<option value="Wichita - ICT">Wichita - ICT</option>
												</optgroup>

												<!-- Kentucky -->
												<optgroup label="Kentucky - KY">
													<option value="Lexington - LEX">Lexington - LEX</option>
													<option value="Louisville - SDF">Louisville - SDF</option>
												</optgroup>

												<!-- Louisiana -->
												<optgroup label="Louisiana - LA">
													<option value="Baton Rouge - BTR">Baton Rouge - BTR</option>
													<option value="New Orleans International Airport - MSY">New Orleans
														International
														Airport - MSY
													</option>
													<option value="Shreveport - SHV">Shreveport - SHV</option>
												</optgroup>

												<!-- Maine -->
												<optgroup label="Maine - ME">
													<option value="Augusta - AUG">Augusta - AUG</option>
													<option value="Bangor - BGR">Bangor - BGR</option>
													<option value="Portland - PWM">Portland - PWM</option>
												</optgroup>

												<!-- Maryland -->
												<optgroup label="Maryland - MD">
													<option value="Baltimore - BWI">Baltimore - BWI</option>
												</optgroup>

												<!-- Massachusetts -->
												<optgroup label="Massachusetts - MA">
													<option value="Boston, Logan International Airport - BOS">Boston,
														Logan
														International Airport - BOS
													</option>
													<option value="Hyannis - HYA">Hyannis - HYA</option>
													<option value="Nantucket - ACK">Nantucket - ACK</option>
													<option value="Worcester - ORH">Worcester - ORH</option>
												</optgroup>

												<!-- Michigan -->
												<optgroup label="Michigan - MI">
													<option value="Battlecreek - BTL">Battlecreek - BTL</option>
													<option value="Detroit Metropolitan Airport - DTW">Detroit
														Metropolitan Airport -
														DTW
													</option>
													<option value="Detroit - DET">Detroit - DET</option>
													<option value="Flint - FNT">Flint - FNT</option>
													<option value="Grand Rapids - GRR">Grand Rapids - GRR</option>
													<option value="Kalamazoo-Battle Creek International Airport - AZO">
														Kalamazoo-Battle
														Creek International Airport - AZO
													</option>
													<option value="Lansing - LAN">Lansing - LAN</option>
													<option value="Saginaw - MBS">Saginaw - MBS</option>
												</optgroup>

												<!-- Minnesota -->
												<optgroup label="Minnesota - MN">
													<option value="Duluth - DLH">Duluth - DLH</option>
													<option value="Minneapolis/St.Paul International Airport - MSP">
														Minneapolis/St.Paul
														International Airport - MSP
													</option>
													<option value="Rochester - RST">Rochester - RST</option>
												</optgroup>

												<!-- Mississippi -->
												<optgroup label="Mississippi - MS">
													<option value="Gulfport - GPT">Gulfport - GPT</option>
													<option value="Jackson - JAN">Jackson - JAN</option>
												</optgroup>

												<!-- Missouri -->
												<optgroup label="Missouri - MO">
													<option value="Kansas City - MCI">Kansas City - MCI</option>
													<option value="St Louis, Lambert International Airport - STL">St
														Louis, Lambert
														International Airport - STL
													</option>
													<option value="Springfield - SGF">Springfield - SGF</option>
												</optgroup>

												<!-- Montana -->
												<optgroup label="Montana - MT">
													<option value="Billings - BIL">Billings - BIL</option>
												</optgroup>

												<!-- Nebraska -->
												<optgroup label="Nebraska - NE">
													<option value="Lincoln - LNK">Lincoln - LNK</option>
													<option value="Omaha - OMA">Omaha - OMA</option>
												</optgroup>

												<!-- Nevada -->
												<optgroup label="Nevada - NV">
													<option
														value="Las Vegas, Las Vegas McCarran International Airport - LAS">
														Las Vegas,
														Las Vegas McCarran International Airport - LAS
													</option>
													<option value="Reno-Tahoe International Airport - RNO">Reno-Tahoe
														International
														Airport - RNO
													</option>
												</optgroup>

												<!-- New Hampshire -->
												<optgroup label="New Hampshire - NH">
													<option value="Manchester - MHT">Manchester - MHT</option>
												</optgroup>

												<!-- New Jersey -->
												<optgroup label="New Jersey - NJ">
													<option value="Atlantic City International Airport - ACY">Atlantic
														City
														International Airport - ACY
													</option>
													<option value="Newark International Airport - EWR">Newark
														International Airport -
														EWR
													</option>
													<option value="Trenton - TTN">Trenton - TTN</option>
												</optgroup>

												<!-- New Mexico -->
												<optgroup label="New Mexico - NM">
													<option value="Albuquerque International Airport - ABQ">Albuquerque
														International
														Airport - ABQ
													</option>
													<option value="Alamogordo - ALM">Alamogordo - ALM</option>
												</optgroup>

												<!-- New York -->
												<optgroup label="New York - NY">
													<option value="Albany International Airport - ALB">Albany
														International Airport -
														ALB
													</option>
													<option value="Buffalo - BUF">Buffalo - BUF</option>
													<option value="Islip - ISP">Islip - ISP</option>
													<option
														value="New York, John F Kennedy International Airport - JFK">
														New York, John
														F Kennedy International Airport - JFK
													</option>
													<option value="New York, LaGuardia Airport - LGA">New York,
														LaGuardia Airport -
														LGA
													</option>
													<option value="Newburgh - SWF">Newburgh - SWF</option>
													<option value="Rochester - ROC">Rochester - ROC</option>
													<option value="Syracuse - SYR">Syracuse - SYR</option>
													<option value="Westchester - HPN">Westchester - HPN</option>
												</optgroup>

												<!-- North Carolina -->
												<optgroup label="North Carolina - NC">
													<option value="Asheville - AVL">Asheville - AVL</option>
													<option value="Charlotte/Douglas International Airport - CLT">
														Charlotte/Douglas
														International Airport - CLT
													</option>
													<option value="Fayetteville - FAY">Fayetteville - FAY</option>
													<option value="Greensboro - GSO">Greensboro - GSO</option>
													<option value="Raleigh - RDU">Raleigh - RDU</option>
													<option value="Winston-Salem - INT">Winston-Salem - INT</option>
												</optgroup>

												<!-- North Dakota -->
												<optgroup label="North Dakota - ND">
													<option value="Bismarck - BIS">Bismarck - BIS</option>
													<option value="Fargo - FAR">Fargo - FAR</option>
												</optgroup>

												<!-- Ohio -->
												<optgroup label="Ohio - OH">
													<option value="Akron - CAK">Akron - CAK</option>
													<option value="Cincinnati - CVG">Cincinnati - CVG</option>
													<option value="Cleveland - CLE">Cleveland - CLE</option>
													<option value="Columbus - CMH">Columbus - CMH</option>
													<option value="Dayton - DAY">Dayton - DAY</option>
													<option value="Toledo - TOL">Toledo - TOL</option>
												</optgroup>

												<!-- Oklahoma -->
												<optgroup label="Oklahoma - OK">
													<option value="Oklahoma City - OKC">Oklahoma City - OKC</option>
													<option value="Tulsa - TUL">Tulsa - TUL</option>
												</optgroup>

												<!-- Oregon -->
												<optgroup label="Oregon - OR">
													<option value="Eugene - EUG">Eugene - EUG</option>
													<option value="Portland International Airport - PDX">Portland
														International Airport
														- PDX
													</option>
													<option value="Portland, Hillsboro Airport - HIO">Portland,
														Hillsboro Airport -
														HIO
													</option>
													<option value="Salem - SLE">Salem - SLE</option>
												</optgroup>

												<!-- Pennsylvania -->
												<optgroup label="Pennsylvania - PA">
													<option value="Allentown - ABE">Allentown - ABE</option>
													<option value="Erie - ERI">Erie - ERI</option>
													<option value="Harrisburg - MDT">Harrisburg - MDT</option>
													<option value="Philadelphia - PHL">Philadelphia - PHL</option>
													<option value="Pittsburgh - PIT">Pittsburgh - PIT</option>
													<option value="Scranton - AVP">Scranton - AVP</option>
												</optgroup>

												<!-- Rhode Island -->
												<optgroup label="Rhode Island - RI">
													<option value="Providence - T.F. Green Airport - PVD">Providence -
														T.F. Green
														Airport - PVD
													</option>
												</optgroup>

												<!-- South Carolina -->
												<optgroup label="South Carolina - SC">
													<option value="Charleston - CHS">Charleston - CHS</option>
													<option value="Columbia - CAE">Columbia - CAE</option>
													<option value="Greenville - GSP">Greenville - GSP</option>
													<option value="Myrtle Beach - MYR">Myrtle Beach - MYR</option>
												</optgroup>

												<optgroup label="South Dakota - SD">
													<option value="Pierre - PIR">Pierre - PIR</option>
													<option value="Rapid City - RAP">Rapid City - RAP</option>
													<option value="Sioux Falls - FSD">Sioux Falls - FSD</option>
												</optgroup>

												<optgroup label="Tennessee - TN">
													<option value="Bristol - TRI">Bristol - TRI</option>
													<option value="Chattanooga - CHA">Chattanooga - CHA</option>
													<option value="Knoxville - TYS">Knoxville - TYS</option>
													<option value="Memphis - MEM">Memphis - MEM</option>
													<option value="Nashville - BNA">Nashville - BNA</option>
												</optgroup>

												<optgroup label="Texas - TX">
													<option value="Amarillo - AMA">Amarillo - AMA</option>
													<option value="Austin Bergstrom International Airport - AUS">Austin
														Bergstrom
														International Airport - AUS
													</option>
													<option value="Corpus Christi - CRP">Corpus Christi - CRP</option>
													<option value="Dallas Love Field Airport - DAL">Dallas Love Field
														Airport - DAL
													</option>
													<option value="Dallas/Fort Worth International Airport - DFW">
														Dallas/Fort Worth
														International Airport - DFW
													</option>
													<option value="El Paso - ELP">El Paso - ELP</option>
													<option value="Houston, William B Hobby Airport - HOU">Houston,
														William B Hobby
														Airport - HOU
													</option>
													<option value="Houston, George Bush Intercontinental Airport - IAH">
														Houston, George
														Bush Intercontinental Airport - IAH
													</option>
													<option value="Lubbock - LBB">Lubbock - LBB</option>
													<option value="Midland - MAF">Midland - MAF</option>
													<option value="San Antonio International Airport - SAT">San Antonio
														International
														Airport - SAT
													</option>
												</optgroup>

												<optgroup label="Utah - UT">
													<option value="Salt Lake City - SLC">Salt Lake City - SLC</option>
												</optgroup>

												<optgroup label="Vermont - VT">
													<option value="Burlington - BTV">Burlington - BTV</option>
													<option value="Montpelier - MPV">Montpelier - MPV</option>
													<option value="Rutland - RUT">Rutland - RUT</option>
												</optgroup>

												<optgroup label="Virginia - VA">
													<option value="Dulles - IAD">Dulles - IAD</option>
													<option value="Newport News - PHF">Newport News - PHF</option>
													<option value="Norfolk - ORF">Norfolk - ORF</option>
													<option value="Richmond - RIC">Richmond - RIC</option>
													<option value="Roanoke - ROA">Roanoke - ROA</option>
												</optgroup>

												<optgroup label="Washington - WA">
													<option value="Pasco, Pasco/Tri-Cities Airport - PSC">Pasco,
														Pasco/Tri-Cities
														Airport - PSC
													</option>
													<option value="Seattle, Tacoma International Airport - SEA">Seattle,
														Tacoma
														International Airport - SEA
													</option>
													<option value="Spokane International Airport - GEG">Spokane
														International Airport -
														GEG
													</option>
												</optgroup>

												<optgroup label="West Virginia - WV">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Clarksburg - CKB">Clarksburg - CKB</option>
													<option value="Huntington Tri-State Airport - HTS">Huntington
														Tri-State Airport -
														HTS
													</option>
												</optgroup>
												<optgroup label="Wisconsin - WI">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Green Bay - GRB">Green Bay - GRB</option>
													<option value="Madison - MSN">Madison - MSN</option>
													<option value="Milwaukee - MKE">Milwaukee - MKE</option>
												</optgroup>
												<optgroup label="Wyoming - WY">
													<option value="Casper - CPR">Casper - CPR</option>
													<option value="Cheyenne - CYS">Cheyenne - CYS</option>
													<option value="Jackson Hole - JAC">Jackson Hole - JAC</option>
													<option value="Rock Springs - RKS">Rock Springs - RKS</option>
												</optgroup>
											</select>
											<input type="hidden" id="airportFromToVal"
												   value="<?= $data->airportFromTo ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="departureTimeTo">Departure Time</label>
											<input type="time" name="departureTimeTo" id="departureTimeTo"
												   class="input-sm form-control" value="<?= $data->departureTimeTo ?>">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-4">
											<label for="confirmationTo">Confirmation #</label>
											<input type="text" name="confirmationTo" id="confirmationTo"
												   class="input-sm form-control" value="<?= $data->confirmationTo ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="airportToTo">Airport To</label><br>
											<select class="form-control input-sm" name="airportToTo" style="width: 100%"
													id="airportToTo">
												<option value="">Select Airline To</option>
												<!-- Alabama -->
												<optgroup label="Alabama - AL">
													<option value="Birmingham International Airport - BHM">Birmingham
														International
														Airport - BHM
													</option>
													<option value="Dothan Regional Airport - DHN">Dothan Regional
														Airport - DHN
													</option>
													<option value="Huntsville International Airport - HSV">Huntsville
														International
														Airport - HSV
													</option>
													<option value="Mobile - MOB">Mobile - MOB</option>
													<option value="Montgomery - MGM">Montgomery - MGM</option>
												</optgroup>

												<!-- Alaska -->
												<optgroup label="Alaska - AK">
													<option value="Anchorage International Airport - ANC">Anchorage
														International
														Airport - ANC
													</option>
													<option value="Fairbanks International Airport - FAI">Fairbanks
														International
														Airport - FAI
													</option>
													<option value="Juneau International Airport - JNU">Juneau
														International Airport -
														JNU
													</option>
												</optgroup>

												<!-- Arizona -->
												<optgroup label="Arizona - AZ">
													<option value="Flagstaff - FLG">Flagstaff - FLG</option>
													<option
														value="Phoenix, Phoenix Sky Harbor International Airport - PHX">
														Phoenix,
														Phoenix Sky Harbor International Airport - PHX
													</option>
													<option value="Tucson International Airport - TUS">Tucson
														International Airport -
														TUS
													</option>
													<option value="Yuma International Airport - YUM">Yuma International
														Airport - YUM
													</option>
												</optgroup>

												<!-- Arkansas -->
												<optgroup label="Arkansas - AR">
													<option value="Fayetteville - FYV">Fayetteville - FYV</option>
													<option value="Little Rock National Airport - LIT">Little Rock
														National Airport -
														LIT
													</option>
													<option value="Northwest Arkansas Regional Airport - XNA">Northwest
														Arkansas
														Regional Airport - XNA
													</option>
												</optgroup>

												<!-- California -->
												<optgroup label="California - CA">
													<option value="Burbank - BUR">Burbank - BUR</option>
													<option value="Fresno - FAT">Fresno - FAT</option>
													<option value="Long Beach - LGB">Long Beach - LGB</option>
													<option value="Los Angeles International Airport - LAX">Los Angeles
														International
														Airport - LAX
													</option>
													<option value="Oakland - OAK">Oakland - OAK</option>
													<option value="Ontario - ONT">Ontario - ONT</option>
													<option value="Palm Springs - PSP">Palm Springs - PSP</option>
													<option value="Sacramento - SMF">Sacramento - SMF</option>
													<option value="San Diego - SAN">San Diego - SAN</option>
													<option value="San Francisco International Airport - SFO">San
														Francisco
														International Airport - SFO
													</option>
													<option value="San Jose - SJC">San Jose - SJC</option>
													<option value="Santa Ana - SNA">Santa Ana - SNA</option>
												</optgroup>

												<!-- Colorado -->
												<optgroup label="Colorado - CO">
													<option value="Aspen - ASE">Aspen - ASE</option>
													<option value="Colorado Springs - COS">Colorado Springs - COS
													</option>
													<option value="Denver International Airport - DEN">Denver
														International Airport -
														DEN
													</option>
													<option value="Grand Junction - GJT">Grand Junction - GJT</option>
													<option value="Pueblo - PUB">Pueblo - PUB</option>
												</optgroup>

												<!-- Connecticut -->
												<optgroup label="Connecticut - CT">
													<option value="Hartford - BDL">Hartford - BDL</option>
													<option value="Tweed New Haven - HVN">Tweed New Haven - HVN</option>
												</optgroup>

												<optgroup label="District of Columbia - DC">
													<option value="Washington, Dulles International Airport - IAD">
														Washington, Dulles
														International Airport
													</option>
													<option value="Washington National Airport - DCA">Washington
														National Airport -
														DCA
													</option>
												</optgroup>

												<!-- Florida -->
												<optgroup label="Florida - FL">
													<option value="Daytona Beach - DAB">Daytona Beach - DAB</option>
													<option
														value="Fort Lauderdale-Hollywood International Airport - FLL">
														Fort
														Lauderdale-Hollywood International Airport - FLL
													</option>
													<option value="Fort Myers - RSW">Fort Myers - RSW</option>
													<option value="Jacksonville - JAX">Jacksonville - JAX</option>
													<option value="Key West International Airport - EYW">Key West
														International Airport
														- EYW
													</option>
													<option value="Miami International Airport - MIA">Miami
														International Airport -
														MIA
													</option>
													<option value="Orlando - MCO">Orlando - MCO</option>
													<option value="Pensacola - PNS">Pensacola - PNS</option>
													<option value="St. Petersburg - PIE">St. Petersburg - PIE</option>
													<option value="Sarasota - SRQ">Sarasota - SRQ</option>
													<option value="Tampa - TPA">Tampa - TPA</option>
													<option value="West Palm Beach - PBI">West Palm Beach - PBI</option>
													<option value="Panama City-Bay County International Airport - PFN">
														Panama City-Bay
														County International Airport - PFN
													</option>
												</optgroup>

												<!-- Georgia -->
												<optgroup label="Georgia - GA">
													<option value="Atlanta Hartsfield International Airport - ATL">
														Atlanta Hartsfield
														International Airport - ATL
													</option>
													<option value="Augusta - AGS">Augusta - AGS</option>
													<option value="Savannah - SAV">Savannah - SAV</option>
												</optgroup>

												<!-- Hawaii -->
												<optgroup label="Hawaii - HI">
													<option value="Hilo - ITO">Hilo - ITO</option>
													<option value="Honolulu International Airport - HNL">Honolulu
														International Airport
														- HNL
													</option>
													<option value="Kahului - OGG">Kahului - OGG</option>
													<option value="Kailua - KOA">Kailua - KOA</option>
													<option value="Lihue - LIH">Lihue - LIH</option>
												</optgroup>

												<!-- Idaho -->
												<optgroup label="Idaho - ID">
													<option value="Boise - BOI">Boise - BOI</option>
												</optgroup>

												<!-- Illinois -->
												<optgroup label="Illinois - IL">
													<option value="Chicago Midway Airport - MDW">Chicago Midway Airport
														- MDW
													</option>
													<option value="Chicago, O'Hare International Airport - ORD">Chicago,
														O'Hare
														International Airport - ORD
													</option>
													<option value="Moline - MLI">Moline - MLI</option>
													<option value="Peoria - PIA">Peoria - PIA</option>
												</optgroup>

												<!-- Indiana -->
												<optgroup label="Indiana - IN">
													<option value="Evansville - EVV">Evansville - EVV</option>
													<option value="Fort Wayne - FWA">Fort Wayne - FWA</option>
													<option value="Indianapolis International Airport - IND">
														Indianapolis International
														Airport - IND
													</option>
													<option value="South Bend - SBN">South Bend - SBN</option>
												</optgroup>

												<!-- Iowa -->
												<optgroup label="Iowa - IA">
													<option value="Cedar Rapids - CID">Cedar Rapids - CID</option>
													<option value="Des Moines - DSM">Des Moines - DSM</option>
												</optgroup>

												<!-- Kansas -->
												<optgroup label="Kansas - KS">
													<option value="Wichita - ICT">Wichita - ICT</option>
												</optgroup>

												<!-- Kentucky -->
												<optgroup label="Kentucky - KY">
													<option value="Lexington - LEX">Lexington - LEX</option>
													<option value="Louisville - SDF">Louisville - SDF</option>
												</optgroup>

												<!-- Louisiana -->
												<optgroup label="Louisiana - LA">
													<option value="Baton Rouge - BTR">Baton Rouge - BTR</option>
													<option value="New Orleans International Airport - MSY">New Orleans
														International
														Airport - MSY
													</option>
													<option value="Shreveport - SHV">Shreveport - SHV</option>
												</optgroup>

												<!-- Maine -->
												<optgroup label="Maine - ME">
													<option value="Augusta - AUG">Augusta - AUG</option>
													<option value="Bangor - BGR">Bangor - BGR</option>
													<option value="Portland - PWM">Portland - PWM</option>
												</optgroup>

												<!-- Maryland -->
												<optgroup label="Maryland - MD">
													<option value="Baltimore - BWI">Baltimore - BWI</option>
												</optgroup>

												<!-- Massachusetts -->
												<optgroup label="Massachusetts - MA">
													<option value="Boston, Logan International Airport - BOS">Boston,
														Logan
														International Airport - BOS
													</option>
													<option value="Hyannis - HYA">Hyannis - HYA</option>
													<option value="Nantucket - ACK">Nantucket - ACK</option>
													<option value="Worcester - ORH">Worcester - ORH</option>
												</optgroup>

												<!-- Michigan -->
												<optgroup label="Michigan - MI">
													<option value="Battlecreek - BTL">Battlecreek - BTL</option>
													<option value="Detroit Metropolitan Airport - DTW">Detroit
														Metropolitan Airport -
														DTW
													</option>
													<option value="Detroit - DET">Detroit - DET</option>
													<option value="Flint - FNT">Flint - FNT</option>
													<option value="Grand Rapids - GRR">Grand Rapids - GRR</option>
													<option value="Kalamazoo-Battle Creek International Airport - AZO">
														Kalamazoo-Battle
														Creek International Airport - AZO
													</option>
													<option value="Lansing - LAN">Lansing - LAN</option>
													<option value="Saginaw - MBS">Saginaw - MBS</option>
												</optgroup>

												<!-- Minnesota -->
												<optgroup label="Minnesota - MN">
													<option value="Duluth - DLH">Duluth - DLH</option>
													<option value="Minneapolis/St.Paul International Airport - MSP">
														Minneapolis/St.Paul
														International Airport - MSP
													</option>
													<option value="Rochester - RST">Rochester - RST</option>
												</optgroup>

												<!-- Mississippi -->
												<optgroup label="Mississippi - MS">
													<option value="Gulfport - GPT">Gulfport - GPT</option>
													<option value="Jackson - JAN">Jackson - JAN</option>
												</optgroup>

												<!-- Missouri -->
												<optgroup label="Missouri - MO">
													<option value="Kansas City - MCI">Kansas City - MCI</option>
													<option value="St Louis, Lambert International Airport - STL">St
														Louis, Lambert
														International Airport - STL
													</option>
													<option value="Springfield - SGF">Springfield - SGF</option>
												</optgroup>

												<!-- Montana -->
												<optgroup label="Montana - MT">
													<option value="Billings - BIL">Billings - BIL</option>
												</optgroup>

												<!-- Nebraska -->
												<optgroup label="Nebraska - NE">
													<option value="Lincoln - LNK">Lincoln - LNK</option>
													<option value="Omaha - OMA">Omaha - OMA</option>
												</optgroup>

												<!-- Nevada -->
												<optgroup label="Nevada - NV">
													<option
														value="Las Vegas, Las Vegas McCarran International Airport - LAS">
														Las Vegas,
														Las Vegas McCarran International Airport - LAS
													</option>
													<option value="Reno-Tahoe International Airport - RNO">Reno-Tahoe
														International
														Airport - RNO
													</option>
												</optgroup>

												<!-- New Hampshire -->
												<optgroup label="New Hampshire - NH">
													<option value="Manchester - MHT">Manchester - MHT</option>
												</optgroup>

												<!-- New Jersey -->
												<optgroup label="New Jersey - NJ">
													<option value="Atlantic City International Airport - ACY">Atlantic
														City
														International Airport - ACY
													</option>
													<option value="Newark International Airport - EWR">Newark
														International Airport -
														EWR
													</option>
													<option value="Trenton - TTN">Trenton - TTN</option>
												</optgroup>

												<!-- New Mexico -->
												<optgroup label="New Mexico - NM">
													<option value="Albuquerque International Airport - ABQ">Albuquerque
														International
														Airport - ABQ
													</option>
													<option value="Alamogordo - ALM">Alamogordo - ALM</option>
												</optgroup>

												<!-- New York -->
												<optgroup label="New York - NY">
													<option value="Albany International Airport - ALB">Albany
														International Airport -
														ALB
													</option>
													<option value="Buffalo - BUF">Buffalo - BUF</option>
													<option value="Islip - ISP">Islip - ISP</option>
													<option
														value="New York, John F Kennedy International Airport - JFK">
														New York, John
														F Kennedy International Airport - JFK
													</option>
													<option value="New York, LaGuardia Airport - LGA">New York,
														LaGuardia Airport -
														LGA
													</option>
													<option value="Newburgh - SWF">Newburgh - SWF</option>
													<option value="Rochester - ROC">Rochester - ROC</option>
													<option value="Syracuse - SYR">Syracuse - SYR</option>
													<option value="Westchester - HPN">Westchester - HPN</option>
												</optgroup>

												<!-- North Carolina -->
												<optgroup label="North Carolina - NC">
													<option value="Asheville - AVL">Asheville - AVL</option>
													<option value="Charlotte/Douglas International Airport - CLT">
														Charlotte/Douglas
														International Airport - CLT
													</option>
													<option value="Fayetteville - FAY">Fayetteville - FAY</option>
													<option value="Greensboro - GSO">Greensboro - GSO</option>
													<option value="Raleigh - RDU">Raleigh - RDU</option>
													<option value="Winston-Salem - INT">Winston-Salem - INT</option>
												</optgroup>

												<!-- North Dakota -->
												<optgroup label="North Dakota - ND">
													<option value="Bismarck - BIS">Bismarck - BIS</option>
													<option value="Fargo - FAR">Fargo - FAR</option>
												</optgroup>

												<!-- Ohio -->
												<optgroup label="Ohio - OH">
													<option value="Akron - CAK">Akron - CAK</option>
													<option value="Cincinnati - CVG">Cincinnati - CVG</option>
													<option value="Cleveland - CLE">Cleveland - CLE</option>
													<option value="Columbus - CMH">Columbus - CMH</option>
													<option value="Dayton - DAY">Dayton - DAY</option>
													<option value="Toledo - TOL">Toledo - TOL</option>
												</optgroup>

												<!-- Oklahoma -->
												<optgroup label="Oklahoma - OK">
													<option value="Oklahoma City - OKC">Oklahoma City - OKC</option>
													<option value="Tulsa - TUL">Tulsa - TUL</option>
												</optgroup>

												<!-- Oregon -->
												<optgroup label="Oregon - OR">
													<option value="Eugene - EUG">Eugene - EUG</option>
													<option value="Portland International Airport - PDX">Portland
														International Airport
														- PDX
													</option>
													<option value="Portland, Hillsboro Airport - HIO">Portland,
														Hillsboro Airport -
														HIO
													</option>
													<option value="Salem - SLE">Salem - SLE</option>
												</optgroup>

												<!-- Pennsylvania -->
												<optgroup label="Pennsylvania - PA">
													<option value="Allentown - ABE">Allentown - ABE</option>
													<option value="Erie - ERI">Erie - ERI</option>
													<option value="Harrisburg - MDT">Harrisburg - MDT</option>
													<option value="Philadelphia - PHL">Philadelphia - PHL</option>
													<option value="Pittsburgh - PIT">Pittsburgh - PIT</option>
													<option value="Scranton - AVP">Scranton - AVP</option>
												</optgroup>

												<!-- Rhode Island -->
												<optgroup label="Rhode Island - RI">
													<option value="Providence - T.F. Green Airport - PVD">Providence -
														T.F. Green
														Airport - PVD
													</option>
												</optgroup>

												<!-- South Carolina -->
												<optgroup label="South Carolina - SC">
													<option value="Charleston - CHS">Charleston - CHS</option>
													<option value="Columbia - CAE">Columbia - CAE</option>
													<option value="Greenville - GSP">Greenville - GSP</option>
													<option value="Myrtle Beach - MYR">Myrtle Beach - MYR</option>
												</optgroup>

												<optgroup label="South Dakota - SD">
													<option value="Pierre - PIR">Pierre - PIR</option>
													<option value="Rapid City - RAP">Rapid City - RAP</option>
													<option value="Sioux Falls - FSD">Sioux Falls - FSD</option>
												</optgroup>

												<optgroup label="Tennessee - TN">
													<option value="Bristol - TRI">Bristol - TRI</option>
													<option value="Chattanooga - CHA">Chattanooga - CHA</option>
													<option value="Knoxville - TYS">Knoxville - TYS</option>
													<option value="Memphis - MEM">Memphis - MEM</option>
													<option value="Nashville - BNA">Nashville - BNA</option>
												</optgroup>

												<optgroup label="Texas - TX">
													<option value="Amarillo - AMA">Amarillo - AMA</option>
													<option value="Austin Bergstrom International Airport - AUS">Austin
														Bergstrom
														International Airport - AUS
													</option>
													<option value="Corpus Christi - CRP">Corpus Christi - CRP</option>
													<option value="Dallas Love Field Airport - DAL">Dallas Love Field
														Airport - DAL
													</option>
													<option value="Dallas/Fort Worth International Airport - DFW">
														Dallas/Fort Worth
														International Airport - DFW
													</option>
													<option value="El Paso - ELP">El Paso - ELP</option>
													<option value="Houston, William B Hobby Airport - HOU">Houston,
														William B Hobby
														Airport - HOU
													</option>
													<option value="Houston, George Bush Intercontinental Airport - IAH">
														Houston, George
														Bush Intercontinental Airport - IAH
													</option>
													<option value="Lubbock - LBB">Lubbock - LBB</option>
													<option value="Midland - MAF">Midland - MAF</option>
													<option value="San Antonio International Airport - SAT">San Antonio
														International
														Airport - SAT
													</option>
												</optgroup>

												<optgroup label="Utah - UT">
													<option value="Salt Lake City - SLC">Salt Lake City - SLC</option>
												</optgroup>

												<optgroup label="Vermont - VT">
													<option value="Burlington - BTV">Burlington - BTV</option>
													<option value="Montpelier - MPV">Montpelier - MPV</option>
													<option value="Rutland - RUT">Rutland - RUT</option>
												</optgroup>

												<optgroup label="Virginia - VA">
													<option value="Dulles - IAD">Dulles - IAD</option>
													<option value="Newport News - PHF">Newport News - PHF</option>
													<option value="Norfolk - ORF">Norfolk - ORF</option>
													<option value="Richmond - RIC">Richmond - RIC</option>
													<option value="Roanoke - ROA">Roanoke - ROA</option>
												</optgroup>

												<optgroup label="Washington - WA">
													<option value="Pasco, Pasco/Tri-Cities Airport - PSC">Pasco,
														Pasco/Tri-Cities
														Airport - PSC
													</option>
													<option value="Seattle, Tacoma International Airport - SEA">Seattle,
														Tacoma
														International Airport - SEA
													</option>
													<option value="Spokane International Airport - GEG">Spokane
														International Airport -
														GEG
													</option>
												</optgroup>

												<optgroup label="West Virginia - WV">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Clarksburg - CKB">Clarksburg - CKB</option>
													<option value="Huntington Tri-State Airport - HTS">Huntington
														Tri-State Airport -
														HTS
													</option>
												</optgroup>
												<optgroup label="Wisconsin - WI">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Green Bay - GRB">Green Bay - GRB</option>
													<option value="Madison - MSN">Madison - MSN</option>
													<option value="Milwaukee - MKE">Milwaukee - MKE</option>
												</optgroup>
												<optgroup label="Wyoming - WY">
													<option value="Casper - CPR">Casper - CPR</option>
													<option value="Cheyenne - CYS">Cheyenne - CYS</option>
													<option value="Jackson Hole - JAC">Jackson Hole - JAC</option>
													<option value="Rock Springs - RKS">Rock Springs - RKS</option>
												</optgroup>
											</select>
											<input type="hidden" id="airportToToVal" value="<?= $data->airportToTo ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="arrivalTimeTo">Arrival Time</label>
											<input type="time" name="arrivalTimeTo" id="arrivalTimeTo"
												   class="input-sm form-control" value="<?= $data->arrivalTimeTo ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Travel-From Info</label>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-4">
											<label for="travelTypeFrom">Travel Type </label>
											<select class="form-control input-sm" name="travelTypeFrom"
													id="travelTypeFrom">
												<option <?= $data->travelTypeFrom == 'Airline' ? 'selected' : '' ?>
													value="Airline">Airline
												</option>
												<option <?= $data->travelTypeFrom == 'Amtrak' ? 'selected' : '' ?>
													value="Amtrak">Amtrak
												</option>
												<option <?= $data->travelTypeFrom == 'Bus' ? 'selected' : '' ?>
													value="Bus">Bus
												</option>
											</select>
										</div>
										<div class="form-group col-md-4">
											<label for="airlineFrom">Airline </label><br>
											<select class="form-control input-sm" name="airlineFrom"
													id="airlineFrom" style="width: 100%">
												<option value="">Select Airline</option>
												<option <?= $data->airlineFrom == 'Alaska Airlines' ? 'selected' : '' ?>
													value="Alaska Airlines">Alaska Airlines
												</option>
												<option <?= $data->airlineFrom == 'Allegiant Air' ? 'selected' : '' ?>
													value="Allegiant Air">Allegiant Air
												</option>
												<option <?= $data->airlineFrom == 'American Airlines' ? 'selected' : '' ?>
													value="American Airlines">American Airlines
												</option>
												<option <?= $data->airlineFrom == 'Breeze Airways' ? 'selected' : '' ?>
													value="Breeze Airways">Breeze Airways
												</option>
												<option <?= $data->airlineFrom == 'Delta Air' ? 'selected' : '' ?>
													value="Delta Air Lines">Delta Air Lines
												</option>
												<option <?= $data->airlineFrom == 'Frontier Airlines' ? 'selected' : '' ?>
													value="Frontier Airlines">Frontier Airlines
												</option>
												<option <?= $data->airlineFrom == 'Hawaiian Airlines' ? 'selected' : '' ?>
													value="Hawaiian Airlines">Hawaiian Airlines
												</option>
												<option <?= $data->airlineFrom == 'JetBlue"' ? 'selected' : '' ?>
													value="JetBlue">JetBlue
												</option>
												<option <?= $data->airlineFrom == 'Southwest Airlines' ? 'selected' : '' ?>
													value="Southwest Airlines">Southwest Airlines
												</option>
												<option <?= $data->airlineFrom == 'Spirit Airlines' ? 'selected' : '' ?>
													value="Spirit Airlines">Spirit Airlines
												</option>
												<option <?= $data->airlineFrom == 'Sun Country Airlines' ? 'selected' : '' ?>
													value="Sun Country Airlines">Sun Country Airlines
												</option>
												<option <?= $data->airlineFrom == 'United Airlines' ? 'selected' : '' ?>
													value="United Airlines">United Airlines
												</option>
											</select>
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-4">
											<label for="specifyTravelFrom">Specify Travel </label>
											<input class="form-control input-sm"
												   type="text" <?= $data->travelTypeFrom == 'Airline' ? 'readonly' : '' ?>
												   name="specifyTravelFrom" id="specifyTravelFrom"
												   value="<?= $data->specifyTravelFrom ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="airportFromFrom">Airport From</label><br>
											<select class="form-control input-sm" name="airportFromFrom"
													style="width: 100%"
													id="airportFromFrom">
												<option value="">Select Airline From</option>
												<!-- Alabama -->
												<optgroup label="Alabama - AL">
													<option value="Birmingham International Airport - BHM">Birmingham
														International
														Airport - BHM
													</option>
													<option value="Dothan Regional Airport - DHN">Dothan Regional
														Airport - DHN
													</option>
													<option value="Huntsville International Airport - HSV">Huntsville
														International
														Airport - HSV
													</option>
													<option value="Mobile - MOB">Mobile - MOB</option>
													<option value="Montgomery - MGM">Montgomery - MGM</option>
												</optgroup>

												<!-- Alaska -->
												<optgroup label="Alaska - AK">
													<option value="Anchorage International Airport - ANC">Anchorage
														International
														Airport - ANC
													</option>
													<option value="Fairbanks International Airport - FAI">Fairbanks
														International
														Airport - FAI
													</option>
													<option value="Juneau International Airport - JNU">Juneau
														International Airport -
														JNU
													</option>
												</optgroup>

												<!-- Arizona -->
												<optgroup label="Arizona - AZ">
													<option value="Flagstaff - FLG">Flagstaff - FLG</option>
													<option
														value="Phoenix, Phoenix Sky Harbor International Airport - PHX">
														Phoenix,
														Phoenix Sky Harbor International Airport - PHX
													</option>
													<option value="Tucson International Airport - TUS">Tucson
														International Airport -
														TUS
													</option>
													<option value="Yuma International Airport - YUM">Yuma International
														Airport - YUM
													</option>
												</optgroup>

												<!-- Arkansas -->
												<optgroup label="Arkansas - AR">
													<option value="Fayetteville - FYV">Fayetteville - FYV</option>
													<option value="Little Rock National Airport - LIT">Little Rock
														National Airport -
														LIT
													</option>
													<option value="Northwest Arkansas Regional Airport - XNA">Northwest
														Arkansas
														Regional Airport - XNA
													</option>
												</optgroup>

												<!-- California -->
												<optgroup label="California - CA">
													<option value="Burbank - BUR">Burbank - BUR</option>
													<option value="Fresno - FAT">Fresno - FAT</option>
													<option value="Long Beach - LGB">Long Beach - LGB</option>
													<option value="Los Angeles International Airport - LAX">Los Angeles
														International
														Airport - LAX
													</option>
													<option value="Oakland - OAK">Oakland - OAK</option>
													<option value="Ontario - ONT">Ontario - ONT</option>
													<option value="Palm Springs - PSP">Palm Springs - PSP</option>
													<option value="Sacramento - SMF">Sacramento - SMF</option>
													<option value="San Diego - SAN">San Diego - SAN</option>
													<option value="San Francisco International Airport - SFO">San
														Francisco
														International Airport - SFO
													</option>
													<option value="San Jose - SJC">San Jose - SJC</option>
													<option value="Santa Ana - SNA">Santa Ana - SNA</option>
												</optgroup>

												<!-- Colorado -->
												<optgroup label="Colorado - CO">
													<option value="Aspen - ASE">Aspen - ASE</option>
													<option value="Colorado Springs - COS">Colorado Springs - COS
													</option>
													<option value="Denver International Airport - DEN">Denver
														International Airport -
														DEN
													</option>
													<option value="Grand Junction - GJT">Grand Junction - GJT</option>
													<option value="Pueblo - PUB">Pueblo - PUB</option>
												</optgroup>

												<!-- Connecticut -->
												<optgroup label="Connecticut - CT">
													<option value="Hartford - BDL">Hartford - BDL</option>
													<option value="Tweed New Haven - HVN">Tweed New Haven - HVN</option>
												</optgroup>

												<optgroup label="District of Columbia - DC">
													<option value="Washington, Dulles International Airport - IAD">
														Washington, Dulles
														International Airport
													</option>
													<option value="Washington National Airport - DCA">Washington
														National Airport -
														DCA
													</option>
												</optgroup>

												<!-- Florida -->
												<optgroup label="Florida - FL">
													<option value="Daytona Beach - DAB">Daytona Beach - DAB</option>
													<option
														value="Fort Lauderdale-Hollywood International Airport - FLL">
														Fort
														Lauderdale-Hollywood International Airport - FLL
													</option>
													<option value="Fort Myers - RSW">Fort Myers - RSW</option>
													<option value="Jacksonville - JAX">Jacksonville - JAX</option>
													<option value="Key West International Airport - EYW">Key West
														International Airport
														- EYW
													</option>
													<option value="Miami International Airport - MIA">Miami
														International Airport -
														MIA
													</option>
													<option value="Orlando - MCO">Orlando - MCO</option>
													<option value="Pensacola - PNS">Pensacola - PNS</option>
													<option value="St. Petersburg - PIE">St. Petersburg - PIE</option>
													<option value="Sarasota - SRQ">Sarasota - SRQ</option>
													<option value="Tampa - TPA">Tampa - TPA</option>
													<option value="West Palm Beach - PBI">West Palm Beach - PBI</option>
													<option value="Panama City-Bay County International Airport - PFN">
														Panama City-Bay
														County International Airport - PFN
													</option>
												</optgroup>

												<!-- Georgia -->
												<optgroup label="Georgia - GA">
													<option value="Atlanta Hartsfield International Airport - ATL">
														Atlanta Hartsfield
														International Airport - ATL
													</option>
													<option value="Augusta - AGS">Augusta - AGS</option>
													<option value="Savannah - SAV">Savannah - SAV</option>
												</optgroup>

												<!-- Hawaii -->
												<optgroup label="Hawaii - HI">
													<option value="Hilo - ITO">Hilo - ITO</option>
													<option value="Honolulu International Airport - HNL">Honolulu
														International Airport
														- HNL
													</option>
													<option value="Kahului - OGG">Kahului - OGG</option>
													<option value="Kailua - KOA">Kailua - KOA</option>
													<option value="Lihue - LIH">Lihue - LIH</option>
												</optgroup>

												<!-- Idaho -->
												<optgroup label="Idaho - ID">
													<option value="Boise - BOI">Boise - BOI</option>
												</optgroup>

												<!-- Illinois -->
												<optgroup label="Illinois - IL">
													<option value="Chicago Midway Airport - MDW">Chicago Midway Airport
														- MDW
													</option>
													<option value="Chicago, O'Hare International Airport - ORD">Chicago,
														O'Hare
														International Airport - ORD
													</option>
													<option value="Moline - MLI">Moline - MLI</option>
													<option value="Peoria - PIA">Peoria - PIA</option>
												</optgroup>

												<!-- Indiana -->
												<optgroup label="Indiana - IN">
													<option value="Evansville - EVV">Evansville - EVV</option>
													<option value="Fort Wayne - FWA">Fort Wayne - FWA</option>
													<option value="Indianapolis International Airport - IND">
														Indianapolis International
														Airport - IND
													</option>
													<option value="South Bend - SBN">South Bend - SBN</option>
												</optgroup>

												<!-- Iowa -->
												<optgroup label="Iowa - IA">
													<option value="Cedar Rapids - CID">Cedar Rapids - CID</option>
													<option value="Des Moines - DSM">Des Moines - DSM</option>
												</optgroup>

												<!-- Kansas -->
												<optgroup label="Kansas - KS">
													<option value="Wichita - ICT">Wichita - ICT</option>
												</optgroup>

												<!-- Kentucky -->
												<optgroup label="Kentucky - KY">
													<option value="Lexington - LEX">Lexington - LEX</option>
													<option value="Louisville - SDF">Louisville - SDF</option>
												</optgroup>

												<!-- Louisiana -->
												<optgroup label="Louisiana - LA">
													<option value="Baton Rouge - BTR">Baton Rouge - BTR</option>
													<option value="New Orleans International Airport - MSY">New Orleans
														International
														Airport - MSY
													</option>
													<option value="Shreveport - SHV">Shreveport - SHV</option>
												</optgroup>

												<!-- Maine -->
												<optgroup label="Maine - ME">
													<option value="Augusta - AUG">Augusta - AUG</option>
													<option value="Bangor - BGR">Bangor - BGR</option>
													<option value="Portland - PWM">Portland - PWM</option>
												</optgroup>

												<!-- Maryland -->
												<optgroup label="Maryland - MD">
													<option value="Baltimore - BWI">Baltimore - BWI</option>
												</optgroup>

												<!-- Massachusetts -->
												<optgroup label="Massachusetts - MA">
													<option value="Boston, Logan International Airport - BOS">Boston,
														Logan
														International Airport - BOS
													</option>
													<option value="Hyannis - HYA">Hyannis - HYA</option>
													<option value="Nantucket - ACK">Nantucket - ACK</option>
													<option value="Worcester - ORH">Worcester - ORH</option>
												</optgroup>

												<!-- Michigan -->
												<optgroup label="Michigan - MI">
													<option value="Battlecreek - BTL">Battlecreek - BTL</option>
													<option value="Detroit Metropolitan Airport - DTW">Detroit
														Metropolitan Airport -
														DTW
													</option>
													<option value="Detroit - DET">Detroit - DET</option>
													<option value="Flint - FNT">Flint - FNT</option>
													<option value="Grand Rapids - GRR">Grand Rapids - GRR</option>
													<option value="Kalamazoo-Battle Creek International Airport - AZO">
														Kalamazoo-Battle
														Creek International Airport - AZO
													</option>
													<option value="Lansing - LAN">Lansing - LAN</option>
													<option value="Saginaw - MBS">Saginaw - MBS</option>
												</optgroup>

												<!-- Minnesota -->
												<optgroup label="Minnesota - MN">
													<option value="Duluth - DLH">Duluth - DLH</option>
													<option value="Minneapolis/St.Paul International Airport - MSP">
														Minneapolis/St.Paul
														International Airport - MSP
													</option>
													<option value="Rochester - RST">Rochester - RST</option>
												</optgroup>

												<!-- Mississippi -->
												<optgroup label="Mississippi - MS">
													<option value="Gulfport - GPT">Gulfport - GPT</option>
													<option value="Jackson - JAN">Jackson - JAN</option>
												</optgroup>

												<!-- Missouri -->
												<optgroup label="Missouri - MO">
													<option value="Kansas City - MCI">Kansas City - MCI</option>
													<option value="St Louis, Lambert International Airport - STL">St
														Louis, Lambert
														International Airport - STL
													</option>
													<option value="Springfield - SGF">Springfield - SGF</option>
												</optgroup>

												<!-- Montana -->
												<optgroup label="Montana - MT">
													<option value="Billings - BIL">Billings - BIL</option>
												</optgroup>

												<!-- Nebraska -->
												<optgroup label="Nebraska - NE">
													<option value="Lincoln - LNK">Lincoln - LNK</option>
													<option value="Omaha - OMA">Omaha - OMA</option>
												</optgroup>

												<!-- Nevada -->
												<optgroup label="Nevada - NV">
													<option
														value="Las Vegas, Las Vegas McCarran International Airport - LAS">
														Las Vegas,
														Las Vegas McCarran International Airport - LAS
													</option>
													<option value="Reno-Tahoe International Airport - RNO">Reno-Tahoe
														International
														Airport - RNO
													</option>
												</optgroup>

												<!-- New Hampshire -->
												<optgroup label="New Hampshire - NH">
													<option value="Manchester - MHT">Manchester - MHT</option>
												</optgroup>

												<!-- New Jersey -->
												<optgroup label="New Jersey - NJ">
													<option value="Atlantic City International Airport - ACY">Atlantic
														City
														International Airport - ACY
													</option>
													<option value="Newark International Airport - EWR">Newark
														International Airport -
														EWR
													</option>
													<option value="Trenton - TTN">Trenton - TTN</option>
												</optgroup>

												<!-- New Mexico -->
												<optgroup label="New Mexico - NM">
													<option value="Albuquerque International Airport - ABQ">Albuquerque
														International
														Airport - ABQ
													</option>
													<option value="Alamogordo - ALM">Alamogordo - ALM</option>
												</optgroup>

												<!-- New York -->
												<optgroup label="New York - NY">
													<option value="Albany International Airport - ALB">Albany
														International Airport -
														ALB
													</option>
													<option value="Buffalo - BUF">Buffalo - BUF</option>
													<option value="Islip - ISP">Islip - ISP</option>
													<option
														value="New York, John F Kennedy International Airport - JFK">
														New York, John
														F Kennedy International Airport - JFK
													</option>
													<option value="New York, LaGuardia Airport - LGA">New York,
														LaGuardia Airport -
														LGA
													</option>
													<option value="Newburgh - SWF">Newburgh - SWF</option>
													<option value="Rochester - ROC">Rochester - ROC</option>
													<option value="Syracuse - SYR">Syracuse - SYR</option>
													<option value="Westchester - HPN">Westchester - HPN</option>
												</optgroup>

												<!-- North Carolina -->
												<optgroup label="North Carolina - NC">
													<option value="Asheville - AVL">Asheville - AVL</option>
													<option value="Charlotte/Douglas International Airport - CLT">
														Charlotte/Douglas
														International Airport - CLT
													</option>
													<option value="Fayetteville - FAY">Fayetteville - FAY</option>
													<option value="Greensboro - GSO">Greensboro - GSO</option>
													<option value="Raleigh - RDU">Raleigh - RDU</option>
													<option value="Winston-Salem - INT">Winston-Salem - INT</option>
												</optgroup>

												<!-- North Dakota -->
												<optgroup label="North Dakota - ND">
													<option value="Bismarck - BIS">Bismarck - BIS</option>
													<option value="Fargo - FAR">Fargo - FAR</option>
												</optgroup>

												<!-- Ohio -->
												<optgroup label="Ohio - OH">
													<option value="Akron - CAK">Akron - CAK</option>
													<option value="Cincinnati - CVG">Cincinnati - CVG</option>
													<option value="Cleveland - CLE">Cleveland - CLE</option>
													<option value="Columbus - CMH">Columbus - CMH</option>
													<option value="Dayton - DAY">Dayton - DAY</option>
													<option value="Toledo - TOL">Toledo - TOL</option>
												</optgroup>

												<!-- Oklahoma -->
												<optgroup label="Oklahoma - OK">
													<option value="Oklahoma City - OKC">Oklahoma City - OKC</option>
													<option value="Tulsa - TUL">Tulsa - TUL</option>
												</optgroup>

												<!-- Oregon -->
												<optgroup label="Oregon - OR">
													<option value="Eugene - EUG">Eugene - EUG</option>
													<option value="Portland International Airport - PDX">Portland
														International Airport
														- PDX
													</option>
													<option value="Portland, Hillsboro Airport - HIO">Portland,
														Hillsboro Airport -
														HIO
													</option>
													<option value="Salem - SLE">Salem - SLE</option>
												</optgroup>

												<!-- Pennsylvania -->
												<optgroup label="Pennsylvania - PA">
													<option value="Allentown - ABE">Allentown - ABE</option>
													<option value="Erie - ERI">Erie - ERI</option>
													<option value="Harrisburg - MDT">Harrisburg - MDT</option>
													<option value="Philadelphia - PHL">Philadelphia - PHL</option>
													<option value="Pittsburgh - PIT">Pittsburgh - PIT</option>
													<option value="Scranton - AVP">Scranton - AVP</option>
												</optgroup>

												<!-- Rhode Island -->
												<optgroup label="Rhode Island - RI">
													<option value="Providence - T.F. Green Airport - PVD">Providence -
														T.F. Green
														Airport - PVD
													</option>
												</optgroup>

												<!-- South Carolina -->
												<optgroup label="South Carolina - SC">
													<option value="Charleston - CHS">Charleston - CHS</option>
													<option value="Columbia - CAE">Columbia - CAE</option>
													<option value="Greenville - GSP">Greenville - GSP</option>
													<option value="Myrtle Beach - MYR">Myrtle Beach - MYR</option>
												</optgroup>

												<optgroup label="South Dakota - SD">
													<option value="Pierre - PIR">Pierre - PIR</option>
													<option value="Rapid City - RAP">Rapid City - RAP</option>
													<option value="Sioux Falls - FSD">Sioux Falls - FSD</option>
												</optgroup>

												<optgroup label="Tennessee - TN">
													<option value="Bristol - TRI">Bristol - TRI</option>
													<option value="Chattanooga - CHA">Chattanooga - CHA</option>
													<option value="Knoxville - TYS">Knoxville - TYS</option>
													<option value="Memphis - MEM">Memphis - MEM</option>
													<option value="Nashville - BNA">Nashville - BNA</option>
												</optgroup>

												<optgroup label="Texas - TX">
													<option value="Amarillo - AMA">Amarillo - AMA</option>
													<option value="Austin Bergstrom International Airport - AUS">Austin
														Bergstrom
														International Airport - AUS
													</option>
													<option value="Corpus Christi - CRP">Corpus Christi - CRP</option>
													<option value="Dallas Love Field Airport - DAL">Dallas Love Field
														Airport - DAL
													</option>
													<option value="Dallas/Fort Worth International Airport - DFW">
														Dallas/Fort Worth
														International Airport - DFW
													</option>
													<option value="El Paso - ELP">El Paso - ELP</option>
													<option value="Houston, William B Hobby Airport - HOU">Houston,
														William B Hobby
														Airport - HOU
													</option>
													<option value="Houston, George Bush Intercontinental Airport - IAH">
														Houston, George
														Bush Intercontinental Airport - IAH
													</option>
													<option value="Lubbock - LBB">Lubbock - LBB</option>
													<option value="Midland - MAF">Midland - MAF</option>
													<option value="San Antonio International Airport - SAT">San Antonio
														International
														Airport - SAT
													</option>
												</optgroup>

												<optgroup label="Utah - UT">
													<option value="Salt Lake City - SLC">Salt Lake City - SLC</option>
												</optgroup>

												<optgroup label="Vermont - VT">
													<option value="Burlington - BTV">Burlington - BTV</option>
													<option value="Montpelier - MPV">Montpelier - MPV</option>
													<option value="Rutland - RUT">Rutland - RUT</option>
												</optgroup>

												<optgroup label="Virginia - VA">
													<option value="Dulles - IAD">Dulles - IAD</option>
													<option value="Newport News - PHF">Newport News - PHF</option>
													<option value="Norfolk - ORF">Norfolk - ORF</option>
													<option value="Richmond - RIC">Richmond - RIC</option>
													<option value="Roanoke - ROA">Roanoke - ROA</option>
												</optgroup>

												<optgroup label="Washington - WA">
													<option value="Pasco, Pasco/Tri-Cities Airport - PSC">Pasco,
														Pasco/Tri-Cities
														Airport - PSC
													</option>
													<option value="Seattle, Tacoma International Airport - SEA">Seattle,
														Tacoma
														International Airport - SEA
													</option>
													<option value="Spokane International Airport - GEG">Spokane
														International Airport -
														GEG
													</option>
												</optgroup>

												<optgroup label="West Virginia - WV">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Clarksburg - CKB">Clarksburg - CKB</option>
													<option value="Huntington Tri-State Airport - HTS">Huntington
														Tri-State Airport -
														HTS
													</option>
												</optgroup>
												<optgroup label="Wisconsin - WI">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Green Bay - GRB">Green Bay - GRB</option>
													<option value="Madison - MSN">Madison - MSN</option>
													<option value="Milwaukee - MKE">Milwaukee - MKE</option>
												</optgroup>
												<optgroup label="Wyoming - WY">
													<option value="Casper - CPR">Casper - CPR</option>
													<option value="Cheyenne - CYS">Cheyenne - CYS</option>
													<option value="Jackson Hole - JAC">Jackson Hole - JAC</option>
													<option value="Rock Springs - RKS">Rock Springs - RKS</option>
												</optgroup>
											</select>
											<input type="hidden" id="airportFromFromVal"
												   value="<?= $data->airportFromFrom ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="departureTimeFrom">Departure Time</label>
											<input type="time" name="departureTimeFrom" id="departureTimeFrom"
												   class="input-sm form-control"
												   value="<?= $data->departureTimeFrom ?>">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-4">
											<label for="confirmationFrom">Confirmation #</label>
											<input type="text" name="confirmationFrom" id="confirmationFrom"
												   class="input-sm form-control" value="<?= $data->confirmationFrom ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="airportToFrom">Airport To</label><br>
											<select class="form-control input-sm" name="airportToFrom"
													style="width: 100%"
													id="airportToFrom">
												<option value="">Select Airline To</option>
												<!-- Alabama -->
												<optgroup label="Alabama - AL">
													<option value="Birmingham International Airport - BHM">Birmingham
														International
														Airport - BHM
													</option>
													<option value="Dothan Regional Airport - DHN">Dothan Regional
														Airport - DHN
													</option>
													<option value="Huntsville International Airport - HSV">Huntsville
														International
														Airport - HSV
													</option>
													<option value="Mobile - MOB">Mobile - MOB</option>
													<option value="Montgomery - MGM">Montgomery - MGM</option>
												</optgroup>

												<!-- Alaska -->
												<optgroup label="Alaska - AK">
													<option value="Anchorage International Airport - ANC">Anchorage
														International
														Airport - ANC
													</option>
													<option value="Fairbanks International Airport - FAI">Fairbanks
														International
														Airport - FAI
													</option>
													<option value="Juneau International Airport - JNU">Juneau
														International Airport -
														JNU
													</option>
												</optgroup>

												<!-- Arizona -->
												<optgroup label="Arizona - AZ">
													<option value="Flagstaff - FLG">Flagstaff - FLG</option>
													<option
														value="Phoenix, Phoenix Sky Harbor International Airport - PHX">
														Phoenix,
														Phoenix Sky Harbor International Airport - PHX
													</option>
													<option value="Tucson International Airport - TUS">Tucson
														International Airport -
														TUS
													</option>
													<option value="Yuma International Airport - YUM">Yuma International
														Airport - YUM
													</option>
												</optgroup>

												<!-- Arkansas -->
												<optgroup label="Arkansas - AR">
													<option value="Fayetteville - FYV">Fayetteville - FYV</option>
													<option value="Little Rock National Airport - LIT">Little Rock
														National Airport -
														LIT
													</option>
													<option value="Northwest Arkansas Regional Airport - XNA">Northwest
														Arkansas
														Regional Airport - XNA
													</option>
												</optgroup>

												<!-- California -->
												<optgroup label="California - CA">
													<option value="Burbank - BUR">Burbank - BUR</option>
													<option value="Fresno - FAT">Fresno - FAT</option>
													<option value="Long Beach - LGB">Long Beach - LGB</option>
													<option value="Los Angeles International Airport - LAX">Los Angeles
														International
														Airport - LAX
													</option>
													<option value="Oakland - OAK">Oakland - OAK</option>
													<option value="Ontario - ONT">Ontario - ONT</option>
													<option value="Palm Springs - PSP">Palm Springs - PSP</option>
													<option value="Sacramento - SMF">Sacramento - SMF</option>
													<option value="San Diego - SAN">San Diego - SAN</option>
													<option value="San Francisco International Airport - SFO">San
														Francisco
														International Airport - SFO
													</option>
													<option value="San Jose - SJC">San Jose - SJC</option>
													<option value="Santa Ana - SNA">Santa Ana - SNA</option>
												</optgroup>

												<!-- Colorado -->
												<optgroup label="Colorado - CO">
													<option value="Aspen - ASE">Aspen - ASE</option>
													<option value="Colorado Springs - COS">Colorado Springs - COS
													</option>
													<option value="Denver International Airport - DEN">Denver
														International Airport -
														DEN
													</option>
													<option value="Grand Junction - GJT">Grand Junction - GJT</option>
													<option value="Pueblo - PUB">Pueblo - PUB</option>
												</optgroup>

												<!-- Connecticut -->
												<optgroup label="Connecticut - CT">
													<option value="Hartford - BDL">Hartford - BDL</option>
													<option value="Tweed New Haven - HVN">Tweed New Haven - HVN</option>
												</optgroup>

												<optgroup label="District of Columbia - DC">
													<option value="Washington, Dulles International Airport - IAD">
														Washington, Dulles
														International Airport
													</option>
													<option value="Washington National Airport - DCA">Washington
														National Airport -
														DCA
													</option>
												</optgroup>

												<!-- Florida -->
												<optgroup label="Florida - FL">
													<option value="Daytona Beach - DAB">Daytona Beach - DAB</option>
													<option
														value="Fort Lauderdale-Hollywood International Airport - FLL">
														Fort
														Lauderdale-Hollywood International Airport - FLL
													</option>
													<option value="Fort Myers - RSW">Fort Myers - RSW</option>
													<option value="Jacksonville - JAX">Jacksonville - JAX</option>
													<option value="Key West International Airport - EYW">Key West
														International Airport
														- EYW
													</option>
													<option value="Miami International Airport - MIA">Miami
														International Airport -
														MIA
													</option>
													<option value="Orlando - MCO">Orlando - MCO</option>
													<option value="Pensacola - PNS">Pensacola - PNS</option>
													<option value="St. Petersburg - PIE">St. Petersburg - PIE</option>
													<option value="Sarasota - SRQ">Sarasota - SRQ</option>
													<option value="Tampa - TPA">Tampa - TPA</option>
													<option value="West Palm Beach - PBI">West Palm Beach - PBI</option>
													<option value="Panama City-Bay County International Airport - PFN">
														Panama City-Bay
														County International Airport - PFN
													</option>
												</optgroup>

												<!-- Georgia -->
												<optgroup label="Georgia - GA">
													<option value="Atlanta Hartsfield International Airport - ATL">
														Atlanta Hartsfield
														International Airport - ATL
													</option>
													<option value="Augusta - AGS">Augusta - AGS</option>
													<option value="Savannah - SAV">Savannah - SAV</option>
												</optgroup>

												<!-- Hawaii -->
												<optgroup label="Hawaii - HI">
													<option value="Hilo - ITO">Hilo - ITO</option>
													<option value="Honolulu International Airport - HNL">Honolulu
														International Airport
														- HNL
													</option>
													<option value="Kahului - OGG">Kahului - OGG</option>
													<option value="Kailua - KOA">Kailua - KOA</option>
													<option value="Lihue - LIH">Lihue - LIH</option>
												</optgroup>

												<!-- Idaho -->
												<optgroup label="Idaho - ID">
													<option value="Boise - BOI">Boise - BOI</option>
												</optgroup>

												<!-- Illinois -->
												<optgroup label="Illinois - IL">
													<option value="Chicago Midway Airport - MDW">Chicago Midway Airport
														- MDW
													</option>
													<option value="Chicago, O'Hare International Airport - ORD">Chicago,
														O'Hare
														International Airport - ORD
													</option>
													<option value="Moline - MLI">Moline - MLI</option>
													<option value="Peoria - PIA">Peoria - PIA</option>
												</optgroup>

												<!-- Indiana -->
												<optgroup label="Indiana - IN">
													<option value="Evansville - EVV">Evansville - EVV</option>
													<option value="Fort Wayne - FWA">Fort Wayne - FWA</option>
													<option value="Indianapolis International Airport - IND">
														Indianapolis International
														Airport - IND
													</option>
													<option value="South Bend - SBN">South Bend - SBN</option>
												</optgroup>

												<!-- Iowa -->
												<optgroup label="Iowa - IA">
													<option value="Cedar Rapids - CID">Cedar Rapids - CID</option>
													<option value="Des Moines - DSM">Des Moines - DSM</option>
												</optgroup>

												<!-- Kansas -->
												<optgroup label="Kansas - KS">
													<option value="Wichita - ICT">Wichita - ICT</option>
												</optgroup>

												<!-- Kentucky -->
												<optgroup label="Kentucky - KY">
													<option value="Lexington - LEX">Lexington - LEX</option>
													<option value="Louisville - SDF">Louisville - SDF</option>
												</optgroup>

												<!-- Louisiana -->
												<optgroup label="Louisiana - LA">
													<option value="Baton Rouge - BTR">Baton Rouge - BTR</option>
													<option value="New Orleans International Airport - MSY">New Orleans
														International
														Airport - MSY
													</option>
													<option value="Shreveport - SHV">Shreveport - SHV</option>
												</optgroup>

												<!-- Maine -->
												<optgroup label="Maine - ME">
													<option value="Augusta - AUG">Augusta - AUG</option>
													<option value="Bangor - BGR">Bangor - BGR</option>
													<option value="Portland - PWM">Portland - PWM</option>
												</optgroup>

												<!-- Maryland -->
												<optgroup label="Maryland - MD">
													<option value="Baltimore - BWI">Baltimore - BWI</option>
												</optgroup>

												<!-- Massachusetts -->
												<optgroup label="Massachusetts - MA">
													<option value="Boston, Logan International Airport - BOS">Boston,
														Logan
														International Airport - BOS
													</option>
													<option value="Hyannis - HYA">Hyannis - HYA</option>
													<option value="Nantucket - ACK">Nantucket - ACK</option>
													<option value="Worcester - ORH">Worcester - ORH</option>
												</optgroup>

												<!-- Michigan -->
												<optgroup label="Michigan - MI">
													<option value="Battlecreek - BTL">Battlecreek - BTL</option>
													<option value="Detroit Metropolitan Airport - DTW">Detroit
														Metropolitan Airport -
														DTW
													</option>
													<option value="Detroit - DET">Detroit - DET</option>
													<option value="Flint - FNT">Flint - FNT</option>
													<option value="Grand Rapids - GRR">Grand Rapids - GRR</option>
													<option value="Kalamazoo-Battle Creek International Airport - AZO">
														Kalamazoo-Battle
														Creek International Airport - AZO
													</option>
													<option value="Lansing - LAN">Lansing - LAN</option>
													<option value="Saginaw - MBS">Saginaw - MBS</option>
												</optgroup>

												<!-- Minnesota -->
												<optgroup label="Minnesota - MN">
													<option value="Duluth - DLH">Duluth - DLH</option>
													<option value="Minneapolis/St.Paul International Airport - MSP">
														Minneapolis/St.Paul
														International Airport - MSP
													</option>
													<option value="Rochester - RST">Rochester - RST</option>
												</optgroup>

												<!-- Mississippi -->
												<optgroup label="Mississippi - MS">
													<option value="Gulfport - GPT">Gulfport - GPT</option>
													<option value="Jackson - JAN">Jackson - JAN</option>
												</optgroup>

												<!-- Missouri -->
												<optgroup label="Missouri - MO">
													<option value="Kansas City - MCI">Kansas City - MCI</option>
													<option value="St Louis, Lambert International Airport - STL">St
														Louis, Lambert
														International Airport - STL
													</option>
													<option value="Springfield - SGF">Springfield - SGF</option>
												</optgroup>

												<!-- Montana -->
												<optgroup label="Montana - MT">
													<option value="Billings - BIL">Billings - BIL</option>
												</optgroup>

												<!-- Nebraska -->
												<optgroup label="Nebraska - NE">
													<option value="Lincoln - LNK">Lincoln - LNK</option>
													<option value="Omaha - OMA">Omaha - OMA</option>
												</optgroup>

												<!-- Nevada -->
												<optgroup label="Nevada - NV">
													<option
														value="Las Vegas, Las Vegas McCarran International Airport - LAS">
														Las Vegas,
														Las Vegas McCarran International Airport - LAS
													</option>
													<option value="Reno-Tahoe International Airport - RNO">Reno-Tahoe
														International
														Airport - RNO
													</option>
												</optgroup>

												<!-- New Hampshire -->
												<optgroup label="New Hampshire - NH">
													<option value="Manchester - MHT">Manchester - MHT</option>
												</optgroup>

												<!-- New Jersey -->
												<optgroup label="New Jersey - NJ">
													<option value="Atlantic City International Airport - ACY">Atlantic
														City
														International Airport - ACY
													</option>
													<option value="Newark International Airport - EWR">Newark
														International Airport -
														EWR
													</option>
													<option value="Trenton - TTN">Trenton - TTN</option>
												</optgroup>

												<!-- New Mexico -->
												<optgroup label="New Mexico - NM">
													<option value="Albuquerque International Airport - ABQ">Albuquerque
														International
														Airport - ABQ
													</option>
													<option value="Alamogordo - ALM">Alamogordo - ALM</option>
												</optgroup>

												<!-- New York -->
												<optgroup label="New York - NY">
													<option value="Albany International Airport - ALB">Albany
														International Airport -
														ALB
													</option>
													<option value="Buffalo - BUF">Buffalo - BUF</option>
													<option value="Islip - ISP">Islip - ISP</option>
													<option
														value="New York, John F Kennedy International Airport - JFK">
														New York, John
														F Kennedy International Airport - JFK
													</option>
													<option value="New York, LaGuardia Airport - LGA">New York,
														LaGuardia Airport -
														LGA
													</option>
													<option value="Newburgh - SWF">Newburgh - SWF</option>
													<option value="Rochester - ROC">Rochester - ROC</option>
													<option value="Syracuse - SYR">Syracuse - SYR</option>
													<option value="Westchester - HPN">Westchester - HPN</option>
												</optgroup>

												<!-- North Carolina -->
												<optgroup label="North Carolina - NC">
													<option value="Asheville - AVL">Asheville - AVL</option>
													<option value="Charlotte/Douglas International Airport - CLT">
														Charlotte/Douglas
														International Airport - CLT
													</option>
													<option value="Fayetteville - FAY">Fayetteville - FAY</option>
													<option value="Greensboro - GSO">Greensboro - GSO</option>
													<option value="Raleigh - RDU">Raleigh - RDU</option>
													<option value="Winston-Salem - INT">Winston-Salem - INT</option>
												</optgroup>

												<!-- North Dakota -->
												<optgroup label="North Dakota - ND">
													<option value="Bismarck - BIS">Bismarck - BIS</option>
													<option value="Fargo - FAR">Fargo - FAR</option>
												</optgroup>

												<!-- Ohio -->
												<optgroup label="Ohio - OH">
													<option value="Akron - CAK">Akron - CAK</option>
													<option value="Cincinnati - CVG">Cincinnati - CVG</option>
													<option value="Cleveland - CLE">Cleveland - CLE</option>
													<option value="Columbus - CMH">Columbus - CMH</option>
													<option value="Dayton - DAY">Dayton - DAY</option>
													<option value="Toledo - TOL">Toledo - TOL</option>
												</optgroup>

												<!-- Oklahoma -->
												<optgroup label="Oklahoma - OK">
													<option value="Oklahoma City - OKC">Oklahoma City - OKC</option>
													<option value="Tulsa - TUL">Tulsa - TUL</option>
												</optgroup>

												<!-- Oregon -->
												<optgroup label="Oregon - OR">
													<option value="Eugene - EUG">Eugene - EUG</option>
													<option value="Portland International Airport - PDX">Portland
														International Airport
														- PDX
													</option>
													<option value="Portland, Hillsboro Airport - HIO">Portland,
														Hillsboro Airport -
														HIO
													</option>
													<option value="Salem - SLE">Salem - SLE</option>
												</optgroup>

												<!-- Pennsylvania -->
												<optgroup label="Pennsylvania - PA">
													<option value="Allentown - ABE">Allentown - ABE</option>
													<option value="Erie - ERI">Erie - ERI</option>
													<option value="Harrisburg - MDT">Harrisburg - MDT</option>
													<option value="Philadelphia - PHL">Philadelphia - PHL</option>
													<option value="Pittsburgh - PIT">Pittsburgh - PIT</option>
													<option value="Scranton - AVP">Scranton - AVP</option>
												</optgroup>

												<!-- Rhode Island -->
												<optgroup label="Rhode Island - RI">
													<option value="Providence - T.F. Green Airport - PVD">Providence -
														T.F. Green
														Airport - PVD
													</option>
												</optgroup>

												<!-- South Carolina -->
												<optgroup label="South Carolina - SC">
													<option value="Charleston - CHS">Charleston - CHS</option>
													<option value="Columbia - CAE">Columbia - CAE</option>
													<option value="Greenville - GSP">Greenville - GSP</option>
													<option value="Myrtle Beach - MYR">Myrtle Beach - MYR</option>
												</optgroup>

												<optgroup label="South Dakota - SD">
													<option value="Pierre - PIR">Pierre - PIR</option>
													<option value="Rapid City - RAP">Rapid City - RAP</option>
													<option value="Sioux Falls - FSD">Sioux Falls - FSD</option>
												</optgroup>

												<optgroup label="Tennessee - TN">
													<option value="Bristol - TRI">Bristol - TRI</option>
													<option value="Chattanooga - CHA">Chattanooga - CHA</option>
													<option value="Knoxville - TYS">Knoxville - TYS</option>
													<option value="Memphis - MEM">Memphis - MEM</option>
													<option value="Nashville - BNA">Nashville - BNA</option>
												</optgroup>

												<optgroup label="Texas - TX">
													<option value="Amarillo - AMA">Amarillo - AMA</option>
													<option value="Austin Bergstrom International Airport - AUS">Austin
														Bergstrom
														International Airport - AUS
													</option>
													<option value="Corpus Christi - CRP">Corpus Christi - CRP</option>
													<option value="Dallas Love Field Airport - DAL">Dallas Love Field
														Airport - DAL
													</option>
													<option value="Dallas/Fort Worth International Airport - DFW">
														Dallas/Fort Worth
														International Airport - DFW
													</option>
													<option value="El Paso - ELP">El Paso - ELP</option>
													<option value="Houston, William B Hobby Airport - HOU">Houston,
														William B Hobby
														Airport - HOU
													</option>
													<option value="Houston, George Bush Intercontinental Airport - IAH">
														Houston, George
														Bush Intercontinental Airport - IAH
													</option>
													<option value="Lubbock - LBB">Lubbock - LBB</option>
													<option value="Midland - MAF">Midland - MAF</option>
													<option value="San Antonio International Airport - SAT">San Antonio
														International
														Airport - SAT
													</option>
												</optgroup>

												<optgroup label="Utah - UT">
													<option value="Salt Lake City - SLC">Salt Lake City - SLC</option>
												</optgroup>

												<optgroup label="Vermont - VT">
													<option value="Burlington - BTV">Burlington - BTV</option>
													<option value="Montpelier - MPV">Montpelier - MPV</option>
													<option value="Rutland - RUT">Rutland - RUT</option>
												</optgroup>

												<optgroup label="Virginia - VA">
													<option value="Dulles - IAD">Dulles - IAD</option>
													<option value="Newport News - PHF">Newport News - PHF</option>
													<option value="Norfolk - ORF">Norfolk - ORF</option>
													<option value="Richmond - RIC">Richmond - RIC</option>
													<option value="Roanoke - ROA">Roanoke - ROA</option>
												</optgroup>

												<optgroup label="Washington - WA">
													<option value="Pasco, Pasco/Tri-Cities Airport - PSC">Pasco,
														Pasco/Tri-Cities
														Airport - PSC
													</option>
													<option value="Seattle, Tacoma International Airport - SEA">Seattle,
														Tacoma
														International Airport - SEA
													</option>
													<option value="Spokane International Airport - GEG">Spokane
														International Airport -
														GEG
													</option>
												</optgroup>

												<optgroup label="West Virginia - WV">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Clarksburg - CKB">Clarksburg - CKB</option>
													<option value="Huntington Tri-State Airport - HTS">Huntington
														Tri-State Airport -
														HTS
													</option>
												</optgroup>
												<optgroup label="Wisconsin - WI">
													<option value="Charleston - CRW">Charleston - CRW</option>
													<option value="Green Bay - GRB">Green Bay - GRB</option>
													<option value="Madison - MSN">Madison - MSN</option>
													<option value="Milwaukee - MKE">Milwaukee - MKE</option>
												</optgroup>
												<optgroup label="Wyoming - WY">
													<option value="Casper - CPR">Casper - CPR</option>
													<option value="Cheyenne - CYS">Cheyenne - CYS</option>
													<option value="Jackson Hole - JAC">Jackson Hole - JAC</option>
													<option value="Rock Springs - RKS">Rock Springs - RKS</option>
												</optgroup>
											</select>
											<input type="hidden" id="airportToFromVal"
												   value="<?= $data->airportToFrom ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="arrivalTimeFrom">Arrival Time</label>
											<input type="time" name="arrivalTimeFrom" id="arrivalTimeFrom"
												   class="input-sm form-control" value="<?= $data->arrivalTimeFrom ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Ground Trans</label>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-4">
											<label for="groundTransCo">Ground Trans Co. </label>
											<input class="form-control input-sm" type="text"
												   name="groundTransCo" id="groundTransCo"
												   value="<?= $data->groundTransCo ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="vehicleMake">Vehicle Make</label><br>
											<input class="form-control input-sm" type="text"
												   name="vehicleMake" id="vehicleMake"
												   value="<?= $data->vehicleMake ?>">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-3">
											<label for="driverName">Driver Name</label>
											<input type="text" name="driverName" id="driverName"
												   class="input-sm form-control" value="<?= $data->driverName ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="driverPhone">Phone Number</label>
											<input type="text" name="driverPhone" id="driverPhone"
												   class="input-sm form-control" value="<?= $data->driverPhone ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="vehicleModel">Vehicle Model</label>
											<input type="text" name="vehicleModel" id="vehicleModel"
												   class="input-sm form-control" value="<?= $data->vehicleModel ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="vehicleTag">Vehicle Tag #</label>
											<input type="text" name="vehicleTag" id="vehicleTag"
												   class="input-sm form-control" value="<?= $data->vehicleTag ?>">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-2">
											<label for="pickUpTime">Pick-Up Time</label>
											<input type="time" name="pickUpTime" id="pickUpTime"
												   class="input-sm form-control" value="<?= $data->pickUpTime ?>">
										</div>
										<div class="form-group col-md-2">
											<label for="dropOffTime">Drop-Off Time</label>
											<input type="time" name="dropOffTime" id="dropOffTime"
												   class="input-sm form-control" value="<?= $data->dropOffTime ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="dropOffLocation">Drop-Off Location</label>
											<input type="text" name="dropOffLocation" id="dropOffLocation"
												   class="input-sm form-control" value="<?= $data->dropOffLocation ?>">
										</div>
										<div class="form-group col-md-4">
											<label for="groundNotes">Notes</label>
											<input type="text" name="groundNotes" id="groundNotes"
												   class="input-sm form-control" value="<?= $data->groundNotes ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="panel panel-default">
								<label for="title" class="control-label">
									Accommodations</label>
								<div class="panel-body">
									<div class="row">
										<div class="form-group col-md-3">
											<label for="hotelName">Hotel Name</label>
											<input class="form-control input-sm" type="text"
												   name="hotelName" id="hotelName" value="<?= $data->hotelName ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="hotelStay">Hotel Stay (Total Nights)</label>
											<input class="form-control input-sm" type="number" step="any" min="0"
												   name="hotelStay" id="hotelStay" value="<?= $data->hotelStay ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="confirmationAccommodation">Confirmation</label>
											<input class="form-control input-sm" type="text"
												   value="<?= $data->confirmationAccommodation ?>"
												   name="confirmationAccommodation" id="confirmationAccommodation">
										</div>
										<div class="form-group col-md-3">
											<label for="perDiem">Per Diem</label>
											<input class="form-control input-sm" type="text"
												   name="perDiem" id="perDiem" value="<?= $data->perDiem ?>">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-3">
											<label for="hotelAddress">Hotel Address</label>
											<input class="form-control input-sm" type="text"
												   name="hotelAddress" id="hotelAddress"
												   value="<?= $data->hotelAddress ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="roomType">Room Type</label>
											<input class="form-control input-sm" type="text"
												   name="roomType" id="roomType" value="<?= $data->roomType ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="checkIn">Check-In</label>
											<input type="time" name="checkIn" id="checkIn"
												   class="input-sm form-control" value="<?= $data->checkIn ?>">
										</div>
										<div class="form-group col-md-3">
											<label for="checkOut">Check-Out</label>
											<input type="time" name="checkOut" id="checkOut"
												   class="input-sm form-control" value="<?= $data->checkOut ?>">
										</div>
									</div>
									<div class="row">
										<div class="form-group col-md-6">
											<label for="accommodationNote">Notes</label>
											<input type="text" name="accommodationNote" id="accommodationNote"
												   class="input-sm form-control"
												   value="<?= $data->accommodationNote ?>">
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="box-footer">
					<div class="row">
						<div class="form-group col-md-12">
							<button type="submit" id="submit" class="btn pull-right"
									style="background-color: black; color: white">Update
							</button>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
<style>
	#remoteModal1 label {
		color: white;
	}

	.panel-default {
		background-color: #0E2231;
		color: white;
		border-color: #007bff;
		position: relative;
	}

	.control-label {
		position: absolute;
		top: -10px;
		left: 15px;
		background-color: #f8f9fa;
		padding: 0 5px;
		color: #007bff !important;
		font-size: 14px;
	}
</style>
<script>
	var airportToToVal = $('#airportToToVal').val();
	var airportToFromVal = $('#airportToFromVal').val();
	var airportFromToVal = $('#airportFromToVal').val();
	var airportFromFromVal = $('#airportFromFromVal').val();

	$('#airportToTo').val(airportToToVal).trigger("change");
	$('#airportToFrom').val(airportToFromVal).trigger("change");
	$('#airportFromFrom').val(airportFromFromVal).trigger("change");
	$('#airportFromTo').val(airportFromToVal).trigger("change");

	$('#departureTimeTo, #departureTimeFrom, #arrivalTimeTo, #arrivalTimeFrom, #pickUpTime, #dropOffTime, #checkIn, #checkOut').on('click', function (event) {
		event.preventDefault();
		$(this)[0].showPicker(); // Open the picker only for the clicked element
	});
	$(function () {
		$("#crewMemberId").select2({
			placeholder: "Select Crew Member",
			dropdownParent: $('#remoteModal1'),
			ajax: {
				url: '<?= customer_url("getCrewMemberSearch/") . $data->productionId ?>',
				dataType: 'json',
				type: "POST",
				quietMillis: 50,
				allowClear: true,
				data: function (params) {
					return {
						searchTerm: params.term
					};
				},
				processResults: function (response) {
					return {
						results: response
					};
				}
			}
		}).on('select2:select', function (event) {
			var data = event.params.data;
			console.log(data);
			$('#lastName').val(data.lastName);
			$('#airlineTo').val(data.airline).trigger('change');
			$('#airlineFrom').val(data.airline).trigger('change');
			$('#airportFromTo').val(data.airlineFrom).trigger('change');
			$('#airportToTo').val(data.airlineTo).trigger('change');
			$('#airportFromFrom').val(data.airlineFrom).trigger('change');
			$('#airportToFrom').val(data.airlineTo).trigger('change');
			$('#groundTransCo').val(data.groundTransCo);
			$('#hotelName').val(data.hotelName);
			$('#perDiem').val(data.perDiem);
			$('#hotelStay').val(data.totalNight);
		});
	});
	$('#airportFromFrom, #airportFromTo, #airportToFrom, #airportToTo').select2({
		dropdownParent: $('#remoteModal1')
	});

	$('#travelTypeTo').on('change', function () {
		var optionVal = $('#travelTypeTo').find(":selected").text();
		if (optionVal != 'Airline') {
			$('#specifyTravelTo').prop('readonly', false);
		} else {
			$('#specifyTravelTo').prop('readonly', true);
		}
	})

	$('#travelTypeFrom').on('change', function () {
		var optionVal = $('#travelTypeFrom').find(":selected").text();
		if (optionVal != 'Airline') {
			$('#specifyTravelFrom').prop('readonly', false);
		} else {
			$('#specifyTravelFrom').prop('readonly', true);
		}
	})
</script>
