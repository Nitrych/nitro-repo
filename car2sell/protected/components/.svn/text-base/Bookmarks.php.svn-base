<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Bookmarks extends CWidget {
	public function run(){
		$bookmarks = Post::model()->getBookmarks();
        		
		if(count($bookmarks)>0){
			$total = count($bookmarks);
			echo "<a class='".Helper::getLinkClass("/post/favorites")."' href='/post/favorites'>Избранные: $total </a> |";
		}
	}
}
?>
