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
		<div class="footer-nav">
			<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?> 
		</div>	          
	    <div class="company-info">
	    	<p class="copyright">&copy; <?php echo date('Y') ?> Easy Gardener Products, Inc.</p>  
	    	<p>Easy Gardener Products, Inc.,<br />
	    	 3022 Franklin Avenue,<br />
	    	 Waco, TX 76710 USA 
	    	</p>
	    </div> 
	    <div class="social">
	    	<h5>Connect</h5>
	    	<ul>
	    		<li class="facebook">
	                <a target="_blank" title="facebook" href="https://www.facebook.com/">Facebook</a>
	            </li>
	            <li class="googleplus">
	                <a target="_blank" title="google plus" href="https://www.google.com/">Facebook</a>
	            </li>
	            <li class="twitter">
	                <a target="_blank" title="twitter" href="https://www.twitter.com/">Facebook</a>
	            </li>
	            <li class="pinterest">
	                <a target="_blank" title="pinterest" href="https://www.pinterest.com/">Facebook</a>
	            </li>
	            <li class="youtube">
	                <a target="_blank" title="youtube" href="https://www.youtube.com/">Facebook</a>
	            </li>
	    	</ul>
	    </div>
    </div>     
</div> <!-- /footer -->

</div> <!-- /page -->

<?php wp_footer(); ?>
</body>
</html>