<?php
include "top.php";
?>

<body style="padding-top:70px">
  <?php include "top.php"; ?>
  <div class="container">
    <?php
    include "dblink.php";
    include "lib/pagination.php";

    $sql = "SELECT * FROM categories";
    $r_cat= mysqli_query($link, $sql);
    $sql = "SELECT sup_id, sup_name FROM suppliers";
    $r_sup = mysqli_query($link, $sql);
    ?>

    <?php
    $field = "ทั้งหมด";
    $sql = "SELECT products.*, categories.cat_name,  suppliers.sup_name
    FROM products
    LEFT JOIN categories
    ON products.cat_id = categories.cat_id
    LEFT JOIN suppliers
    ON products.sup_id = suppliers.sup_id";

    $sql .= " ORDER BY pro_id DESC";
    $result = page_query($link, $sql, 10);
    $first = page_start_row();
    $last = page_stop_row();
    $total = page_total_rows();
    if($total == 0) {
      $first = 0;
    }
    ?>

    <table class="table">
        <thead>
          <tr>
            <th>ลำดับ</th>
            <th>รูป</th>
            <th>ชื่อสินค้า</th>
            <th>ตัวเลือก</th>
          </tr>
        </thead>
        <tbody>
          <?php
          include "lib/IMGallery/imgallery-no-jquery.php";
          $row = $first;
          while($pro = mysqli_fetch_array($result)) {
            ?>
          <tr>
            <td><?php echo $row; ?></td>
            <td>
              <?php
              $sql = "SELECT * FROM images WHERE pro_id = {$pro['pro_id']}";
              $r = mysqli_query($link, $sql);
              if(mysqli_num_rows($r) > 0) {
                echo "<br>";
                $src = "read-image.php?id=";
                gallery_thumb_width(50);
                while($img =mysqli_fetch_array($r)) {
                  gallery_echo_img($src . $img['img_id']);
                }
              }
              ?>
            </td>
            <td>
              <span class="tag">ชื่อสินค้า: </span><?php echo $pro['pro_name']; ?><br>
              <span class="tag">ราคา: </span><?php echo $pro['price']; ?><br>
              <span class="tag">จำนวนที่มี: </span><?php echo $pro['balance']; ?> <br>
            </td>
            <td>
              <a class="btn btn-warning" href="product-edit.php?id=<?php echo $pro['pro_id']; ?>">แก้ไข</a>
              <button class="btn btn-danger" data-id="<?php echo $pro['pro_id']; ?>">ลบ</button>
            </td>
          </tr>

        </tbody>
        <?php
        $row++;
      }
      ?>
    </table>
  </div>


<?php include "footer.php"; ?>
