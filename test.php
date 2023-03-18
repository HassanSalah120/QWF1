

   
<main class="main" id="main">
        <div class="pagetitle">
            <h1>Files</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="http://localhost/QWF/index.php">Home</a></li>
                    <li class="breadcrumb-item">edit</li>
                    <li class="breadcrumb-item active">edit files</li>
                </ol>
            </nav>
        </div>
    <!-- End Page Title -->
<!-- upload -->
    <div class="container">
        <div class="row">
            <form action="index.php" method="post" enctype="multipart/form-data">
                <h3>upload Files</h3>
                <input class="form-control" type="file"name="myfile"> <br>
                <button class="form-control btn btn-primary" type="submit" name="save">upload</button>
            </form>
             <!-- download -->
        <table class="table table-boarded"> 
            <thead>
                <th>ID</th>
                <th>Filename</th>
                <th>size (in mb)</th>
                <th>Downloads</th>
                <th>Action</th>
            </thead>
            <tbody>
                <?php foreach ($files as $file): ?>
                    <tr>
                    <td><?php echo $file['id']; ?></td>
                    <td><?php echo $file['name']; ?></td>
                    <td><?php echo floor($file['size'] / 1000) . ' KB'; ?></td>
                    <td><?php echo $file['downloads']; ?></td>
                    <td><a class="btn btn-danger" href="http://localhost/QWF/index.php?file_id=<?php echo $file['id'] ?>">Download</a></td>
                    </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        </div>
    </div>
   
 


  </main>