<?php
require_once("../php/header.php");
require_once("../php/session.php");
if($_SESSION['type'] != '2'){
	echo "You are not allowed to access this feature";
	return false;
}
?>

<link href="../css/jquery.tagsinput-revisited.min.css" rel="stylesheet" />
<script src="../js/jquery.tagsinput-revisited.min.js"></script>
<script src="wizard.js"></script>
<script src="jobTitle.js"></script>
<script src="locations.js"></script>
<script src="locations_sub.js"></script>

<script>
var jobid = '0'
function Validate(){
	return false;
}

function getTotalHrs(){
	var t1 = $("#timefrom").jqxDateTimeInput('getDate');
	t1 = moment(t1);
	var t2 = $("#timeto").jqxDateTimeInput('getDate');
	t2 = moment(t2);
	var diffa = t2.diff(t1, 'minutes');
	diffa = moment.utc(moment.duration(diffa, "minutes").asMilliseconds()).format("HH:mm");
	$("#totalHours").html(diffa);
}
function getTotalHrsWeek(){
	var mon1 = $("#timefrommon").jqxDateTimeInput('getDate');
	mon1 = moment(mon1);
	var mon2 = $("#timetomon").jqxDateTimeInput('getDate');
	mon2 = moment(mon2);
	var totmon = mon2.diff(mon1, 'minutes');
	//totmon = moment.utc(moment.duration(totmon, "minutes").asMilliseconds()).format("HH:mm");

	var tue1 = $("#timefromtue").jqxDateTimeInput('getDate');
	tue1 = moment(tue1);
	var tue2 = $("#timetotue").jqxDateTimeInput('getDate');
	tue2 = moment(tue2);
	var tottue = tue2.diff(tue1, 'minutes');
	//tottue = moment.utc(moment.duration(tottue, "minutes").asMilliseconds()).format("HH:mm");

	var wed1 = $("#timefromwed").jqxDateTimeInput('getDate');
	wed1 = moment(wed1);
	var wed2 = $("#timetowed").jqxDateTimeInput('getDate');
	wed2 = moment(wed2);
	var totwed = wed2.diff(wed1, 'minutes');
	//totwed = moment.utc(moment.duration(totwed, "minutes").asMilliseconds()).format("HH:mm");

	var thu1 = $("#timefromthu").jqxDateTimeInput('getDate');
	thu1 = moment(thu1);
	var thu2 = $("#timetothu").jqxDateTimeInput('getDate');
	thu2 = moment(thu2);
	var totthu = thu2.diff(thu1, 'minutes');
	//totthu = moment.utc(moment.duration(totthu, "minutes").asMilliseconds()).format("HH:mm");

	var fri1 = $("#timefromfri").jqxDateTimeInput('getDate');
	fri1 = moment(fri1);
	var fri2 = $("#timetofri").jqxDateTimeInput('getDate');
	fri2 = moment(fri2);
	var totfri = fri2.diff(fri1, 'minutes');
	//totfri = moment.utc(moment.duration(totfri, "minutes").asMilliseconds()).format("HH:mm");

	var sat1 = $("#timefromsat").jqxDateTimeInput('getDate');
	sat1 = moment(sat1);
	var sat2 = $("#timetosat").jqxDateTimeInput('getDate');
	sat2 = moment(sat2);
	var totsat = sat2.diff(sat1, 'minutes');
	//totsat = moment.utc(moment.duration(totsat, "minutes").asMilliseconds()).format("HH:mm");

	var sun1 = $("#timefromsun").jqxDateTimeInput('getDate');
	sun1 = moment(sun1);
	var sun2 = $("#timetosun").jqxDateTimeInput('getDate');
	sun2 = moment(sun2);
	var totsun = sun2.diff(sun1, 'minutes');
	//totsun = moment.utc(moment.duration(totsun, "minutes").asMilliseconds()).format("HH:mm");
	var finalhours = parseFloat(totmon + tottue + totwed + totthu + totfri + totsat + totsun);
	$("#totalHours").html(moment.utc(moment.duration(finalhours, "minutes").asMilliseconds()).format("HH:mm"));
}


