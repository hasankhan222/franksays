<?php
/**
 * Archive pagination
 *
 * @package Isca
 */

?>
<ul id="pagination">
	<li class="older">
		<?php previous_post_link( '<span class="more-link">%link</span>' ); ?>
	</li>
	<li class="newer">
		<?php next_post_link( '<span class="more-link">%link</span>' ); ?>
	</li>
</ul>
