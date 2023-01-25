$(document).ready(function() {
    $.ajaxSetup({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    
      
    $('#category_id').on('change',function(){
        console.log('helllo');
        var parentID = $(this).val();
        console.log("inside the on click function", parentID)
        if(parentID){
            $.ajax({
                url:'/admin/load/subcategory/'+parentID,
                type:'GET',
                success:function(res){
                    console.log('response is ', res);     
                    $('#subcategory_id').empty();   
                    var content = '<option value="">choose</option>';
                    $.each(res.data, function(index, val) {                        
                        content += `<option value="${val['id'] }"> ${val['name'] }</option>`
                    });
                    $('#subcategory_id').append(content);     
                },
                error:function(res) {
                    console.log(res.error);
                }
            });
        }    
    });
})

