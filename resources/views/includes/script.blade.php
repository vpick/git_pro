
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="{{ url('assets/js/custom.js') }}"></script>
<script src="https://cdn.ckeditor.com/ckeditor5/35.3.2/classic/ckeditor.js"></script>
<script>
    ClassicEditor
            .create( document.querySelector( '#editor' ) )
            .then( editor => {
                    console.log( editor );
            } )
            .catch( error => {
                    console.error( error );
            } );
</script>
<script type="text/javascript">
        var i = 0;
        $("#add-btn").click(function(){
        ++i;
        $("#dynamicAddRemove").append('<tr><td><div class="form-raw"><div class="form-name"> &nbsp;</div><div class="form-txtfld"><input type="text"  placeholder="Title" name="moreFields['+i+'][title]"></div></div><div class="form-raw"><div class="form-name"> &nbsp;</div> <div class="form-txtfld txtfld50"><input type="text" placeholder="heading" name="moreFields['+i+'][heading]"></div><div class="form-txtfld txtfld50"><input type="text" placeholder="desciption" name="moreFields['+i+'][description]"></div></div><div class="form-raw"><div class="form-name">&nbsp;</div><div class="form-txtfld" style="width: 320px; text-align: right;"><img src="{{ url('assets/images/delete.gif') }}" alt="" class="remove-tr"></div></div></td></tr>');
        });
          $(document).on('click', '.remove-tr', function(){  

         $(this).parents('tr').remove();

    });  
        </script>
        <script type="text/javascript">
                var i = 0;
                $("#add-btn1").click(function(){
                ++i;
                $("#dynamicAddRemove1").append('<tr><td><div class="form-raw"><div class="form-name"> &nbsp;</div> <div class="form-txtfld txtfld50"><input type="text" placeholder="heading" name="moreInput['+i+'][heading]"></div><div class="form-txtfld txtfld50"><input type="file" placeholder="desciption" name="moreInput['+i+'][description]"></div></div><div class="form-raw"><div class="form-name">&nbsp;</div><div class="form-txtfld" style="width: 320px; text-align: right;"><img src="{{ url('assets/images/delete.gif') }}" alt="" class="remove-tr1"></div></div></td></tr>');
                });
                  $(document).on('click', '.remove-tr1', function(){  
        
                 $(this).parents('tr').remove();
        
            });  
                </script>