<?php
session_start();
if (isset($_GET['Logout'])) {
  session_unset();
  session_destroy();
  header("Location: http://localhost/QWF/index.php");
  exit();
}

if (!isset($_SESSION['admin'])) {
  header("Location: http://localhost/QWF/admin/login.php");
  exit();
}

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

if (isset($_COOKIE['mode'])) {
  $mode = $_COOKIE['mode'];
} else {
  // if not, default to light mode
  $mode = 'light';
}

// update preferred mode when form is submitted
if (isset($_POST['mode'])) {
  $mode = $_POST['mode'];
  setcookie('mode', $mode, time() + (86400 * 30), '/'); // set cookie for 30 days
}

// store the preferred mode in a session variable
$_SESSION['mode'] = $mode;


?>

<!DOCTYPE html>
<html>

<head>
  <!-- set the appropriate CSS file based on the preferred mode -->
  <?php if ($mode === 'light'): ?>
    <link rel="stylesheet" href="./QWF/assets/css/style.c1ss">
  <?php else: ?>
    <link rel="stylesheet" href="./QWF/assets/css/dark-mode.c1ss">
  <?php endif; ?>
  <!-- rest of the head content -->
  <title>My Website</title>
</head>

<header id="header" class="header fixed-top d-flex align-items-center">

  <div id="logo" class="d-flex align-items-center justify-content-between">
    <a href="http://localhost/QWF/index.php" class="logo d-flex align-items-center w-auto">
      <img src="http://localhost/QWF/assets/img/logo.png">
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

  <!-- Add the mode toggle button here -->
  <li class="nav-item ms-auto">
    <form method="post" class="d-flex align-items-center">
      <label class="me-2 mb-0"></label>
      <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" id="mode-toggle" name="mode" value="dark" <?php if ($mode === 'dark')
          echo 'checked'; ?>>
      </div>
    </form>
  </li>

  <li class="nav-item dropdown pe-3">
    <a class="nav-link nav-profile d-flex align-items-center pe-0 ms-auto" href="#" data-bs-toggle="dropdown">
      <span class="nav-link">
        <?php echo '' . $_SESSION['admin'] ?>
      </span>
    </a>
    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
      <li class="dropdown-header">
        <?php echo '' . $_SESSION['admin'] . '<br>' . '  ' . $_SESSION['rolename']; ?>
      </li>
      <li>
        <hr class="dropdown-divider">
      </li>
      <li>
        <a class="dropdown-item d-flex align-items-center" href="#">
          <i class="bi bi-box-arrow-right"></i>
          <form action="">
            <button class="btn btn-light mx-auto" name="Logout" type="submit">Logout</button>
          </form>
        </a>
      </li>
    </ul><!-- End Profile Dropdown Items -->
  </li>

</header><!-- End Header -->

<!-- mode toggle script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
  $(document).ready(function () {

    // Check for user's preferred theme
    const prefersDarkMode = window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches;
    let preferredTheme = localStorage.getItem('preferredTheme');

    // If user's preferred theme is not set in localStorage, set it based on the system preference
    if (preferredTheme === null) {
      localStorage.setItem('preferredTheme', prefersDarkMode ? 'dark' : 'light');
      preferredTheme = localStorage.getItem('preferredTheme');
    }

    // Apply user's preferred theme
    if (preferredTheme === 'dark') {
      $('link[href$="style.css"]').attr('href', '/QWF/assets/css/dark-mode.css');
      $('body').addClass('dark-mode');
    } else {
      $('link[href$="dark-mode.css"]').attr('href', '/QWF/assets/css/style.css');
      $('body').removeClass('dark-mode');
    }

    // Mode toggle button click event
    $('#mode-toggle').click(function () {
      if ($('link[href$="style.css"]').length > 0) {
        $('link[href$="style.css"]').attr('href', '/QWF/assets/css/dark-mode.css');
        localStorage.setItem('preferredTheme', 'dark');
      } else {
        $('link[href$="dark-mode.css"]').attr('href', '/QWF/assets/css/style.css');
        localStorage.setItem('preferredTheme', 'light');
      }
      $('body').toggleClass('dark-mode');
    });
  });
</script>



<aside id="sidebar" class="sidebar">


  <ul class="sidebar-nav" id="sidebar-nav">


    <br>
    <li class="nav-item">
      <a class="nav-link " href="http://localhost/QWF/index.php">
        <i class="bi bi-grid"></i>
        <span>Dashboard</span>
      </a>
      <?php if (isset($_SESSION['admin'])): ?>

      </li><!-- End Dashboard Nav -->
      <li class="nav-item">
        <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
          <i class="bi bi-layout-text-window-reverse"></i><span>Standard</span><i class="bi bi-chevron-down ms-auto"></i>
        </a>
        <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
        
        <?php
        if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
  ?>  
        <li>
            <a href="http://localhost/QWF/standarts/addSTD.php" class="btn btn-light">
              <i class="bi bi-circle"></i><span>Add Standard</span>
            </a>
            <?php
}
?>
            <a href="http://localhost/QWF/standarts/addPointer.php" class="btn btn-light">
              <i class="bi bi-circle"></i><span>Add Pointer</span>
            </a>
            <a href="http://localhost/QWF/standarts/addActivity.php" class="btn btn-light">
              <i class="bi bi-circle"></i><span>Add Activity</span>
            </a>
          </li>
          <li>
            <a href="http://localhost/QWF/standarts/viewStandard.php" class="btn btn-light"
              style="text-decoration: none;">
              <i class="bi bi-circle"></i><span>View Standard</span>
            </a>
          </li>
       
        </ul>
      </li>
      <!-- End Tables Nav -->
      <?php
// check if user is logged in and has admin role
if($_SESSION['role'] == 1 || $_SESSION['role'] == 2) {
  ?>
  <li class="nav-item">
    <a class="nav-link collapsed" data-bs-target="#admin-nav" data-bs-toggle="collapse" href="#">
      <i class="bi bi-layout-text-window-reverse"></i><span>Admin</span><i class="bi bi-chevron-down ms-auto"></i>
    </a>
    <ul id="admin-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
      <li>
        <a href="http://localhost/QWF/admin/addUsers.php" class="btn btn-light">
          <i class="bi bi-circle"></i><span>Add Users</span>
        </a>
        <a href="http://localhost/QWF/admin/users.php" class="btn btn-light">
          <i class="bi bi-circle"></i><span>List Of Users</span>
        </a>
      </li>
    </ul>
  </li>
<?php
}
?>
      </ul>
      </li>
    <?php else: ?>
      <li class="nav-item">
        <a class="nav-link collapsed" href="http://localhost/QWF/admin/login.php">
          <i class="bi bi-box-arrow-in-right"></i>
          <span>Login</span>
        </a>
      </li>
    <?php endif; ?>
  </ul>

</aside>