<?php
// core.php holds pagination variables
include_once 'config/core.php';
$page_title = "Products";
 

// include database and object files
include_once 'config/database.php';
include_once 'objects/product.php';
include_once 'objects/category.php';
 

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();
 
$product = new Product($db);
$category = new Category($db);
 
include_once "header.php";
?>

<?php
    if(isset($_SESSION)){
        include_once 'authentication.php';
    };

?> 

<!-- <a class="dropdown-item" href="products.php?q=logout">Logout</a> -->
<?php

// query products
$stmt = $product->readAll($from_record_num, $records_per_page);
 
// specify the page where paging is used
$page_url = "products.php?";
 
// count total rows - used for pagination
$total_rows=$product->countAll();
// read_template.php controls how the product list will be rendered
echo ('<div class="content"><div class="row"><div class="col-12"><div class="card card-chart"><div class="card-header">');
include_once "read_template.php";
echo('</div></div></div></div></div>');

// layout_footer.php holds our javascript and closing html tags
include_once "footer.php";


?>