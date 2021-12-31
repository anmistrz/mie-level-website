
<script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

<?php
    if (isset($_POST['search'])) {
        require 'functions.php';

        // array id_menu makanan (Untuk Button)
        $sql1 = " SELECT id_menu FROM menu WHERE id_menu LIKE '%MKN%' ";
        $result = mysqli_query($conn,$sql1);

        $array = [];
        while($row = mysqli_fetch_assoc($result)){
            array_push($array, $row['id_menu']);
        }

        
        // array selain id_menu makanan (Untuk Button)
        $query = " SELECT id_menu  FROM menu WHERE id_menu NOT LIKE '%MKN%'";
        $result1 = mysqli_query($conn,$query);

        $array1 = [];
        while($row1 = mysqli_fetch_assoc($result1)){
            array_push($array1, $row1['id_menu']);
        }


        $no = 1;
        $search = $_POST['search'];

        $query = mysqli_query($conn, "SELECT * FROM menu WHERE 
            nama_menu LIKE '%" . $search . "%' or 
            harga LIKE '%" . $search . "%' or
            jenis_menu LIKE '%" . $search . "%'
            ");
            
        while ($row = mysqli_fetch_assoc($query)) {
?>
        <tr>
        <td>
                                            <div class="card row m-4" style="width: 18rem; height: 32rem;">
                                                <img src="photo/<?= $row["foto_menu"];?>" width="60" height="200" class="card-img-top">
                                                <div class="card-body">
                                                    <input type="hidden" class="form-control" name='id_menu' id="id_menu" value="<?= $row['id_menu'];?>">
                                                    <h5 class="card-title"><?= $row["nama_menu"]; ?></h5>

                                                        <p class="card-text"><?= substr($row["detail"],0, 120)."[...]" ?></p>
                                                    
                                                    <h3 class="card-text" style="color:green;">Rp.<?= $row["harga"]; ?></h3>

                                                    <?php 

                                                    foreach($array as $mkn){

                                                        // $link = $row['id_menu'];

                                                        if($row['id_menu'] == $mkn) { 
                                                            
                                                            echo "
                                                                <a href=\"detail_menu_mkn.php?id=$mkn\" class=\"btn btn-primary mt-2\"> Order Menu </a>
                                                            ";           

                                                        }
                                                        
                                                    }

                                                    foreach($array1 as $md) {

                                                        // $link = $row['id_menu'];

                                                        if($row['id_menu'] == $md) { 
                                                            
                                                            echo "
                                                                <a href=\"detail_menu.php?id=$md\" class=\"btn btn-primary mt-2\"> Order Menu </a>
                                                            ";           

                                                        }
                                                   
                                                    }

                                                    ?>

                                                
                                                </div>
                                            </div>                                
                                        </td>
        </tr>
<?php }
} 

?>

<script>feather.replace()</script>