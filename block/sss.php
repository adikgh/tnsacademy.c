<div class="ub1_l">
				<div class="umenu_c">
					<div class="logo_m">D</div>
					<?php if (!$user_right): ?>
						<!-- <a class="menu_ci <?=($menu_name=='dashboard'?'menu_ci_act':'')?>" href="#" href-old="/u/dashboard.php">
							<div class="menu_cin"><i class="fal fa-chalkboard-teacher"></i></div>
							<div class="menu_cih">Оқу үстелі</div>
						</a> -->
					<?php endif ?>
					<a class="menu_ci <?=($menu_name=='cours'?'menu_ci_act':'')?>" href="/user/cours/">
						<div class="menu_cin"><i class="fal fa-graduation-cap"></i></div>
						<div class="menu_cih">Курстар</div>
					</a>
					<?php if ($user_right): ?>
						<a class="menu_ci <?=($menu_name=='users'?'menu_ci_act':'')?>" href="/user/admin/users/">
							<div class="menu_cin"><i class="fal fa-users"></i></div>
							<div class="menu_cih">Оқушылар</div>
						</a>
						<a class="menu_ci <?=($menu_name=='autors'?'menu_ci_act':'')?>" href="/user/admin/autors/">
							<div class="menu_cin"><i class="fal fa-user-tie"></i></div>
							<div class="menu_cih">Ұстаздар</div>
						</a>
						<?php if ($user_super_right): ?>
							<a class="menu_ci <?=($menu_name=='rights'?'menu_ci_act':'')?>" href="/user/admin/rights/">
								<div class="menu_cin"><i class="fal fa-users-cog"></i></div>
								<div class="menu_cih">Басқарушылар</div>
							</a>
						<?php endif ?>
					<?php endif ?>
					<?php if (!$user_right): ?>
						<!-- <a class="menu_ci <?=($menu_name=='bookmark'?'menu_ci_act':'')?>" href="/user/bookmark.php">
							<div class="menu_cin"><i class="fal fa-bookmark"></i></div>
							<div class="menu_cih">Сақтаулы</div>
						</a> -->
					<?php endif ?>
					<!-- <a class="menu_ci" href="#">
						<div class="menu_cin"><i class="fal fa-award"></i></div>
						<div class="menu_cih">Академия жайлы</div>
					</a> -->
					<a class="menu_ci <?=($menu_name=='user'?'menu_ci_act':'')?>" href="/user/">
						<div class="menu_cin"><i class="fal fa-user"></i></div>
						<div class="menu_cih">Аккаунт</div>
					</a>
					<!-- <a class="menu_ci <?=($menu_name=='setting'?'menu_ci_act':'')?>" href="/u/setting.php">
						<div class="menu_cin"><i class="fal fa-cog"></i></div>
						<div class="menu_cih">Баптаулар</div>
					</a> -->
				</div>
				<div class="ub1_lb">
					<div class="ub1_lbt">
						<a class="menu_ci" href="/user/exit.php">
							<div class="menu_cin"><i class="fal fa-sign-out"></i></div>
							<div class="menu_cih">Шығу</div>
						</a>
					</div>
					<div class="ub1_lbb">
						<div class="ub1_lbb1">
							<a href="https://gprog.kz" target="_blank" class="gprog_bl">
								<span>#gprog-та</span>
								<div class="gprog_heart"><i class="fas fa-heart"></i></div>
								<span>жасалған</span>
								<div class="gprog_ab">
									<div class="gprog_lg"><div class="lazy_img" data-src="https://gprog.kz/assets/img/logo/logo_tr_1200.png"></div></div>
									<div class="gprog_h">G prog</div>
									<div class="gprog_p">digital cіздің<br>бизнесіңізге</div>
								</div>
							</a>
						</div>
					</div>
				</div>
			</div>