<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<link rel="apple-touch-icon" sizes="57x57" href="/favicon/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/favicon/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/favicon/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/favicon/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/favicon/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/favicon/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/favicon/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/favicon/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/favicon/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/favicon/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/favicon/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<link rel="stylesheet" href="/fontawesome/css/all.css">
	<link rel="stylesheet" href="/css/style.css">
	<script src="/js/jquery-3.3.1.js"></script>
	<script src="/js/script.js"></script>
	<title>Korona Gry</title>
</head>
<body>
		
<?php
$today = date("m월 d일");
$day = date("Y-m-d");
$y = array("일","월","화","수","목","금","토");
$d = $y[date('w', strtotime($day))];
?>

	
	<!-- header - no login - -->
	<?php if(isset($_SESSION['user'])) : ?>
	<nav id="header_nav">

		<span><?= $today ?>(<?= $d ?>)</span>
		<ul>
			<li><a href="/profile&id=<?= $user->id ?>"><?= $user->name ?>님(<?= $user->point ?>)</a></li>
			<li><a href="/logout">로그아웃</a></li>
		</ul>
	</nav>
	<?php else : ?>

	<nav id="header_nav">
		
		<span><?= $today ?>(<?= $d ?>)</span>
		<ul>
			<li><a href="/login">로그인</a></li>
			<li><a href="/register">회원가입</a></li>
		</ul>
	</nav>
	
	<?php endif; ?>

	<header>
		<a href="/" id="header_logo">
			<img src="/img/logo.png" alt="logo" height="90">
		</a>

		<form action="search" method="get">
			<div class="search_box">
				<select name="tag" id="tag">
					<option value="title">제목</option>
					<option value="writer">글쓴이</option>
					<option value="sub">본문</option>
				</select>
				<input type="text" name="contain">
				<button><i class="fas fa-search"></i></button>
			</div>
		</form>
	</header>
	
	<nav id="header_menu">
		<div class="size">
			<ul>
				<li><a href="/"><i class="fas fa-home"></i></a></li>
				<li><a href="/introduce">소개</a></li>
				<li><a href="/">리뷰</a></li>
				<li class="drop-down"><a>베스트글</a>
					<ul class="drop-menu">
						<li><a href="/best/daily">일간Best</a></li>
						<li><a href="/best/weedend">주간Best</a></li>
						<li><a href="/best/month">월간Best</a></li>
					</ul>
				</li>
				<li><a href="/board">커뮤니티</a></li>
				<li><a href="/notice">공지사항</a></li>
				<li><a href="/rank">랭킹</a></li>
				
				<?php if(isset($_SESSION['user'])) : ?>
					<?php if($_SESSION['user']->id == 'admin') : ?>
						<li><a href="/member">회원관리</a></li>
						<li><a href="/write/notice">공지글 쓰기</a></li>
						<li><a href="/notice">공지글 관리</a></li>
					<?php endif; ?>
				<?php endif; ?>
			</ul>
			<a href="/my"><i class="far fa-user"></i> 내가 쓴 글 보기</a>
		</div>
	</nav>
	

	<div class="size">