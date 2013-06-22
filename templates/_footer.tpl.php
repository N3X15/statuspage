
		<div id="footer">
			<div class="wrapper">
				<?if(file_exists('images/logo_square.jpg')):?>
				<img src="images/logo_square.jpg" />
				<?endif;?>
				<div class="text">
					<ul>
						<?foreach($this->footer_links as $link):?>
						<li><a href="<?=$link['url']?>"><?=$link['title']?></a></li>
						<?endforeach;?>
						<li><iframe src="github-buttons/github-btn.html?user=N3X15&repo=statuspage&type=watch"  allowtransparency="true" frameborder="0" scrolling="0" width="62px" height="20px"></iframe></li>
					</ul>
				</div>
			</div>
		</div>


		<script type="text/javascript">
			!function(d,s,id) {
				var js,fjs=d.getElementsByTagName(s)[0];
				if(!d.getElementById(id)){
					js=d.createElement(s);
					js.id=id;
					js.src="//platform.twitter.com/widgets.js";
					fjs.parentNode.insertBefore(js,fjs);
				}
			}
			(document,"script","twitter-wjs");

			<?if(!empty($_GET['refresh'])):?>setRefresh();<?endif;?>
		</script>
	</body>
</html>
