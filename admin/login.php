<?php
include '../shared/head.php';
include '../general/configDB.php';

session_start();

if (isset($_POST['login'])){
    $userName = $_POST['username'];
    $password = $_POST['password'];

    $select = "SELECT admins.id, admins.password, admins.roleId, role.name AS role_name
               FROM admins
               INNER JOIN role ON admins.roleid = role.id
               WHERE admins.name = '$userName'";
    $result = mysqli_query($conn, $select);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $num = mysqli_num_rows($result);
    $row = mysqli_fetch_assoc($result);

    if ($num > 0 && $row['password'] == $password) {
        echo "<h1 class='chi text-center text-primary b pt-5'>True Admin</h1>";
        $_SESSION['admin'] = $userName;
        $_SESSION['id'] = $row['id'];
        $_SESSION['role'] = $row['roleId'];
        $_SESSION['rolename'] = $row['role_name'];

        header("Refresh:0; url=http://localhost/QWF/index.php");
    } else {
        echo "<h1 class='text-center text-primary b pt-5'>Incorrect username or password</h1>";
    }
}
?>

<main>
    <div class="container">
      <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

              <div class="d-flex justify-content-center py-4">
                <a href="http://localhost/QWF/index.php" class="logo d-flex align-items-center w-auto">
                  <img src="../assets/img/logo.png" alt="">
                  <!-- <span class="d-none d-lg-block">QWF</span> -->
                </a>
              </div>
              <!-- End Logo -->

              <div class="card mb-3">

                <div class="card-body">

                  <div class="pt-4 pb-2">
                    <h5 class="card-title text-center pb-0 fs-4">Login to Your Account</h5>
                    <p class="text-center small">Enter your username & password to login</p>
                  </div>

                  <form method="POST"class="row g-3 needs-validation" >

                    <div class="col-12">
                      <label class="form-label" >Username</label>
                      <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="text" name="username" class="form-control" id="yourUsername" required>
                        <div class="invalid-feedback">Please enter your username.</div>
                      </div>
                    </div>

                    <div class="col-12">
                      <label  class="form-label">Password</label>
                      <input type="password" name="password" class="form-control" id="yourPassword" required>
                      <div class="invalid-feedback">Please enter your password!</div>
                    </div>

                    <div class="col-12">
                      <button name="login" class="btn btn-primary w-100" type="submit">Login</button>
                    </div>
                  </form>

                </div>
              </div>
            </div>
          </div>
        </div>

      </section>



    </div>
  </main><!-- End #main -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<?php include '../shared/script.php'; ?>