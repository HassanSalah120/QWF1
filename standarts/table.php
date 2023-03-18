<?php
include '../shared/head.php';
include '../shared/nav.php';
include '../general/configDB.php';
include '../general/functions.php';
$stdID = $_GET['StdID'];
$user_id = $_SESSION['id'];
$userrole = $_SESSION['role'];
if ($userrole == 1 || $userrole == 2) {
  $select = "SELECT activites.id, activites.actv, activites.manager, activites.from, activites.to, activites.output, activites.goalID, activites.pointerID,
        standard_pointer.pointerName, standard_pointer.pointerID, standard_pointer.goalname,
        standarts.StdName, standarts.StdID 
        FROM activites
        JOIN standard_pointer ON activites.pointerID = standard_pointer.pointerID
        JOIN standarts ON activites.stdID = standarts.StdID
        WHERE standarts.stdID=$stdID";
} else {
  $select = "SELECT activites.id, activites.actv, activites.manager, activites.from, activites.to, activites.output, activites.goalID, activites.pointerID,
        standard_pointer.pointerName, standard_pointer.pointerID, standard_pointer.goalname,
        standarts.StdName, standarts.StdID 
        FROM activites
        JOIN standard_pointer ON activites.pointerID = standard_pointer.pointerID
        JOIN standarts ON activites.stdID = standarts.StdID
        JOIN admin_std ON standarts.StdID = admin_std.std_id
        WHERE admin_std.user_id = $user_id AND standarts.stdID=$stdID";
}
$s = mysqli_query($conn, $select);
?>
<main id="main" class="main">
  <div class="pagetitle">
    <h1>Standarts</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
        <li class="breadcrumb-item">table</li>
        <li class="breadcrumb-item active">Standarts</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->
  <div class="container mt-5">
    <div class="row card p-5" class="tatest">
      <div class="col-12">
        <table class="table table-bordered" style="direction:rtl;">
          <thead>
            <tr>
              <th scope="col" rowspan="'.count($s).'">المعيار</th>
              <th scope="col">مؤشرات المعيار</th>
              <th scope="col">الاهداف</th>
              <th scope="col">الانشطة</th>
              <th scope="col">مسئول التنفيذ</th>
              <th scope="col"> من</th>
              <th scope="col"> الى</th>
              <th class="text-center" scope="col" colspan="3"> المخرجات</th>
            </tr>
          </thead>
          <tbody>
            <?php $prev_stdname = ''; ?>
            <?php foreach ($s as $index => $activities) { ?>
              <tr>
                <?php if ($activities['StdName'] != $prev_stdname) { ?>
                  <td rowspan="0">
                    <?php echo $activities['StdName']; ?>
                  </td>
                <?php } ?>
                <td>
                  <?php echo $activities['pointerName']; ?>
                </td>
                <td>
                  <?php echo $activities['goalname']; ?>
                </td>
                <td>
                  <?php echo $activities['actv']; ?>
                </td>
                <td>
                  <?php echo $activities['manager']; ?>
                </td>
                <td>
                  <?php echo $activities['from']; ?>
                </td>
                <td>
                  <?php echo $activities['to']; ?>
                </td>
                <td>
                  <?php echo $activities['output']; ?>
                </td>
                <td>
                  <a class="btn btn-primary"
                    href="../Files/downloads.php?StdID=<?php echo $activities['StdID']; ?>&pointerID=<?php echo $activities['pointerID']; ?>&goalname=<?php echo urlencode($activities['goalname']); ?>&id=<?php echo urlencode($activities['id']); ?>">Download</a>
                </td>
                <td>
                  <a class="btn btn-danger"
                    href="../Files/upload.php?StdName=<?php echo urlencode($activities['StdName']); ?>&pointerID=<?php echo urlencode($activities['pointerID']); ?>&output=<?php echo urlencode($activities['output']); ?> &id=<?php echo urlencode($activities['id']); ?>">Upload</a>
                </td>
                <?php if ($activities['StdName'] != $prev_stdname) { ?>
                  <?php $prev_stdname = $activities['StdName']; ?>
                <?php } else { ?>
                <?php } ?>
              </tr>
            <?php } ?>
          </tbody>

        </table>
      </div>
    </div>
  </div>
</main>
<?php include '../shared/script.php'; ?>