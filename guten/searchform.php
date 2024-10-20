<?php
/**
 * The template for displaying search forms in Guten
 */ ?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label>
		<input type="search" class="search-field" placeholder="<?php echo esc_attr( get_theme_mod( 'guten-header-search-txt', customizer_library_get_default( 'guten-header-search-txt' ) ) ); ?>" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" />
	</label>
	<input type="submit" class="search-submit" value="<?php echo esc_attr_x( '&nbsp;', 'submit button', 'guten' ); ?>" />
</form>
