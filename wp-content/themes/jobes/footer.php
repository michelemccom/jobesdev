<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */
?>

	</div> <!--/shell -->
</div> <!-- /content -->
<div id="footer">
	<div class="shell">
		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>           
	    <div class="company-info">
	    	<p>&copy; <?php echo date('Y') ?> Easy Gardener Products, Inc.</p>  
	    	<p>Easy Gardener Products, Inc.,<br />
	    	 3022 Franklin Avenue,<br />
	    	 Waco, TX 76710 USA 
	    	</p>
	    </div> 
	    <div class="social">
	    	<ul>
	    		<li class="facebook">
	                <a target="_blank" title="facebook" href="https://www.facebook.com/">Facebook</a>
	            </li>
	    	</ul>
	    </div>
    </div>     
</div> <!-- /footer -->

</div> <!-- /page -->

<?php wp_footer(); ?>
</body>
</html>