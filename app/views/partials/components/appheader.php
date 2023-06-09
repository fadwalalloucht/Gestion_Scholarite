<?php

$navbarsideleft = array(
    array(
        'path' => 'home',
        'label' => 'Acceuil',
        'icon' => '<i class="fa fa-home "></i>',
    ),
	array(
		'path' => 'filieres',
		'label' => 'Filieres',
		'icon' => '<i class="fa fa-diamond "></i>',
	),
 

    array(
        'path' => 'etudiants',
        'label' => 'utilisateurs',
        'icon' => '<i class="fa fa-group "></i>',
        'submenu' => array(
            array(
                'path' => 'tuteurs',
                'label' => 'Tuteurs',
                'icon' => '<i class="fa fa-user-secret "></i>',
            ),

            array(
                'path' => 'professeurs',
                'label' => 'Professeurs',
                'icon' => '<i class="fa fa-user-md "></i>',
            ),

            array(
                'path' => 'etudiants/list',
                'label' => 'Etudiants',
                'icon' => '<i class="fa fa-group "></i>',
            ),
        ),
    ),

   

   
);

$navbartopleft = array(
    array(
        'path' => 'messages/list',
        'label' => 'Messages',
        'icon' => '<i class="fa fa-wechat "></i>',
    ),
);

?>
<template id="AppHeader">
	<div>
<b-navbar ref="navbar" toggleable="md" fixed="top" type="dark" variant="primary">
	<b-navbar-brand href="<?php print_link("");?>">
		<img class="img-responsive" src="<?php print_link(SITE_LOGO);?>" />
		<?php echo SITE_NAME ?>
	</b-navbar-brand>
	<b-navbar-toggle target="nav_collapse"></b-navbar-toggle>
	<?php
if (user_login_status() == true) {
    ?>
	<b-collapse is-nav id="nav_collapse">
		<b-navbar-nav ref="sidebar" class="navbar-fixed-left navbar-dark bg-primary">

			<div class="menu-profile">
				<a class="avatar" href="#account">
					<span class="avatar-icon"><i class="fa fa-user"></i></span>
				</a>
				<h5 class="user-name">Hi <?php echo ucwords(USER_NAME); ?> ! </h5>
				<?php
if (defined('USER_ROLE')) {
        ?>
						<small class="text-muted"><?php echo USER_ROLE; ?> </small>
					<?php
}
    ?>
				<div class="menu-dropdown">
					<b-nav-item-dropdown right>
						<template slot="button-content">
							<i class="fa fa-user"></i>
						</template>
						<b-dropdown-item href="#account"><i class="fa fa-user"></i> Mon compte</b-dropdown-item>
						<b-dropdown-item href="<?php print_link('index/logout?csrf_token=' . Csrf::$token)?>"><i class="fa fa-sign-out"></i> Connectez - Out</b-dropdown-item>
					</b-nav-item-dropdown>
				</div>
			</div>

			<?php render_menu($navbarsideleft, 'left');?>
		</b-navbar-nav>
		<b-navbar-nav>
			<?php render_menu($navbartopleft, 'left');?>
		</b-navbar-nav>

		<!-- Right aligned nav items -->
		<b-navbar-nav class="ml-auto">


				<b-nav-item-dropdown right>
					<template slot="button-content">
						<span class="avatar-icon"><i class="fa fa-user"></i></span>
						<span>Hi <?php echo ucwords(USER_NAME); ?> !</span>
					</template>
					<b-dropdown-item to="/account"><i class="fa fa-user"></i> My Account</b-dropdown-item>
					<b-dropdown-item href="<?php print_link('index/logout?csrf_token=' . Csrf::$token)?>"><i class="fa fa-sign-out"></i> Connectez - Out</b-dropdown-item>
				</b-nav-item-dropdown>

		</b-navbar-nav>

	</b-collapse>
	<?php
}
?>
</b-navbar>
</div>
</template>

<script>
	var AppHeader = Vue.component('AppHeader', {
		template:'#AppHeader',
		mounted:function(){
			//let height = this.$el.offsetHeight;
			if(this.$refs.navbar){
				var height = this.$refs.navbar.offsetHeight;
				document.body.style.paddingTop = height + 'px';

				if(this.$refs.sidebar){
					this.$refs.sidebar.style.top = height + 'px';
				}
			}
		}
	})
</script>

<?php
/**
 * Build Menu List From Array
 * Support Multi Level Dropdown Menu Tree
 * Set Active Menu Base on The Current Page || url
 * @return  HTML
 */
function render_menu($arrMenu, $slot = "left")
{
    if (!empty($arrMenu)) {
        foreach ($arrMenu as $menuobj) {
            $path = trim($menuobj['path'], "/");

            if (PageAccessManager::GetPageAccess($path) == 'AUTHORIZED') {

                if (empty($menuobj['submenu'])) {
                    ?>
						<b-nav-item to="/<?php echo ($path); ?>">
							<?php echo (!empty($menuobj['icon']) ? $menuobj['icon'] : null); ?>
							<?php echo $menuobj['label']; ?>
						</b-nav-item>
						<?php
} else {
                    $smenu = $menuobj['submenu'];
                    ?>
						<b-nav-item-dropdown right>
							<template slot="button-content">
								<?php echo (!empty($menuobj['icon']) ? $menuobj['icon'] : null); ?>
								<?php echo $menuobj['label']; ?>
								<?php if (!empty($smenu)) {?><i class="caret"></i><?php }?>
							</template>
							<?php
if (!empty($smenu)) {
                        render_submenu($smenu);
                    }
                    ?>
						</b-nav-item-dropdown>
						<?php
}
            }
        }

    }
}

/**
 * Render Multi Level Dropdown menu
 * Recursive Function
 * @return  HTML
 */
function render_submenu($arrMenu)
{
    if (!empty($arrMenu)) {
        foreach ($arrMenu as $key => $menuobj) {
            $path = trim($menuobj['path'], "/");
            if (PageAccessManager::GetPageAccess($path) == 'AUTHORIZED') {
                ?>
					<b-dropdown-item to="/<?php echo ($path); ?>">
						<?php echo (!empty($menuobj['icon']) ? $menuobj['icon'] : null); ?>
						<?php echo $menuobj['label']; ?>
						<?php
if (!empty($menuobj['submenu'])) {
                    render_menu($menuobj['submenu']);
                }
                ?>
					</b-dropdown-item>
					<?php
}
        }
    }
}
?>