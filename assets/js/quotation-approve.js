$('.btn-proccess').click(function(){
    bootbox.confirm({
        title : '<i class="fa fa-warning"></i> DURACON SYSTEM',
        message: "Approve Quotation ?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
          
          if(result)
          { 
            $("input[name='Employee_qo[approved]']").val(1);
      
            setTimeout(function(){
              $('form#form-quotation').submit();
            }, 500);
          }         

        }
      });
  });

  $('.btn-reject').click(function(){

    if($('textarea#note').val() == "") 
    {
        _alert("Catatan harus diisi !");
        return false;
    }

     bootbox.confirm({
        title : "<i class=\"fa fa-warning\"></i> DURACON SYSTEM",
        message: "Reject Quotation ?",
        buttons: {
            confirm: {
                label: 'Yes',
                className: 'btn-success'
            },
            cancel: {
                label: 'No',
                className: 'btn-danger'
            }
        },
        callback: function (result) {
          
          if(result)
          { 
            $("input[name='Employee_qo[approved]']").val(0);
            
            setTimeout(function(){
              $('form#form-quotation').submit();
            }, 500);
          }         
        }
      });
  });