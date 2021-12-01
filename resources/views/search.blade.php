

 <div class="container box">
   <h3 align="center">Autocomplete By Using Ajax and Api Folder </h3><br />
   
   <div class="form-group">
    <input type="text" name="search" id="search" class="form-control input-lg" placeholder="Enter Book Name" />
    <div id="bookList">
    </div>
   </div>
   {{ csrf_field() }}
  </div>

<script>
$(document).ready(function(){

 $('#search').keyup(function(){ 
        var query = $(this).val();
        if(query != '')
        {
         var _token = $('input[name="_token"]').val();
         $.ajax({
          url:"/api/autocomplete",
          method:"POST",
          data:{query:query, _token:_token},
          success:function(data){
           $('#bookList').fadeIn();  
                    $('#bookList').html(data);
          }
         });
        }
    });

    $(document).on('click', 'li', function(){  
        $('#search').val($(this).text());  
        $('#bookList').fadeOut();

        var name = $('#search').val();

        var _token = $('input[name="_token"]').val();
        // alert(name);
        $.ajax({
          url:"/api/searching",
          method:'POST',
          data:{key:name,_token:_token},
          success:function(data)
          {
            $('#data').html(data);
            // console.log(data);
          }
        });  
    });

});
</script>


