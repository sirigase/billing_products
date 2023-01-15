 <?php
     //variable inititalisation
     
     
     $servername = "localhost";
     $username = "sirigase_billing2";
     $password = "DeGcyN9By77aJpU";
     $dbname = "sirigase_billing2";
     
     
     /*
     $servername = "localhost";
     $username = "root";
     $password = "";
    $dbname = "billing2";
    // $dbname = "billing3";
     */
     
      $conn = new mysqli($servername, $username, $password, $dbname);
                        if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                           }
                          $sql = "SELECT * FROM settings WHERE id=1";
                         $result = $conn->query($sql);
                           if ($result->num_rows > 0) {
                           while($row = $result->fetch_assoc()) {
                             $companyname=$row["name"];
                             $companyaddress=$row["address"];
                             $companyphone=$row["phone"];
                             $rprod=$row["recordProducts"];
                             $rcat=$row["recordCategories"];
                             $rretail=$row["recordRetail"];
                            $rcsale=$row["recordCounSale"];
                            $rcgiven=$row["recordCreditGiven"];
                            $rpur=$row["recordPurchase"];
                            $rcus=$row["recordCustomer"];
                            $invqty=$row["recordInvQty"];
                            }
                             } else {
                             echo "0 results";
                              }
                     $conn->close();
                     $companyName=$companyname;
     
      ?>