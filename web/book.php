<?php require_once "web/header.php"; ?> <!-- Include headrs -->
    <div>
        <input type="text" id = "filter" name="filter" class="demoInputBox"> <!-- Author filter -->
        <div style="text-align: right;margin: -44px 258px 0px;float: inherit;">
            <a id="btnSearchAction" href="#">Search</a> <!-- Search Button -->
        </div>
    </div>
    <div style="text-align: right;margin: 37px 77px 8px;">
        <span id = "success_sec"></span> <!-- Success msg div -->
        <span id = "error_sec"></span> <!-- Error msg div -->
        <a id="btnAddAction" href="#"><img src="web/image/icon-add.png" />Add Book</a>
    </div>
    <div style="text-align: right;margin: -56px 230px 11px;float: left;">
        <a id="btnListAction" href="#">List Authors</a>
    </div>
    <div id='book-details' style="display: none;">
        <?php include_once('book-details.php'); ?> <!-- Include add/edit book section -->
    </div>
    <div id='authors' style="display: none;">
        <?php include_once('author.php'); ?> <!-- Include author list section -->
    </div>
    <!-- Start of book list section -->
    <div id="toys-grid">
        <table cellpadding="10" cellspacing="1">
            <thead>
                <tr>
                    <th><strong>#</strong></th>
                    <th><strong>Book Name</strong></th>
                    <th><strong>Author</strong></th>
                    <th><strong>Action</strong></th>
                </tr>
            </thead>
            <tbody id="book_list">
                    <?php
                    if (! empty($result)) {
                        $cnt = 1;
                        foreach ($result as $k => $v) {
                            ?>
          <tr id="<?php echo 'rw_'.$result[$k]["id"]; ?>">
                    <td><?php echo $cnt++; ?></td>
                    <td><?php echo $result[$k]["b_name"]; ?></td>
                    <td><?php echo $result[$k]["a_name"]; ?></td>
                    <td><a class="btnEditAction"
                        href="#" rel=<?php echo $result[$k]["id"]; ?>>
                        <img src="web/image/icon-edit.png" />
                        </a>
                        <a class="btnDeleteAction" 
                        href="#" rel=<?php echo $result[$k]["id"]; ?>>
                        <img src="web/image/icon-delete.png" />
                        </a>
                    </td>
                </tr>
                    <?php
                        }
                    }
                    ?>
                
            
            
            <tbody>
        
        </table>
    </div>
    <!-- End of book listing section -->
    <script src="https://code.jquery.com/jquery-2.1.1.min.js"
    type="text/javascript"></script>
    <script>
        
        function randerBookList(){
            var a_name = $('#filter').val();
            var post_data = 'action=getList';
            if( a_name.length>1 ){
                post_data = post_data + '&a_name='+a_name;
            }
            $.ajax({
                url: "Ajax/manage-book.php",
                data:post_data,
                type: "POST",
                dataType  : 'json',
                success:function(data){
                   var book_html = '';
                   var cnt = 0;
                    $.each(data, function(index,jsonObject){
                        cnt++;
                        book_html = book_html + '<tr><td>'+cnt+'</td><td>'+jsonObject['b_name']+'</td><td>'+jsonObject['a_name']+'</td><td><a class="btnEditAction" href="#" rel="'+jsonObject['id']+'"><img src="web/image/icon-edit.png"></a><a class="btnDeleteAction" href="#" rel="'+jsonObject['id']+'"><img src="web/image/icon-delete.png"></a></td></tr>';
                        
                    });
                    $('#frmBook').trigger('reset');
                    $('#book-details').fadeOut('slow');
                    $('#success_sec').fadeOut('slow');
                    $('#error_sec').fadeOut('slow');
                    $('#book_list').html('');
                    $('#book_list').html(book_html);
                },
                error:function (){}
            });
        }

        $("#btnAddAction").on('click', function() {
          $('#book-details').fadeIn('slow');
        });
        $("#btnListAction").on('click', function() {
          $('#authors').fadeIn('slow');
        });
        $("#btnSearchAction").on('click', function() {
          randerBookList();
        });
        $("#btnSubmit").on('click', function() {
            var id = $('#id').val();
            var action = 'add';
            if(id>0){
                action = 'edit';        
            }
            $.ajax({
                url: "Ajax/manage-book.php",
                data:$('#frmBook').serialize()+'&action='+action,
                type: "POST",
                dataType  : 'json',
                success:function(data){
                    if(data.status==1){
                        $('#error_sec').html('');
                        $('#error_sec').hide();
                        $('#success_sec').html(data.message);
                        $('#success_sec').fadeIn('slow');
                    }else{
                        $('#success_sec').html('');
                        $('#success_sec').hide();
                        var error_li_html = '';
                        $.each(data, function(index,jsonObject){
                            $.each(jsonObject, function(key,val){
                                if(key!='status'){
                                    error_li_html = error_li_html + '<li>'+val+'</li>';
                                }
                            });
                        });
                        var error_html = '<ul>'+error_li_html+'</ul>';
                        $('#error_sec').html(error_html);
                        $('#error_sec').fadeIn('slow');

                    }
                    randerBookList();
                },
                error:function (){}
            });
        });
        $("#btnCancel").on('click', function() {
          $('#book-details').hide();
        });

        $(".btnEditAction").on('click', function() {
           $.ajax({
                url: "Ajax/manage-book.php",
                data:'action=get&id='+$(this).prop('rel'),
                type: "POST",
                dataType  : 'json',
                success:function(data){
                   $('#id').val(data.id); 
                   $('#b_name').val(data.b_name); 
                   $('#a_name').val(data.a_name);  
                },
                error:function (){}
            });  
          $('#book-details').show();
        });
        $(".btnDeleteAction").on('click', function() {
           if(!confirm('Are you sure you wanna delete?')){
            return false;
           }
           $.ajax({
                url: "Ajax/manage-book.php",
                data:'action=delete&id='+$(this).prop('rel'),
                type: "POST",
                dataType  : 'json',
                success:function(data){
                   $('#error_sec').html('');
                   $('#error_sec').hide();
                   $('#success_sec').html(data.message);
                   $('#success_sec').fadeIn('slow');
                    randerBookList();

                },
                error:function (){}
            });  
          
        });
    </script>

</body>
</html>