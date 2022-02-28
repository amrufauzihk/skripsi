
  <div align="left">
    <ul class="pagination">
      <?php
        // Jika page = 1, maka LinkPrev disable
        if($page == 1){ 
      ?>        
        <!-- link Previous Page disable --> 
        <li class="disabled"><a href="#">Sebelumnya</a></li>
      <?php
        }
        else{ 
          $LinkPrev = ($page > 1)? $page - 1 : 1;  

          if($kolomCari=="" && $kolomKataKunci==""){
          ?>
            <li><a href="<?php echo "?page=".$view."&paginasi=".$LinkPrev; ?>">Sebelumnya</a></li>
       <?php     
          }else{
        ?> 
          <li><a href="<?php echo "?page=".$view."&Kolom=".$kolomCari."&KataKunci=".$kolomKataKunci."&paginasi=".$LinkPrev;?>">Sebelumnya</a></li>
         <?php
           } 
        }
      ?>

      <?php
        //kondisi jika parameter pencarian kosong
        if($kolomCari=="" && $kolomKataKunci==""){
          $SqlQuery = mysqli_query($mysqli, "$qry $orderby");
        }else{
          //kondisi jika parameter kolom pencarian diisi
          $SqlQuery = mysqli_query($mysqli, "$qry
														                 WHERE $kolomCari LIKE '%$kolomKataKunci%' $orderby");
        }     
      
        //Hitung semua jumlah data yang berada pada tabel Sisawa
        $JumlahData = mysqli_num_rows($SqlQuery);
        
        // Hitung jumlah halaman yang tersedia
        $jumlahPage = ceil($JumlahData / $limit); 
        
        // Jumlah link number 
        $jumlahNumber = 1; 

        // Untuk awal link number
        $startNumber = ($page > $jumlahNumber)? $page - $jumlahNumber : 1; 
        
        // Untuk akhir link number
        $endNumber = ($page < ($jumlahPage - $jumlahNumber))? $page + $jumlahNumber : $jumlahPage; 
        
        for($i = $startNumber; $i <= $endNumber; $i++){
          $linkActive = ($page == $i)? ' class="active"' : '';

          if($kolomCari=="" && $kolomKataKunci==""){
      ?>
          <li<?php echo $linkActive; ?>><a href="<?php echo "?page=".$view."&paginasi=".$i; ?>"><?php echo $i; ?></a></li>

      <?php
        }else{
          ?>
          <li<?php echo $linkActive; ?>><a href="<?php echo "?page=".$view."&Kolom=".$kolomCari."&KataKunci=".$kolomKataKunci."&paginasi=".$i; ?>"><?php echo $i; ?></a></li>
          <?php
        }
      }
      ?>
      
      <!-- link Next Page -->
      <?php       
       if($page == $jumlahPage){ 
      ?>
        <li class="disabled"><a href="#">Selanjutnya</a></li>
      <?php
      }
      else{
        $linkNext = ($page < $jumlahPage)? $page + 1 : $jumlahPage;
       if($kolomCari=="" && $kolomKataKunci==""){
          ?>
            <li><a href="<?php echo "?page=".$view."&paginasi=".$linkNext; ?>">Selanjutnya</a></li>
       <?php     
          }else{
        ?> 
           <li><a href="<?php echo "?page=".$view."&Kolom=".$kolomCari."&KataKunci=".$kolomKataKunci."&paginasi=".$linkNext; ?>">Selanjutnya</a></li>
      <?php
        }
      }
      ?>
    </ul>
  </div>
