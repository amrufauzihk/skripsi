<?php
                    $page = (isset($_GET['paginasi']))? (int) $_GET['paginasi'] : 1;
                    $kolomCari=(isset($_GET['Kolom']))? $_GET['Kolom'] : "";
                    $kolomKataKunci=(isset($_GET['KataKunci']))? $_GET['KataKunci'] : "";
                    
                    // Jumlah data per halaman
                    $limit = 1000;
                    $limitStart = ($page - 1) * $limit;                   

                         //kondisi jika parameter pencarian kosong
                    if($kolomCari=="" && $kolomKataKunci==""){
                         $dt = mysqli_query($mysqli, "$qry $orderby LIMIT ".$limitStart.",".$limit);
                    }else{
                    //kondisi jika parameter kolom pencarian diisi
                         $dt = mysqli_query($mysqli, "$qry 
                                                      WHERE $kolomCari LIKE '%$kolomKataKunci%' $orderby  
                                                      LIMIT ".$limitStart.",".$limit);
                    }
                                
                    $no = $limitStart + 1;
?>