$(document).ready(function () {

 

$("#timefrom, #timeto, .timeweek").on('valueChanged', function (event) {
	$("#diff").is(':checked') ? getTotalHrsWeek() : getTotalHrs();
});


$('#jobTitle').on('checkChange', function (event)
{     
  var items = $("#jobTitle").jqxDropDownList('getCheckedItems');
  var checkedItems = "";
      $.each(items, function (index) {
          checkedItems += this.value + ",";
      });
      checkedItems = checkedItems.replace(/,\s*$/, "");
      jobid = checkedItems; 
});

var parsedData;
$.ajax({url:"tags.php", type:"POST", data:{jobid:jobid}, async:true, success:function(data){
          try {
            parsedData = JSON.parse(data);
            }
          catch(err) {
            alertify.error(data);
            return false;
          }
        }});


$("#skills").tagsInput({
	interactive: true,
	unique:true,
	minChars: 2,
    maxChars: 20,
	autocomplete:{
	source: function(request, response) {
  		$.ajax({
     	url: "tags.php",
     	dataType: "json",
     	type:"POST",
     	data: {
        	jobid: jobid
     		},
	     	success: function(data) {
	        	response( $.map( data, function( item ) {
	                        return {
	                            label: item.skill,
	                            value: item.skill
	                        }
	          }));

	     	}
  		})
	}}
});


$("#datestart, #dateend").jqxDateTimeInput({ formatString: "dd/MM/yyyy", width: '120px' });
$("#timefrom, #timeto, .timeweek").jqxDateTimeInput({formatString: 'HH:mm', showTimeButton: true, showCalendarButton: false, width: '80px', editMode: 'full'});

$("#diff").click(function(){
	if($(this).is(':checked')){
		$(".timeweektable").show();
	}else {
		$(".timeweektable").hide();
	}
	});

$("#finish").click(function(){
 alert("Alert");
});

$("#test").click(function(){
	 $('div.setup-panel div a.btn-success').trigger('click');
});

$("#endno").change(function(){
	$(this).is(':checked') ? $("#dateend").jqxDateTimeInput({ disabled: true }) : $("#dateend").jqxDateTimeInput({ disabled: false });
});
$("#asap").change(function(){
	$(this).is(':checked') ? $("#datestart").jqxDateTimeInput({ disabled: true }) : $("#datestart").jqxDateTimeInput({ disabled: false });
});

});// end doc.ready
    
</script>
<title>Add New Profile</title>
<link href="index.css" rel="stylesheet" />
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12 pageHeader">Job Seeker add new profile</div>
    </div>
