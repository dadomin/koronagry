<?php

use Korona\Route;

Route::get("/", "MainController@home");

Route::get("/login", "UserController@login");
Route::get("/register", "UserController@register");
Route::get("/logout", "UserController@logout");

Route::get("/board", "BoardController@all");
Route::get("/board/category", "BoardController@category");

Route::get("/write", "BoardController@write");

Route::get("/view", "BoardController@view");

Route::get("/profile", "UserController@profile");
Route::get("/my", "BoardController@my");

Route::get("/search", "BoardController@search");

Route::get("/board/search", "BoardController@search");
Route::get("/member", "AdminController@member");
Route::get("/write/notice", "AdminController@noticewrite");
Route::get("/notice", "AdminController@notice");
Route::get("/notice/view", "AdminController@view");

Route::get("/modify/board", "BoardController@modify");

Route::post("/member/delete", "AdminController@deletemember");

Route::post("/register/check", "UserController@regicheck");
Route::post("/login/check", "UserController@logcheck");
Route::post("/write/ok", "BoardController@writeOk");
Route::post("/profile/change", "UserController@profilechange");
Route::post("/like", "BoardController@like");
Route::post("/unlike", "BoardController@unlike");
Route::post("/notice/ok", "AdminController@noticeok");
Route::post("/delete/board", "BoardController@delete");
Route::post("/modify/board/ok", "BoardController@modifyOk");