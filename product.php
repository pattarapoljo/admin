<?php
include "check-login.php";
?>
<!doctype html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <title>ระบบจำหน่ายอะไหล่รถจักรยานยนต์</title>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">

  <link href="js/jquery-ui.min.css" rel="stylesheet">
  <script src="js/jquery-2.1.1.min.js"> </script>
  <script src="js/jquery-ui.min.js"> </script>
  <script src="js/jquery.form.min.js"> </script>
  <script src="js/jquery.blockUI.js"> </script>

  <script>
  var fileNo = 1;
  var fileCount = 5;

  $(function() {
    $('#bt-search').click(function() {
      if($(':radio[name=field]:checked').val() == "category") {
        $('#field-text').val($('#cat-search option:selected').text());
      }
      else if($(':radio[name=field]:checked').val() == "supplier") {
        $('#field-text').val($('#sup-search option:selected').text());
      }
      $('#form-search').submit();
    });

    $('#bt-add-pro').click(function() {
      showDialog();
    });

    $('#bt-send').click(function(event) {
      var data = $('#form-pro').serializeArray();
      ajaxSend(data);
    });

    fileCount = $('[type=file]').length;
    for(i = 1; i <= fileCount; i++) {
      $('#bt-upload' + i).click(function() {
        uploadFile();
      });
    }

    $('button.edit').click(function() {
      var id = $(this).attr('data-id');
      window.open('product-edit.php?id=' + id);
    });

    $('button.del').click(function() {
      if(!(confirm("ยืนยันการลบสินค้ารายการนี้"))) {
        return;
      }
      var id = $(this).attr('data-id');
      $.ajax({
        url: 'product-delete.php',
        data: {'action': 'del', 'pro_id': id},
        type: 'post',
        dataType: "html",
        beforeSend: function() {
          $.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
        },
        success: function(result) {
          location.reload();
        },
        complete: function() {
          $.unblockUI();
        }
      })
    });

  });

  function resetForm() {
    $('#form-pro')[0].reset();
    $('input:file').clearInputs();  //อยู่ในไลบรารี form.js
  }

  function showDialog() {
    fileNo = 1;
    resetForm();
    $('#dialog').dialog({
      title: 'เพิ่มสินค้า',
      width: 'auto',
      modal: true,
      position: { my: "center top", at: "center top", of: $('nav')}
    });
  }

  function ajaxSend(dataJSON) {
    $.ajax({
      url: 'product-add.php',
      data: dataJSON,
      type: 'post',
      dataType: "html",
      beforeSend: function() {
        $.blockUI({message:'<h3>กำลังส่งข้อมูล...</h3>'});
      },
      success: function(result) {
        $('#bt-upload' + fileNo).click();
      },
      complete: function() {
        //$.unblockUI();
      }
    });
  }

  function uploadFile() {
    if(fileNo > fileCount) {
      return;
    }
    var input = '#file' + fileNo;
    $('#form-img'  + fileNo).ajaxForm({
      dataType: 'html',
      beforeSend: function() {
        if($(input).val().length != 0) {
          $.blockUI({message:'<h3>กำลังอัปโหลดภาพที่ ' + fileNo + '</h3>'});
        }
      },
      success: function(result) {	},
      complete: function() {
        fileNo++;
        if(fileNo <= fileCount) {
          $('#bt-upload' + fileNo).click();
        }
        else {
          fileNo = 1;
          $('#dialog').dialog('close');
          $.unblockUI();
          location.reload();
        }
      }
    });
  }
  </script>
