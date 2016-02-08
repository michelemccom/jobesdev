<?php
/**
 * @package WordPress
 * @subpackage Jobes
 */
?>


</div> <!-- /content -->
<div id="footer">
	<div class="shell">
		<?php wp_nav_menu( array( 'theme_location' => 'footer' ) ); ?>           
	    <p>Copyright &copy; <?php echo date('Y') ?></p>    
    </div>     
</div> <!-- /footer -->

</div> <!-- /page -->

<?php wp_footer(); ?>
</body>
</html>