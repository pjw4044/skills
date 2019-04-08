<!-- 서브 비주얼 Sub Visual Start -->
<div class="sub_visual">
	
	<script type="text/javascript">

		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0',
			'width', '850',
			'height', '150',
			'src', '/common/swf/sub',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'window',
			'devicefont', 'false',
			'id', 'sub',
			'bgcolor', '#584232',
			'name', 'sub',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '/common/swf/sub',
			'salign', '',
			'wmode','transparent'
			);

	</script>

</div>
<!-- // 서브 비주얼 Sub Visual End -->

<!-- 서브 컨텐츠 Sub Content Start -->
<div class="sub_content">

	<!-- 서브 메뉴 Sub Menu Start -->
	<div class="lnb">
		
		<h2><?php echo $main_title ?></h2>

		<ul>

		<?php

			$db->table = $menu_table;

			$dep2_r = $db->select("parent='{$midx}' order by od asc");

			for($i = 1; $dep2 = mysql_fetch_assoc($dep2_r); $i++) {

				$style = $dep2['idx'] == $sidx ? 'over' : '';

				echo "<li><a class=\"{$style}\" href=\"/page/{$dep2['parent']}/{$dep2['idx']}/\" title=\"{$dep2['title']}\">{$dep2['title']}</a></li>";

			}

		?>

		</ul>

	</div>
	<!-- // 서브 메뉴 Sub Menu End -->

	<!-- 컨텐츠 Content Start -->
	<div class="sub_cont">

		<!-- 페이지 제목 Page Title Start -->
		<div class="page_title">
			<h3><?php echo $sub_title ?></h3>
			<p class="location">
				<a href="/" title="메인화면">메인화면</a> &gt;
				<a href="<?php echo "/page/{$midx}/{$page['idx']}/" ?>" title="<?php echo $main_title ?>"><?php echo $main_title ?></a> &gt;
				<a href="<?php echo "{$get_page}" ?>" title="<?php echo $sub_title ?>" class="bold"><?php echo $sub_title ?></a>
			</p>
			<p class="font">
				<img src="/img/font_1.png" title="프린트" alt="프린트" onclick="window.print(); return false;" />
				<img src="/img/font_2.png" title="글자크게" alt="글자크게" onclick="zoom(20); return false;" />
				<img src="/img/font_3.png" title="글자작게" alt="글자작게" onclick="zoom(-20); return false;" />
				<img src="/img/font_4.png" title="기본크기" alt="기본크기" onclick="zoom(100); return false; "/>
			</p>
		</div>
		<!-- // 페이지 제목 Page Title End -->

		<!-- 본문 출력 Cont Area -->
		<div id="cont_area">

			<div class="html" style="line-height:200%">

				<?php echo $sub['content'] ?>

			</div>

			<?php if($sub['type'] != 'HTML') include_once("{$_SERVER['DOCUMENT_ROOT']}/{$page_mode}/{$include_file}.php") ?>

		</div>
		<!-- // 본문 출력 Cont Area -->

	</div>
	<!-- // 컨텐츠 Content End -->

</div>
<!-- // 서브 컨텐츠 Sub Content End -->