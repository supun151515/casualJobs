<?php
require_once("../php/header.php");
$_SESSION['dropdown'] = '1';
require_once("../php/session.php");
if($_SESSION['type'] != '1'){
	echo "You are not allowed to access this feature";
	return false;
}
?>

<title>Matched Jobs</title>
<link href="index.css" rel="stylesheet" />
<script>
var pathname = window.location.pathname;
var url      = window.location.href;
var status= '';
try{
var pieces = url.split("?");
var pieces = pieces[1];
pieces = pieces.split("&");

status = pieces[0];
status = status.split("=");
status = status[1];

var bl_id = pieces[1];
bl_id = bl_id.split("=");
bl_id = bl_id[1];
} catch(err) {

}

var parsedData;
if(status == 'pending'){
$.ajax({url:'get_bl_data.php', type:'POST', async:false, data:{status:status, bl_id: bl_id}, success:function(data){
    try{
        parsedData = JSON.parse(data);
        }catch(err){
        alertify.error(data);
        return false;
        }

}});
  $("#new_arrival").trigger("click");
BLGridSelectURL(parsedData);
}else{
  $("#new_arrival").trigger("click");
}

</script>
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12 pageHeader">Employer Dashboard</div>
    </div>
</div>
<br>
<div class="container-fluid">
	<div class="row">
		<div class="col-md-4 imgContainer align-items-center">
			<img alt="Employer" src="images/<?php echo $_SESSION['id']; ?>.jpg" class="rounded-circle pb-2" width="auto" height="200" />
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
		</div>
		<div class="col-md-8">
			<h5>
				Matched Profiles for the job<b> <?php echo $_GET['job'];?></b>, Posted on <?php echo $_GET['date']; ?> in <?php echo $_GET['loc']; ?>
			</h5>
			<table class="table table-striped w-auto">
				<thead>
					<tr>
						<th scope="col">
							#
						</th>
						<th scope="col">
							Date Posted
						</th>
						<th scope="col">
							Job Title
						</th>
						<th scope="col">
							Category
						</th>
						<th scope="col">
							Location
						</th>
						<th scope="col">
							Type
						</th>
						<th scope="col">
							
						</th>
						<th>
							
						</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>
							1
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							 <span class="badge badge-primary">4 </span> Commercial Cleaner
						</td>
						<td>
							Hospitality
						</td>
						<td>
							Lower Hutt
						</td>
						<td>
							Casual
						</td>
						<td>
							<a href="">Details</a>
						</td>
						<td>
							<a href="">Edit/Delete</a>
						</td>
					</tr>
					<tr class="table-active">
						<td>
							2
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							Commercial Cleaner
						</td>
						<td>
							Hospitality
						</td>
						<td>
							Lower Hutt
						</td>
						<td>
							Casual
						</td>
						<td>
							<a href="">Edit</a>
						</td>
						<td>
							<a href="">Delete</a>
						</td>
					</tr>
					<tr class="table-success">
						<td>
							3
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							Commercial Cleaner
						</td>
						<td>
							Hospitality
						</td>
						<td>
							Lower Hutt
						</td>
						<td>
							Casual
						</td>
						<td>
							<a href="">Edit</a>
						</td>
						<td>
							<a href="">Delete</a>
						</td>
					</tr>
					<tr class="table-warning">
						<td>
							4
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							Commercial Cleaner
						</td>
						<td>
							Hospitality
						</td>
						<td>
							Lower Hutt
						</td>
						<td>
							Casual
						</td>
						<td>
							<a href="">Edit</a>
						</td>
						<td>
							<a href="">Delete</a>
						</td>
					</tr>
					<tr class="table-danger">
						<td>
							5
						</td>
						<td>
							01/04/2012
						</td>
						<td>
							Commercial Cleaner
						</td>
						<td>
							Hospitality
						</td>
						<td>
							Lower Hutt
						</td>
						<td>
							Casual
						</td>
						<td>
							<a href="">Edit</a>
						</td>
						<td>
							<a href="">Delete</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>

</div>
<?php
 require_once("../php/footer.php");
?>