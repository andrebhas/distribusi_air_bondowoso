<!-- Main sidebar -->
			<div class="sidebar sidebar-main">
				<div class="sidebar-content">

					<!-- User menu -->
					<div class="sidebar-user">
						<div class="category-content">
							<div class="media">
								<a href="#" class="media-left"><img src="<?= base_url('images/users/'.$user->user_img)?>" class="img-circle img-sm" alt=""></a>
								<div class="media-body">
									<span class="media-heading text-semibold"><?php echo $user->username ?></span>
								</div>

								<div class="media-right media-middle">
									<ul class="icons-list">
										<li>
											<a href="<?php echo base_url('users/update/'.$user->id) ?>"><i class="icon-cog3"></i></a>
										</li>
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- /user menu -->


					<!-- Main navigation -->
					<div class="sidebar-category sidebar-category-visible">
						<div class="category-content no-padding">

							<ul class="navigation navigation-main navigation-accordion">
								<li class="navigation-header"><span>Main Menu</span> <i class="icon-menu" title="Main pages"></i></li>

								<li><a href="<?php echo base_url('dashboard.html') ?>"><i class="icon-home4"></i> <span>Dashboard</span></a></li>
								<li><a href="<?php echo base_url('survey.html') ?>"><i class="icon-reading"></i> <span>Survey</span></a></li>

	<?php
		$admin = 1; 
		if ($this->ion_auth->in_group($admin)): 
	?>
								
								<li>
									<a href="#"><i class="fa fa-puzzle-piece"></i> <span>Analisis Prioritas SAW</span></a>
									<ul>
										<li><a href="<?php echo base_url('analisis.html')?>"><i class="fa fa-search"></i> <span>Analisis</span></a></li>
										<li><a href="<?php echo base_url('kriteria.html') ?>"><i class="fa fa-sitemap"></i> <span>Kriteria</span></a></li>
										<li><a href="<?php echo base_url('subkriteria.html') ?>"><i class="fa fa-sitemap"></i> <span>Sub Kriteria</span></a></li>
										<li><a href="<?php echo base_url('subsubkriteria.html') ?>"><i class="fa fa-sitemap"></i> <span>Sub Sub Kriteria</span></a></li>
									</ul>
								</li>
								<li>
									<a href="#"><i class="icon-users"></i> <span>Kelola Users</span></a>
									<ul>
										<li><a href="<?php echo base_url('users.html') ?>"><i class="fa fa-users"></i> <span>Users</span></a></li>
										<li><a href="<?php echo base_url('groups.html') ?>"><i class="fa fa-sitemap"></i> <span>Level</span></a></li>
									</ul>
								</li>
	<?php else: ?>



	<?php endif ?>
								



							</ul>
						</div>
					</div>
					<!-- /main navigation -->

				</div>
			</div>
			<!-- /main sidebar -->

			<script type="text/javascript">
				var url = window.location;
				// Will only work if string in href matches with location
				$('ul.navigation a[href="'+ url +'"]').parent().addClass('active');

				// Will also work for relative and absolute hrefs
				$('ul.navigation a').filter(function() {
				    return this.href == url;
				}).parent().addClass('active');
			</script>