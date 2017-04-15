
<!--Adding code use the "search function" that I have created inside the "nav-bar" in "header.php"-->
<form role= "search" method="get" action="<?php echo home_url('/');?>">
	<input type="search" class="form-control" placeholder="Search" value="<?php echo get_search_query()?>"
	name="s" title="Search"/>
</form>
