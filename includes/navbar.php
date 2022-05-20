

  <header class="main-header">
      <nav class="transparent">
        <div class="container">
          <div class="nav-wrapper">
            <a
              href="index.php"
              class="brand-logo hide-on-small-and-down"
              >Ithute Motswana</a
            >
            <a href="#" data-activates="mobile-nav" class="button-collapse">
              <i class="fa fa-bars"></i>
            </a>
            <ul class="right hide-on-med-and-down">
              <li>
                <a  href="index.php">Home</a>
              </li>
              <li>
                <a href="updates.php">Updates/News</a>
              </li>
             <?php 
              if(isset($_SESSION["customer_session"])){?>
               <li><a href="clients/home.php"> Application Dashboard</a></li>
              <li style="display:none;">
                <a href="signup.php">Sign Up</a>
              </li>
            
              <li>
                <a href="logout.php" id="" class="btn purple">Logout</a>
              </li>
               <?php } else { ?>
                 <li>
                <a href="signup.php">Sign Up</a>
              </li>
                <li>
                <a href="login.php" id="" class="btn purple">Login</a>
              </li>
               <?php } ?>
              <li>
                <a href="https://www.facebook.com/ithutemotswana/" target="_blank" class="tooltipped" data-tooltip="Our Facebook Page">
                  <i class="fab fa-facebook " ></i>
                </a>
              </li>
              <li>
                <a href="https://www.instagram.com/ithute_motswana/" target="_blank" class="tooltipped" data-tooltip="Our Instagram Page">
                  <i class="fab fa-instagram"></i>
                </a>
              </li>
            </ul>
            <ul class="side-nav" id="mobile-nav">
              <h4 class="purple-text text-darken-4 center">Ithute Motswana</h4>
              <li>
                <div class="divider"></div>
              </li>
              <li>
                <a href="index.php">
                  <i class="fa fa-home grey-text text-darken-4"></i> Home</a
                >
              </li>
              <li>
                <a href="updates.php">
                  <i class="fa fa-newspaper grey-text text-darken-4"></i> News/Updates</a
                >
              </li>
              <?php 
              if(isset($_SESSION["customer_session"])){?>
              <li style="display:none">
                <a href="signup.php">
                  <i class="fa fa-user grey-text text-darken-4"></i> Sign Up</a
                >
              </li>
              <li>
                <a href="clients/home.php">
                  <i class="fa fa-newspaper grey-text text-darken-4"></i> Application Dashboard</a
                >
              </li>
             
              <li>
                <div class="divider"></div>
              </li>
              <li>
                <a href="logout.php"  class="btn purple">Logout</a>
              </li>
               <?php } else {?>
                <li >
                <a href="signup.php">
                  <i class="fa fa-user grey-text text-darken-4"></i> Sign Up</a
                >
              </li>
                <li>
                <a href="login.php"  class="btn purple">Login</a>
               </li> <?php } ?>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Showcase -->
      <div class="showcase container">
        <div class="row">
          <div class="col s12 m10 offset-m1 center">
            <h5>Welcome To Ithute Motswana</h5>
            <h1>Your Door To The Future.</h1>
            <p>
              We help Batswana stand a great chance of getting admissions into Chinese Universities and fully funded scholarships.  
            </p>
            <br />
            <br />
            <a href="details.php" class="btn btn-large white purple-text"
              >Scholarship Details</a
            >  
            <?php
             if(!isset($_SESSION["customer_session"])){?> 
            <a href="signup.php" class="btn btn-large purple white-text"
              >Sign Up And Apply</a>

             <?php } ?>
           
          </div>
        </div>
      </div>
    </header>


