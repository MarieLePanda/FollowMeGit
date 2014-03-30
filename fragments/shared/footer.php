<?php
/* ------------------------------------------------------------------------------------ */
/*										FOOTER											*/
/* ------------------------------------------------------------------------------------ */
?>
		</div>
		<div id="footer">
		<ul>
		  <li><a href="">Mentions légales</a></li>
		  <li><a href="">Qui sommes nous</a></li>
		</ul>
		</div>
		</div>
		<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
		<?php 
		if (isset($jsDependencies)){
			foreach($jsDependencies as $jsd){
				?>
				<script src="<?= $jsd ?>"></script>
				<?php
			}
		}
		?>

	</body>
</html>