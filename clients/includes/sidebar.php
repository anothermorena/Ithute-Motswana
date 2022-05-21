<!-- This navigation  menu is for the second side bar-->
<ul class="collection with-header">
  <li class="collection-item <?php if(isset($_GET["new_application"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">create_new_folder</i><a href="apply.php?new_application" class="black-text">New Application </a></li>
  <li class="collection-item <?php if(isset($_GET["my_applications"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">list</i><a href="apply.php?my_applications" class="black-text">My Applications <span class="badge deep-purple lighten-1 white-text"><?php    echo $applicationCount;?></span></a></li>
  <li class="collection-item <?php if(isset($_GET["personal_info"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">person</i><a href="apply.php?personal_info" class="black-text">Personal information </a></li>
  <li class="collection-item <?php if(isset($_GET["language"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">record_voice_over</i><a href="apply.php?language" class="black-text">Language Proficiency </a></li>
  <li class="collection-item <?php if(isset($_GET["documents"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">book</i><a href="apply.php?documents" class="black-text">Supporting Documents</a></li>
  <li class="collection-item <?php if(isset($_GET["bank_details"])){echo "active deep-purple  lighten-1";} ?>"><i class="material-icons left">credit_card</i><a href="apply.php?bank_details" class="black-text">Our Banking Details </a></li>
  <li class="collection-item <?php if(isset($_GET["our_contacts"])){echo "active deep-purple lighten-1";} ?>"><i class="material-icons left">phone_iphone</i><a href="apply.php?our_contacts" class="black-text">Our Contacts</a></li>            
</ul>
