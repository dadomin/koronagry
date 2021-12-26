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
Route::get("/modify/notice", "AdminController@noticemodify");

Route::get("/comment/like", "BoardController@commentLike");
Route::get("/rank", "UserController@rank");
Route::get("/best/daily", "BoardController@bestDaily");
Route::get("/best/weekend", "BoardController@bestWeekend");
Route::get("/best/month", "BoardController@bestMonth");

Route::get("/introduce", "CompanyController@all");
Route::get("/company/add", "CompanyController@add");
Route::get("/company", "CompanyController@view");

Route::get("/report/board", "BoardController@reportBoard");
Route::get("/report/comment", "BoardController@reportComment");
Route::get("/admin/category", "AdminController@category");
Route::get("/admin/blind", "AdminController@blind");
Route::get("/admin/show", "AdminController@show");
Route::get("/admin/report", "AdminController@reportAll");

Route::post("/member/delete", "AdminController@deletemember");

Route::post("/register/check", "UserController@regicheck");
Route::post("/login/check", "UserController@logcheck");
Route::post("/write/ok", "BoardController@writeOk");
Route::post("/profile/change", "UserController@profilechange");
Route::post("/like", "BoardController@like");
Route::post("/unlike", "BoardController@unlike");
Route::post("/notice/ok", "AdminController@noticeok");
Route::post("/delete/board", "BoardController@delete");
Route::post("/delete/notice", "AdminController@noticedelete");
Route::post("/modify/board/ok", "BoardController@modifyOk");
Route::post("/modify/notice/ok", "AdminController@noticeModifyOk");

Route::post("/write/comment", "BoardController@comment");

Route::post("/email", "UserController@email");

Route::post("/company/add/ok", "CompanyController@addOk");
Route::post("/review/add", "CompanyController@reviewAdd");

Route::post("/point", "AdminController@givePoint");
Route::post("/admin/point", "AdminController@pointLevel");

Route::post("/admin/category/update", "BoardController@categoryUpdate");
Route::post("/admin/category/delete", "BoardController@categoryDelete");
Route::post("/admin/category/add", "BoardController@categoryAdd");

Route::post("/member/limit", "AdminController@limit");
Route::post("/member/limit-none", "AdminController@limit_none");
Route::post("/admin/level", "AdminController@levelGrade");