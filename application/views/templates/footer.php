</div>
</div>
	<?php $_SESSION['acao_atual'] = current_url();?>
</main>
<footer class="footer fixed-bottom bg-dark ">
    <!-- Copyright -->
    <div class="footer-copyright text-center py-3">
        <span class="text-muted">&copy; Rodrigo Palermo, 2019
			<?php echo  (ENVIRONMENT === 'development') ?  ' - Page rendered in <strong>{elapsed_time}</strong> seconds. CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></span>
    </div>
</footer>
    </body>
</html>