</div>
<br>
<div class="container-fluid pb-5">
	<div class="row">
		<div class="col-md-4 imgContainer align-items-center">
			<img alt="Employer" src="../seeker/images/<?php echo $_SESSION['id']; ?>.jpg" class="rounded-circle pb-2" width="auto" height="200" />
			<div class="card bg-default">
				<h5 class="card-header">
					<?php echo $_SESSION['userName']; ?>
				</h5>
				<div class="card-body">
					<p class="card-text">
						<p><?php echo $_SESSION['address1'].' '. $_SESSION['address2'].', '. $_SESSION['suburb'].', '.$_SESSION['city'].', '.$_SESSION['postcode']; ?></p>
						<p><?php echo $_SESSION['email']; ?></p>
						<p><?php echo $_SESSION['telephone']; ?></p>
					</p>
				</div>
				<div class="card-footer">
					<a href="">Edit Profile</a>
				</div>
				<div class="card-footer">
					<a href="../php/logout.php">Logout</a>
				</div>
			</div>
		</div> <!-- end profile -->
	
	<div class="col-md-8">
		<div class="container">
    <div class="stepwizard">
        <div class="stepwizard-row setup-panel">
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-1" type="button" class="btn btn-success btn-circle">1</a>
                <p><small>Job Details</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
                <p><small>Availability</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
                <p><small>Qualifications</small></p>
            </div>
            <div class="stepwizard-step col-xs-3"> 
                <a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
                <p><small>Other</small></p>
            </div>
        </div>
    </div>
    
    <form role="form" class="" id="myform" onsubmit="return Validate();">
        <div class="panel panel-primary setup-content" id="step-1">
            <div class="panel-heading">
                 <h3 class="panel-title">Job Details</h3>
            </div>
            <div class="panel-body">
             <div class="form-group row">
				  <label class="col-md-2 control-label" for="jobtitle">Job Title</label>
				  <div class="col-md-6">
				    <div id="jobTitle"></div>
				  </div>
			</div>
              <div class="form-group row">
				  <label class="col-md-2 control-label" for="jobtype">Job Type</label>
				  <div class="col-md-4">
				    <select id="jobtype" name="jobtype" class="form-control">
				    <option value="0" selected="">Any</option>
				      <option value="1">Cacual</option>
				      <option value="2">Part-time</option>
				      <option value="3">One-Off</option>
				    </select>
				  </div>
				</div>
			<div class="form-group row">
				  <label class="col-md-2 control-label" for="joblocation">Job Location</label>
				  <div class="col-md-6">
					  <div id="location"></div>
				  </div>
			</div>
			<div class="form-group row" id="location_sub_group" style="display: none;">
				  <label class="col-md-2 control-label" for="joblocation">Sub Location</label>
				  <div class="col-md-6">
					  <div id="location_sub"></div>
				  </div>
			</div>
			<div class="form-group row">
				  <label class="col-md-2 control-label" for="payrate">Minimum Pay Rate: $/hour</label>  
				  <div class="col-md-2">
				  <input id="payrate" name="payrate" type="text" placeholder="" class="form-control input-md" value="18.90" required="">
				  </div>
			</div>
	
			<div class="form-group row">
				  <div class="col-md-6">
				    <button id="singlebutton" name="singlebutton" class="btn btn-primary nextBtn pull-right">Next</button>
				    <input type="button" id="test" value="test" />
				  </div>
			</div>
			</div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-2">
            <div class="panel-heading">
                 <h3 class="panel-title">Job Availability</h3>
            </div>
       	<div class="panel-body">
				<div class="form-group row">
				  <label class="col-md-2 control-label" for="dateend">Start Date</label>  
				  <div class="col-md-4">
				  <div id='datestart'></div>
				  </div>
				</div>

				<div class="form-group row mt-n3">
				<div class="col-md-2">
				</div>
					<div class="col-md-4"><label for="asap">
				      <input type="checkbox" name="asap" id="asap" value="1">
				      ASAP
				    </label>
			    	</div>
				</div>

				<div class="form-group row">
				  <label class="col-md-2 control-label" for="dateend">End Date</label>  
				  <div class="col-md-4">
				  <div id='dateend'></div>
				  </div>
				</div>

				<div class="form-group row mt-n3">
				<div class="col-md-2">
				</div>
					<div class="col-md-4"><label for="endno">
				      <input type="checkbox" name="endno" id="endno" value="1">
				      Any day
				    </label>
			    	</div>
				</div>
		
				<div class="form-group row">
				  <label class="col-md-2 control-label" for="timeto">From time</label>  
				  <div class="col-md-2">
				  <div id='timefrom'></div>
				  </div>
				  <label class="col-md-1 control-label" for="timeto">To </label>
				    <div class="col-md-1">
				  <div id='timeto'></div>
				  </div>
				</div>
				<div class="form-group row">
					<div class="checkbox col-md-2 control-label">
				    <label for="diff">
				      <input type="checkbox" name="diff" id="diff" value="1">
				      Different timing
				    </label>
					</div>
				</div>
				<div class="form-group timeweektable" style="display: none;">
				<table>
				<tr>
				<td width="70"><b>Mon</b></td>
				<td width="50">From</td>
				<td width="70"><div id="timefrommon" class="timeweek"></div></td>
				<td width="50" class="pl-4">To</td>
				<td width="70"><div id="timetomon" class="timeweek"></div></td>
				</tr>
				<tr>
				<td width="70"><b>Tue</b></td>
				<td width="50">From</td>
				<td width="70"><div id="timefromtue" class="timeweek"></div></td>
				<td width="50" class="pl-4">To</td>
				<td width="70"><div id="timetotue" class="timeweek"></div></td>
				</tr>
				<tr>
				<td width="70"><b>Wed</b></td>
				<td width="50">From</td>
				<td width="70"><div id="timefromwed" class="timeweek"></div></td>
				<td width="50" class="pl-4">To</td>
				<td width="70"><div id="timetowed" class="timeweek"></div></td>
				</tr>
				<tr>
				<td width="70"><b>Thu</b></td>
				<td width="50">From</td>
				<td width="70"><div id="timefromthu" class="timeweek"></div></td>
				<td width="50" class="pl-4">To</td>
				<td width="70"><div id="timetothu" class="timeweek"></div></td>
				</tr>
				<tr>
				<td width="70"><b>Fri</b></td>
				<td width="50">From</td>
				<td width="70"><div id="timefromfri" class="timeweek"></div></td>
				<td width="50" class="pl-4">To</td>
				<td width="70"><div id="timetofri" class="timeweek"></div></td>
				</tr>
				<tr>
				<td width="70"><b>Sat</b></td>
				<td width="50">From</td>
				<td width="70"><div id="timefromsat" class="timeweek"></div></td>
				<td width="50" class="pl-4">To</td>
				<td width="70"><div id="timetosat" class="timeweek"></div></td>
				</tr>
				<tr>
				<td width="70"><b>Sun</b></td>
				<td width="50">From</td>
				<td width="70"><div id="timefromsun" class="timeweek"></div></td>
				<td width="50" class="pl-4">To</td>
				<td width="70"><div id="timetosun" class="timeweek"></div></td>
				</tr>
				</table>
				</div>
				<div>Total Hours <div id="totalHours"></div></div>
			<div class="form-group row">
				  <div class="col-md-6">
				    <button id="singlebutton" name="singlebutton" class="btn btn-primary nextBtn pull-right">Next</button>
				  </div>
			</div>


       	</div>
       </div>
        
        <div class="panel panel-primary setup-content" id="step-3">
            <div class="panel-heading">
                 <h3 class="panel-title">Qualifications</h3>
            </div>
            <div class="panel-body">

            	<div class="form-group row">
					  <label class="col-md-4 control-label" for="experience"> Qualifications</label>
					  <div class="col-md-4">
					    <select id="experience" name="experience" class="form-control">
					      <option value="0">Prefer not to say</option>
					      <option value="1">Ordinary level</option>
					      <option value="2">College level</option>
					      <option value="3">High-School level</option>
					      <option value="4">University level</option>
					    </select>
					  </div>
				</div>

					<div class="form-group row">
					  <label class="col-md-4 control-label" for="experience">Experience</label>
					  <div class="col-md-4">
					    <select id="experience" name="experience" class="form-control">
					      <option value="0">Any</option>
					      <option value="1">1-3 Months</option>
					      <option value="2">3-6 Months</option>
					      <option value="3">6-12 Months</option>
					      <option value="4">12+ Months</option>
					    </select>
					  </div>
					  </div>
					  <div class="form-group row">
					  <label class="col-md-4 control-label" for="experience">Skills</label>
					  <div class="col-md-6">
					      <input type="text" id="skills" value=""><div style="font-size: 10px;">You can select skills from the list and press enter. Also you can add new tags. These new tags will be monitored by the site administrator.</div>
					  </div>
					  </div>
					  <button id="" class="btn btn-primary nextBtn pull-right" type="button">Next</button>
        </div>
        </div>
        
        <div class="panel panel-primary setup-content" id="step-4">
            <div class="panel-heading">
                 <h3 class="panel-title">Other</h3>
            </div>
            <div class="panel-body">
                <div class="form-group row">
					  <label class="col-md-4 control-label" for="visa">Visa Type</label>
					  <div class="col-md-5">
					    <select id="visa" name="visa" class="form-control">
					      <option value="0">Any</option>
					      <option value="1">Student Work Visa</option>
					      <option value="2">General Work Visa</option>
					      <option value="3">Working Holiday Visa</option>
					      <option value="4">Other Visa Type</option>
					    </select>
					  </div>
				</div>

				<div class="form-group row">
					  <label class="col-md-4 control-label" for="license">Driving License</label>
					  <div class="col-md-4">
					    <select id="license" name="license" class="form-control">
					      <option value="0">Any</option>
					      <option value="1">Full</option>
					      <option value="2">Restricted</option>
					      <option value="3">International</option>
					    </select>
					  </div>
				</div>

				<div class="form-group row">
					  <label class="col-md-4 control-label" for="vehicle">Vehicle Requirement</label>
					  <div class="col-md-4">
					    <select id="vehicle" name="vehicle" class="form-control">
					      <option value="0">No Vehicle</option>
					      <option value="1">Own Vehicle</option>
					    </select>
					  </div>
				</div>

				<div class="form-group row">
					  <label class="col-md-4 control-label" for="ethnicity">Ethnicity Requirement</label>
					  <div class="col-md-6">
					    <select id="ethnicity" name="ethnicity" class="form-control">
					      <option value="0">Prefer not to say</option>
					      <option value="1">European</option>
					      <option value="2">Māori</option>
					      <option value="3">Pasifika</option>
					      <option value="4">Asian</option>
					      <option value="5">MELAA (Middle Eastern/Latin American/African)</option>
					    </select>
					  </div>
				</div>

				<div class="form-group row">
					  <label class="col-md-4 control-label" for="age">Age</label>  
					  <div class="col-md-2">
					  <input id="age1" name="age1" value="18" type="text" placeholder="" class="form-control input-md">
					  </div>
					 
				</div>

				<div class="form-group row">
					  <label class="col-md-4 control-label" for="gender">Gender Preference</label>
					  <div class="col-md-4">
					    <select id="gender" name="gender" class="form-control">
					      <option value="0">Prefer not to say</option>
					      <option value="1" selected="">Male</option>
					      <option value="2">Female</option>
					    </select>
					  </div>
				</div>

                <button id="finish" class="btn btn-success pull-right" type="submit">Finish!</button>
            </div>
        </div>
    </form>
</div>
	
	</div>

	</div> <!-- Row end -->

</div>
<?php
require_once("../php/footer.php");
?>