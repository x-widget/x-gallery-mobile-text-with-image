<?php
if (!defined('_GNUBOARD_')) exit; // 개별 페이지 접근 불가
include_once(G5_LIB_PATH.'/thumbnail.lib.php');

widget_css();

if( $widget_config['forum1'] ) $_bo_table = $widget_config['forum1'];
else $_bo_table = $widget_config['default_forum_id'];

if ( empty($_bo_table) ) jsAlert('Error: empty $_bo_table ? on widget :' . $widget_config['name']);

if( $widget_config['no'] ) $limit = $widget_config['no'];
else $limit = 4;

$list = g::posts( array(
			"bo_table" 	=>	$_bo_table,
			"limit"		=>	$limit,
			"select"	=>	"idx,domain,bo_table,wr_id,wr_parent,wr_is_comment,wr_comment,ca_name,wr_datetime,wr_hit,wr_good,wr_nogood,wr_name,mb_id,wr_subject,wr_content"
				)
		);	
?>

<div class="gallery_1_mobile_list_with_image">
    <table width='100%' cellpadding=0 cellspacing=0 border=0>
    <?php for ($i=0; $i<count($list); $i++) {?>
	<tr valign='top'>
		
            <?php			
			$imgsrc = x::post_thumbnail( $_bo_table , $list[$i]['wr_id'], 58, 40 );
			
			//if ( !$imgsrc ) $img = $latest_skin_url.'/img/no-image.png';
			//else $img = $imgsrc['src'];
			if( $imgsrc ) $img = $imgsrc['src'];
			else $img = x::url().'/widget/'.$widget_config['name'].'/img/no-image.png';						
			?>
			<td width='59'>
				<div class='image_wrapper'>
					<a href="<?=$list[$i]['url']?>"><img src='<?=$img?>'/></a>
				</div>
			</td>			       
            <td>
				<div class='subject'><a href='<?=$list[$i]['url']?>'><?=cut_str(strip_tags($list[$i]['wr_subject']), 30, '...')?></div>
				<div class='contents_wrapper'><a href='<?=$list[$i]['url']?>'><?=cut_str(strip_tags($list[$i]['wr_content']), 35, '...')?></a></div>			
			</td>
				
             
	</tr>	
    <?php }  ?>
    <?php if(count($list) == 0) { //게시물이 없을 때  
			$img = $latest_skin_url.'/img/no-image.png';
			for ( $i=0; $i < 4; $i++ ) {?>
			<tr valign='top'>
				<td width='59'>
					<div class='image_wrapper'>
						<a href="<?=$list[$i]['href']?>"><img src='<?=$img?>'/></a>
					</div>
				</td>			       
				<td>
					<div class='subject'><a href='<?=G5_BBS_URL?>/write.php?bo_table=<?=$_bo_table?>'>글을 등록해 주세요.</div>
					<div class='contents_wrapper'><a href='<?=G5_BBS_URL?>/write.php?bo_table=<?=$_bo_table?>'>글을 등록해 주세요,</a></div>			
				</td>
			</tr>
			<? }?>
    <?php }  ?>
    </table>    
</div>



<!--[if IE]>
	<style>
		.gallery_1_mobile_list_with_image .list_title{
			margin-bottom:10px;
		}
		
		.gallery_1_mobile_list_with_image td{
			padding-top:0;	
		}
	</style>
<![endif]-->