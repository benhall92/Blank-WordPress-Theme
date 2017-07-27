<!-- NAVIGATION -->
<div id="navigation" data-lap="lap-hidden" data-palm="palm-hidden">

	<!-- NAVIGATION WITH SCHEMA -->
	<nav class="nav nav--primary" itemscope itemtype="http://schema.org/SiteNavigationElement">

		<ul class="mega-menu">
            <?php
             
            $locations = get_nav_menu_locations();

            if ( isset( $locations[ 'mega_menu' ] ) ) :
               
                $menu = get_term( $locations[ 'mega_menu' ], 'nav_menu' );
                
                if ( $items = wp_get_nav_menu_items( $menu->name ) ) :
                    
                    foreach ( $items as $item ) : ?>

                		<?php $class_names = esc_attr( implode( ' ', $item->classes ) ); ?>
                        
                        <li class="mega-menu__list <?php echo $class_names; ?>">

                        	<div class="list__wrap">
                            
	                            <a href="<?php echo $item->url; ?>"><?php echo $item->title; ?></a>
	                            
	                            <?php if ( is_active_sidebar( 'mega-menu-widget-area-' . $item->ID ) ) : ?>

	                           		<i class="fa fa-chevron-down" aria-hidden="true"></i>
									
							<!-- list wrapp -->
	                        </div>
	                                
                            <div id="mega-menu-<?php echo $item->ID;?>" class="mega-menu__container">

                            	<div class="wrapper">

                                	<ul class="mega-menu__widgets" id="mega">

                                    <?php dynamic_sidebar( 'mega-menu-widget-area-' . $item->ID ); ?>

                                	</ul>

                                </div>

                                <?php get_template_part('theme/includes/thin_usps'); ?>	

                            </div>

                           <?php else: ?>

	                        <!-- list wrapp -->
	                        </div>
	                            
	                        <?php endif; ?>

                        </li>
                    
                    <?php endforeach; ?>
                
                <?php endif; ?>
            
            <?php endif; ?>

        </ul>
		
	<!-- NAVs -->
	</nav>
	
<!-- NAVIGATION -->
</div>