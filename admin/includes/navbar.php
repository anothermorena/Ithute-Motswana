<div  class="navbar-fixed">
     <nav>
    <div class="nav-wrapper deep-purple darken-1">
      <a href="../index.php" class="brand-logo hide-on-med-and-down"  style="font-family: Brush Script MT, cursive; font-size: 50px;position:relative;left:100px;">Ithute Motswana</a>
       <a href="#" data-activates="mobile-nav" class="button-collapse">
              <i class="fa fa-bars"></i>
            </a>
      <ul class="right hide-on-med-and-down center-align">
        <li class="<?php if(isset($_GET["all_clients"])){echo "active deep-purple lighten-1";} ?>"><a href="dashboard.php?all_clients"><i class="material-icons left">people_outline</i>All Clients <span class="badge pink white-text"><?php    echo $clients_count;?></span></a></li>
        <li class="<?php if(isset($_GET["all_applications"])){echo "active deep-purple lighten-1";} ?>"><a href="dashboard.php?all_applications"><i class="material-icons left">list</i>All Applications <span class="badge pink  white-text"><?php    echo $applications_count;?></span></a></li>
        <li class="<?php if(isset($_GET["news"])){echo "active deep-purple lighten-1";} ?>"><a href="dashboard.php?news"><i class="material-icons left">create</i>Breaking News</a></li>
        <li><a href="logout.php"><i class="material-icons left">power_settings_new</i>Logout</a></li>
      </ul>
    </div>
  </nav>
  </div>

  
  <ul class="side-nav" id="mobile-nav">
              <h4 class="purple-text text-darken-4 center">Ithute Motswana</h4>
              <li>
                <div class="divider"></div>
              </li>
              <li>
                <a href="dashboard.php?all_clients">All Clients <span class="badge pink white-text"><?php    echo $clients_count;?></span></a>
              </li>
              <li>
                <a href="dashboard.php?all_applications">All Applications <span class="badge pink  white-text"><?php    echo $applications_count;?></span></a>
              </li>
              <li>
                <a href="dashboard.php?news"> Breaking News</a>
              </li>
               <li>
                <a href="logout.php"> Logout</a>
              </li>
             
</ul>