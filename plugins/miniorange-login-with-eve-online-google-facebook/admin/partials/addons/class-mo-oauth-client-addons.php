<?php
	
class Mo_OAuth_Client_Admin_Addons {

  public static function addons() {
      self::addons_page();
	}
    
    public static function addons_page(){
?>

<style>
.outermost-div {
  color: #424242;
  font-family: Open Sans!important;
  font-size: 14px;
  line-height: 1.4;
  letter-spacing: 0.3px;
}

.column_container {
  position: relative;
  box-sizing: border-box;
  margin-top: 30px;
}  

.column_container > .column_inner {
  
  box-sizing: border-box;
  padding-left: 20px;
  padding-right: 20px;
  width: 100%;
} 

.benefits-outer-block{
  padding-left: 3em;
  padding-right: 3em;
  padding-top: 2em;
  width: 77%;
  margin: 0;
  padding-bottom: 1em;
  background:#fff;
  height:246px;
}

.benefits-outer-block:hover{
 margin-top: -10px;
 border-top: 5px solid #0063ae;
 transition: all .2s ease-in-out;
}

.benefits-icon {
  font-size: 25px;
  padding-top: 6px;
  padding-right: 8px;
  padding-left: 8px;
  border-radius: 3px;
  padding-bottom: 5px;
  background: #1779ab;
  color: #fff;
}

h5 {
  font-weight: 700;
  font-size: 16px;
  line-height: 20px;
  text-transform: none;
  letter-spacing: 0.5px;
  color: #585858;
}

@media (min-width: 768px) {
  .grid_view {
    width: 50%;
    float: left;
  }
  .row-view {
    width: 100%;
    position: relative;
    display: inline-block;
  }
}

/*Content Animation*/
@keyframes fadeInScale {
  0% {
  	transform: scale(0.9);
  	opacity: 0;
  }
  
  100% {
  	transform: scale(1);
  	opacity: 1;
  }
}
</style>

<div class="outermost-div">
  <div class="row-view">
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <img src="<?php echo plugins_url("images/page-restriction.png", __FILE__) ?>" width="40px" height="40px">
          <h5 style="margin-top:1em;">Page Restriction</h5>
          <p>Allows to restrict access to WordPress pages/posts based on user roles and their login status, thereby preventing them from unauthorized access.</p>
        </div>
      </div>
    </div>      
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <img src="<?php echo plugins_url("images/buddypress-logo.png", __FILE__) ?>" width="40px" height="40px">
          <h5 style="margin-top:1em;">BuddyPress Integrator</h5>
          <p>Allows to integrate user information received from OAuth/OpenID Provider with the BuddyPress profile.</p>
        </div>
      </div>
    </div>  
  </div>
  <div class="row-view">
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <img src="<?php echo plugins_url("images/login-form.png", __FILE__) ?>" width="40px" height="40px">
          <h5 style="margin-top:1em;">Login Form Add-on</h5>
          <p>Provides Login form for OAuth/OpenID login instead of a only a button. It relies on OAuth/OpenID plugin to have Password Grant configured. It can be customized using custom CSS and JS.</p>
        </div>
      </div>
    </div>
    <div class="grid_view column_container">
      <div class="column_inner">
        <div class="row benefits-outer-block">
          <img src="<?php echo plugins_url("images/member-login.png", __FILE__) ?>" width="40px" height="40px">
          <h5 style="margin-top:1em;">Membership Level based Login Redirection</h5>
          <p>Allows to redirect users to custom pages based on users' membership levels. Checks for the user's membership level during every login, so any update on the membership level doesn't affect redirection.</p>
        </div>
      </div>    
    </div>  
  </div>
</div>

<?php
    }
}