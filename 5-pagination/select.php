<?php

 include('config/db.php');
    $limit=5;
    
    if(isset($_GET['page']))
    {
    	$page=$_GET['page'];
    }
    else{

    	$page=1;
    }
    $start=$limit*($page-1);
  $authors = $connection->query("SELECT * FROM authors LIMIT $start,$limit")->fetchAll();
 // Get total records
  $sql = $connection->query("SELECT count(id) AS id FROM authors")->fetchAll();
  $allRecrods = $sql[0]['id'];

  // Calculate total pages
  $totoalPages = ceil($allRecrods / $limit);


?>



<!DOCTYPE html>
<html>
<head>
	 <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>PHP Pagination Example</title>
    <style>
        .container {
            max-width: 1000px
        }

        .custom-select {
            max-width: 150px
        }
    </style>
</head>
<body>

	    <!-- Datatable -->
        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Email</th>
                    <th scope="col">DOB</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($authors as $author): ?>
                <tr>
                    <th scope="row"><?php echo $author['id']; ?></th>
                    <td><?php echo $author['first_name']; ?></td>
                    <td><?php echo $author['last_name']; ?></td>
                    <td><?php echo $author['email']; ?></td>
                    <td><?php echo $author['birthdate']; ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Pagination -->
        <nav aria-label="Page navigation example mt-5">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if($page <= 1){ echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page <= 1){ echo '#'; } else { echo "?page=" . $prev; } ?>">Previous</a>
                </li>

                <?php for($i = 1; $i <= $totoalPages; $i++ ): ?>
                <li class="page-item <?php if($page == $i) {echo 'active'; } ?>">
                    <a class="page-link" href="select.php?page=<?= $i; ?>"> <?= $i; ?> </a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?php if($page >= $totoalPages) { echo 'disabled'; } ?>">
                    <a class="page-link"
                        href="<?php if($page >= $totoalPages){ echo '#'; } else {echo "?page=". $next; } ?>">Next</a>
                </li>
            </ul>
        </nav>


</body>
</html>