$(document).ready(function() {
    $('#export').click(function(){ 
        $('.buttons-excel').click();
     });

     $('#csv').click(function(){ 
        $('.buttons-csv').click();
     });
})
function getRec(){
    
    $.ajax({
        type: "POST",
        url: "data/student-handler.php",
        data: "recent=true",
        cache: false,
        success: function(data) {

            var json = $.parseJSON(data);
            var list = $(".products-list").empty();
            if(data!="null"){
                $(json).each(function(i,val){
                   list.append('<li class="item">'+
                   '<div class="product-img">'+
                     '<img src="../img/default-avatar.png" alt="Product Image" class="img-size-50">'+
                   '</div>'+
                   '<div class="product-info">'+
                     '<a href="javascript:void(0)" class="product-title">'+val.studnum+'</a>'+
                     '<span class="product-description">'+val.desc+
                     '</span>'+
                   '</div>'+
                 '</li>')
                 });
            }else{
                
            }
            
        }
    })
}


function getAllStudent() {
	//iCheck for checkbox and radio inputs
	  /*------ datatables all products---------*/
    var table = $('#student-all').DataTable( {
        "dom": '<"toolbar">Bfrtip',
        "lengthChange": false,
        "ordering": false,
        "buttons": [
            'csv',
            {
                extend: 'excel',
                messageTop: 'The information in this table is copyright to Tarlac State University College of Computer Studies.'
            },
        ],
        "language": {
            "emptyTable":     "No student available"
        },
        "ajax": {
            "url": "data/student-handler.php",
            "dataSrc": ""
        },
         "columns": [
            { "data": "log_id" },
            { "data": "stud_no" },
            { "data": "str" },
            { "data": "end" },
            { "data": "date" }
        ],
         'columnDefs': [{
         'targets': 0,
         'searchable':false,
         'orderable':false,
         'className': 'dt-body-center',
         'render': function (data, type, full, meta){
             return '<div class="md-checkbox"><input type="checkbox" name="pat-chk" class="flat-red" name="mt-chk" value="'+$('<div/>').text(data).html()+'" id="'+$('<div/>').text(data).html()+'"><label for="'+$('<div/>').text(data).html()+'"></label></div>';
        }
        },
        {
        "targets": [ 0 ],
        "visible": false,
        "searchable": false
        },
    ],
      'order': [1, 'asc']
    } );

    /*------------- custom toolbar ------------*/
     $("div.toolbar").html('<div class="mailbox-controls">'+
        //  '<button type="button" class="btn btn-default btn-sm checkbox-toggle" title="Select All"><i class="fa fa-square-o"></i> Select All</button> '+
         '<div class="btn-group">'+
            // '<button type="button" class="btn btn-default btn-sm" id="del" title="Delete"><i class="fa fa-trash-o"></i> Delete</button>'+
            '<button type="button" class="btn btn-default btn-sm" id="export" title="Excel"><i class="fa fa-cloud-download"></i> Export to Excel</button>'+
            '<button type="button" class="btn btn-default btn-sm" id="csv" title="CSV"><i class="fa fa-download"></i> Export to CSV</button>'+
            '</div>'+
        '</div>');

     $("div.toolbar").css('float','left');

    
}