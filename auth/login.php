<?php 
  include_once("../layout/header.php");
  if (isset($_SESSION['access_token'])) {
      header("Location: http://githubissues.local/");
  }
  $secret_code = isset($_GET["secret_code"]) ? $_GET["secret_code"] : '';
  
  const CLIENT = "c8a827ff69d53682e696";
  const LOGIN_URL = "https://api.github.com/Nkwembe/onegridtresor";
  $wrong_code = false;
  /*
  
  */
  if (!empty($secret_code) && $secret_code === 'tresor') {
      $authorizeUrl = "https://github.com/login/oauth/authorize?client_id=".CLIENT;
      header("Location: $authorizeUrl");
  } else {
    if(isset($_GET["secret_code"])) {
      $wrong_code = true;
    }
  }
?>
<form class="row row-cols-lg-auto needs-validation <?=$wrong_code ? 'validated': ''?>" novalidate>
    <div class="col-6 has-validation">
        <label class="visually-hidden" for="inlineFormInputSecretCode">
            Enter Secret code to sign in
        </label>
        <input 
            type="text" class="form-control"
            name="secret_code"
            id="inlineFormInputSecretCode" 
            placeholder="Enter Secret code"
            required
        >
        <div class="invalid-feedback">
            Please provide a valid secret code in order to proceed. <br/> Use applicant name: <b>treso...</b>
        </div>
        <?php if($wrong_code) { ?>
          <div style="color: red">
            Invalid secret code. Use applicant name: <b>treso...</b>
        </div>
        <?php }?>
    </div>
    <div class="col-6">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</form>
<?php
  include_once("../layout/footer.php");
?>

