<?php 
  include_once("../layout/header.php");

  if (isset($_SESSION['access_token'])) {
      header("Location:"  . $config['host']);
  }
  //current security code is: tresor
  $secret_code = isset($_GET["secret_code"]) ? $_GET["secret_code"] : '';

  $wrong_code = false;

  if (!empty($secret_code) && $secret_code === 'tresor') {
    header("Location: https://github.com/login/oauth/authorize?client_id=". $config['client_id']);
  } else {
    if(isset($_GET["secret_code"])) {
      $wrong_code = true;
    }
  }
?>

<form class="row row-cols-lg-auto needs-validation" novalidate>
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

