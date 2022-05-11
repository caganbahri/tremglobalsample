<?php
include("db.php")
?>
<html lang="tr">
<head>
<body translate="no" class="hm-gradient">
<meta charset="UTF-8">
<title>Trem Global Form</title>
  
  
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdbootstrap/4.4.1/css/mdb.min.css">
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/css/intlTelInput.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/fixedcolumns/4.0.2/css/fixedColumns.dataTables.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/js/intlTelInput.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/10.0.2/js/utils.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedcolumns/4.0.2/js/dataTables.fixedColumns.min.js"></script>



</head>


  
    
    <main>
        
        <!--MDB Forms-->
        <div class="container mt-1">

       
            <!-- Grid row -->
            <div class="row">
                <!-- Grid column -->
                <div class="col-md-12 mb-4">
                    <div class="card">
                        <div class="card-body">
						<form id="kayitformu">
                            <h3 class="text-center default-text py-3"><i class="fa fa-lock"></i> Kayıt Formu </h3>
                            <!--Body-->
								<div class="md-form">
								<i class="fa fa-user prefix grey-text active"></i>
								<input type="text" name="isimsoyisim" id="isimsoyisim"  class="form-control">
								<label for="defaultForm-email" class="active">İsim Soyisim</label>
								</div>
								<div class="md-form">
								<i class="fa fa-envelope prefix grey-text active"></i>
								<input type="text" name="eposta" id="eposta" class="form-control">
								<label for="defaultForm-email" class="active">Eposta</label>
								</div>
								<div class="md-form">
								<i class="fa fa-phone prefix grey-text active"></i>
								<input type="tel" id="telefon" name="telefon"  class="form-control">
								<label for="defaultForm-pass" class="active">Telefon</label>
								</div>

								<div class="md-form">
								<i class="fa fa-lock prefix grey-text active"></i>
								<textarea name="adres" id="adres" class="form-control" style="height:60px;border-top:0px; border-left:0px;border-right:0px;"></textarea>
								<label for="defaultForm-pass" class="active">Adres</label>
								</div>
					
                            <div class="text-center">
                                <button type="button" id="submit" class="btn btn-default waves-effect waves-light">Kayıt Et</button>
                            </div>
							</form>
                        </div>
                    </div>
                </div>
				
				
				
				
				
				
				
				
				
				
				<div class="col-md-12 mb-4">
				<div class="card">
				<div class="card-body">
				<form id="kayitformu">
				<h3 class="text-center default-text py-3"><i class="fa fa-lock"></i> Kayitlar </h3>


						<table id="example" class="stripe row-border order-column" style="width:100%">
						<thead>
						<tr>
							<th>AdSoyad</th>
							<th>Telefon</th>
							<th>Eposta</th>
							<th>Adres</th>

						</tr>
						</thead>
						<tbody>
						<?php

						$query = $db->query("SELECT * from kayitdefteri order by id desc limit 100", PDO::FETCH_ASSOC);
						if ( $query->rowCount() ){
						foreach( $query as $row ){



						?>
						<tr>
							<td><?php echo $row['adsoyad'] ?></td>
							<td><?php echo $row['telefon'] ?></td>
							<td><?php echo $row['eposta'] ?></td>
							<td><?php echo $row['adres'] ?></td>


						</tr>
						<?php

						}
						}
						?>
						</tfoot>
						</table>


				</div>
				</div>
				</div>

				
				
				
				
				
				
				
				
				
				
        
            </div>
        
          
            
          
            

        </div>
        <!--MDB Forms-->
      
    </main>
  <script type="text/javascript">
  $("#telefon").intlTelInput();

$(document).ready(function(){   // Jquery sayfa yüklediğinde çalışmaya başlayacak kod yapısı
 
 
 
 
$("#submit").click(function(e) {  // Gönder butonuna tıklandığın da çalışacak event
var isimsoyisim = $("#isimsoyisim").val();
var telefon = $("#telefon").val();
var adres = $("#adres").val();
var eposta = $("#eposta").val();
  if(isimsoyisim || telefon || eposta || adres){
  $.ajax({   
           type: "POST", 
           url: "ajax.php",
           dataType: 'JSON',
           data: $("#kayitformu").serialize(), //form bilgilerini veri parametrelerine dönüştürecek kod
           success: function(data)
           {
			if(data.islem){
			
			alert(data.mesaj)
			location.reload();
			}else{

			alert(data.mesaj);
			}
        }    });

}else{
	alert("Lütfen form bilgilerini giriniz...");
	
}

});


});


$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#example tfoot th').each( function (i) {
        var title = $('#example thead th').eq( $(this).index() ).text();
        $(this).html( '<input type="text" placeholder="'+title+'" data-index="'+i+'" />' );
    } );
  
    // DataTable
    var table = $('#example').DataTable( {
        scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         false,
        fixedColumns:   true
    } );
 
    // Filter event handler
    $( table.table().container() ).on( 'keyup', 'tfoot input', function () {
        table
            .column( $(this).data('index') )
            .search( this.value )
            .draw();
    } );
} );
</script>


</body></html>