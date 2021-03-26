<div style="height: 100%;" class="container-fluid d-flex flex-column align-items-center justify-content-center">

  <div class="d-flex flex-column justify-content-start" style="margin-bottom: 18em;">
    <h1 style="margin: 24px 0;">Register</h1>
    <div>

      <form action="/register" method="POST">
        <div class="row">
          <div class="col">
            <div class="mb-3">
              <label class="form-label">Firstname</label>
              <input type="text" class="form-control" name="firstname">
            </div>
          </div>
          <div class="col">
            <div class="mb-3">
              <label class="form-label">Lastname</label>
              <input type="text" class="form-control" name="lastname">
            </div>
          </div>
        </div>


        <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" class="form-control" name="email">
        </div>
        <div class="mb-3">
          <label class="form-label">Password</label>
          <input type="password" class="form-control" name="password">
        </div>
        <div class="mb-3">
          <label class="form-label">Confirm password</label>
          <input type="password" class="form-control" name="passwordConfirm">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
      </form>

    </div>
  </div>

</div>