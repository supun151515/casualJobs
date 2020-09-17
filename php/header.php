<?php
if (session_status() == PHP_SESSION_NONE) {
   ini_set('session.gc_maxlifetime', 288000);
   session_set_cookie_params(28800);
   session_start();
}
if(!isset($_SESSION['dropdown'])){
   $_SESSION['dropdown'] = '1'; 
}

require_once("../php/include.php")
?>
<body style="margin:0; padding: 0">
   <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="/">

              <!--  <img class="logo_image" src="https://moodle.weltec.ac.nz/theme/image.php/weltec/theme/1575238179/logo" alt="" />
                -->

            <img class="logo_image" src="../css/images/logo.png" alt="" />
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item btn btn-sm btn-outline-secondary active">
                            <a class="menu_link" href="../home">Home</a>
                    </li>
                    <li class="nav-item btn btn-sm btn-outline-secondary">
                        <a class="menu_link" href="../employer">Employer</a>
                    </li>
                    <li class="nav-item btn btn-sm btn-outline-secondary">
                        <a class="menu_link" href="../seeker">Job Seeker</a>
                    </li>
                      <li class="nav-item btn btn-sm btn-outline-secondary">
                        <a class="menu_link "href="../home">About Us</a>
                    </li>
                      <li class="nav-item btn btn-sm btn-outline-secondary">
                        <a class="menu_link" href="../home">Contact Us</a>
                    </li>
                </ul>
         
            </div>
                   <?php
                    if(isset($_SESSION['email'])){
                        echo '<span class="webdev">Welcome <b>'.$_SESSION['email'] .'</b>
                &nbsp;&nbsp;&nbsp;&nbsp;<a class="menu_link" style="font-size:12px;text-decoration: underline" href="../php/logout.php">Logout</a>
                </span>';
                    }else{
                    echo '<span class="webdev"><a class="menu_link mybtn1" href="../register">Register Now</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="menu_link mybtn2" href="../login">Login</a>
                </span>';
                    }
                ?>
            </div>
    </nav>
