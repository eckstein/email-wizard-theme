<!DOCTYPE html>
<html <?php language_attributes(); ?> <?php emailwizard_theme_schema_type(); ?>>

<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div id="wrapper" class="hfeed">
		<header id="header" role="banner">
			<div id="header-inner">
				<div id="branding">
					<div id="site-logo" itemprop="publisher" itemscope itemtype="https://schema.org/Organization">
						<?php
						$site_logo = get_theme_mod( 'emailwizard_site_logo' ) ?? '';
						?>
						<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
							<img src="<?php echo esc_url( $site_logo ); ?>" alt="<?php bloginfo( 'name' ); ?>"
								class="site-logo">
						</a>
					</div>

				</div>
				<nav id="content-menu" class="header-menu main" role="navigation" itemscope
					itemtype="https://schema.org/SiteNavigationElement">
					<?php wp_nav_menu( array( 'theme_location' => 'content-menu', 'link_before' => '<span itemprop="name">', 'link_after' => '</span>' ) ); ?>
				</nav>
				<nav id="user-menu" class="header-menu" role="navigation" itemscope
					itemtype="https://schema.org/SiteNavigationElement">
					<?php if ( is_user_logged_in() ) : ?>
						<ul>

							<!-- <li class="nav-button"><a href="<?php //echo esc_url( home_url( '/templates/' ) );    ?>"><i
										class="fa-regular fa-folder"></i>&nbsp;&nbsp;Templates</a></li> -->
							<li><button class="wizard-button new-template"><i class="fa-solid fa-plus"></i>&nbsp;&nbsp;New
									Template</button>
							</li>
							<li id="user-dropdown" class="wizard-dropdown">
								<i class="fa-2x fa-regular fa-circle-user"></i>
								<div class="wizard-dropdown-panel" id="user-dropdown-panel">
									<ul class="wizard-dropdown-menu">
										<li><a href="<?php echo esc_url( home_url( '/account/' ) ); ?>"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;Account</a></li>
										<li><a href="<?php echo esc_url( home_url( '/settings/' ) ); ?>"><i class="fa-solid fa-sliders"></i>&nbsp;&nbsp;Settings</a></li>
										<li><a href="<?php echo esc_url( wp_logout_url() ); ?>"><i class="fa-solid fa-right-from-bracket"></i>&nbsp;&nbsp;Sign Out</a></li>
									</ul>
								</div>
							</li>
						</ul>
					<?php else : ?>
						<ul>
							<li class="nav-button"><a href="<?php echo esc_url( home_url( '/get-started/' ) ); ?>">Get
									Started</a></li>
							<li><a href="<?php echo esc_url( wp_login_url() ); ?>">Sign In</a></li>
						</ul>
					<?php endif; ?>
				</nav>

			</div>
		</header>
		<div id="container">
			<main id="content" role="main">