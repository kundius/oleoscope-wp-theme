<div class="searchBlock">
	<form role="search" id="searchform" method="get" class="searchform" action="<?php echo home_url( '/' ); ?>">
		<div class="input-group">
			<input type="search" class="form-control" placeholder="<?php echo esc_attr_x( 'Найти на сайте …', 'placeholder' ) ?>" value="<?php echo get_search_query() ?>" name="s" title="<?php echo esc_attr_x( 'Search for:', 'label' ) ?>" />
			<button class="searchBtn"></button>
		</div>
	</form>
</div>