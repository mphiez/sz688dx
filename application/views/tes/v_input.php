<?php $this->load->view('header');?>
	<style>
		#modal-create{
			padding-right:0px !Important;
		}
		.form-control[disabled], .form-control[readonly], fieldset[disabled] .form-control {
			background-color: #fff !important;
			opacity: 1;
		}
	</style>
	<link rel="stylesheet" href="https://jqueryvalidation.org/files/demo/site-demos.css">
	<div id="page-wrapper">
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">Buat Pembayaran</h1>
			</div>
		</div>
        <div class="row">
			<div class="col-xs-12">
				<form enctype="multipart/form-data" id="submit" method="post">
					<div class="col-md-12">
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Nama Pelanggan</label>
								<input type="text" id="nama_pelanggan" class="form-control" placeholder="[Auto]" required>
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Email</label>
								<input type="text" id="email_pelanggan" class="form-control" required>
							</div>
						</div>
						<div class="col-sm-12 col-md-3">
							<div class="form-group" >
								<label>No Referensi</label>
								<input type="text" id="no_referensi" class="form-control moneydec">
							</div>
						</div>
						<div class="col-sm-6 col-md-3">
							<div class="form-group">
								<label>Alamat Penagihan</label>
								<textarea id="alamat_penagihan" class="form-control" style="height: 33px;"></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-12">
						<hr>
						
					</div>
					<div class="col-md-12" id="btn_save">
						
						<button class="btn btn-success pull-right"><i class="fa fa-save"></i> Simpan</button>
						
					</div>
					<div class="col-md-12">
						<br>
						<br>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-1.11.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
<?php $this->load->view('footer');?>
<script>
$(function(){
    $("#submit").validate();    
    $("#submit").on('submit', function(e) {
        var isvalid = $("#submit").valid();
        if (isvalid) {
            e.preventDefault();
            alert(getvalues("submit"));
        }
    });
});

function getvalues(f)
{
    var form=$("#"+f);
    var str='';
    $("input:not('input:submit')", form).each(function(i){
        str+='\n'+$(this).prop('name')+': '+$(this).val();
    });
    return str;
}
/* 
$(document).ready(function() {
	
	$('#submit').validate({
		errorElement: 'div',
		errorClass: 'help-block',
		focusInvalid: true,
		ignore: "",
		rules: {
			sid: {
				required: true,
			},
		},
		
		highlight: function (e) {
			$(e).closest('.form-group').removeClass('has-info').addClass('has-error');
		},

		success: function (e) {
			$(e).closest('.form-group').removeClass('has-error');//.addClass('has-info');
			$(e).remove();
		},

		errorPlacement: function (error, element) {
			if(element.is('input[type=checkbox]') || element.is('input[type=radio]')) {
				var controls = element.closest('div[class*="col-"]');
				if(controls.find(':checkbox,:radio').length > 1) controls.append(error);
				else error.insertAfter(element.nextAll('.lbl:eq(0)').eq(0));
			}
			else if(element.is('.select2')) {
				error.insertAfter(element.siblings('[class*="select2-container"]:eq(0)'));
			}
			else if(element.is('.chosen-select')) {
				error.insertAfter(element.siblings('[class*="chosen-container"]:eq(0)'));
			}
			else error.insertAfter(element);
		},
		
		submitHandler: function (form) {
			var datasid = {
				sid: $("#sid").val(),
				act:'mapping'
			};
			var csrf_req = $("#form-request #csrf").val();
			$.ajax({
				url: '<?php echo $this->basePath()?>/ticket/request-sid',
				type: "POST",
				dataType: 'json',
				data: { guid: 1,code: 1,data: JSON.stringify(datasid),csrf: csrf_req},
				success: function(datax) {
					var dataInfo = datax.info;
					var dataDokter = datax.guid;
					var dataCode = datax.code;
					
					$('#myModalInfo').modal('hide');
					if(dataCode === 0){			
						var $contentInfo = $('#kontenSukses');
						document.getElementById("kontenSukses").innerHTML = '';
						$contentInfo.append(dataInfo);
						
						$("#myModalSukses").modal()
					}else{
						var $contentInfo = $('#kontenSukses');
						document.getElementById("kontenSukses").innerHTML = '';
						$contentInfo.append('Maaf Request Mapping Anda, Gagal!');
						
						$("#myModalSukses").modal()
					}
				}
			});
			return false;
		}
	});
}); */
</script>
