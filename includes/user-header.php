<!DOCTYPE HTML>
<html>
	<head>
		<title>E-Mart</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

		<!-- STYLES -->
		<link rel="stylesheet" href="../css/animate.css">
		<link rel="stylesheet" href="../css/skel.css" />
		<!-- <link rel="stylesheet" href="../css/style-desktop.css" /> -->
		<link rel="stylesheet" href="../css/override.css" />
		<link rel="stylesheet" href="../css/bootstrap.css" />
		<link rel="stylesheet" href="../css/styleInspinia.css" />

	</head>
	<body>
		<!--SCRIPTS-->
	    <script src="../js/sails.io.js"></script>
	    <script src="../js/jquery.js"></script>
	    <script src="../js/app.js"></script>
	    <script src="../js/inspinia.js"></script>
	    <script src="../js/plugins/backbone.js"></script>
	    <script src="../js/plugins/bootstrap.js"></script>
	    <script src="../js/plugins/jquery.metisMenu.js"></script>
	    <script src="../js/plugins/underscore.js"></script>

	    <!--SCRIPTS END-->

	<style>
      body{
          background: #2980b9;
      }
    </style>

    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li class="nav-header">

                    <div class="dropdown profile-element"> 
                        <span>
                          <?php  
                            $query = "SELECT first_name, last_name FROM user WHERE id='". $_SESSION['USER_ID'] . "';";
                            if($result = mysqli_query($conn, $query)) {
                                while ($row = mysqli_fetch_assoc($result)) {
                        //   echo '<img alt="image" class="img-circle" src="' . $row['picture'] . '" width="48" height="48"/>
                        // </span>
                        // <a data-toggle="dropdown" class="dropdown-toggle" href="/">
                        //   <span class="clear"> 
                        //     <span class="block m-t-xs"> 
                        //       <strong class="font-bold">';
                              
                                        echo $row['first_name'] . " " . $row['last_name'];
                                    }
                                } ?> 
                               <b class="caret"></b></strong>
                            </span> 
                          </span> 
                        </a>
                        <ul class="dropdown-menu animated fadeInRight m-t-xs">
                            <li><a href="#">Settings</a></li>
                            <li><a href="#">Billing</a></li>
                            <li><a href="#">Support</a></li>
                            <li><a href="logout.php">Logout</a></li>
                        </ul>
                    </div>
                    <div class="logo-element">
                      USSC                        
                    </div>

                </li>
                <li class="active" >
                    <a href="./"><i class="fa fa-bar-chart-o"></i> <span class="nav-label">Dashboard</span> </a>

                </li>

                <li>
                    <a href="/"><i class="fa fa-chain"></i> <span class="nav-label">Connections</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li><a href="#">Shippers</a></li>
                        <li><a href="#">Seafood Handlers</a></li>
                        <li><a href="#">Customers</a></li>
                    </ul>
                </li>

                <li>
                    <a href="#"><i class="fa fa-truck"></i><span class="nav-label">Pickups</span></a>
                </li>

                <li>
                    <a href="team.php"><i class="fa fa-users"></i><span class="nav-label">Team</span></a>
                </li>

                <li>
                    <a href="#"><i class="fa fa-flash"></i><span class="nav-label">Activity</span></a>
                </li>

            </ul>

        </div>
    </nav>
