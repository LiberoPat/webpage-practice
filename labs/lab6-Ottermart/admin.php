<?php
    session_start();
    if(!isset( $_SESSION['adminName']))
    {
        header("Location:login.php");
    }
    
    function displayAllProducts() {
        global $conn;
        $sql = "SELECT * FROM om_product ORDER BY productId";
        $statement = $conn->prepare($sql);
        $statement->execute();
        $records = $statement->fetchAll(PDO::FETCH_AASSOC);
        
        return $records;
    }
    
    function getCategories() {
        global $connection;
        
        $sql = "SELECT catId, catName FROM om_category ORDER BY catName";
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetchAll(PDO::FETCH_AASSOC);
        foreach ($records as $record) {
            echo "<option ";
            echo ($record["catId"] == $catId)? "selected": "";
            echo " value='".$record["catId"] ."'>". $record['catName'] ." </option>";
        }
    }
?>

<?php $records=displayAllProducts();
    echo "<table class='table table-hover'>";
    echo "<thead>
            <tr>
                <th scope='col'>ID</th>
                <th scope='col'>Name</th>
                <th scope='col'>Description</th>
                <th scope='col'>Price</th>
                <th scope='col'>Update</th>
                <th scope='col'>Remove</th>
                
            </tr>
            </thead>";
    echo"<tbody>";
    foreach($records as $record) {
        echo "<tr>";
        echo "<td>" .$record['productId']."</td>";
        echo "<td>" .$record["productName"]."</td>";
        echo "<td>" .$record["productDescription"]."</td>";
        echo "<td>$" .$record["price"]."</td>";
        echo "<td><a class='btn btn-primary' href='updateProduct.php?productId".$record['productId']."'>Update</a></td>";
        
        echo "<form action='deleteProduct.php' onsubmit='return confirmDelete()'>";
        echo "<input type='hidden' name='productId' value= ". $record['productId'] . " />";
        echo "<td><input type='submit' class = 'btn btn-danger' value='Remove'></td>";
        echo "</form>";
    }
    
    echo "</tbody>";
    echo"</table> ";
?>

<form action="addProduct.php">
    <input type="submit" class = 'btn btn-secondary' id = "beginning" name="addProduct" value="Add Product"/>
</form>
<form>
    <strong>Product name</strong><input type="text" class="form-control"name="productName"><br>
    <strong>Description</strong> <textarea name="description" class="form-control" cols= 50 rows = 4></textarea><br>
    <strong>Price</strong> <input type="text" class="form-control" name="price"><br>
    <strong>Category</strong><select name="catId" class="form-control">
        <option value="">Select One</option>
        <?php getCategories(); ?>
    </select> <br />
    <strong>Set Image Url</strong> <input type = "text" name = "productImage" class="form-control"><br>
    <input type="submit" name="submitProduct" class='btn btn-primary' value="AddProduct">
</form>
<?php
    if (isset($_GET['submitProduct'])) {
        $productName = $_GET['productName'];
        $productDescription = $_GET['description'];
        $productImage = $_GET['productImage'];
        $productPrice = $_GET['price'];
        $catId = $_GET['catId'];
        
        $sql = "INSERT INTO om_product
                ( productName, productDescription, productImage, price, catId)
                VALUES ( :productName, :productDescription, :productImage, :price, :catId)";
        
        $namedParameters = array();
        $namedParameters[':productName'] = $productName;
        $namedParameters[':productDescription'] = $productDescription;
        $namedParameters['productImage'] = $productImage;
        $namedParameters[':price'] = $productPrice;
        $namedParameters[':catId'] = $catId;
        $statement = $conn->prepare($sql);
        $statement->execute($namedParameters);
    }
?>

<form>
    <input type="hidden" name="productId" value= "<?$product['productId']?>"/>
    <strong>Product name</strong> <input type="text" class="form-control" value= "<?$product['productName']?>" name="productName"><br>
    <strong>Description</strong> <input type="textarea" name="description" class="form-control" cols=50 rows = 4><?=$product['productDescription']?></textarea><br>
    <strong>Price</strong> <input type="text" class="form-control" name="price" value="<?$product['price']?>"><br>
    
    <strong>Category</strong> <select name="catId" class="form-control">
        <option>Select One</option>
        <?php getCategories( $product['catId'] );?>
    </select> <br />
    <strong>Set Image Url</strong> <input type = "text" class="form-control" name = "productImage" value = "<?=$product['productImage']?>"><br>
    <input type="submit" class='btn btn-primary' name="updateProduct" value="Update Product">
</form>

<?php
    if (isset ($_GET['productId'])) {
        $product = getProductionInfo();
    }
    function getProductionInfo()
    {
        global $connection;
        $sql = "SELECT * FROM om_product WHERE productId = " . $_GET['productId'];
        
        $statement = $connection->prepare($sql);
        $statement->execute();
        $record = $statement->fetch(PDO::FETCH_ASSOC);
        
        return $record;
    }
    
?>