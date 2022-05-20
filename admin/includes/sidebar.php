
 <ul class="collection with-header">
    <li class="collection-item <?php if(isset($_GET["all_clients"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">people_outline</i><a href="dashboard.php?all_clients" class="black-text">All Clients <span class="badge deep-purple lighten-1 white-text"><?php    echo $clients_count;?></span></a></li>
    <li class="collection-item <?php if(isset($_GET["all_applications"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">list</i><a href="dashboard.php?all_applications" class="black-text">All Applications <span class="badge deep-purple lighten-1 white-text"><?php    echo $applications_count;?></span></a></li>
    <li class="collection-item <?php if(isset($_GET["news"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">create</i><a href="dashboard.php?news" class="black-text">Breaking News</a></li>
    <li style="display:none" class="collection-item <?php if(isset($_GET["new_user"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">person_add</i><a href="dashboard.php?new_user" class="black-text">Add New User</a></li>
    <li  class="collection-item"><i class="material-icons left">power_settings_new</i><a href="logout.php" class="black-text">Logout </a></li>          
  </ul>
