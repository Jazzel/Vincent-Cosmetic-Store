<?php



// search form
echo ('<div class="row pt-3 pl-3"><div class="col-6">');
echo ('<div class="h1 text-white styled-font">' . $page_title . '</div>');
echo ('</div>');
echo ('<div class="col">');
if ($page_title == 'Products') {

    echo "<form role='search' class='form-inline pull-right' action='search.php'>";
    echo ('<div class="input-group mb-2 mr-sm-2">');

    echo ('<a href="create_product.php" type="submit" class="btn btn-md btn-primary mb-2"><i class="fa fa-plus"></i></a>');
    echo "</div>";
    $search_value = isset($search_term) ? "value='{$search_term}'" : "";
    echo ('<div class="input-group mb-2 mr-sm-2">');
    echo ('<div class="input-group-prepend"><button type="submit" class="btn btn-md btn-primary mb-2"><i class="fa fa-search"></i></button></div>');
    echo "<input type='text' class='form-control mt-1' name='s' id='srch-term' placeholder='Type product name or description...' required {$search_value} />";
    echo "</div>";
    echo "</form>";
}

echo "</div>";
echo "</div>";



// display the products if there are any
if ($total_rows > 0) {

    echo "<table class='table table-hover table-striped'>";
    echo "<tr style='color:white !important;'>";
    echo "<th>Product</th>";
    echo "<th>Price</th>";
    echo "<th>Category</th>";
    echo "<th>Actions</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo "<td>";
        $category->id = $category_id;
        $category->readName();
        echo $category->name;
        echo "</td>";


        echo "<td>";

        // read product button
        echo "<a href='detail_product.php?id={$id}' class='mr-1 btn btn-primary left-margin'>";
        echo "<span class='fa fa-list'></span> ";
        echo "</a>";

        // edit product button
        echo "<a href='update_product.php?id={$id}' class='ml-1 mr-1 btn btn-info left-margin'>";
        echo "<span class='fa fa-edit'></span> ";
        echo "</a>";

        // delete product button
        echo "<a delete-id='{$id}' class='ml-1 mr-1 btn btn-danger delete-object'>";
        echo "<span class='fa fa-trash'></span> ";
        echo "</a>";

        echo "</td>";

        echo "</tr>";
    }

    echo "</table>";

    if ($page_title == 'Products') {
        // paging buttons
        include_once 'dashboard_paging.php';
    } else {
        echo '<div><br></div>';
    }
}

// tell the user there are no products
else {
    echo "<div class='alert alert-danger'>No products found.</div>";
}
