<?php 
  include_once("layout/header.php");

  if (!isset($_SESSION['access_token'])) {
    header("Location:  http://1-grid.healingprotocols.co.za/auth/login.php");
  }
?>
<table class="table table-hover tableIssues" id="tableIssues">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Title</th>
      <th scope="col">Description Body</th>
      <th scope="col">Client</th>
      <th scope="col">Priority</th>
      <th scope="col">Type</th>
      <th scope="col">Assigned to</th>
      <th scope="col">Status</th>
    </tr>
  </thead>
  <tbody>
  </tbody>
</table>
<div class="row">
    <div class="col-md-4 col-xs-12">
      <img class="img-fluid rounded" src="assets/brand/one-1.jpg" alt="1-Grid Logo Image" />
      <div class="alert alert-info mt-4" role="alert">
        A simple 1-Grid Github Integration!
      </div>
    </div>
    <div class="col-md-8 col-xs-12">
      <form class="needs-validation" id="issueForm" method="post" novalidate>
        <div class="col-12">
          <label for="inputTitle" class="form-label">Title</label>
          <input type="text" name="title" class="form-control" id="inputTitle" required>
        </div>
        <div class="col-12">
          <label for="inputBody" class="form-label">Description</label>
          <textarea class="form-control" name="body" id="inputBody" aria-label="With textarea" required></textarea>
        </div>
        <div class="row g-2">
          <div class="col-md-4">
            <label for="inputClient" class="form-label">Client</label>
            <select id="inputClient" name="C" class="form-select" required>
              <option></option>
              <option value="Client ABC">Client ABC</option>
              <option value="Client XYZ">Client XYZ</option>
              <option value="Client MNO">Client MNO</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="inputType" class="form-label">Type</label>
            <select id="inputType" name="T" class="form-select" required>
              <option></option>
              <option value="Bug">Bug</option>
              <option value="Support">Support</option>
              <option value="Enhancement">Enhancement</option>
            </select>
          </div>
          <div class="col-md-4">
            <label for="inputPriority" class="form-label">Priority</label>
            <select id="inputPriority" name="P" class="form-select" required>
              <option></option>
              <option value="Low">Low</option>
              <option value="Medium">Medium</option>
              <option value="High">High</option>
            </select>
          </div>
          <!-- <div class="col-md-4">
            <label for="inputRepository" class="form-label">Repository</label>
            <select id="inputRepository" name="repo" class="form-select" required>
              <option value="GitIntegration" selected>GitIntegration</option>
              <option value="onegriddev">TresorOneGrid</option>
            </select>
          </div> -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary">
              Submit
            </button>
            <div id="spinner" class="text-primary pt-2" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
          </div>
      </form>
  </div>
</div>
<?php
  include_once("layout/footer.php");
?>