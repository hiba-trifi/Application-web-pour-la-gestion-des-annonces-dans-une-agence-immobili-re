<link rel="stylesheet" href="style.css">
<?php 
error_reporting(E_ERROR|E_PARSE);
 while ($row = mysqli_fetch_assoc($result)) {
 if(isset($row['Id_ac'])){

  $query_img = mysqli_query($connect, "SELECT * FROM image INNER JOIN annonce ON image.Id_ac=annonce.Id_ac where img_Principale=1 AND image.Id_ac=$row[Id_ac]");
  $row_img = mysqli_fetch_assoc($query_img);

  echo "
 
  <div class='card  col-xs-12  col-md-5  col-xl-3 my-5 ' style='width:400px;hight:400px'>

  <img src='./img/$row_img[Titre_img]' class='card-img-top' alt='$row_img[Titre_img]'>
  <div class='card-body'>
    <h5 class='card-title text-info'>$row[Titre]</h5>
    <h6 class='list-group-item '>$row[Adresse]</h6>
    <ol class='list-group mb-3  list-group-flush'>

    <li class='list-group-item   d-flex justify-content-between align-items-start'>
    <div class='ms-2 me-auto'>
      <div class='fw-bold text-secondary' >Ville</div>
      $row[ville]
    </div>
    </li>
    
    <li class='list-group-item   d-flex justify-content-between align-items-start'>
    <div class='ms-2 me-auto'>
      <div class='fw-bold text-secondary' >Categorie</div>
      $row[categorie]
    </div>
    </li>

    <li class='list-group-item d-flex justify-content-between align-items-start'>
      <div class='ms-2 me-auto'>
        <div class='fw-bold text-secondary' >Type</div>
        $row[type]
      </div>
    </li>

    <li class='list-group-item d-flex justify-content-between align-items-start'>
      <div class='ms-2 me-auto'>
        <div class='fw-bold text-secondary' >Superficie</div>
        $row[Superficie]m²
      </div>
    </li>

    <li class='list-group-item d-flex justify-content-between align-items-start'>
  
  </li> 
  </ol>
  <div class='ms-2 me-auto d-flex justify-content-between'>
  <h4 class='btn btn-outline-info fw-bold text-dark btn-lg'> $row[Prix] DH </h4> 
    <a href='details.php?Id_ac=".$row['Id_ac']."' class='btn btn-lg btn-info  ' >Plus De Detail</a>
      </div>
      
      
      <div class='btn-group d-flex justify-content-between mt-3 mx-5  ' role='group' aria-label='Basic mixed styles example'>
     
      <form method='POST' action='./delete.php'>
      <input type='hidden' name='id_ac' value='$row[Id_ac]'>
      <button type='submit' name='delete' class='btn btn-lg bg-info text-dark' ><i class='fa-solid fa-trash'></i></button>
      </form>

      <form method='POST' action='./edit.php'>
    <input type='hidden' name='id_ac' value='$row[Id_ac]'>
    <button type='submit' name='edit' class='btn btn-lg bg-info text-dark' ><i class='fa-solid fa-pen-to-square'></i></button>
</form>
    </div>
    <div> Publiée le : $row[Date_pub]</div>
    </div>
 
</div>

  ";
 
};
}
  ?>
