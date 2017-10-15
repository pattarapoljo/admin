</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"> </script>
<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
<script>
$(document).ready(function(){
  $('.CTable').DataTable(
    {
      "language": {
            "url": "https://cdn.datatables.net/plug-ins/1.10.16/i18n/Thai.json"
        }
    }
  );
});

$(function() {
  $('#add-cat').click(function() {
    var cat = prompt("กรุณากำหนดชื่อหมวด", "");
    if(cat) {
      ajaxSend({'action': 'add', 'cat':cat});
    }
  });

  $('button.edit').click(function() {
    var cat = prompt("กรุณากำหนดชื่อใหม่สำหรับหมวดนี้", "");
    if(cat) {
      var id = $(this).attr('data-id');
      ajaxSend({'action': 'edit', 'cat':cat, 'cat_id': id});
    }
  });

  $('button.del').click(function() {
    if(confirm("ยืนยันที่ัจะลบหมวดนี้")) {
      var id = $(this).attr('data-id');
      ajaxSend({'action': 'del', 'cat_id': id});
    }
  });

});

</script>
</body>
</html>
