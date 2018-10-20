<?php

include_once 'db_connect.php';
$conn = OpenCon();

$cat = $_GET['cat'];

$sql = "SELECT
        shop.products.id,
        shop.products.`name`,
        shop.products.description,
        shop.products.image_sm,
        shop.products.image_xl,
        shop.products.price,
        shop.products.`status`
        FROM
        shop.cat_list
        RIGHT JOIN shop.products
        ON shop.cat_list.pd_id = shop.products.id
        ";
if ($cat)
{
  $cat = $conn->real_escape_string($cat);
  $sql .= "WHERE shop.cat_list.cat_id = $cat AND status = 1 ";
}
else
{
    $sql .= "WHERE  status = 1 ";
}
$sql .= "GROUP BY
        shop.products.id,
        shop.products.`name`,
        shop.products.description,
        shop.products.image_sm,
        shop.products.image_xl,
        shop.products.price,
        shop.products.`status` ";

$sql .= "ORDER BY shop.products.name ";

$result = $conn->query($sql);

if ($result->num_rows > 0)
{
    // output data of each row
    while($row = $result->fetch_assoc()) {
		echo ' <div class="art_pos">
        <a href="one.php?id='. $row["id"].'">
            <img class="pd_mini" src="'.$row["image_sm"].'" alt="deco"></a>
            <h4><a class="art" href="one.php?id='. $row["id"].'">'. $row["name"].'</a></h4>
            <h5>$'. $row["price"].'</h5>
            <p class="description">'. $row["description"].'</p>
            <br />
          </div>';
    }

}

CloseCon($conn);


?>