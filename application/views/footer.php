</div>
    <?php 
		/* $active = $this->uri->segment(1);
		$sub_ac		= $this->uri->segment(2);
		$pn_jabatan = $this->session->userdata('pn_jabatan');
		echo (cek_read($pn_jabatan,$active,$sub_ac));
		echo (check_valid()); */
	?>
    
    <!-- Custom Theme JavaScript -->
    
	
	<script src="<?=base_url();?>plugins/jQuery/jquery-2.2.3.min.js"></script>
	<!-- Bootstrap 3.3.6 -->
	<script src="<?=base_url();?>bootstrap/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="<?=base_url();?>plugins/fastclick/fastclick.js"></script>
	<!-- AdminLTE App -->
	<script src="<?=base_url();?>dist/js/app.min.js"></script>
	<!-- Sparkline -->
	<script src="<?=base_url();?>plugins/sparkline/jquery.sparkline.min.js"></script>
	<!-- jvectormap -->
	<script src="<?=base_url();?>plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?=base_url();?>plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
	<!-- mask -->
	<script src="<?=base_url();?>plugins/input-mask/jquery.mask.min.js"></script>
	<!-- SlimScroll 1.3.0 -->
	<script src="<?=base_url();?>plugins/slimScroll/jquery.slimscroll.min.js"></script>
	<script src="<?=base_url();?>plugins/chosen/chosen.jquery.js"></script>
	<script src="<?=base_url();?>plugins/chosen/chosen.jquery.min.js"></script>
	<script src="<?=base_url()?>plugins/jQueryUI/jquery-ui.min.js"></script>
	<script src="<?=base_url()?>plugins/datatables/jquery.dataTables.js"></script>
	<!-- Metis Menu Plugin JavaScript -->
    <script src="<?=base_url()?>vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
	<script src="<?=base_url()?>dist/js/sb-admin-2.js"></script>
    <script src="<?=base_url()?>vendor/raphael/raphael.min.js"></script>
	
	<script>
	$('.money').mask('000,000,000,000,000', {reverse: true});
	$('.moneydec').mask('000000000000000', {reverse: true});
</script>
</body>

</html>