</head>

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
    <form id="form-search" method="get">
      <div id="search-col1">
        <input type="radio" name="field" value="1">ทั้งหมด<br>

        <input type="radio" name="field" value="price">ราคาสินค้า
        <select name="price_op">
          <option value="=">=</option>
          <option value="<="><=</option>
          <option value=">=">>=</option>
        </select>
        <input type="number" name="price_val" min="0"><br>

        <input type="radio" name="field" value="quantity">จำนวนที่มี&nbsp;
        <select name="quan_op">
          <option value="=">=</option>
          <option value="<="><=</option>
          <option value=">=">>=</option>
        </select>
        <input type="number" name="quan_val" min="0"><br>


      </div>
      <div id="search-col2">
        <input type="radio" name="field" value="pro_name">ชื่อสินค้า
        <input type="text" name="pro_key"><br>

        <input type="radio" name="field" value="category">หมวดหมู่
        <select name="cat" id="cat-search">
          <?php
          while($cat = mysqli_fetch_array($r_cat)) {
            echo "<option value=\"{$cat['cat_id']}\">{$cat['cat_name']}</option>";
          }
          ?>
        </select><br>
        <input type="radio" name="field" value="supplier">ผู้จัดส่ง&nbsp;&nbsp;
        <select name="sup" id="sup-search">
          <?php
          while($sup = mysqli_fetch_array($r_sup)) {
            echo "<option value=\"{$sup['sup_id']}\">{$sup['sup_name']}</option>";
          }
          ?>
        </select>
        <input type="hidden" name="field_text" id="field-text">
      </div>
    </form> <br>

    <?php
    $field = "ทั้งหมด";
    $sql = "SELECT products.*, categories.cat_name,  suppliers.sup_name
    FROM products
    LEFT JOIN categories
    ON products.cat_id = categories.cat_id
    LEFT JOIN suppliers
    ON products.sup_id = suppliers.sup_id";

    if((@$_GET['field'] == "price") && is_numeric(@$_GET['price_val'])) {
      $sql .= " WHERE price " . $_GET['price_op'] . " " . $_GET['price_val'];
      $field = "ราคา " . $_GET['price_op'] . " " . $_GET['price_val'];
    }
    else if((@$_GET['field'] == "quantity") && is_numeric(@$_GET['quan_val'])) {
      $sql .= " WHERE quantity " . $_GET['quan_op'] . " " . $_GET['quan_val'];
      $field = "จำนวนที่มี " .  $_GET['quan_op'] . " " . $_GET['quan_val'];
    }
    else if((@$_GET['field'] == "pro_name") && !empty(@$_GET['pro_key'])) {
      $sql .= " WHERE pro_name LIKE '%" . $_GET['pro_key'] . "%'";
      $field = "ชื่อสินค้า: '" .  $_GET['pro_key'] . "'";
    }
    else if(@$_GET['field'] == "category") {
      $sql .= " WHERE products.cat_id = " . $_GET['cat'];
      $field = "หมวดหมู่: " . $_GET['field_text'];
    }
    else if(@$_GET['field'] == "supplier") {
      $sql .= " WHERE products.sup_id = " . $_GET['sup'];
      $field = "ผู้จัดส่ง: "  . $_GET['field_text'];
    }
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
      <caption>
        <?php 	echo "สินค้าลำดับที่  $first - $last จาก $total  ($field)"; ?>
        <button id="bt-add-pro">เพิ่มสินค้า</button>
        <button  type="submit" id="bt-search">แสดงสินค้าตามที่ระบุ</button>
      </caption>
      <colgroup><col id="c1"><col id="c2"><col id="c3"><col id="c4"></colgroup>

        <thead>
          <tr>
            <th width="5%">#</th>
            <th width="10%">รูป</th>
            <th width="25%">ชื่อสินค้า</th>
            <th width="45%">รายละเอียด</th>
            <th width="15%">ตัวเลือก</th>
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
              <span class="tag">ชื่อสินค้า:</span><?php echo $pro['pro_name']; ?><br>
              <span class="tag">ราคา:</span><?php echo $pro['price']; ?><br>
              <span class="tag">จำนวนที่มี:</span><?php echo $pro['quantity']; ?> <br>
              <span class="tag">รูปภาพ:</span><br>

            </td>
            <td>
              <span class="tag">รายละเอียด:</span><?php echo $pro['detail']; ?><br>
              <span class="tag">หมวดหมู่:</span><?php echo $pro['cat_name']; ?><br>
              <span class="tag">ผู้จัดส่ง:</span><?php echo $pro['sup_name']; ?><br>
              <span class="tag">คุณลักษณะ:</span>
              <?php
              $sql = "SELECT * FROM attributes WHERE pro_id = {$pro['pro_id']}";
              $r = mysqli_query($link, $sql);
              if(mysqli_num_rows($r) > 0) {
                echo "<br>";
                while($attr =mysqli_fetch_array($r)) {
                  echo "- " .  $attr['attr_name'] . ": " . $attr['attr_value'] . "<br>";
                }
              }
              else {
                echo " - <br>";
              }
              ?>
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
    <?php
    if(page_total() > 1) { 	 //ให้แสดงหมายเลขเพจเฉพาะเมื่อมีมากกว่า 1 เพจ
      echo '<p id="pagenum">';
      page_echo_pagenums();
      echo '</p>';
    }
    ?>
    <div id="dialog">
      <form id="form-pro">
        <input type="text" name="pro_name" id="pro-name" placeholder="ชื่อสินค้า"><br>
        <textarea name="detail" id="detail" placeholder="รายละเอียดของสินค้า"></textarea><br>
        <input type="text" name="price" id="price" placeholder="ราคาต่อหน่วย">
        <input type="text" name="quantity" id="quantity" placeholder="จำนวนสินค้า"><br>
        <select name="category" id="category">
          <option>หมวดหมู่ของสินค้า</option>
          <?php
          mysqli_data_seek($r_cat, 0);
          while($cat = mysqli_fetch_array($r_cat)) {
            echo "<option value=\"{$cat['cat_id']}\">- {$cat['cat_name']}</option>";
          }
          ?>
        </select>
        <select name="supplier" id="supplier">
          <option>ผู้จัดส่งสินค้า (Supplier)</option>
          <?php
          mysqli_data_seek($r_sup, 0);
          while($sup = mysqli_fetch_array($r_sup)) {
            echo "<option value=\"{$sup['sup_id']}\">- {$sup['sup_name']}</option>";
          }
          ?>
        </select>
        <br><br>
        <span id="propname">คุณลักษณะสินค้า </span>
        <span id="propval">ค่าของคุณลักษณะ </span><br>
        <input type="text" name="attr_name[]" class="attr-name" placeholder="ชื่อคุณลักษณะ (1)">
        <input type="text" name="attr_value[]"  class="attr-value" placeholder="ค่าของคุณลักษณะ (1)"><br>
        <input type="text" name="attr_name[]" class="attr-name" placeholder="ชื่อคุณลักษณะ (2)">
        <input type="text" name="attr_value[]" class="attr-value" placeholder="ค่าของคุณลักษณะ (2)"><br>
      </form>
      <br>

      <form id="form-img1" method="post" action="product-image.php" enctype="multipart/form-data">
        ภาพสินค้า #1: <input type="file" name="file" id="file1">
        <button type="submit" id="bt-upload1" class="hidden">อัปโหลดภาพ</button>
      </form>
      <br>
      <button type="button" id="bt-send">ส่งข้อมูล</button>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>
<?php mysqli_close($link);  ?>
